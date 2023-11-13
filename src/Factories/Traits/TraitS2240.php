<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2240
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
        $ide = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ide,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ide,
            "matricula",
            !empty($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->dom->addChild(
            $ide,
            "codCateg",
            !empty($this->std->codcateg) ? $this->std->codcateg : null,
            false
        );
        $this->node->appendChild($ide);
        $info = $this->dom->createElement("infoExpRisco");
        $this->dom->addChild(
            $info,
            "dtIniCondicao",
            $this->std->dtinicondicao,
            true
        );

        $infoamb = $this->dom->createElement("infoAmb");
        $this->dom->addChild(
            $infoamb,
            "localAmb",
            $this->std->infoamb->localamb,
            true
        );
        $this->dom->addChild(
            $infoamb,
            "dscSetor",
            $this->std->infoamb->dscsetor,
            true
        );
        $this->dom->addChild(
            $infoamb,
            "tpInsc",
            $this->std->infoamb->tpinsc,
            true
        );
        $this->dom->addChild(
            $infoamb,
            "nrInsc",
            $this->std->infoamb->nrinsc,
            true
        );
        $info->appendChild($infoamb);

        $infoAtiv = $this->dom->createElement("infoAtiv");
        $this->dom->addChild(
            $infoAtiv,
            "dscAtivDes",
            $this->std->dscativdes,
            true
        );
        $info->appendChild($infoAtiv);

        foreach ($this->std->agnoc as $ag) {
            $agNoc = $this->dom->createElement("agNoc");
            $this->dom->addChild(
                $agNoc,
                "codAgNoc",
                $ag->codagnoc,
                true
            );
            $this->dom->addChild(
                $agNoc,
                "dscAgNoc",
                isset($ag->dscagnoc) ? $ag->dscagnoc : null,
                false
            );
            if (isset($ag->tpaval)) {
                $this->dom->addChild(
                    $agNoc,
                    "tpAval",
                    isset($ag->tpaval) ? $ag->tpaval : null,
                    true
                );
            }
            $this->dom->addChild(
                $agNoc,
                "intConc",
                isset($ag->intconc) ? $ag->intconc : null,
                false
            );
            $this->dom->addChild(
                $agNoc,
                "limTol",
                isset($ag->limtol) ? $ag->limtol : null,
                false
            );
            $this->dom->addChild(
                $agNoc,
                "unMed",
                isset($ag->unmed) ? $ag->unmed : null,
                false
            );
            $this->dom->addChild(
                $agNoc,
                "tecMedicao",
                isset($ag->tecmedicao) ? $ag->tecmedicao : null,
                false
            );

            if (!empty($ag->epcepi)) {
                $epcEpi = $this->dom->createElement("epcEpi");
                $this->dom->addChild(
                    $epcEpi,
                    "utilizEPC",
                    $ag->epcepi->utilizepc,
                    true
                );
                $this->dom->addChild(
                    $epcEpi,
                    "eficEpc",
                    isset($ag->epcepi->eficepc) ? $ag->epcepi->eficepc : null,
                    false
                );
                $this->dom->addChild(
                    $epcEpi,
                    "utilizEPI",
                    $ag->epcepi->utilizepi,
                    true
                );
                $this->dom->addChild(
                    $epcEpi,
                    "eficEpi",
                    isset($ag->epcepi->eficepi) ? $ag->epcepi->eficepi : null,
                    false
                );

                if (!empty($ag->epcepi->epi)) {
                    foreach ($ag->epcepi->epi as $e) {
                        $epi = $this->dom->createElement("epi");
                        if (isset($e->docaval)) {
                            $this->dom->addChild(
                                $epi,
                                "docAval",
                                isset($e->docaval) ? $e->docaval : null,
                                false
                            );
                        } else {
                            $this->dom->addChild(
                                $epi,
                                "dscEPI",
                                isset($e->dscepi) ? $e->dscepi : null,
                                false
                            );
                        }
                        $epcEpi->appendChild($epi);
                    }
                }

                if (!empty($ag->epcepi->epicompl)) {
                    $epiCompl = $this->dom->createElement("epiCompl");
                    $this->dom->addChild(
                        $epiCompl,
                        "medProtecao",
                        $ag->epcepi->epicompl->medprotecao,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "condFuncto",
                        $ag->epcepi->epicompl->condfuncto,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "usoInint",
                        $ag->epcepi->epicompl->usoinint,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "przValid",
                        $ag->epcepi->epicompl->przvalid,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "periodicTroca",
                        $ag->epcepi->epicompl->periodictroca,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "higienizacao",
                        $ag->epcepi->epicompl->higienizacao,
                        true
                    );
                    $epcEpi->appendChild($epiCompl);
                }
                $agNoc->appendChild($epcEpi);
            }
            $info->appendChild($agNoc);
        }

        foreach ($this->std->respreg as $r) {
            $respReg = $this->dom->createElement("respReg");

            if (!empty($r->cpfresp)) {
                $this->dom->addChild(
                    $respReg,
                    "cpfResp",
                    $r->cpfresp,
                    true
                );
            }

            $this->dom->addChild(
                $respReg,
                "ideOC",
                $r->ideoc,
                true
            );
            $this->dom->addChild(
                $respReg,
                "dscOC",
                !empty($r->dscoc) ? $r->dscoc : null,
                false
            );
            $this->dom->addChild(
                $respReg,
                "nrOC",
                $r->nroc,
                true
            );
            $this->dom->addChild(
                $respReg,
                "ufOC",
                $r->ufoc,
                true
            );
            $info->appendChild($respReg);
        }

        if (!empty($this->std->obscompl)) {
            $obs = $this->dom->createElement("obs");
            $this->dom->addChild(
                $obs,
                "obsCompl",
                $this->std->obscompl,
                false
            );
            $info->appendChild($obs);
        }

        $this->node->appendChild($info);
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
        $ide = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ide,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ide,
            "matricula",
            !empty($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->dom->addChild(
            $ide,
            "codCateg",
            !empty($this->std->codcateg) ? $this->std->codcateg : null,
            false
        );
        $this->node->appendChild($ide);
        $info = $this->dom->createElement("infoExpRisco");
        $this->dom->addChild(
            $info,
            "dtIniCondicao",
            $this->std->dtinicondicao,
            true
        );
        $this->dom->addChild(
            $info,
            "dtFimCondicao",
            $this->std->dtfimcondicao ?? null,
            false
        );
        $infoamb = $this->dom->createElement("infoAmb");
        $this->dom->addChild(
            $infoamb,
            "localAmb",
            $this->std->infoamb->localamb,
            true
        );
        $this->dom->addChild(
            $infoamb,
            "dscSetor",
            $this->std->infoamb->dscsetor,
            true
        );
        $this->dom->addChild(
            $infoamb,
            "tpInsc",
            $this->std->infoamb->tpinsc,
            true
        );
        $this->dom->addChild(
            $infoamb,
            "nrInsc",
            $this->std->infoamb->nrinsc,
            true
        );
        $info->appendChild($infoamb);

        $infoAtiv = $this->dom->createElement("infoAtiv");
        $this->dom->addChild(
            $infoAtiv,
            "dscAtivDes",
            $this->std->dscativdes,
            true
        );
        $info->appendChild($infoAtiv);

        foreach ($this->std->agnoc as $ag) {
            $agNoc = $this->dom->createElement("agNoc");
            $this->dom->addChild(
                $agNoc,
                "codAgNoc",
                $ag->codagnoc,
                true
            );
            $this->dom->addChild(
                $agNoc,
                "dscAgNoc",
                isset($ag->dscagnoc) ? $ag->dscagnoc : null,
                false
            );
            if (isset($ag->tpaval)) {
                $this->dom->addChild(
                    $agNoc,
                    "tpAval",
                    isset($ag->tpaval) ? $ag->tpaval : null,
                    true
                );
            }
            $this->dom->addChild(
                $agNoc,
                "intConc",
                isset($ag->intconc) ? $ag->intconc : null,
                false
            );
            $this->dom->addChild(
                $agNoc,
                "limTol",
                isset($ag->limtol) ? $ag->limtol : null,
                false
            );
            $this->dom->addChild(
                $agNoc,
                "unMed",
                isset($ag->unmed) ? $ag->unmed : null,
                false
            );
            $this->dom->addChild(
                $agNoc,
                "tecMedicao",
                isset($ag->tecmedicao) ? $ag->tecmedicao : null,
                false
            );

            if (!empty($ag->epcepi)) {
                $epcEpi = $this->dom->createElement("epcEpi");
                $this->dom->addChild(
                    $epcEpi,
                    "utilizEPC",
                    $ag->epcepi->utilizepc,
                    true
                );
                $this->dom->addChild(
                    $epcEpi,
                    "eficEpc",
                    isset($ag->epcepi->eficepc) ? $ag->epcepi->eficepc : null,
                    false
                );
                $this->dom->addChild(
                    $epcEpi,
                    "utilizEPI",
                    $ag->epcepi->utilizepi,
                    true
                );
                $this->dom->addChild(
                    $epcEpi,
                    "eficEpi",
                    isset($ag->epcepi->eficepi) ? $ag->epcepi->eficepi : null,
                    false
                );

                if (!empty($ag->epcepi->epi)) {
                    foreach ($ag->epcepi->epi as $e) {
                        $epi = $this->dom->createElement("epi");
                        $this->dom->addChild(
                            $epi,
                            "docAval",
                            $e->docaval,
                            true
                        );
                        $epcEpi->appendChild($epi);
                    }
                }
                if (!empty($ag->epcepi->epicompl)) {
                    $epiCompl = $this->dom->createElement("epiCompl");
                    $this->dom->addChild(
                        $epiCompl,
                        "medProtecao",
                        $ag->epcepi->epicompl->medprotecao,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "condFuncto",
                        $ag->epcepi->epicompl->condfuncto,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "usoInint",
                        $ag->epcepi->epicompl->usoinint,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "przValid",
                        $ag->epcepi->epicompl->przvalid,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "periodicTroca",
                        $ag->epcepi->epicompl->periodictroca,
                        true
                    );
                    $this->dom->addChild(
                        $epiCompl,
                        "higienizacao",
                        $ag->epcepi->epicompl->higienizacao,
                        true
                    );
                    $epcEpi->appendChild($epiCompl);
                }
                $agNoc->appendChild($epcEpi);
            }
            $info->appendChild($agNoc);
        }

        foreach ($this->std->respreg as $r) {
            $respReg = $this->dom->createElement("respReg");

            if (!empty($r->cpfresp)) {
                $this->dom->addChild(
                    $respReg,
                    "cpfResp",
                    $r->cpfresp,
                    true
                );
            }

            $this->dom->addChild(
                $respReg,
                "ideOC",
                $r->ideoc,
                true
            );
            $this->dom->addChild(
                $respReg,
                "dscOC",
                !empty($r->dscoc) ? $r->dscoc : null,
                false
            );
            $this->dom->addChild(
                $respReg,
                "nrOC",
                $r->nroc,
                true
            );
            $this->dom->addChild(
                $respReg,
                "ufOC",
                $r->ufoc,
                true
            );
            $info->appendChild($respReg);
        }

        if (!empty($this->std->obscompl)) {
            $obs = $this->dom->createElement("obs");
            $this->dom->addChild(
                $obs,
                "obsCompl",
                $this->std->obscompl,
                false
            );
            $info->appendChild($obs);
        }

        $this->node->appendChild($info);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
