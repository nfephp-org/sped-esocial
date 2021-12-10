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
}
