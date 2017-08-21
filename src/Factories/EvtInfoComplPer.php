<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtInfoComplPer Event S-1280 constructor
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

use NFePHP\eSocial\Common\Factory;
use NFePHP\eSocial\Common\FactoryInterface;
use NFePHP\eSocial\Common\FactoryId;
use NFePHP\Common\Certificate;
use stdClass;

class EvtInfoComplPer extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtInfoComplPer';
    /**
     * @var string
     */
    protected $evtAlias = 'S-1280';
    /**
     * Parameters patterns
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * Constructor
     *
     * @param string      $config
     * @param stdClass    $std
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
        $evtInfoComplPer = $this->dom->createElement("evtInfoComplPer");
        $att = $this->dom->createAttribute('Id');
        $att->value = $evtid;
        $evtInfoComplPer->appendChild($att);
        
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
        $evtInfoComplPer->appendChild($ideEvento);
    
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
        $evtInfoComplPer->appendChild($ideEmpregador);
        


        $eSocial->appendChild($evtInfoComplPer);
        $this->sign($eSocial);
    }
}
