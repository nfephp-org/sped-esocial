<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtRmnRPPS Event S-1202 constructor
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

class EvtRmnRPPS extends Factory implements FactoryInterface
{

    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtRmnRPPS';

    /**
     * @var string
     */
    protected $evtAlias = 'S-1202';

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
    public function __construct($config, stdClass $std, Certificate $certificate)
    {
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
        $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ideTrabalhador,
            "cpfTrab",
            $this->std->idetrabalhador->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideTrabalhador,
            "nisTrab",
            !empty($this->std->idetrabalhador->nistrab) ? $this->std->idetrabalhador->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ideTrabalhador,
            "qtdDepFP",
            !empty($this->std->idetrabalhador->qtddepfp) ? $this->std->idetrabalhador->qtddepfp : null,
            false
        );
        if (isset($this->std->idetrabalhador->procjudtrab)) {
            foreach ($this->std->idetrabalhador->procjudtrab as $proc) {
                $procJudTrab = $this->dom->createElement("procJudTrab");
                $this->dom->addChild(
                    $procJudTrab,
                    "tpTrib",
                    $proc->tptrib,
                    true
                );
                $this->dom->addChild(
                    $procJudTrab,
                    "nrProcJud",
                    $proc->nrprocjud,
                    true
                );
                $this->dom->addChild(
                    $procJudTrab,
                    "codSusp",
                    !empty($proc->codsusp) ? $proc->codsusp : null,
                    false
                );
                $ideTrabalhador->appendChild($procJudTrab);
            }
        }
        $this->node->appendChild($ideTrabalhador);
        $dmDev = '';
        if (isset($this->std->dmdev)) {
            foreach ($this->std->dmdev as $dev) {
                $dmDev = $this->dom->createElement("dmDev");
                $this->dom->addChild(
                    $dmDev,
                    "ideDmDev",
                    $dev->idedmdev,
                    true
                );
                if (isset($dev->infoperapur)) {
                    $infoPerApur = $this->dom->createElement("infoPerApur");
                    foreach ($dev->infoperapur->ideestab as $estab) {
                        $ideEstab = $this->dom->createElement("ideEstab");
                        $this->dom->addChild(
                            $ideEstab,
                            "tpInsc",
                            $estab->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $ideEstab,
                            "nrInsc",
                            $estab->nrinsc,
                            true
                        );
                        foreach ($estab->remunperapur as $remun) {
                            $remunPerApur = $this->dom->createElement("remunPerApur");
                            $this->dom->addChild(
                                $remunPerApur,
                                "matricula",
                                !empty($remun->matricula) ? $remun->matricula : null,
                                false
                            );
                            $this->dom->addChild(
                                $remunPerApur,
                                "codCateg",
                                $remun->codcateg,
                                true
                            );
                            foreach ($remun->itensremun as $itens) {
                                $itensRemun = $this->dom->createElement("itensRemun");
                                $this->dom->addChild(
                                    $itensRemun,
                                    "codRubr",
                                    $itens->codrubr,
                                    true
                                );
                                $this->dom->addChild(
                                    $itensRemun,
                                    "ideTabRubr",
                                    $itens->idetabrubr,
                                    true
                                );
                                $this->dom->addChild(
                                    $itensRemun,
                                    "qtdRubr",
                                    !empty($itens->qtdrubr) ? $itens->qtdrubr : null,
                                    false
                                );
                                $this->dom->addChild(
                                    $itensRemun,
                                    "fatorRubr",
                                    !empty($itens->fatorrubr) ? $itens->fatorrubr : null,
                                    false
                                );
                                $this->dom->addChild(
                                    $itensRemun,
                                    "vrUnit",
                                    !empty($itens->vrunit) ? $itens->vrunit : null,
                                    false
                                );
                                $this->dom->addChild(
                                    $itensRemun,
                                    "vrRubr",
                                    $itens->vrrubr,
                                    true
                                );
                                $remunPerApur->appendChild($itensRemun);
                            }
                            if (isset($remun->infosaudecolet)) {
                                $infoSaudeColet = $this->dom->createElement("infoSaudeColet");
                                foreach ($remun->infosaudecolet->detoper as $oper) {
                                    $detOper = $this->dom->createElement("detOper");
                                    $this->dom->addChild(
                                        $detOper,
                                        "cnpjOper",
                                        $oper->cnpjoper,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $detOper,
                                        "regANS",
                                        $oper->regans,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $detOper,
                                        "vrPgTit",
                                        $oper->vrpgtit,
                                        true
                                    );
                                    if (isset($oper->detplano)) {
                                        foreach ($oper->detplano as $plano) {
                                            $detPlano = $this->dom->createElement("detPlano");
                                            $this->dom->addChild(
                                                $detPlano,
                                                "tpDep",
                                                $plano->tpdep,
                                                true
                                            );
                                            $this->dom->addChild(
                                                $detPlano,
                                                "cpfDep",
                                                !empty($plano->cpfdep) ? $plano->cpfdep : null,
                                                false
                                            );
                                            $this->dom->addChild(
                                                $detPlano,
                                                "nmDep",
                                                $plano->nmdep,
                                                true
                                            );
                                            $this->dom->addChild(
                                                $detPlano,
                                                "dtNascto",
                                                $plano->dtnascto,
                                                true
                                            );
                                            $this->dom->addChild(
                                                $detPlano,
                                                "vlrPgDep",
                                                $plano->vlrpgdep,
                                                true
                                            );
                                            $detOper->appendChild($detPlano);
                                        }
                                    }
                                    $infoSaudeColet->appendChild($detOper);
                                }
                                $remunPerApur->appendChild($infoSaudeColet);
                            }
                            $ideEstab->appendChild($remunPerApur);
                        }
                        $infoPerApur->appendChild($ideEstab);
                    }
                    $dmDev->appendChild($infoPerApur);
                }
                if (isset($dev->infoperant)) {
                    $infoPerAnt = $this->dom->createElement("infoPerAnt");
                    foreach ($dev->infoperant->ideadc as $adc) {
                        $ideADC = $this->dom->createElement("ideADC");
                        $this->dom->addChild(
                            $ideADC,
                            "dtLei",
                            $adc->dtlei,
                            true
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "nrLei",
                            $adc->nrlei,
                            true
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "dtEf",
                            !empty($adc->dtef) ? $adc->dtef : null,
                            false
                        );
                        foreach ($adc->ideperiodo as $periodo) {
                            $idePeriodo = $this->dom->createElement("idePeriodo");
                            $this->dom->addChild(
                                $idePeriodo,
                                "perRef",
                                $periodo->perref,
                                true
                            );
                            foreach ($periodo->ideestab as $estab) {
                                $ideEstab = $this->dom->createElement("ideEstab");
                                $this->dom->addChild(
                                    $ideEstab,
                                    "tpInsc",
                                    $estab->tpinsc,
                                    true
                                );
                                $this->dom->addChild(
                                    $ideEstab,
                                    "nrInsc",
                                    $estab->nrinsc,
                                    true
                                );
                                foreach ($estab->remunperant as $perant) {
                                    $remunPerAnt = $this->dom->createElement("remunPerAnt");
                                    $this->dom->addChild(
                                        $remunPerAnt,
                                        "matricula",
                                        !empty($perant->matricula) ? $perant->matricula : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $remunPerAnt,
                                        "codCateg",
                                        $perant->codcateg,
                                        true
                                    );
                                    foreach ($perant->itensremun as $itens) {
                                        $itensRemun = $this->dom->createElement("itensRemun");
                                        $this->dom->addChild(
                                            $itensRemun,
                                            "codRubr",
                                            $itens->codrubr,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $itensRemun,
                                            "ideTabRubr",
                                            $itens->idetabrubr,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $itensRemun,
                                            "qtdRubr",
                                            !empty($itens->qtdrubr) ? $itens->qtdrubr : null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $itensRemun,
                                            "fatorRubr",
                                            !empty($itens->fatorrubr) ? $itens->fatorrubr : null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $itensRemun,
                                            "vrUnit",
                                            !empty($itens->vrunit) ? $itens->vrunit : null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $itensRemun,
                                            "vrRubr",
                                            $itens->vrrubr,
                                            true
                                        );
                                        $remunPerAnt->appendChild($itensRemun);
                                    }
                                    $ideEstab->appendChild($remunPerAnt);
                                }
                                $idePeriodo->appendChild($ideEstab);
                            }
                        }
                        $ideADC->appendChild($idePeriodo);
                    }
                    $infoPerAnt->appendChild($ideADC);
                }
                $dmDev->appendChild($infoPerAnt);
            }
        }
        if (!empty($dmDev)) {
            $this->node->appendChild($dmDev);
        }
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
