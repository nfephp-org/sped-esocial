<?php

namespace NFePHP\eSocial;

/**
 * Classe Tools, executa a comunicação com o webservice do e-Social
 *
 * @category  NFePHP
 * @package   NFePHP\eSocial\BaseTools
 * @copyright Copyright (c) 2016
 * @license   https://www.gnu.org/licenses/lgpl-3.0.txt LGPLv3
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt GPLv3
 * @license   https://opensource.org/licenses/mit-license.php MIT
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-esocial for the canonical source repository
 */
use NFePHP\Common\Certificate\Pkcs12;
use NFePHP\Common\DateTime\DateTime;
use NFePHP\Common\Dom\Dom;
use NFePHP\Common\Soap\CurlSoap;
use NFePHP\Common\Files;
use RuntimeException;
use InvalidArgumentException;

class Base
{
    /**
     * errors
     * Matriz com os erros ocorridos
     * @var array
     */
    public $errors;
    /**
     * verAplic
     * Versão da aplicação
     * @var string
     */
    public $verAplic = '';
    /**
     * certExpireTimestamp
     * TimeStamp com a data de vencimento do certificado
     * @var double
     */
    public $certExpireTimestamp = 0;
    /**
     * String com a data de expiração da validade
     * do certificado digital no9 formato dd/mm/aaaa
     *
     * @var string
     */
    public $certExpireDate = '';
    /**
     * tpAmb
     * @var int
     */
    public $tpAmb = 2;
    /**
     * ambiente
     * @var string
     */
    public $ambiente = 'homologacao';
    /**
     * aConfig
     * @var array
     */
    public $aConfig = array();
    /**
     * sslProtocol
     * @var int
     */
    public $sslProtocol = 0;
    /**
     * soapTimeout
     * @var int
     */
    public $soapTimeout = 10;
    /**
     * oCertificate
     * @var Object Class
     */
    public $oCertificate;
    /**
     * oSoap
     * @var Object Class
     */
    public $oSoap;
    /**
     * soapDebug
     * @var string
     */
    public $soapDebug = '';
    /**
     * XMLNS namespace
     * @var string
     */
    public $xmlns = "http://sped.fazenda.gov.br/";
    
    /**
     * __construct
     * @param string $configJson
     * @param bool   $ignore default false usado para testes apenas
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function __construct($configJson = '', $ignore = false)
    {
        if ($configJson == '') {
            $msg = 'O arquivo de configuração no formato JSON deve ser passado para a classe.';
            throw new InvalidArgumentException($msg);
        }
        if (is_file($configJson)) {
            $configJson = Files\FilesFolders::readFile($configJson);
        }
        //carrega os dados de configuração
        $this->aConfig      = (array) json_decode($configJson, true);
        $this->aProxyConf   = (array) $this->aConfig['aProxyConf'];
        $this->verAplic     = $this->aConfig['verAplic'];
        //seta o timezone
        DateTime::tzdBR($this->aConfig['siglaUF']);
        //carrega os certificados
        $this->oCertificate = new Pkcs12(
            $this->aConfig['pathCertsFiles'],
            $this->aConfig['cnpj'],
            '',
            '',
            '',
            $ignore
        );
        $timestampnow = gmmktime(0, 0, 0, date("m"), date("d"), date("Y"));
        if ($this->oCertificate->expireTimestamp == 0 || $this->oCertificate->expireTimestamp < $timestampnow) {
            //tentar carregar novo certificado
            $this->atualizaCertificado(
                $this->aConfig['pathCertsFiles'].$this->aConfig['certPfxName'],
                $this->aConfig['certPassword']
            );
            if ($this->oCertificate->expireTimestamp == 0 || $this->oCertificate->expireTimestamp < $timestampnow) {
                $msg = 'Não existe certificado válido disponível. Atualize o Certificado.';
                throw new RuntimeException($msg);
            }
        }
        $this->setAmbiente($this->aConfig['tpAmb']);
        $this->certExpireTimestamp = $this->oCertificate->expireTimestamp;
        $this->certExpireDate = date('d/m/Y', $this->certExpireTimestamp);
        $this->loadSoapClass();
    }
    
   /**
    * getCertTimestamp
    * Retorna o timestamp para a data de vencimento do Certificado
    * @return int
    */
    public function getCertTimestamp()
    {
        return $this->certExpireTimestamp;
    }
   /**
    * getCertValidity
    * Retorna o timestamp para a data de vencimento do Certificado
    * @return int
    */
    public function getCertValidity()
    {
        return $this->certExpireDate;
    }
    
