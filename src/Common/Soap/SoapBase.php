<?php

namespace NFePHP\eSocial\Common\Soap;

/**
 * Soap base class
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2017
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfse for the canonical source repository
 */

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use NFePHP\Common\Certificate;
use NFePHP\Common\Exception\RuntimeException;
use NFePHP\Common\Strings;
use Psr\Log\LoggerInterface;

abstract class SoapBase implements SoapInterface
{
    /**
     * @var string
     */
    public $responseHead;
    /**
     * @var string
     */
    public $responseBody;
    /**
     * @var string
     */
    public $requestHead;
    /**
     * @var string
     */
    public $requestBody;
    /**
     * @var string
     */
    public $soaperror;
    /**
     * @var int
     */
    public $soaperror_code;
    /**
     * @var array
     */
    public $soapinfo = [];
    /**
     * @var int
     */
    public $waitingTime = 45;
    /**
     * @var int
     */
    protected $soapprotocol = self::SSL_DEFAULT;
    /**
     * @var int
     */
    protected $soaptimeout = 20;
    /**
     * @var string
     */
    protected $proxyIP;
    /**
     * @var string
     */
    protected $proxyPort;
    /**
     * @var string
     */
    protected $proxyUser;
    /**
     * @var string
     */
    protected $proxyPass;
    /**
     * @var array
     */
    protected $prefixes = [1 => 'soapenv', 2 => 'soap'];
    /**
     * @var Certificate
     */
    protected $certificate;
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var string
     */
    protected $tempdir;
    /**
     * @var string
     */
    protected $certsdir;
    /**
     * @var string
     */
    protected $debugdir;
    /**
     * @var string
     */
    protected $prifile;
    /**
     * @var string
     */
    protected $pubfile;
    /**
     * @var string
     */
    protected $certfile;
    /**
     * @var string
     */
    protected $casefaz;
    /**
     * @var bool
     */
    protected $disablesec = false;
    /**
     * @var bool
     */
    protected $disableCertValidation = false;
    /**
     * @var \League\Flysystem\Adapter\Local
     */
    protected $adapter;
    /**
     * @var \League\Flysystem\Filesystem
     */
    protected $filesystem;
    /**
     * @var string
     */
    protected $temppass = '';
    /**
     * @var bool
     */
    protected $encriptPrivateKey = true;
    /**
     * @var bool
     */
    protected $debugmode = false;
    /**
     * Constructor
     *
     * @param Certificate $certificate
     * @param LoggerInterface $logger
     */
    public function __construct(
        Certificate $certificate = null,
        LoggerInterface $logger = null
    ) {
        $this->logger      = $logger;
        $this->certificate = $this->checkCertValidity($certificate);
        $this->setTemporaryFolder(sys_get_temp_dir().'/sped/');
    }
    /**
     * Check if certificate is valid
     *
     * @param  Certificate $certificate
     *
     * @return Certificate
     * @throws RuntimeException
     */
    private function checkCertValidity(Certificate $certificate = null)
    {
        if ($this->disableCertValidation) {
            return $certificate;
        }
        if (! empty($certificate)) {
            if ($certificate->isExpired()) {
                throw new RuntimeException(
                    'The validity of the certificate has expired.'
                );
            }
        }
        return $certificate;
    }
    /**
     * Set another temporayfolder for saving certificates for SOAP utilization
     *
     * @param string $folderRealPath
     */
    public function setTemporaryFolder($folderRealPath)
    {
        $this->tempdir = $folderRealPath;
        $this->setLocalFolder($folderRealPath);
    }
    /**
     * Set Local folder for flysystem
     *
     * @param string $folder
     */
    protected function setLocalFolder($folder = '')
    {
        $this->adapter    = new Local($folder);
        $this->filesystem = new Filesystem($this->adapter);
    }
    /**
     * Destructor
     * Clean temporary files
     */
    public function __destruct()
    {
        $this->removeTemporarilyFiles();
    }
    /**
     * Delete all files in folder
     */
    public function removeTemporarilyFiles()
    {
        $contents = $this->filesystem->listContents($this->certsdir, true);
        //define um limite de $waitingTime min, ou seja qualquer arquivo criado a mais
        //de $waitingTime min será removido
        //NOTA: quando ocorre algum erro interno na execução do script, alguns
        //arquivos temporários podem permanecer
        //NOTA: O tempo default é de 45 minutos e pode ser alterado diretamente nas
        //propriedades da classe, esse tempo entre 5 a 45 min é recomendável pois
        //podem haver processos concorrentes para um mesmo usuário. Esses processos
        //como o DFe podem ser mais longos, dependendo a forma que o aplicativo
        //utilize a API. Outra solução para remover arquivos "perdidos" pode ser
        //encontrada oportunamente.
        $dt = new \DateTime();
        $tint = new \DateInterval("PT".$this->waitingTime."M");
        $tint->invert = true;
        $tsLimit = $dt->add($tint)->getTimestamp();
        foreach ($contents as $item) {
            if ($item['type'] == 'file') {
                if ($item['path'] == $this->prifile
                    || $item['path'] == $this->pubfile
                    || $item['path'] == $this->certfile
                ) {
                    $this->filesystem->delete($item['path']);
                    continue;
                }
                $timestamp = $this->filesystem->getTimestamp($item['path']);
                if ($timestamp < $tsLimit) {
                    //remove arquivos criados a mais de 45 min
                    $this->filesystem->delete($item['path']);
                }
            }
        }
    }
    /**
     * Disables the security checking of host and peer certificates
     *
     * @param bool $flag
     */
    public function disableSecurity($flag = false)
    {
        $this->disablesec = $flag;
        return $this->disablesec;
    }
    /**
     * ONlY for tests
     *
     * @param  bool $flag
     *
     * @return bool
     */
    public function disableCertValidation($flag = true)
    {
        $this->disableCertValidation = $flag;
        return $this->disableCertValidation;
    }
    /**
     * Load path to CA and enable to use on SOAP
     *
     * @param string $capath
     */
    public function loadCA($capath)
    {
        if (is_file($capath)) {
            $this->casefaz = $capath;
        }
    }
    /**
     * Set option to encript private key before save in filesystem
     * for an additional layer of protection
     *
     * @param  bool $encript
     *
     * @return bool
     */
    public function setEncriptPrivateKey($encript = true)
    {
        return $this->encriptPrivateKey = $encript;
    }
    /**
     * Set debug mode, this mode will save soap envelopes in temporary directory
     *
     * @param  bool $value
     *
     * @return bool
     */
    public function setDebugMode($value = false)
    {
        return $this->debugmode = $value;
    }
    /**
     * Set certificate class for SSL comunications
     *
     * @param Certificate $certificate
     */
    public function loadCertificate(Certificate $certificate)
    {
        $this->certificate = $this->checkCertValidity($certificate);
    }
    /**
     * Set logger class
     *
     * @param LoggerInterface $logger
     */
    public function loadLogger(LoggerInterface $logger)
    {
        return $this->logger = $logger;
    }
    /**
     * Set timeout for communication
     *
     * @param int $timesecs
     */
    public function timeout($timesecs)
    {
        return $this->soaptimeout = $timesecs;
    }
    /**
     * Set security protocol
     *
     * @param  int $protocol
     *
     * @return type Description
     */
    public function protocol($protocol = self::SSL_DEFAULT)
    {
        return $this->soapprotocol = $protocol;
    }
    /**
     * Set prefixes
     *
     * @param  string $prefixes
     *
     * @return string
     */
    public function setSoapPrefix($prefixes)
    {
        return $this->prefixes = $prefixes;
    }
    /**
     * Set proxy parameters
     *
     * @param string $ip
     * @param int $port
     * @param string $user
     * @param string $password
     */
    public function proxy($ip, $port, $user, $password)
    {
        $this->proxyIP   = $ip;
        $this->proxyPort = $port;
        $this->proxyUser = $user;
        $this->proxyPass = $password;
    }
    /**
     * Send message to webservice
     */
    abstract public function send(
        $operation,
        $url,
        $action,
        $envelope,
        $parameters
    );
    /**
     * Temporarily saves the certificate keys for use cURL or SoapClient
     */
    public function saveTemporarilyKeyFiles()
    {
        if (! is_object($this->certificate)) {
            throw new RuntimeException(
                'Certificate not found.'
            );
        }
        $this->certsdir = $this->certificate->getCnpj().'/certs/';
        $this->prifile = $this->certsdir.Strings::randomString(10).'.pem';
        $this->pubfile = $this->certsdir.Strings::randomString(10).'.pem';
        $this->certfile = $this->certsdir.Strings::randomString(10).'.pem';
        $ret = true;
        $private = $this->certificate->privateKey;
        if ($this->encriptPrivateKey) {
            //cria uma senha temporária ALEATÓRIA para salvar a chave primaria
            //portanto mesmo que localizada e identificada não estará acessível
            //pois sua senha não existe além do tempo de execução desta classe
            $this->temppass = Strings::randomString(16);
            //encripta a chave privada entes da gravação do filesystem
            openssl_pkey_export(
                $this->certificate->privateKey,
                $private,
                $this->temppass
            );
        }
        $ret &= $this->filesystem->put(
            $this->prifile,
            $private
        );
        $ret &= $this->filesystem->put(
            $this->pubfile,
            $this->certificate->publicKey
        );
        $ret &= $this->filesystem->put(
            $this->certfile,
            $private."{$this->certificate}"
        );
        if (! $ret) {
            throw new RuntimeException(
                'Unable to save temporary key files in folder.'
            );
        }
    }
    /**
     * Save request envelope and response for debug reasons
     *
     * @param  string $operation
     * @param  string $request
     * @param  string $response
     *
     * @return void
     */
    public function saveDebugFiles($operation, $request, $response)
    {
        if (! $this->debugmode) {
            return;
        }
        $this->debugdir = $this->certificate->getCnpj().'/debug/';
        $now = \DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
        $time = substr($now->format("ymdHisu"), 0, 16);
        try {
            $this->filesystem->put(
                $this->debugdir.$time."_".$operation."_sol.txt",
                $request
            );
            $this->filesystem->put(
                $this->debugdir.$time."_".$operation."_res.txt",
                $response
            );
        } catch (Exception $e) {
            throw new RuntimeException(
                'Unable to create debug files.'
            );
        }
    }
    /**
     * Mount soap envelope
     *
     * @param  string $request
     * @param  array $namespaces
     * @param  \SOAPHeader $header
     *
     * @return string
     */
    protected function makeEnvelopeSoap(
        $request,
        $namespaces,
        $soapver = SOAP_1_2,
        $header = null
    ) {
        $prefix   = $this->prefixes[$soapver];
        $envelope = "<$prefix:Envelope";
        foreach ($namespaces as $key => $value) {
            $envelope .= " $key=\"$value\"";
        }
        $envelope   .= ">";
        $soapheader = "<$prefix:Header/>";
        if (! empty($header)) {
            $ns = ! empty($header->namespace) ? $header->namespace : '';
            $name = $header->name;
            $soapheader = "<$prefix:Header>";
            $soapheader .= "<$name xmlns=\"$ns\">";
            foreach ($header->data as $key => $value) {
                $soapheader .= "<$key>$value</$key>";
            }
            $soapheader .= "</$name></$prefix:Header>";
        }
        $envelope .= $soapheader;
        $envelope .= "<$prefix:Body>$request</$prefix:Body>"
            ."</$prefix:Envelope>";
        return $envelope;
    }
}
