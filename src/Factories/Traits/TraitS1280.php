<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1280
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
            false
        );
        $this->dom->addChild(
            $ideEvento,
            "perApur",
            $this->std->perapur,
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
        if (isset($this->std->infosubstpatr)) {
            $infoSubstPatr = $this->dom->createElement("infoSubstPatr");
            $this->dom->addChild(
                $infoSubstPatr,
                "indSubstPatr",
                $this->std->infosubstpatr->indsubstpatr,
                true
            );
            $this->dom->addChild(
                $infoSubstPatr,
                "percRedContrib",
                $this->std->infosubstpatr->percpedcontrib,
                true
            );
            $this->node->appendChild($infoSubstPatr);
        }
        if (isset($this->std->infosubstpatropport)) {
            foreach ($this->std->infosubstpatropport as $info) {
                $infoSubstPatrOpPort = $this->dom->createElement("infoSubstPatrOpPort");
                $this->dom->addChild(
                    $infoSubstPatrOpPort,
                    "cnpjOpPortuario",
                    $info->cnpjopportuario,
                    true
                );
                $this->node->appendChild($infoSubstPatrOpPort);
            }
        }
        if (isset($this->std->infoativconcom)) {
            $infoAtivConcom = $this->dom->createElement("infoAtivConcom");
            $this->dom->addChild(
                $infoAtivConcom,
                "fatorMes",
                $this->std->infoativconcom->fatormes,
                true
            );
            $this->dom->addChild(
                $infoAtivConcom,
                "fator13",
                $this->std->infoativconcom->fator13,
                true
            );
            $this->node->appendChild($infoAtivConcom);
        }
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->sign();
        //$this->xml = $this->dom->saveXML($this->eSocial);
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
            "indGuia",
            !empty($this->std->indguia) ? $this->std->indguia : null,
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
        if (isset($this->std->infosubstpatr)) {
            $infoSubstPatr = $this->dom->createElement("infoSubstPatr");
            $this->dom->addChild(
                $infoSubstPatr,
                "indSubstPatr",
                $this->std->infosubstpatr->indsubstpatr,
                true
            );
            $this->dom->addChild(
                $infoSubstPatr,
                "percRedContrib",
                $this->std->infosubstpatr->percpedcontrib,
                true
            );
            $this->node->appendChild($infoSubstPatr);
        }
        if (isset($this->std->infosubstpatropport)) {
            foreach ($this->std->infosubstpatropport as $info) {
                $infoSubstPatrOpPort = $this->dom->createElement("infoSubstPatrOpPort");
                $this->dom->addChild(
                    $infoSubstPatrOpPort,
                    "codLotacao",
                    $info->codlotacao,
                    true
                );
                $this->node->appendChild($infoSubstPatrOpPort);
            }
        }
        if (isset($this->std->infoativconcom)) {
            $infoAtivConcom = $this->dom->createElement("infoAtivConcom");
            $this->dom->addChild(
                $infoAtivConcom,
                "fatorMes",
                $this->std->infoativconcom->fatormes,
                true
            );
            $this->dom->addChild(
                $infoAtivConcom,
                "fator13",
                $this->std->infoativconcom->fator13,
                true
            );
            $this->node->appendChild($infoAtivConcom);
        }
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
