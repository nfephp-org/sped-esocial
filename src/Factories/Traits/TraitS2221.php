<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2221
{
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S_1.0 !!");
    }

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
        return $this->toNodeS100();
    }

    /**
     * builder for version S.1.2.0
     */
    protected function toNodeS120()
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
        $ideVinculo = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->idevinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            !empty($this->std->idevinculo->matricula) ? $this->std->idevinculo->matricula : null,
            false
        );
        $this->node->appendChild($ideVinculo);

        $toxicologico = $this->dom->createElement("toxicologico");
        $this->dom->addChild(
            $toxicologico,
            "dtExame",
            $this->std->toxicologico->dtexame,
            true
        );
        $this->dom->addChild(
            $toxicologico,
            "cnpjLab",
            $this->std->toxicologico->cnpjlab,
            true
        );
        $this->dom->addChild(
            $toxicologico,
            "codSeqExame",
            $this->std->toxicologico->codseqexame,
            true
        );
        $this->dom->addChild(
            $toxicologico,
            "nmMed",
            $this->std->toxicologico->nmmed,
            true
        );
        $this->dom->addChild(
            $toxicologico,
            "nrCRM",
            $this->std->toxicologico->nrcrm,
            true
        );
        $this->dom->addChild(
            $toxicologico,
            "ufCRM",
            $this->std->toxicologico->ufcrm,
            true
        );
        $this->node->appendChild($toxicologico);

        $this->eSocial->appendChild($this->node);

        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
