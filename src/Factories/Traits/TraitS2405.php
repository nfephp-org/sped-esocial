<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2405
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
        $ideBenef = $this->dom->createElement("ideBenef");
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        $this->node->appendChild($ideBenef);
        $alteracao = $this->dom->createElement("alteracao");
        $this->dom->addChild(
            $alteracao,
            "dtAlteracao",
            $this->std->dtalteracao,
            true
        );
        $dadosBenef = $this->dom->createElement("dadosBenef");
        $this->dom->addChild(
            $dadosBenef,
            "nmBenefic",
            $this->std->dadosbenef->nmbenefic,
            true
        );
        $this->dom->addChild(
            $dadosBenef,
            "sexo",
            $this->std->dadosbenef->sexo,
            true
        );
        $this->dom->addChild(
            $dadosBenef,
            "racaCor",
            $this->std->dadosbenef->racacor,
            true
        );
        $this->dom->addChild(
            $dadosBenef,
            "estCiv",
            !empty($this->std->dadosbenef->estciv) ? $this->std->dadosbenef->estciv : null,
            false
        );
        $this->dom->addChild(
            $dadosBenef,
            "incFisMen",
            $this->std->dadosbenef->incfismen,
            true
        );
        $endereco = $this->dom->createElement("endereco");
        if (!empty($this->std->dadosbenef->endereco->brasil)) {
            $end = $this->std->dadosbenef->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                !empty($end->tplograd) ? $end->tplograd : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $end->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $end->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($end->bairro) ? $end->bairro : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $end->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $end->codmunic,
                true
            );
            $this->dom->addChild(
                $brasil,
                "uf",
                $end->uf,
                true
            );
            $endereco->appendChild($brasil);
        } elseif (!empty($this->std->dadosbenef->endereco->exterior)) {
            $end = $this->std->dadosbenef->endereco->exterior;
            $exterior = $this->dom->createElement("exterior");
            $this->dom->addChild(
                $exterior,
                "paisResid",
                $end->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $end->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $end->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($end->bairro) ? $end->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $end->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                !empty($end->codpostal) ? $end->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $dadosBenef->appendChild($endereco);
        if (!empty($this->std->dadosbenef->dependente)) {
            foreach ($this->std->dadosbenef->dependente as $num => $dep) {
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
                    $dep->sexodep,
                    true
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
                $dadosBenef->appendChild($dependente);
            }
        }
        $alteracao->appendChild($dadosBenef);
        $this->node->appendChild($alteracao);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
