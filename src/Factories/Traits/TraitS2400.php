<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2400
{
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
            $this->std->cpfbenef,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "nmBenefic",
            $this->std->nmbenefic,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "dtInicio",
            $this->std->dtinicio,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "sexo",
            !empty($this->std->sexo) ? $this->std->sexo : null,
            false
        );
        $this->dom->addChild(
            $beneficiario,
            "racaCor",
            $this->std->racacor,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "estCiv",
            !empty($this->std->estciv) ? $this->std->estciv : null,
            false
        );
        $this->dom->addChild(
            $beneficiario,
            "incFisMen",
            $this->std->incfismen,
            true
        );
        $this->dom->addChild(
            $beneficiario,
            "dtIncFisMen",
            !empty($this->std->dtincfismen) ? $this->std->dtincfismen : null,
            false
        );
        $endereco = $this->dom->createElement("endereco");
        $end = $this->std->endereco;
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

        //dependentes (opcional)
        if (isset($this->std->dependente)) {
            foreach ($this->std->dependente as $dep) {
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

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
        return $this->toNodeS100();
    }
}
