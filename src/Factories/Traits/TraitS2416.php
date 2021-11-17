<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2416
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
            $this->std->cpfbenef,
            true
        );
        $this->dom->addChild(
            $ideBeneficio,
            "nrBeneficio",
            $this->std->nrbeneficio,
            true
        );
        $this->node->appendChild($ideBeneficio);
        
        $infoBenAlteracao = $this->dom->createElement("infoBenAlteracao");
        $this->dom->addChild(
            $infoBenAlteracao,
            "dtAltBeneficio",
            $this->std->dtaltbeneficio,
            true
        );
        $dadosBeneficio = $this->dom->createElement("dadosBeneficio");
        $this->dom->addChild(
            $dadosBeneficio,
            "tpBeneficio",
            $this->std->tpbeneficio,
            true
        );
        $this->dom->addChild(
            $dadosBeneficio,
            "tpPlanRP",
            $this->std->tpplanrp,
            true
        );
        $this->dom->addChild(
            $dadosBeneficio,
            "dsc",
            !empty($this->std->dsc) ? $this->std->dsc : null,
            false
        );
        $this->dom->addChild(
            $dadosBeneficio,
            "indSuspensao",
            $this->std->indsuspensao,
            true
        );
        if (!empty($this->std->infopenmorte)) {
            $infoPenMorte = $this->dom->createElement("infoPenMorte");
            $this->dom->addChild(
                $infoPenMorte,
                "tpPenMorte",
                $this->std->infopenmorte->tppenmorte,
                true
            );
            $dadosBeneficio->appendChild($infoPenMorte);
        }
        if (!empty($this->std->suspensao)) {
            $suspensao = $this->dom->createElement("suspensao");
            $this->dom->addChild(
                $suspensao,
                "mtvSuspensao",
                $this->std->suspensao->mtvsuspensao,
                true
            );
            $this->dom->addChild(
                $suspensao,
                "dscSuspensao",
                !empty($this->std->suspensao->dscssuspensao)
                    ? $this->std->suspensao->dscssuspensao
                    : null,
                false
            );
            $dadosBeneficio->appendChild($suspensao);
        }
        $infoBenAlteracao->appendChild($dadosBeneficio);
        $this->node->appendChild($infoBenAlteracao);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
