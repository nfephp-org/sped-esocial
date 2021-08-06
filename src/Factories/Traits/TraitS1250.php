<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1250
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

        $evtAqProd = $this->dom->createElement("evtAqProd");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtAqProd->appendChild($att);

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
            ! empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
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

        $infoAquisProd  = $this->dom->createElement("infoAquisProd");
        $ideEstabAdquir = $this->dom->createElement("ideEstabAdquir");

        $this->dom->addChild(
            $ideEstabAdquir,
            "tpInscAdq",
            $this->std->ideestabadquir->tpinscadq,
            true
        );

        $this->dom->addChild(
            $ideEstabAdquir,
            "nrInscAdq",
            $this->std->ideestabadquir->nrinscadq,
            true
        );

        if (isset($this->std->ideestabadquir->tpaquis)) {
            foreach ($this->std->ideestabadquir->tpaquis as $tp) {
                $tpAquis = $this->dom->createElement("tpAquis");

                $this->dom->addChild(
                    $tpAquis,
                    "indAquis",
                    $tp->indaquis,
                    true
                );

                $this->dom->addChild(
                    $tpAquis,
                    "vlrTotAquis",
                    $tp->vlrtotaquis,
                    true
                );

                foreach ($tp->ideprodutor as $ideprod) {
                    $ideProdutor = $this->dom->createElement("ideProdutor");

                    $this->dom->addChild(
                        $ideProdutor,
                        "tpInscProd",
                        $ideprod->tpinscprod,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "nrInscProd",
                        $ideprod->nrinscprod,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "vlrBruto",
                        $ideprod->vlrbruto,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "vrCPDescPR",
                        $ideprod->vrcpdescpr,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "vrRatDescPR",
                        $ideprod->vrratdescpr,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "vrSenarDesc",
                        $ideprod->vrsenardesc,
                        true
                    );

                    foreach ($ideprod->nfs as $prodnfs) {
                        $nfs = $this->dom->createElement("nfs");

                        $this->dom->addChild(
                            $nfs,
                            "serie",
                            ! empty($prodnfs->serie) ? $prodnfs->serie : null,
                            false
                        );

                        $this->dom->addChild(
                            $nfs,
                            "nrDocto",
                            $prodnfs->nrdocto,
                            true
                        );

                        $this->dom->addChild(
                            $nfs,
                            "dtEmisNF",
                            $prodnfs->dtemisnf,
                            true
                        );

                        $this->dom->addChild(
                            $nfs,
                            "vlrBruto",
                            $prodnfs->vlrbruto,
                            true
                        );

                        $this->dom->addChild(
                            $nfs,
                            "vrCPDescPR",
                            $prodnfs->vrcpdescpr,
                            true
                        );

                        $this->dom->addChild(
                            $nfs,
                            "vrRatDescPR",
                            $prodnfs->vrratdescpr,
                            true
                        );

                        $this->dom->addChild(
                            $nfs,
                            "vrSenarDesc",
                            $prodnfs->vrsenardesc,
                            true
                        );

                        $ideProdutor->appendChild($nfs);
                    }

                    foreach ($ideprod->infoprocjud as $prodprocjud) {
                        $infoProcJud = $this->dom->createElement("infoProcJud");

                        $this->dom->addChild(
                            $infoProcJud,
                            "nrProcJud",
                            $prodprocjud->nrprocjud,
                            true
                        );

                        $this->dom->addChild(
                            $infoProcJud,
                            "codSusp",
                            $prodprocjud->codsusp,
                            true
                        );

                        $this->dom->addChild(
                            $infoProcJud,
                            "vrCPNRet",
                            $prodprocjud->vrcpnret,
                            true
                        );

                        $this->dom->addChild(
                            $infoProcJud,
                            "vrRatNRet",
                            $prodprocjud->vrratnret,
                            true
                        );

                        $this->dom->addChild(
                            $infoProcJud,
                            "vrSenarNRet",
                            $prodprocjud->vrsenarnret,
                            true
                        );

                        $ideProdutor->appendChild($infoProcJud);
                    }

                    $tpAquis->appendChild($ideProdutor);
                }

                $ideEstabAdquir->appendChild($tpAquis);
            }
        }

        $infoAquisProd->appendChild($ideEstabAdquir);
        $this->node->appendChild($infoAquisProd);

        $this->eSocial->appendChild($this->node);
        $this->sign();
    }

    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S_1.0 !!");
    }
}
