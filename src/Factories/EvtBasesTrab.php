<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtBasesTrab Event S-5001 constructor
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
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

class EvtBasesTrab extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtBasesTrab';
    /**
     * @var string
     */
    protected $evtAlias = 'S-5001';
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
            "nrRecArqBase",
            ! empty($this->std->nrrecarqbase) ? $this->std->nrrecarqbase : null,
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
        $this->node->insertBefore($ideEvento, $ideEmpregador);

        $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ideTrabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        if (isset($this->std->procjudtrab)) {
            foreach ($this->std->procjudtrab as $proc) {
                $procJudTrab = $this->dom->createElement("procJudTrab");
                $this->dom->addChild(
                    $procJudTrab,
                    "nrProcJud",
                    $proc->nrprocjud,
                    true
                );
                $this->dom->addChild(
                    $procJudTrab,
                    "codSusp",
                    $proc->codsusp,
                    true
                );
                $ideTrabalhador->appendChild($procJudTrab);
            }
        }
        $this->node->appendChild($ideTrabalhador);

        if (isset($this->std->infocpcalc)) {
            foreach ($this->std->infocpcalc as $info) {
                $infoCpCalc = $this->dom->createElement("infoCpCalc");
                $this->dom->addChild(
                    $infoCpCalc,
                    "tpCR",
                    $info->tpcr,
                    true
                );
                $this->dom->addChild(
                    $infoCpCalc,
                    "vrCpSeg",
                    $info->vrcpseg,
                    true
                );
                $this->dom->addChild(
                    $infoCpCalc,
                    "vrDescSeg",
                    $info->vrdescseg,
                    true
                );
                $this->node->appendChild($infoCpCalc);
            }
        }

        $infoCp = $this->dom->createElement("infoCp");
        foreach ($this->std->ideestablot as $ideest) {
            $ideEstabLot = $this->dom->createElement("ideEstabLot");
            $this->dom->addChild(
                $ideEstabLot,
                "tpInsc",
                $ideest->tpinsc,
                true
            );
            $this->dom->addChild(
                $ideEstabLot,
                "nrInsc",
                $ideest->nrinsc,
                true
            );
            $this->dom->addChild(
                $ideEstabLot,
                "codLotacao",
                $ideest->codlotacao,
                true
            );
            foreach ($ideest->infocategincid as $infocat) {
                $infoCategIncid = $this->dom->createElement("infoCategIncid");
                $this->dom->addChild(
                    $infoCategIncid,
                    "matricula",
                    ! empty($infocat->matricula) ? $infocat->matricula : null,
                    false
                );
                $this->dom->addChild(
                    $infoCategIncid,
                    "codCateg",
                    $infocat->codcateg,
                    true
                );
                $this->dom->addChild(
                    $infoCategIncid,
                    "indSimples",
                    ! empty($infocat->indsimples) ? $infocat->indsimples : null,
                    false
                );
                foreach ($infocat->infobasecs as $infobase) {
                    $infoBaseCS = $this->dom->createElement("infoBaseCS");
                    $this->dom->addChild(
                        $infoBaseCS,
                        "ind13",
                        $infobase->ind13,
                        true
                    );
                    $this->dom->addChild(
                        $infoBaseCS,
                        "tpValor",
                        $infobase->tpvalor,
                        true
                    );
                    $this->dom->addChild(
                        $infoBaseCS,
                        "valor",
                        $infobase->valor,
                        true
                    );
                    $infoCategIncid->appendChild($infoBaseCS);
                }

                if (isset($infocat->calcterc)) {
                    foreach ($infocat->calcterc as $cT) {
                        $calcTerc = $this->dom->createElement("calcTerc");
                        $this->dom->addChild(
                            $calcTerc,
                            "tpCR",
                            $cT->tpcr,
                            true
                        );
                        $this->dom->addChild(
                            $calcTerc,
                            "vrCsSegTerc",
                            $cT->vrcssegterc,
                            true
                        );
                        $this->dom->addChild(
                            $calcTerc,
                            "vrDescTerc",
                            $cT->vrdescterc,
                            true
                        );
                        $infoCategIncid->appendChild($calcTerc);
                    }
                }
                if (isset($infocat->infoperref)) {
                    foreach ($infocat->infoperref as $iref) {
                        $inforef = $this->dom->createElement("infoPerRef");
                        $this->dom->addChild(
                            $inforef,
                            "perRef",
                            $iref->perRef,
                            true
                        );
                        foreach ($iref->detinfoperref as $dref) {
                            $detref = $this->dom->createElement("detInfoPerRef");
                            $this->dom->addChild(
                                $detref,
                                "ind13",
                                $dref->ind13,
                                true
                            );
                            $this->dom->addChild(
                                $detref,
                                "tpValor",
                                $dref->tpvalor,
                                true
                            );
                            $this->dom->addChild(
                                $detref,
                                "vrPerRef",
                                $dref->vrperref,
                                true
                            );
                            $inforef->appendChild($detref);
                        }
                        $infoCategIncid->appendChild($inforef);
                    }
                }
                $ideEstabLot->appendChild($infoCategIncid);
            }
            $infoCp->appendChild($ideEstabLot);
        }
        $this->node->appendChild($infoCp);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->node);
        $this->sign();
    }
}
