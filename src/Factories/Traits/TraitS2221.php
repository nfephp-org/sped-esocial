<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2221
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
        $ide = $this->std->idevinculo;
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $ide->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            !empty($ide->nistrab) ? $ide->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            !empty($ide->matricula) ? $ide->matricula : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "codCateg",
            !empty($ide->codcateg) ? $ide->codcateg : null,
            false
        );
        $this->node->appendChild($ideVinculo);
        
        $toxic = $this->dom->createElement("toxicologico");
        $tox = $this->std->toxicologico;
        $this->dom->addChild(
            $toxic,
            "dtExame",
            $tox->dtexame,
            true
        );
        $this->dom->addChild(
            $toxic,
            "cnpjLab",
            !empty($tox->cnpjlab) ? $tox->cnpjlab : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "codSeqExame",
            !empty($tox->codseqexame) ? $tox->codseqexame : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "nmMed",
            !empty($tox->nmmed) ? $tox->nmmed : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "nrCRM",
            !empty($tox->nrcrm) ? $tox->nrcrm : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "ufCRM",
            !empty($tox->ufcrm) ? $tox->ufcrm : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "indRecusa",
            $tox->indrecusa,
            true
        );
        $this->node->appendChild($toxic);
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
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S_1.0 !!");
    }
}
