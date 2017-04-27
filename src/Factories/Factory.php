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

class Factory
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
     * @var type
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
    public function __construct($config, stdClass $std, Certificate $certificate)
    {
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
        //set properties from inputs
        if (!empty($std)) {
            $std = $this->standardizeParams($this->parameters, $std);
            $this->std = $std;
            $this->loadProperties();
        }
        $this->scheme = realpath(
            __DIR__
            . "/../../schemes/$this->layoutStr/"
            . $this->evtName
            . ".xsd"
        );
        $this->init();
    }
    
    /**
     * Return xml of event
     * @return string
     */
    public function toString()
    {
        if (empty($this->node)) {
            $this->toNode();
        }
        return $this->node;
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
        if (empty($this->node)) {
            $this->toNode();
        }
        $xml = simplexml_load_string($this->node);
        return json_encode($xml, JSON_PRETTY_PRINT);
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
        $c = 0;
        $str = 'v';
        foreach ($fils as $fil) {
            $str .= str_pad($fil, 2, '0', STR_PAD_LEFT). '_';
        }
        return substr($str, 0, -1);
    }
    
    /**
     * Sign and validate XML with XSD, can throw Exception
     * @param DOMElement $node
     */
    protected function sign(DOMElement $node)
    {
        $xml = $this->dom->saveXML($node);
        $xml = Strings::clearXmlString($xml);
        $this->node = Signer::sign(
            $this->certificate,
            $xml,
            $this->evtName,
            'Id',
            OPENSSL_ALGO_SHA1,
            [false,false,null,null]
        );
        $xsd = $this->scheme;
        Validator::isValid($this->node, $xsd);
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
        }
    }
    
    /**
     * Load all properties from $this->std, from __construct method
     */
    protected function loadProperties()
    {
        $properties = array_keys(get_object_vars($this));
        foreach ($properties as $key) {
            $q = strtolower($key);
            if (isset($this->std->$q)) {
                $this->$key = $this->std->$q;
            }
        }
    }
    
    /**
     * Standardize parameters
     * @param array $parameters
     * @param stdClass $dados
     * @return stdClass
     */
    protected static function standardizeParams($parameters, stdClass $dados)
    {
        $properties = get_object_vars($dados);
        foreach ($properties as $key => $value) {
            $keyList[strtoupper($key)] = gettype($value);
        }
        foreach ($parameters as $key => $data) {
            if (!key_exists(strtoupper($key), $keyList)) {
                //nesse caso a classe não contêm a propriedade então
                //ela deve ser criada pois todos os parametros devem
                //ser definidos
                $dados->{$key} = $value;
            } elseif ($keyList[strtoupper($key)] !== 'object' && strpos($type, ':') > 0) {
                //nesse caso a propriedade existe mas não é a classe exigida
                $dados->{$key} = $value;
            }
        }
        return self::propertiesToLower($dados);
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
            $nk = strtolower($key);
             $clone->{$nk} = $value;
        }
        return $clone;
    }
}
