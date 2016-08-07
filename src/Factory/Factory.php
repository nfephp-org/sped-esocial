<?php

namespace NFePHP\eSocial\Factory;

/**
 * Classe abstrata construtora dos eventos
 *
 * @category  NFePHP
 * @package   NFePHP\eSocial\Factory\Factory
 * @copyright Copyright (c) 2016
 * @license   https://www.gnu.org/licenses/lgpl-3.0.txt LGPLv3
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt GPLv3
 * @license   https://opensource.org/licenses/mit-license.php MIT
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-esocial for the canonical source repository
 */

use NFePHP\Common\Base\BaseMake;
use NFePHP\Common\Certificate\Pkcs12;
use NFePHP\Common\Files\FilesFolders;
use NFePHP\Common\Dom\ValidXsd;
use InvalidArgumentException;

abstract class Factory extends BaseMake
{
    /**
     * errors
     * Matriz com os erros ocorridos
     * @var array
     */    
    public $errors = array();
    /**
     * Objeto stdClass convertido do Json config
     *
     * @var stdClass
     */
    protected $objConfig;
    /**
     * estabelece qual a tag será assinada
     * deve estar preenchido nas classes derivadas
     *
     * @var string
     */
    protected $signTag = '';
    /**
     * Objeto Dom::class Tag ideDeclarante
     *
     * @var Dom
     */
    protected $ide;
    /**
     * Objeto Dom::class Tag evt???
     *
     * @var Dom
     */
    protected $evt;
    /**
     * Instancia da classe que lida com os certificados
     * será usada na assinatura do xml dos eventos
     *
     * @var Pkcs12
     */
    protected $pkcs;
    
    /**
     * Recebe o arquivo de configuração em uma string json ou 
     * um path de arquivo
     * @param string $config
     * @param bool   $ignore
     */
    public function __construct($config = '', $ignore = false)
    {
        parent::__construct();
        $this->loadConfig($config, $ignore);
    }
    
    /**
     * Executa a leitura do arquivo de configuração e
     * carrega o certificado
     * @param string $config
     * @param bool   $ignore
     */
    protected function loadConfig($config = '', $ignore = false)
    {
        if (is_file($config)) {
            $config = FilesFolders::readFile($config);
        }
        $result = json_decode($config);
        if (json_last_error() === JSON_ERROR_NONE) {
            $this->objConfig = $result;
        }
        if (! is_object($this->objConfig)) {
            throw new InvalidArgumentException("Uma configuração valida deve ser passada!");
        }
        
        $this->pkcs = new Pkcs12(
            $this->objConfig->pathCertsFiles,
            $this->objConfig->cnpj,
            '',
            '',
            '',
            $ignore
        );
        $this->pkcs->loadPfxFile(
            $this->objConfig->pathCertsFiles.$this->objConfig->certPfxName,
            $this->objConfig->certPassword,
            true,
            $ignore,
            false
        );
    }
    
    /**
     * Cria a tag evt????
     * @param  string $id
     * @param  string $indRetificacao
     * @param  int    $tpAmb
     * @param  string $nrRecibo
     * @return Dom
     */
    public function tagEvento($id, $indRetificacao, $tpAmb, $nrRecibo = '')
    {
        $id = "ID".str_pad($id, 18, '0', STR_PAD_LEFT);
        $identificador = 'tag raiz ';
        $this->evt = $this->dom->createElement($this->signTag);
        //importante a identificação "Id" deve estar grafada assim
        $this->evt->setAttribute("id", $id);
        $ide = $this->dom->createElement("ideEvento");
        $this->dom->addChild(
            $ide,
            "indRetif",
            $indRetificacao,
            false,
            $identificador . "Indicador de retificação"
        );
        if ($indRetificacao > 1) {
            $this->dom->addChild(
                $ide,
                "nrRecibo",
                $nrRecibo,
                true,
                $identificador . "Numero do recibo quando for retificador"
            );
        }
        $this->dom->addChild(
            $ide,
            "tpAmb",
            $tpAmb,
            true,
            $identificador . "tipo de ambiente"
        );
        $this->dom->addChild(
            $ide,
            "procEmi",
            $this->objConfig->procEmi,
            true,
            $identificador . "Processo de emissão do evento"
        );
        $this->dom->addChild(
            $ide,
            "verProc",
            $this->objConfig->verAplic,
            true,
            $identificador . "Versão do aplicativo de emissão do evento"
        );
        $this->dom->appChild($this->evt, $ide);
        return $this->evt;
    }
    
    /**
     * Cria a tag ideEmpregador
     * @param  string $cnpj
     * @return Dom
     */
    public function tagDeclarante($tpInsc, $nrInsc)
    {
        $identificador = 'tag ideEmpregador ';
        $ide = $this->dom->createElement("ideEmpregador");
        $this->dom->addChild(
            $ide,
            "tpInsc",
            $tpInsc,
            true,
            $identificador . "tipo de inscrição, conforme tabela 5, informar CNPJ ou CPF"
        );
        $this->dom->addChild(
            $ide,
            "nrInsc",
            $nrInsc,
            true,
            $identificador . "número de inscrição do contribuinte, informar o CNPJ ou o CPF"
        );
        $this->ide = $ide;
        return $ide;
    }
    
    /**
     * Executa a assinatura digital do xml
     * Essa assinatura depende da classe Pkcs12.php que está no repositório
     * nfephp-org/sped-common/Certificates
     */
    public function assina()
    {
        $this->xml = $this->pkcs->signXML($this->xml, $this->signTag, 'id', $this->objConfig->signAlgorithm);
    }
    /**
     * Construtor do XML
     * Executa a montagem geral do xml de evento
     */
    public function monta()
    {
        $this->eFinanceira = $this->dom->createElement("eFinanceira");
        $this->eFinanceira->setAttribute(
            "xmlns",
            "http://www.eSocial.gov.br/schemas/"
                . $this->signTag
                . "/"
            . $this->objConfig->schemes
        );
        $this->dom->appChild($this->evt, $this->ide, "Falta ide");
        if (!empty($this->info)) {
            $this->dom->appChild($this->evt, $this->info, "Falta ide");
        }
        $this->premonta();
        
        $this->dom->appChild($this->eFinanceira, $this->evt, 'Falta DOMDocument');
        $this->dom->appChild($this->dom, $this->eFinanceira, 'Falta DOMDocument');
        $this->xml = $this->dom->saveXML();
    }
    
    /**
     * Valida o xml contra o xsd
     *
     * @param  string $xml
     * @return boolean
     */
    public function valida($xml = '')
    {
        if (empty($xml)) {
            $xml = $this->xml;
        }
        $xsdfile = dirname(dirname(dirname(__FILE__)))
            . DIRECTORY_SEPARATOR
            . 'schemes'
            . DIRECTORY_SEPARATOR
            . $this->objConfig->schemes
            . DIRECTORY_SEPARATOR
            . $this->signTag
            . '-'
            . $this->objConfig->schemes
            . '.xsd';
        if (! ValidXsd::validar($xml, $xsdfile)) {
            $this->errors = ValidXsd::$errors;
            return false;
        }
        return true;
    }
    
    /**
     * preConstrutor do XML
     * Essa função faz uma pre-montagem de estruturas particulares 
     * a cada evento
     */
    abstract protected function premonta();
}