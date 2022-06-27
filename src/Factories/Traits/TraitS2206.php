<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2206
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
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
            ! empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
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
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            $this->std->nistrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->matricula,
            true
        );
        $this->node->appendChild($ideVinculo);
        
        $altContratual = $this->dom->createElement("altContratual");
        $this->dom->addChild(
            $altContratual,
            "dtAlteracao",
            $this->std->dtalteracao,
            true
        );
        $this->dom->addChild(
            $altContratual,
            "dtEf",
            !empty($this->std->dtef) ? $this->std->dtef : null,
            false
        );
        $this->dom->addChild(
            $altContratual,
            "dscAlt",
            !empty($this->std->dscalt) ? $this->std->dscalt : null,
            false
        );
        
        $vinculo = $this->dom->createElement("vinculo");
        $this->dom->addChild(
            $vinculo,
            "tpRegPrev",
            $this->std->tpregprev,
            true
        );
        $altContratual->appendChild($vinculo);

        $infoRegimeTrab = $this->dom->createElement("infoRegimeTrab");
        if (!empty($this->std->infoceletista)) {
            $ct = $this->std->infoceletista;
            $infoCeletista = $this->dom->createElement("infoCeletista");
            $this->dom->addChild(
                $infoCeletista,
                "tpRegJor",
                $ct->tpregjor,
                true
            );
            $this->dom->addChild(
                $infoCeletista,
                "natAtividade",
                $ct->natatividade,
                true
            );
            $this->dom->addChild(
                $infoCeletista,
                "dtBase",
                !empty($ct->dtbase) ? $ct->dtbase : null,
                false
            );
            $this->dom->addChild(
                $infoCeletista,
                "cnpjSindCategProf",
                $ct->cnpjsindcategprof,
                true
            );
            if (!empty($ct->trabtemp)) {
                $trabTemp = $this->dom->createElement("trabTemp");
                $this->dom->addChild(
                    $trabTemp,
                    "justProrr",
                    $ct->trabtemp->justprorr,
                    true
                );
                $infoCeletista->appendChild($trabTemp);
            }
            if (!empty($ct->aprend)) {
                $aprend = $this->dom->createElement("aprend");
                $this->dom->addChild(
                    $aprend,
                    "tpInsc",
                    $ct->aprend->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $aprend,
                    "nrInsc",
                    $ct->aprend->nrinsc,
                    true
                );
                $infoCeletista->appendChild($aprend);
            }
            $infoRegimeTrab->appendChild($infoCeletista);
        } elseif (!empty($this->std->infoestatutario)) {
            $ct = $this->std->infoestatutario;
            $infoEstatutario = $this->dom->createElement("infoEstatutario");
            $this->dom->addChild(
                $infoEstatutario,
                "tpPlanRP",
                $ct->tpplanrp,
                true
            );
            $infoRegimeTrab->appendChild($infoEstatutario);
        }
        $altContratual->appendChild($infoRegimeTrab);
        
        $infoContrato = $this->dom->createElement("infoContrato");
        $ct = $this->std->infocontrato;
        $this->dom->addChild(
            $infoContrato,
            "codCargo",
            !empty($ct->codcargo) ? $ct->codcargo : null,
            false
        );
        $this->dom->addChild(
            $infoContrato,
            "codFuncao",
            !empty($ct->codfuncao) ? $ct->codfuncao : null,
            false
        );
        $this->dom->addChild(
            $infoContrato,
            "codCateg",
            $ct->codcateg,
            true
        );
        $this->dom->addChild(
            $infoContrato,
            "codCarreira",
            !empty($ct->codcarreira) ? $ct->codcarreira : null,
            false
        );
        $this->dom->addChild(
            $infoContrato,
            "dtIngrCarr",
            !empty($ct->dtingrcarr) ? $ct->dtingrcarr : null,
            false
        );
        $remuneracao = $this->dom->createElement("remuneracao");
        $this->dom->addChild(
            $remuneracao,
            "vrSalFx",
            $ct->vrsalfx,
            true
        );
        $this->dom->addChild(
            $remuneracao,
            "undSalFixo",
            $ct->undsalfixo,
            true
        );
        $this->dom->addChild(
            $remuneracao,
            "dscSalVar",
            !empty($ct->dscsalvar) ? $ct->dscsalvar : null,
            false
        );
        $infoContrato->appendChild($remuneracao);
        $duracao = $this->dom->createElement("duracao");
        $this->dom->addChild(
            $duracao,
            "tpContr",
            $ct->tpcontr,
            true
        );
        $this->dom->addChild(
            $duracao,
            "dtTerm",
            !empty($ct->dtterm) ? $ct->dtterm : null,
            false
        );
        $this->dom->addChild(
            $duracao,
            "objDet",
            !empty($ct->objdet) ? $ct->objdet : null,
            false
        );
        $infoContrato->appendChild($duracao);
        
        $localTrabalho = $this->dom->createElement("localTrabalho");
        if (!empty($this->std->localtrabgeral)) {
            $tg = $this->std->localtrabgeral;
            $localTrabGeral = $this->dom->createElement("localTrabGeral");
            $this->dom->addChild(
                $localTrabGeral,
                "tpInsc",
                $tg->tpinsc,
                true
            );
            $this->dom->addChild(
                $localTrabGeral,
                "nrInsc",
                $tg->nrinsc,
                true
            );
            $this->dom->addChild(
                $localTrabGeral,
                "descComp",
                !empty($tg->desccomp) ? $tg->desccomp : null,
                false
            );
            $localTrabalho->appendChild($localTrabGeral);
        } elseif (!empty($this->std->localtrabdom)) {
            $tg = $this->std->localtrabdom;
            $localTrabDom = $this->dom->createElement("localTrabDom");
            $this->dom->addChild(
                $localTrabDom,
                "tpLograd",
                $tg->tplograd,
                true
            );
            $this->dom->addChild(
                $localTrabDom,
                "dscLograd",
                $tg->dsclograd,
                true
            );
            $this->dom->addChild(
                $localTrabDom,
                "nrLograd",
                $tg->nrlograd,
                true
            );
            $this->dom->addChild(
                $localTrabDom,
                "complemento",
                !empty($tg->complemento) ? $tg->complemento : null,
                false
            );
            $this->dom->addChild(
                $localTrabDom,
                "bairro",
                !empty($tg->bairro) ? $tg->bairro : null,
                false
            );
            $this->dom->addChild(
                $localTrabDom,
                "cep",
                $tg->cep,
                true
            );
            $this->dom->addChild(
                $localTrabDom,
                "codMunic",
                $tg->codmunic,
                true
            );
            $this->dom->addChild(
                $localTrabDom,
                "uf",
                $tg->uf,
                true
            );
            $localTrabalho->appendChild($localTrabDom);
        }
        $infoContrato->appendChild($localTrabalho);
        
        if (!empty($this->std->horcontratual)) {
            $hc = $this->std->horcontratual;
            $horContratual = $this->dom->createElement("horContratual");
            $this->dom->addChild(
                $horContratual,
                "qtdHrsSem",
                !empty($hc->qtdhrssem) ? $hc->qtdhrssem : null,
                false
            );
            $this->dom->addChild(
                $horContratual,
                "tpJornada",
                $hc->tpjornada,
                true
            );
            $this->dom->addChild(
                $horContratual,
                "dscTpJorn",
                !empty($hc->dsctpjorn) ? $hc->dsctpjorn : null,
                false
            );
            $this->dom->addChild(
                $horContratual,
                "tmpParc",
                $hc->tmpparc,
                true
            );
            if (!empty($hc->horario)) {
                foreach ($hc->horario as $hor) {
                    $horario = $this->dom->createElement("horario");
                    $this->dom->addChild(
                        $horario,
                        "dia",
                        $hor->dia,
                        true
                    );
                    $this->dom->addChild(
                        $horario,
                        "codHorContrat",
                        $hor->codhorcontrat,
                        true
                    );
                    $horContratual->appendChild($horario);
                }
            }
            $infoContrato->appendChild($horContratual);
        }
        
        if (!empty($this->std->filiacaosindical)) {
            foreach ($this->std->filiacaosindical as $fs) {
                $filiacaoSindical = $this->dom->createElement("filiacaoSindical");
                $this->dom->addChild(
                    $filiacaoSindical,
                    "cnpjSindTrab",
                    $fs->cnpjsindtrab,
                    true
                );
                $infoContrato->appendChild($filiacaoSindical);
            }
        }
        
        if (!empty($this->std->alvarajudicial)) {
            $alvaraJudicial = $this->dom->createElement("alvaraJudicial");
            $this->dom->addChild(
                $alvaraJudicial,
                "nrProcJud",
                $this->std->alvarajudicial->nrprocjud,
                true
            );
            $infoContrato->appendChild($alvaraJudicial);
        }
        
        if (!empty($this->std->observacoes)) {
            foreach ($this->std->observacoes as $obs) {
                $observacoes = $this->dom->createElement("observacoes");
                $this->dom->addChild(
                    $observacoes,
                    "observacao",
                    $obs->observacao,
                    true
                );
                $infoContrato->appendChild($observacoes);
            }
        }
        
        if (!empty($this->std->servpubl)) {
            $servPubl = $this->dom->createElement("servPubl");
            $this->dom->addChild(
                $servPubl,
                "mtvAlter",
                $this->std->servpubl->mtvalter,
                true
            );
            $infoContrato->appendChild($servPubl);
        }
        $altContratual->appendChild($infoContrato);
        $this->node->appendChild($altContratual);
        //finalização do xml
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
            ! empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
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
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->matricula,
            true
        );
        $this->node->appendChild($ideVinculo);

        $altContratual = $this->dom->createElement("altContratual");
        $this->dom->addChild(
            $altContratual,
            "dtAlteracao",
            $this->std->dtalteracao,
            true
        );
        $this->dom->addChild(
            $altContratual,
            "dtEf",
            !empty($this->std->dtef) ? $this->std->dtef : null,
            false
        );
        $this->dom->addChild(
            $altContratual,
            "dscAlt",
            !empty($this->std->dscalt) ? $this->std->dscalt : null,
            false
        );

        $vinculo = $this->dom->createElement("vinculo");
        $this->dom->addChild(
            $vinculo,
            "tpRegPrev",
            $this->std->tpregprev,
            true
        );

        $infoRegimeTrab = $this->dom->createElement("infoRegimeTrab");
        if (!empty($this->std->infoceletista)) {
            $ct = $this->std->infoceletista;
            $infoCeletista = $this->dom->createElement("infoCeletista");
            $this->dom->addChild(
                $infoCeletista,
                "tpRegJor",
                $ct->tpregjor,
                true
            );
            $this->dom->addChild(
                $infoCeletista,
                "natAtividade",
                $ct->natatividade,
                true
            );
            $this->dom->addChild(
                $infoCeletista,
                "dtBase",
                !empty($ct->dtbase) ? $ct->dtbase : null,
                false
            );
            $this->dom->addChild(
                $infoCeletista,
                "cnpjSindCategProf",
                $ct->cnpjsindcategprof,
                true
            );
            if (!empty($ct->trabtemporario)) {
                $trabTemp = $this->dom->createElement("trabTemporario");
                $this->dom->addChild(
                    $trabTemp,
                    "justProrr",
                    $ct->trabtemporario->justprorr,
                    true
                );
                $infoCeletista->appendChild($trabTemp);
            }
            if (!empty($ct->aprend)) {
                $aprend = $this->dom->createElement("aprend");
                $this->dom->addChild(
                    $aprend,
                    "tpInsc",
                    $ct->aprend->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $aprend,
                    "nrInsc",
                    $ct->aprend->nrinsc,
                    true
                );
                $infoCeletista->appendChild($aprend);
            }
            $infoRegimeTrab->appendChild($infoCeletista);
        } elseif (!empty($this->std->infoestatutario)) {
            $ct = $this->std->infoestatutario;
            $infoEstatutario = $this->dom->createElement("infoEstatutario");
            $this->dom->addChild(
                $infoEstatutario,
                "tpPlanRP",
                $ct->tpplanrp,
                true
            );
            $this->dom->addChild(
                $infoEstatutario,
                "indTetoRGPS",
                ! empty($ct->indtetorgps) ? $ct->indtetorgps : null,
                false
            );
            $this->dom->addChild(
                $infoEstatutario,
                "indAbonoPerm",
                ! empty($ct->indabonoperm) ? $ct->indabonoperm : null,
                false
            );
            $infoRegimeTrab->appendChild($infoEstatutario);
        }
        $vinculo->appendChild($infoRegimeTrab);

        $infoContrato = $this->dom->createElement("infoContrato");
        $ct = $this->std->infocontrato;
        $this->dom->addChild(
            $infoContrato,
            "nmCargo",
            ! empty($ct->nmcargo) ? $ct->nmcargo : null,
            false
        );
        $this->dom->addChild(
            $infoContrato,
            "CBOCargo",
            ! empty($ct->cbocargo) ? $ct->cbocargo : null,
            false
        );
        $this->dom->addChild(
            $infoContrato,
            "nmFuncao",
            ! empty($ct->nmfuncao) ? $ct->nmfuncao : null,
            false
        );
        $this->dom->addChild(
            $infoContrato,
            "CBOFuncao",
            ! empty($ct->cbofuncao) ? $ct->cbofuncao : null,
            false
        );
        $this->dom->addChild(
            $infoContrato,
            "acumCargo",
            ! empty($ct->acumcargo) ? $ct->acumcargo : null,
            false
        );
        $this->dom->addChild(
            $infoContrato,
            "codCateg",
            $ct->codcateg,
            true
        );
        //remuneracao (obrigatorio)
        $remuneracao = $this->dom->createElement("remuneracao");
        $this->dom->addChild(
            $remuneracao,
            "vrSalFx",
            $ct->vrsalfx,
            true
        );
        $this->dom->addChild(
            $remuneracao,
            "undSalFixo",
            $ct->undsalfixo,
            true
        );
        $this->dom->addChild(
            $remuneracao,
            "dscSalVar",
            ! empty($ct->dscsalvar) ? $ct->dscsalvar : null,
            false
        );
        $infoContrato->appendChild($remuneracao);
        //duracao (obrigatorio)
        $duracao = $this->dom->createElement("duracao");
        $this->dom->addChild(
            $duracao,
            "tpContr",
            $ct->tpcontr,
            true
        );
        $this->dom->addChild(
            $duracao,
            "dtTerm",
            ! empty($ct->dtterm) ? $ct->dtterm : null,
            false
        );
        $this->dom->addChild(
            $duracao,
            "objDet",
            ! empty($ct->objdet) ? $ct->objdet : null,
            false
        );
        $infoContrato->appendChild($duracao);
        //localTrabalho (obrigatorio)
        $localTrabalho = $this->dom->createElement("localTrabalho");
        //localTrabGeral (opcional)
        if (isset($ct->localtrabgeral)) {
            $localgeral = $this->dom->createElement("localTrabGeral");
            $this->dom->addChild(
                $localgeral,
                "tpInsc",
                $ct->localtrabgeral->tpinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "nrInsc",
                $ct->localtrabgeral->nrinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "descComp",
                ! empty($ct->localtrabgeral->desccomp) ? $ct->localtrabgeral->desccomp : null,
                false
            );
            $localTrabalho->appendChild($localgeral);
        }
        //localTempDom (opcional)
        if (isset($ct->localtempdom)) {
            $ld = $ct->localtempdom;
            $localDomestico = $this->dom->createElement("localTempDom");
            $this->dom->addChild(
                $localDomestico,
                "tpLograd",
                $ld->tplograd,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "dscLograd",
                $ld->dsclograd,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "nrLograd",
                $ld->nrlograd,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "complemento",
                ! empty($ld->complemento) ? $ld->complemento : null,
                false
            );
            $this->dom->addChild(
                $localDomestico,
                "bairro",
                ! empty($ld->bairro) ? $ld->bairro : null,
                false
            );
            $this->dom->addChild(
                $localDomestico,
                "cep",
                $ld->cep,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "codMunic",
                $ld->codmunic,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "uf",
                $ld->uf,
                true
            );
            $localTrabalho->appendChild($localDomestico);
        }
        $infoContrato->appendChild($localTrabalho);

        //horContratual (opcional)
        if (isset($ct->horcontratual)) {
            $hc = $ct->horcontratual;
            $horContratual = $this->dom->createElement("horContratual");
            $this->dom->addChild(
                $horContratual,
                "qtdHrsSem",
                $hc->qtdhrssem,
                true
            );
            $this->dom->addChild(
                $horContratual,
                "tpJornada",
                $hc->tpjornada,
                true
            );
            $this->dom->addChild(
                $horContratual,
                "tmpParc",
                $hc->tmpparc,
                true
            );
            if (! empty($hc->hornoturno)) {
                $this->dom->addChild(
                    $horContratual,
                    "horNoturno",
                    $hc->hornoturno,
                    true
                );
            }
            $this->dom->addChild(
                $horContratual,
                "dscJorn",
                $hc->dscjorn,
                false
            );
            //encerra horContratual
            $infoContrato->appendChild($horContratual);
        }
        //alvaraJudicial (opcional)
        if (isset($ct->alvarajudicial)) {
            $alvaraJudicial = $this->dom->createElement("alvaraJudicial");
            $this->dom->addChild(
                $alvaraJudicial,
                "nrProcJud",
                $ct->alvarajudicial->nrprocjud,
                true
            );
            $infoContrato->appendChild($alvaraJudicial);
        }
        //observacoes (opcional)
        if (isset($ct->observacoes)) {
            foreach ($ct->observacoes as $obs) {
                $observacoes = $this->dom->createElement("observacoes");
                $this->dom->addChild(
                    $observacoes,
                    "observacao",
                    $obs->observacao,
                    true
                );
                $infoContrato->appendChild($observacoes);
            }
        }
        //treiCap (opcional)
        if (isset($ct->treicap)) {
            foreach ($ct->treicap as $trein) {
                $treiCap = $this->dom->createElement("treiCap");
                $this->dom->addChild(
                    $treiCap,
                    "codTreiCap",
                    $trein->codtreicap,
                    true
                );
                $infoContrato->appendChild($treiCap);
            }
        }
        $vinculo->appendChild($infoContrato);

        $altContratual->appendChild($vinculo);
        $this->node->appendChild($altContratual);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
