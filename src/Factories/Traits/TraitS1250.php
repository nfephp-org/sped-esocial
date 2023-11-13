<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1250
{
    /**
     * Estrutura do tpAquin v2.4.2
     * @param DOMElement $ideEstabAdquir
     * @param stdClass $tpaquis
     */
    protected function tpAquis(&$ideEstabAdquir, $tpaquis)
    {
        foreach ($tpaquis as $tp) {
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
                if (isset($ideprod->nfs)) {
                    foreach ($ideprod->nfs as $prodnfs) {
                        $nfs = $this->dom->createElement("nfs");
                        $this->dom->addChild(
                            $nfs,
                            "serie",
                            !empty($prodnfs->serie) ? $prodnfs->serie : null,
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
                }
                if (isset($ideprod->infoprocjud)) {
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
                }
                $tpAquis->appendChild($ideProdutor);
            }
            $ideEstabAdquir->appendChild($tpAquis);
        }
    }

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
        return $this->toNodeS100();
    }

    /**
     * Grandes altereções de estrutura na tag tpAquis
     * @param DOMElement $ideEstabAdquir
     * @param stdClass $tpaquis
     */
    protected function tpAquisV020500(&$ideEstabAdquir, $tpaquis)
    {
        foreach ($tpaquis as $tp) {
            $tpAquis = $this->dom->createElement("tpAquis");
            $tpAquis->setAttribute('indAquis', $tp->indaquis);
            $tpAquis->setAttribute(
                'vlrTotAquis',
                number_format($tp->vlrtotaquis, 2, '.', '')
            );
            foreach ($tp->ideprodutor as $ideprod) {
                $ideProdutor = $this->dom->createElement("ideProdutor");
                $ideProdutor->setAttribute('tpInscProd', $ideprod->tpinscprod);
                $ideProdutor->setAttribute('nrInscProd', $ideprod->nrinscprod);
                $ideProdutor->setAttribute(
                    'vlrBruto',
                    number_format($ideprod->vlrbruto, 2, '.', '')
                );
                $ideProdutor->setAttribute(
                    'vrCPDescPR',
                    number_format($ideprod->vrcpdescpr, 2, '.', '')
                );
                $ideProdutor->setAttribute(
                    'vrRatDescPR',
                    number_format($ideprod->vrratdescpr, 2, '.', '')
                );
                $ideProdutor->setAttribute(
                    'vrSenarDesc',
                    number_format($ideprod->vrsenardesc, 2, '.', '')
                );
                $ideProdutor->setAttribute('indOpcCP', $ideprod->indopccp);

                if (isset($ideprod->nfs)) {
                    foreach ($ideprod->nfs as $prodnfs) {
                        $nfs = $this->dom->createElement("nfs");
                        !empty($prodnfs->serie) ? $nfs->setAttribute('serie', $prodnfs->serie) : null;
                        $nfs->setAttribute('nrDocto', $prodnfs->nrdocto);
                        $nfs->setAttribute('dtEmisNF', $prodnfs->dtemisnf);
                        $nfs->setAttribute(
                            'vlrBruto',
                            number_format($prodnfs->vlrbruto, 2, '.', '')
                        );
                        $nfs->setAttribute(
                            'vrCPDescPR',
                            number_format($prodnfs->vrcpdescpr, 2, '.', '')
                        );
                        $nfs->setAttribute(
                            'vrRatDescPR',
                            number_format($prodnfs->vrratdescpr, 2, '.', '')
                        );
                        $nfs->setAttribute(
                            'vrSenarDesc',
                            number_format($prodnfs->vrsenardesc, 2, '.', '')
                        );
                        $ideProdutor->appendChild($nfs);
                    }
                }
                if (isset($ideprod->infoprocjud)) {
                    foreach ($ideprod->infoprocjud as $prodprocjud) {
                        $infoProcJud = $this->dom->createElement("infoProcJud");
                        $infoProcJud->setAttribute('nrProcJud', $prodprocjud->nrprocjud);
                        $infoProcJud->setAttribute('codSusp', $prodprocjud->codsusp);
                        $infoProcJud->setAttribute(
                            'vrCPNRet',
                            number_format($prodprocjud->vrcpnret, 2, '.', '')
                        );
                        $infoProcJud->setAttribute(
                            'vrRatNRet',
                            number_format($prodprocjud->vrratnret, 2, '.', '')
                        );
                        $infoProcJud->setAttribute(
                            'vrSenarNRet',
                            number_format($prodprocjud->vrsenarnret, 2, '.', '')
                        );
                        $ideProdutor->appendChild($infoProcJud);
                    }
                }
                $tpAquis->appendChild($ideProdutor);
                if (!empty($tp->infoprocj)) {
                    foreach ($tp->infoprocj as $procjud) {
                        $procJ = $this->dom->createElement("infoProcJ");
                        $procJ->setAttribute('nrProcJud', $procjud->nrprocjud);
                        $procJ->setAttribute('codSusp', $procjud->codsusp);
                        $procJ->setAttribute(
                            'vrCPNRet',
                            number_format($procjud->vrcpnret, 2, '.', '')
                        );
                        $procJ->setAttribute(
                            'vrRatNRet',
                            number_format($procjud->vrratnret, 2, '.', '')
                        );
                        $procJ->setAttribute(
                            'vrSenarNRet',
                            number_format($procjud->vrsenarnret, 2, '.', '')
                        );
                        $tpAquis->appendChild($procJ);
                    }
                }
            }
            $ideEstabAdquir->appendChild($tpAquis);
        }
    }

    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S_1.0 !!");
    }
}
