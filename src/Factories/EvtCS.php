<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtCS Event S-5011 constructor
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

class EvtCS extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtCS';
    /**
     * @var string
     */
    protected $evtAlias = 'S-5011';
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
        $ideEvento = $this->dom->createElement("ideEvento");
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
        $infoCS = $this->dom->createElement("infoCS");
        $this->dom->addChild(
            $infoCS,
            "nrRecArqBase",
            !empty($this->std->nrrecarqbase) ? $this->std->nrrecarqbase : null,
            false
        );
        $this->dom->addChild(
            $infoCS,
            "indExistInfo",
            $this->std->indexistinfo,
            true
        );
        if (!empty($this->std->infocpseg)) {
            $ips = $this->std->infocpseg;
            $infoCPSeg = $this->dom->createElement("infoCPSeg");
            $this->dom->addChild(
                $infoCPSeg,
                "vrDescCP",
                $ips->vrdesccp,
                true
            );
            $this->dom->addChild(
                $infoCPSeg,
                "vrCpSeg",
                $ips->vrcpseg,
                true
            );
            $infoCS->appendChild($infoCPSeg);
        }
        $ict = $this->std->infocontrib;
        $infoContrib = $this->dom->createElement("infoContrib");
        $this->dom->addChild(
            $infoContrib,
            "classTrib",
            $ict->classtrib,
            true
        );
        if (!empty($ict->infopj)) {
            $ipj = $ict->infopj;
            $infoPJ = $this->dom->createElement("infoPJ");
            $this->dom->addChild(
                $infoPJ,
                "indCoop",
                !empty($ipj->indcoop) ? $ipj->indcoop : null,
                false
            );
            $this->dom->addChild(
                $infoPJ,
                "indConstr",
                $ipj->indconstr,
                true
            );
            $this->dom->addChild(
                $infoPJ,
                "indSubstPatr",
                !empty($ipj->indsubstpatr) ? $ipj->indsubstpatr : null,
                false
            );
            $this->dom->addChild(
                $infoPJ,
                "percRedContrib",
                !empty($ipj->percredcontrib) ? $ipj->percredcontrib : null,
                false
            );
            if (!empty($ipj->infoatconc)) {
                $at = $ipj->infoatconc;
                $infoAtConc = $this->dom->createElement("infoAtConc");
                $this->dom->addChild(
                    $infoAtConc,
                    "fatorMes",
                    $at->fatormes,
                    true
                );
                $this->dom->addChild(
                    $infoAtConc,
                    "fator13",
                    $at->fator13,
                    true
                );

                $infoPJ->appendChild($infoAtConc);
            }
            $infoContrib->appendChild($infoPJ);
        }
        $infoCS->appendChild($infoContrib);
        if (!empty($this->std->ideestab)) {
            foreach ($this->std->ideestab as $is) {
                $ideEstab = $this->dom->createElement("ideEstab");
                $this->dom->addChild(
                    $ideEstab,
                    "tpInsc",
                    $is->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $ideEstab,
                    "nrInsc",
                    $is->nrinsc,
                    true
                );
                if (!empty($is->infoestab)) {
                    $infoEstab = $this->dom->createElement("infoEstab");
                    $this->dom->addChild(
                        $infoEstab,
                        "cnaePrep",
                        $is->infoestab->cnaeprep,
                        true
                    );
                    $this->dom->addChild(
                        $infoEstab,
                        "aliqRat",
                        $is->infoestab->aliqrat,
                        true
                    );
                    $this->dom->addChild(
                        $infoEstab,
                        "fap",
                        $is->infoestab->fap,
                        true
                    );
                    $this->dom->addChild(
                        $infoEstab,
                        "aliqRatAjust",
                        $is->infoestab->aliqratajust,
                        true
                    );
                    if (!empty($is->infoestab->infocomplobra)) {
                        $infoComplObra = $this->dom->createElement("infoComplObra");
                        $this->dom->addChild(
                            $infoComplObra,
                            "indSubstPatrObra",
                            $is->infoestab->infocomplobra->indsubstpatrobra,
                            true
                        );
                        $infoEstab->appendChild($infoComplObra);
                    }
                    $ideEstab->appendChild($infoEstab);
                }
                if (!empty($is->idelotacao)) {
                    foreach ($is->idelotacao as $id) {
                        $ideLotacao = $this->dom->createElement("ideLotacao");
                        $this->dom->addChild(
                            $ideLotacao,
                            "codLotacao",
                            $id->codlotacao,
                            true
                        );
                        $this->dom->addChild(
                            $ideLotacao,
                            "fpas",
                            $id->fpas,
                            true
                        );
                        $this->dom->addChild(
                            $ideLotacao,
                            "codTercs",
                            $id->codtercs,
                            true
                        );
                        $this->dom->addChild(
                            $ideLotacao,
                            "codTercsSusp",
                            !empty($id->codtercssusp) ? $id->codtercssusp : null,
                            false
                        );
                        if (!empty($id->infotercsusp)) {
                            foreach ($id->infotercsusp as $tsus) {
                                $infoTercSusp = $this->dom->createElement("infoTercSusp");
                                $this->dom->addChild(
                                    $infoTercSusp,
                                    "codTerc",
                                    $tsus->codterc,
                                    true
                                );
                                $ideLotacao->appendChild($infoTercSusp);
                            }
                        }
                        if (!empty($id->infoemprparcial)) {
                            $infoEmprParcial = $this->dom->createElement("infoEmprParcial");
                            $this->dom->addChild(
                                $infoEmprParcial,
                                "tpInscContrat",
                                $id->infoemprparcial->tpinsccontrat,
                                true
                            );
                            $this->dom->addChild(
                                $infoEmprParcial,
                                "nrInscContrat",
                                $id->infoemprparcial->nrinsccontrat,
                                true
                            );
                            $this->dom->addChild(
                                $infoEmprParcial,
                                "tpInscProp",
                                $id->infoemprparcial->tpinscprop,
                                true
                            );
                            $this->dom->addChild(
                                $infoEmprParcial,
                                "nrInscProp",
                                $id->infoemprparcial->nrinscprop,
                                true
                            );
                            $this->dom->addChild(
                                $infoEmprParcial,
                                "cnoObra",
                                $id->infoemprparcial->cnoobra,
                                true
                            );
                            $ideLotacao->appendChild($infoEmprParcial);
                        }
                        if (!empty($id->dadosopport)) {
                            $dadosOpPort = $this->dom->createElement("dadosOpPort");
                            $this->dom->addChild(
                                $dadosOpPort,
                                "cnpjOpPortuario",
                                $id->dadosopport->cnpjopportuario,
                                true
                            );
                            $this->dom->addChild(
                                $dadosOpPort,
                                "aliqRat",
                                $id->dadosopport->aliqrat,
                                true
                            );
                            $this->dom->addChild(
                                $dadosOpPort,
                                "fap",
                                $id->dadosopport->fap,
                                true
                            );
                            $this->dom->addChild(
                                $dadosOpPort,
                                "aliqRatAjust",
                                $id->dadosopport->aliqratajust,
                                true
                            );
                            $ideLotacao->appendChild($dadosOpPort);
                        }
                        if (!empty($id->basesremun)) {
                            foreach ($id->basesremun as $br) {
                                $basesRemun = $this->dom->createElement("basesRemun");
                                $this->dom->addChild(
                                    $basesRemun,
                                    "indIncid",
                                    $br->indincid,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesRemun,
                                    "codCateg",
                                    $br->codcateg,
                                    true
                                );
                                $basesCp = $this->dom->createElement("basesCp");
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrBcCp00",
                                    $br->basescp->vrbccp00,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrBcCp15",
                                    $br->basescp->vrbccp15,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrBcCp20",
                                    $br->basescp->vrbccp20,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrBcCp25",
                                    $br->basescp->vrbccp25,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrSuspBcCp00",
                                    $br->basescp->vrsuspbccp00,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrSuspBcCp15",
                                    $br->basescp->vrsuspbccp15,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrSuspBcCp20",
                                    $br->basescp->vrsuspbccp20,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrSuspBcCp25",
                                    $br->basescp->vrsuspbccp25,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrDescSest",
                                    $br->basescp->vrdescsest,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrCalcSest",
                                    $br->basescp->vrcalcsest,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrDescSenat",
                                    $br->basescp->vrdescsenat,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrCalcSenat",
                                    $br->basescp->vrcalcsenat,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrSalFam",
                                    $br->basescp->vrsalfam,
                                    true
                                );
                                $this->dom->addChild(
                                    $basesCp,
                                    "vrSalMat",
                                    $br->basescp->vrsalmat,
                                    true
                                );
                                $basesRemun->appendChild($basesCp);
                                $ideLotacao->appendChild($basesRemun);
                            }
                        }
                        if (!empty($id->basesavnport)) {
                            $basesAvNPort = $this->dom->createElement("basesAvNPort");
                            $this->dom->addChild(
                                $basesAvNPort,
                                "vrBcCp00",
                                $id->basesavnport->vrbccp00,
                                true
                            );
                            $this->dom->addChild(
                                $basesAvNPort,
                                "vrBcCp15",
                                $id->basesavnport->vrbccp15,
                                true
                            );
                            $this->dom->addChild(
                                $basesAvNPort,
                                "vrBcCp20",
                                $id->basesavnport->vrbccp20,
                                true
                            );
                            $this->dom->addChild(
                                $basesAvNPort,
                                "vrBcCp25",
                                $id->basesavnport->vrbccp25,
                                true
                            );
                            $this->dom->addChild(
                                $basesAvNPort,
                                "vrBcCp13",
                                $id->basesavnport->vrbccp13,
                                true
                            );
                            $this->dom->addChild(
                                $basesAvNPort,
                                "vrBcFgts",
                                $id->basesavnport->vrbcfgts,
                                true
                            );
                            $this->dom->addChild(
                                $basesAvNPort,
                                "vrDescCP",
                                $id->basesavnport->vrdesccp,
                                true
                            );
                            $ideLotacao->appendChild($basesAvNPort);
                        }
                        if (!empty($id->infosubstpatropport)) {
                            foreach ($id->infosubstpatropport as $ipp) {
                                $infoSubstPatrOpPort = $this->dom->createElement("infoSubstPatrOpPort");
                                $this->dom->addChild(
                                    $infoSubstPatrOpPort,
                                    "cnpjOpPortuario",
                                    $ipp->cnpjopportuario,
                                    true
                                );
                                $ideLotacao->appendChild($infoSubstPatrOpPort);
                            }
                        }
                        $ideEstab->appendChild($ideLotacao);
                    }
                }
                if (!empty($is->basesaquis)) {
                    foreach ($is->basesaquis as $bq) {
                        $basesAquis = $this->dom->createElement("basesAquis");
                        $this->dom->addChild(
                            $basesAquis,
                            "indAquis",
                            $bq->indaquis,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vlrAquis",
                            $bq->vlraquis,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vrCPDescPR",
                            $bq->vrcpdescpr,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vrCPNRet",
                            $bq->vrcpnret,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vrRatNRet",
                            $bq->vrratnret,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vrSenarNRet",
                            $bq->vrsenarnret,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vrCPCalcPR",
                            $bq->vrcpcalcpr,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vrRatDescPR",
                            $bq->vrratdescpr,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vrRatCalcPR",
                            $bq->vrratcalcpr,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vrSenarDesc",
                            $bq->vrsenardesc,
                            true
                        );
                        $this->dom->addChild(
                            $basesAquis,
                            "vrSenarCalc",
                            $bq->vrsenarcalc,
                            true
                        );
                        $ideEstab->appendChild($basesAquis);
                    }
                }
                if (!empty($is->basescomerc)) {
                    foreach ($is->basescomerc as $bc) {
                        $basesComerc = $this->dom->createElement("basesComerc");
                        $this->dom->addChild(
                            $basesComerc,
                            "indComerc",
                            $bc->indcomerc,
                            true
                        );
                        $this->dom->addChild(
                            $basesComerc,
                            "vrBcComPR",
                            $bc->vrbccompr,
                            true
                        );
                        $this->dom->addChild(
                            $basesComerc,
                            "vrCPSusp",
                            !empty($bc->vrcpsusp) ? $bc->vrcpsusp : null,
                            false
                        );
                        $this->dom->addChild(
                            $basesComerc,
                            "vrRatSusp",
                            !empty($bc->vrratsusp) ? $bc->vrratsusp : null,
                            false
                        );
                        $this->dom->addChild(
                            $basesComerc,
                            "vrSenarSusp",
                            !empty($bc->vrsenarsusp) ? $bc->vrsenarsusp : null,
                            false
                        );
                        $ideEstab->appendChild($basesComerc);
                    }
                }
                if (!empty($is->infocrestab)) {
                    foreach ($is->infocrestab as $cre) {
                        $infoCREstab = $this->dom->createElement("infoCREstab");
                        $this->dom->addChild(
                            $infoCREstab,
                            "tpCR",
                            $cre->tpcr,
                            true
                        );
                        $this->dom->addChild(
                            $infoCREstab,
                            "vrCR",
                            $cre->vrcr,
                            true
                        );
                        $this->dom->addChild(
                            $infoCREstab,
                            "vrSuspCR",
                            $cre->vrsuspcr,
                            true
                        );
                        $ideEstab->appendChild($infoCREstab);
                    }
                }
                $infoCS->appendChild($ideEstab);
            }
        }
        if (!empty($this->std->infocrcontrib)) {
            foreach ($this->std->infocrcontrib as $ic) {
                $infoCRContrib = $this->dom->createElement("infoCRContrib");
                $this->dom->addChild(
                    $infoCRContrib,
                    "tpCR",
                    $ic->tpcr,
                    true
                );
                $this->dom->addChild(
                    $infoCRContrib,
                    "vrCR",
                    $ic->vrcr,
                    true
                );
                $this->dom->addChild(
                    $infoCRContrib,
                    "vrCRSusp",
                    $ic->vrcrsusp,
                    true
                );
                $infoCS->appendChild($infoCRContrib);
            }
        }
        $this->node->appendChild($infoCS);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
