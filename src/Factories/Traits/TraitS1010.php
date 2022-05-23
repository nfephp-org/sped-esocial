<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1010
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
        $infoRubrica = $this->dom->createElement("infoRubrica");
        //tag comum a todos os modos
        $ideRubrica = $this->dom->createElement("ideRubrica");
        $this->dom->addChild(
            $ideRubrica,
            "codRubr",
            $this->std->codrubr,
            true
        );
        $this->dom->addChild(
            $ideRubrica,
            "ideTabRubr",
            $this->std->idetabrubr,
            true
        );
        $this->dom->addChild(
            $ideRubrica,
            "iniValid",
            $this->std->inivalid,
            true
        );
        $this->dom->addChild(
            $ideRubrica,
            "fimValid",
            ! empty($this->std->fimvalid) ? $this->std->fimvalid : null,
            false
        );
        //seleção do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
        } else {
            $node = $this->dom->createElement("exclusao");
        }
        $node->appendChild($ideRubrica);

        if (!empty($this->std->dadosrubrica) && $this->std->modo != 'EXC') {
            $dadosRubrica = $this->dom->createElement("dadosRubrica");
            $this->dom->addChild(
                $dadosRubrica,
                "dscRubr",
                $this->std->dadosrubrica->dscrubr,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "natRubr",
                $this->std->dadosrubrica->natrubr,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "tpRubr",
                $this->std->dadosrubrica->tprubr,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "codIncCP",
                $this->std->dadosrubrica->codinccp,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "codIncIRRF",
                $this->std->dadosrubrica->codincirrf,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "codIncFGTS",
                $this->std->dadosrubrica->codincfgts,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "codIncSIND",
                $this->std->dadosrubrica->codincsind,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "observacao",
                ! empty($this->std->dadosrubrica->observacao)
                    ? $this->std->dadosrubrica->observacao
                    : null,
                false
            );

            if (! empty($this->std->dadosrubrica->ideprocessocp)) {
                foreach ($this->std->dadosrubrica->ideprocessocp as $cp) {
                    $ideProcessoCP = $this->dom->createElement("ideProcessoCP");
                    $this->dom->addChild(
                        $ideProcessoCP,
                        "tpProc",
                        $cp->tpproc,
                        true
                    );
                    $this->dom->addChild(
                        $ideProcessoCP,
                        "nrProc",
                        $cp->nrproc,
                        true
                    );
                    $this->dom->addChild(
                        $ideProcessoCP,
                        "extDecisao",
                        $cp->extdecisao,
                        true
                    );
                    $this->dom->addChild(
                        $ideProcessoCP,
                        "codSusp",
                        $cp->codsusp,
                        true
                    );
                    $dadosRubrica->appendChild($ideProcessoCP);
                }
            }

            if (! empty($this->std->dadosrubrica->ideprocessoirrf)) {
                foreach ($this->std->dadosrubrica->ideprocessoirrf as $irrf) {
                    $ideProcessoIRRF = $this->dom->createElement("ideProcessoIRRF");
                    $this->dom->addChild(
                        $ideProcessoIRRF,
                        "nrProc",
                        $irrf->nrproc,
                        true
                    );
                    $this->dom->addChild(
                        $ideProcessoIRRF,
                        "codSusp",
                        $irrf->codsusp,
                        true
                    );
                    $dadosRubrica->appendChild($ideProcessoIRRF);
                }
            }
            if (! empty($this->std->dadosrubrica->ideprocessofgts)) {
                foreach ($this->std->dadosrubrica->ideprocessofgts as $fgts) {
                    $ideProcessoFGTS = $this->dom->createElement("ideProcessoFGTS");
                    $this->dom->addChild(
                        $ideProcessoFGTS,
                        "nrProc",
                        $fgts->nrproc,
                        true
                    );
                    $dadosRubrica->appendChild($ideProcessoFGTS);
                }
            }
            if (! empty($this->std->dadosrubrica->ideprocessosind)) {
                foreach ($this->std->dadosrubrica->ideprocessosind as $sind) {
                    $ideProcessoSIND = $this->dom->createElement("ideProcessoSIND");
                    $this->dom->addChild(
                        $ideProcessoSIND,
                        "nrProc",
                        $sind->nrproc,
                        true
                    );
                    $dadosRubrica->appendChild($ideProcessoSIND);
                }
            }
            $node->appendChild($dadosRubrica);
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

        //finalização do xml
        $infoRubrica->appendChild($node);
        $this->node->appendChild($infoRubrica);
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
        $infoRubrica = $this->dom->createElement("infoRubrica");
        //tag comum a todos os modos
        $ideRubrica = $this->dom->createElement("ideRubrica");
        $this->dom->addChild(
            $ideRubrica,
            "codRubr",
            $this->std->codrubr,
            true
        );
        $this->dom->addChild(
            $ideRubrica,
            "ideTabRubr",
            $this->std->idetabrubr,
            true
        );
        $this->dom->addChild(
            $ideRubrica,
            "iniValid",
            $this->std->inivalid,
            true
        );
        $this->dom->addChild(
            $ideRubrica,
            "fimValid",
            ! empty($this->std->fimvalid) ? $this->std->fimvalid : null,
            false
        );
        //seleção do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
        } else {
            $node = $this->dom->createElement("exclusao");
        }
        $node->appendChild($ideRubrica);

        if (!empty($this->std->dadosrubrica) && $this->std->modo != 'EXC') {
            $dadosRubrica = $this->dom->createElement("dadosRubrica");
            $this->dom->addChild(
                $dadosRubrica,
                "dscRubr",
                $this->std->dadosrubrica->dscrubr,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "natRubr",
                $this->std->dadosrubrica->natrubr,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "tpRubr",
                $this->std->dadosrubrica->tprubr,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "codIncCP",
                $this->std->dadosrubrica->codinccp,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "codIncIRRF",
                $this->std->dadosrubrica->codincirrf,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "codIncFGTS",
                $this->std->dadosrubrica->codincfgts,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "codIncCPRP",
                $this->std->dadosrubrica->codinccprp,
                true
            );
            $this->dom->addChild(
                $dadosRubrica,
                "tetoRemun",
                ! empty($this->std->dadosrubrica->tetoremun)
                    ? $this->std->dadosrubrica->tetoremun
                    : null,
                false
            );
            $this->dom->addChild(
                $dadosRubrica,
                "observacao",
                ! empty($this->std->dadosrubrica->observacao)
                    ? $this->std->dadosrubrica->observacao
                    : null,
                false
            );

            if (! empty($this->std->dadosrubrica->ideprocessocp)) {
                foreach ($this->std->dadosrubrica->ideprocessocp as $cp) {
                    $ideProcessoCP = $this->dom->createElement("ideProcessoCP");
                    $this->dom->addChild(
                        $ideProcessoCP,
                        "tpProc",
                        $cp->tpproc,
                        true
                    );
                    $this->dom->addChild(
                        $ideProcessoCP,
                        "nrProc",
                        $cp->nrproc,
                        true
                    );
                    $this->dom->addChild(
                        $ideProcessoCP,
                        "extDecisao",
                        $cp->extdecisao,
                        true
                    );
                    $this->dom->addChild(
                        $ideProcessoCP,
                        "codSusp",
                        $cp->codsusp,
                        true
                    );
                    $dadosRubrica->appendChild($ideProcessoCP);
                }
            }

            if (! empty($this->std->dadosrubrica->ideprocessoirrf)) {
                foreach ($this->std->dadosrubrica->ideprocessoirrf as $irrf) {
                    $ideProcessoIRRF = $this->dom->createElement("ideProcessoIRRF");
                    $this->dom->addChild(
                        $ideProcessoIRRF,
                        "nrProc",
                        $irrf->nrproc,
                        true
                    );
                    $this->dom->addChild(
                        $ideProcessoIRRF,
                        "codSusp",
                        $irrf->codsusp,
                        true
                    );
                    $dadosRubrica->appendChild($ideProcessoIRRF);
                }
            }
            if (! empty($this->std->dadosrubrica->ideprocessofgts)) {
                foreach ($this->std->dadosrubrica->ideprocessofgts as $fgts) {
                    $ideProcessoFGTS = $this->dom->createElement("ideProcessoFGTS");
                    $this->dom->addChild(
                        $ideProcessoFGTS,
                        "nrProc",
                        $fgts->nrproc,
                        true
                    );
                    $dadosRubrica->appendChild($ideProcessoFGTS);
                }
            }
            if (! empty($this->std->dadosrubrica->ideprocessosind)) {
                foreach ($this->std->dadosrubrica->ideprocessosind as $sind) {
                    $ideProcessoSIND = $this->dom->createElement("ideProcessoSIND");
                    $this->dom->addChild(
                        $ideProcessoSIND,
                        "nrProc",
                        $sind->nrproc,
                        true
                    );
                    $dadosRubrica->appendChild($ideProcessoSIND);
                }
            }
            $node->appendChild($dadosRubrica);
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

        //finalização do xml
        $infoRubrica->appendChild($node);
        $this->node->appendChild($infoRubrica);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
