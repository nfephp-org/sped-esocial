<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtIrrf Event S-5012 constructor
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

class EvtIrrf extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtIrrf';
    /**
     * @var string
     */
    protected $evtAlias = 'S-5012';
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
        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);
        //o idEvento pode variar de evento para evento
        //então cada factory individualmente terá de construir o seu
        $ideEvento = $this->dom->createElement("ideEvento");
        $this->dom->addChild(
            $ideEvento,
            "perApur",
            $this->std->perapur,
            true
        );
        $this->node->insertBefore($ideEvento, $ideEmpregador);
        
        //tag deste evento em particular
        $infoIrrf = $this->dom->createElement("infoIRRF");
        $this->dom->addChild(
            $infoIrrf,
            "nrRecArqBase",
            !empty($this->std->infoirrf->nrrecarqbase) ? $this->std->infoirrf->nrrecarqbase : '',
            false
        );
        $this->dom->addChild(
            $infoIrrf,
            "indExistInfo",
            $this->std->infoirrf->indexistinfo,
            true
        );
        
        if (isset($this->std->infocrcontrib)) {
            foreach ($this->std->infocrcontrib as $infoc) {
                $infocontrib = $this->dom->createElement("infoCRContrib");
                $this->dom->addChild(
                    $infocontrib,
                    "tpCR",
                    $infoc->tpcr,
                    true
                );
                $this->dom->addChild(
                    $infocontrib,
                    "vrCR",
                    $infoc->vrcr,
                    true
                );
                $infoIrrf->appendChild($infocontrib);
            }
        }
        $this->node->appendChild($infoIrrf);
        
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
