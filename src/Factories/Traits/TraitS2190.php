<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2190
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
        $infoRegPrelim = $this->dom->createElement("infoRegPrelim");
        $this->dom->addChild(
            $infoRegPrelim,
            "cpfTrab",
            $this->std->inforegprelim->cpftrab,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtNascto",
            $this->std->inforegprelim->dtnascto,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtAdm",
            $this->std->inforegprelim->dtadm,
            true
        );
        $this->node->appendChild($infoRegPrelim);

        //finalização do xml
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
        $infoRegPrelim = $this->dom->createElement("infoRegPrelim");
        $this->dom->addChild(
            $infoRegPrelim,
            "cpfTrab",
            $this->std->inforegprelim->cpftrab,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtNascto",
            $this->std->inforegprelim->dtnascto,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtAdm",
            $this->std->inforegprelim->dtadm,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "matricula",
            $this->std->inforegprelim->matricula,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "codCateg",
            $this->std->inforegprelim->codcateg,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "natAtividade",
            $this->std->inforegprelim->natatividade,
            true
        );
        $this->node->appendChild($infoRegPrelim);

        $infoRegCTPS = $this->dom->createElement("infoRegCTPS");
        $this->dom->addChild(
            $infoRegCTPS,
            "CBOCargo",
            $this->std->inforegctps->cbocargo,
            true
        );
        $this->dom->addChild(
            $infoRegCTPS,
            "vrSalFx",
            $this->std->inforegctps->vrsalfx,
            true
        );
        $this->dom->addChild(
            $infoRegCTPS,
            "undSalFixo",
            $this->std->inforegctps->undsalfixo,
            true
        );
        $this->dom->addChild(
            $infoRegCTPS,
            "tpContr",
            $this->std->inforegctps->tpcontr,
            true
        );
        $this->dom->addChild(
            $infoRegCTPS,
            "dtTerm",
            $this->std->inforegctps->dtterm,
            true
        );
        $this->node->appendChild($infoRegCTPS);

        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
