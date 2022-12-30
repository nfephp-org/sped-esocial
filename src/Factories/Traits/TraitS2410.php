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
            $this->std->beneficiario->cpfbenef,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "matricula",
            !empty($this->std->beneficiario->matricula) ? $this->std->beneficiario->matricula : null,
            false
        );
        $this->dom->addChild(
            $beneficiario,
            "cnpjOrigem",
            !empty($this->std->beneficiario->cnpjorigem) ? $this->std->beneficiario->cnpjorigem : null,
            false
        );
        $this->node->appendChild($beneficiario);
        
        $infoBenInicio = $this->dom->createElement("infoBenInicio");
        $this->dom->addChild(
            $infoBenInicio,
            "cadIni",
            $this->std->infobeninicio->cadini,
            true
        );
        $this->dom->addChild(
            $infoBenInicio,
            "indSitBenef",
            !empty($this->std->infobeninicio->indsitbenef) ? $this->std->infobeninicio->indsitbenef : null,
            false
        );
        $this->dom->addChild(
            $infoBenInicio,
            "nrBeneficio",
            $this->std->infobeninicio->nrbeneficio,
            true
        );
        $this->dom->addChild(
            $infoBenInicio,
            "dtIniBeneficio",
            $this->std->infobeninicio->dtinibeneficio,
            true
        );
        $this->dom->addChild(
            $infoBenInicio,
            "dtPublic",
            !empty($this->std->infobeninicio->dtpublic) ? $this->std->infobeninicio->dtpublic : null,
            false
        );
        $dadosBeneficio = $this->dom->createElement("dadosBeneficio");
       
        $this->dom->addChild(
            $dadosBeneficio,
            "tpBeneficio",
            $this->std->infobeninicio->dadosbeneficio->tpbeneficio,
            true
        );
      
        $this->dom->addChild(
            $dadosBeneficio,
            "tpPlanRP",
            $this->std->infobeninicio->dadosbeneficio->tpplanrp,
            true
        );
      
        $this->dom->addChild(
            $dadosBeneficio,
            "dsc",
            !empty($this->std->infobeninicio->dadosbeneficio->dsc) ? $this->std->infobeninicio->dadosbeneficio->dsc : null,
            false
        );
        
        $this->dom->addChild(
            $dadosBeneficio,
            "indDecJud",
            !empty($this->std->infobeninicio->dadosbeneficio->inddecjud) ? $this->std->infobeninicio->dadosbeneficio->inddecjud : null,
            false
        );
        
        if (!empty($this->std->infobeninicio->dadosbeneficio->infopenmorte)) {
            $infoPenMorte = $this->dom->createElement("infoPenMorte");
            $this->dom->addChild(
                $infoPenMorte,
                "tpPenMorte",
                $this->std->infobeninicio->dadosbeneficio->infopenmorte->tppenmorte,
                true
            );
            if (!empty($this->std->infobeninicio->dadosbeneficio->infopenmorte->instpenmorte)) {
                $instPenMorte = $this->dom->createElement("instPenMorte");
                $this->dom->addChild(
                    $instPenMorte,
                    "cpfInst",
                    $this->std->infobeninicio->dadosbeneficio->infopenmorte->instpenmorte->cpfinst,
                    true
                );
                $this->dom->addChild(
                    $instPenMorte,
                    "dtInst",
                    $this->std->infobeninicio->dadosbeneficio->infopenmorte->instpenmorte->dtinst,
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
        
        $beneficiario = $this->dom->createElement("beneficiario");
        $this->dom->addChild(
            $beneficiario,
            "cpfBenef",
            $this->std->beneficiario->cpfbenef,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "matricula",
            !empty($this->std->beneficiario->matricula) ? $this->std->beneficiario->matricula : null,
            false
        );
        $this->dom->addChild(
            $beneficiario,
            "cnpjOrigem",
            !empty($this->std->beneficiario->cnpjorigem) ? $this->std->beneficiario->cnpjorigem : null,
            false
        );
        $this->node->appendChild($beneficiario);
        
        $infoBenInicio = $this->dom->createElement("infoBenInicio");
        $this->dom->addChild(
            $infoBenInicio,
            "cadIni",
            $this->std->infobeninicio->cadini,
            true
        );
        $this->dom->addChild(
            $infoBenInicio,
            "indSitBenef",
            !empty($this->std->infobeninicio->indsitbenef) ? $this->std->infobeninicio->indsitbenef : null,
            false
        );
        $this->dom->addChild(
            $infoBenInicio,
            "nrBeneficio",
            $this->std->infobeninicio->nrbeneficio,
            true
        );
        $this->dom->addChild(
            $infoBenInicio,
            "dtIniBeneficio",
            $this->std->infobeninicio->dtinibeneficio,
            true
        );
        $this->dom->addChild(
            $infoBenInicio,
            "dtPublic",
            !empty($this->std->infobeninicio->dtpublic) ? $this->std->infobeninicio->dtpublic : null,
            false
        );
        $dadosBeneficio = $this->dom->createElement("dadosBeneficio");
       
        $this->dom->addChild(
            $dadosBeneficio,
            "tpBeneficio",
            $this->std->infobeninicio->dadosbeneficio->tpbeneficio,
            true
        );
      
        $this->dom->addChild(
            $dadosBeneficio,
            "tpPlanRP",
            $this->std->infobeninicio->dadosbeneficio->tpplanrp,
            true
        );
      
        $this->dom->addChild(
            $dadosBeneficio,
            "dsc",
            !empty($this->std->infobeninicio->dadosbeneficio->dsc) ? $this->std->infobeninicio->dadosbeneficio->dsc : null,
            false
        );
        
        $this->dom->addChild(
            $dadosBeneficio,
            "indDecJud",
            !empty($this->std->infobeninicio->dadosbeneficio->inddecjud) ? $this->std->infobeninicio->dadosbeneficio->inddecjud : null,
            false
        );
        
        if (!empty($this->std->infobeninicio->dadosbeneficio->infopenmorte)) {
            $infoPenMorte = $this->dom->createElement("infoPenMorte");
            $this->dom->addChild(
                $infoPenMorte,
                "tpPenMorte",
                $this->std->infobeninicio->dadosbeneficio->infopenmorte->tppenmorte,
                true
            );
            if (!empty($this->std->infobeninicio->dadosbeneficio->infopenmorte->instpenmorte)) {
                $instPenMorte = $this->dom->createElement("instPenMorte");
                $this->dom->addChild(
                    $instPenMorte,
                    "cpfInst",
                    $this->std->infobeninicio->dadosbeneficio->infopenmorte->instpenmorte->cpfinst,
                    true
                );
                $this->dom->addChild(
                    $instPenMorte,
                    "dtInst",
                    $this->std->infobeninicio->dadosbeneficio->infopenmorte->instpenmorte->dtinst,
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
