<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2230
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
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->idevinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            $this->std->idevinculo->nistrab,
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
            if (isset($this->std->iniafastamento->infoatestado)) {
                foreach ($this->std->iniafastamento->infoatestado as $info) {
                    $infoAtestado = $this->dom->createElement("infoAtestado");
                    $this->dom->addChild(
                        $infoAtestado,
                        "codCID",
                        ! empty($info->codcid) ? $info->codcid : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoAtestado,
                        "qtdDiasAfast",
                        $info->qtddiasafast,
                        true
                    );
                    if (isset($info->emitente)) {
                        $emitente = $this->dom->createElement("emitente");

                        $this->dom->addChild(
                            $emitente,
                            "nmEmit",
                            $info->emitente->nmemit,
                            true
                        );
                        $this->dom->addChild(
                            $emitente,
                            "ideOC",
                            $info->emitente->ideoc,
                            true
                        );
                        $this->dom->addChild(
                            $emitente,
                            "nrOc",
                            $info->emitente->nroc,
                            true
                        );
                        $this->dom->addChild(
                            $emitente,
                            "ufOC",
                            ! empty($info->emitente->ufoc) ? $info->emitente->ufoc : null,
                            false
                        );
                        $infoAtestado->appendChild($emitente);
                    }
                    $iniAfastamento->appendChild($infoAtestado);
                }
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
                $this->std->inforetif->tpproc,
                true
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
            if (! empty($this->std->iniafastamento->peraquis)) {
                $perAquis = $this->dom->createElement("perAquis");
                $this->dom->addChild(
                    $perAquis,
                    "dtInicio",
                    $this->std->iniafastamento->peraquis->dtinicio,
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
            if (! empty($this->std->iniafastamento->infocessao)) {
                $infoCessao = $this->dom->createElement("infoCessao");
                $this->dom->addChild(
                    $infoCessao,
                    "cnpjCess",
                    $this->std->iniafastamento->infocessao->cnpjcess,
                    true
                );
                $this->dom->addChild(
                    $infoCessao,
                    "infOnus",
                    $this->std->iniafastamento->infocessao->infonus,
                    true
                );
                $iniAfastamento->appendChild($infoCessao);
            }
            if (! empty($this->std->iniafastamento->infomandsind)) {
                $infoMandSind = $this->dom->createElement("infoMandSind");
                $this->dom->addChild(
                    $infoMandSind,
                    "cnpjSind",
                    $this->std->iniafastamento->infomandsind->cnpjsind,
                    true
                );
                $this->dom->addChild(
                    $infoMandSind,
                    "infOnusRemun",
                    $this->std->iniafastamento->infomandsind->infonusremun,
                    true
                );
                $iniAfastamento->appendChild($infoMandSind);
            }
            if (! empty($this->std->iniafastamento->infomandelet)) {
                $infoMandElet = $this->dom->createElement("infoMandElet");
                $this->dom->addChild(
                    $infoMandElet,
                    "cnpjMandElet",
                    $this->std->iniafastamento->infomandelet->cnpjmandelet,
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
}
