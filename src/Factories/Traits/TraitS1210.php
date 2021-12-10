<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1210
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
        if (!empty($this->std->deps->vrdeddep)) {
            $deps = $this->dom->createElement("deps");
            $this->dom->addChild(
                $deps,
                "vrDedDep",
                $this->std->deps->vrdeddep,
                true
            );
            $ideBenef->appendChild($deps);
        }
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
                "indResBr",
                $pgto->indresbr,
                true
            );
            if (!empty($pgto->detpgtofl)) {
                foreach ($pgto->detpgtofl as $pgtofl) {
                    $detPgtoFl = $this->dom->createElement("detPgtoFl");
                    $this->dom->addChild(
                        $detPgtoFl,
                        "perRef",
                        !empty($pgtofl->perref) ? $pgtofl->perref : null,
                        false
                    );
                    $this->dom->addChild(
                        $detPgtoFl,
                        "ideDmDev",
                        $pgtofl->idedmdev,
                        true
                    );
                    $this->dom->addChild(
                        $detPgtoFl,
                        "indPgtoTt",
                        $pgtofl->indpgtott,
                        true
                    );
                    $this->dom->addChild(
                        $detPgtoFl,
                        "vrLiq",
                        $pgtofl->vrliq,
                        true
                    );
                    $this->dom->addChild(
                        $detPgtoFl,
                        "nrRecArq",
                        !empty($pgtofl->nrrecarq) ? $pgtofl->nrrecarq : null,
                        false
                    );
                    if (!empty($pgtofl->retpgtotot)) {
                        foreach ($pgtofl->retpgtotot as $pg) {
                            $retPgtoTot = $this->dom->createElement("retPgtoTot");
                            $this->dom->addChild(
                                $retPgtoTot,
                                "codRubr",
                                $pg->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $retPgtoTot,
                                "ideTabRubr",
                                $pg->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $retPgtoTot,
                                "qtdRubr",
                                !empty($pg->qtdrubr) ? $pg->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $retPgtoTot,
                                "fatorRubr",
                                !empty($pg->fatorrubr) ? $pg->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $retPgtoTot,
                                "vrUnit",
                                !empty($pg->vrunit) ? $pg->vrunit : null,
                                false
                            );
                            $this->dom->addChild(
                                $retPgtoTot,
                                "vrRubr",
                                $pg->vrrubr,
                                true
                            );
                            if (!empty($pg->penalim)) {
                                foreach ($pg->penalim as $pa) {
                                    $penAlim = $this->dom->createElement("penAlim");
                                    $this->dom->addChild(
                                        $penAlim,
                                        "cpfBenef",
                                        $pa->cpfbenef,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $penAlim,
                                        "dtNasctoBenef",
                                        !empty($pa->dtnasctobenef) ? $pa->dtnasctobenef : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $penAlim,
                                        "nmBenefic",
                                        $pa->nmbenefic,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $penAlim,
                                        "vlrPensao",
                                        $pa->vlrpensao,
                                        true
                                    );
                                    $retPgtoTot->appendChild($penAlim);
                                    $penAlim = null;
                                }
                            }
                            $detPgtoFl->appendChild($retPgtoTot);
                            $retPgtoTot = null;
                        }
                    }
                    if (!empty($pgtofl->infopgtoparc)) {
                        foreach ($pgtofl->infopgtoparc as $pp) {
                            $infoPgtoParc = $this->dom->createElement("infoPgtoParc");
                            $this->dom->addChild(
                                $infoPgtoParc,
                                "matricula",
                                !empty($pp->matricula) ? $pp->matricula : null,
                                false
                            );

                            $this->dom->addChild(
                                $infoPgtoParc,
                                "codRubr",
                                $pp->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $infoPgtoParc,
                                "ideTabRubr",
                                $pp->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $infoPgtoParc,
                                "qtdRubr",
                                !empty($pp->qtdrubr) ? $pp->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $infoPgtoParc,
                                "fatorRubr",
                                !empty($pp->fatorrubr) ? $pp->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $infoPgtoParc,
                                "vrUnit",
                                !empty($pp->vrunit) ? $pp->vrunit : null,
                                false
                            );
                            $this->dom->addChild(
                                $infoPgtoParc,
                                "vrRubr",
                                $pp->vrrubr,
                                true
                            );
                            $detPgtoFl->appendChild($infoPgtoParc);
                            $infoPgtoParc = null;
                        }
                    }
                    $infoPgto->appendChild($detPgtoFl);
                    $detPgtoFl = null;
                }
            }
            if (!empty($pgto->detpgtobenpr)) {
                $detPgtoBenPr = $this->dom->createElement("detPgtoBenPr");
                $this->dom->addChild(
                    $detPgtoBenPr,
                    "perRef",
                    $pgto->detpgtobenpr->perref,
                    true
                );
                $this->dom->addChild(
                    $detPgtoBenPr,
                    "ideDmDev",
                    $pgto->detpgtobenpr->idedmdev,
                    true
                );
                $this->dom->addChild(
                    $detPgtoBenPr,
                    "indPgtoTt",
                    $pgto->detpgtobenpr->indpgtott,
                    true
                );
                $this->dom->addChild(
                    $detPgtoBenPr,
                    "vrLiq",
                    $pgto->detpgtobenpr->vrliq,
                    true
                );
                if (!empty($pgto->detpgtobenpr->retpgtotot)) {
                    foreach ($pgto->detpgtobenpr->retpgtotot as $rpt) {
                        $retPgtoTot = $this->dom->createElement("retPgtoTot");
                        $this->dom->addChild(
                            $retPgtoTot,
                            "codRubr",
                            $rpt->codrubr,
                            true
                        );
                        $this->dom->addChild(
                            $retPgtoTot,
                            "ideTabRubr",
                            $rpt->idetabrubr,
                            true
                        );
                        $this->dom->addChild(
                            $retPgtoTot,
                            "qtdRubr",
                            !empty($rpt->qtdrubr) ? $rpt->qtdrubr : null,
                            false
                        );
                        $this->dom->addChild(
                            $retPgtoTot,
                            "fatorRubr",
                            !empty($rpt->fatorrubr) ? $rpt->fatorrubr : null,
                            false
                        );
                        $this->dom->addChild(
                            $retPgtoTot,
                            "vrUnit",
                            !empty($rpt->vrunit) ? $rpt->vrunit : null,
                            false
                        );
                        $this->dom->addChild(
                            $retPgtoTot,
                            "vrRubr",
                            $rpt->vrrubr,
                            true
                        );
                        $detPgtoBenPr->appendChild($retPgtoTot);
                        $retPgtoTot = null;
                    }
                }
                if (!empty($pgto->detpgtobenpr->infopgtoparc)) {
                    foreach ($pgto->detpgtobenpr->infopgtoparc as $rpt) {
                        $infoPgtoParc = $this->dom->createElement("infoPgtoParc");
                        $this->dom->addChild(
                            $infoPgtoParc,
                            "codRubr",
                            $rpt->codrubr,
                            true
                        );
                        $this->dom->addChild(
                            $infoPgtoParc,
                            "ideTabRubr",
                            $rpt->idetabrubr,
                            true
                        );
                        $this->dom->addChild(
                            $infoPgtoParc,
                            "qtdRubr",
                            !empty($rpt->qtdrubr) ? $rpt->qtdrubr : null,
                            false
                        );
                        $this->dom->addChild(
                            $infoPgtoParc,
                            "fatorRubr",
                            !empty($rpt->fatorrubr) ? $rpt->fatorrubr : null,
                            false
                        );
                        $this->dom->addChild(
                            $infoPgtoParc,
                            "vrUnit",
                            !empty($rpt->vrunit) ? $rpt->vrunit : null,
                            false
                        );
                        $this->dom->addChild(
                            $infoPgtoParc,
                            "vrRubr",
                            $rpt->vrrubr,
                            true
                        );
                        $detPgtoBenPr->appendChild($infoPgtoParc);
                        $infoPgtoParc = null;
                    }
                }
                $infoPgto->appendChild($detPgtoBenPr);
                $detPgtoBenPr = null;
            }
            if (!empty($pgto->detpgtofer)) {
                foreach ($pgto->detpgtofer as $rpt) {
                    $detPgtoFer = $this->dom->createElement("detPgtoFer");
                    $this->dom->addChild(
                        $detPgtoFer,
                        "codCateg",
                        $rpt->codcateg,
                        true
                    );
                    $this->dom->addChild(
                        $detPgtoFer,
                        "matricula",
                        !empty($rpt->matricula) ? $rpt->matricula : null,
                        false
                    );
                    $this->dom->addChild(
                        $detPgtoFer,
                        "dtIniGoz",
                        $rpt->dtinigoz,
                        true
                    );
                    $this->dom->addChild(
                        $detPgtoFer,
                        "qtDias",
                        $rpt->qtdias,
                        true
                    );
                    $this->dom->addChild(
                        $detPgtoFer,
                        "vrLiq",
                        $rpt->vrliq,
                        true
                    );
                    if (!empty($rpt->detrubrfer)) {
                        foreach ($rpt->detrubrfer as $dpt) {
                            $detRubrFer = $this->dom->createElement("detRubrFer");
                            $this->dom->addChild(
                                $detRubrFer,
                                "codRubr",
                                $dpt->codrubr,
                                true
                            );
                            $this->dom->addChild(
                                $detRubrFer,
                                "ideTabRubr",
                                $dpt->idetabrubr,
                                true
                            );
                            $this->dom->addChild(
                                $detRubrFer,
                                "qtdRubr",
                                !empty($dpt->qtdrubr) ? $dpt->qtdrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $detRubrFer,
                                "fatorRubr",
                                !empty($dpt->fatorrubr) ? $dpt->fatorrubr : null,
                                false
                            );
                            $this->dom->addChild(
                                $detRubrFer,
                                "vrUnit",
                                !empty($dpt->vrunit) ? $dpt->vrunit : null,
                                false
                            );
                            $this->dom->addChild(
                                $detRubrFer,
                                "vrRubr",
                                $dpt->vrrubr,
                                true
                            );
                            if (!empty($dpt->penalim)) {
                                foreach ($dpt->penalim as $xf) {
                                    $penAlim = $this->dom->createElement("penAlim");
                                    $this->dom->addChild(
                                        $penAlim,
                                        "cpfBenef",
                                        $xf->cpfbenef,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $penAlim,
                                        "dtNasctoBenef",
                                        !empty($xf->dtnasctobenef) ? $xf->dtnasctobenef : null,
                                        false
                                    );
                                    $this->dom->addChild(
                                        $penAlim,
                                        "nmBenefic",
                                        $xf->nmbenefic,
                                        true
                                    );
                                    $this->dom->addChild(
                                        $penAlim,
                                        "vlrPensao",
                                        $xf->vlrpensao,
                                        true
                                    );
                                    $detRubrFer->appendChild($penAlim);
                                    $penAlim = null;
                                }
                            }
                            $detPgtoFer->appendChild($detRubrFer);
                            $detRubrFer = null;
                        }
                    }
                    $infoPgto->appendChild($detPgtoFer);
                    $detPgtoFer = null;
                }
            }
            if (!empty($pgto->detpgtoant)) {
                foreach ($pgto->detpgtoant as $pgant) {
                    $detPgtoAnt = $this->dom->createElement("detPgtoAnt");
                    $this->dom->addChild(
                        $detPgtoAnt,
                        "codCateg",
                        $pgant->codcateg,
                        true
                    );
                    foreach ($pgant->infopgtoant as $ipa) {
                        $infoPgtoAnt = $this->dom->createElement("infoPgtoAnt");
                        $this->dom->addChild(
                            $infoPgtoAnt,
                            "tpBcIRRF",
                            $ipa->tpbcirrf,
                            true
                        );
                        $this->dom->addChild(
                            $infoPgtoAnt,
                            "vrBcIRRF",
                            $ipa->vrbcirrf,
                            true
                        );
                        $detPgtoAnt->appendChild($infoPgtoAnt);
                        $infoPgtoAnt = null;
                    }
                    $infoPgto->appendChild($detPgtoAnt);
                    $detPgtoAnt = null;
                }
            }
            if (!empty($pgto->idepgtoext)) {
                $idePgtoExt = $this->dom->createElement("idePgtoExt");
                $idePais = $this->dom->createElement("idePais");
                $this->dom->addChild(
                    $idePais,
                    "codPais",
                    $pgto->idepgtoext->codpais,
                    true
                );
                $this->dom->addChild(
                    $idePais,
                    "indNIF",
                    $pgto->idepgtoext->indnif,
                    true
                );
                $this->dom->addChild(
                    $idePais,
                    "nifBenef",
                    !empty($pgto->idepgtoext->nifbenef) ? $pgto->idepgtoext->nifbenef : null,
                    false
                );
                $endExt = $this->dom->createElement("endExt");
                $this->dom->addChild(
                    $endExt,
                    "dscLograd",
                    $pgto->idepgtoext->endext->dsclograd,
                    true
                );
                $this->dom->addChild(
                    $endExt,
                    "nrLograd",
                    !empty($pgto->idepgtoext->endext->nrlograd) ? $pgto->idepgtoext->endext->nrlograd : null,
                    false
                );
                $this->dom->addChild(
                    $endExt,
                    "complem",
                    !empty($pgto->idepgtoext->endext->complem) ? $pgto->idepgtoext->endext->complem : null,
                    false
                );
                $this->dom->addChild(
                    $endExt,
                    "bairro",
                    !empty($pgto->idepgtoext->endext->bairro) ? $pgto->idepgtoext->endext->bairro : null,
                    false
                );
                $this->dom->addChild(
                    $endExt,
                    "nmCid",
                    $pgto->idepgtoext->endext->nmcid,
                    true
                );
                $this->dom->addChild(
                    $endExt,
                    "codPostal",
                    !empty($pgto->idepgtoext->endext->codoostal) ? $pgto->idepgtoext->endext->codoostal : null,
                    false
                );
                $idePgtoExt->appendChild($idePais);
                $idePgtoExt->appendChild($endExt);
                $infoPgto->appendChild($idePgtoExt);
            }
            $ideBenef->appendChild($infoPgto);
            $infoPgto = null;
        }

        $this->node->appendChild($ideBenef);
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
}
