<?php

namespace NFePHP\eSocial\Common;

use NFePHP\eSocial\Common\ParamsStandardize;
use NFePHP\Common\DOMImproved as Dom;
use NFePHP\Common\Certificate;
use NFePHP\Common\Signer;
use NFePHP\Common\Strings;
use NFePHP\Common\Validator;
use JsonSchema\Validator as JsonValid;
use JsonSchema\SchemaStorage;
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
    public $nmRazao;
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
    public $layout = '2.2.2';
    /**
     * @var string
     */
    public $layoutStr = '';
    /**
     * @var string
     */
    public $schema = '';
    /**
     * @var string
     */
    public $jsonschema = '';
    /**
     * @var string
     */
    public $evtid = '';

    /**
     * Constructor
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate
     * @param string $date
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate = null,
        $date = ''
    ) {
        //set properties from config
        $stdConf = json_decode($config);
        $this->date = new DateTime();
        if (!empty($date)) {
            $this->date = new DateTime($date);
        }
        $this->tpAmb = $stdConf->tpAmb;
        $this->verProc = $stdConf->verProc;
        $this->layout = $stdConf->eventoVersion;
        $this->tpInsc = $stdConf->empregador->tpInsc;
        $this->nrInsc = $stdConf->empregador->nrInsc;
        $this->nmRazao = $stdConf->empregador->nmRazao;
        $this->layoutStr = $this->strLayoutVer($this->layout);
        $this->certificate = $certificate;
        if (empty($std) || !is_object($std)) {
            throw new \InvalidArgumentException(
                'Você deve passar os parâmetros num stdClass.'
            );
        }
        $this->jsonschema = realpath(
            __DIR__
            . "/../../jsonSchemes/$this->layoutStr/"
            . $this->evtName
            . ".schema"
        );
        $this->schema = realpath(
            __DIR__
            . "/../../schemes/$this->layoutStr/"
            . $this->evtName
            . ".xsd"
        );
        //convert all data fields to lower case
        $this->std = $this->propertiesToLower($std);
        //validate input data with schema
        $this->validInputData($this->std);
        //Adding forgotten or unnecessary fields.
        //This is done for standardization purposes.
        //Fields with no value will not be included by the builder.
        $this->std = $this->standardizeProperties($this->std);
        $this->init();
    }
    
    abstract protected function toNode();
    
    public function alias()
    {
        return $this->evtAlias;
    }
    
    public function getCertificate()
    {
        return $this->certificate;
    }
    
    public function setCertificate(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }
    
    /**
     * Validation json data from json Schema
     * @param stdClass $data
     * @return boolean
     * @throws \RuntimeException
     */
    protected function validInputData($data)
    {
        if (!is_file($this->jsonschema)) {
            return true;
        }
        $validator = new JsonValid();
        $validator->check($data, (object)['$ref' => 'file://' . $this->jsonschema]);
        if (!$validator->isValid()) {
            $msg = "JSON does not validate. Violations:\n";
            foreach ($validator->getErrors() as $error) {
                $msg .= sprintf("[%s] %s\n", $error['property'], $error['message']);
            }
            throw new \RuntimeException($msg);
        }
        return true;
    }
    
    /**
     * Return xml of event
     * @return string
     */
    public function toXML()
    {
        if (empty($this->xml)) {
            $this->toNode();
        }
        return $this->clearXml($this->xml);
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
        //a assinatura só faz sentido no XML, os demais formatos
        //não devem conter dados da assinatura
        $xml = Signer::removeSignature($this->xml);
        $dom = new \DOMDocument();
        $dom->loadXML($xml);
        $sxml = simplexml_load_string($dom->saveXML());
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
     * Remove XML declaration from XML string
     * @param string $xml
     * @return string
     */
    protected function clearXml($xml)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $this->formatOutput = false;
        $this->preserveWhiteSpace = false;
        $dom->loadXML($xml);
        return $dom->saveXML($dom->documentElement);
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
                'eSocial',
                '',
                OPENSSL_ALGO_SHA256,
                [true,false,null,null]
            );
            //validation by XSD schema throw Exception if dont pass
            Validator::isValid($xml, $this->schema);
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
            $this->evtid = FactoryId::build(
                $this->tpInsc,
                $this->nrInsc,
                $this->date,
                $this->std->sequencial
            );
            $this->node = $this->dom->createElement($this->evtName);
            $att = $this->dom->createAttribute('Id');
            $att->value = $this->evtid;
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
     * @param stdClass $data
     * @return stdClass
     */
    protected static function propertiesToLower(stdClass $data)
    {
        $properties = get_object_vars($data);
        $clone = new stdClass();
        foreach ($properties as $key => $value) {
            if ($value instanceof stdClass) {
                $value = self::propertiesToLower($value);
            }
            $nk = strtolower($key);
            $clone->{$nk} = $value;
        }
        return $clone;
    }
    
    /**
     * Adjust missing properties form original data according schema
     * @param stdClass $data
     */
    public function standardizeProperties(stdClass $data)
    {
        if (!is_file($this->jsonschema)) {
            return $data;
        }
        $jsonSchemaObj = json_decode(file_get_contents($this->jsonschema));
        $sc = new ParamsStandardize($jsonSchemaObj);
        return $sc->stdData($data);
    }
}
