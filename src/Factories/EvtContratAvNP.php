<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtContratAvNP Event S-1270 constructor
 * Read for 2.4.2 layout
 * 
 * @category  library
 * @package   NFePHP\eSocial
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

class EvtContratAvNP extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtContratAvNP';
    /**
     * @var string
     */
    protected $evtAlias = 'S-1270';
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
            "indApuracao",
            $this->std->indapuracao,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "perApur",
            $this->std->perapur,
            true
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

        if (isset($this->std->remunavnp)) {
            foreach ($this->std->remunavnp as $remun) {
                $remunAvNP = $this->dom->createElement("remunAvNP");

                $this->dom->addChild(
                    $remunAvNP,
                    "tpInsc",
                    $remun->tpinsc,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "nrInsc",
                    $remun->nrinsc,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "codLotacao",
                    $remun->codlotacao,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp00",
                    $remun->vrbccp00,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp15",
                    $remun->vrbccp15,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp20",
                    $remun->vrbccp20,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp25",
                    $remun->vrbccp25,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp13",
                    $remun->vrbccp13,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcFgts",
                    $remun->vrbcfgts,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrDescCP",
                    $remun->vrdesccp,
                    true
                );

                $this->node->appendChild($remunAvNP);
            }
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
