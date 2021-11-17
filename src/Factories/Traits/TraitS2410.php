<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2410
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
        
        $beneficiario = $this->dom->createElement("beneficiario");
        $this->dom->addChild(
            $beneficiario,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "matricula",
            !empty($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->dom->addChild(
            $beneficiario,
            "cnpjOrigem",
            !empty($this->std->cnpjorigem) ? $this->std->cnpjorigem : null,
            false
        );
        $this->node->appendChild($beneficiario);
        
        $infoBenInicio = $this->dom->createElement("infoBenInicio");
        $this->dom->addChild(
            $infoBenInicio,
            "cadIni",
            $this->std->cadini,
            true
        );
        $this->dom->addChild(
            $infoBenInicio,
            "indSitBenef",
            !empty($this->std->indsitbenef) ? $this->std->indsitbenef : null,
            false
        );
        $this->dom->addChild(
            $infoBenInicio,
            "nrBeneficio",
            $this->std->nrbeneficio,
            true
        );
        $this->dom->addChild(
            $infoBenInicio,
            "dtIniBeneficio",
            $this->std->dtinibeneficio,
            true
        );
        $this->dom->addChild(
            $infoBenInicio,
            "dtPublic",
            !empty($this->std->dtpublic) ? $this->std->dtpublic : null,
            false
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
            "indDecJud",
            !empty($this->std->inddecjud) ? $this->std->inddecjud : null,
            false
        );
        
        if (!empty($this->std->infopenmorte)) {
            $infoPenMorte = $this->dom->createElement("infoPenMorte");
            $this->dom->addChild(
                $infoPenMorte,
                "tpPenMorte",
                $this->std->infopenmorte->tppenmorte,
                true
            );
            if (!empty($this->std->infopenmorte->instpenmorte)) {
                $instPenMorte = $this->dom->createElement("instPenMorte");
                $this->dom->addChild(
                    $instPenMorte,
                    "cpfInst",
                    $this->std->infopenmorte->instpenmorte->cpfinst,
                    true
                );
                $this->dom->addChild(
                    $instPenMorte,
                    "dtInst",
                    $this->std->infopenmorte->instpenmorte->dtinst,
                    true
                );
                $infoPenMorte->appendChild($instPenMorte);
            }
            $dadosBeneficio->appendChild($infoPenMorte);
        }
        $infoBenInicio->appendChild($dadosBeneficio);
        
        if (!empty($this->std->sucessaobenef)) {
            $sucessaoBenef = $this->dom->createElement("sucessaoBenef");
            $this->dom->addChild(
                $sucessaoBenef,
                "cnpjOrgaoAnt",
                $this->std->sucessaobenef->cnpjorgaoant,
                true
            );
            $this->dom->addChild(
                $sucessaoBenef,
                "nrBeneficioAnt",
                $this->std->sucessaobenef->nrbeneficioant,
                true
            );
            $this->dom->addChild(
                $sucessaoBenef,
                "dtTransf",
                $this->std->sucessaobenef->dttransf,
                true
            );
            $this->dom->addChild(
                $sucessaoBenef,
                "observacao",
                !empty($this->std->sucessaobenef->observacao)
                 ? $this->std->sucessaobenef->observacao : null,
                false
            );
            $infoBenInicio->appendChild($sucessaoBenef);
        }
        
        if (!empty($this->std->mudancacpf)) {
            $mudancaCPF = $this->dom->createElement("mudancaCPF");
            $this->dom->addChild(
                $mudancaCPF,
                "cpfAnt",
                $this->std->mudancacpf->cpfant,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "nrBeneficioAnt",
                $this->std->mudancacpf->nrbeneficioant,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "dtAltCPF",
                $this->std->mudancacpf->dtaltcpf,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "observacao",
                !empty($this->std->mudancacpf->observacao)
                 ? $this->std->mudancacpf->observacao : null,
                false
            );
            $infoBenInicio->appendChild($mudancaCPF);
        }
        
        if (!empty($this->std->infobentermino)) {
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
            $infoBenInicio->appendChild($infoBenTermino);
        }
        
        $this->node->appendChild($infoBenInicio);
        
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
