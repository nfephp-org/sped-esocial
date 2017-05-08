<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\Common\DOMImproved as Dom;
use NFePHP\Common\Certificate;
use NFePHP\Common\Signer;
use NFePHP\Common\Strings;
use NFePHP\Common\Validator;
use stdClass;
use DOMDocument;
use DOMElement;
use DateTime;

abstract class Factory
{
    /**
     * @var string
     */
    protected $xmlns = "http://www.esocial.gov.br/schema/evt/";
    /**
     * @var string
     */
    protected $xsi = "http://www.w3.org/2001/XMLSchema-instance";
    /**
     * @var Dom
     */
    protected $dom;
    /**
     * @var stdClass
     */
    protected $std;
    /**
     * @var string
     */
    protected $xml;
    /**
     * @var DOMNode
     */
    protected $eSocial;
    /**
     * @var DOMElement
     */
    protected $node;
    /**
     * @var array
     */
    protected $parameters = [];
    /**
     * @var string
     */
    protected $evtName = '';
    /**
     * @var string
     */
    protected $evtAlias = '';
    /**
     * @var Certificate
     */
    protected $certificate;
    
    /**
     * @var int
     */
    public $tpInsc;
    /**
     * @var string
     */
    public $nrInsc;
    /**
     * @var string
     */
    public $company;
    /**
     * @var DateTime
     */
    public $date;
    /**
     * @var int
     */
    public $tpAmb = 3;
    /**
     * @var int
     */
    public $procEmi = 1;
    /**
     * @var string
     */
    public $verProc = '';
    /**
     * @var string
     */
    public $layout = '2.2.1';
    /**
     * @var string
     */
    public $layoutStr = '';
    /**
     * @var string
     */
    public $scheme = '';

    /**
     * Constructor
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate = null
    ) {
        //set properties from config
        $stdConf = json_decode($config);
        $this->date = new DateTime();
        $this->tpInsc = $stdConf->tpInsc;
        $this->nrInsc = $stdConf->nrInsc;
        $this->company = $stdConf->company;
        $this->tpAmb = $stdConf->tpAmb;
        $this->verProc = $stdConf->verProc;
        $this->layout = $stdConf->layout;
        $this->layoutStr = $this->strLayoutVer($stdConf->layout);
        $this->certificate = $certificate;
        if (empty($std)) {
            throw new \InvalidArgumentException(
                'Você deve passar os parametros num stdClass'
            );
        }
        $this->std = $this->propertiesToLower($std);
        $this->scheme = realpath(
            __DIR__
            . "/../../schemes/$this->layoutStr/"
            . $this->evtName
            . ".xsd"
        );
        $this->init();
    }
    
    abstract protected function toNode();

    /**
     * Return xml of event
     * @return string
     */
    public function toXML()
    {
        if (empty($this->xml)) {
            $this->toNode();
        }
        return $this->xml;
    }
    
    /**
     * Convert xml of event to array
     * @return array
     */
    public function toArray()
    {
        return json_decode($this->toJson(), true);
    }
    
    /**
     * Convert xml to json string
     * @return string
     */
    public function toJson()
    {
        if (empty($this->xml)) {
            $this->toNode();
        }
        $dom = new \DOMDocument();
        $dom->loadXML($this->xml);
        //a assinatura só faz sentido no XML, os demais formatos
        //não devem conter dados da assinatura
        $node = Signer::removeSignature($dom);
        $sxml = simplexml_load_string($node->saveXML());
       
        return str_replace(
            '@attributes',
            'attributes',
            json_encode($sxml, JSON_PRETTY_PRINT)
        );
    }
    
    /**
     * Convert xml to stdClass
     * @return stdClass
     */
    public function toStd()
    {
        return json_decode($this->toJson());
    }

    /**
     * Stringfy layout number
     * @param type $layout
     * @return string
     */
    protected function strLayoutVer($layout)
    {
        $fils = explode('.', $layout);
        $str = 'v';
        foreach ($fils as $fil) {
            $str .= str_pad($fil, 2, '0', STR_PAD_LEFT). '_';
        }
        return substr($str, 0, -1);
    }
    
    /**
     * Sign and validate XML with XSD, can throw Exception
     */
    protected function sign()
    {
        $xml = $this->dom->saveXML($this->eSocial);
        $xml = Strings::clearXmlString($xml);
        if (!empty($this->certificate)) {
            $xml = Signer::sign(
                $this->certificate,
                $xml,
                $this->evtName,
                'Id',
                OPENSSL_ALGO_SHA1,
                [false,false,null,null]
            );
            $xsd = $this->scheme;
            Validator::isValid($xml, $xsd);
        }
        $this->xml = $xml;
    }

    /**
     * Initialize DOM
     */
    protected function init()
    {
        if (empty($this->dom)) {
            $this->dom = new Dom('1.0', 'UTF-8');
            $this->dom->preserveWhiteSpace = false;
            $this->dom->formatOutput = false;
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"
                . "<eSocial xmlns=\"$this->xmlns"
                . $this->evtName
                . "/$this->layoutStr\" "
                . "xmlns:xsi=\"$this->xsi\">"
                . "</eSocial>";
            $this->dom->loadXML($xml);
            $this->eSocial = $this->dom->getElementsByTagName('eSocial')->item(0);
            $evtid = FactoryId::build(
                $this->tpInsc,
                $this->nrInsc,
                $this->date,
                $this->std->sequencial
            );
            $this->node = $this->dom->createElement($this->evtName);
            $att = $this->dom->createAttribute('Id');
            $att->value = $evtid;
            $this->node->appendChild($att);
            
            $ideEmpregador = $this->dom->createElement("ideEmpregador");
            $this->dom->addChild(
                $ideEmpregador,
                "tpInsc",
                $this->tpInsc,
                true
            );
            $this->dom->addChild(
                $ideEmpregador,
                "nrInsc",
                $this->nrInsc,
                true
            );
            $this->node->appendChild($ideEmpregador);
        }
    }
    
    
    /**
     * Change properties names of stdClass to lower case
     * @param stdClass $dados
     * @return stdClass
     */
    protected static function propertiesToLower(stdClass $dados)
    {
        $properties = get_object_vars($dados);
        $clone = new stdClass();
        foreach ($properties as $key => $value) {
            if ($value instanceOf stdClass) {
                $value = propertiesToLower($value);
            }
            $nk = strtolower($key);
            $clone->{$nk} = $value;
        }
        return $clone;
    }
}
