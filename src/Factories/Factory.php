<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\Common\DOMImproved as Dom;
use stdClass;
use DOMDocument;
use DOMElement;
use DateTime;

class Factory
{
    protected $xmlns = "http://www.esocial.gov.br/schema/evt/";
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
     * @var DOMElement
     */
    protected $node;
    /**
     * @var array
     */
    protected $parameters = [];
    protected $caller;
    
    
    public $tpInsc; //byte "\d"
    public $nrInsc; //string "\d{8,15}"    public $company;
    public $date;
    public $tpAmb; //byte "\d"
    public $procEmi = 1; //byte "\d" 1- App empregador; 2 - App governo
    public $verProc; //string minLength value="1" maxLength value="20"
    public $layout = '2.2.1';
    public $layoutStr = '';
    
    public $scheme="";

    public function __construct($config, stdClass $std, $caller)
    {
        //se properties from config
        $stdConf = json_decode($config);
        $this->date = new DateTime();
        $this->tpInsc = $stdConf->tpInsc;
        $this->nrInsc = $stdConf->nrInsc;
        $this->company = $stdConf->company;
        $this->tpAmb = $stdConf->tpAmb;
        $this->verProc = $stdConf->verProc;
        $this->layout = $stdConf->layout;
        $this->layoutStr = $this->strLayoutVer($stdConf->layout);
        $this->caller = $caller;
        //set properties from inputs
        if (!empty($std)) {
            $std = $this->standardizeParams($this->parameters, $std);
            $this->std = $std;
            $this->loadProperties($caller);
        }
        $this->scheme = realpath(
            __DIR__
            . "/../../schemes/$this->layoutStr/"
            . $caller::EVT_NAME
            . ".xsd"
        );
        $this->init();
    }
    
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
     * Return data from DOMElement in json string
     * @return string
     */
    public function __toString()
    {
        if (empty($this->node)) {
            $this->toNode();
        }
        return $this->dom->saveXML();
    }
    
    public function toArray()
    {
        return json_decode($this->toJson($this->node), true);
    }
    
    /**
     * Convert DOMElement to json string
     * @param DOMElement $node
     * @return string
     */
    public function toJson()
    {
        if (empty($this->node)) {
            $this->toNode();
        }
        $newdoc = new DOMDocument();
        $cloned = $node->cloneNode(true);
        $newdoc->appendChild($newdoc->importNode($cloned, true));
        $xml_string = $newdoc->saveXML();
        $xml = simplexml_load_string($xml_string);
        return json_encode($xml, JSON_PRETTY_PRINT);
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
                . "<eSocial xmlns=\"http://www.esocial.gov.br/schema/evt/"
                . $this->caller::EVT_NAME
                . "/$this->layoutStr\" "
                . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
                . "</eSocial>";
            $this->dom->loadXML($xml);
        }
    }
    
    /**
     * Load all properties from $this->std, from __construct method
     */
    protected function loadProperties($caller)
    {
        $properties = array_keys(get_object_vars($caller));
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
    
    protected static function formatToTag($params, $value = null)
    {
        if ($value === null && $params['required'] == true) {
            $value = self::createEmptyValue($params['type'], $params['format']);
        } elseif ($value === null && $params['required'] == false) {
            return $value;
        }
        switch ($params['type']) {
            case 'string':
                return self::stringTag($value, $params['format']);
                break;
            case 'integer':
                return self::integerTag($value, $params['format']);
                break;
            case 'double':
                return self::doubleTag($value, $params['format']);
                break;
            case 'object':
                return self::objectTag($value);
                break;
            case 'DateTime':
                return self::dataTag($value, $params['format']);
                break;
        }
    }
    
    protected static function createEmptyValue($type, $format)
    {
        switch ($type) {
            case 'string':
                return '';
                break;
            case 'integer':
                return 0;
                break;
            case 'double':
                return 0;
                break;
            case 'DateTime':
                return ;
                break;
        }
    }

    protected static function stringTag($value, $length)
    {
        return substr(trim($value), 0, $length);
    }
    
    protected static function integerTag($value, $length)
    {
        return str_pad(
            substr(preg_replace("/[^0-9\s]/", "", $value), 0, $length),
            '0',
            STR_PAD_LEFT
        );
    }

    protected static function dataTag(DateTime $value, $format)
    {
        return $value->format($format);
    }
    
    protected static function doubleTag($value, $format)
    {
        $f = explode('v', $format);
        return number_format($value, $f[1], '.', '');
    }
    
    protected static function objectTag($value)
    {
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
