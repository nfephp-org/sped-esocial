<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2240
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
        $ide = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ide,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ide,
            "nisTrab",
            !empty($this->std->nistrab) ? $this->std->nistrab : null,
            false
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
            $this->std->dtcondicao,
            true
        );

        foreach ($this->std->infoamb as $amb) {
            $infoamb = $this->dom->createElement("infoAmb");
            $this->dom->addChild(
                $infoamb,
                "codAmb",
                $amb->codamb,
                true
            );
            $info->appendChild($infoamb);
        }

        $infoAtiv = $this->dom->createElement("infoAtiv");
        $this->dom->addChild(
            $infoAtiv,
            "dscAtivDes",
            $this->std->infoativ->dscativdes,
            true
        );
        foreach ($this->std->infoativ->ativpericinsal as $p) {
            $ativPericInsal = $this->dom->createElement("ativPericInsal");
            $this->dom->addChild(
                $ativPericInsal,
                "codAtiv",
                $p->codativ,
                true
            );
            $infoAtiv->appendChild($ativPericInsal);
        }
        $info->appendChild($infoAtiv);

        foreach ($this->std->fatrisco as $f) {
            $fatRisco = $this->dom->createElement("fatRisco");
            $this->dom->addChild(
                $fatRisco,
                "codFatRis",
                $f->codfatris,
                true
            );
            $this->dom->addChild(
                $fatRisco,
                "dscFatRisc",
                isset($f->dscfatrisc) ? $f->dscfatrisc : null,
                false
            );
            $this->dom->addChild(
                $fatRisco,
                "tpAval",
                $f->tpaval,
                true
            );
            $this->dom->addChild(
                $fatRisco,
                "intConc",
                isset($f->intconc) ? $f->intconc : null,
                false
            );
            $this->dom->addChild(
                $fatRisco,
                "limTol",
                isset($f->limtol) ? $f->limtol : null,
                false
            );
            $this->dom->addChild(
                $fatRisco,
                "unMed",
                isset($f->unmed) ? $f->unmed : null,
                false
            );
            $this->dom->addChild(
                $fatRisco,
                "tecMedicao",
                isset($f->tecmedicao) ? $f->tecmedicao : null,
                false
            );
            $this->dom->addChild(
                $fatRisco,
                "insalubridade",
                isset($f->insalubridade) ? $f->insalubridade : null,
                false
            );
            $this->dom->addChild(
                $fatRisco,
                "periculosidade",
                isset($f->periculosidade) ? $f->periculosidade : null,
                false
            );
            $this->dom->addChild(
                $fatRisco,
                "aposentEsp",
                isset($f->aposentesp) ? $f->aposentesp : null,
                false
            );

            $epcEpi = $this->dom->createElement("epcEpi");
            $this->dom->addChild(
                $epcEpi,
                "utilizEPC",
                $f->epcepi->utilizepc,
                true
            );
            $this->dom->addChild(
                $epcEpi,
                "eficEpc",
                isset($f->epcepi->eficepc) ? $f->epcepi->eficepc : null,
                false
            );
            $this->dom->addChild(
                $epcEpi,
                "utilizEPI",
                $f->epcepi->utilizepi,
                true
            );

            if (!empty($f->epcepi->epi)) {
                foreach ($f->epcepi->epi as $e) {
                    $epi = $this->dom->createElement("epi");
                    $this->dom->addChild(
                        $epi,
                        "caEPI",
                        isset($e->caepi) ? $e->caepi : null,
                        false
                    );
                    $this->dom->addChild(
                        $epi,
                        "dscEPI",
                        isset($e->dscepi) ? $e->dscepi : null,
                        false
                    );
                    $this->dom->addChild(
                        $epi,
                        "eficEpi",
                        $e->eficepi,
                        true
                    );
                    $this->dom->addChild(
                        $epi,
                        "medProtecao",
                        $e->medprotecao,
                        true
                    );
                    $this->dom->addChild(
                        $epi,
                        "condFuncto",
                        $e->condfuncto,
                        true
                    );
                    $this->dom->addChild(
                        $epi,
                        "usoInint",
                        $e->usoinint,
                        true
                    );
                    $this->dom->addChild(
                        $epi,
                        "przValid",
                        $e->przvalid,
                        true
                    );
                    $this->dom->addChild(
                        $epi,
                        "periodicTroca",
                        $e->periodictroca,
                        true
                    );
                    $this->dom->addChild(
                        $epi,
                        "higienizacao",
                        $e->higienizacao,
                        true
                    );
                    $epcEpi->appendChild($epi);
                }
            }
            $fatRisco->appendChild($epcEpi);
            $info->appendChild($fatRisco);
        }

        foreach ($this->std->respreg as $r) {
            $respReg = $this->dom->createElement("respReg");
            $this->dom->addChild(
                $respReg,
                "cpfResp",
                $r->cpfresp,
                true
            );
            $this->dom->addChild(
                $respReg,
                "nisResp",
                $r->nisresp,
                true
            );
            $this->dom->addChild(
                $respReg,
                "nmResp",
                $r->nmresp,
                true
            );
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

        if (!empty($this->std->obs)) {
            $o = $this->std->obs;
            $obs = $this->dom->createElement("obs");
            $this->dom->addChild(
                $obs,
                "metErg",
                !empty($o->meterg) ? $o->meterg : null,
                false
            );
            $this->dom->addChild(
                $obs,
                "obsCompl",
                !empty($o->obscompl) ? $o->obscompl : null,
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
            $this->dom->addChild(
                $respReg,
                "cpfResp",
                $r->cpfresp,
                true
            );
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
