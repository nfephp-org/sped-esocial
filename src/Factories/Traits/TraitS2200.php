<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2200
{
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

        //trabalhador (obrigatório)
        $trabalhador = $this->dom->createElement("trabalhador");
        $this->dom->addChild(
            $trabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmTrab",
            $this->std->nmtrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "sexo",
            $this->std->sexo,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "racaCor",
            $this->std->racacor,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "estCiv",
            ! empty($this->std->estciv) ? $this->std->estciv : null,
            false
        );
        $this->dom->addChild(
            $trabalhador,
            "grauInstr",
            $this->std->grauinstr,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmSoc",
            ! empty($this->std->nmsoc) ? $this->std->nmsoc : null,
            false
        );

        //nascimento (obrigatorio)
        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->paisnac,
            true
        );
        $trabalhador->appendChild($nascimento);

        //Endereço (obrigatorio)
        $endereco = $this->dom->createElement("endereco");
        if (isset($this->std->endereco->brasil)) {
            $end = $this->std->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            if (! empty($end->tplograd)) {
                $this->dom->addChild(
                    $brasil,
                    "tpLograd",
                    $end->tplograd,
                    true
                );
            }
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
                ! empty($end->complemento) ? $end->complemento : null,
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
        }
        if (isset($this->std->endereco->exterior) && !isset($this->std->endereco->brasil)) {
            $end = $this->std->endereco->exterior;
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
                ! empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                ! empty($end->bairro) ? $end->bairro : null,
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
                ! empty($end->codpostal) ? $end->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $trabalhador->appendChild($endereco);

        if (isset($this->std->trabimig)) {
            $ex = $this->std->trabimig;
            $trabImig = $this->dom->createElement("trabImig");
            $this->dom->addChild(
                $trabImig,
                "tmpResid",
                $ex->tmpresid,
                true
            );
            $this->dom->addChild(
                $trabImig,
                "condIng",
                $ex->conding,
                true
            );
            $trabalhador->appendChild($trabImig);
        }

        //deficiencia (opcional)
        if (isset($this->std->infodeficiencia)) {
            $def = $this->std->infodeficiencia;
            $deficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $deficiencia,
                "defFisica",
                $def->deffisica,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defVisual",
                $def->defvisual,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defAuditiva",
                $def->defauditiva,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defMental",
                $def->defmental,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defIntelectual",
                $def->defintelectual,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "reabReadap",
                $def->reabreadap,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "infoCota",
                !empty($def->infocota) ? $def->infocota : null,
                false
            );
            $this->dom->addChild(
                $deficiencia,
                "observacao",
                ! empty($def->observacao) ? $def->observacao : null,
                false
            );
            $trabalhador->appendChild($deficiencia);
        }

        //dependentes (opcional) (ARRAY)
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
                    ! empty($dep->cpfdep) ? $dep->cpfdep : null,
                    false
                );
                $this->dom->addChild(
                    $dependente,
                    "sexoDep",
                    ! empty($dep->sexodep) ? $dep->sexodep : null,
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
                    "depSF",
                    $dep->depsf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "incTrab",
                    $dep->inctrab,
                    true
                );
                $trabalhador->appendChild($dependente);
            }
        }

        //contato (opcional)
        if (isset($this->std->contato)) {
            $doc = $this->std->contato;
            $contato = $this->dom->createElement("contato");
            $this->dom->addChild(
                $contato,
                "fonePrinc",
                ! empty($doc->foneprinc) ? $doc->foneprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                ! empty($doc->emailprinc) ? $doc->emailprinc : null,
                false
            );
            $trabalhador->appendChild($contato);
        }
        //encerra trabalhador
        $this->node->appendChild($trabalhador);

        //vinculo (obrigatorio)
        $vinculo = $this->dom->createElement("vinculo");
        $vin = $this->std->vinculo;
        $this->dom->addChild(
            $vinculo,
            "matricula",
            $vin->matricula,
            true
        );
        $this->dom->addChild(
            $vinculo,
            "tpRegTrab",
            $vin->tpregtrab,
            true
        );
        $this->dom->addChild(
            $vinculo,
            "tpRegPrev",
            $vin->tpregprev,
            true
        );
        $this->dom->addChild(
            $vinculo,
            "cadIni",
            $vin->cadini,
            true
        );

        $infoRegimeTrab = $this->dom->createElement("infoRegimeTrab");
        if (isset($vin->infoceletista)) {
            $std = $vin->infoceletista;
            $celetista = $this->dom->createElement("infoCeletista");
            $this->dom->addChild(
                $celetista,
                "dtAdm",
                $std->dtadm,
                true
            );
            $this->dom->addChild(
                $celetista,
                "tpAdmissao",
                $std->tpadmissao,
                true
            );
            $this->dom->addChild(
                $celetista,
                "indAdmissao",
                $std->indadmissao,
                true
            );
            // Processo judicial obrigatorio e exclusivo quando indadmissao = 3
            if (! empty($std->nrproctrab)) {
                $this->dom->addChild(
                    $celetista,
                    "nrProcTrab",
                    $std->nrproctrab,
                    true
                );
            }
             $this->dom->addChild(
                 $celetista,
                 "tpRegJor",
                 $std->tpregjor,
                 true
             );
            $this->dom->addChild(
                $celetista,
                "natAtividade",
                $std->natatividade,
                true
            );
            $this->dom->addChild(
                $celetista,
                "dtBase",
                ! empty($std->dtbase) ? $std->dtbase : null,
                false
            );
            $this->dom->addChild(
                $celetista,
                "cnpjSindCategProf",
                $std->cnpjsindcategprof,
                true
            );

            //FGTS
            if (! empty($std->dtopcfgts)) {
                $fgts = $this->dom->createElement("FGTS");
                $this->dom->addChild(
                    $fgts,
                    "dtOpcFGTS",
                    $std->dtopcfgts,
                    false
                );
                $celetista->appendChild($fgts);
            }

            if (isset($std->trabtemporario)) {
                $trabTemporario = $this->dom->createElement("trabTemporario");
                $this->dom->addChild(
                    $trabTemporario,
                    "hipLeg",
                    $std->trabtemporario->hipleg,
                    true
                );
                $this->dom->addChild(
                    $trabTemporario,
                    "justContr",
                    $std->trabtemporario->justcontr,
                    true
                );
                $ideEstabVinc = $this->dom->createElement("ideEstabVinc");
                $this->dom->addChild(
                    $ideEstabVinc,
                    "tpInsc",
                    $std->trabtemporario->ideestabvinc->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $ideEstabVinc,
                    "nrInsc",
                    $std->trabtemporario->ideestabvinc->nrinsc,
                    true
                );
                $trabTemporario->appendChild($ideEstabVinc);

                //substituido (opcional) ARRAY
                if (isset($std->trabtemporario->idetrabsubstituido)) {
                    foreach ($std->trabtemporario->idetrabsubstituido as $subs) {
                        $ideTrabSubstituido = $this->dom->createElement("ideTrabSubstituido");
                        $this->dom->addChild(
                            $ideTrabSubstituido,
                            "cpfTrabSubst",
                            $subs->cpftrabsubst,
                            true
                        );
                        $trabTemporario->appendChild($ideTrabSubstituido);
                    }
                }
                $celetista->appendChild($trabTemporario);
            }
            //aprendiz (opcional)
            if (isset($std->aprend)) {
                $aprendiz = $this->dom->createElement("aprend");
                $this->dom->addChild(
                    $aprendiz,
                    "tpInsc",
                    $std->aprend->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $aprendiz,
                    "nrInsc",
                    $std->aprend->nrinsc,
                    true
                );
                $celetista->appendChild($aprendiz);
            }
            $infoRegimeTrab->appendChild($celetista);
        } elseif (isset($vin->infoestatutario)) {
            $std = $vin->infoestatutario;
            $estatutario = $this->dom->createElement("infoEstatutario");
            $this->dom->addChild(
                $estatutario,
                "tpProv",
                $std->tpprov,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "dtExercicio",
                $std->dtexercicio,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "tpPlanRP",
                isset($std->tpplanrp) ? $std->tpplanrp : null, //pode ser ZERO
                false
            );
            $this->dom->addChild(
                $estatutario,
                "indTetoRGPS",
                ! empty($std->indtetorgps) ? $std->indtetorgps : null,
                false
            );
            $this->dom->addChild(
                $estatutario,
                "indAbonoPerm",
                ! empty($std->indabonoperm) ? $std->indabonoperm : null,
                false
            );
            $this->dom->addChild(
                $estatutario,
                "dtIniAbono",
                ! empty($std->dtiniabono) ? $std->dtiniabono : null,
                false
            );
            $infoRegimeTrab->appendChild($estatutario);
        }
        $vinculo->appendChild($infoRegimeTrab);

        //infoContrato (obrigatorio)
        $contrato = $this->dom->createElement("infoContrato");
        $std = $vin->infocontrato;
        $this->dom->addChild(
            $contrato,
            "nmCargo",
            ! empty($std->nmcargo) ? $std->nmcargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "CBOCargo",
            ! empty($std->cbocargo) ? $std->cbocargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "dtIngrCargo",
            ! empty($std->dtingrcargo) ? $std->dtingrcargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "nmFuncao",
            ! empty($std->nmfuncao) ? $std->nmfuncao : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "CBOFuncao",
            ! empty($std->cbofuncao) ? $std->cbofuncao : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "acumCargo",
            ! empty($std->acumcargo) ? $std->acumcargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "codCateg",
            $std->codcateg,
            true
        );
        if (isset($std->remuneracao)) {
            $rem = $std->remuneracao;
            $remuneracao = $this->dom->createElement("remuneracao");
            $this->dom->addChild(
                $remuneracao,
                "vrSalFx",
                $rem->vrsalfx,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "undSalFixo",
                $rem->undsalfixo,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "dscSalVar",
                ! empty($rem->dscsalvar) ? $rem->dscsalvar : null,
                false
            );
            $contrato->appendChild($remuneracao);
        }
        if (isset($std->duracao)) {
            $dur = $std->duracao;
            $duracao = $this->dom->createElement("duracao");
            $this->dom->addChild(
                $duracao,
                "tpContr",
                $dur->tpcontr,
                true
            );
            $this->dom->addChild(
                $duracao,
                "dtTerm",
                ! empty($dur->dtterm) ? $dur->dtterm : null,
                false
            );
            $this->dom->addChild(
                $duracao,
                "clauAssec",
                ! empty($dur->clauassec) ? $dur->clauassec : null,
                false
            );
            if ((int)$dur->tpcontr == 3) {
                $this->dom->addChild(
                    $duracao,
                    "objDet",
                    ! empty($dur->objdet) ? $dur->objdet : null,
                    false
                );
            }
            $contrato->appendChild($duracao);
        }
        //localTrabalho (obrigatorio)
        $localTrabalho = $this->dom->createElement("localTrabalho");
        //localTrabGeral (opcional)
        if (isset($std->localtrabgeral)) {
            $localgeral = $this->dom->createElement("localTrabGeral");
            $this->dom->addChild(
                $localgeral,
                "tpInsc",
                $std->localtrabgeral->tpinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "nrInsc",
                $std->localtrabgeral->nrinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "descComp",
                ! empty($std->localtrabgeral->desccomp) ? $std->localtrabgeral->desccomp : null,
                false
            );
            $localTrabalho->appendChild($localgeral);
        }
        //localTempDom (opcional)
        if (isset($std->localtempdom)) {
            $ld = $std->localtempdom;
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
        $contrato->appendChild($localTrabalho);

        //horContratual (opcional)
        if (isset($std->horcontratual)) {
            $hc = $std->horcontratual;
            $horContratual = $this->dom->createElement("horContratual");
            if (! empty($hc->qtdhrssem)) {
                $this->dom->addChild(
                    $horContratual,
                    "qtdHrsSem",
                    $hc->qtdhrssem,
                    true
                );
            }
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
            $contrato->appendChild($horContratual);
        }
        //alvaraJudicial (opcional)
        if (isset($std->alvarajudicial)) {
            $alvaraJudicial = $this->dom->createElement("alvaraJudicial");
            $this->dom->addChild(
                $alvaraJudicial,
                "nrProcJud",
                $std->alvarajudicial->nrprocjud,
                true
            );
            $contrato->appendChild($alvaraJudicial);
        }
        //observacoes (opcional)
        if (isset($std->observacoes)) {
            foreach ($std->observacoes as $obs) {
                $observacoes = $this->dom->createElement("observacoes");
                $this->dom->addChild(
                    $observacoes,
                    "observacao",
                    $obs->observacao,
                    true
                );
                $contrato->appendChild($observacoes);
            }
        }
        //treiCap (opcional)
        if (isset($std->treicap)) {
            foreach ($std->treicap as $trein) {
                $treiCap = $this->dom->createElement("treiCap");
                $this->dom->addChild(
                    $treiCap,
                    "codTreiCap",
                    $trein->codtreicap,
                    true
                );
                $contrato->appendChild($treiCap);
            }
        }
        $vinculo->appendChild($contrato);

        //sucessaoVinc (opcional)
        if (isset($vin->sucessaovinc)) {
            $std = $vin->sucessaovinc;
            $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
            $this->dom->addChild(
                $sucessaoVinc,
                "tpInsc",
                !empty($std->tpinsc) ? $std->tpinsc : null,
                false
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "nrInsc",
                $std->nrinsc,
                true
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "matricAnt",
                ! empty($std->matricant) ? $std->matricant : null,
                false
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "dtTransf",
                $std->dttransf,
                true
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "observacao",
                ! empty($std->observacao) ? $std->observacao : null,
                false
            );
            $vinculo->appendChild($sucessaoVinc);
        }
        //transfDom (opcional)
        if (isset($vin->transfdom)) {
            $std = $vin->transfdom;
            $transfDom = $this->dom->createElement("transfDom");
            $this->dom->addChild(
                $transfDom,
                "cpfSubstituido",
                $std->cpfsubstituido,
                true
            );
            $this->dom->addChild(
                $transfDom,
                "matricAnt",
                ! empty($std->matricant) ? $std->matricant : null,
                false
            );
            $this->dom->addChild(
                $transfDom,
                "dtTransf",
                $std->dttransf,
                true
            );
            $vinculo->appendChild($transfDom);
        }
        //mudancaCPF (opcional)
        if (isset($vin->mudancacpf)) {
            $std = $vin->mudancacpf;
            $mudancaCPF = $this->dom->createElement("mudancaCPF");
            $this->dom->addChild(
                $mudancaCPF,
                "cpfAnt",
                $std->cpfant,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "matricAnt",
                ! empty($std->matricant) ? $std->matricant : null,
                false
            );
            $this->dom->addChild(
                $mudancaCPF,
                "dtAltCPF",
                $std->dtaltcpf,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "observacao",
                ! empty($std->observacao) ? $std->observacao : null,
                false
            );
            $vinculo->appendChild($mudancaCPF);
        }

        //afastamento (opcional)
        if (isset($this->std->vinculo->afastamento)) {
            $std = $this->std->vinculo->afastamento;
            $afastamento = $this->dom->createElement("afastamento");
            $this->dom->addChild(
                $afastamento,
                "dtIniAfast",
                $std->dtiniafast,
                true
            );
            $this->dom->addChild(
                $afastamento,
                "codMotAfast",
                $std->codmotafast,
                true
            );
            $vinculo->appendChild($afastamento);
        }

        //desligamento (opcional)
        if (isset($this->std->vinculo->desligamento)) {
            $std = $this->std->vinculo->desligamento;
            $desligamento = $this->dom->createElement("desligamento");
            $this->dom->addChild(
                $desligamento,
                "dtDeslig",
                $std->dtdeslig,
                true
            );
            $vinculo->appendChild($desligamento);
        }

        //cessao (opcional)
        if (isset($this->std->vinculo->cessao)) {
            $std = $this->std->vinculo->cessao;
            $cessao = $this->dom->createElement("cessao");
            $this->dom->addChild(
                $cessao,
                "dtIniCessao",
                $std->dtinicessao,
                true
            );
            $vinculo->appendChild($cessao);
        }

        //encerra vinculo
        $this->node->appendChild($vinculo);
        //finalização do xml
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

        //trabalhador (obrigatório)
        $trabalhador = $this->dom->createElement("trabalhador");
        $this->dom->addChild(
            $trabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmTrab",
            $this->std->nmtrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "sexo",
            $this->std->sexo,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "racaCor",
            $this->std->racacor,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "estCiv",
            ! empty($this->std->estciv) ? $this->std->estciv : null,
            false
        );
        $this->dom->addChild(
            $trabalhador,
            "grauInstr",
            $this->std->grauinstr,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmSoc",
            ! empty($this->std->nmsoc) ? $this->std->nmsoc : null,
            false
        );

        //nascimento (obrigatorio)
        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->paisnac,
            true
        );
        $trabalhador->appendChild($nascimento);

        //Endereço (obrigatorio)
        $endereco = $this->dom->createElement("endereco");
        if (isset($this->std->endereco->brasil)) {
            $end = $this->std->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            if (! empty($end->tplograd)) {
                $this->dom->addChild(
                    $brasil,
                    "tpLograd",
                    $end->tplograd,
                    true
                );
            }
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
                ! empty($end->complemento) ? $end->complemento : null,
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
        }
        if (isset($this->std->endereco->exterior) && !isset($this->std->endereco->brasil)) {
            $end = $this->std->endereco->exterior;
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
                ! empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                ! empty($end->bairro) ? $end->bairro : null,
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
                ! empty($end->codpostal) ? $end->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $trabalhador->appendChild($endereco);

        if (isset($this->std->trabimig)) {
            $ex = $this->std->trabimig;
            $trabImig = $this->dom->createElement("trabImig");
            $this->dom->addChild(
                $trabImig,
                "tmpResid",
                $ex->tmpresid,
                true
            );
            $this->dom->addChild(
                $trabImig,
                "condIng",
                $ex->conding,
                true
            );
            $trabalhador->appendChild($trabImig);
        }

        //deficiencia (opcional)
        if (isset($this->std->infodeficiencia)) {
            $def = $this->std->infodeficiencia;
            $deficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $deficiencia,
                "defFisica",
                $def->deffisica,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defVisual",
                $def->defvisual,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defAuditiva",
                $def->defauditiva,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defMental",
                $def->defmental,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defIntelectual",
                $def->defintelectual,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "reabReadap",
                $def->reabreadap,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "infoCota",
                !empty($def->infocota) ? $def->infocota : null,
                false
            );
            $this->dom->addChild(
                $deficiencia,
                "observacao",
                ! empty($def->observacao) ? $def->observacao : null,
                false
            );
            $trabalhador->appendChild($deficiencia);
        }

        //dependentes (opcional) (ARRAY)
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
                    ! empty($dep->cpfdep) ? $dep->cpfdep : null,
                    false
                );
                $this->dom->addChild(
                    $dependente,
                    "sexoDep",
                    ! empty($dep->sexodep) ? $dep->sexodep : null,
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
                    "depSF",
                    $dep->depsf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "incTrab",
                    $dep->inctrab,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "descrDep",
                    $dep->descrdep ?? null,
                    false
                );
                $trabalhador->appendChild($dependente);
            }
        }

        //contato (opcional)
        if (isset($this->std->contato)) {
            $doc = $this->std->contato;
            $contato = $this->dom->createElement("contato");
            $this->dom->addChild(
                $contato,
                "fonePrinc",
                ! empty($doc->foneprinc) ? $doc->foneprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                ! empty($doc->emailprinc) ? $doc->emailprinc : null,
                false
            );
            $trabalhador->appendChild($contato);
        }
        //encerra trabalhador
        $this->node->appendChild($trabalhador);

        //vinculo (obrigatorio)
        $vinculo = $this->dom->createElement("vinculo");
        $vin = $this->std->vinculo;
        $this->dom->addChild(
            $vinculo,
            "matricula",
            $vin->matricula,
            true
        );
        $this->dom->addChild(
            $vinculo,
            "tpRegTrab",
            $vin->tpregtrab,
            true
        );
        $this->dom->addChild(
            $vinculo,
            "tpRegPrev",
            $vin->tpregprev,
            true
        );
        $this->dom->addChild(
            $vinculo,
            "cadIni",
            $vin->cadini,
            true
        );

        $infoRegimeTrab = $this->dom->createElement("infoRegimeTrab");
        if (isset($vin->infoceletista)) {
            $std = $vin->infoceletista;
            $celetista = $this->dom->createElement("infoCeletista");
            $this->dom->addChild(
                $celetista,
                "dtAdm",
                $std->dtadm,
                true
            );
            $this->dom->addChild(
                $celetista,
                "tpAdmissao",
                $std->tpadmissao,
                true
            );
            $this->dom->addChild(
                $celetista,
                "indAdmissao",
                $std->indadmissao,
                true
            );
            // Processo judicial obrigatorio e exclusivo quando indadmissao = 3
            if (! empty($std->nrproctrab)) {
                $this->dom->addChild(
                    $celetista,
                    "nrProcTrab",
                    $std->nrproctrab,
                    true
                );
            }
            $this->dom->addChild(
                $celetista,
                "tpRegJor",
                $std->tpregjor,
                true
            );
            $this->dom->addChild(
                $celetista,
                "natAtividade",
                $std->natatividade,
                true
            );
            $this->dom->addChild(
                $celetista,
                "dtBase",
                ! empty($std->dtbase) ? $std->dtbase : null,
                false
            );
            $this->dom->addChild(
                $celetista,
                "cnpjSindCategProf",
                $std->cnpjsindcategprof,
                true
            );
            $this->dom->addChild(
                $celetista,
                "matAnotJud",
                $std->matanotjud ?? null,
                false
            );

            //FGTS
            if (! empty($std->dtopcfgts)) {
                $fgts = $this->dom->createElement("FGTS");
                $this->dom->addChild(
                    $fgts,
                    "dtOpcFGTS",
                    $std->dtopcfgts,
                    false
                );
                $celetista->appendChild($fgts);
            }

            if (isset($std->trabtemporario)) {
                $trabTemporario = $this->dom->createElement("trabTemporario");
                $this->dom->addChild(
                    $trabTemporario,
                    "hipLeg",
                    $std->trabtemporario->hipleg,
                    true
                );
                $this->dom->addChild(
                    $trabTemporario,
                    "justContr",
                    $std->trabtemporario->justcontr,
                    true
                );
                $ideEstabVinc = $this->dom->createElement("ideEstabVinc");
                $this->dom->addChild(
                    $ideEstabVinc,
                    "tpInsc",
                    $std->trabtemporario->ideestabvinc->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $ideEstabVinc,
                    "nrInsc",
                    $std->trabtemporario->ideestabvinc->nrinsc,
                    true
                );
                $trabTemporario->appendChild($ideEstabVinc);

                //substituido (opcional) ARRAY
                if (isset($std->trabtemporario->idetrabsubstituido)) {
                    foreach ($std->trabtemporario->idetrabsubstituido as $subs) {
                        $ideTrabSubstituido = $this->dom->createElement("ideTrabSubstituido");
                        $this->dom->addChild(
                            $ideTrabSubstituido,
                            "cpfTrabSubst",
                            $subs->cpftrabsubst,
                            true
                        );
                        $trabTemporario->appendChild($ideTrabSubstituido);
                    }
                }
                $celetista->appendChild($trabTemporario);
            }
            //aprendiz (opcional)
            if (isset($std->aprend)) {
                $aprendiz = $this->dom->createElement("aprend");
                $this->dom->addChild(
                    $aprendiz,
                    "indAprend",
                    $std->aprend->indaprend,
                    true
                );
                $this->dom->addChild(
                    $aprendiz,
                    "cnpjEntQual",
                    $std->aprend->cnpjentqual ?? null,
                    false
                );
                $this->dom->addChild(
                    $aprendiz,
                    "tpInsc",
                    $std->aprend->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $aprendiz,
                    "nrInsc",
                    $std->aprend->nrinsc,
                    true
                );
                $this->dom->addChild(
                    $aprendiz,
                    "cnpjPrat",
                    $std->aprend->cnpjprat ?? null,
                    false
                );
                $celetista->appendChild($aprendiz);
            }
            $infoRegimeTrab->appendChild($celetista);
        } elseif (isset($vin->infoestatutario)) {
            $std = $vin->infoestatutario;
            $estatutario = $this->dom->createElement("infoEstatutario");
            $this->dom->addChild(
                $estatutario,
                "tpProv",
                $std->tpprov,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "dtExercicio",
                $std->dtexercicio,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "tpPlanRP",
                isset($std->tpplanrp) ? $std->tpplanrp : null, //pode ser ZERO
                false
            );
            $this->dom->addChild(
                $estatutario,
                "indTetoRGPS",
                ! empty($std->indtetorgps) ? $std->indtetorgps : null,
                false
            );
            $this->dom->addChild(
                $estatutario,
                "indAbonoPerm",
                ! empty($std->indabonoperm) ? $std->indabonoperm : null,
                false
            );
            $this->dom->addChild(
                $estatutario,
                "dtIniAbono",
                ! empty($std->dtiniabono) ? $std->dtiniabono : null,
                false
            );
            $infoRegimeTrab->appendChild($estatutario);
        }
        $vinculo->appendChild($infoRegimeTrab);

        //infoContrato (obrigatorio)
        $contrato = $this->dom->createElement("infoContrato");
        $std = $vin->infocontrato;
        $this->dom->addChild(
            $contrato,
            "nmCargo",
            ! empty($std->nmcargo) ? $std->nmcargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "CBOCargo",
            ! empty($std->cbocargo) ? $std->cbocargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "dtIngrCargo",
            ! empty($std->dtingrcargo) ? $std->dtingrcargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "nmFuncao",
            ! empty($std->nmfuncao) ? $std->nmfuncao : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "CBOFuncao",
            ! empty($std->cbofuncao) ? $std->cbofuncao : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "acumCargo",
            ! empty($std->acumcargo) ? $std->acumcargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "codCateg",
            $std->codcateg,
            true
        );
        if (isset($std->remuneracao)) {
            $rem = $std->remuneracao;
            $remuneracao = $this->dom->createElement("remuneracao");
            $this->dom->addChild(
                $remuneracao,
                "vrSalFx",
                $rem->vrsalfx,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "undSalFixo",
                $rem->undsalfixo,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "dscSalVar",
                ! empty($rem->dscsalvar) ? $rem->dscsalvar : null,
                false
            );
            $contrato->appendChild($remuneracao);
        }
        if (isset($std->duracao)) {
            $dur = $std->duracao;
            $duracao = $this->dom->createElement("duracao");
            $this->dom->addChild(
                $duracao,
                "tpContr",
                $dur->tpcontr,
                true
            );
            $this->dom->addChild(
                $duracao,
                "dtTerm",
                $dur->dtterm ?? null,
                false
            );
            $this->dom->addChild(
                $duracao,
                "clauAssec",
                $dur->clauassec ?? null,
                false
            );
            if ((int)$dur->tpcontr == 3) {
                $this->dom->addChild(
                    $duracao,
                    "objDet",
                    $dur->objdet ?? null,
                    false
                );
            }
            $contrato->appendChild($duracao);
        }
        //localTrabalho (obrigatorio)
        $localTrabalho = $this->dom->createElement("localTrabalho");
        //localTrabGeral (opcional)
        if (isset($std->localtrabgeral)) {
            $localgeral = $this->dom->createElement("localTrabGeral");
            $this->dom->addChild(
                $localgeral,
                "tpInsc",
                $std->localtrabgeral->tpinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "nrInsc",
                $std->localtrabgeral->nrinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "descComp",
                ! empty($std->localtrabgeral->desccomp) ? $std->localtrabgeral->desccomp : null,
                false
            );
            $localTrabalho->appendChild($localgeral);
        }
        //localTempDom (opcional)
        if (isset($std->localtempdom)) {
            $ld = $std->localtempdom;
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
        $contrato->appendChild($localTrabalho);

        //horContratual (opcional)
        if (isset($std->horcontratual)) {
            $hc = $std->horcontratual;
            $horContratual = $this->dom->createElement("horContratual");
            if (! empty($hc->qtdhrssem)) {
                $this->dom->addChild(
                    $horContratual,
                    "qtdHrsSem",
                    $hc->qtdhrssem,
                    true
                );
            }
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
            $contrato->appendChild($horContratual);
        }
        //alvaraJudicial (opcional)
        if (isset($std->alvarajudicial)) {
            $alvaraJudicial = $this->dom->createElement("alvaraJudicial");
            $this->dom->addChild(
                $alvaraJudicial,
                "nrProcJud",
                $std->alvarajudicial->nrprocjud,
                true
            );
            $contrato->appendChild($alvaraJudicial);
        }
        //observacoes (opcional)
        if (isset($std->observacoes)) {
            foreach ($std->observacoes as $obs) {
                $observacoes = $this->dom->createElement("observacoes");
                $this->dom->addChild(
                    $observacoes,
                    "observacao",
                    $obs->observacao,
                    true
                );
                $contrato->appendChild($observacoes);
            }
        }
        //treiCap (opcional)
        if (isset($std->treicap)) {
            foreach ($std->treicap as $trein) {
                $treiCap = $this->dom->createElement("treiCap");
                $this->dom->addChild(
                    $treiCap,
                    "codTreiCap",
                    $trein->codtreicap,
                    true
                );
                $contrato->appendChild($treiCap);
            }
        }
        $vinculo->appendChild($contrato);

        //sucessaoVinc (opcional)
        if (isset($vin->sucessaovinc)) {
            $std = $vin->sucessaovinc;
            $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
            $this->dom->addChild(
                $sucessaoVinc,
                "tpInsc",
                !empty($std->tpinsc) ? $std->tpinsc : null,
                false
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "nrInsc",
                $std->nrinsc,
                true
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "matricAnt",
                ! empty($std->matricant) ? $std->matricant : null,
                false
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "dtTransf",
                $std->dttransf,
                true
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "observacao",
                ! empty($std->observacao) ? $std->observacao : null,
                false
            );
            $vinculo->appendChild($sucessaoVinc);
        }
        //transfDom (opcional)
        if (isset($vin->transfdom)) {
            $std = $vin->transfdom;
            $transfDom = $this->dom->createElement("transfDom");
            $this->dom->addChild(
                $transfDom,
                "cpfSubstituido",
                $std->cpfsubstituido,
                true
            );
            $this->dom->addChild(
                $transfDom,
                "matricAnt",
                ! empty($std->matricant) ? $std->matricant : null,
                false
            );
            $this->dom->addChild(
                $transfDom,
                "dtTransf",
                $std->dttransf,
                true
            );
            $vinculo->appendChild($transfDom);
        }
        //mudancaCPF (opcional)
        if (isset($vin->mudancacpf)) {
            $std = $vin->mudancacpf;
            $mudancaCPF = $this->dom->createElement("mudancaCPF");
            $this->dom->addChild(
                $mudancaCPF,
                "cpfAnt",
                $std->cpfant,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "matricAnt",
                ! empty($std->matricant) ? $std->matricant : null,
                false
            );
            $this->dom->addChild(
                $mudancaCPF,
                "dtAltCPF",
                $std->dtaltcpf,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "observacao",
                ! empty($std->observacao) ? $std->observacao : null,
                false
            );
            $vinculo->appendChild($mudancaCPF);
        }

        //afastamento (opcional)
        if (isset($this->std->vinculo->afastamento)) {
            $std = $this->std->vinculo->afastamento;
            $afastamento = $this->dom->createElement("afastamento");
            $this->dom->addChild(
                $afastamento,
                "dtIniAfast",
                $std->dtiniafast,
                true
            );
            $this->dom->addChild(
                $afastamento,
                "codMotAfast",
                $std->codmotafast,
                true
            );
            $vinculo->appendChild($afastamento);
        }

        //desligamento (opcional)
        if (isset($this->std->vinculo->desligamento)) {
            $std = $this->std->vinculo->desligamento;
            $desligamento = $this->dom->createElement("desligamento");
            $this->dom->addChild(
                $desligamento,
                "dtDeslig",
                $std->dtdeslig,
                true
            );
            $vinculo->appendChild($desligamento);
        }

        //cessao (opcional)
        if (isset($this->std->vinculo->cessao)) {
            $std = $this->std->vinculo->cessao;
            $cessao = $this->dom->createElement("cessao");
            $this->dom->addChild(
                $cessao,
                "dtIniCessao",
                $std->dtinicessao,
                true
            );
            $vinculo->appendChild($cessao);
        }

        //encerra vinculo
        $this->node->appendChild($vinculo);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
