<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtBasesFGTS Event S-5003 constructor
 * Read for 2.5.0 layout
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2017-2019
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

class EvtBasesFGTS extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtBasesFGTS';
    /**
     * @var string
     */
    protected $evtAlias = 'S-5003';
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
            !empty($this->std->nrrecarqbase) ? $this->std->nrrecarqbase : null,
            false
        );
        $this->dom->addChild(
            $ideEvento,
            "perApur",
            $this->std->perapur,
            true
        );
        $this->node->insertBefore($ideEvento, $ideEmpregador);
        
        $ide = $this->dom->createElement("ideTrabalhador");
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
        $this->node->appendChild($ide);
        
        if (!empty($this->std->infofgts)) {
            $info = $this->std->infofgts;
            $infoFGTS = $this->dom->createElement("infoFGTS");
            $this->dom->addChild(
                $infoFGTS,
                "dtVenc",
                !empty($info->dtvenc) ? $info->dtvenc : null,
                false
            );
            foreach ($info->ideestablot as $isl) {
                $ideEstabLot = $this->dom->createElement("ideEstabLot");
                $this->dom->addChild(
                    $ideEstabLot,
                    "tpInsc",
                    $isl->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $ideEstabLot,
                    "nrInsc",
                    $isl->nrinsc,
                    true
                );
                $this->dom->addChild(
                    $ideEstabLot,
                    "codLotacao",
                    $isl->codlotacao,
                    true
                );
                foreach ($isl->infotrabfgts as $itf) {
                    $infoTrabFGTS = $this->dom->createElement("infoTrabFGTS");
                    $this->dom->addChild(
                        $infoTrabFGTS,
                        "matricula",
                        !empty($itf->matricula) ? $itf->matricula : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoTrabFGTS,
                        "codCateg",
                        $itf->codcateg,
                        true
                    );
                    $this->dom->addChild(
                        $infoTrabFGTS,
                        "dtAdm",
                        !empty($itf->dtadm) ? $itf->dtadm : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoTrabFGTS,
                        "dtDeslig",
                        !empty($itf->dtdeslig) ? $itf->dtdeslig : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoTrabFGTS,
                        "dtInicio",
                        !empty($itf->dtinicio) ? $itf->dtinicio : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoTrabFGTS,
                        "mtvDeslig",
                        !empty($itf->mtvdeslig) ? $itf->mtvdeslig : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoTrabFGTS,
                        "dtTerm",
                        !empty($itf->dtterm) ? $itf->dtterm : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoTrabFGTS,
                        "mtvDesligTSV",
                        !empty($itf->mtvdesligtsv) ? $itf->mtvdesligtsv : null,
                        false
                    );
                    
                    if (!empty($itf->infobasefgts)) {
                        $ibf = $itf->infobasefgts;
                        $infoBaseFGTS = $this->dom->createElement("infoBaseFGTS");
                        if ($ibf->baseperapur) {
                            foreach ($ibf->baseperapur as $bpa) {
                                $basePerApur = $this->dom->createElement("basePerApur");
                                $this->dom->addChild(
                                    $basePerApur,
                                    "tpValor",
                                    $bpa->tpvalor,
                                    true
                                );
                                $this->dom->addChild(
                                    $basePerApur,
                                    "remFGTS",
                                    number_format($bpa->remfgts, 2, ".", ""),
                                    true
                                );
                                $infoBaseFGTS->appendChild($basePerApur);
                            }
                        }
                        
                        if ($ibf->infobaseperante) {
                            foreach ($ibf->infobaseperante as $ibpae) {
                                $infoBasePerAntE = $this->dom->createElement("infoBasePerAntE");
                                $this->dom->addChild(
                                    $infoBasePerAntE,
                                    "perRef",
                                    $ibpae->perref,
                                    true
                                );
                                foreach ($ibpae->baseperante as $bpae) {
                                    $basePerAntE = $this->dom->createElement("basePerAntE");
                                    $this->dom->addChild(
                                        $basePerAntE,
                                        "tpValorE",
                                        $bpae->tpvalore,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $basePerAntE,
                                        "remFGTSE",
                                        number_format($bpae->remfgtse, 2, ".", ""),
                                        true
                                    );
                                    $infoBasePerAntE->appendChild($basePerAntE);
                                }
                                $infoBaseFGTS->appendChild($infoBasePerAntE);
                            }
                        }
                        $infoTrabFGTS->appendChild($infoBaseFGTS);
                    }
                    $ideEstabLot->appendChild($infoTrabFGTS);
                }
                $infoFGTS->appendChild($ideEstabLot);
            }
            
            if (!empty($info->infodpsfgts)) {
                $idps = $info->infodpsfgts;
                $infoDpsFGTS = $this->dom->createElement("infoDpsFGTS");
                foreach ($idps->infotrabdps as $itdps) {
                    $infoTrabDps = $this->dom->createElement("infoTrabDps");
                    $this->dom->addChild(
                        $infoTrabDps,
                        "matricula",
                        !empty($itdps->matricula) ? $itdps->matricula : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoTrabDps,
                        "codCateg",
                        $itdps->codcateg,
                        true
                    );
                    
                    if (!empty($itdps->dpsperapur)) {
                        foreach ($itdps->dpsperapur as $dpsapp) {
                            $dpsPerApur = $this->dom->createElement("dpsPerApur");
                            $this->dom->addChild(
                                $dpsPerApur,
                                "tpDps",
                                $dpsapp->tpdps,
                                true
                            );
                            $this->dom->addChild(
                                $dpsPerApur,
                                "dpsFGTS",
                                number_format($dpsapp->dpsfgts, 2, ".", ""),
                                true
                            );
                            $infoTrabDps->appendChild($dpsPerApur);
                        }
                    }
                    
                    if (!empty($itdps->infodpsperante)) {
                        foreach ($itdps->infodpsperante as $ipae) {
                            $infoDpsPerAntE = $this->dom->createElement("infoDpsPerAntE");
                            $this->dom->addChild(
                                $infoDpsPerAntE,
                                "perRef",
                                $ipae->perref,
                                true
                            );
                            foreach ($ipae->dpsperante as $dpspae) {
                                $dpsPerAntE = $this->dom->createElement("dpsPerAntE");
                                $this->dom->addChild(
                                    $dpsPerAntE,
                                    "tpDpsE",
                                    $dpspae->tpdpse,
                                    true
                                );
                                $this->dom->addChild(
                                    $dpsPerAntE,
                                    "dpsFGTSE",
                                    number_format($dpspae->dpsfgtse, 2, ".", ""),
                                    true
                                );
                                $infoDpsPerAntE->appendChild($dpsPerAntE);
                            }
                            $infoTrabDps->appendChild($infoDpsPerAntE);
                        }
                    }
                    $infoDpsFGTS->appendChild($infoTrabDps);
                }
                $infoFGTS->appendChild($infoDpsFGTS);
            }
            $this->node->appendChild($infoFGTS);
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->node);
        $this->sign();
    }
}
