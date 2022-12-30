<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2420
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão 2.5.0 !!");
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
        if ($this->std->indretif == 2) {
            $this->dom->addChild(
                $ideEvento,
                "nrRecibo",
                $this->std->nrrecibo,
                true
            );
        }
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
        
        $ideBeneficio = $this->dom->createElement("ideBeneficio");
        $this->dom->addChild(
            $ideBeneficio,
            "cpfBenef",
            $this->std->idebeneficio->cpfbenef,
            true
        );
        $this->dom->addChild(
            $ideBeneficio,
            "nrBeneficio",
            $this->std->idebeneficio->nrbeneficio,
            true
        );
        $this->node->appendChild($ideBeneficio);
        
        $infoBenTermino = $this->dom->createElement("infoBenTermino");
        $this->dom->addChild(
            $infoBenTermino,
            "dtTermBeneficio",
            $this->std->infobentermino->dttermbeneficio,
            true
        );
        $this->dom->addChild(
            $infoBenTermino,
            "mtvTermino",
            $this->std->infobentermino->mtvtermino,
            true
        );
        if (isset($this->std->infobentermino->cnpjorgaosuc) && !empty($this->std->infobentermino->cnpjorgaosuc)) {
            $this->dom->addChild(
                $infoBenTermino,
                "cnpjOrgaoSuc",
                $this->std->infobentermino->cnpjorgaosuc,
                false
            );
        }
        if (isset($this->std->infobentermino->novocpf) && !empty($this->std->infobentermino->novocpf)) {
            $this->dom->addChild(
                $infoBenTermino,
                "novoCPF",
                $this->std->infobentermino->novocpf,
                false
            );
        }
        $this->node->appendChild($infoBenTermino);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
    
    /**
     * builder for version S.1.1.0
     */
    /**
     * TODO
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
        if ($this->std->indretif == 2) {
            $this->dom->addChild(
                $ideEvento,
                "nrRecibo",
                $this->std->nrrecibo,
                true
            );
        }
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
        
        $ideBeneficio = $this->dom->createElement("ideBeneficio");
        $this->dom->addChild(
            $ideBeneficio,
            "cpfBenef",
            $this->std->idebeneficio->cpfbenef,
            true
        );
        $this->dom->addChild(
            $ideBeneficio,
            "nrBeneficio",
            $this->std->idebeneficio->nrbeneficio,
            true
        );
        $this->node->appendChild($ideBeneficio);
        
        $infoBenTermino = $this->dom->createElement("infoBenTermino");
        $this->dom->addChild(
            $infoBenTermino,
            "dtTermBeneficio",
            $this->std->infobentermino->dttermbeneficio,
            true
        );
        $this->dom->addChild(
            $infoBenTermino,
            "mtvTermino",
            $this->std->infobentermino->mtvtermino,
            true
        );
        if (isset($this->std->infobentermino->cnpjorgaosuc) && !empty($this->std->infobentermino->cnpjorgaosuc)) {
            $this->dom->addChild(
                $infoBenTermino,
                "cnpjOrgaoSuc",
                $this->std->infobentermino->cnpjorgaosuc,
                false
            );
        }
        if (isset($this->std->infobentermino->novocpf) && !empty($this->std->infobentermino->novocpf)) {
            $this->dom->addChild(
                $infoBenTermino,
                "novoCPF",
                $this->std->infobentermino->novocpf,
                false
            );
        }
        $this->node->appendChild($infoBenTermino);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
