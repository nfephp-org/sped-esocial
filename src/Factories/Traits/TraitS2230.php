<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2230
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
        $this->dom->addChild(
            $ideVinculo,
            "codCateg",
            !empty($this->std->idevinculo->codcateg) ? $this->std->idevinculo->codcateg : null,
            false
        );
        $this->node->appendChild($ideVinculo);
        $infoAfastamento = $this->dom->createElement("infoAfastamento");
        if (! empty($this->std->iniafastamento)) {
            $iniAfastamento = $this->dom->createElement("iniAfastamento");
            $this->dom->addChild(
                $iniAfastamento,
                "dtIniAfast",
                $this->std->iniafastamento->dtiniafast,
                true
            );
            $this->dom->addChild(
                $iniAfastamento,
                "codMotAfast",
                $this->std->iniafastamento->codmotafast,
                true
            );
            $this->dom->addChild(
                $iniAfastamento,
                "infoMesmoMtv",
                ! empty($this->std->iniafastamento->infomesmomtv) ? $this->std->iniafastamento->infomesmomtv : null,
                false
            );
            $this->dom->addChild(
                $iniAfastamento,
                "tpAcidTransito",
                ! empty($this->std->iniafastamento->tpacidtransito) ? $this->std->iniafastamento->tpacidtransito : null,
                false
            );
            $this->dom->addChild(
                $iniAfastamento,
                "observacao",
                ! empty($this->std->iniafastamento->observacao) ? $this->std->iniafastamento->observacao : null,
                false
            );
            if (! empty($this->std->peraquis)) {
                $perAquis = $this->dom->createElement("perAquis");
                $this->dom->addChild(
                    $perAquis,
                    "dtInicio",
                    $this->std->peraquis->dtinicio,
                    true
                );
                $this->dom->addChild(
                    $perAquis,
                    "dtFim",
                    $this->std->iniafastamento->peraquis->dtfim ?? null,
                    false
                );
                $iniAfastamento->appendChild($perAquis);
            }
            if (! empty($this->std->infocessao)) {
                $infoCessao = $this->dom->createElement("infoCessao");
                $this->dom->addChild(
                    $infoCessao,
                    "cnpjCess",
                    $this->std->infocessao->cnpjcess,
                    true
                );
                $this->dom->addChild(
                    $infoCessao,
                    "infOnus",
                    $this->std->infocessao->infonus,
                    true
                );
                $iniAfastamento->appendChild($infoCessao);
            }
            if (! empty($this->std->infomandsind)) {
                $infoMandSind = $this->dom->createElement("infoMandSind");
                $this->dom->addChild(
                    $infoMandSind,
                    "cnpjSind",
                    $this->std->infomandsind->cnpjsind,
                    true
                );
                $this->dom->addChild(
                    $infoMandSind,
                    "infOnusRemun",
                    $this->std->infomandsind->infonusremun,
                    true
                );
                $iniAfastamento->appendChild($infoMandSind);
            }
            if (! empty($this->std->infomandelet)) {
                $infoMandElet = $this->dom->createElement("infoMandElet");
                $this->dom->addChild(
                    $infoMandElet,
                    "cnpjMandElet",
                    $this->std->infomandelet->cnpjmandelet,
                    true
                );
                $this->dom->addChild(
                    $infoMandElet,
                    "indRemunCargo",
                    $this->std->iniafastamento->infomandelet->indremuncargo ?? null,
                    false
                );
                $iniAfastamento->appendChild($infoMandElet);
            }
            $infoAfastamento->appendChild($iniAfastamento);
        }
        if (! empty($this->std->inforetif)) {
            $infoRetif = $this->dom->createElement("infoRetif");
            $this->dom->addChild(
                $infoRetif,
                "origRetif",
                $this->std->inforetif->origretif,
                true
            );
            $this->dom->addChild(
                $infoRetif,
                "tpProc",
                $this->std->inforetif->tpproc ?? null,
                false
            );
            $this->dom->addChild(
                $infoRetif,
                "nrProc",
                ! empty($this->std->inforetif->nrproc) ? $this->std->inforetif->nrproc : null,
                false
            );
            $infoAfastamento->appendChild($infoRetif);
        }
        if (! empty($this->std->fimafastamento)) {
            $fimAfastamento = $this->dom->createElement("fimAfastamento");
            $this->dom->addChild(
                $fimAfastamento,
                "dtTermAfast",
                $this->std->fimafastamento->dttermafast,
                true
            );
            $infoAfastamento->appendChild($fimAfastamento);
        }
        $this->node->appendChild($infoAfastamento);
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

    /**
     * builder for version S.1.2.0
     */
    protected function toNodeS120()
    {
        return $this->toNodeS100();
    }
}
