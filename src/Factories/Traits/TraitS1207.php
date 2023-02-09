<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1207
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
        $ideBenef = $this->dom->createElement("ideBenef");
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        $this->node->appendChild($ideBenef);
        if (isset($this->std->dmdev)) {
            foreach ($this->std->dmdev as $dev) {
                $dmDev = $this->dom->createElement("dmDev");
                $this->dom->addChild(
                    $dmDev,
                    "tpBenef",
                    $dev->tpbenef,
                    true
                );
                $this->dom->addChild(
                    $dmDev,
                    "nrBenefic",
                    $dev->nrbenefic,
                    true
                );
                $this->dom->addChild(
                    $dmDev,
                    "ideDmDev",
                    $dev->idedmdev,
                    true
                );
                if (isset($dev->itens)) {
                    foreach ($dev->itens as $item) {
                        $itens = $this->dom->createElement("itens");
                        $this->dom->addChild(
                            $itens,
                            "codRubr",
                            $item->codrubr,
                            true
                        );
                        $this->dom->addChild(
                            $itens,
                            "ideTabRubr",
                            $item->idetabrubr,
                            true
                        );
                        $this->dom->addChild(
                            $itens,
                            "vrRubr",
                            $item->vrrubr,
                            true
                        );
                        $dmDev->appendChild($itens);
                    }
                }
                $this->node->appendChild($dmDev);
            }
        }
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
        $ideBenef = $this->dom->createElement("ideBenef");
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->idebenef->cpfbenef,
            true
        );
        $this->node->appendChild($ideBenef);
        if (isset($this->std->dmdev)) {
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
                if (isset($dev->infoperapur) && isset($dev->infoperapur->ideestab)) {
                    $infoperapur = $this->dom->createElement("infoPerApur");
                    foreach ($dev->infoperapur->ideestab as $ideestab) {
                        $estab = $this->dom->createElement("ideEstab");
                        $this->dom->addChild(
                            $estab,
                            "tpInsc",
                            $ideestab->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $estab,
                            "nrInsc",
                            $ideestab->nrinsc,
                            true
                        );                      
                        foreach ($ideestab->itensremun as $itemremun) {
                            $itens = $this->dom->createElement("itensRemun");
                            $this->dom->addChild(
                                $itens,
                                "codRubr",
                                $itemremun->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itens,
                                "ideTabRubr",
                                $itemremun->idetabrubr,
                                true
                            );
                            if (isset($itemremun->qtdrubr) && !empty($itemremun->qtdrubr)) {
                                $this->dom->addChild(
                                    $itens,
                                    "qtdRubr",
                                    $itemremun->qtdrubr,
                                    true
                                );
                            }
                            if (isset($itemremun->fatorrubr) && !empty($itemremun->fatorrubr)) {
                                $this->dom->addChild(
                                    $itens,
                                    "fatorRubr",
                                    $itemremun->fatorrubr,
                                    true
                                );
                            }
                            $this->dom->addChild(
                                $itens,
                                "vrRubr",
                                $itemremun->vrrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itens,
                                "indApurIR",
                                $itemremun->indapurir,
                                true
                            );
                            $estab->appendChild($itens);
                        }
                        $infoperapur->appendChild($estab);
                    }
                    $dmDev->appendChild($infoperapur);
                }
                if (isset($dev->infoapurant) && isset($dev->infoapurant->ideperiodo)) {
                    $infoperant = $this->dom->createElement("infoPerAnt");
                    foreach ($dev->infoapurant->ideperiodo as $ideperiodo) {
                        $periodo = $this->dom->createElement("idePeriodo");
                        $this->dom->addChild(
                            $periodo,
                            "perRef",
                            $ideperiodo->perref,
                            true
                        );
                        foreach ($ideperiodo->ideestab as $ideestab) {
                            $estab = $this->dom->createElement("ideEstab");
                            $this->dom->addChild(
                                $estab,
                                "tpInsc",
                                $ideestab->tpinsc,
                                true
                            );
                            $this->dom->addChild(
                                $estab,
                                "nrInsc",
                                $ideestab->nrinsc,
                                true
                            );                      
                            foreach ($ideestab->itensremun as $itemremun) {
                                $itens = $this->dom->createElement("itensRemun");
                                $this->dom->addChild(
                                    $itens,
                                    "codRubr",
                                    $itemremun->codrubr,
                                    true
                                );
                                $this->dom->addChild(
                                    $itens,
                                    "ideTabRubr",
                                    $itemremun->idetabrubr,
                                    true
                                );
                                if (isset($item->qtdrubr) && !empty($item->qtdrubr)) {
                                    $this->dom->addChild(
                                        $itens,
                                        "qtdRubr",
                                        $itemremun->qtdrubr,
                                        true
                                    );
                                }
                                if (isset($itemremun->fatorrubr) && !empty($itemremun->fatorrubr)) {
                                    $this->dom->addChild(
                                        $itens,
                                        "fatorRubr",
                                        $itemremun->fatorrubr,
                                        true
                                    );
                                }
                                $this->dom->addChild(
                                    $itens,
                                    "vrRubr",
                                    $itemremun->vrrubr,
                                    true
                                );
                                $this->dom->addChild(
                                    $itens,
                                    "indApurIR",
                                    $itemremun->indapurir,
                                    true
                                );
                                $estab->appendChild($itens);
                            }
                            $periodo->appendChild($estab);
                        }
                        $infoperant->appendChild($periodo);
                    }
                    $dmDev->appendChild($infoperant);
                }
                $this->node->appendChild($dmDev);
            }
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
            $this->std->idebenef->cpfbenef,
            true
        );
        $this->node->appendChild($ideBenef);
        if (isset($this->std->dmdev)) {
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
                if (isset($dev->infoperapur) && isset($dev->infoperapur->ideestab)) {
                    $infoperapur = $this->dom->createElement("infoPerApur");
                    foreach ($dev->infoperapur->ideestab as $ideestab) {
                        $estab = $this->dom->createElement("ideEstab");
                        $this->dom->addChild(
                            $estab,
                            "tpInsc",
                            $ideestab->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $estab,
                            "nrInsc",
                            $ideestab->nrinsc,
                            true
                        );                      
                        foreach ($ideestab->itensremun as $itemremun) {
                            $itens = $this->dom->createElement("itensRemun");
                            $this->dom->addChild(
                                $itens,
                                "codRubr",
                                $itemremun->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itens,
                                "ideTabRubr",
                                $itemremun->idetabrubr,
                                true
                            );
                            if (isset($itemremun->qtdrubr) && !empty($itemremun->qtdrubr)) {
                                $this->dom->addChild(
                                    $itens,
                                    "qtdRubr",
                                    $itemremun->qtdrubr,
                                    true
                                );
                            }
                            if (isset($itemremun->fatorrubr) && !empty($itemremun->fatorrubr)) {
                                $this->dom->addChild(
                                    $itens,
                                    "fatorRubr",
                                    $itemremun->fatorrubr,
                                    true
                                );
                            }
                            $this->dom->addChild(
                                $itens,
                                "vrRubr",
                                $itemremun->vrrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itens,
                                "indApurIR",
                                $itemremun->indapurir,
                                true
                            );
                            $estab->appendChild($itens);
                        }
                        $infoperapur->appendChild($estab);
                    }
                    $dmDev->appendChild($infoperapur);
                }
                if (isset($dev->infoapurant) && isset($dev->infoapurant->ideperiodo)) {
                    $infoperant = $this->dom->createElement("infoPerAnt");
                    foreach ($dev->infoapurant->ideperiodo as $ideperiodo) {
                        $periodo = $this->dom->createElement("idePeriodo");
                        $this->dom->addChild(
                            $periodo,
                            "perRef",
                            $ideperiodo->perref,
                            true
                        );
                        foreach ($ideperiodo->ideestab as $ideestab) {
                            $estab = $this->dom->createElement("ideEstab");
                            $this->dom->addChild(
                                $estab,
                                "tpInsc",
                                $ideestab->tpinsc,
                                true
                            );
                            $this->dom->addChild(
                                $estab,
                                "nrInsc",
                                $ideestab->nrinsc,
                                true
                            );                      
                            foreach ($ideestab->itensremun as $itemremun) {
                                $itens = $this->dom->createElement("itensRemun");
                                $this->dom->addChild(
                                    $itens,
                                    "codRubr",
                                    $itemremun->codrubr,
                                    true
                                );
                                $this->dom->addChild(
                                    $itens,
                                    "ideTabRubr",
                                    $itemremun->idetabrubr,
                                    true
                                );
                                if (isset($item->qtdrubr) && !empty($item->qtdrubr)) {
                                    $this->dom->addChild(
                                        $itens,
                                        "qtdRubr",
                                        $itemremun->qtdrubr,
                                        true
                                    );
                                }
                                if (isset($itemremun->fatorrubr) && !empty($itemremun->fatorrubr)) {
                                    $this->dom->addChild(
                                        $itens,
                                        "fatorRubr",
                                        $itemremun->fatorrubr,
                                        true
                                    );
                                }
                                $this->dom->addChild(
                                    $itens,
                                    "vrRubr",
                                    $itemremun->vrrubr,
                                    true
                                );
                                $this->dom->addChild(
                                    $itens,
                                    "indApurIR",
                                    $itemremun->indapurir,
                                    true
                                );
                                $estab->appendChild($itens);
                            }
                            $periodo->appendChild($estab);
                        }
                        $infoperant->appendChild($periodo);
                    }
                    $dmDev->appendChild($infoperant);
                }
                $this->node->appendChild($dmDev);
            }
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

}