    /**
     * setSSLProtocol
     * Força o uso de um determinado protocolo de encriptação
     * na comunicação https com a SEFAZ usando cURL
     * Apenas é necessário quando a versão do PHP e do libssl não
     * consegue estabelecer o protocolo correto durante o handshake
     * @param string $protocol
     */
    public function setSSLProtocol($protocol = '')
    {
        if (! empty($protocol)) {
            switch ($protocol) {
                case 'TLSv1':
                    $this->sslProtocol = 1;
                    break;
                case 'SSLv2':
                    $this->sslProtocol = 2;
                    break;
                case 'SSLv3':
                    $this->sslProtocol = 3;
                    break;
                case 'TLSv1.0':
                    $this->sslProtocol = 4;
                    break;
                case 'TLSv1.1':
                    $this->sslProtocol = 5;
                    break;
                case 'TLSv1.2':
                    $this->sslProtocol = 6;
                    break;
                default:
                    $this->sslProtocol = 0;
            }
            $this->loadSoapClass();
        }
    }
    
    /**
     * getSSLProtocol
     * Retorna o protocolo que está setado
     * Se for indicada qualquer opção no parametro será retornada as possiveis
     * opções para o protocolo SSL
     * @return string | array protocolo setado ou array de opções
     */
    public function getSSLProtocol($opt = '')
    {
        $aPr = array('automatic','TLSv1','SSLv2','SSLv3','TLSv1.0','TLSv1.1','TLSv1.2');
        if ($opt == '') {
            return $aPr[$this->sslProtocol];
        }
        return $aPr;
    }
    
    /**
     * setSoapTimeOut
     * Seta um valor para timeout
     * @param integer $segundos
     */
    public function setSoapTimeOut($segundos = 10)
    {
        if (! empty($segundos)) {
            $this->soapTimeout = $segundos;
            $this->loadSoapClass();
        }
    }
    
    /**
     * getSoapTimeOut
     * Retorna o valor de timeout defido
     * @return integer
     */
    public function getSoapTimeOut()
    {
        return $this->soapTimeout;
    }
    
    /**
     * setAmbiente
     * Seta a varável de ambiente
     * @param string $tpAmb
     */
    protected function setAmbiente($tpAmb = '2')
    {
        $this->tpAmb = $tpAmb;
        $this->ambiente = 'homologacao';
        if ($tpAmb == '1') {
            $this->ambiente = 'producao';
        }
    }
    
    /**
     * atualizaCertificado
     * Permite a atualização de um novo certificado já colocado na pasta dos
     * certificados definida no config.json
     * @param string $certpfx certificado pfx em string ou o nome do arquivo do certificado
     * @param string $senha senha para abrir o certificado
     * @return boolean
     */
    public function atualizaCertificado($certpfx = '', $senha = '')
    {
        if ($certpfx == '' && $senha != '') {
            return false;
        }
        if (is_file($certpfx)) {
            $this->oCertificate->loadPfxFile($certpfx, $senha);
            return true;
        }
        $this->oCertificate->loadPfx($certpfx, $senha);
        $this->loadSoapClass();
        return true;
    }
    
    /**
     * Grava as mensagens em disco
     * @param string $data conteudo a ser gravado
     * @param string $filename
     * @param int $tpAmb
     * @param string $folder
     * @param string $subFolder
     * @throws RuntimeException
     */
    protected function gravaFile(
        $data,
        $filename,
        $tpAmb = '2',
        $folder = '',
        $subFolder = ''
    ) {
        $anomes = date('Ym');
        $pathTemp = $folder
            . Files\FilesFolders::getAmbiente($tpAmb)
            . DIRECTORY_SEPARATOR
            . $subFolder
            . DIRECTORY_SEPARATOR
            . $anomes;
        if (! Files\FilesFolders::saveFile($pathTemp, $filename, $data)) {
            $msg = 'Falha na gravação no diretório. '.$pathTemp;
            throw new RuntimeException($msg);
        }
    }
    
    /**
     * Carrega a classe SOAP e os certificados
     * @return void
     */
    protected function loadSoapClass()
    {
        $this->oSoap = null;
        $this->oSoap = new CurlSoap(
            $this->oCertificate->priKeyFile,
            $this->oCertificate->pubKeyFile,
            $this->oCertificate->certKeyFile,
            $this->soapTimeout,
            $this->sslProtocol
        );
    }
    
    /**
     * Retorna uma seguencia não sujeita a repetição indicando
     * o ano, mes, dia, hora, minuto e segundo
     * Este retorno é usado para nomear os arquivos de log das
     * comunicações SOAP enviadas e retornadas
     * @return string sequencia AAAMMDDHHMMSS
     */
    protected function generateMark()
    {
        return date('YmdHis');
    }
    
    /**
     * Envia a mensagem para o webservice
     * @param string $urlService
     * @param strting $body
     * @param string $method
     * @return string
     */
    public function zSend($urlService, $body, $method)
    {
        try {
            $retorno = $this->oSoap->send($urlService, '', '', $body, $this->xmlns.$method);
        } catch (\NFePHP\Common\Exception\RuntimeException $e) {
            $msg = $this->oSoap->infoCurl['http_code'] . ' - ' . $this->oSoap->errorCurl;
            throw new \RuntimeException($msg);
        }
        $aRet = [
            'retorno'=>$retorno,
            'lastMsg' => $this->oSoap->lastMsg,
            'soapDebug' => $this->oSoap->soapDebug
        ];
        return $aRet;
    }
}
