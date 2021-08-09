<?php

namespace NFePHP\eSocial\Factories\Traits;

use NFePHP\eSocial\Common\FactoryId;

trait TraitS1280
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );

        $evtInfoComplPer = $this->dom->createElement("evtInfoComplPer");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtInfoComplPer->appendChild($att);

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);

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
            $this->std->nrrecibo,
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

        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
         throw new \Exception("TODO !!");
    }
}
