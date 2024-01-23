<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1207
{
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
        $ideBenef = $this->dom->createElement("ideBenef");
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        $this->node->appendChild($ideBenef);

        foreach ($this->std->dmdev as $dev) {
            $dmDev = $this->dom->createElement("dmDev");
            $this->dom->addChild(
                $dmDev,
                "ideDmDev",
                $dev->idedmdev,
                true
            );
            $this->dom->addChild(
                $dmDev,
                "nrBeneficio",
                $dev->nrbeneficio,
                true
            );
            if (!empty($dev->infoperapur)) {
                $perapur = $this->dom->createElement("infoPerApur");
                foreach ($dev->infoperapur->ideestab as $ide) {
                    $ideestab = $this->dom->createElement("ideEstab");
                    $this->dom->addChild(
                        $ideestab,
                        "tpInsc",
                        $ide->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideestab,
                        "nrInsc",
                        $ide->nrinsc,
                        true
                    );
                    foreach ($ide->itensremun as $rem) {
                        $item = $this->dom->createElement("itensRemun");
                        $this->dom->addChild(
                            $item,
                            "codRubr",
                            $rem->codrubr,
                            true
                        );
                        $this->dom->addChild(
                            $item,
                            "ideTabRubr",
                            $rem->idetabrubr,
                            true
                        );
                        $this->dom->addChild(
                            $item,
                            "qtdRubr",
                            !empty($rem->qtdrubr) ? $rem->qtdrubr : null,
                            false
                        );
                        $this->dom->addChild(
                            $item,
                            "fatorRubr",
                            !empty($rem->fatorrubr) ? $rem->fatorrubr : null,
                            false
                        );
                        $this->dom->addChild(
                            $item,
                            "vrRubr",
                            $rem->vrrubr,
                            true
                        );
                         $this->dom->addChild(
                             $item,
                             "indApurIR",
                             $rem->indapurir,
                             true
                         );
                        $ideestab->appendChild($item);
                    }
                    $perapur->appendChild($ideestab);
                }
                $dmDev->appendChild($perapur);
            }
            if (!empty($dev->infoperant)) {
                $perant = $this->dom->createElement("infoPerAnt");
                foreach ($dev->infoperant->ideperiodo as $per) {
                    $periodo = $this->dom->createElement("idePeriodo");
                    $this->dom->addChild(
                        $periodo,
                        "perRef",
                        $per->perref,
                        true
                    );
                    foreach ($per->ideestab as $ide) {
                        $ideestab = $this->dom->createElement("ideEstab");
                        $this->dom->addChild(
                            $ideestab,
                            "tpInsc",
                            $ide->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $ideestab,
                            "nrInsc",
                            $ide->nrinsc,
                            true
                        );
                        foreach ($ide->itensremun as $rem) {
                            $item = $this->dom->createElement("itensRemun");
                            $this->dom->addChild(
                                $item,
                                "codRubr",
                                $rem->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $item,
                                "ideTabRubr",
                                $rem->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $item,
                                "qtdRubr",
                                !empty($rem->qtdrubr) ? $rem->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $item,
                                "fatorRubr",
                                !empty($rem->fatorrubr) ? $rem->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $item,
                                "vrRubr",
                                $rem->vrrubr,
                                true
                            );
                             $this->dom->addChild(
                                 $item,
                                 "indApurIR",
                                 $rem->indapurir,
                                 true
                             );
                            $ideestab->appendChild($item);
                        }
                        $periodo->appendChild($ideestab);
                    }
                    $perant->appendChild($periodo);
                }
                $dmDev->appendChild($perant);
            }
            $this->node->appendChild($dmDev);
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
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
        $ideBenef = $this->dom->createElement("ideBenef");
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        $this->node->appendChild($ideBenef);

        foreach ($this->std->dmdev as $dev) {
            $dmDev = $this->dom->createElement("dmDev");
            $this->dom->addChild(
                $dmDev,
                "ideDmDev",
                $dev->idedmdev,
                true
            );
            $this->dom->addChild(
                $dmDev,
                "nrBeneficio",
                $dev->nrbeneficio,
                true
            );
            $this->dom->addChild(
                $dmDev,
                "indRRA",
                $dev->indrra ?? null,
                false
            );
            if (!empty($dev->inforra)) {
                $irra = $dev->inforra;
                $rra = $this->dom->createElement("infoRRA");
                $this->dom->addChild(
                    $rra,
                    "tpProcRRA",
                    $irra->tpprocrra,
                    true
                );
                $this->dom->addChild(
                    $rra,
                    "nrProcRRA",
                    $irra->nrprocrra,
                    true
                );
                $this->dom->addChild(
                    $rra,
                    "descRRA",
                    $irra->descrra,
                    true
                );
                $this->dom->addChild(
                    $rra,
                    "qtdMesesRRA",
                    $irra->qtdmesesrra,
                    true
                );
                if (!empty($irra->despprocjud)) {
                    $jud = $this->dom->createElement("despProcJud");
                    $this->dom->addChild(
                        $jud,
                        "vlrDespCustas",
                        $irra->despprocjud->vlrdespcustas,
                        true
                    );
                    $this->dom->addChild(
                        $jud,
                        "vlrDespAdvogados",
                        $irra->despprocjud->vlrdespadvogados,
                        true
                    );
                    $rra->appendChild($jud);
                }
                if (!empty($irra->ideadv)) {
                    foreach ($irra->ideadv as $adv) {
                        $ideadv = $this->dom->createElement("ideAdv");
                        $this->dom->addChild(
                            $ideadv,
                            "tpInsc",
                            $adv->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $ideadv,
                            "nrInsc",
                            $adv->nrinsc,
                            true
                        );
                        $rra->appendChild($ideadv);
                    }
                }
                $dmDev->appendChild($rra);
            }
            if (!empty($dev->infoperapur)) {
                $perapur = $this->dom->createElement("infoPerApur");
                foreach ($dev->infoperapur->ideestab as $ide) {
                    $ideestab = $this->dom->createElement("ideEstab");
                    $this->dom->addChild(
                        $ideestab,
                        "tpInsc",
                        $ide->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideestab,
                        "nrInsc",
                        $ide->nrinsc,
                        true
                    );
                    foreach ($ide->itensremun as $rem) {
                        $item = $this->dom->createElement("itensRemun");
                        $this->dom->addChild(
                            $item,
                            "codRubr",
                            $rem->codrubr,
                            true
                        );
                        $this->dom->addChild(
                            $item,
                            "ideTabRubr",
                            $rem->idetabrubr,
                            true
                        );
                        $this->dom->addChild(
                            $item,
                            "qtdRubr",
                            !empty($rem->qtdrubr) ? $rem->qtdrubr : null,
                            false
                        );
                        $this->dom->addChild(
                            $item,
                            "fatorRubr",
                            !empty($rem->fatorrubr) ? $rem->fatorrubr : null,
                            false
                        );
                        $this->dom->addChild(
                            $item,
                            "vrRubr",
                            $rem->vrrubr,
                            true
                        );
                        $this->dom->addChild(
                            $item,
                            "indApurIR",
                            $rem->indapurir,
                            true
                        );
                        $ideestab->appendChild($item);
                    }
                    $perapur->appendChild($ideestab);
                }
                $dmDev->appendChild($perapur);
            }
            if (!empty($dev->infoperant)) {
                $perant = $this->dom->createElement("infoPerAnt");
                foreach ($dev->infoperant->ideperiodo as $per) {
                    $periodo = $this->dom->createElement("idePeriodo");
                    $this->dom->addChild(
                        $periodo,
                        "perRef",
                        $per->perref,
                        true
                    );
                    foreach ($per->ideestab as $ide) {
                        $ideestab = $this->dom->createElement("ideEstab");
                        $this->dom->addChild(
                            $ideestab,
                            "tpInsc",
                            $ide->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $ideestab,
                            "nrInsc",
                            $ide->nrinsc,
                            true
                        );
                        foreach ($ide->itensremun as $rem) {
                            $item = $this->dom->createElement("itensRemun");
                            $this->dom->addChild(
                                $item,
                                "codRubr",
                                $rem->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $item,
                                "ideTabRubr",
                                $rem->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $item,
                                "qtdRubr",
                                !empty($rem->qtdrubr) ? $rem->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $item,
                                "fatorRubr",
                                !empty($rem->fatorrubr) ? $rem->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $item,
                                "vrRubr",
                                $rem->vrrubr,
                                true
                            );
                            $this->dom->addChild(
                                $item,
                                "indApurIR",
                                $rem->indapurir,
                                true
                            );
                            $ideestab->appendChild($item);
                        }
                        $periodo->appendChild($ideestab);
                    }
                    $perant->appendChild($periodo);
                }
                $dmDev->appendChild($perant);
            }
            $this->node->appendChild($dmDev);
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    /**
     * builder for version S.1.2.0
     */
    protected function toNodeS120()
    {
        return $this->toNodeS110();
    }
}
