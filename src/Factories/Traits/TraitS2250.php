<?php

namespace NFePHP\eSocial\Factories\Traits;

use NFePHP\eSocial\Common\FactoryId;

trait TraitS2250
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        $evtid       = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );
        $eSocial     = $this->dom->getElementsByTagName("eSocial")->item(0);
        $evtAvPrevio = $this->dom->createElement("evtAvPrevio");
        $att         = $this->dom->createAttribute('Id');
        $att->value  = $evtid;
        $evtAvPrevio->appendChild($att);

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
        $evtAvPrevio->appendChild($ideEvento);

        $ideEmpregador = $this->dom->createElement("ideEmpregador");
        $this->dom->addChild(
            $ideEmpregador,
            "tpInsc",
            $this->tpInsc,
            true
        );
        $this->dom->addChild(
            $ideEmpregador,
            "nrInsc",
            $this->nrInsc,
            true
        );
        $evtAvPrevio->appendChild($ideEmpregador);

        $ideVinculo = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->idevinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            $this->std->idevinculo->nistrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->idevinculo->matricula,
            true
        );
        $evtAvPrevio->appendChild($ideVinculo);

        $infoAvPrevio = $this->dom->createElement("infoAvPrevio");


        if (isset($this->std->infoavprevio->detavprevio)) {

            $detAvPrevio = $this->dom->createElement("detAvPrevio");

            $this->dom->addChild(
              $detAvPrevio,
              "dtAvPrv",
              $this->std->infoavprevio->detavprevio->dtavprv,
              true
            );
            $this->dom->addChild(
              $detAvPrevio,
              "dtPrevDeslig",
              $this->std->infoavprevio->detavprevio->dtprevdeslig,
              true
            );
            $this->dom->addChild(
              $detAvPrevio,
              "tpAvPrevio",
              $this->std->infoavprevio->detavprevio->tpavprevio,
              true
            );
            $this->dom->addChild(
              $detAvPrevio,
              "observacao",
              ! empty($this->std->infoavprevio->detavprevio->observacao) ? $this->std->infoavprevio->detavprevio->observacao : null,
              false
            );

            $infoAvPrevio->appendChild($detAvPrevio);
        }

        $evtAvPrevio->appendChild($infoAvPrevio);

        if (! empty($this->std->infoavprevio->cancavprevio)) {
            $cancAvPrevio = $this->dom->createElement("cancAvPrevio");
            $this->dom->addChild(
                $cancAvPrevio,
                "dtCancAvPrv",
                $this->std->infoavprevio->cancavprevio->dtcancavprv,
                true
            );
            $this->dom->addChild(
                $cancAvPrevio,
                "observacao",
                ! empty($this->std->infoavprevio->cancavprevio->observacao) ? $this->std->infoavprevio->cancavprevio->observacao : null,
                false
            );
            $this->dom->addChild(
                $cancAvPrevio,
                "mtvCancAvPrevio",
                $this->std->infoavprevio->cancavprevio->mtvcancavprevio,
                true
            );
            $infoAvPrevio->appendChild($cancAvPrevio);
        }

        $eSocial->appendChild($evtAvPrevio);
        $this->sign($eSocial);
    }
    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S_1.0 !!");
    }
}
