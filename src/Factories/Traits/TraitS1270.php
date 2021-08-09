<?php

namespace NFePHP\eSocial\Factories\Traits;

use NFePHP\eSocial\Common\FactoryId;

trait TraitS1270
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        $evtid          = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );

        $evtContratAvNP = $this->dom->createElement("evtContratAvNP");

        $att            = $this->dom->createAttribute('Id');

        $att->value     = $evtid;

        $evtContratAvNP->appendChild($att);

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

        if (isset($this->std->remunavnp)) {
            foreach ($this->std->remunavnp as $remun) {
                $remunAvNP = $this->dom->createElement("remunAvNP");

                $this->dom->addChild(
                    $remunAvNP,
                    "tpInsc",
                    $remun->tpinsc,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "nrInsc",
                    $remun->nrinsc,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "codLotacao",
                    $remun->codlotacao,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp00",
                    $remun->vrbccp00,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp15",
                    $remun->vrbccp15,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp20",
                    $remun->vrbccp20,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp25",
                    $remun->vrbccp25,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcCp13",
                    $remun->vrbccp13,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrBcFgts",
                    $remun->vrbcfgts,
                    true
                );

                $this->dom->addChild(
                    $remunAvNP,
                    "vrDescCP",
                    $remun->vrdesccp,
                    true
                );

                $this->node->appendChild($remunAvNP);
            }
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
