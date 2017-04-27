<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTSVAltContr Event S-2306 constructor
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

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use NFePHP\eSocial\Factories\EvtId;
use NFePHP\Common\Certificate;
use stdClass;

class EvtTSVAltContr extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtTSVAltContr';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2306';
    /**
     * Parameters patterns
     * @var array
     */
    protected $parameters = [];

    /**
     * Constructor
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
        $evtid = EvtId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );
        $eSocial = $this->dom->getElementsByTagName("eSocial")->item(0);
        $evtTSVAltContr = $this->dom->createElement("evtTSVAltContr");
        $att = $this->dom->createAttribute('Id');
        $att->value = $evtid;
        $evtTSVAltContr->appendChild($att);
        
        $ideEvento = $this->dom->createElement("ideEvento");
        $this->dom->addChild(
            $ideEvento,
            "tpAmb",
            $this->tpAmb,
            rue
        );
        $this->dom->addChild(
            $ideEvento,
            "procEmi",
            $this->procEmi,
            rue
        );        $this->dom->addChild(
            $ideEvento,
            "verProc",
            $this->verProc,
            true
        );
        $evtAdmPrelim->appendChild($ideEvento);
    
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
        $evtAdmPrelim->appendChild($ideEmpregador);
        


        $eSocial->appendChild($evtAdmPrelim);
        $this->sign($eSocial);
    }
}
