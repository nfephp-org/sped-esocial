<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtExpRisco Event S-2240 constructor
 *
 * @category  NFePHP
 * @package   NFePHPSocial
 * @copyright NFePHP Copyright (c) 2017
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-esocial for the canonical source repository
 */

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Common\Factory;
use NFePHP\eSocial\Common\FactoryId;
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

class EvtExpRisco extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtExpRisco';

    /**
     * @var string
     */
    protected $evtAlias = 'S-2240';

    /**
     * Parameters patterns
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * Constructor
     *
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate
    ) {
        parent::__construct($config, $std, $certificate);
    }

    /**
     * Node constructor
     */
    protected function toNode()
    {
        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);
        //o idEvento pode variar de evento para evento
        //então cada factory individualmente terá de construir o seu
        $ideEvento = $this->dom->createElement("ideEvento");
        $this->dom->addChild(
            $ideEvento,
            "indRetif",
            $this->std->indretif,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "nrRecibo",
            !empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
            false
        );
        $this->dom->addChild(
            $ideEvento,
            "tpAmb",
            $this->tpAmb,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "procEmi",
            $this->procEmi,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "verProc",
            $this->verProc,
            true
        );
        $this->node->insertBefore($ideEvento, $ideEmpregador);
        
        $ide = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ide,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ide,
            "nisTrab",
            !empty($this->std->nistrab) ? $this->std->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ide,
            "matricula",
            !empty($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->node->appendChild($ide);
        
        switch ($this->std->modo) {
            case 'INI':
                $noderisco = $this->dom->createElement("iniExpRisco");
                $dtnode = 'dtIniCondicao';
                break;
            case 'ALT':
                $noderisco = $this->dom->createElement("altExpRisco");
                $dtnode = 'dtAltCondicao';
                break;
            case 'FIM':
                $noderisco = $this->dom->createElement("fimExpRisco");
                $dtnode = 'dtFimCondicao';
                break;
        }
        $this->dom->addChild(
            $noderisco,
            $dtnode,
            $this->std->dtcondicao,
            true
        );
        if (!empty($this->std->codamb)) {
            foreach($this->std->codamb as $cod) {
                $infoAmb = $this->dom->createElement("infoAmb");
                $this->dom->addChild(
                    $infoAmb,
                    'codAmb',
                    $cod,
                    true
                );
                $noderisco->appendChild($infoAmb);
            }
        }
        
        $info = $this->dom->createElement("infoExpRisco");
        $info->appendChild($noderisco);
        
        $this->node->appendChild($info);
        $this->eSocial->appendChild($this->node);
        $this->xml = $this->dom->saveXML($this->eSocial);
        //$this->sign();
    }
}
