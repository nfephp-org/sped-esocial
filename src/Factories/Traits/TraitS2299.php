<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2299
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
        $infoDeslig = $this->dom->createElement("infoDeslig");
        $this->dom->addChild(
            $infoDeslig,
            "mtvDeslig",
            $this->std->mtvdeslig,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "dtDeslig",
            $this->std->dtdeslig,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "indPagtoAPI",
            $this->std->indpagtoapi,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "dtProjFimAPI",
            !empty($this->std->dtprojfimapi) ? $this->std->dtprojfimapi : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "pensAlim",
            $this->std->pensalim,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "percAliment",
            !empty($this->std->percaliment) ? $this->std->percaliment : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "vrAlim",
            !empty($this->std->vralim) ? $this->std->vralim : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "nrCertObito",
            !empty($this->std->nrcertobito) ? $this->std->nrcertobito : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "nrProcTrab",
            !empty($this->std->nrproctrab) ? $this->std->nrproctrab : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "indCumprParc",
            $this->std->indcumprparc,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "qtdDiasInterm",
            !empty($this->std->qtddiasinterm) ? $this->std->qtddiasinterm : null,
            false
        );
        if (!empty($this->std->observacoes)) {
            $observacoes = $this->dom->createElement("observacoes");
            foreach ($this->std->observacoes as $obs) {
                $this->dom->addChild(
                    $observacoes,
                    "observacao",
                    $obs->observacao,
                    false
                );
            }
            $infoDeslig->appendChild($observacoes);
        }
        if (!empty($this->std->sucessaovinc)) {
            $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
            $this->dom->addChild(
                $sucessaoVinc,
                "tpInscSuc",
                !empty($this->std->sucessaovinc->tpinscsuc) ? $this->std->sucessaovinc->tpinscsuc : null,
                false
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "cnpjSucessora",
                $this->std->sucessaovinc->cnpjsucessora,
                true
            );
            $infoDeslig->appendChild($sucessaoVinc);
        }
        if (!empty($this->std->transftit)) {
            $transfTit = $this->dom->createElement("transfTit");
            $this->dom->addChild(
                $transfTit,
                "cpfSubstituto",
                $this->std->transftit->cpfsubstituto,
                true
            );
            $this->dom->addChild(
                $transfTit,
                "dtNascto",
                $this->std->transftit->dtnascto,
                true
            );
            $infoDeslig->appendChild($transfTit);
        }
        if (!empty($this->std->mudancacpf)) {
            $mudancaCPF = $this->dom->createElement("mudancaCPF");
            $mcpf = $this->std->mudancacpf;
            $this->dom->addChild(
                $mudancaCPF,
                "novoCPF",
                $mcpf->novocpf,
                true
            );
            $infoDeslig->appendChild($mudancaCPF);
        }

        if (!empty($this->std->verbasresc)) {
            $verbasResc = $this->dom->createElement("verbasResc");
            foreach ($this->std->verbasresc->dmdev as $dm) {
                $dmDev = $this->dom->createElement("dmDev");
                $this->dom->addChild(
                    $dmDev,
                    "ideDmDev",
                    $dm->idedmdev,
                    true
                );
                if (!empty($dm->infoperapur)) {
                    $infoPerApur = $this->dom->createElement("infoPerApur");
                    foreach ($dm->infoperapur->ideestablot as $isl) {
                        $ideEstabLot = $this->dom->createElement("ideEstabLot");
                        $this->dom->addChild(
                            $ideEstabLot,
                            "tpInsc",
                            $isl->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $ideEstabLot,
                            "nrInsc",
                            $isl->nrinsc,
                            true
                        );
                        $this->dom->addChild(
                            $ideEstabLot,
                            "codLotacao",
                            $isl->codlotacao,
                            true
                        );
                        foreach ($isl->detverbas as $dv) {
                            $detVerbas = $this->dom->createElement("detVerbas");
                            $this->dom->addChild(
                                $detVerbas,
                                "codRubr",
                                $dv->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "ideTabRubr",
                                $dv->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "qtdRubr",
                                !empty($dv->qtdrubr) ? $dv->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "fatorRubr",
                                !empty($dv->fatorrubr) ? $dv->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "vrUnit",
                                !empty($dv->vrunit) ? $dv->vrunit : null,
                                false
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "vrRubr",
                                $dv->vrrubr,
                                true
                            );
                            $ideEstabLot->appendChild($detVerbas);
                        }
                        if (!empty($isl->infosaudecolet)) {
                            $infoSaudeColet = $this->dom->createElement("infoSaudeColet");
                            foreach ($isl->infosaudecolet->detoper as $do) {
                                $detOper = $this->dom->createElement("detOper");
                                $this->dom->addChild(
                                    $detOper,
                                    "cnpjOper",
                                    $do->cnpjoper,
                                    true
                                );
                                $this->dom->addChild(
                                    $detOper,
                                    "regANS",
                                    $do->regans,
                                    true
                                );
                                $this->dom->addChild(
                                    $detOper,
                                    "vrPgTit",
                                    $do->vrpgtit,
                                    true
                                );
                                if (!empty($do->detplano)) {
                                    foreach ($do->detplano as $dp) {
                                        $detPlano = $this->dom->createElement("detPlano");
                                        $this->dom->addChild(
                                            $detPlano,
                                            "tpDep",
                                            $dp->tpdep,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $detPlano,
                                            "cpfDep",
                                            !empty($dp->cpfdep) ? $dp->cpfdep : null,
                                            false
                                        );
                                        $this->dom->addChild(
                                            $detPlano,
                                            "nmDep",
                                            $dp->nmdep,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $detPlano,
                                            "dtNascto",
                                            $dp->dtnascto,
                                            true
                                        );
                                        $this->dom->addChild(
                                            $detPlano,
                                            "vlrPgDep",
                                            $dp->vlrpgdep,
                                            true
                                        );
                                        $detOper->appendChild($detPlano);
                                    }
                                }
                                $infoSaudeColet->appendChild($detOper);
                            }
                            $ideEstabLot->appendChild($infoSaudeColet);
                        }
                        if (!empty($isl->infoagnocivo)) {
                            $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                            $this->dom->addChild(
                                $infoAgNocivo,
                                "grauExp",
                                $isl->infoagnocivo->grauexp,
                                true
                            );
                            $ideEstabLot->appendChild($infoAgNocivo);
                        }
                        if (!empty($isl->infosimples)) {
                            $infoSimples = $this->dom->createElement("infoSimples");
                            $this->dom->addChild(
                                $infoSimples,
                                "indSimples",
                                $isl->infosimples->indsimples,
                                true
                            );
                            $ideEstabLot->appendChild($infoSimples);
                        }
                        $infoPerApur->appendChild($ideEstabLot);
                    }
                    $dmDev->appendChild($infoPerApur);
                }
                if (!empty($dm->infoperant)) {
                    $infoPerAnt = $this->dom->createElement("infoPerAnt");
                    foreach ($dm->infoperant->ideadc as $adc) {
                        $ideADC = $this->dom->createElement("ideADC");
                        $this->dom->addChild(
                            $ideADC,
                            "dtAcConv",
                            $adc->dtacconv,
                            true
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "tpAcConv",
                            $adc->tpacconv,
                            true
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "compAcConv",
                            !empty($adc->compacconv) ? $adc->compacconv : null,
                            false
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "dtEfAcConv",
                            !empty($adc->dtefacconv) ? $adc->dtefacconv : null,
                            false
                        );
                        $this->dom->addChild(
                            $ideADC,
                            "dsc",
                            $adc->dsc,
                            true
                        );
                        foreach ($adc->ideperiodo as $aper) {
                            $idePeriodo = $this->dom->createElement("idePeriodo");
                            $this->dom->addChild(
                                $idePeriodo,
                                "perRef",
                                $aper->perref,
                                true
                            );
                            foreach ($aper->ideestablot as $ael) {
                                $dmideEstabLot = $this->dom->createElement("ideEstabLot");
                                $this->dom->addChild(
                                    $dmideEstabLot,
                                    "tpInsc",
                                    $ael->tpinsc,
                                    true
                                );
                                $this->dom->addChild(
                                    $dmideEstabLot,
                                    "nrInsc",
                                    $ael->nrinsc,
                                    true
                                );
                                $this->dom->addChild(
                                    $dmideEstabLot,
                                    "codLotacao",
                                    $ael->codlotacao,
                                    true
                                );
                                foreach ($ael->detverbas as $adv) {
                                    $dmdetVerbas = $this->dom->createElement("detVerbas");
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "codRubr",
                                        $adv->codrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "ideTabRubr",
                                        $adv->idetabrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "qtdRubr",
                                        !empty($adv->qtdrubr) ? $adv->qtdrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "fatorRubr",
                                        !empty($adv->fatorrubr) ? $adv->fatorrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "vrUnit",
                                        !empty($adv->vrunit) ? $adv->vrunit : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "vrRubr",
                                        $adv->vrrubr,
                                        true
                                    );
                                    $dmideEstabLot->appendChild($dmdetVerbas);
                                }
                                if (!empty($ael->infoagnocivo)) {
                                    $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                                    $this->dom->addChild(
                                        $infoAgNocivo,
                                        "grauExp",
                                        $ael->infoagnocivo->grauexp,
                                        true
                                    );
                                    $dmideEstabLot->appendChild($infoAgNocivo);
                                }
                                if (!empty($ael->infosimples)) {
                                    $infoSimples = $this->dom->createElement("infoSimples");
                                    $this->dom->addChild(
                                        $infoSimples,
                                        "indSimples",
                                        $ael->infosimples->indsimples,
                                        true
                                    );
                                    $dmideEstabLot->appendChild($infoSimples);
                                }
                                $idePeriodo->appendChild($dmideEstabLot);
                            }
                            $ideADC->appendChild($idePeriodo);
                        }
                        $infoPerAnt->appendChild($ideADC);
                    }
                    $dmDev->appendChild($infoPerAnt);
                }
                if (!empty($dm->infotrabinterm)) {
                    foreach ($dm->infotrabinterm as $tin) {
                        $infoTrabInterm = $this->dom->createElement("infoTrabInterm");
                        $this->dom->addChild(
                            $infoTrabInterm,
                            "codConv",
                            $tin->codconv,
                            true
                        );
                        $dmDev->appendChild($infoTrabInterm);
                    }
                }
                $verbasResc->appendChild($dmDev);
            }
            if (!empty($this->std->verbasresc->procjudtrab)) {
                foreach ($this->std->verbasresc->procjudtrab as $pjt) {
                    $procJudTrab = $this->dom->createElement("procJudTrab");
                    $this->dom->addChild(
                        $procJudTrab,
                        "tpTrib",
                        $pjt->tptrib,
                        true
                    );
                    $this->dom->addChild(
                        $procJudTrab,
                        "nrProcJud",
                        $pjt->nrprocjud,
                        true
                    );
                    $this->dom->addChild(
                        $procJudTrab,
                        "codSusp",
                        !empty($pjt->codsusp) ? $pjt->codsusp : null,
                        false
                    );
                    $verbasResc->appendChild($procJudTrab);
                }
            }
            if (!empty($this->std->verbasresc->infomv)) {
                $imv = $this->std->verbasresc->infomv;
                $infoMV = $this->dom->createElement("infoMV");
                $this->dom->addChild(
                    $infoMV,
                    "indMV",
                    $imv->indmv,
                    true
                );
                foreach ($imv->remunoutrempr as $roe) {
                    $remunOutrEmpr = $this->dom->createElement("remunOutrEmpr");
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "tpInsc",
                        $roe->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "nrInsc",
                        $roe->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "codCateg",
                        $roe->codcateg,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "vlrRemunOE",
                        $roe->vlrremunoe,
                        true
                    );
                    $infoMV->appendChild($remunOutrEmpr);
                }
                $verbasResc->appendChild($infoMV);
            }
            if (!empty($this->std->verbasresc->proccs)) {
                $procCS = $this->dom->createElement("procCS");
                $this->dom->addChild(
                    $procCS,
                    "nrProcJud",
                    $this->std->verbasresc->proccs->nrprocjud,
                    true
                );
                $verbasResc->appendChild($procCS);
            }
            $infoDeslig->appendChild($verbasResc);
        }
        if (!empty($this->std->quarentena)) {
            $quarentena = $this->dom->createElement("quarentena");
            $this->dom->addChild(
                $quarentena,
                "dtFimQuar",
                $this->std->quarentena->dtfimquar,
                true
            );
            $infoDeslig->appendChild($quarentena);
        }

        if (!empty($this->std->consigfgts)) {
            foreach ($this->std->consigfgts as $cfg) {
                $consigFGTS = $this->dom->createElement("consigFGTS");
                $this->dom->addChild(
                    $consigFGTS,
                    "insConsig",
                    $cfg->insconsig,
                    true
                );
                $this->dom->addChild(
                    $consigFGTS,
                    "nrContr",
                    $cfg->nrcontr,
                    true
                );
                $infoDeslig->appendChild($consigFGTS);
            }
        }

        $this->node->appendChild($infoDeslig);
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
        $infoDeslig = $this->dom->createElement("infoDeslig");
        $this->dom->addChild(
            $infoDeslig,
            "mtvDeslig",
            $this->std->mtvdeslig,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "dtDeslig",
            $this->std->dtdeslig,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "dtAvPrv",
            !empty($this->std->dtavprv) ? $this->std->dtavprv : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "indPagtoAPI",
            $this->std->indpagtoapi,
            true
        );
        $this->dom->addChild(
            $infoDeslig,
            "dtProjFimAPI",
            !empty($this->std->dtprojfimapi) ? $this->std->dtprojfimapi : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "pensAlim",
            isset($this->std->pensalim) ? $this->std->pensalim : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "percAliment",
            !empty($this->std->percaliment) ? $this->std->percaliment : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "vrAlim",
            !empty($this->std->vralim) ? $this->std->vralim : null,
            false
        );
        $this->dom->addChild(
            $infoDeslig,
            "nrProcTrab",
            !empty($this->std->nrproctrab) ? $this->std->nrproctrab : null,
            false
        );
        if (!empty($this->std->infointerm)) {
            $infoInterm = $this->dom->createElement("infoInterm");
            foreach ($this->std->infointerm as $interm) {
                $this->dom->addChild(
                    $infoInterm,
                    "dia",
                    $interm->dia,
                    true
                );
            }
            $infoDeslig->appendChild($infoInterm);
        }
        if (!empty($this->std->observacoes)) {
            $observacoes = $this->dom->createElement("observacoes");
            foreach ($this->std->observacoes as $obs) {
                $this->dom->addChild(
                    $observacoes,
                    "observacao",
                    $obs->observacao,
                    true
                );
            }
            $infoDeslig->appendChild($observacoes);
        }
        if (!empty($this->std->sucessaovinc)) {
            $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
            $svinc = $this->std->sucessaovinc;
            $this->dom->addChild(
                $sucessaoVinc,
                "tpInsc",
                $svinc->tpinsc,
                true
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "nrInsc",
                $svinc->nrinsc,
                true
            );
            $infoDeslig->appendChild($sucessaoVinc);
        }
        if (!empty($this->std->transftit)) {
            $transfTit = $this->dom->createElement("transfTit");
            $this->dom->addChild(
                $transfTit,
                "cpfSubstituto",
                $this->std->transftit->cpfsubstituto,
                true
            );
            $this->dom->addChild(
                $transfTit,
                "dtNascto",
                $this->std->transftit->dtnascto,
                true
            );
            $infoDeslig->appendChild($transfTit);
        }
        if (!empty($this->std->mudancacpf)) {
            $mudancaCPF = $this->dom->createElement("mudancaCPF");
            $mcpf = $this->std->mudancacpf;
            $this->dom->addChild(
                $mudancaCPF,
                "novoCPF",
                $mcpf->novocpf,
                true
            );
            $infoDeslig->appendChild($mudancaCPF);
        }

        if (!empty($this->std->verbasresc)) {
            $verbasResc = $this->dom->createElement("verbasResc");
            foreach ($this->std->verbasresc->dmdev as $dm) {
                $dmDev = $this->dom->createElement("dmDev");
                $this->dom->addChild(
                    $dmDev,
                    "ideDmDev",
                    $dm->idedmdev,
                    true
                );
                if (!empty($dm->infoperapur)) {
                    $infoPerApur = $this->dom->createElement("infoPerApur");
                    foreach ($dm->infoperapur->ideestablot as $isl) {
                        $ideEstabLot = $this->dom->createElement("ideEstabLot");
                        $this->dom->addChild(
                            $ideEstabLot,
                            "tpInsc",
                            $isl->tpinsc,
                            true
                        );
                        $this->dom->addChild(
                            $ideEstabLot,
                            "nrInsc",
                            $isl->nrinsc,
                            true
                        );
                        $this->dom->addChild(
                            $ideEstabLot,
                            "codLotacao",
                            $isl->codlotacao,
                            true
                        );
                        foreach ($isl->detverbas as $dv) {
                            $detVerbas = $this->dom->createElement("detVerbas");
                            $this->dom->addChild(
                                $detVerbas,
                                "codRubr",
                                $dv->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "ideTabRubr",
                                $dv->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "qtdRubr",
                                !empty($dv->qtdrubr) ? $dv->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "fatorRubr",
                                !empty($dv->fatorrubr) ? $dv->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "vrRubr",
                                $dv->vrrubr,
                                true
                            );
                            $this->dom->addChild(
                                $detVerbas,
                                "indApurIR",
                                isset($dv->indapurir) ? $dv->indapurir : null,
                                false
                            );
                            $ideEstabLot->appendChild($detVerbas);
                        }
                        if (!empty($isl->infoagnocivo)) {
                            $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                            $this->dom->addChild(
                                $infoAgNocivo,
                                "grauExp",
                                $isl->infoagnocivo->grauexp,
                                true
                            );
                            $ideEstabLot->appendChild($infoAgNocivo);
                        }
                        if (!empty($isl->infosimples)) {
                            $infoSimples = $this->dom->createElement("infoSimples");
                            $this->dom->addChild(
                                $infoSimples,
                                "indSimples",
                                $isl->infosimples->indsimples,
                                true
                            );
                            $ideEstabLot->appendChild($infoSimples);
                        }
                        $infoPerApur->appendChild($ideEstabLot);
                    }
                    $dmDev->appendChild($infoPerApur);
                }
                if (!empty($dm->infoperant)) {
                    $infoPerAnt = $this->dom->createElement("infoPerAnt");
                    foreach ($dm->infoperant->ideadc as $adc) {
                        $ideADC = $this->dom->createElement("ideADC");
                        $this->dom->addChild(
                            $ideADC,
                            "dtAcConv",
                            $adc->dtacconv,
                            true
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
                        foreach ($adc->ideperiodo as $aper) {
                            $idePeriodo = $this->dom->createElement("idePeriodo");
                            $this->dom->addChild(
                                $idePeriodo,
                                "perRef",
                                $aper->perref,
                                true
                            );
                            foreach ($aper->ideestablot as $ael) {
                                $dmideEstabLot = $this->dom->createElement("ideEstabLot");
                                $this->dom->addChild(
                                    $dmideEstabLot,
                                    "tpInsc",
                                    $ael->tpinsc,
                                    true
                                );
                                $this->dom->addChild(
                                    $dmideEstabLot,
                                    "nrInsc",
                                    $ael->nrinsc,
                                    true
                                );
                                $this->dom->addChild(
                                    $dmideEstabLot,
                                    "codLotacao",
                                    $ael->codlotacao,
                                    true
                                );
                                foreach ($ael->detverbas as $adv) {
                                    $dmdetVerbas = $this->dom->createElement("detVerbas");
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "codRubr",
                                        $adv->codrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "ideTabRubr",
                                        $adv->idetabrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "qtdRubr",
                                        !empty($adv->qtdrubr) ? $adv->qtdrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "fatorRubr",
                                        !empty($adv->fatorrubr) ? $adv->fatorrubr : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "vrRubr",
                                        $adv->vrrubr,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $dmdetVerbas,
                                        "indApurIR",
                                        isset($adv->indapurir) ? $adv->indapurir : null,
                                        false
                                    );
                                    $dmideEstabLot->appendChild($dmdetVerbas);
                                }
                                if (!empty($ael->infoagnocivo)) {
                                    $infoAgNocivo = $this->dom->createElement("infoAgNocivo");
                                    $this->dom->addChild(
                                        $infoAgNocivo,
                                        "grauExp",
                                        $ael->infoagnocivo->grauexp,
                                        true
                                    );
                                    $dmideEstabLot->appendChild($infoAgNocivo);
                                }
                                if (!empty($ael->infosimples)) {
                                    $infoSimples = $this->dom->createElement("infoSimples");
                                    $this->dom->addChild(
                                        $infoSimples,
                                        "indSimples",
                                        $ael->infosimples->indsimples,
                                        true
                                    );
                                    $dmideEstabLot->appendChild($infoSimples);
                                }
                                $idePeriodo->appendChild($dmideEstabLot);
                            }
                            $ideADC->appendChild($idePeriodo);
                        }
                        $infoPerAnt->appendChild($ideADC);
                    }
                    $dmDev->appendChild($infoPerAnt);
                }
                $verbasResc->appendChild($dmDev);
            }
            if (!empty($this->std->verbasresc->procjudtrab)) {
                foreach ($this->std->verbasresc->procjudtrab as $pjt) {
                    $procJudTrab = $this->dom->createElement("procJudTrab");
                    $this->dom->addChild(
                        $procJudTrab,
                        "tpTrib",
                        $pjt->tptrib,
                        true
                    );
                    $this->dom->addChild(
                        $procJudTrab,
                        "nrProcJud",
                        $pjt->nrprocjud,
                        true
                    );
                    $this->dom->addChild(
                        $procJudTrab,
                        "codSusp",
                        !empty($pjt->codsusp) ? $pjt->codsusp : null,
                        false
                    );
                    $verbasResc->appendChild($procJudTrab);
                }
            }
            if (!empty($this->std->verbasresc->infomv)) {
                $imv = $this->std->verbasresc->infomv;
                $infoMV = $this->dom->createElement("infoMV");
                $this->dom->addChild(
                    $infoMV,
                    "indMV",
                    $imv->indmv,
                    true
                );
                foreach ($imv->remunoutrempr as $roe) {
                    $remunOutrEmpr = $this->dom->createElement("remunOutrEmpr");
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "tpInsc",
                        $roe->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "nrInsc",
                        $roe->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "codCateg",
                        $roe->codcateg,
                        true
                    );
                    $this->dom->addChild(
                        $remunOutrEmpr,
                        "vlrRemunOE",
                        $roe->vlrremunoe,
                        true
                    );
                    $infoMV->appendChild($remunOutrEmpr);
                }
                $verbasResc->appendChild($infoMV);
            }
            if (!empty($this->std->verbasresc->proccs)) {
                $procCS = $this->dom->createElement("procCS");
                $this->dom->addChild(
                    $procCS,
                    "nrProcJud",
                    $this->std->verbasresc->proccs->nrprocjud,
                    true
                );
                $verbasResc->appendChild($procCS);
            }
            $infoDeslig->appendChild($verbasResc);
        }
        if (!empty($this->std->quarentena)) {
            $quarentena = $this->dom->createElement("quarentena");
            $this->dom->addChild(
                $quarentena,
                "dtFimQuar",
                $this->std->quarentena->dtfimquar,
                true
            );
            $infoDeslig->appendChild($quarentena);
        }

        if (!empty($this->std->consigfgts)) {
            foreach ($this->std->consigfgts as $cfg) {
                $consigFGTS = $this->dom->createElement("consigFGTS");
                $this->dom->addChild(
                    $consigFGTS,
                    "insConsig",
                    $cfg->insconsig,
                    true
                );
                $this->dom->addChild(
                    $consigFGTS,
                    "nrContr",
                    $cfg->nrcontr,
                    true
                );
                $infoDeslig->appendChild($consigFGTS);
            }
        }

        $this->node->appendChild($infoDeslig);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);

        $this->sign();
    }
}
