<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS5001
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
            "nrRecArqBase",
            ! empty($this->std->nrrecarqbase) ? $this->std->nrrecarqbase : null,
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
        $this->node->insertBefore($ideEvento, $ideEmpregador);

        $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ideTrabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        if (isset($this->std->procjudtrab)) {
            foreach ($this->std->procjudtrab as $proc) {
                $procJudTrab = $this->dom->createElement("procJudTrab");
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
                $ideTrabalhador->appendChild($procJudTrab);
            }
        }
        $this->node->appendChild($ideTrabalhador);

        if (isset($this->std->infocpcalc)) {
            foreach ($this->std->infocpcalc as $info) {
                $infoCpCalc = $this->dom->createElement("infoCpCalc");
                $this->dom->addChild(
                    $infoCpCalc,
                    "tpCR",
                    $info->tpcr,
                    true
                );
                $this->dom->addChild(
                    $infoCpCalc,
                    "vrCpSeg",
                    $info->vrcpseg,
                    true
                );
                $this->dom->addChild(
                    $infoCpCalc,
                    "vrDescSeg",
                    $info->vrdescseg,
                    true
                );
                $this->node->appendChild($infoCpCalc);
            }
        }

        $infoCp = $this->dom->createElement("infoCp");
        foreach ($this->std->ideestablot as $ideest) {
            $ideEstabLot = $this->dom->createElement("ideEstabLot");
            $this->dom->addChild(
                $ideEstabLot,
                "tpInsc",
                $ideest->tpinsc,
                true
            );
            $this->dom->addChild(
                $ideEstabLot,
                "nrInsc",
                $ideest->nrinsc,
                true
            );
            $this->dom->addChild(
                $ideEstabLot,
                "codLotacao",
                $ideest->codlotacao,
                true
            );
            foreach ($ideest->infocategincid as $infocat) {
                $infoCategIncid = $this->dom->createElement("infoCategIncid");
                $this->dom->addChild(
                    $infoCategIncid,
                    "matricula",
                    ! empty($infocat->matricula) ? $infocat->matricula : null,
                    false
                );
                $this->dom->addChild(
                    $infoCategIncid,
                    "codCateg",
                    $infocat->codcateg,
                    true
                );
                $this->dom->addChild(
                    $infoCategIncid,
                    "indSimples",
                    ! empty($infocat->indsimples) ? $infocat->indsimples : null,
                    false
                );
                foreach ($infocat->infobasecs as $infobase) {
                    $infoBaseCS = $this->dom->createElement("infoBaseCS");
                    $this->dom->addChild(
                        $infoBaseCS,
                        "ind13",
                        $infobase->ind13,
                        true
                    );
                    $this->dom->addChild(
                        $infoBaseCS,
                        "tpValor",
                        $infobase->tpvalor,
                        true
                    );
                    $this->dom->addChild(
                        $infoBaseCS,
                        "valor",
                        $infobase->valor,
                        true
                    );
                    $infoCategIncid->appendChild($infoBaseCS);
                }

                if (isset($infocat->calcterc)) {
                    foreach ($infocat->calcterc as $cT) {
                        $calcTerc = $this->dom->createElement("calcTerc");
                        $this->dom->addChild(
                            $calcTerc,
                            "tpCR",
                            $cT->tpcr,
                            true
                        );
                        $this->dom->addChild(
                            $calcTerc,
                            "vrCsSegTerc",
                            $cT->vrcssegterc,
                            true
                        );
                        $this->dom->addChild(
                            $calcTerc,
                            "vrDescTerc",
                            $cT->vrdescterc,
                            true
                        );
                        $infoCategIncid->appendChild($calcTerc);
                    }
                }
                $ideEstabLot->appendChild($infoCategIncid);
            }
            $infoCp->appendChild($ideEstabLot);
        }
        $this->node->appendChild($infoCp);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->node);
        $this->sign($this->eSocial);
    }
    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("TODO !!");
    }
    
    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
        throw new \Exception("TODO !!");
    }
}
