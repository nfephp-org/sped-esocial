<?php

namespace NFePHP\eSocial\Factories\Traits;

use NFePHP\eSocial\Common\FactoryId;

trait TraitS2230
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );

        $evtAfastTemp = $this->dom->createElement("evtAfastTemp");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtAfastTemp->appendChild($att);

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);

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
        $evtAfastTemp->appendChild($ideEvento);

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
            $this->std->idevinculo->matricula,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "codCateg",
            ! empty($this->std->idevinculo->codcateg) ? $this->std->idevinculo->codcateg : null,
            false
        );
        $this->node->appendChild($ideVinculo);

        $infoAfastamento = $this->dom->createElement("infoAfastamento");

        if (!empty($this->std->infoafastamento->iniafastamento)) {
            $iniAfastamento = $this->dom->createElement("iniAfastamento");

            $this->dom->addChild(
                $iniAfastamento,
                "dtIniAfast",
                $this->std->infoafastamento->iniafastamento->dtiniafast,
                true
            );

            $this->dom->addChild(
                $iniAfastamento,
                "codMotAfast",
                $this->std->infoafastamento->iniafastamento->codmotafast,
                true
            );

            $this->dom->addChild(
                $iniAfastamento,
                "infoMesmoMtv",
                ! empty($this->std->infoafastamento->iniafastamento->infomesmomtv) ? $this->std->infoafastamento->iniafastamento->infomesmomtv : null,
                false
            );

            $this->dom->addChild(
                $iniAfastamento,
                "tpAcidTransito",
                ! empty($this->std->infoafastamento->iniafastamento->tpacidtransito) ? $this->std->infoafastamento->iniafastamento->tpacidtransito : null,
                false
            );

            $this->dom->addChild(
                $iniAfastamento,
                "observacao",
                ! empty($this->std->infoafastamento->iniafastamento->observacao) ? $this->std->infoafastamento->iniafastamento->observacao : null,
                false
            );

            if (isset($this->std->infoafastamento->iniafastamento->infoatestado)) {
                foreach ($this->std->infoafastamento->iniafastamento->infoatestado as $info) {
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

            if (! empty($this->std->infoafastamento->iniafastamento->infocessao)) {
                $infoCessao = $this->dom->createElement("infoCessao");

                $this->dom->addChild(
                    $infoCessao,
                    "cnpjCess",
                    $this->std->infoafastamento->iniafastamento->infocessao->cnpjcess,
                    true
                );

                $this->dom->addChild(
                    $infoCessao,
                    "infOnus",
                    $this->std->infoafastamento->iniafastamento->infocessao->infonus,
                    true
                );

                $iniAfastamento->appendChild($infoCessao);
            }

            if (! empty($this->std->infoafastamento->iniafastamento->infomandsind)) {
                $infoMandSind = $this->dom->createElement("infoMandSind");

                $this->dom->addChild(
                    $infoMandSind,
                    "cnpjSind",
                    $this->std->infoafastamento->iniafastamento->infomandsind->cnpjsind,
                    true
                );

                $this->dom->addChild(
                    $infoMandSind,
                    "infOnusRemun",
                    $this->std->infoafastamento->iniafastamento->infomandsind->infonusremun,
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

        if (! empty($this->std->infoafastamento->fimafastamento)) {
            $fimAfastamento = $this->dom->createElement("fimAfastamento");
            $this->dom->addChild(
                $fimAfastamento,
                "dtTermAfast",
                $this->std->infoafastamento->fimafastamento->dttermafast,
                true
            );
            $infoAfastamento->appendChild($fimAfastamento);
        }
        $this->node->appendChild($infoAfastamento);

        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("TODO !!");
    }
}
