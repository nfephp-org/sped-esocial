<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1200
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
            "indApuracao",
            $this->std->indapuracao,
            true
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
        $ide = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ide,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        if (!empty($this->std->infomv)) {
            $info = $this->dom->createElement("infoMV");
            $this->dom->addChild(
                $info,
                "indMV",
                $this->std->infomv->indmv,
                true
            );
            if (!empty($this->std->infomv->remunoutrempr)) {
                foreach ($this->std->infomv->remunoutrempr as $remo) {
                    $remunOutrEmpr = $this->dom->createElement("remunOutrEmpr");
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "tpInsc",
                        $remo->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "nrInsc",
                        $remo->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "codCateg",
                        $remo->codcateg,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "vlrRemunOE",
                        $remo->vlrremunoe,
                        true
                    );
                    $info->appendChild($remunOutrEmpr);
                }
                $ide->appendChild($info);
            }
        }
        if (!empty($this->std->infocomplem)) {
            $ic = $this->std->infocomplem;
            $infoComplem = $this->dom->createElement("infoComplem");
            $this->dom->addChild(
                $infoComplem,
                "nmTrab",
                $ic->nmtrab,
                true
            );
            $this->dom->addChild(
                $infoComplem,
                "dtNascto",
                $ic->dtnascto,
                true
            );
            if (!empty($ic->sucessaovinc)) {
                $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
                $this->dom->addChild(
                    $sucessaoVinc,
                    "tpInsc",
                    $ic->sucessaovinc->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "nrInsc",
                    $ic->sucessaovinc->nrinsc,
                    true
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "matricAnt",
                    !empty($ic->sucessaovinc->matricant) ? $ic->sucessaovinc->matricant : null,
                    false
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "dtAdm",
                    $ic->sucessaovinc->dtadm,
                    true
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "observacao",
                    !empty($ic->observacao) ? $ic->observacao : null,
                    false
                );
                $infoComplem->appendChild($sucessaoVinc);
            }
            $ide->appendChild($infoComplem);
        }
        if (!empty($this->std->procjudtrab)) {
            foreach ($this->std->procjudtrab as $proc) {
                $procJudTrab = $this->dom->createElement("procJudTrab");
                $this->dom->addChild(
                    $procJudTrab,
                    "tpTrib",
                    $proc->tptrib,
                    true
                );
                $this->dom->addChild(
                    $procJudTrab,
                    "nrProcJud",
                    $proc->nrprocjud,
                    true
                );
                $this->dom->addChild(
                    $procJudTrab,
                    "codSusp",
                    $proc->codsusp,
                    true
                );
                $ide->appendChild($procJudTrab);
            }
        }
        if (!empty($this->std->infointerm)) {
            foreach ($this->std->infointerm as $iterm) {
                $infoInterm = $this->dom->createElement("infoInterm");
                $this->dom->addChild(
                    $infoInterm,
                    "dia",
                    $iterm->dia,
                    true
                );
                $ide->appendChild($infoInterm);
            }
        }
        $this->node->appendChild($ide);
        foreach ($this->std->dmdev as $dm) {
            $dmdev = $this->dom->createElement("dmDev");
            $this->dom->addChild(
                $dmdev,
                "ideDmDev",
                $dm->idedmdev,
                true
            );
            $this->dom->addChild(
                $dmdev,
                "codCateg",
                $dm->codcateg,
                true
            );
            if (!empty($dm->ideestablot)) {
                $infoPerApur = $this->dom->createElement("infoPerApur");
                foreach ($dm->ideestablot as $idsl) {
                    $ideEstabLot = $this->dom->createElement("ideEstabLot");
                    $this->dom->addChild(
                        $ideEstabLot,
                        "tpInsc",
                        $idsl->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabLot,
                        "nrInsc",
                        $idsl->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabLot,
                        "codLotacao",
                        $idsl->codlotacao,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabLot,
                        "qtdDiasAv",
                        !empty($idsl->qtddiasav) ? $idsl->qtddiasav : null,
                        false
                    );
                    foreach ($idsl->remunperapur as $rpa) {
                        $remunPerApur = $this->dom->createElement("remunPerApur");
                        $this->dom->addChild(
                            $remunPerApur,
                            "matricula",
                            !empty($rpa->matricula) ? $rpa->matricula : null,
                            false
                        );
                        $this->dom->addChild(
                            $remunPerApur,
                            "indSimples",
                            !empty($rpa->indsimples) ? $rpa->indsimples : null,
                            false
                        );
                        foreach ($rpa->itensremun as $itemr) {
                            $itensRemun = $this->dom->createElement("itensRemun");
                            $this->dom->addChild(
                                $itensRemun,
                                "codRubr",
                                $itemr->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "ideTabRubr",
                                $itemr->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "qtdRubr",
                                !empty($itemr->qtdrubr) ? $itemr->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "fatorRubr",
                                !empty($itemr->fatorrubr) ? $itemr->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "vrRubr",
                                $itemr->vrrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "indApurIR",
                                isset($itemr->indapurir) ? $itemr->indapurir : null,
                                false
                            );
                            $remunPerApur->appendChild($itensRemun);
                        }
                        if (!empty($rpa->infoagnocivo)) {
                            $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                            $this->dom->addChild(
                                $infoAgNocivo,
                                "grauExp",
                                $rpa->infoagnocivo->grauexp,
                                true
                            );
                            $remunPerApur->appendChild($infoAgNocivo);
                        }
                        $ideEstabLot->appendChild($remunPerApur);
                    }
                    $infoPerApur->appendChild($ideEstabLot);
                }
                $dmdev->appendChild($infoPerApur);
            }
            if (!empty($dm->ideadc)) {
                $infoPerAnt = $this->dom->createElement("infoPerAnt");
                foreach ($dm->ideadc as $adc) {
                    $ideADC = $this->dom->createElement("ideADC");
                    $this->dom->addChild(
                        $ideADC,
                        "dtAcConv",
                        !empty($adc->dtacconv) ? $adc->dtacconv : null,
                        false
                    );
                    $this->dom->addChild(
                        $ideADC,
                        "tpAcConv",
                        $adc->tpacconv,
                        true
                    );
                    $this->dom->addChild(
                        $ideADC,
                        "dsc",
                        $adc->dsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideADC,
                        "remunSuc",
                        $adc->remunsuc,
                        true
                    );
                    foreach ($adc->ideperiodo as $idp) {
                        $idePeriodo = $this->dom->createElement("idePeriodo");
                        $this->dom->addChild(
                            $idePeriodo,
                            "perRef",
                            $idp->perref,
                            true
                        );
                        foreach ($idp->ideestablot as $idl) {
                            $ideEstabLot = $this->dom->createElement("ideEstabLot");
                            $this->dom->addChild(
                                $ideEstabLot,
                                "tpInsc",
                                $idl->tpinsc,
                                true
                            );
                            $this->dom->addChild(
                                $ideEstabLot,
                                "nrInsc",
                                $idl->nrinsc,
                                true
                            );
                            $this->dom->addChild(
                                $ideEstabLot,
                                "codLotacao",
                                $idl->codlotacao,
                                true
                            );
                            foreach ($idl->remunperant as $rpr) {
                                $remunPerAnt = $this->dom->createElement("remunPerAnt");
                                $this->dom->addChild(
                                    $remunPerAnt,
                                    "matricula",
                                    !empty($rpr->matricula) ? $rpr->matricula : null,
                                    false
                                );
                                $this->dom->addChild(
                                    $remunPerAnt,
                                    "indSimples",
                                    !empty($rpr->indsimples) ? $rpr->indsimples : null,
                                    false
                                );
                                foreach ($rpr->itensremun as $irem) {
                                    $itensRemun = $this->dom->createElement("itensRemun");
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "codRubr",
                                        $irem->codrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "ideTabRubr",
                                        $irem->idetabrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "qtdRubr",
                                        !empty($irem->qtdrubr) ? $irem->qtdrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "fatorRubr",
                                        !empty($irem->fatorrubr) ? $irem->fatorrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "vrRubr",
                                        $irem->vrrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "indApurIR",
                                        isset($irem->indapurir) ? $irem->indapurir : null,
                                        false
                                    );
                                    $remunPerAnt->appendChild($itensRemun);
                                }
                                if (!empty($rpr->infoagnocivo)) {
                                    $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                                    $this->dom->addChild(
                                        $infoAgNocivo,
                                        "grauExp",
                                        $rpr->infoagnocivo->grauexp,
                                        true
                                    );
                                    $remunPerAnt->appendChild($infoAgNocivo);
                                }
                                $ideEstabLot->appendChild($remunPerAnt);
                            }
                            $idePeriodo->appendChild($ideEstabLot);
                        }
                        $ideADC->appendChild($idePeriodo);
                    }
                    $infoPerAnt->appendChild($ideADC);
                }
                $dmdev->appendChild($infoPerAnt);
            }
            if (!empty($dm->infocomplcont)) {
                $infoComplCont = $this->dom->createElement("infoComplCont");
                $this->dom->addChild(
                    $infoComplCont,
                    "codCBO",
                    $dm->infocomplcont->codcbo,
                    true
                );
                $this->dom->addChild(
                    $infoComplCont,
                    "natAtividade",
                    !empty($dm->infocomplcont->natatividade) ? $dm->infocomplcont->natatividade : null,
                    false
                );
                $this->dom->addChild(
                    $infoComplCont,
                    "qtdDiasTrab",
                    !empty($dm->infocomplcont->qtddiastrab) ? $dm->infocomplcont->qtddiastrab : null,
                    false
                );
                $dmdev->appendChild($infoComplCont);
            }
            $this->node->appendChild($dmdev);
        }
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
            "indApuracao",
            $this->std->indapuracao,
            true
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
        $ide = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ide,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        if (!empty($this->std->infomv)) {
            $info = $this->dom->createElement("infoMV");
            $this->dom->addChild(
                $info,
                "indMV",
                $this->std->infomv->indmv,
                true
            );
            if (!empty($this->std->infomv->remunoutrempr)) {
                foreach ($this->std->infomv->remunoutrempr as $remo) {
                    $remunOutrEmpr = $this->dom->createElement("remunOutrEmpr");
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "tpInsc",
                        $remo->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "nrInsc",
                        $remo->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "codCateg",
                        $remo->codcateg,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "vlrRemunOE",
                        $remo->vlrremunoe,
                        true
                    );
                    $info->appendChild($remunOutrEmpr);
                }
                $ide->appendChild($info);
            }
        }
        if (!empty($this->std->infocomplem)) {
            $ic = $this->std->infocomplem;
            $infoComplem = $this->dom->createElement("infoComplem");
            $this->dom->addChild(
                $infoComplem,
                "nmTrab",
                $ic->nmtrab,
                true
            );
            $this->dom->addChild(
                $infoComplem,
                "dtNascto",
                $ic->dtnascto,
                true
            );
            if (!empty($ic->sucessaovinc)) {
                $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
                $this->dom->addChild(
                    $sucessaoVinc,
                    "tpInsc",
                    $ic->sucessaovinc->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "nrInsc",
                    $ic->sucessaovinc->nrinsc,
                    true
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "matricAnt",
                    !empty($ic->sucessaovinc->matricant) ? $ic->sucessaovinc->matricant : null,
                    false
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "dtAdm",
                    $ic->sucessaovinc->dtadm,
                    true
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "observacao",
                    !empty($ic->observacao) ? $ic->observacao : null,
                    false
                );
                $infoComplem->appendChild($sucessaoVinc);
            }
            $ide->appendChild($infoComplem);
        }
        if (!empty($this->std->procjudtrab)) {
            foreach ($this->std->procjudtrab as $proc) {
                $procJudTrab = $this->dom->createElement("procJudTrab");
                $this->dom->addChild(
                    $procJudTrab,
                    "tpTrib",
                    $proc->tptrib,
                    true
                );
                $this->dom->addChild(
                    $procJudTrab,
                    "nrProcJud",
                    $proc->nrprocjud,
                    true
                );
                $this->dom->addChild(
                    $procJudTrab,
                    "codSusp",
                    $proc->codsusp,
                    true
                );
                $ide->appendChild($procJudTrab);
            }
        }
        if (!empty($this->std->infointerm)) {
            foreach ($this->std->infointerm as $iterm) {
                $infoInterm = $this->dom->createElement("infoInterm");
                $this->dom->addChild(
                    $infoInterm,
                    "dia",
                    $iterm->dia,
                    true
                );
                $ide->appendChild($infoInterm);
            }
        }
        $this->node->appendChild($ide);
        foreach ($this->std->dmdev as $dm) {
            $dmdev = $this->dom->createElement("dmDev");
            $this->dom->addChild(
                $dmdev,
                "ideDmDev",
                $dm->idedmdev,
                true
            );
            $this->dom->addChild(
                $dmdev,
                "codCateg",
                $dm->codcateg,
                true
            );
            $indrra = ($dm->indrra ?? null) === 'S' ? 'S' : null;
            $this->dom->addChild(
                $dmdev,
                "indRRA",
                $indrra,
                false
            );
            if (!empty($dm->inforra) && $indrra === 'S') {
                $inf = $dm->inforra;
                $ifrra = $this->dom->createElement("infoRRA");
                $this->dom->addChild(
                    $ifrra,
                    "tpProcRRA",
                    $inf->tpprocrra,
                    true
                );
                $this->dom->addChild(
                    $ifrra,
                    "nrProcRRA",
                    $inf->nrprocrra ?? null,
                    false
                );
                $this->dom->addChild(
                    $ifrra,
                    "descRRA",
                    $inf->descrra,
                    true
                );
                $this->dom->addChild(
                    $ifrra,
                    "qtdMesesRRA",
                    $inf->qtdmesesrra,
                    true
                );
                if (!empty($inf->despprocjud)) {
                    $dpj = $inf->despprocjud;
                    $despProcJud = $this->dom->createElement("despProcJud");
                    $this->dom->addChild(
                        $despProcJud,
                        "vlrDespCustas",
                        $dpj->vlrdespcustas,
                        true
                    );
                    $this->dom->addChild(
                        $despProcJud,
                        "vlrDespAdvogados",
                        $dpj->vlrdespadvogados,
                        true
                    );
                    $ifrra->appendChild($despProcJud);
                }
                if (!empty($inf->ideadv)) {
                    foreach ($inf->ideadv as $idadv) {
                        $adv = $this->dom->createElement("ideAdv");
                        $this->dom->addChild(
                            $adv,
                            "tpInsc",
                            $idadv->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $adv,
                            "nrInsc",
                            $idadv->nrinsc,
                            true
                        );
                        $this->dom->addChild(
                            $adv,
                            "vlrAdv",
                            $idadv->vlradv,
                            true
                        );
                        $ifrra->appendChild($adv);
                    }
                }
                $dmdev->appendChild($ifrra);
            }
            if (!empty($dm->ideestablot)) {
                $infoPerApur = $this->dom->createElement("infoPerApur");
                foreach ($dm->ideestablot as $idsl) {
                    $ideEstabLot = $this->dom->createElement("ideEstabLot");
                    $this->dom->addChild(
                        $ideEstabLot,
                        "tpInsc",
                        $idsl->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabLot,
                        "nrInsc",
                        $idsl->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabLot,
                        "codLotacao",
                        $idsl->codlotacao,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabLot,
                        "qtdDiasAv",
                        !empty($idsl->qtddiasav) ? $idsl->qtddiasav : null,
                        false
                    );
                    foreach ($idsl->remunperapur as $rpa) {
                        $remunPerApur = $this->dom->createElement("remunPerApur");
                        $this->dom->addChild(
                            $remunPerApur,
                            "matricula",
                            !empty($rpa->matricula) ? $rpa->matricula : null,
                            false
                        );
                        $this->dom->addChild(
                            $remunPerApur,
                            "indSimples",
                            !empty($rpa->indsimples) ? $rpa->indsimples : null,
                            false
                        );
                        foreach ($rpa->itensremun as $itemr) {
                            $itensRemun = $this->dom->createElement("itensRemun");
                            $this->dom->addChild(
                                $itensRemun,
                                "codRubr",
                                $itemr->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "ideTabRubr",
                                $itemr->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "qtdRubr",
                                !empty($itemr->qtdrubr) ? $itemr->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "fatorRubr",
                                !empty($itemr->fatorrubr) ? $itemr->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "vrRubr",
                                $itemr->vrrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "indApurIR",
                                isset($itemr->indapurir) ? $itemr->indapurir : null,
                                false
                            );
                            $remunPerApur->appendChild($itensRemun);
                        }
                        if (!empty($rpa->infoagnocivo)) {
                            $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                            $this->dom->addChild(
                                $infoAgNocivo,
                                "grauExp",
                                $rpa->infoagnocivo->grauexp,
                                true
                            );
                            $remunPerApur->appendChild($infoAgNocivo);
                        }
                        $ideEstabLot->appendChild($remunPerApur);
                    }
                    $infoPerApur->appendChild($ideEstabLot);
                }
                $dmdev->appendChild($infoPerApur);
            }
            if (!empty($dm->ideadc)) {
                $infoPerAnt = $this->dom->createElement("infoPerAnt");
                foreach ($dm->ideadc as $adc) {
                    $ideADC = $this->dom->createElement("ideADC");
                    $this->dom->addChild(
                        $ideADC,
                        "dtAcConv",
                        !empty($adc->dtacconv) ? $adc->dtacconv : null,
                        false
                    );
                    $this->dom->addChild(
                        $ideADC,
                        "tpAcConv",
                        $adc->tpacconv,
                        true
                    );
                    $this->dom->addChild(
                        $ideADC,
                        "dsc",
                        $adc->dsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideADC,
                        "remunSuc",
                        $adc->remunsuc,
                        true
                    );
                    foreach ($adc->ideperiodo as $idp) {
                        $idePeriodo = $this->dom->createElement("idePeriodo");
                        $this->dom->addChild(
                            $idePeriodo,
                            "perRef",
                            $idp->perref,
                            true
                        );
                        foreach ($idp->ideestablot as $idl) {
                            $ideEstabLot = $this->dom->createElement("ideEstabLot");
                            $this->dom->addChild(
                                $ideEstabLot,
                                "tpInsc",
                                $idl->tpinsc,
                                true
                            );
                            $this->dom->addChild(
                                $ideEstabLot,
                                "nrInsc",
                                $idl->nrinsc,
                                true
                            );
                            $this->dom->addChild(
                                $ideEstabLot,
                                "codLotacao",
                                $idl->codlotacao,
                                true
                            );
                            foreach ($idl->remunperant as $rpr) {
                                $remunPerAnt = $this->dom->createElement("remunPerAnt");
                                $this->dom->addChild(
                                    $remunPerAnt,
                                    "matricula",
                                    !empty($rpr->matricula) ? $rpr->matricula : null,
                                    false
                                );
                                $this->dom->addChild(
                                    $remunPerAnt,
                                    "indSimples",
                                    !empty($rpr->indsimples) ? $rpr->indsimples : null,
                                    false
                                );
                                foreach ($rpr->itensremun as $irem) {
                                    $itensRemun = $this->dom->createElement("itensRemun");
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "codRubr",
                                        $irem->codrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "ideTabRubr",
                                        $irem->idetabrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "qtdRubr",
                                        !empty($irem->qtdrubr) ? $irem->qtdrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "fatorRubr",
                                        !empty($irem->fatorrubr) ? $irem->fatorrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "vrRubr",
                                        $irem->vrrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "indApurIR",
                                        isset($irem->indapurir) ? $irem->indapurir : null,
                                        false
                                    );
                                    $remunPerAnt->appendChild($itensRemun);
                                }
                                if (!empty($rpr->infoagnocivo)) {
                                    $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                                    $this->dom->addChild(
                                        $infoAgNocivo,
                                        "grauExp",
                                        $rpr->infoagnocivo->grauexp,
                                        true
                                    );
                                    $remunPerAnt->appendChild($infoAgNocivo);
                                }
                                $ideEstabLot->appendChild($remunPerAnt);
                            }
                            $idePeriodo->appendChild($ideEstabLot);
                        }
                        $ideADC->appendChild($idePeriodo);
                    }
                    $infoPerAnt->appendChild($ideADC);
                }
                $dmdev->appendChild($infoPerAnt);
            }
            if (!empty($dm->infocomplcont)) {
                $infoComplCont = $this->dom->createElement("infoComplCont");
                $this->dom->addChild(
                    $infoComplCont,
                    "codCBO",
                    $dm->infocomplcont->codcbo,
                    true
                );
                $this->dom->addChild(
                    $infoComplCont,
                    "natAtividade",
                    !empty($dm->infocomplcont->natatividade) ? $dm->infocomplcont->natatividade : null,
                    false
                );
                $this->dom->addChild(
                    $infoComplCont,
                    "qtdDiasTrab",
                    !empty($dm->infocomplcont->qtddiastrab) ? $dm->infocomplcont->qtddiastrab : null,
                    false
                );
                $dmdev->appendChild($infoComplCont);
            }
            $this->node->appendChild($dmdev);
        }
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
            "indApuracao",
            $this->std->indapuracao,
            true
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
        $ide = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ide,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        if (!empty($this->std->infomv)) {
            $info = $this->dom->createElement("infoMV");
            $this->dom->addChild(
                $info,
                "indMV",
                $this->std->infomv->indmv,
                true
            );
            if (!empty($this->std->infomv->remunoutrempr)) {
                foreach ($this->std->infomv->remunoutrempr as $remo) {
                    $remunOutrEmpr = $this->dom->createElement("remunOutrEmpr");
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "tpInsc",
                        $remo->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "nrInsc",
                        $remo->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "codCateg",
                        $remo->codcateg,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "vlrRemunOE",
                        $remo->vlrremunoe,
                        true
                    );
                    $info->appendChild($remunOutrEmpr);
                }
                $ide->appendChild($info);
            }
        }
        if (!empty($this->std->infocomplem)) {
            $ic = $this->std->infocomplem;
            $infoComplem = $this->dom->createElement("infoComplem");
            $this->dom->addChild(
                $infoComplem,
                "nmTrab",
                $ic->nmtrab,
                true
            );
            $this->dom->addChild(
                $infoComplem,
                "dtNascto",
                $ic->dtnascto,
                true
            );
            if (!empty($ic->sucessaovinc)) {
                $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
                $this->dom->addChild(
                    $sucessaoVinc,
                    "tpInsc",
                    $ic->sucessaovinc->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "nrInsc",
                    $ic->sucessaovinc->nrinsc,
                    true
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "matricAnt",
                    !empty($ic->sucessaovinc->matricant) ? $ic->sucessaovinc->matricant : null,
                    false
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "dtAdm",
                    $ic->sucessaovinc->dtadm,
                    true
                );
                $this->dom->addChild(
                    $sucessaoVinc,
                    "observacao",
                    !empty($ic->observacao) ? $ic->observacao : null,
                    false
                );
                $infoComplem->appendChild($sucessaoVinc);
            }
            $ide->appendChild($infoComplem);
        }
        if (!empty($this->std->procjudtrab)) {
            foreach ($this->std->procjudtrab as $proc) {
                $procJudTrab = $this->dom->createElement("procJudTrab");
                $this->dom->addChild(
                    $procJudTrab,
                    "tpTrib",
                    $proc->tptrib,
                    true
                );
                $this->dom->addChild(
                    $procJudTrab,
                    "nrProcJud",
                    $proc->nrprocjud,
                    true
                );
                $this->dom->addChild(
                    $procJudTrab,
                    "codSusp",
                    $proc->codsusp,
                    true
                );
                $ide->appendChild($procJudTrab);
            }
        }
        if (!empty($this->std->infointerm)) {
            foreach ($this->std->infointerm as $iterm) {
                $infoInterm = $this->dom->createElement("infoInterm");
                $this->dom->addChild(
                    $infoInterm,
                    "dia",
                    $iterm->dia,
                    true
                );
                $ide->appendChild($infoInterm);
            }
        }
        $this->node->appendChild($ide);
        foreach ($this->std->dmdev as $dm) {
            $dmdev = $this->dom->createElement("dmDev");
            $this->dom->addChild(
                $dmdev,
                "ideDmDev",
                $dm->idedmdev,
                true
            );
            $this->dom->addChild(
                $dmdev,
                "codCateg",
                $dm->codcateg,
                true
            );
            $indrra = ($dm->indrra ?? null) === 'S' ? 'S' : null;
            $this->dom->addChild(
                $dmdev,
                "indRRA",
                $indrra,
                false
            );
            if (!empty($dm->inforra) && $indrra === 'S') {
                $inf = $dm->inforra;
                $ifrra = $this->dom->createElement("infoRRA");
                $this->dom->addChild(
                    $ifrra,
                    "tpProcRRA",
                    $inf->tpprocrra,
                    true
                );
                $this->dom->addChild(
                    $ifrra,
                    "nrProcRRA",
                    $inf->nrprocrra ?? null,
                    false
                );
                $this->dom->addChild(
                    $ifrra,
                    "descRRA",
                    $inf->descrra,
                    true
                );
                $this->dom->addChild(
                    $ifrra,
                    "qtdMesesRRA",
                    $inf->qtdmesesrra,
                    true
                );
                if (!empty($inf->despprocjud)) {
                    $dpj = $inf->despprocjud;
                    $despProcJud = $this->dom->createElement("despProcJud");
                    $this->dom->addChild(
                        $despProcJud,
                        "vlrDespCustas",
                        $dpj->vlrdespcustas,
                        true
                    );
                    $this->dom->addChild(
                        $despProcJud,
                        "vlrDespAdvogados",
                        $dpj->vlrdespadvogados,
                        true
                    );
                    $ifrra->appendChild($despProcJud);
                }
                if (!empty($inf->ideadv)) {
                    foreach ($inf->ideadv as $idadv) {
                        $adv = $this->dom->createElement("ideAdv");
                        $this->dom->addChild(
                            $adv,
                            "tpInsc",
                            $idadv->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $adv,
                            "nrInsc",
                            $idadv->nrinsc,
                            true
                        );
                        $this->dom->addChild(
                            $adv,
                            "vlrAdv",
                            $idadv->vlradv,
                            true
                        );
                        $ifrra->appendChild($adv);
                    }
                }
                $dmdev->appendChild($ifrra);
            }
            if (!empty($dm->ideestablot)) {
                $infoPerApur = $this->dom->createElement("infoPerApur");
                foreach ($dm->ideestablot as $idsl) {
                    $ideEstabLot = $this->dom->createElement("ideEstabLot");
                    $this->dom->addChild(
                        $ideEstabLot,
                        "tpInsc",
                        $idsl->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabLot,
                        "nrInsc",
                        $idsl->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabLot,
                        "codLotacao",
                        $idsl->codlotacao,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabLot,
                        "qtdDiasAv",
                        !empty($idsl->qtddiasav) ? $idsl->qtddiasav : null,
                        false
                    );
                    foreach ($idsl->remunperapur as $rpa) {
                        $remunPerApur = $this->dom->createElement("remunPerApur");
                        $this->dom->addChild(
                            $remunPerApur,
                            "matricula",
                            !empty($rpa->matricula) ? $rpa->matricula : null,
                            false
                        );
                        $this->dom->addChild(
                            $remunPerApur,
                            "indSimples",
                            !empty($rpa->indsimples) ? $rpa->indsimples : null,
                            false
                        );
                        foreach ($rpa->itensremun as $itemr) {
                            $itensRemun = $this->dom->createElement("itensRemun");
                            $this->dom->addChild(
                                $itensRemun,
                                "codRubr",
                                $itemr->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "ideTabRubr",
                                $itemr->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "qtdRubr",
                                !empty($itemr->qtdrubr) ? $itemr->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "fatorRubr",
                                !empty($itemr->fatorrubr) ? $itemr->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "vrRubr",
                                $itemr->vrrubr,
                                true
                            );
                            $this->dom->addChild(
                                $itensRemun,
                                "indApurIR",
                                isset($itemr->indapurir) ? $itemr->indapurir : null,
                                false
                            );
                            $remunPerApur->appendChild($itensRemun);
                        }
                        if (!empty($rpa->infoagnocivo)) {
                            $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                            $this->dom->addChild(
                                $infoAgNocivo,
                                "grauExp",
                                $rpa->infoagnocivo->grauexp,
                                true
                            );
                            $remunPerApur->appendChild($infoAgNocivo);
                        }
                        $ideEstabLot->appendChild($remunPerApur);
                    }
                    $infoPerApur->appendChild($ideEstabLot);
                }
                $dmdev->appendChild($infoPerApur);
            }
            if (!empty($dm->ideadc)) {
                $infoPerAnt = $this->dom->createElement("infoPerAnt");
                foreach ($dm->ideadc as $adc) {
                    $ideADC = $this->dom->createElement("ideADC");
                    $this->dom->addChild(
                        $ideADC,
                        "dtAcConv",
                        !empty($adc->dtacconv) ? $adc->dtacconv : null,
                        false
                    );
                    $this->dom->addChild(
                        $ideADC,
                        "tpAcConv",
                        $adc->tpacconv,
                        true
                    );
                    $this->dom->addChild(
                        $ideADC,
                        "dsc",
                        $adc->dsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideADC,
                        "remunSuc",
                        $adc->remunsuc,
                        true
                    );
                    foreach ($adc->ideperiodo as $idp) {
                        $idePeriodo = $this->dom->createElement("idePeriodo");
                        $this->dom->addChild(
                            $idePeriodo,
                            "perRef",
                            $idp->perref,
                            true
                        );
                        foreach ($idp->ideestablot as $idl) {
                            $ideEstabLot = $this->dom->createElement("ideEstabLot");
                            $this->dom->addChild(
                                $ideEstabLot,
                                "tpInsc",
                                $idl->tpinsc,
                                true
                            );
                            $this->dom->addChild(
                                $ideEstabLot,
                                "nrInsc",
                                $idl->nrinsc,
                                true
                            );
                            $this->dom->addChild(
                                $ideEstabLot,
                                "codLotacao",
                                $idl->codlotacao,
                                true
                            );
                            foreach ($idl->remunperant as $rpr) {
                                $remunPerAnt = $this->dom->createElement("remunPerAnt");
                                $this->dom->addChild(
                                    $remunPerAnt,
                                    "matricula",
                                    !empty($rpr->matricula) ? $rpr->matricula : null,
                                    false
                                );
                                $this->dom->addChild(
                                    $remunPerAnt,
                                    "indSimples",
                                    !empty($rpr->indsimples) ? $rpr->indsimples : null,
                                    false
                                );
                                foreach ($rpr->itensremun as $irem) {
                                    $itensRemun = $this->dom->createElement("itensRemun");
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "codRubr",
                                        $irem->codrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "ideTabRubr",
                                        $irem->idetabrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "qtdRubr",
                                        !empty($irem->qtdrubr) ? $irem->qtdrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "fatorRubr",
                                        !empty($irem->fatorrubr) ? $irem->fatorrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "vrRubr",
                                        $irem->vrrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $itensRemun,
                                        "indApurIR",
                                        isset($irem->indapurir) ? $irem->indapurir : null,
                                        false
                                    );
                                    $remunPerAnt->appendChild($itensRemun);
                                }
                                if (!empty($rpr->infoagnocivo)) {
                                    $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                                    $this->dom->addChild(
                                        $infoAgNocivo,
                                        "grauExp",
                                        $rpr->infoagnocivo->grauexp,
                                        true
                                    );
                                    $remunPerAnt->appendChild($infoAgNocivo);
                                }
                                $ideEstabLot->appendChild($remunPerAnt);
                            }
                            $idePeriodo->appendChild($ideEstabLot);
                        }
                        $ideADC->appendChild($idePeriodo);
                    }
                    $infoPerAnt->appendChild($ideADC);
                }
                $dmdev->appendChild($infoPerAnt);
            }
            if (!empty($dm->infocomplcont)) {
                $infoComplCont = $this->dom->createElement("infoComplCont");
                $this->dom->addChild(
                    $infoComplCont,
                    "codCBO",
                    $dm->infocomplcont->codcbo,
                    true
                );
                $this->dom->addChild(
                    $infoComplCont,
                    "natAtividade",
                    !empty($dm->infocomplcont->natatividade) ? $dm->infocomplcont->natatividade : null,
                    false
                );
                $this->dom->addChild(
                    $infoComplCont,
                    "qtdDiasTrab",
                    !empty($dm->infocomplcont->qtddiastrab) ? $dm->infocomplcont->qtddiastrab : null,
                    false
                );
                $dmdev->appendChild($infoComplCont);
            }
            $this->node->appendChild($dmdev);
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
