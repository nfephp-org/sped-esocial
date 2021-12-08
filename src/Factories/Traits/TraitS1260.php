<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1260
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
            $this->std->nrrecibo,
            true
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
        $infoComProd = $this->dom->createElement("infoComProd");
        $ideEstabel = $this->dom->createElement("ideEstabel");
        $this->dom->addChild(
            $ideEstabel,
            "nrInscEstabRural",
            $this->std->estabelecimento->nrinscestabrural,
            true
        );
        foreach ($this->std->estabelecimento->tpcomerc as $tpcom) {
            $tpComerc = $this->dom->createElement("tpComerc");
            $this->dom->addChild(
                $tpComerc,
                "indComerc",
                $tpcom->indcomerc,
                true
            );
            $this->dom->addChild(
                $tpComerc,
                "vrTotCom",
                $tpcom->vrtotcom,
                true
            );
            if (isset($tpcom->ideadquir)) {
                foreach ($tpcom->ideadquir as $adquir) {
                    $ideAdquir = $this->dom->createElement("ideAdquir");
                    $this->dom->addChild(
                        $ideAdquir,
                        "tpInsc",
                        $adquir->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideAdquir,
                        "nrInsc",
                        $adquir->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideAdquir,
                        "vrComerc",
                        $adquir->vrcomerc,
                        true
                    );
                    if (isset($adquir->nfs)) {
                        foreach ($adquir->nfs as $nf) {
                            $nfs = $this->dom->createElement("nfs");
                            $this->dom->addChild(
                                $nfs,
                                "serie",
                                !empty($nf->serie) ? $nf->serie : null,
                                false
                            );
                            $this->dom->addChild(
                                $nfs,
                                "nrDocto",
                                $nf->nrdocto,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "dtEmisNF",
                                $nf->dtemisnf,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "vlrBruto",
                                $nf->vlrbruto,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "vrCPDescPR",
                                $nf->vrcpdescpr,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "vrRatDescPR",
                                $nf->vrratdescpr,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "vrSenarDesc",
                                $nf->vrsenardesc,
                                true
                            );
                            $ideAdquir->appendChild($nfs);
                        }
                    }
                    $tpComerc->appendChild($ideAdquir);
                }
            }

            if (isset($tpcom->infoprocjud)) {
                foreach ($tpcom->infoprocjud as $procjud) {
                    $infoProcJud = $this->dom->createElement("infoProcJud");
                    $this->dom->addChild(
                        $infoProcJud,
                        "tpProc",
                        $procjud->tpproc,
                        true
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "nrProc",
                        $procjud->nrproc,
                        true
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "codSusp",
                        $procjud->codsusp,
                        true
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "vrCPSusp",
                        !empty($procjud->vrcpsusp) ? $procjud->vrcpsusp : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "vrRatSusp",
                        !empty($procjud->vrratsusp) ? $procjud->vrratsusp : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "vrSenarSusp",
                        !empty($procjud->vrsenarsusp) ? $procjud->vrsenarsusp : null,
                        false
                    );
                    $tpComerc->appendChild($infoProcJud);
                }
            }
            $ideEstabel->appendChild($tpComerc);
        }
        $infoComProd->appendChild($ideEstabel);
        $this->node->appendChild($infoComProd);
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
            !empty($this->std->nrrecibo) && ($this->std->indretif == 2) ? $this->std->nrrecibo : null,
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
            $this->std->indguia,
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
        $infoComProd = $this->dom->createElement("infoComProd");
        $ideEstabel = $this->dom->createElement("ideEstabel");
        $this->dom->addChild(
            $ideEstabel,
            "nrInscEstabRural",
            $this->std->estabelecimento->nrinscestabrural,
            true
        );
        foreach ($this->std->estabelecimento->tpcomerc as $tpcom) {
            $tpComerc = $this->dom->createElement("tpComerc");
            $this->dom->addChild(
                $tpComerc,
                "indComerc",
                $tpcom->indcomerc,
                true
            );
            $this->dom->addChild(
                $tpComerc,
                "vrTotCom",
                $tpcom->vrtotcom,
                true
            );
            if (isset($tpcom->ideadquir)) {
                foreach ($tpcom->ideadquir as $adquir) {
                    $ideAdquir = $this->dom->createElement("ideAdquir");
                    $this->dom->addChild(
                        $ideAdquir,
                        "tpInsc",
                        $adquir->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideAdquir,
                        "nrInsc",
                        $adquir->nrinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideAdquir,
                        "vrComerc",
                        $adquir->vrcomerc,
                        true
                    );
                    if (isset($adquir->nfs)) {
                        foreach ($adquir->nfs as $nf) {
                            $nfs = $this->dom->createElement("nfs");
                            $this->dom->addChild(
                                $nfs,
                                "serie",
                                !empty($nf->serie) ? $nf->serie : null,
                                false
                            );
                            $this->dom->addChild(
                                $nfs,
                                "nrDocto",
                                $nf->nrdocto,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "dtEmisNF",
                                $nf->dtemisnf,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "vlrBruto",
                                $nf->vlrbruto,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "vrCPDescPR",
                                $nf->vrcpdescpr,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "vrRatDescPR",
                                $nf->vrratdescpr,
                                true
                            );
                            $this->dom->addChild(
                                $nfs,
                                "vrSenarDesc",
                                $nf->vrsenardesc,
                                true
                            );
                            $ideAdquir->appendChild($nfs);
                        }
                    }
                    $tpComerc->appendChild($ideAdquir);
                }
            }

            if (isset($tpcom->infoprocjud)) {
                foreach ($tpcom->infoprocjud as $procjud) {
                    $infoProcJud = $this->dom->createElement("infoProcJud");
                    $this->dom->addChild(
                        $infoProcJud,
                        "tpProc",
                        $procjud->tpproc,
                        true
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "nrProc",
                        $procjud->nrproc,
                        true
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "codSusp",
                        $procjud->codsusp,
                        true
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "vrCPSusp",
                        !empty($procjud->vrcpsusp) ? $procjud->vrcpsusp : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "vrRatSusp",
                        !empty($procjud->vrratsusp) ? $procjud->vrratsusp : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoProcJud,
                        "vrSenarSusp",
                        !empty($procjud->vrsenarsusp) ? $procjud->vrsenarsusp : null,
                        false
                    );
                    $tpComerc->appendChild($infoProcJud);
                }
            }
            $ideEstabel->appendChild($tpComerc);
        }
        $infoComProd->appendChild($ideEstabel);
        $this->node->appendChild($infoComProd);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
