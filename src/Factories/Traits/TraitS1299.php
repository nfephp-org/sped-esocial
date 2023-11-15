<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1299
{
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
            "indGuia",
            !empty($this->std->indguia) ? $this->std->indguia : null,
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

        $infoFech = $this->dom->createElement("infoFech");
        $fech = $this->std->infofech;
        $this->dom->addChild(
            $infoFech,
            "evtRemun",
            $fech->evtremun,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtComProd",
            $fech->evtcomprod,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtContratAvNP",
            $fech->evtcontratavnp,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtInfoComplPer",
            $fech->evtinfocomplper,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "indExcApur1250",
            (($fech->indexcapur1250 ?? null) == 'S') ? $fech->indexcapur1250 : null, //aceita somente S
            false
        );
        $this->dom->addChild(
            $infoFech,
            "transDCTFWeb",
            (($fech->transdctfweb ?? null) == 'S') ? $fech->transdctfweb : null, //aceita somente S
            false
        );
        $this->node->appendChild($infoFech);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);
        //o idEvento pode variar de evento para evento
        //então cada factory individualmente terá de construir o seu
        $ideEvento = $this->dom->createElement("ideEvento");
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
            "indGuia",
            !empty($this->std->indguia) ? $this->std->indguia : null,
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

        $infoFech = $this->dom->createElement("infoFech");
        $fech = $this->std->infofech;
        $this->dom->addChild(
            $infoFech,
            "evtRemun",
            $fech->evtremun,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtPgtos",
            $fech->evtpgtos,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtComProd",
            $fech->evtcomprod,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtContratAvNP",
            $fech->evtcontratavnp,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtInfoComplPer",
            $fech->evtinfocomplper,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "indExcApur1250",
            (($fech->indexcapur1250 ?? null) == 'S') ? $fech->indexcapur1250 : null, //aceita somente S
            false
        );
        $this->dom->addChild(
            $infoFech,
            "transDCTFWeb",
            (($fech->transdctfweb ?? null) == 'S') ? $fech->transdctfweb : null, //aceita somente S
            false
        );
        $this->dom->addChild(
            $infoFech,
            "naoValid",
            (($fech->naovalid ?? null) == 'S') ? $fech->naovalid : null, //aceita somente S
            false
        );
        $this->node->appendChild($infoFech);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    /**
     * builder for version S.1.2.0
     */
    protected function toNodeS120()
    {
        return $this->toNodeS110();
    }
}
