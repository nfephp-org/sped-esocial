<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2298
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        $ideEvento = $this->dom->createElement('ideEvento');

        $this->dom->addChild(
            $ideEvento,
            'indRetif',
            $this->std->indretif,
            true
        );

        $this->dom->addChild(
            $ideEvento,
            'nrRecibo',
            !empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
            false
        );

        $this->dom->addChild(
            $ideEvento,
            'tpAmb',
            $this->tpAmb,
            true
        );

        $this->dom->addChild(
            $ideEvento,
            'procEmi',
            $this->procEmi,
            true
        );

        $this->dom->addChild(
            $ideEvento,
            'verProc',
            $this->verProc,
            true
        );

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);

        $this->node->insertBefore($ideEvento, $ideEmpregador);

        $ideVinculo = $this->dom->createElement('ideVinculo');

        $this->dom->addChild(
            $ideVinculo,
            'cpfTrab',
            $this->std->idevinculo->cpftrab,
            true
        );

        $this->dom->addChild(
            $ideVinculo,
            'nisTrab',
            $this->std->idevinculo->nistrab,
            true
        );

        $this->dom->addChild(
            $ideVinculo,
            'matricula',
            $this->std->idevinculo->matricula,
            true
        );

        $this->node->appendChild($ideVinculo);

        $infoReintegr = $this->dom->createElement('infoReintegr');

        $this->dom->addChild(
            $infoReintegr,
            'tpReint',
            $this->std->inforeintegr->tpreint,
            true
        );

        $this->dom->addChild(
            $infoReintegr,
            'nrProcJud',
            !empty($this->std->inforeintegr->nrprocjud) ? $this->std->inforeintegr->nrprocjud : null,
            false
        );

        $this->dom->addChild(
            $infoReintegr,
            'nrLeiAnistia',
            !empty($this->std->inforeintegr->nrleianistia) ? $this->std->inforeintegr->nrleianistia : null,
            false
        );

        $this->dom->addChild(
            $infoReintegr,
            'dtEfetRetorno',
            $this->std->inforeintegr->dtefetretorno,
            true
        );

        $this->dom->addChild(
            $infoReintegr,
            'dtEfeito',
            $this->std->inforeintegr->dtefeito,
            true
        );

        $this->dom->addChild(
            $infoReintegr,
            'indPagtoJuizo',
            $this->std->inforeintegr->indpagtojuizo,
            true
        );

        $this->node->appendChild($infoReintegr);
        $this->eSocial->appendChild($this->node);
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
            "indRetif",
            $this->std->indretif,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "nrRecibo",
            !empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
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
        //nodes do evento
        $ideVinculo = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->matricula,
            true
        );
        $this->node->appendChild($ideVinculo);

        $infoReintegr = $this->dom->createElement("infoReintegr");
        $this->dom->addChild(
            $infoReintegr,
            "tpReint",
            $this->std->tpreint,
            true
        );
        $this->dom->addChild(
            $infoReintegr,
            "nrProcJud",
            ! empty($this->std->nrprocjud) ? $this->std->nrprocjud : null,
            false
        );
        $this->dom->addChild(
            $infoReintegr,
            "nrLeiAnistia",
            ! empty($this->std->nrleianistia) ? $this->std->nrleianistia : null,
            false
        );
        $this->dom->addChild(
            $infoReintegr,
            "dtEfetRetorno",
            $this->std->dtefetretorno,
            true
        );
        $this->dom->addChild(
            $infoReintegr,
            "dtEfeito",
            $this->std->dtefeito,
            true
        );
        $this->node->appendChild($infoReintegr);
        //finalização do xml
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
            "indRetif",
            $this->std->indretif,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "nrRecibo",
            !empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
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
        //nodes do evento
        $ideVinculo = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->matricula,
            true
        );
        $this->node->appendChild($ideVinculo);

        $infoReintegr = $this->dom->createElement("infoReintegr");
        $this->dom->addChild(
            $infoReintegr,
            "tpReint",
            $this->std->tpreint,
            true
        );
        $this->dom->addChild(
            $infoReintegr,
            "nrProcJud",
            ! empty($this->std->nrprocjud) ? $this->std->nrprocjud : null,
            false
        );
        $this->dom->addChild(
            $infoReintegr,
            "nrLeiAnistia",
            ! empty($this->std->nrleianistia) ? $this->std->nrleianistia : null,
            false
        );
        $this->dom->addChild(
            $infoReintegr,
            "dtEfetRetorno",
            $this->std->dtefetretorno,
            true
        );
        $this->dom->addChild(
            $infoReintegr,
            "dtEfeito",
            $this->std->dtefeito,
            true
        );
        $this->node->appendChild($infoReintegr);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
