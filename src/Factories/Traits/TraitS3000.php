<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS3000
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
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

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);
        $this->node->insertBefore($ideEvento, $ideEmpregador);

        $infoExclusao = $this->dom->createElement("infoExclusao");
        $this->dom->addChild(
            $infoExclusao,
            "tpEvento",
            $this->std->infoexclusao->tpevento,
            true
        );
        $this->dom->addChild(
            $infoExclusao,
            "nrRecEvt",
            $this->std->infoexclusao->nrrecevt,
            true
        );
        if (!empty($this->std->infoexclusao->idetrabalhador)) {
            $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
            $this->dom->addChild(
                $ideTrabalhador,
                "cpfTrab",
                $this->std->infoexclusao->idetrabalhador->cpftrab,
                true
            );
            $this->dom->addChild(
                $ideTrabalhador,
                "nisTrab",
                !empty($this->std->infoexclusao->idetrabalhador->nistrab) ? $this->std->infoexclusao->idetrabalhador->nistrab : null,
                false
            );
            $infoExclusao->appendChild($ideTrabalhador);
        }

        if (!empty($this->std->infoexclusao->idefolhapagto)) {
            $ideFolhaPagto = $this->dom->createElement("ideFolhaPagto");
            if (isset($this->std->infoexclusao->idefolhapagto->indapuracao) && !empty($this->std->infoexclusao->idefolhapagto->indapuracao)) {
                $this->dom->addChild(
                    $ideFolhaPagto,
                    "indApuracao",
                    $this->std->infoexclusao->idefolhapagto->indapuracao,
                    true
                );
            }
            $this->dom->addChild(
                $ideFolhaPagto,
                "perApur",
                $this->std->infoexclusao->idefolhapagto->perapur,
                true
            );
            $infoExclusao->appendChild($ideFolhaPagto);
        }

        $this->node->appendChild($infoExclusao);
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }

    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
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

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);
        $this->node->insertBefore($ideEvento, $ideEmpregador);

        $infoExclusao = $this->dom->createElement("infoExclusao");
        $this->dom->addChild(
            $infoExclusao,
            "tpEvento",
            $this->std->infoexclusao->tpevento,
            true
        );
        $this->dom->addChild(
            $infoExclusao,
            "nrRecEvt",
            $this->std->infoexclusao->nrrecevt,
            true
        );
        if (!empty($this->std->infoexclusao->idetrabalhador)) {
            $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
            $this->dom->addChild(
                $ideTrabalhador,
                "cpfTrab",
                $this->std->infoexclusao->idetrabalhador->cpftrab,
                true
            );
            $infoExclusao->appendChild($ideTrabalhador);
        }

        if (!empty($this->std->infoexclusao->idefolhapagto)) {
            $ideFolhaPagto = $this->dom->createElement("ideFolhaPagto");
            $this->dom->addChild(
                $ideFolhaPagto,
                "indApuracao",
                $this->std->infoexclusao->idefolhapagto->indapuracao,
                true
            );
            $this->dom->addChild(
                $ideFolhaPagto,
                "perApur",
                $this->std->infoexclusao->idefolhapagto->perapur,
                true
            );
            $infoExclusao->appendChild($ideFolhaPagto);
        }

        $this->node->appendChild($infoExclusao);
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
