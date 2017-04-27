<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtAdmPrelim Event S-2190 constructor
 *
 * @category  NFePHP
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2017
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-esocial for the canonical source repository
 */

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use NFePHP\eSocial\Factories\FactoryId;
use NFePHP\Common\Certificate;
use stdClass;

class EvtAdmPrelim extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    public $cpfTrab;
    /**
     * @var \DateTime
     */
    public $dtNascto;
    /**
     * @var \DateTime
     */
    public $dtAdm;

    /**
     * @var string
     */
    protected $evtName = 'evtAdmPrelim';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2190';
    /**
     * Parameters patterns
     * @var array
     */
    protected $parameters = [];

    /**
     * Constructor
     * @param type $config
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
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );
        $eSocial = $this->dom->getElementsByTagName("eSocial")->item(0);
        $evtAdmPrelim = $this->dom->createElement("evtAdmPrelim");
        $att = $this->dom->createAttribute('Id');
        $att->value = $evtid;
        $evtAdmPrelim->appendChild($att);
        
        $ideEvento = $this->dom->createElement("ideEvento");
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
        
        $infoRegPrelim = $this->dom->createElement("infoRegPrelim");
        $this->dom->addChild(
            $infoRegPrelim,
            "cpfTrab",
            $this->cpfTrab,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtNascto",
            $this->dtNascto->format('Y-m-d'),
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtAdm",
            $this->dtAdm->format('Y-m-d'),
            true
        );
        $evtAdmPrelim->appendChild($infoRegPrelim);
        $eSocial->appendChild($evtAdmPrelim);
        $this->sign($eSocial);
    }
}
