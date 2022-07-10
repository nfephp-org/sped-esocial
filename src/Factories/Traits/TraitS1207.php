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
}
