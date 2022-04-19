<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2400
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

        $ideBenef = $this->dom->createElement("ideBenef");
        $iben = $this->std->idebenef;
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $iben->cpfbenef,
            true
        );
        $this->dom->addChild(
            $ideBenef,
            "nmBenefic",
            $iben->nmbenefic,
            true
        );
        $this->node->appendChild($ideBenef);
        
        $dadosBenef = $this->dom->createElement("dadosBenef");
        
        $dadosNasc = $this->dom->createElement("dadosNasc");
        $diben = $this->std->idebenef->dadosbenef->dadosnasc;
        $this->dom->addChild(
            $dadosNasc,
            "dtNascto",
            $diben->dtnascto,
            true
        );
        $this->dom->addChild(
            $dadosNasc,
            "codMunic",
            !empty($diben->codmunic) ? $diben->codmunic : null,
            false
        );
        $this->dom->addChild(
            $dadosNasc,
            "uf",
            !empty($diben->uf) ? $diben->uf : null,
            false
        );
        $this->dom->addChild(
            $dadosNasc,
            "paisNascto",
            $diben->paisnascto,
            true
        );
        $this->dom->addChild(
            $dadosNasc,
            "paisNac",
            $diben->paisnac,
            true
        );
        $this->dom->addChild(
            $dadosNasc,
            "nmMae",
            !empty($diben->nmmae) ? $diben->nmmae : null,
            false
        );
        $this->dom->addChild(
            $dadosNasc,
            "nmPai",
            !empty($diben->nmpai) ?
                $diben->nmpai : null,
            false
        );
        $dadosBenef->appendChild($dadosNasc);
        $endereco = $this->dom->createElement("endereco");
        if (isset($this->std->idebenef->dadosbenef->endereco->brasil)) {
            $br = $this->std->idebenef->dadosbenef->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                $br->tplograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $br->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $br->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($br->complemento) ? $br->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($br->bairro) ? $br->bairro : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $br->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $br->codmunic,
                true
            );

            $this->dom->addChild(
                $brasil,
                "uf",
                $br->uf,
                true
            );
            $endereco->appendChild($brasil);
        }

        if (isset($this->std->idebenef->dadosbenef->endereco->exterior)) {
            $ext = $this->std->idebenef->dadosbenef->endereco->exterior;
            $exterior = $this->dom->createElement("exterior");

            $this->dom->addChild(
                $exterior,
                "paisResid",
                $ext->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $ext->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $ext->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($ext->complemento) ? $ext->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($ext->bairro) ? $ext->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $ext->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                $ext->codpostal,
                true
            );
            $endereco->appendChild($exterior);
        }
        $dadosBenef->appendChild($endereco);
        $ideBenef->appendChild($dadosBenef);
        $infoBeneficio = $this->dom->createElement("infoBeneficio");
        $this->dom->addChild(
            $infoBeneficio,
            "tpPlanRP",
            $this->std->infobeneficio->tpplanrp,
            true
        );
        $this->node->appendChild($infoBeneficio);
        if (isset($this->std->infobeneficio->inibeneficio)) {
            $iben = $this->std->infobeneficio->inibeneficio;
            $iniBeneficio = $this->dom->createElement("iniBeneficio");
            $this->dom->addChild(
                $iniBeneficio,
                "tpBenef",
                $iben->tpbenef,
                true
            );
            $this->dom->addChild(
                $iniBeneficio,
                "nrBenefic",
                $iben->nrbenefic,
                true
            );
            $this->dom->addChild(
                $iniBeneficio,
                "dtIniBenef",
                $iben->dtinibenef,
                true
            );
            $this->dom->addChild(
                $iniBeneficio,
                "vrBenef",
                $iben->vrbenef,
                true
            );
            if (isset($iben->infopenmorte)) {
                $infoPenMorte = $this->dom->createElement("infoPenMorte");
                $this->dom->addChild(
                    $infoPenMorte,
                    "idQuota",
                    $iben->infopenmorte->idquota,
                    true
                );
                $this->dom->addChild(
                    $infoPenMorte,
                    "cpfInst",
                    $iben->infopenmorte->cpfinst,
                    true
                );
                $iniBeneficio->appendChild($infoPenMorte);
            }
            $infoBeneficio->appendChild($iniBeneficio);
        }

        if (isset($this->std->infobeneficio->altbeneficio)) {
            $iben = $this->std->infobeneficio->altbeneficio;
            $altBeneficio = $this->dom->createElement("altBeneficio");
            $this->dom->addChild(
                $altBeneficio,
                "tpBenef",
                $iben->tpbenef,
                true
            );
            $this->dom->addChild(
                $altBeneficio,
                "nrBenefic",
                $iben->nrbenefic,
                true
            );
            $this->dom->addChild(
                $altBeneficio,
                "dtIniBenef",
                $iben->dtinibenef,
                true
            );
            $this->dom->addChild(
                $altBeneficio,
                "vrBenef",
                $iben->vrbenef,
                true
            );
            if (isset($iben->infopenmorte)) {
                $infoPenMorte = $this->dom->createElement("infoPenMorte");
                $this->dom->addChild(
                    $infoPenMorte,
                    "idQuota",
                    $iben->infopenmorte->idquota,
                    true
                );
                $this->dom->addChild(
                    $infoPenMorte,
                    "cpfInst",
                    $iben->infopenmorte->cpfinst,
                    true
                );
                $altBeneficio->appendChild($infoPenMorte);
            }
            $infoBeneficio->appendChild($altBeneficio);
        }
        if (isset($this->std->infobeneficio->fimbeneficio)) {
            $fim = $this->std->infobeneficio->fimbeneficio;
            $fimBeneficio = $this->dom->createElement("fimBeneficio");
            $this->dom->addChild(
                $fimBeneficio,
                "tpBenef",
                $fim->tpbenef,
                true
            );
            $this->dom->addChild(
                $fimBeneficio,
                "nrBenefic",
                $fim->nrbenefic,
                true
            );
            $this->dom->addChild(
                $fimBeneficio,
                "dtFimBenef",
                $fim->dtfimbenef,
                true
            );
            $this->dom->addChild(
                $fimBeneficio,
                "mtvFim",
                $fim->mtvfim,
                true
            );
            $infoBeneficio->appendChild($fimBeneficio);
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
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
        
        $beneficiario = $this->dom->createElement("beneficiario");
        $this->dom->addChild(
            $beneficiario,
            "cpfBenef",
            $this->std->beneficiario->cpfbenef,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "nmBenefic",
            $this->std->beneficiario->nmbenefic,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "dtNascto",
            $this->std->beneficiario->dtnascto,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "dtInicio",
            $this->std->beneficiario->dtinicio,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "sexo",
            !empty($this->std->beneficiario->sexo) ? $this->std->beneficiario->sexo : null,
            false
        );
        $this->dom->addChild(
            $beneficiario,
            "racaCor",
            $this->std->beneficiario->racacor,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "estCiv",
            !empty($this->std->beneficiario->estciv) ? $this->std->beneficiario->estciv : null,
            false
        );
        $this->dom->addChild(
            $beneficiario,
            "incFisMen",
            $this->std->beneficiario->incfismen,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "dtIncFisMen",
            !empty($this->std->beneficiario->dtincfismen) ? $this->std->beneficiario->dtincfismen : null,
            false
        );
        $endereco = $this->dom->createElement("endereco");
        $end = $this->std->beneficiario->endereco;
        if (!empty($end->brasil)) {
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                !empty($end->brasil->tplograd) ? $end->brasil->tplograd : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $end->brasil->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $end->brasil->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($end->brasil->complemento) ? $end->brasil->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($end->brasil->bairro) ? $end->brasil->bairro : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $end->brasil->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $end->brasil->codmunic,
                true
            );
            $this->dom->addChild(
                $brasil,
                "uf",
                $end->brasil->uf,
                true
            );
            $endereco->appendChild($brasil);
        } else {
            $exterior = $this->dom->createElement("exterior");
            $this->dom->addChild(
                $exterior,
                "paisResid",
                $end->exterior->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $end->exterior->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $end->exterior->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($end->exterior->complemento) ? $end->exterior->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($end->exterior->bairro) ? $end->exterior->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $end->exterior->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                !empty($end->exterior->codpostal) ? $end->exterior->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $beneficiario->appendChild($endereco);
        
        if (isset($this->std->beneficiario->dependente) && !empty($this->std->beneficiario->dependente)) {
            foreach ($this->std->beneficiario->dependente as $dep) {
                $dependente = $this->dom->createElement("dependente");
                $this->dom->addChild(
                    $dependente,
                    "tpDep",
                    $dep->tpdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "nmDep",
                    $dep->nmdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "dtNascto",
                    $dep->dtnascto,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "cpfDep",
                    !empty($dep->cpfdep) ? $dep->cpfdep : null,
                    false
                );
                $this->dom->addChild(
                    $dependente,
                    "sexoDep",
                    !empty($dep->sexodep) ? $dep->sexodep : null,
                    false
                );
                $this->dom->addChild(
                    $dependente,
                    "depIRRF",
                    $dep->depirrf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "incFisMen",
                    $dep->incfismen,
                    true
                );
                $beneficiario->appendChild($dependente);
            }
        }
        $this->node->appendChild($beneficiario);
        
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
