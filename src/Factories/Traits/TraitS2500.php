<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2500
{
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S 1.0.0 !!");
    }

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);
        $ideresp = $this->dom->createElement("ideResp");
        $this->dom->addChild(
            $ideresp,
            "tpInsc",
            $this->std->ideresp->tpinsc,
            true
        );
        $this->dom->addChild(
            $ideresp,
            "nrInsc",
            $this->std->ideresp->nrinsc,
            true
        );
        $ideEmpregador->appendChild($ideresp);
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
        $infoProc = $this->dom->createElement("infoProcesso");
        $this->dom->addChild(
            $infoProc,
            "origem",
            $this->std->origem,
            true
        );
        $this->dom->addChild(
            $infoProc,
            "nrProcTrab",
            $this->std->nrproctrab,
            true
        );
        $this->dom->addChild(
            $infoProc,
            "obsProcTrab",
            !empty($this->std->obsproctrab) ? $this->std->obsproctrab : null,
            false
        );
        $dados = $this->dom->createElement('dadosCompl');
        if (!empty($this->std->infoprocjud)) {
            $info = $this->std->infoprocjud;
            $infojud = $this->dom->createElement('infoProcJud');
            $this->dom->addChild(
                $infojud,
                "dtSent",
                $info->dtsent,
                true
            );
            $this->dom->addChild(
                $infojud,
                "ufVara",
                $info->ufvara,
                true
            );
            $this->dom->addChild(
                $infojud,
                "codMunic",
                $info->codmunic,
                true
            );
            $this->dom->addChild(
                $infojud,
                "idVara",
                $info->idvara,
                true
            );
            $dados->appendChild($infojud);
        } elseif (!empty($this->std->infoccp)) {
            $info = $this->std->infoccp;
            $infoccp = $this->dom->createElement('infoCCP');
            $this->dom->addChild(
                $infoccp,
                "dtCCP",
                $info->dtccp,
                true
            );
            $this->dom->addChild(
                $infoccp,
                "tpCCP",
                $info->tpccp,
                true
            );
            $this->dom->addChild(
                $infoccp,
                "cnpjCCP",
                !empty($info->cnpjccp) ? $info->cnpjccp : null,
                false
            );
            $dados->appendChild($infoccp);
        }
        $infoProc->appendChild($dados);
        $this->node->appendChild($infoProc);
        $idetrab = $this->dom->createElement("ideTrab");
        $this->dom->addChild(
            $idetrab,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $idetrab,
            "nmTrab",
            $this->std->nmtrab,
            true
        );
        $this->dom->addChild(
            $idetrab,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        foreach ($this->std->dependente as $dep) {
            $dependente = $this->dom->createElement("dependente");
            $this->dom->addChild(
                $dependente,
                "cpfDep",
                $dep->cpfdep,
                true
            );
            $this->dom->addChild(
                $dependente,
                "tpDep",
                $dep->tpdep,
                true
            );
            if ($dep->tpdep === '99') {
                $this->dom->addChild(
                    $dependente,
                    "descDep",
                    $dep->descdep,
                    true
                );
            }
            $idetrab->appendChild($dependente);
        }
        foreach ($this->std->infocontr as $ict) {
            $infoc = $this->dom->createElement("infoContr");
            $this->dom->addChild(
                $infoc,
                "tpContr",
                $ict->tpcontr,
                true
            );
            $this->dom->addChild(
                $infoc,
                "indContr",
                $ict->indcontr,
                true
            );
            $this->dom->addChild(
                $infoc,
                "dtAdmOrig",
                !empty($ict->dtadmorig) ? $ict->dtadmorig : null,
                false
            );
            $this->dom->addChild(
                $infoc,
                "indReint",
                !empty($ict->indreint) ? $ict->indreint : null,
                false
            );
            $this->dom->addChild(
                $infoc,
                "indCateg",
                $ict->indcateg,
                true
            );
            $this->dom->addChild(
                $infoc,
                "indNatAtiv",
                $ict->indnatativ,
                true
            );
            $this->dom->addChild(
                $infoc,
                "indMotDeslig",
                $ict->indmotdeslig,
                true
            );
            $this->dom->addChild(
                $infoc,
                "indUnic",
                !empty($ict->indunic) ? $ict->indunic : null,
                false
            );
            $this->dom->addChild(
                $infoc,
                "matricula",
                !empty($ict->matricula) ? $ict->matricula : null,
                false
            );
            $this->dom->addChild(
                $infoc,
                "codCateg",
                !empty($ict->codcateg) ? $ict->codcateg : null,
                false
            );
            $this->dom->addChild(
                $infoc,
                "dtInicio",
                !empty($ict->dtinicio) ? $ict->dtinicio : null,
                false
            );
            if (!empty($ict->infocompl)) {
                $co = $ict->infocompl;
                $icmp = $this->dom->createElement("infoCompl");
                $this->dom->addChild(
                    $icmp,
                    "codCBO",
                    !empty($co->codcbo) ? $co->codcbo : null,
                    false
                );
                $this->dom->addChild(
                    $icmp,
                    "natAtividade",
                    !empty($co->natatividade) ? $co->natatividade : null,
                    false
                );
                if (!empty($co->remuneracao)) {
                    foreach ($co->remuneracao as $rem) {
                        $remu = $this->dom->createElement("remuneracao");
                        $this->dom->addChild(
                            $remu,
                            "dtRemun",
                            $rem->dtremun,
                            true
                        );
                        $this->dom->addChild(
                            $remu,
                            "vrSalFx",
                            $rem->vrsalfx,
                            true
                        );
                        $this->dom->addChild(
                            $remu,
                            "undSalFixo",
                            $rem->undsalfixo,
                            true
                        );
                        $this->dom->addChild(
                            $remu,
                            "dscSalVar",
                            !empty($rem->dscsalvar) ? $rem->dscsalvar : null,
                            false
                        );
                        $icmp->appendChild($remu);
                    }
                }
                if (!empty($co->infovinc)) {
                    $vinc = $co->infovinc;
                    $vinculo = $this->dom->createElement("infoVinc");
                    $this->dom->addChild(
                        $vinculo,
                        "tpRegTrab",
                        $vinc->tpregtrab,
                        true
                    );
                    $this->dom->addChild(
                        $vinculo,
                        "tpRegPrev",
                        $vinc->tpregprev,
                        true
                    );
                    $this->dom->addChild(
                        $vinculo,
                        "dtAdm",
                        $vinc->dtadm,
                        true
                    );
                    $this->dom->addChild(
                        $vinculo,
                        "dtAdm",
                        $vinc->tmpParc ?? null,
                        false
                    );
                    if (!empty($vinc->duracao)) {
                        $dc = $vinc->duracao;
                        $dura = $this->dom->createElement("duracao");
                        $this->dom->addChild(
                            $dura,
                            "tpContr",
                            $dc->tpcontr,
                            true
                        );
                        $this->dom->addChild(
                            $dura,
                            "dtTerm",
                            !empty($dc->dtterm) ? $dc->dtterm : null,
                            false
                        );
                        $this->dom->addChild(
                            $dura,
                            "clauAssec",
                            !empty($dc->clauassec) ? $dc->clauassec : null,
                            false
                        );
                        $this->dom->addChild(
                            $dura,
                            "objDet",
                            !empty($dc->objdet) ? $dc->objdet : null,
                            false
                        );
                        $vinculo->appendChild($dura);
                    }
                    if (!empty($vinc->observacoes)) {
                        foreach ($vinc->observacoes as $obs) {
                            $observ = $this->dom->createElement("observacoes");
                            $this->dom->addChild(
                                $observ,
                                "observacao",
                                $obs->observacao,
                                true
                            );
                            $vinculo->appendChild($observ);
                        }
                    }
                    if (!empty($vinc->sucessaovinc)) {
                        $sv = $vinc->sucessaovinc;
                        $succ = $this->dom->createElement("sucessaoVinc");
                        $this->dom->addChild(
                            $succ,
                            "tpInsc",
                            $sv->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $succ,
                            "nrInsc",
                            $sv->nrinsc,
                            true
                        );
                        $this->dom->addChild(
                            $succ,
                            "matricAnt",
                            !empty($sv->matricant) ? $sv->matricant : null,
                            false
                        );
                        $this->dom->addChild(
                            $succ,
                            "dtTransf",
                            $sv->dttransf,
                            true
                        );
                        $vinculo->appendChild($succ);
                    }
                    $dd = $vinc->infodeslig;
                    $deslig = $this->dom->createElement("infoDeslig");
                    $this->dom->addChild(
                        $deslig,
                        "dtDeslig",
                        $dd->dtdeslig,
                        true
                    );
                    $this->dom->addChild(
                        $deslig,
                        "mtvDeslig",
                        $dd->mtvdeslig,
                        true
                    );
                    $this->dom->addChild(
                        $deslig,
                        "dtProjFimAPI",
                        !empty($dd->dtprojfimapi) ? $dd->dtprojfimapi : null,
                        false
                    );
                    $vinculo->appendChild($deslig);
                    $icmp->appendChild($vinculo);
                }
                if (!empty($co->infoterm)) {
                    $term = $this->dom->createElement("infoTerm");
                    $this->dom->addChild(
                        $term,
                        "dtTerm",
                        $co->infoterm->dtterm,
                        true
                    );
                    $this->dom->addChild(
                        $term,
                        "mtvDesligTSV",
                        !empty($co->infoterm->mtvdesligtsv) ? $co->infoterm->mtvdesligtsv : null,
                        false
                    );
                    $icmp->appendChild($term);
                }
                $infoc->appendChild($icmp);
            }
            if (!empty($ict->mudcategativ)) {
                foreach ($ict->mudcategativ as $muda) {
                    $mudacat = $this->dom->createElement("mudCategAtiv");
                    $this->dom->addChild(
                        $mudacat,
                        "codCateg",
                        $muda->codcateg,
                        true
                    );
                    $this->dom->addChild(
                        $mudacat,
                        "natAtividade",
                        !empty($muda->natatividade) ? $muda->natatividade : null,
                        false
                    );
                    $this->dom->addChild(
                        $mudacat,
                        "dtMudCategAtiv",
                        $muda->dtmudcategativ,
                        true
                    );
                    $infoc->appendChild($mudacat);
                }
            }
            if (!empty($ict->uniccontr)) {
                foreach ($ict->uniccontr as $uni) {
                    $unic = $this->dom->createElement("unicContr");
                    $this->dom->addChild(
                        $unic,
                        "matUnic",
                        !empty($uni->matunic) ? $uni->matunic : null,
                        false
                    );
                    $this->dom->addChild(
                        $unic,
                        "codCateg",
                        !empty($uni->codcateg) ? $uni->codcateg : null,
                        false
                    );
                    $this->dom->addChild(
                        $unic,
                        "dtInicio",
                        !empty($uni->dtInicio) ? $uni->dtInicio : null,
                        false
                    );
                    $infoc->appendChild($unic);
                }
            }
            $idestab = $ict->ideestab;
            $estab = $this->dom->createElement("ideEstab");
            $this->dom->addChild(
                $estab,
                "tpInsc",
                $idestab->tpinsc,
                true
            );
            $this->dom->addChild(
                $estab,
                "nrInsc",
                $idestab->nrinsc,
                true
            );
            $vlr = $idestab->infovlr;
            $ivlr = $this->dom->createElement("infoVlr");
            $this->dom->addChild(
                $ivlr,
                "compIni",
                $vlr->compini,
                true
            );
            $this->dom->addChild(
                $ivlr,
                "compFim",
                $vlr->compfim,
                true
            );
            $this->dom->addChild(
                $ivlr,
                "repercProc",
                $vlr->repercproc,
                true
            );
            $this->dom->addChild(
                $ivlr,
                "vrRemun",
                $vlr->vrremun,
                true
            );
            $this->dom->addChild(
                $ivlr,
                "vrAPI",
                $vlr->vrapi,
                true
            );
            $this->dom->addChild(
                $ivlr,
                "vr13API",
                $vlr->vr13api,
                true
            );
            $this->dom->addChild(
                $ivlr,
                "vrInden",
                $vlr->vrinden,
                true
            );
            $this->dom->addChild(
                $ivlr,
                "vrBaseIndenFGTS",
                !empty($vlr->vrbaseindenfgts) ? $vlr->vrbaseindenfgts : null,
                false
            );
            $this->dom->addChild(
                $ivlr,
                "pagDiretoResc",
                !empty($vlr->pagdiretoresc) ? $vlr->pagdiretoresc : null,
                false
            );

            if (!empty($vlr->ideperiodo)) {
                foreach ($vlr->ideperiodo as $per) {
                    $ideper = $this->dom->createElement("idePeriodo");
                    $this->dom->addChild(
                        $ideper,
                        "perRef",
                        $per->perref,
                        true
                    );
                    $base = $this->dom->createElement("baseCalculo");
                    $this->dom->addChild(
                        $base,
                        "vrBcCpMensal",
                        $per->vrbccpmensal,
                        true
                    );
                    $this->dom->addChild(
                        $base,
                        "vrBcCp13",
                        $per->vrbccp13,
                        true
                    );
                    $this->dom->addChild(
                        $base,
                        "vrBcFgts",
                        $per->vrbcfgts,
                        true
                    );
                    $this->dom->addChild(
                        $base,
                        "vrBcFgts13",
                        $per->vrbcfgts13,
                        true
                    );
                    if (!empty($per->infoagnocivo)) {
                        $noc = $this->dom->createElement("infoAgNocivo");
                        $this->dom->addChild(
                            $noc,
                            "grauExp",
                            $per->infoagnocivo->grauexp,
                            true
                        );
                        $base->appendChild($noc);
                    }
                    $ideper->appendChild($base);
                    if (!empty($per->infofgts)) {
                        $fgts = $this->dom->createElement("infoFGTS");
                        $this->dom->addChild(
                            $fgts,
                            "vrBcFgtsGuia",
                            $per->infofgts->vrbcfgtsguia,
                            true
                        );
                        $this->dom->addChild(
                            $fgts,
                            "vrBcFgts13Guia",
                            $per->infofgts->vrbcfgts13guia,
                            true
                        );
                        $this->dom->addChild(
                            $fgts,
                            "pagDireto",
                            $per->infofgts->pagdireto,
                            true
                        );
                        $ideper->appendChild($fgts);
                    }
                    if (!empty($per->basemudcateg)) {
                        $mudab = $this->dom->createElement("baseMudCateg");
                        $this->dom->addChild(
                            $mudab,
                            "codCateg",
                            $per->basemudcateg->codcateg,
                            true
                        );
                        $this->dom->addChild(
                            $mudab,
                            "vrBcCPrev",
                            $per->basemudcateg->vrbccprev,
                            true
                        );
                        $ideper->appendChild($mudab);
                    }
                    $ivlr->appendChild($ideper);
                }
            }
            $estab->appendChild($ivlr);
            $infoc->appendChild($estab);
            $idetrab->appendChild($infoc);
        }
        $this->node->appendChild($idetrab);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    /**
     * builder for version S.1.2.0
     */
    protected function toNodeS120()
    {
        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);
        if (!empty($this->std->ideresp)) {
            $ideresp = $this->dom->createElement("ideResp");
            $this->dom->addChild(
                $ideresp,
                "tpInsc",
                $this->std->ideresp->tpinsc,
                true
            );
            $this->dom->addChild(
                $ideresp,
                "nrInsc",
                $this->std->ideresp->nrinsc,
                true
            );
            $ideEmpregador->appendChild($ideresp);
        }
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
        $infoProc = $this->dom->createElement("infoProcesso");
        $this->dom->addChild(
            $infoProc,
            "origem",
            $this->std->origem,
            true
        );
        $this->dom->addChild(
            $infoProc,
            "nrProcTrab",
            $this->std->nrproctrab,
            true
        );
        $this->dom->addChild(
            $infoProc,
            "obsProcTrab",
            $this->std->obsproctrab ?? null,
            false
        );
        $dados = $this->dom->createElement('dadosCompl');
        if (!empty($this->std->infoprocjud)) {
            $info = $this->std->infoprocjud;
            $infojud = $this->dom->createElement('infoProcJud');
            $this->dom->addChild(
                $infojud,
                "dtSent",
                $info->dtsent,
                true
            );
            $this->dom->addChild(
                $infojud,
                "ufVara",
                $info->ufvara,
                true
            );
            $this->dom->addChild(
                $infojud,
                "codMunic",
                $info->codmunic,
                true
            );
            $this->dom->addChild(
                $infojud,
                "idVara",
                $info->idvara,
                true
            );
            $dados->appendChild($infojud);
        } elseif (!empty($this->std->infoccp)) {
            $info = $this->std->infoccp;
            $infoccp = $this->dom->createElement('infoCCP');
            $this->dom->addChild(
                $infoccp,
                "dtCCP",
                $info->dtccp,
                true
            );
            $this->dom->addChild(
                $infoccp,
                "tpCCP",
                $info->tpccp,
                true
            );
            $this->dom->addChild(
                $infoccp,
                "cnpjCCP",
                $info->cnpjccp ?? null,
                false
            );
            $dados->appendChild($infoccp);
        }
        $infoProc->appendChild($dados);
        $this->node->appendChild($infoProc);
        $idetrab = $this->dom->createElement("ideTrab");
        $this->dom->addChild(
            $idetrab,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $idetrab,
            "nmTrab",
            $this->std->nmtrab ?? null,
            false
        );
        $this->dom->addChild(
            $idetrab,
            "dtNascto",
            $this->std->dtnascto ?? null,
            false
        );
        foreach ($this->std->infocontr as $ictr) {
            $infoctr = $this->dom->createElement("infoContr");
            $this->dom->addChild(
                $infoctr,
                "tpContr",
                $ictr->tpcontr,
                true
            );
            $this->dom->addChild(
                $infoctr,
                "indContr",
                $ictr->indcontr,
                true
            );
            $this->dom->addChild(
                $infoctr,
                "dtAdmOrig",
                $ictr->dtadmorig ?? null,
                false
            );
            $this->dom->addChild(
                $infoctr,
                "indReint",
                $ictr->indreint ?? null,
                false
            );
            $this->dom->addChild(
                $infoctr,
                "indCateg",
                $ictr->indcateg,
                true
            );
            $this->dom->addChild(
                $infoctr,
                "indNatAtiv",
                $ictr->indnatativ,
                true
            );
            $this->dom->addChild(
                $infoctr,
                "indMotDeslig",
                $ictr->indmotdeslig,
                true
            );
            $this->dom->addChild(
                $infoctr,
                "matricula",
                $ictr->matricula ?? null,
                false
            );
            $this->dom->addChild(
                $infoctr,
                "codCateg",
                $ictr->codcateg ?? null,
                false
            );
            $this->dom->addChild(
                $infoctr,
                "dtInicio",
                $ictr->dtinicio ?? null,
                false
            );
            if (!empty($ictr->infocompl)) {
                $icl = $ictr->infocompl;
                $icom = $this->dom->createElement("infoCompl");
                $this->dom->addChild(
                    $icom,
                    "codCBO",
                    $icl->codcbo ?? null,
                    false
                );
                $this->dom->addChild(
                    $icom,
                    "natAtividade",
                    $icl->natatividade ?? null,
                    false
                );
                if (!empty($icl->remuneracao)) {
                    foreach ($icl->remuneracao as $rem) {
                        $remu = $this->dom->createElement("remuneracao");
                        $this->dom->addChild(
                            $remu,
                            "dtRemun",
                            $rem->dtremun,
                            true
                        );
                        $this->dom->addChild(
                            $remu,
                            "vrSalFx",
                            $rem->vrsalfx,
                            true
                        );
                        $this->dom->addChild(
                            $remu,
                            "undSalFixo",
                            $rem->undsalfixo,
                            true
                        );
                        $this->dom->addChild(
                            $remu,
                            "dscSalVar",
                            $rem->dscsalvar ?? null,
                            false
                        );
                        $icom->appendChild($remu);
                    }
                }
                if (!empty($icl->infovinc)) {
                    $vinc = $icl->infovinc;
                    $infoVinc = $this->dom->createElement("infoVinc");
                    $this->dom->addChild(
                        $infoVinc,
                        "tpRegTrab",
                        $vinc->tpregtrab,
                        true
                    );
                    $this->dom->addChild(
                        $infoVinc,
                        "tpRegPrev",
                        $vinc->tpregprev,
                        true
                    );
                    $this->dom->addChild(
                        $infoVinc,
                        "dtAdm",
                        $vinc->dtadm,
                        true
                    );
                    $this->dom->addChild(
                        $infoVinc,
                        "tmpParc",
                        $vinc->tmpparc ?? null,
                        false
                    );
                    if (!empty($vinc->duracao)) {
                        $dur = $vinc->duracao;
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
                            $dur->dtrerm ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $duracao,
                            "clauAssec",
                            $dur->clauassec ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $duracao,
                            "objDet",
                            $dur->objdet ?? null,
                            false
                        );
                        $infoVinc->appendChild($duracao);
                    }
                    if (!empty($vinc->observacoes)) {
                        foreach ($vinc->observacoes as $obs) {
                            $observacoes = $this->dom->createElement("observacoes");
                            $this->dom->addChild(
                                $observacoes,
                                "observacao",
                                $obs->observacao,
                                true
                            );
                            $infoVinc->appendChild($observacoes);
                        }
                    }
                    if (!empty($vinc->sucessaovinc)) {
                        $suss = $vinc->sucessaovinc;
                        $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
                        $this->dom->addChild(
                            $sucessaoVinc,
                            "tpInsc",
                            $suss->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $sucessaoVinc,
                            "nrInsc",
                            $suss->nrinsc,
                            true
                        );
                        $this->dom->addChild(
                            $sucessaoVinc,
                            "matricAnt",
                            $suss->matricant ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $sucessaoVinc,
                            "dtTransf",
                            $suss->dttransf,
                            true
                        );
                        $infoVinc->appendChild($sucessaoVinc);
                    }
                    $des = $vinc->infodeslig;
                    $infoDeslig = $this->dom->createElement("infoDeslig");
                    $this->dom->addChild(
                        $infoDeslig,
                        "dtDeslig",
                        $des->dtdeslig,
                        true
                    );
                    $this->dom->addChild(
                        $infoDeslig,
                        "mtvDeslig",
                        $des->mtvdeslig,
                        true
                    );
                    $this->dom->addChild(
                        $infoDeslig,
                        "dtProjFimAPI",
                        $des->dtprojfimapi ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $infoDeslig,
                        "pensAlim",
                        $des->pensalim ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $infoDeslig,
                        "percAliment",
                        $des->percaliment ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $infoDeslig,
                        "vrAlim",
                        $des->vralim ?? null,
                        false
                    );
                    $infoVinc->appendChild($infoDeslig);
                    $icom->appendChild($infoVinc);
                }
                if (!empty($icl->infoterm)) {
                    $it = $icl->infoterm;
                    $infoTerm = $this->dom->createElement("infoTerm");
                    $this->dom->addChild(
                        $infoTerm,
                        "dtTerm",
                        $it->dtterm,
                        true
                    );
                    $this->dom->addChild(
                        $infoTerm,
                        "mtvDesligTSV",
                        $it->mtvdesligtsv ?? null,
                        false
                    );
                    $icom->appendChild($infoTerm);
                }
                $infoctr->appendChild($icom);
                if (!empty($ictr->mudcategativ)) {
                    foreach ($ictr->mudcategativ as $mud) {
                        $mudCategAtiv = $this->dom->createElement("mudCategAtiv");
                        $this->dom->addChild(
                            $mudCategAtiv,
                            "codCateg",
                            $mud->codcateg,
                            true
                        );
                        $this->dom->addChild(
                            $mudCategAtiv,
                            "natAtividade",
                            $mud->natatividade ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $mudCategAtiv,
                            "dtMudCategAtiv",
                            $mud->dtmudcategativ,
                            true
                        );
                        $infoctr->appendChild($mudCategAtiv);
                    }
                }
                if (!empty($ictr->uniccontr)) {
                    foreach ($ictr->uniccontr as $uni) {
                        $unicContr = $this->dom->createElement("unicContr");
                        $this->dom->addChild(
                            $unicContr,
                            "matUnic",
                            $uni->matunic ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $unicContr,
                            "codCateg",
                            $uni->codcateg ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $unicContr,
                            "dtInicio",
                            $uni->dtinicio ?? null,
                            false
                        );
                        $infoctr->appendChild($unicContr);
                    }
                }
                $idestab = $ictr->ideestab;
                $estab = $this->dom->createElement("ideEstab");
                $this->dom->addChild(
                    $estab,
                    "tpInsc",
                    $idestab->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $estab,
                    "nrInsc",
                    $idestab->nrinsc,
                    true
                );
                $vlr = $idestab->infovlr;
                $ivlr = $this->dom->createElement("infoVlr");
                $this->dom->addChild(
                    $ivlr,
                    "compIni",
                    $vlr->compini,
                    true
                );
                $this->dom->addChild(
                    $ivlr,
                    "compFim",
                    $vlr->compfim,
                    true
                );
                $this->dom->addChild(
                    $ivlr,
                    "indReperc",
                    $vlr->indreperc,
                    true
                );
                $this->dom->addChild(
                    $ivlr,
                    "indenSD",
                    $vlr->indensd,
                    true
                );
                $this->dom->addChild(
                    $ivlr,
                    "indenAbono",
                    $vlr->indenabono,
                    true
                );
                if (!empty($vlr->abono)) {
                    foreach ($vlr->abono as $ab) {
                        $abono = $this->dom->createElement("abono");
                        $this->dom->addChild(
                            $abono,
                            "anoBase",
                            $ab->anobase,
                            true
                        );
                        $ivlr->appendChild($abono);
                    }
                }
                if (!empty($vlr->ideperiodo)) {
                    foreach ($vlr->ideperiodo as $per) {
                        $ideper = $this->dom->createElement("idePeriodo");
                        $this->dom->addChild(
                            $ideper,
                            "perRef",
                            $per->perref,
                            true
                        );
                        if (!empty($per->basecalculo)) {
                            $bc = $per->basecalculo;
                            $base = $this->dom->createElement("baseCalculo");
                            $this->dom->addChild(
                                $base,
                                "vrBcCpMensal",
                                $bc->vrbccpmensal,
                                true
                            );
                            $this->dom->addChild(
                                $base,
                                "vrBcCp13",
                                $bc->vrbccp13,
                                true
                            );
                            if (!empty($bc->infoagnocivo)) {
                                $noc = $this->dom->createElement("infoAgNocivo");
                                $this->dom->addChild(
                                    $noc,
                                    "grauExp",
                                    $bc->infoagnocivo->grauexp,
                                    true
                                );
                                $base->appendChild($noc);
                            }
                            $ideper->appendChild($base);
                        }
                        if (!empty($per->infofgts)) {
                            $fg = $per->infofgts;
                            $fgts = $this->dom->createElement("infoFGTS");
                            $this->dom->addChild(
                                $fgts,
                                "vrBcFGTSProcTrab",
                                $fg->vrbcfgtsproctrab,
                                true
                            );
                            $this->dom->addChild(
                                $fgts,
                                "vrBcFGTSSefip",
                                $fg->vrbcfgtssefip ?? null,
                                false
                            );
                            $this->dom->addChild(
                                $fgts,
                                "vrBcFGTSDecAnt",
                                $fg->vrbcfgtsdecant ?? null,
                                false
                            );
                            $ideper->appendChild($fgts);
                        }
                        if (!empty($per->basemudcateg)) {
                            $bm = $per->basemudcateg;
                            $mudab = $this->dom->createElement("baseMudCateg");
                            $this->dom->addChild(
                                $mudab,
                                "codCateg",
                                $bm->codcateg,
                                true
                            );
                            $this->dom->addChild(
                                $mudab,
                                "vrBcCPrev",
                                $bm->vrbccprev,
                                true
                            );
                            $ideper->appendChild($mudab);
                        }
                        $ivlr->appendChild($ideper);
                    }
                }
                $estab->appendChild($ivlr);
                $infoctr->appendChild($estab);
            }

            $idetrab->appendChild($infoctr);
        }
         $this->node->appendChild($idetrab);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
