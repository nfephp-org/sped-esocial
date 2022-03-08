<?php

namespace NFePHP\eSocial\Common;

use DateTime;
use DOMDocument;
use DOMElement;
use JsonSchema\Validator as JsonValid;
use NFePHP\Common\Certificate;
use NFePHP\Common\DOMImproved as Dom;
use NFePHP\Common\Signer;
use NFePHP\Common\Strings;
use NFePHP\Common\Validator;
use stdClass;

abstract class Factory
{
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
    public $tpAmb;
    /**
     * @var int
     */
    public $procEmi = 1; //1- Aplicativo do empregador
    /**
     * @var string
     */
    public $verProc;
    /**
     * @var string
     */
    public $layout;
    /**
     * @var string
     */
    public $layoutStr;
    /**
     * @var string
     */
    public $schema;
    /**
     * @var string
     */
    public $jsonschema;
    /**
     * @var string
     */
    public $definitions;
    /**
     * @var string
     */
    public $evtid;
    /**
     * @var string
     */
    protected $xmlns = "http://www.esocial.gov.br/schema/evt/";
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
     * @var DOMElement
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
    protected $evtName;
    /**
     * @var string
     */
    protected $evtAlias;
    /**
     * @var Certificate | null
     */
    protected $certificate;
     /**
     * @var string
     */
    protected $method_name;
    
    /**
     * Constructor
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate | null
     * @param string|null $date
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate = null,
        $date = null
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
        $this->nmRazao = $stdConf->empregador->nmRazao ?? null;
        $this->layoutStr = $this->strLayoutVer($this->layout);
        $this->certificate = $certificate;
        if (empty($std) || ! is_object($std)) {
            throw new \InvalidArgumentException(
                'Você deve passar os parâmetros num stdClass.'
            );
        }
        if ($this->layout == 'S.1.0.0' && $this->evtAlias == 'S-2400') {
            $this->evtName = 'evtCdBenefIn';
        }
        //constroi o nome do método construtor baseado na versão
        $this->method_name = 'toNode'
            . str_replace('.', '', $this->layout);
        $this->jsonschema = realpath(
            __DIR__
            ."/../../jsonSchemes/$this->layoutStr/"
            .$this->evtName
            .".schema"
        );
        $this->schema = realpath(
            __DIR__
            ."/../../schemes/$this->layoutStr/"
            .$this->evtName
            .".xsd"
        );
        $this->definitions = realpath(
            __DIR__
            ."/../../jsonSchemes/definitions.schema"
        );
        if (empty($this->schema)) {
            throw new \InvalidArgumentException(
                'Schemas não localizados, verifique de passou as versões '
                    . 'corretamente no config.'
            );
        }
        //convert all data fields to lower case
        $this->std = $this->propertiesToLower($std);
        //validate input data with schema
        $this->validInputData($this->std);
        //Adding forgotten or unnecessary fields.
        //This is done for standardization purposes.
        //Fields with no value will not be included by the builder.
        //$this->std = $this->standardizeProperties($this->std);
        $this->init();
    }

    /**
     * Stringfy layout number
     * @param string $layout
     * @return string
     */
    protected function strLayoutVer($layout)
    {
        //v_S_01_00_00
        //v02_05_00
        if (substr($layout, 0, 1) == 'S') {
            $str  = 'v_S_';
            $fils = explode('.', substr($layout, 2, strlen($layout)-1));
            foreach ($fils as $fil) {
                $str .= str_pad($fil, 2, '0', STR_PAD_LEFT).'_';
            }
        } else {
            $fils = explode('.', $layout);
            $str  = 'v';
            foreach ($fils as $fil) {
                $str .= str_pad($fil, 2, '0', STR_PAD_LEFT).'_';
            }
        }
        return substr($str, 0, -1);
    }

