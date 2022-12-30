<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS5013
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
            "perApur",
            $this->std->perapur,
            true
        );
        $this->node->insertBefore($ideEvento, $ideEmpregador);
        //tag deste evento em particular
                
        $infofgts = $this->dom->createElement("infoFGTS");
        $this->dom->addChild(
            $infofgts,
            "nrRecArqBase",
            $this->std->infofgts->nrrecarqbase,
            true
        );
        $this->dom->addChild(
            $infofgts,
            "indExistInfo",
            $this->std->infofgts->indexistinfo,
            true
        );
        if (!empty($this->std->infofgts->infobasefgts)) {
            $infoBaseFGTS = $this->dom->createElement("infoBaseFGTS");
            if (!empty($this->std->infofgts->infobasefgts->baseperapur)) {
                foreach ($this->std->infofgts->infobasefgts->baseperapur as $bap) {
                    $basePerApur = $this->dom->createElement("basePerApur");
                    $this->dom->addChild(
                        $basePerApur,
                        "tpValor",
                        $bap->tpvalor,
                        true
                    );
                    $this->dom->addChild(
                        $basePerApur,
                        "baseFGTS",
                        number_format($bap->basefgts, 2, ".", ""),
                        true
                    );
                    $infoBaseFGTS->appendChild($basePerApur);
                }
            }
            if (!empty($this->std->infofgts->infobasefgts->infobaseperante)) {
                foreach ($this->std->infofgts->infobasefgts->infobaseperante as $ipa) {
                    $infoBasePerAntE = $this->dom->createElement("infoBasePerAntE");
                    $this->dom->addChild(
                        $infoBasePerAntE,
                        "perRef",
                        $ipa->perref,
                        true
                    );
                    foreach ($ipa->baseperante as $bpae) {
                        $basePerAntE = $this->dom->createElement("basePerAntE");
                        $this->dom->addChild(
                            $basePerAntE,
                            "tpValorE",
                            $bpae->tpvalore,
                            true
                        );
                        $this->dom->addChild(
                            $basePerAntE,
                            "baseFGTSE",
                            number_format($bpae->basefgtse, 2, ".", ""),
                            true
                        );
                        $infoBasePerAntE->appendChild($basePerAntE);
                    }
                    $infoBaseFGTS->appendChild($infoBasePerAntE);
                }
            }
            $infofgts->appendChild($infoBaseFGTS);
        }
        if (!empty($this->std->infofgts->infodpsfgts)) {
            $infoDpsFGTS = $this->dom->createElement("infoDpsFGTS");
            if (!empty($this->std->infofgts->infodpsfgts->dpsperapur)) {
                foreach ($this->std->infofgts->infodpsfgts->dpsperapur as $dpap) {
                    $dpsPerApur = $this->dom->createElement("dpsPerApur");
                    $this->dom->addChild(
                        $dpsPerApur,
                        "tpDps",
                        $dpap->tpdps,
                        true
                    );
                    $this->dom->addChild(
                        $dpsPerApur,
                        "vrFGTS",
                        number_format($dpap->vrfgts, 2, ".", ""),
                        true
                    );
                    if (!empty($dpap->infodpsperante)) {
                        foreach ($dpap->infodpsperante as $ipte) {
                            $infoDpsPerAntE = $this->dom->createElement("infoDpsPerAntE");
                            $this->dom->addChild(
                                $infoDpsPerAntE,
                                "perRef",
                                $ipte->perref,
                                true
                            );
                            foreach ($ipte->dpsperante as $dpte) {
                                $dpsPerAntE = $this->dom->createElement("dpsPerAntE");
                                $this->dom->addChild(
                                    $dpsPerAntE,
                                    "tpDpsE",
                                    $dpte->tpDpsE,
                                    true
                                );
                                $this->dom->addChild(
                                    $dpsPerAntE,
                                    "vrFGTSE",
                                    $dpte->vrfgtse,
                                    true
                                );
                                $infoDpsPerAntE->appendChild($dpsPerAntE);
                            }
                            $dpsPerApur->appendChild($infoDpsPerAntE);
                        }
                    }
                    $infoDpsFGTS->appendChild($dpsPerApur);
                }
            }
            $infofgts->appendChild($infoDpsFGTS);
        }
        $this->node->appendChild($infofgts);
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
