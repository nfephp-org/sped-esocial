<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1299
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

        $ideRespInf = $this->dom->createElement("ideRespInf");
        $this->dom->addChild(
            $ideRespInf,
            "nmResp",
            $this->std->iderespinf->nmresp,
            true
        );
        $this->dom->addChild(
            $ideRespInf,
            "cpfResp",
            $this->std->iderespinf->cpfresp,
            true
        );
        $this->dom->addChild(
            $ideRespInf,
            "telefone",
            $this->std->iderespinf->telefone,
            true
        );
        $this->dom->addChild(
            $ideRespInf,
            "email",
            ! empty($this->std->iderespinf->email) ? $this->std->iderespinf->email : null,
            false
        );
        $this->node->appendChild($ideRespInf);

        $infoFech = $this->dom->createElement("infoFech");
        $this->dom->addChild(
            $infoFech,
            "evtRemun",
            $this->std->infofech->evtremun,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtPgtos",
            $this->std->infofech->evtpgtos,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtAqProd",
            $this->std->infofech->evtaqprod,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtComProd",
            $this->std->infofech->evtcomprod,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtContratAvNP",
            $this->std->infofech->evtcontratavnp,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtInfoComplPer",
            $this->std->infofech->evtinfocomplper,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "compSemMovto",
            ! empty($this->std->infofech->compsemmovto) ? $this->std->infofech->compsemmovto : null,
            false
        );
        $this->node->appendChild($infoFech);
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
        if (!empty($this->std->indguia)) {
            $this->dom->addChild(
                $ideEvento,
                "indGuia",
                $this->std->indguia,
                false
            );
        }
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
        if (!empty($fech->indexcapur1250)) {
            $this->dom->addChild(
                $infoFech,
                "indExcApur1250",
                ($fech->indexcapur1250 == 'S') ? $fech->indexcapur1250 : null, //aceita somente S
                false
            );
        }

        if (!empty($fech->transdctfweb)) {
            $this->dom->addChild(
                $infoFech,
                "transDCTFWeb",
                ($fech->transdctfweb == 'S') ? $fech->transdctfweb : null, //aceita somente S
                false
            );
        }

        $this->node->appendChild($infoFech);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
        
    /**
     * builder for version S.1.1.0
     */
    /**
     * TODO
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
        if (!empty($this->std->indguia)) {
            $this->dom->addChild(
                $ideEvento,
                "indGuia",
                $this->std->indguia,
                false
            );
        }
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
        if (!empty($fech->indexcapur1250)) {
            $this->dom->addChild(
                $infoFech,
                "indExcApur1250",
                ($fech->indexcapur1250 == 'S') ? $fech->indexcapur1250 : null, //aceita somente S
                false
            );
        }

        if (!empty($fech->transdctfweb)) {
            $this->dom->addChild(
                $infoFech,
                "transDCTFWeb",
                ($fech->transdctfweb == 'S') ? $fech->transdctfweb : null, //aceita somente S
                false
            );
        }

        if (!empty($fech->naovalid)) {
            $this->dom->addChild(
                $infoFech,
                "naoValid",
                ($fech->naovalid == 'S') ? $fech->naovalid : null, //aceita somente S
                false
            );
        }

        $this->node->appendChild($infoFech);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