    /**
     * Change properties names of stdClass to lower case
     * @param stdClass $data
     * @return stdClass
     */
    protected static function propertiesToLower(stdClass $data)
    {
        $properties = get_object_vars($data);
        $clone      = new stdClass();
        foreach ($properties as $key => $value) {
            if ($value instanceof stdClass) {
                $value = self::propertiesToLower($value);
            }
            $nk           = strtolower($key);
            $clone->{$nk} = $value;
        }
        return $clone;
    }

    /**
     * Validation json data from json Schema
     * @param stdClass $data
     * @return boolean
     * @throws \RuntimeException
     */
    protected function validInputData($data)
    {
        if (! is_file($this->jsonschema)) {
            return true;
        }
        $errors = JsonValidation::validate($data, $this->jsonschema, $this->definitions);
        if (empty($errors)) {
            return true;
        }
        $msg = '';
        foreach ($errors as $key => $error) {
            $msg .= sprintf("[%s] %s\n", $error['property'], $error['message']). ";";
        }
        $msg = substr($msg, 0, strlen($msg)-2);
        throw new \Exception($msg);
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
                . "/$this->layoutStr\">"
                . "</eSocial>";
            $this->dom->loadXML($xml);
            $this->eSocial = $this->dom->getElementsByTagName('eSocial')->item(0);
            $this->evtid = FactoryId::build(
                $this->tpInsc,
                $this->nrInsc,
                $this->date,
                $this->std->sequencial ?? null
            );
            $this->node = $this->dom->createElement($this->evtName);
            $att = $this->dom->createAttribute('Id');
            $att->value = $this->evtid;
            $this->node->appendChild($att);

            $ideEmpregador = $this->dom->createElement("ideEmpregador");
            $this->dom->addChild(
                $ideEmpregador,
                "tpInsc",
                "$this->tpInsc",
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
     * Returns alias for event
     * @return string
     */
    public function alias()
    {
        return $this->evtAlias;
    }

    /**
     * Returns Certificate::class
     * @return Certificate|null
     */
    public function getCertificate()
    {
        return $this->certificate;
    }
    
    /**
     * Set Certificate::class
     * @param Certificate $certificate
     */
    public function setCertificate(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * Return xml of event
     * @return string
     */
    public function toXML()
    {
        $this->init();
        if (empty($this->xml)) {
            $this->toNode();
        }
        return $this->clearXml($this->xml);
    }

    /**
     * Node constructor
     */
    protected function toNode()
    {
        $method_name = $this->method_name;
        if (!method_exists($this, $method_name)) {
            throw new \Exception("Erro interno método {$method_name} não localizado.");
        }
        return $this->$method_name();
    }

    /**
     * Remove XML declaration from XML string
     * @param string $xml
     * @return string
     */
    protected function clearXml($xml)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = false;
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($xml);
        return $dom->saveXML($dom->documentElement);
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
        return json_encode($this->std);
    }

    /**
     * Returns stdClass
     * @return stdClass
     */
    public function toStd()
    {
        return $this->std;
    }

    /**
     * Adjust missing properties form original data according schema
     * @param \stdClass $data
     * @return \stdClass
     */
    public function standardizeProperties(stdClass $data)
    {
        if (! is_file($this->jsonschema)) {
            return $data;
        }
        $jsonSchemaObj = json_decode(file_get_contents($this->jsonschema));
        $sc = new ParamsStandardize($jsonSchemaObj);
        return $sc->stdData($data);
    }

    /**
     * Sign and validate XML with XSD, can throw Exception
     */
    protected function sign()
    {
        $xml = $this->dom->saveXML($this->eSocial);
        $xml = Strings::clearXmlString($xml);
        if (! empty($this->certificate)) {
            $xml = Signer::sign(
                $this->certificate,
                $xml,
                'eSocial',
                '',
                OPENSSL_ALGO_SHA256,
                [true, false, null, null]
            );
            //validation by XSD schema throw Exception if dont pass
            Validator::isValid($xml, $this->schema);
        }
        $this->xml = $xml;
    }
}
