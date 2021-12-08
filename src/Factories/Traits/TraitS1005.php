<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1005
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

        //tag deste evento em particular
        $infoEstab = $this->dom->createElement("infoEstab");

        //tag comum a todos os modos
        $ideEstab = $this->dom->createElement("ideEstab");
        $this->dom->addChild(
            $ideEstab,
            "tpInsc",
            $this->std->tpinsc,
            true
        );
        $this->dom->addChild(
            $ideEstab,
            "nrInsc",
            $this->std->nrinsc,
            true
        );
        $this->dom->addChild(
            $ideEstab,
            "iniValid",
            $this->std->inivalid,
            true
        );
        $this->dom->addChild(
            $ideEstab,
            "fimValid",
            ! empty($this->std->fimvalid) ? $this->std->fimvalid : null,
            false
        );

        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
        } else {
            $node = $this->dom->createElement("exclusao");
        }
        $node->appendChild($ideEstab);

        if (! empty($this->std->dadosestab)) {
            $dadosEstab = $this->dom->createElement("dadosEstab");
            $this->dom->addChild(
                $dadosEstab,
                "cnaePrep",
                $this->std->dadosestab->cnaeprep,
                true
            );
            $aliqGilrat = $this->dom->createElement("aliqGilrat");
            $this->dom->addChild(
                $aliqGilrat,
                "aliqRat",
                $this->std->dadosestab->aliqgilrat->aliqrat,
                true
            );
            $fap = ! empty($this->std->dadosestab->aliqgilrat->fap) ? $this->std->dadosestab->aliqgilrat->fap : null;
            if ($fap) {
                $fap = number_format($fap, 4, '.', '');
            }
            $this->dom->addChild(
                $aliqGilrat,
                "fap",
                $fap,
                false
            );
            $aliqrata = ! empty($this->std->dadosestab->aliqgilrat->aliqratajust)
                ? $this->std->dadosestab->aliqgilrat->aliqratajust
                : null;
            if ($aliqrata) {
                $aliqrata = number_format($aliqrata, 4, '.', '');
            }
            $this->dom->addChild(
                $aliqGilrat,
                "aliqRatAjust",
                $aliqrata,
                false
            );
            if (! empty($this->std->dadosestab->aliqgilrat->procadmjudrat)) {
                $procAdmJudRat = $this->dom->createElement("procAdmJudRat");
                $this->dom->addChild(
                    $procAdmJudRat,
                    "tpProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudrat->tpproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudRat,
                    "nrProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudrat->nrproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudRat,
                    "codSusp",
                    $this->std->dadosestab->aliqgilrat->procadmjudrat->codsusp,
                    true
                );
                $aliqGilrat->appendChild($procAdmJudRat);
            }
            if (! empty($this->std->dadosestab->aliqgilrat->procadmjudfap)) {
                $procAdmJudFap = $this->dom->createElement("procAdmJudFap");
                $this->dom->addChild(
                    $procAdmJudFap,
                    "tpProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudfap->tpproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudFap,
                    "nrProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudfap->nrproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudFap,
                    "codSusp",
                    $this->std->dadosestab->aliqgilrat->procadmjudfap->codsusp,
                    true
                );
                $aliqGilrat->appendChild($procAdmJudFap);
            }
            $dadosEstab->appendChild($aliqGilrat);

            if (! empty($this->std->dadosestab->infocaepf)) {
                $infoCaepf = $this->dom->createElement("infoCaepf");
                $this->dom->addChild(
                    $infoCaepf,
                    "tpCaepf",
                    $this->std->dadosestab->infocaepf->tpcaepf,
                    true
                );
                $dadosEstab->appendChild($infoCaepf);
            }

            if (! empty($this->std->dadosestab->infoobra)) {
                $infoObra = $this->dom->createElement("infoObra");
                $this->dom->addChild(
                    $infoObra,
                    "indSubstPatrObra",
                    $this->std->dadosestab->infoobra->indsubstpatrobra,
                    true
                );
                $dadosEstab->appendChild($infoObra);
            }
            
            $infoTrab = $this->dom->createElement("infoTrab");
            $this->dom->addChild(
                $infoTrab,
                "regPt",
                $this->std->dadosestab->infotrab->regpt,
                true
            );
            if (! empty($this->std->dadosestab->infoapr)) {
                $infoApr = $this->dom->createElement("infoApr");
                $this->dom->addChild(
                    $infoApr,
                    "contApr",
                    $this->std->dadosestab->infotrab->infoapr->contapr,
                    true
                );
                $this->dom->addChild(
                    $infoApr,
                    "nrProcJud",
                    ! empty($this->std->dadosestab->infotrab->infoapr->nrprocjud)
                        ? $this->std->dadosestab->infotrab->infoapr->nrprocjud
                        : null,
                    false
                );
                $this->dom->addChild(
                    $infoApr,
                    "contEntEd",
                    ! empty($this->std->dadosestab->infotrab->infoapr->contented)
                        ? $this->std->dadosestab->infotrab->infoapr->contented
                        : null,
                    false
                );

                if (! empty($this->std->dadosestab->infotrab->infoapr->infoenteduc)) {
                    foreach ($this->std->dadosestab->infotrab->infoapr->infoenteduc as $edu) {
                        $infoEntEduc = $this->dom->createElement("infoEntEduc");
                        $this->dom->addChild(
                            $infoEntEduc,
                            "nrInsc",
                            $edu->nrinsc,
                            true
                        );
                        $infoApr->appendChild($infoEntEduc);
                    }
                }

                $infoTrab->appendChild($infoApr);
            }
            if (! empty($this->std->dadosestab->infotrab->infopdc)) {
                $infoPCD = $this->dom->createElement("infoPCD");
                $this->dom->addChild(
                    $infoPCD,
                    "contPCD",
                    $this->std->dadosestab->infotrab->infopdc->contpdc,
                    true
                );
                $this->dom->addChild(
                    $infoPCD,
                    "nrProcJud",
                    ! empty($this->std->dadosestab->infotrab->infopdc->nrprocjud)
                        ? $this->std->dadosestab->infotrab->infopdc->nrprocjud
                        : null,
                    false
                );
                $infoTrab->appendChild($infoPCD);
            }
            $dadosEstab->appendChild($infoTrab);
            $node->appendChild($dadosEstab);
        }

        if (! empty($this->std->novavalidade) && $this->std->modo == 'ALT') {
            $newVal = $this->std->novavalidade;
            $novaValidade = $this->dom->createElement("novaValidade");
            $this->dom->addChild(
                $novaValidade,
                "iniValid",
                $newVal->inivalid,
                true
            );
            $this->dom->addChild(
                $novaValidade,
                "fimValid",
                ! empty($newVal->fimvalid) ? $newVal->fimvalid : null,
                false
            );
            $node->appendChild($novaValidade);
        }
        $infoEstab = $this->dom->createElement("infoEstab");
        $infoEstab->appendChild($node);
        //finalização do xml
        $this->node->appendChild($infoEstab);
        $this->eSocial->appendChild($this->node);
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

        //tag deste evento em particular
        $infoEstab = $this->dom->createElement("infoEstab");

        //tag comum a todos os modos
        $ideEstab = $this->dom->createElement("ideEstab");
        $this->dom->addChild(
            $ideEstab,
            "tpInsc",
            $this->std->tpinsc,
            true
        );
        $this->dom->addChild(
            $ideEstab,
            "nrInsc",
            $this->std->nrinsc,
            true
        );
        $this->dom->addChild(
            $ideEstab,
            "iniValid",
            $this->std->inivalid,
            true
        );
        if ($this->std->modo !== 'INC') {
            $this->dom->addChild(
                $ideEstab,
                "fimValid",
                !empty($this->std->fimvalid) ? $this->std->fimvalid : null,
                false
            );
        }

        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
        } else {
            $node = $this->dom->createElement("exclusao");
        }
        $node->appendChild($ideEstab);

        if (!empty($this->std->dadosestab) && in_array($this->std->modo, ['INC', 'ALT'])) {
            $dadosEstab = $this->dom->createElement("dadosEstab");
            $this->dom->addChild(
                $dadosEstab,
                "cnaePrep",
                $this->std->dadosestab->cnaeprep,
                true
            );
            $aliqGilrat = $this->dom->createElement("aliqGilrat");
            $this->dom->addChild(
                $aliqGilrat,
                "aliqRat",
                ! empty($this->std->dadosestab->aliqgilrat->aliqrat)
                    ? $this->std->dadosestab->aliqgilrat->aliqrat
                    : null,
                false
            );
            $fap = !empty($this->std->dadosestab->aliqgilrat->fap)
                ? $this->std->dadosestab->aliqgilrat->fap
                : null;
            if ($fap) {
                $fap = number_format($fap, 4, '.', '');
            }
            $this->dom->addChild(
                $aliqGilrat,
                "fap",
                $fap,
                false
            );
            if (!empty($this->std->dadosestab->aliqgilrat->procadmjudrat)) {
                $procAdmJudRat = $this->dom->createElement("procAdmJudRat");
                $this->dom->addChild(
                    $procAdmJudRat,
                    "tpProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudrat->tpproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudRat,
                    "nrProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudrat->nrproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudRat,
                    "codSusp",
                    $this->std->dadosestab->aliqgilrat->procadmjudrat->codsusp,
                    true
                );
                $aliqGilrat->appendChild($procAdmJudRat);
            }
            if (!empty($this->std->dadosestab->aliqgilrat->procadmjudfap)) {
                $procAdmJudFap = $this->dom->createElement("procAdmJudFap");
                $this->dom->addChild(
                    $procAdmJudFap,
                    "tpProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudfap->tpproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudFap,
                    "nrProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudfap->nrproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudFap,
                    "codSusp",
                    $this->std->dadosestab->aliqgilrat->procadmjudfap->codsusp,
                    true
                );
                $aliqGilrat->appendChild($procAdmJudFap);
            }
            $dadosEstab->appendChild($aliqGilrat);
            if (!empty($this->std->dadosestab->infocaepf)) {
                $infoCaepf = $this->dom->createElement("infoCaepf");
                $this->dom->addChild(
                    $infoCaepf,
                    "tpCaepf",
                    $this->std->dadosestab->infocaepf->tpcaepf,
                    true
                );
                $dadosEstab->appendChild($infoCaepf);
            }
            if (! empty($this->std->dadosestab->infoobra)) {
                $infoObra = $this->dom->createElement("infoObra");
                $this->dom->addChild(
                    $infoObra,
                    "indSubstPatrObra",
                    $this->std->dadosestab->infoobra->indsubstpatrobra,
                    true
                );
                $dadosEstab->appendChild($infoObra);
            }
            if (!empty($this->std->dadosestab->infotrab)) {
                $infoTrab = $this->dom->createElement("infoTrab");
                if (!empty($this->std->dadosestab->infotrab->infoapr)) {
                    $infoApr = $this->dom->createElement("infoApr");
                    $this->dom->addChild(
                        $infoApr,
                        "nrProcJud",
                        ! empty($this->std->dadosestab->infotrab->infoapr->nrprocjud)
                            ? $this->std->dadosestab->infotrab->infoapr->nrprocjud
                            : null,
                        false
                    );
                    if (! empty($this->std->dadosestab->infotrab->infoapr->infoenteduc)) {
                        foreach ($this->std->dadosestab->infotrab->infoapr->infoenteduc as $edu) {
                            $infoEntEduc = $this->dom->createElement("infoEntEduc");
                            $this->dom->addChild(
                                $infoEntEduc,
                                "nrInsc",
                                $edu->nrinsc,
                                true
                            );
                            $infoApr->appendChild($infoEntEduc);
                        }
                    }
                    $infoTrab->appendChild($infoApr);
                }
                if (!empty($this->std->dadosestab->infotrab->infopdc)) {
                    $infoPCD = $this->dom->createElement("infoPCD");
                    $this->dom->addChild(
                        $infoPCD,
                        "nrProcJud",
                        $this->std->dadosestab->infotrab->infopdc->nrprocjud,
                        true
                    );
                    $infoTrab->appendChild($infoPCD);
                }
                $dadosEstab->appendChild($infoTrab);
            }
            $node->appendChild($dadosEstab);
        }
        if (!empty($this->std->novavalidade) && $this->std->modo == 'ALT') {
            $newVal = $this->std->novavalidade;
            $novaValidade = $this->dom->createElement("novaValidade");
            $this->dom->addChild(
                $novaValidade,
                "iniValid",
                $newVal->inivalid,
                true
            );
            $this->dom->addChild(
                $novaValidade,
                "fimValid",
                !empty($newVal->fimvalid) ? $newVal->fimvalid : null,
                false
            );
            $node->appendChild($novaValidade);
        }
        $infoEstab = $this->dom->createElement("infoEstab");
        $infoEstab->appendChild($node);
        //finalização do xml
        $this->node->appendChild($infoEstab);
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
