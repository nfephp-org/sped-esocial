<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS3000
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
        if (!empty($this->std->idetrabalhador)) {
            $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
            $this->dom->addChild(
                $ideTrabalhador,
                "cpfTrab",
                $this->std->idetrabalhador->cpftrab,
                true
            );
            $this->dom->addChild(
                $ideTrabalhador,
                "nisTrab",
                !empty($this->std->idetrabalhador->nistrab) ? $this->std->idetrabalhador->nistrab : null,
                false
            );
            $infoExclusao->appendChild($ideTrabalhador);
        }
        if (!empty($this->std->idefolhapagto)) {
            $ideFolhaPagto = $this->dom->createElement("ideFolhaPagto");
            $this->dom->addChild(
                $ideFolhaPagto,
                "indApuracao",
                $this->std->idefolhapagto->indapuracao ?? null,
                false
            );
            $this->dom->addChild(
                $ideFolhaPagto,
                "perApur",
                $this->std->idefolhapagto->perapur,
                true
            );
            $infoExclusao->appendChild($ideFolhaPagto);
        }
        $this->node->appendChild($infoExclusao);
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
        if (!empty($this->std->idetrabalhador)) {
            $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
            $this->dom->addChild(
                $ideTrabalhador,
                "cpfTrab",
                $this->std->idetrabalhador->cpftrab,
                true
            );
            $infoExclusao->appendChild($ideTrabalhador);
        }
        if (!empty($this->std->idefolhapagto)) {
            $ideFolhaPagto = $this->dom->createElement("ideFolhaPagto");
            $this->dom->addChild(
                $ideFolhaPagto,
                "indApuracao",
                $this->std->idefolhapagto->indapuracao ?? null,
                false
            );
            $this->dom->addChild(
                $ideFolhaPagto,
                "perApur",
                $this->std->idefolhapagto->perapur,
                true
            );
            $infoExclusao->appendChild($ideFolhaPagto);
        }
        $this->node->appendChild($infoExclusao);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
