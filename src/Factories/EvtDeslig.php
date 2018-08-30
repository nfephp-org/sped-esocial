<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtDeslig Event S-2299 constructor
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

class EvtDeslig extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtDeslig';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2299';
    /**
     * Parameters patterns
     *
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

        $ideVinculo = $this->dom->createElement("ideVinculo");

        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->idevinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            $this->std->idevinculo->nistrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->idevinculo->matricula,
            true
        );
        $this->node->appendChild($ideVinculo);

        $infoDeslig = $this->dom->createElement("infoDeslig");
        $this->dom->addChild(
            $infoDeslig,
            "mtvDeslig",
            $this->std->infodeslig->mtvdeslig,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "dtDeslig",
            $this->std->infodeslig->dtdeslig,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "indPagtoAPI",
            $this->std->infodeslig->indpagtoapi,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "dtProjFimAPI",
            !empty($this->std->infodeslig->dtprojfimapi) ? $this->std->infodeslig->dtprojfimapi : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "pensAlim",
            $this->std->infodeslig->pensalim,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "percAliment",
            !empty($this->std->infodeslig->percaliment) ? $this->std->infodeslig->percaliment : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "vrAlim",
            !empty($this->std->infodeslig->vralim) ? $this->std->infodeslig->vralim : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "nrCertObito",
            !empty($this->std->infodeslig->nrcertobito) ? $this->std->infodeslig->nrcertobito : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "nrProcTrab",
            !empty($this->std->infodeslig->nrproctrab) ? $this->std->infodeslig->nrproctrab : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "indCumprParc",
            $this->std->infodeslig->indcumprparc,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "observacao",
            !empty($this->std->infodeslig->observacao) ? $this->std->infodeslig->observacao : null,
            false
        );


        if (!empty($this->std->sucessaovinc)) {
            $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
            $this->dom->addChild(
                $sucessaoVinc,
                "cnpjSucessora",
                $this->std->sucessaovinc->cnpjsucessora,
                true
            );
            $infoDeslig->appendChild($sucessaoVinc);
        }

        if (!empty($this->std->transftit)) {
            $transfTit = $this->dom->createElement("transfTit");
            $this->dom->addChild(
                $transfTit,
                "cpfSubstituto",
                $this->std->transftit->cpfsubstituto,
                true
            );
            $this->dom->addChild(
                $transfTit,
                "dtNascto",
                $this->std->transftit->dtnascto,
                true
            );
            $infoDeslig->appendChild($transfTit);
        }

        if (!empty($this->std->verbasresc)) {
            $verbasResc = $this->dom->createElement("verbasResc");
            foreach ($this->std->verbasresc->dmdev as $dm) {
                $dmDev = $this->dom->createElement("dmDev");
                $this->dom->addChild(
                    $dmDev,
                    "ideDmDev",
                    $dm->idedmdev,
                    true
                );
                if (!empty($dm->infoperapur)) {
                    $infoPerApur = $this->dom->createElement("infoPerApur");
                    foreach ($dm->infoperapur->ideestablot as $isl) {
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

                        foreach ($isl->detverbas as $dv) {
                            $detVerbas = $this->dom->createElement("detVerbas");
                            $this->dom->addChild(
                                $detVerbas,
                                "codRubr",
                                $dv->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "ideTabRubr",
                                $dv->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "qtdRubr",
                                !empty($dv->qtdrubr) ? $dv->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "fatorRubr",
                                !empty($dv->fatorrubr) ? $dv->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "vrUnit",
                                !empty($dv->vrunit) ? $dv->vrunit : null,
                                false
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "vrRubr",
                                $dv->vrrubr,
                                true
                            );
                            $ideEstabLot->appendChild($detVerbas);
                        }

                        if (!empty($isl->infosaudecolet)) {
                            $infoSaudeColet = $this->dom->createElement("infoSaudeColet");
                            foreach ($isl->infosaudecolet->detoper as $do) {
                                $detOper = $this->dom->createElement("detOper");
                                $this->dom->addChild(
                                    $detOper,
                                    "cnpjOper",
                                    $do->cnpjoper,
                                    true
                                );
                                $this->dom->addChild(
                                    $detOper,
                                    "regANS",
                                    $do->regans,
                                    true
                                );
                                $this->dom->addChild(
                                    $detOper,
                                    "vrPgTit",
                                    $do->vrpgtit,
                                    true
                                );

                                if (!empty($do->detplano)) {
                                    foreach ($do->detplano as $dp) {
                                        $detPlano = $this->dom->createElement("detPlano");
                                        $this->dom->addChild(
                                            $detPlano,
                                            "tpDep",
                                            $dp->tpdep,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $detPlano,
                                            "cpfDep",
                                            !empty($dp->cpfdep) ? $dp->cpfdep : null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $detPlano,
                                            "nmDep",
                                            $dp->nmdep,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $detPlano,
                                            "dtNascto",
                                            $dp->dtnascto,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $detPlano,
                                            "vlrPgDep",
                                            $dp->vlrpgdep,
                                            true
                                        );
                                        $detOper->appendChild($detPlano);
                                    }
                                }

                                $infoSaudeColet->appendChild($detOper);
                            }
                            $ideEstabLot->appendChild($infoSaudeColet);
                        }

                        if (!empty($isl->infoagnocivo)) {
                            $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                            $this->dom->addChild(
                                $infoAgNocivo,
                                "grauExp",
                                $isl->infoagnocivo->grauexp,
                                true
                            );
                            $ideEstabLot->appendChild($infoAgNocivo);
                        }

                        if (!empty($isl->infosimples)) {
                            $infoSimples = $this->dom->createElement("infoSimples");
                            $this->dom->addChild(
                                $infoSimples,
                                "indSimples",
                                $isl->infosimples->indsimples,
                                true
                            );
                            $ideEstabLot->appendChild($infoSimples);
                        }

                        $infoPerApur->appendChild($ideEstabLot);
                    }
                    $dmDev->appendChild($infoPerApur);
                }

                if (!empty($dm->infoperant)) {
                    $infoPerAnt = $this->dom->createElement("infoPerAnt");
                    foreach ($dm->infoperant->ideadc as $adc) {
                        $ideADC = $this->dom->createElement("ideADC");
                        $this->dom->addChild(
                            $ideADC,
                            "dtAcConv",
                            $adc->dtacconv,
                            true
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "tpAcConv",
                            $adc->tpacconv,
                            true
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "compAcConv",
                            !empty($adc->compacconv) ? $adc->compacconv : null,
                            false
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "dtEfAcConv",
                            $adc->dtefacconv,
                            true
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "dsc",
                            $adc->dsc,
                            true
                        );
                        foreach ($adc->ideperiodo as $aper) {
                            $idePeriodo = $this->dom->createElement("idePeriodo");
                            $this->dom->addChild(
                                $idePeriodo,
                                "perRef",
                                $aper->perref,
                                true
                            );
                            foreach ($aper->ideestablot as $ael) {
                                $dmideEstabLot = $this->dom->createElement("ideEstabLot");
                                $this->dom->addChild(
                                    $dmideEstabLot,
                                    "tpInsc",
                                    $ael->tpinsc,
                                    true
                                );
                                $this->dom->addChild(
                                    $dmideEstabLot,
                                    "nrInsc",
                                    $ael->nrinsc,
                                    true
                                );
                                $this->dom->addChild(
                                    $dmideEstabLot,
                                    "codLotacao",
                                    $ael->codlotacao,
                                    true
                                );

                                foreach ($ael->detverbas as $adv) {
                                    $dmdetVerbas = $this->dom->createElement("detVerbas");
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "codRubr",
                                        $adv->codrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "ideTabRubr",
                                        $adv->idetabrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "qtdRubr",
                                        !empty($adv->qtdrubr) ? $adv->qtdrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "fatorRubr",
                                        !empty($adv->fatorrubr) ? $adv->fatorrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "vrUnit",
                                        !empty($adv->vrunit) ? $adv->vrunit : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "vrRubr",
                                        $adv->vrrubr,
                                        true
                                    );

                                    $dmideEstabLot->appendChild($dmdetVerbas);
                                }

                                if (!empty($ael->infoagnocivo)) {
                                    $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                                    $this->dom->addChild(
                                        $infoAgNocivo,
                                        "grauExp",
                                        $ael->infoagnocivo->grauexp,
                                        true
                                    );
                                    $dmideEstabLot->appendChild($infoAgNocivo);
                                }

                                if (!empty($ael->infosimples)) {
                                    $infoSimples = $this->dom->createElement("infoSimples");
                                    $this->dom->addChild(
                                        $infoSimples,
                                        "indSimples",
                                        $ael->infosimples->indsimples,
                                        true
                                    );
                                    $dmideEstabLot->appendChild($infoSimples);
                                }

                                $idePeriodo->appendChild($dmideEstabLot);
                            }
                            $ideADC->appendChild($idePeriodo);
                        }


                        $infoPerAnt->appendChild($ideADC);
                    }
                    $dmDev->appendChild($infoPerAnt);
                }

                if (!empty($dm->infotrabinterm)) {
                    foreach ($dm->infotrabinterm as $tin) {
                        $infoTrabInterm = $this->dom->createElement("infoTrabInterm");
                        $this->dom->addChild(
                            $infoTrabInterm,
                            "codConv",
                            $tin->codconv,
                            true
                        );
                        $dmDev->appendChild($infoTrabInterm);
                    }
                }

                $verbasResc->appendChild($dmDev);
            }

            if (!empty($this->std->verbasresc->procjudtrab)) {
                foreach ($this->std->verbasresc->procjudtrab as $pjt) {
                    $procJudTrab = $this->dom->createElement("procJudTrab");
                    $this->dom->addChild(
                        $procJudTrab,
                        "tpTrib",
                        $pjt->tptrib,
                        true
                    );
                    $this->dom->addChild(
                        $procJudTrab,
                        "nrProcJud",
                        $pjt->nrprocjud,
                        true
                    );
                    $this->dom->addChild(
                        $procJudTrab,
                        "codSusp",
                        $pjt->codsusp,
                        true
                    );
                    $verbasResc->appendChild($procJudTrab);
                }
            }

            if (!empty($this->std->verbasresc->infomv)) {
                $imv = $this->std->verbasresc->infomv;
                $infoMV = $this->dom->createElement("infoMV");
                $this->dom->addChild(
                    $infoMV,
                    "indMV",
                    $imv->indmv,
                    true
                );
                foreach ($imv->remunoutrempr as $roe) {
                    $remunOutrEmpr = $this->dom->createElement("remunOutrEmpr");
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "tpInsc",
                        $roe->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "nrInsc",
                        $roe->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "codCateg",
                        $roe->codcateg,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "vlrRemunOE",
                        $roe->vlrremunoe,
                        true
                    );
                    $infoMV->appendChild($remunOutrEmpr);
                }
                $verbasResc->appendChild($infoMV);
            }

            $infoDeslig->appendChild($verbasResc);
        }
        if (!empty($this->std->quarentena)) {
            $quarentena = $this->dom->createElement("quarentena");
            $this->dom->addChild(
                $quarentena,
                "dtFimQuar",
                $this->std->quarentena->dtfimquar,
                true
            );
            $infoDeslig->appendChild($quarentena);
        }

        $consigFGTS = $this->dom->createElement("consigFGTS");

        if (!empty($this->std->consigfgts)) {

            $this->dom->addChild(
                $consigFGTS,
                "idConsig",
                $this->std->consigfgts->idconsig,
                true
            );
            $this->dom->addChild(
                $consigFGTS,
                "insConsig",
                !empty($this->std->consigfgts->insconsig) ? $this->std->consigfgts->insconsig : null,
                true
            );
            $this->dom->addChild(
                $consigFGTS,
                "nrContr",
                !empty($this->std->consigfgts->nrcontr) ? $this->std->consigfgts->nrcontr : null,
                false
            );
            $infoDeslig->appendChild($consigFGTS);

        }

        $this->node->appendChild($infoDeslig);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign($this->eSocial);
    }
}
