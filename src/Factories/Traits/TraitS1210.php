<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1210
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
            "perApur",
            $this->std->perapur,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "indGuia",
            !empty($this->std->indguia) ? $this->std->indguia : null,
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
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        foreach ($this->std->infopgto as $pgto) {
            $infoPgto = $this->dom->createElement("infoPgto");
            $this->dom->addChild(
                $infoPgto,
                "dtPgto",
                $pgto->dtpgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "tpPgto",
                $pgto->tppgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "perRef",
                $pgto->perref,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "ideDmDev",
                $pgto->idedmdev,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "vrLiq",
                $pgto->vrliq,
                true
            );
            $ideBenef->appendChild($infoPgto);
        }
        $this->node->appendChild($ideBenef);
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
            "perApur",
            $this->std->perapur,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "indGuia",
            !empty($this->std->indguia) ? $this->std->indguia : null,
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
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        foreach ($this->std->infopgto as $pgto) {
            $infoPgto = $this->dom->createElement("infoPgto");
            $this->dom->addChild(
                $infoPgto,
                "dtPgto",
                $pgto->dtpgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "tpPgto",
                $pgto->tppgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "perRef",
                $pgto->perref,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "ideDmDev",
                $pgto->idedmdev,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "vrLiq",
                $pgto->vrliq,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "paisResidExt",
                $pgto->paisresidext ?? null,
                false
            );
            if (!empty($pgto->paisresidext) && !empty($pgto->infopgtoext)) {
                $ext = $pgto->infopgtoext;
                $pgtoext = $this->dom->createElement("infoPgtoExt");
                $this->dom->addChild(
                    $pgtoext,
                    "indNIF",
                    $ext->indnif,
                    true
                );
                $this->dom->addChild(
                    $pgtoext,
                    "nifBenef",
                    $ext->nifbenef ?? null,
                    false
                );
                $this->dom->addChild(
                    $pgtoext,
                    "frmTribut",
                    $ext->frmtribut,
                    true
                );
                if (!empty($ext->endext)) {
                    $end = $ext->endext;
                    $endext = $this->dom->createElement("endExt");
                    $this->dom->addChild(
                        $endext,
                        "endDscLograd",
                        $end->enddsclograd ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endNrLograd",
                        $end->endnrlograd ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endComplem",
                        $end->endcomplem ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endBairro",
                        $end->endbairro ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endCidade",
                        $end->endcidade ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endEstado",
                        $end->endestado ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endCodPostal",
                        $end->endcodpostal ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "telef",
                        $end->telef ?? null,
                        false
                    );
                    $pgtoext->appendChild($endext);
                }

                $infoPgto->appendChild($pgtoext);
            }
            $ideBenef->appendChild($infoPgto);
        }
        $this->node->appendChild($ideBenef);
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
            "perApur",
            $this->std->perapur,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "indGuia",
            !empty($this->std->indguia) ? $this->std->indguia : null,
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
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        foreach ($this->std->infopgto as $pgto) {
            $infoPgto = $this->dom->createElement("infoPgto");
            $this->dom->addChild(
                $infoPgto,
                "dtPgto",
                $pgto->dtpgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "tpPgto",
                $pgto->tppgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "perRef",
                $pgto->perref,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "ideDmDev",
                $pgto->idedmdev,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "vrLiq",
                $pgto->vrliq,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "paisResidExt",
                $pgto->paisresidext ?? null,
                false
            );
            if (!empty($pgto->paisresidext) && !empty($pgto->infopgtoext)) {
                $ext = $pgto->infopgtoext;
                $pgtoext = $this->dom->createElement("infoPgtoExt");
                $this->dom->addChild(
                    $pgtoext,
                    "indNIF",
                    $ext->indnif,
                    true
                );
                $this->dom->addChild(
                    $pgtoext,
                    "nifBenef",
                    $ext->nifbenef ?? null,
                    false
                );
                $this->dom->addChild(
                    $pgtoext,
                    "frmTribut",
                    $ext->frmtribut,
                    true
                );
                if (!empty($ext->endext)) {
                    $end = $ext->endext;
                    $endext = $this->dom->createElement("endExt");
                    $this->dom->addChild(
                        $endext,
                        "endDscLograd",
                        $end->enddsclograd ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endNrLograd",
                        $end->endnrlograd ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endComplem",
                        $end->endcomplem ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endBairro",
                        $end->endbairro ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endCidade",
                        $end->endcidade ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endEstado",
                        $end->endestado ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endCodPostal",
                        $end->endcodpostal ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "telef",
                        $end->telef ?? null,
                        false
                    );
                    $pgtoext->appendChild($endext);
                }

                $infoPgto->appendChild($pgtoext);
            }
            $ideBenef->appendChild($infoPgto);
        }
        if (!empty($this->std->infoircomplem)) {
            $infocomp = $this->dom->createElement("infoIRComplem");
            $comp = $this->std->infoircomplem;
            $this->dom->addChild(
                $infocomp,
                "dtLaudo",
                $comp->dtlaudo ?? null,
                false
            );
            if (!empty($comp->infodep)) {
                foreach ($comp->infodep as $dep) {
                    $infodep = $this->dom->createElement("infoDep");
                    $this->dom->addChild(
                        $infodep,
                        "cpfDep",
                        $dep->cpfdep,
                        true
                    );
                    $this->dom->addChild(
                        $infodep,
                        "dtNascto",
                        $dep->dtnascto ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $infodep,
                        "nome",
                        $dep->nome ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $infodep,
                        "depIRRF",
                        $dep->depirrf ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $infodep,
                        "tpDep",
                        $dep->tpdep ?? null,
                        false
                    );
                    if ($dep->tpdep === '99') {
                        $this->dom->addChild(
                            $infodep,
                            "descrDep",
                            $dep->descrdep,
                            true
                        );
                    }
                    $infocomp->appendChild($infodep);
                }                
            }
            if (!empty($comp->infoircr)) {
                foreach ($comp->infoircr as $rc) {
                    $ircr = $this->dom->createElement("infoIRCR");
                    $this->dom->addChild(
                        $ircr,
                        "tpCR",
                        $rc->tpcr,
                        true
                    );
                    if (!empty($rc->deddepen)) {
                        foreach ($rc->deddepen as $ded) {
                            $dpen = $this->dom->createElement("dedDepen");
                            $this->dom->addChild(
                                $dpen,
                                "tpRend",
                                $ded->tprend,
                                true
                            );
                            $this->dom->addChild(
                                $dpen,
                                "cpfDep",
                                $ded->cpfdep,
                                true
                            );
                            $this->dom->addChild(
                                $dpen,
                                "vlrDedDep",
                                $ded->vlrdeddep,
                                true
                            );
                            $ircr->appendChild($dpen);
                        }
                    }
                    if (!empty($rc->penalim)) {
                        foreach ($rc->penalim as $alim) {
                            $palim = $this->dom->createElement("penAlim");
                            $this->dom->addChild(
                                $palim,
                                "tpRend",
                                $alim->tprend,
                                true
                            );
                            $this->dom->addChild(
                                $palim,
                                "cpfDep",
                                $alim->cpfdep,
                                true
                            );
                            $this->dom->addChild(
                                $palim,
                                "vlrDedPenAlim",
                                $alim->vlrdedpenalim,
                                true
                            );
                            $ircr->appendChild($palim);
                        }
                    }
                    if (!empty($rc->previdcompl)) {
                        foreach ($rc->previdcompl as $prev) {
                            $pc = $this->dom->createElement("previdCompl");
                            $this->dom->addChild(
                                $pc,
                                "tpPrev",
                                $prev->tpprev,
                                true
                            );
                            $this->dom->addChild(
                                $pc,
                                "cnpjEntidPC",
                                $prev->cnpjentidpc,
                                true
                            );
                            $this->dom->addChild(
                                $pc,
                                "vlrDedPC",
                                $prev->vlrdedpc,
                                true
                            );
                            $this->dom->addChild(
                                $pc,
                                "vlrPatrocFunp",
                                $prev->vlrpatrocfunp ?? null,
                                false
                            );
                            $ircr->appendChild($pc);
                        }
                    }
                    if (!empty($rc->infoprocret)) {
                        foreach ($rc->infoprocret as $infp) {
                            $pret = $this->dom->createElement("infoProcRet");
                            $this->dom->addChild(
                                $pret,
                                "tpProcRet",
                                $infp->tpprocret,
                                true
                            );
                            $this->dom->addChild(
                                $pret,
                                "nrProcRet",
                                $infp->nrprocret,
                                true
                            );
                            $this->dom->addChild(
                                $pret,
                                "codSusp",
                                $infp->codsusp ?? null,
                                false
                            );
                            if (!empty($infp->infovalores)) {
                                foreach ($infp->infovalores as $val) {
                                    $ival = $this->dom->createElement("infoValores");
                                    $this->dom->addChild(
                                        $ival,
                                        "indApuracao",
                                        $val->indapuracao,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $ival,
                                        "vlrNRetido",
                                        $val->vlrnretido ?? null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $ival,
                                        "vlrDepJud",
                                        $val->vlrdepjud ?? null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $ival,
                                        "vlrCmpAnoCal",
                                        $val->vlrcmpanocal ?? null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $ival,
                                        "vlrCmpAnoAnt",
                                        $val->vlrcmpanoant ?? null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $ival,
                                        "vlrRendSusp",
                                        $val->vlrrendsusp ?? null,
                                        false
                                    );
                                    if (!empty($val->dedsusp)) {
                                        foreach ($val->dedsusp as $susp) {
                                            $dsu = $this->dom->createElement("dedSusp");
                                            $this->dom->addChild(
                                                $dsu,
                                                "indTpDeducao",
                                                $susp->indtpdeducao,
                                                true
                                            );
                                            $this->dom->addChild(
                                                $dsu,
                                                "vlrDedSusp",
                                                $susp->vlrdedsusp ?? null,
                                                false
                                            );
                                            $this->dom->addChild(
                                                $dsu,
                                                "cnpjEntidPC",
                                                $susp->cnpjentidpc ?? null,
                                                false
                                            );
                                            $this->dom->addChild(
                                                $dsu,
                                                "vlrPatrocFunp",
                                                $susp->vlrpatrocfunp ?? null,
                                                false
                                            );
                                            if (!empty($susp->benefpen)) {
                                                foreach ($susp->benefpen as $ben) {
                                                    $bpen = $this->dom->createElement("benefPen");
                                                    $this->dom->addChild(
                                                        $bpen,
                                                        "cpfDep",
                                                        $ben->cpfdep,
                                                        true
                                                    );
                                                    $this->dom->addChild(
                                                        $bpen,
                                                        "vlrDepenSusp",
                                                        $ben->vlrdepensusp,
                                                        true
                                                    );
                                                    $dsu->appendChild($bpen);
                                                }
                                            }
                                            $ival->appendChild($dsu);
                                        }
                                    }
                                    $pret->appendChild($ival);
                                }
                            }
                            $ircr->appendChild($pret);
                        }
                    }
                    $infocomp->appendChild($ircr);
                }
                if (!empty($comp->plansaude)) {
                    foreach ($comp->plansaude as $sau) {
                        $psau = $this->dom->createElement("planSaude");
                        $this->dom->addChild(
                            $psau,
                            "cnpjOper",
                            $sau->cnpjoper,
                            true
                        );
                        $this->dom->addChild(
                            $psau,
                            "regANS",
                            $sau->regans ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $psau,
                            "vlrSaudeTit",
                            $sau->vlrsaudetit,
                            true
                        );
                        if (!empty($sau->infodepsau)) {
                            foreach ($sau->infodepsau as $dep) {
                                $idep = $this->dom->createElement("infoDepSau");
                                $this->dom->addChild(
                                    $idep,
                                    "cpfDep",
                                    $dep->cpfdep,
                                    true
                                );
                                $this->dom->addChild(
                                    $idep,
                                    "vlrSaudeDep",
                                    $dep->vlrsaudedep,
                                    true
                                );
                                $psau->appendChild($idep);
                            }
                        }
                        $infocomp->appendChild($psau);
                    }
                }
                if (!empty($comp->inforeembmed)) {
                    foreach ($comp->inforeembmed as $ree) {
                        $iree = $this->dom->createElement("infoReembMed");
                        $this->dom->addChild(
                            $iree,
                            "indOrgReemb",
                            $ree->indorgreemb,
                            true
                        );
                        $this->dom->addChild(
                            $iree,
                            "cnpjOper",
                            $ree->cnpjoper ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $iree,
                            "regANS",
                            $ree->regans ?? null,
                            false
                        );
                        if (!empty($ree->detreembtit)) {
                            foreach ($ree->detreembtit as $tit) {
                                $rtit = $this->dom->createElement("detReembTit");
                                $this->dom->addChild(
                                    $rtit,
                                    "tpInsc",
                                    $tit->tpinsc,
                                    true
                                );
                                $this->dom->addChild(
                                    $rtit,
                                    "nrInsc",
                                    $tit->nrinsc,
                                    true
                                );
                                $this->dom->addChild(
                                    $rtit,
                                    "vlrReemb",
                                    $tit->vlrreemb ?? null,
                                    false
                                );
                                $this->dom->addChild(
                                    $rtit,
                                    "vlrReembAnt",
                                    $tit->vlrreembant ?? null,
                                    false
                                );
                                $iree->appendChild($rtit);
                            }
                        }
                        if (!empty($ree->inforeembdep)) {
                            foreach ($ree->inforeembdep as $bdep) {
                                $rdep = $this->dom->createElement("infoReembDep");
                                $this->dom->addChild(
                                    $rdep,
                                    "cpfBenef",
                                    $bdep->cpfbenef,
                                    true
                                );
                                if (!empty($bdep->detreembdep)) {
                                    foreach ($bdep->detreembdep as $drdep) {
                                        $detree = $this->dom->createElement("detReembDep");
                                        $this->dom->addChild(
                                            $detree,
                                            "tpInsc",
                                            $drdep->tpinsc,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $detree,
                                            "nrInsc",
                                            $drdep->nrinsc,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $detree,
                                            "vlrReemb",
                                            $drdep->vlrreemb ?? null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $detree,
                                            "vlrReembAnt",
                                            $drdep->vlrreembant ?? null,
                                            false
                                        );
                                        $rdep->appendChild($detree);
                                    }
                                }
                                $iree->appendChild($rdep);
                            }
                        }

                        $infocomp->appendChild($iree);
                    }
                }
            }
            $ideBenef->appendChild($infocomp);
        }
        $this->node->appendChild($ideBenef);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    protected function toNodeS130()
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
            "perApur",
            $this->std->perapur,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "indGuia",
            !empty($this->std->indguia) ? $this->std->indguia : null,
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
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        foreach ($this->std->infopgto as $pgto) {
            $infoPgto = $this->dom->createElement("infoPgto");
            $this->dom->addChild(
                $infoPgto,
                "dtPgto",
                $pgto->dtpgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "tpPgto",
                $pgto->tppgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "perRef",
                $pgto->perref,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "ideDmDev",
                $pgto->idedmdev,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "vrLiq",
                $pgto->vrliq,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "paisResidExt",
                $pgto->paisresidext ?? null,
                false
            );
            if (!empty($pgto->paisresidext) && !empty($pgto->infopgtoext)) {
                $ext = $pgto->infopgtoext;
                $pgtoext = $this->dom->createElement("infoPgtoExt");
                $this->dom->addChild(
                    $pgtoext,
                    "indNIF",
                    $ext->indnif,
                    true
                );
                $this->dom->addChild(
                    $pgtoext,
                    "nifBenef",
                    $ext->nifbenef ?? null,
                    false
                );
                $this->dom->addChild(
                    $pgtoext,
                    "frmTribut",
                    $ext->frmtribut,
                    true
                );
                if (!empty($ext->endext)) {
                    $end = $ext->endext;
                    $endext = $this->dom->createElement("endExt");
                    $this->dom->addChild(
                        $endext,
                        "endDscLograd",
                        $end->enddsclograd ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endNrLograd",
                        $end->endnrlograd ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endComplem",
                        $end->endcomplem ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endBairro",
                        $end->endbairro ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endCidade",
                        $end->endcidade ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endEstado",
                        $end->endestado ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endCodPostal",
                        $end->endcodpostal ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "telef",
                        $end->telef ?? null,
                        false
                    );
                    $pgtoext->appendChild($endext);
                }

                $infoPgto->appendChild($pgtoext);
            }
            $ideBenef->appendChild($infoPgto);
        }
        if (!empty($this->std->infoircomplem)) {
            foreach($this->std->infoircomplem as $comp) {
                $infocomp = $this->dom->createElement("infoIRComplem");
                //$comp = $this->std->infoircomplem;
                $this->dom->addChild(
                    $infocomp,
                    "dtLaudo",
                    $comp->dtlaudo ?? null,
                    false
                );
                if(isset($comp->perant)){
                    $perAnt = $this->dom->createElement("perAnt");
                    $this->dom->addChild(
                        $perAnt,
                        "perRefAjuste",
                        $comp->perant->perrefajuste,
                        true
                    );
                    $this->dom->addChild(
                        $perAnt,
                        "nrRec1210Orig",
                        $comp->perant->nrrec1210orig,
                        true
                    );
                    $infocomp->appendChild($perAnt);
                }
                if (!empty($comp->infodep)) {
                    foreach ($comp->infodep as $dep) {
                        $infodep = $this->dom->createElement("infoDep");
                        $this->dom->addChild(
                            $infodep,
                            "cpfDep",
                            $dep->cpfdep,
                            true
                        );
                        $this->dom->addChild(
                            $infodep,
                            "dtNascto",
                            $dep->dtnascto ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $infodep,
                            "nome",
                            $dep->nome ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $infodep,
                            "depIRRF",
                            $dep->depirrf ?? null,
                            false
                        );
                        $this->dom->addChild(
                            $infodep,
                            "tpDep",
                            $dep->tpdep ?? null,
                            false
                        );
                        if ($dep->tpdep === '99') {
                            $this->dom->addChild(
                                $infodep,
                                "descrDep",
                                $dep->descrdep,
                                true
                            );
                        }
                        $infocomp->appendChild($infodep);
                    }
                }
                if (!empty($comp->infoircr)) {
                    foreach ($comp->infoircr as $rc) {
                        $ircr = $this->dom->createElement("infoIRCR");
                        $this->dom->addChild(
                            $ircr,
                            "tpCR",
                            $rc->tpcr,
                            true
                        );
                        if (!empty($rc->deddepen)) {
                            foreach ($rc->deddepen as $ded) {
                                $dpen = $this->dom->createElement("dedDepen");
                                $this->dom->addChild(
                                    $dpen,
                                    "tpRend",
                                    $ded->tprend,
                                    true
                                );
                                $this->dom->addChild(
                                    $dpen,
                                    "cpfDep",
                                    $ded->cpfdep,
                                    true
                                );
                                $this->dom->addChild(
                                    $dpen,
                                    "vlrDedDep",
                                    $ded->vlrdeddep,
                                    true
                                );
                                $ircr->appendChild($dpen);
                            }
                        }
                        if (!empty($rc->penalim)) {
                            foreach ($rc->penalim as $alim) {
                                $palim = $this->dom->createElement("penAlim");
                                $this->dom->addChild(
                                    $palim,
                                    "tpRend",
                                    $alim->tprend,
                                    true
                                );
                                $this->dom->addChild(
                                    $palim,
                                    "cpfDep",
                                    $alim->cpfdep,
                                    true
                                );
                                $this->dom->addChild(
                                    $palim,
                                    "vlrDedPenAlim",
                                    $alim->vlrdedpenalim,
                                    true
                                );
                                $ircr->appendChild($palim);
                            }
                        }
                        if (!empty($rc->previdcompl)) {
                            foreach ($rc->previdcompl as $prev) {
                                $pc = $this->dom->createElement("previdCompl");
                                $this->dom->addChild(
                                    $pc,
                                    "tpPrev",
                                    $prev->tpprev,
                                    true
                                );
                                $this->dom->addChild(
                                    $pc,
                                    "cnpjEntidPC",
                                    $prev->cnpjentidpc,
                                    true
                                );
                                if(!isset($prev->vlrdedpc13)){
                                    $this->dom->addChild(
                                        $pc,
                                        "vlrDedPC",
                                        $prev->vlrdedpc,
                                        true
                                    );
                                }
                                else{
                                    $this->dom->addChild(
                                        $pc,
                                        "vlrDedPC13",
                                        $prev->vlrdedpc13,
                                        true
                                    );
                                }                                
                                if($prev->tpprev == 3){
                                    if(!isset($prev->vlrpatrocfunp13)){
                                        $this->dom->addChild(
                                            $pc,
                                            "vlrPatrocFunp",
                                            $prev->vlrpatrocfunp ?? null,
                                            false
                                        );
                                    }
                                    else{
                                        $this->dom->addChild(
                                            $pc,
                                            "vlrPatrocFunp13",
                                            $prev->vlrpatrocfunp13 ?? null,
                                            false
                                        );
                                    }                     
                                }                                
                                $ircr->appendChild($pc);
                            }
                        }
                        if (!empty($rc->infoprocret)) {
                            foreach ($rc->infoprocret as $infp) {
                                $pret = $this->dom->createElement("infoProcRet");
                                $this->dom->addChild(
                                    $pret,
                                    "tpProcRet",
                                    $infp->tpprocret,
                                    true
                                );
                                $this->dom->addChild(
                                    $pret,
                                    "nrProcRet",
                                    $infp->nrprocret,
                                    true
                                );
                                $this->dom->addChild(
                                    $pret,
                                    "codSusp",
                                    $infp->codsusp ?? null,
                                    false
                                );
                                if (!empty($infp->infovalores)) {
                                    foreach ($infp->infovalores as $val) {
                                        $ival = $this->dom->createElement("infoValores");
                                        $this->dom->addChild(
                                            $ival,
                                            "indApuracao",
                                            $val->indapuracao,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $ival,
                                            "vlrNRetido",
                                            $val->vlrnretido ?? null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $ival,
                                            "vlrDepJud",
                                            $val->vlrdepjud ?? null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $ival,
                                            "vlrCmpAnoCal",
                                            $val->vlrcmpanocal ?? null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $ival,
                                            "vlrCmpAnoAnt",
                                            $val->vlrcmpanoant ?? null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $ival,
                                            "vlrRendSusp",
                                            $val->vlrrendsusp ?? null,
                                            false
                                        );
                                        if (!empty($val->dedsusp)) {
                                            foreach ($val->dedsusp as $susp) {
                                                $dsu = $this->dom->createElement("dedSusp");
                                                $this->dom->addChild(
                                                    $dsu,
                                                    "indTpDeducao",
                                                    $susp->indtpdeducao,
                                                    true
                                                );
                                                $this->dom->addChild(
                                                    $dsu,
                                                    "vlrDedSusp",
                                                    $susp->vlrdedsusp ?? null,
                                                    false
                                                );
                                                $this->dom->addChild(
                                                    $dsu,
                                                    "cnpjEntidPC",
                                                    $susp->cnpjentidpc ?? null,
                                                    false
                                                );
                                                $this->dom->addChild(
                                                    $dsu,
                                                    "vlrPatrocFunp",
                                                    $susp->vlrpatrocfunp ?? null,
                                                    false
                                                );
                                                if (!empty($susp->benefpen)) {
                                                    foreach ($susp->benefpen as $ben) {
                                                        $bpen = $this->dom->createElement("benefPen");
                                                        $this->dom->addChild(
                                                            $bpen,
                                                            "cpfDep",
                                                            $ben->cpfdep,
                                                            true
                                                        );
                                                        $this->dom->addChild(
                                                            $bpen,
                                                            "vlrDepenSusp",
                                                            $ben->vlrdepensusp,
                                                            true
                                                        );
                                                        $dsu->appendChild($bpen);
                                                    }
                                                }
                                                $ival->appendChild($dsu);
                                            }
                                        }
                                        $pret->appendChild($ival);
                                    }
                                }
                                $ircr->appendChild($pret);
                            }
                        }
                        $infocomp->appendChild($ircr);
                    }
                    if (!empty($comp->plansaude)) {
                        foreach ($comp->plansaude as $sau) {
                            $psau = $this->dom->createElement("planSaude");
                            $this->dom->addChild(
                                $psau,
                                "cnpjOper",
                                $sau->cnpjoper,
                                true
                            );
                            $this->dom->addChild(
                                $psau,
                                "regANS",
                                $sau->regans ?? null,
                                false
                            );
                            $this->dom->addChild(
                                $psau,
                                "vlrSaudeTit",
                                $sau->vlrsaudetit,
                                true
                            );
                            if (!empty($sau->infodepsau)) {
                                foreach ($sau->infodepsau as $dep) {
                                    $idep = $this->dom->createElement("infoDepSau");
                                    $this->dom->addChild(
                                        $idep,
                                        "cpfDep",
                                        $dep->cpfdep,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $idep,
                                        "vlrSaudeDep",
                                        $dep->vlrsaudedep,
                                        true
                                    );
                                    $psau->appendChild($idep);
                                }
                            }
                            $infocomp->appendChild($psau);
                        }
                    }
                    if (!empty($comp->inforeembmed)) {
                        foreach ($comp->inforeembmed as $ree) {
                            $iree = $this->dom->createElement("infoReembMed");
                            $this->dom->addChild(
                                $iree,
                                "indOrgReemb",
                                $ree->indorgreemb,
                                true
                            );
                            $this->dom->addChild(
                                $iree,
                                "cnpjOper",
                                $ree->cnpjoper ?? null,
                                false
                            );
                            $this->dom->addChild(
                                $iree,
                                "regANS",
                                $ree->regans ?? null,
                                false
                            );
                            if (!empty($ree->detreembtit)) {
                                foreach ($ree->detreembtit as $tit) {
                                    $rtit = $this->dom->createElement("detReembTit");
                                    $this->dom->addChild(
                                        $rtit,
                                        "tpInsc",
                                        $tit->tpinsc,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $rtit,
                                        "nrInsc",
                                        $tit->nrinsc,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $rtit,
                                        "vlrReemb",
                                        $tit->vlrreemb ?? null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $rtit,
                                        "vlrReembAnt",
                                        $tit->vlrreembant ?? null,
                                        false
                                    );
                                    $iree->appendChild($rtit);
                                }
                            }
                            if (!empty($ree->inforeembdep)) {
                                foreach ($ree->inforeembdep as $bdep) {
                                    $rdep = $this->dom->createElement("infoReembDep");
                                    $this->dom->addChild(
                                        $rdep,
                                        "cpfBenef",
                                        $bdep->cpfbenef,
                                        true
                                    );
                                    if (!empty($bdep->detreembdep)) {
                                        foreach ($bdep->detreembdep as $drdep) {
                                            $detree = $this->dom->createElement("detReembDep");
                                            $this->dom->addChild(
                                                $detree,
                                                "tpInsc",
                                                $drdep->tpinsc,
                                                true
                                            );
                                            $this->dom->addChild(
                                                $detree,
                                                "nrInsc",
                                                $drdep->nrinsc,
                                                true
                                            );
                                            $this->dom->addChild(
                                                $detree,
                                                "vlrReemb",
                                                $drdep->vlrreemb ?? null,
                                                false
                                            );
                                            $this->dom->addChild(
                                                $detree,
                                                "vlrReembAnt",
                                                $drdep->vlrreembant ?? null,
                                                false
                                            );
                                            $rdep->appendChild($detree);
                                        }
                                    }
                                    $iree->appendChild($rdep);
                                }
                            }

                            $infocomp->appendChild($iree);
                        }
                    }
                }
                $ideBenef->appendChild($infocomp);
            }
        }
        $this->node->appendChild($ideBenef);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
