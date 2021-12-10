<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1202
{
    
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
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
        //tag procJud
        $this->procJud($ideTrabalhador, $this->std);
        $this->node->appendChild($ideTrabalhador);

        $dmDev = null;
        if (isset($this->std->dmdev)) {
            foreach ($this->std->dmdev as $dev) {
                $dmDev = $this->dom->createElement("dmDev");
                $this->dom->addChild(
                    $dmDev,
                    "ideDmDev",
                    $dev->idedmdev,
                    true
                );
                //add infoPerApur to dmDev
                $this->infoperapur($dmDev, $dev);
                //add infoperant to dmDev
                $this->infoperant($dmDev, $dev);
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

    
        /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
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
            $this->std->cpftrab,
            true
        );
        
        if (!empty($this->std->infocomplem)) {
            $info = $this->dom->createElement("infoComplem");
            $this->dom->addChild(
                $info,
                "nmTrab",
                $this->std->infocomplem->nmtrab,
                true
            );
            $this->dom->addChild(
                $info,
                "dtNascto",
                $this->std->infocomplem->dtnascto,
                true
            );
            if (!empty($this->std->infocomplem->sucessaovinc)) {
                $vin =  $this->std->infocomplem->sucessaovinc;
                $succ = $this->dom->createElement("sucessaoVinc");
                $this->dom->addChild(
                    $succ,
                    "cnpjOrgaoAnt",
                    $vin->cnpjorgaoant,
                    true
                );
                $this->dom->addChild(
                    $succ,
                    "matricAnt",
                    !empty($vin->matricant) ? $vin->matricant : null,
                    false
                );
                $this->dom->addChild(
                    $succ,
                    "dtExercicio",
                    $vin->dtexercicio,
                    true
                );
                $this->dom->addChild(
                    $succ,
                    "observacao",
                    !empty($vin->observacao) ? $vin->observacao : null,
                    false
                );
                $info->appendChild($succ);
            }
            $ideTrabalhador->appendChild($info);
        }
        $this->node->appendChild($ideTrabalhador);
        foreach ($this->std->dmdev as $dm) {
            $dmdev = $this->dom->createElement("dmDev");
            $this->dom->addChild(
                $dmdev,
                "ideDmDev",
                $dm->idedmdev,
                true
            );
            $this->dom->addChild(
                $dmdev,
                "codCateg",
                $dm->codcateg,
                true
            );
            if (!empty($dm->infoperapur)) {
                $perapur = $this->dom->createElement("infoPerApur");
                foreach ($dm->infoperapur->ideestab as $est) {
                    $ideestab = $this->dom->createElement("ideEstab");
                    $this->dom->addChild(
                        $ideestab,
                        "tpInsc",
                        $est->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideestab,
                        "nrInsc",
                        $est->nrinsc,
                        true
                    );
                    foreach ($est->remunperapur as $rem) {
                        $remum = $this->dom->createElement("remunPerApur");
                        $this->dom->addChild(
                            $remum,
                            "matricula",
                            !empty($rem->matricula) ? $rem->matricula : null,
                            false
                        );
                        foreach ($rem->itensremun as $item) {
                            $itemremum = $this->dom->createElement("itensRemun");
                            $this->dom->addChild(
                                $itemremum,
                                "codRubr",
                                $item->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itemremum,
                                "ideTabRubr",
                                $item->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itemremum,
                                "qtdRubr",
                                !empty($item->qtdrubr) ? $item->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $itemremum,
                                "fatorRubr",
                                !empty($item->fatorrubr) ? $item->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $itemremum,
                                "vrRubr",
                                $item->vrrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itemremum,
                                "indApurIR",
                                $item->indapurir,
                                true
                            );
                            $remum->appendChild($itemremum);
                        }
                        $ideestab->appendChild($remum);
                    }
                    $perapur->appendChild($ideestab);
                }
                $dmdev->appendChild($perapur);
            }
            if (!empty($dm->infoperant)) {
                $perant = $this->dom->createElement("infoPerAnt");
                $this->dom->addChild(
                    $perant,
                    "remunOrgSuc",
                    $dm->infoperant->remunorgsuc,
                    true
                );
                foreach ($dm->infoperant->ideperiodo as $per) {
                    $ide = $this->dom->createElement("idePeriodo");
                    $this->dom->addChild(
                        $ide,
                        "perRef",
                        $per->perref,
                        true
                    );
                    foreach ($per->ideestab as $estab) {
                        $iest = $this->dom->createElement("ideEstab");
                        $this->dom->addChild(
                            $iest,
                            "tpInsc",
                            $estab->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $iest,
                            "nrInsc",
                            $estab->nrinsc,
                            true
                        );
                        foreach ($estab->remumperant as $rpa) {
                            $rempa = $this->dom->createElement("remunPerAnt");
                            $this->dom->addChild(
                                $rempa,
                                "matricula",
                                !empty($rpa->matricula) ? $rpa->matricula : null,
                                false
                            );
                            foreach ($rem->itensremun as $item) {
                                $itemrpa = $this->dom->createElement("itensRemun");
                                $this->dom->addChild(
                                    $itemrpa,
                                    "codRubr",
                                    $item->codrubr,
                                    true
                                );
                                $this->dom->addChild(
                                    $itemrpa,
                                    "ideTabRubr",
                                    $item->idetabrubr,
                                    true
                                );
                                $this->dom->addChild(
                                    $itemrpa,
                                    "qtdRubr",
                                    !empty($item->qtdrubr) ? $item->qtdrubr : null,
                                    false
                                );
                                $this->dom->addChild(
                                    $itemrpa,
                                    "fatorRubr",
                                    !empty($item->fatorrubr) ? $item->fatorrubr : null,
                                    false
                                );
                                $this->dom->addChild(
                                    $itemrpa,
                                    "vrRubr",
                                    $item->vrrubr,
                                    true
                                );
                                $this->dom->addChild(
                                    $itemrpa,
                                    "indApurIR",
                                    $item->indapurir,
                                    true
                                );
                                $rempa->appendChild($itemrpa);
                            }
                            $iest->appendChild($rempa);
                        }
                        $ide->appendChild($iest);
                    }
                    $perant->appendChild($ide);
                }
                $dmdev->appendChild($perant);
            }
            $this->node->appendChild($dmdev);
        }
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
    
    /**
     * Add ProcJud to ideTrabalhador
     * @param \DOMElement $node
     * @param \stdClass $std
     * @return none
     */
    private function procJud(&$node, $std)
    {
        if (!isset($std->idetrabalhador->procjudtrab)) {
            return;
        }
        foreach ($std->idetrabalhador->procjudtrab as $proc) {
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
            $node->appendChild($procJudTrab);
        }
    }

    /**
     * Add infoPerApur to dmDev
     * @param \DOMElement $node
     * @param \stdClass $std
     * @return none
     */
    private function infoperapur(&$node, $std)
    {
        if (!isset($std->infoperapur)) {
            return;
        }
        $infoPerApur = $this->dom->createElement("infoPerApur");
        $this->ideestab($infoPerApur, $std);
        $node->appendChild($infoPerApur);
    }

    /**
     * Add idestab to infoperapur
     * @param \DOMElementtype $node
     * @param \stdClass $std
     */
    private function ideestab(&$node, $std)
    {
        foreach ($std->infoperapur->ideestab as $estab) {
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
            //add remunperapur to ideEstab
            $this->remunperapur($ideEstab, $estab);
            $node->appendChild($ideEstab);
        }
    }

    /**
     * Add remunperapur to ideEstab
     * @param \DOMElement $node
     * @param \stdClass $std
     */
    private function remunperapur(&$node, $std)
    {
        foreach ($std->remunperapur as $remun) {
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
            //add itensremun to remunPerApur
            $this->itensremun($remunPerApur, $remun);
            //add infosaudecolet to remunPerApur
            $this->infosaudecolet($remunPerApur, $remun);
            $node->appendChild($remunPerApur);
        }
    }

    /**
     * Add itensremun to remunPerApur
     * @param \DOMElement $node
     * @param \stdClass $std
     */
    private function itensremun(&$node, $std)
    {
        foreach ($std->itensremun as $itens) {
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
            $node->appendChild($itensRemun);
        }
    }

    /**
     * Add infosaudecolet to remunPerApur
     * @param type $node
     * @param type $std
     * @return type
     */
    private function infosaudecolet(&$node, $std)
    {
        if (!isset($std->infosaudecolet)) {
            return;
        }
        $infoSaudeColet = $this->dom->createElement("infoSaudeColet");
        foreach ($std->infosaudecolet->detoper as $oper) {
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
        $node->appendChild($infoSaudeColet);
    }

    /**
     * Add infoperant to dmDev
     * @param type $node
     * @param type $std
     * @return type
     */
    private function infoperant(&$node, $std)
    {
        if (!isset($std->infoperant)) {
            return;
        }
        $infoPerAnt = $this->dom->createElement("infoPerAnt");
        //add ideadc to infoPerAnt
        $this->ideadc($infoPerAnt, $std);
        $node->appendChild($infoPerAnt);
    }

    /**
     * Add ideadc to infoPerAnt
     * @param \DOMElement $node
     * @param \stdClass $std
     */
    private function ideadc(&$node, $std)
    {
        foreach ($std->infoperant->ideadc as $adc) {
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
            //add ideperiodo to ideADC
            $this->ideperiodo($ideADC, $adc);
            $node->appendChild($ideADC);
        }
    }

    /**
     * Add ideperiodo to ideADC
     * @param \DOMElement $node
     * @param \stdClass $std
     */
    private function ideperiodo(&$node, $std)
    {
        foreach ($std->ideperiodo as $periodo) {
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
            $node->appendChild($idePeriodo);
        }
    }
}
