<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtInfoComplPer Event S-1280 constructor
 * Read for 2.4.2 layout
 * Read for 2.5.0 layout
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
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate | null
     * @param string $date
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate = null,
        $date = ''
    ) {
        parent::__construct($config, $std, $certificate, $date);
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
            $this->std->nrrecibo,
            false
        );
        $this->dom->addChild(
            $ideEvento,
            "indApuracao",
            $this->std->indapuracao,
            false
        );
        $this->dom->addChild(
            $ideEvento,
            "perApur",
            $this->std->perapur,
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
        if (isset($this->std->infosubstpatr)) {
            $infoSubstPatr = $this->dom->createElement("infoSubstPatr");
            $this->dom->addChild(
                $infoSubstPatr,
                "indSubstPatr",
                $this->std->infosubstpatr->indsubstpatr,
                true
            );
            $this->dom->addChild(
                $infoSubstPatr,
                "percRedContrib",
                $this->std->infosubstpatr->percpedcontrib,
                true
            );
            $this->node->appendChild($infoSubstPatr);
        }
        if (isset($this->std->infosubstpatropport)) {
            foreach ($this->std->infosubstpatropport as $info) {
                $infoSubstPatrOpPort = $this->dom->createElement("infoSubstPatrOpPort");
                $this->dom->addChild(
                    $infoSubstPatrOpPort,
                    "cnpjOpPortuario",
                    $info->cnpjopportuario,
                    true
                );
                $this->node->appendChild($infoSubstPatrOpPort);
            }
        }
        if (isset($this->std->infoativconcom)) {
            $infoAtivConcom = $this->dom->createElement("infoAtivConcom");
            $this->dom->addChild(
                $infoAtivConcom,
                "fatorMes",
                $this->std->infoativconcom->fatormes,
                true
            );
            $this->dom->addChild(
                $infoAtivConcom,
                "fator13",
                $this->std->infoativconcom->fator13,
                true
            );
            $this->node->appendChild($infoAtivConcom);
        }
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->sign();
        //$this->xml = $this->dom->saveXML($this->eSocial);
    }
}
