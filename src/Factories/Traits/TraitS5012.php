<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS5012
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
            "perApur",
            $this->std->perapur,
            true
        );
        $this->node->insertBefore($ideEvento, $ideEmpregador);

        //tag deste evento em particular
        $infoIrrf = $this->dom->createElement("infoIRRF");
        $this->dom->addChild(
            $infoIrrf,
            "nrRecArqBase",
            ! empty($this->std->infoirrf->nrrecarqbase) ? $this->std->infoirrf->nrrecarqbase : '',
            false
        );
        $this->dom->addChild(
            $infoIrrf,
            "indExistInfo",
            $this->std->infoirrf->indexistinfo,
            true
        );

        if (isset($this->std->infocrcontrib)) {
            foreach ($this->std->infocrcontrib as $infoc) {
                $infocontrib = $this->dom->createElement("infoCRContrib");
                $this->dom->addChild(
                    $infocontrib,
                    "tpCR",
                    $infoc->tpcr,
                    true
                );
                $this->dom->addChild(
                    $infocontrib,
                    "vrCR",
                    $infoc->vrcr,
                    true
                );
                $infoIrrf->appendChild($infocontrib);
            }
        }
        $this->node->appendChild($infoIrrf);

        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S_1.0 !!");
    }
}
