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
        
        $infoBenAlteracao = $this->dom->createElement("infoBenAlteracao");
        $this->dom->addChild(
            $infoBenAlteracao,
            "dtAltBeneficio",
            $this->std->infobenalteracao->dtaltbeneficio,
            true
        );
        $dadosBeneficio = $this->dom->createElement("dadosBeneficio");
        $this->dom->addChild(
            $dadosBeneficio,
            "tpBeneficio",
            $this->std->infobenalteracao->dadosbeneficio->tpbeneficio,
            true
        );
        $this->dom->addChild(
            $dadosBeneficio,
            "tpPlanRP",
            $this->std->infobenalteracao->dadosbeneficio->tpplanrp,
            true
        );
        if (isset($this->std->infobenalteracao->dadosbeneficio->dsc)) {
            $this->dom->addChild(
                $dadosBeneficio,
                "dsc",
                !empty($this->std->infobenalteracao->dadosbeneficio->dsc) ? $this->std->infobenalteracao->dadosbeneficio->dsc : null,
                false
            );
        }
        $this->dom->addChild(
            $dadosBeneficio,
            "indSuspensao",
            $this->std->infobenalteracao->dadosbeneficio->indsuspensao,
            true
        );
        if (!empty($this->std->infobenalteracao->dadosbeneficio->infopenmorte)) {
            $infoPenMorte = $this->dom->createElement("infoPenMorte");
            $this->dom->addChild(
                $infoPenMorte,
                "tpPenMorte",
                $this->std->infobenalteracao->dadosbeneficio->infopenmorte->tppenmorte,
                true
            );
            $dadosBeneficio->appendChild($infoPenMorte);
        }
        if (!empty($this->std->infobenalteracao->dadosbeneficio->suspensao)) {
            $suspensao = $this->dom->createElement("suspensao");
            $this->dom->addChild(
                $suspensao,
                "mtvSuspensao",
                $this->std->infobenalteracao->dadosbeneficio->suspensao->mtvsuspensao,
                true
            );
            if (isset($this->std->infobenalteracao->dadosbeneficio->suspensao->dscssuspensao)) {
                $this->dom->addChild(
                    $suspensao,
                    "dscSuspensao",
                    !empty($this->std->infobenalteracao->dadosbeneficio->suspensao->dscssuspensao)
                        ? $this->std->infobenalteracao->dadosbeneficio->suspensao->dscssuspensao
                        : null,
                    false
                );
            }
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
