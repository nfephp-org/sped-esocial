<?php

namespace NFePHP\eSocial\Factories\Traits;

use NFePHP\eSocial\Common\FactoryId;

trait TraitS1260
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );

        $evtComProd = $this->dom->createElement("evtComProd");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtComProd->appendChild($att);

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

        $tpComerc = $this->dom->createElement("tpComerc");

        $this->dom->addChild(
            $tpComerc,
            "indComerc",
            $this->std->estabelecimento->indcomerc,
            true
        );

        $this->dom->addChild(
            $tpComerc,
            "vrTotCom",
            $this->std->estabelecimento->vrtotcom,
            true
        );

        if (isset($this->std->estabelecimento->ideadquir)) {
            foreach ($this->std->estabelecimento->ideadquir as $adquir) {
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

        if (isset($this->std->infoprocjud)) {
            foreach ($this->std->infoprocjud as $procjud) {
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

        $infoComProd->appendChild($ideEstabel);

        $this->node->appendChild($infoComProd);


        $this->eSocial->appendChild($this->node);
        $this->sign();
    }

    
    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("TODO !!");
    }
}
