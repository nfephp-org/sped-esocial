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
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtAdm",
            $this->std->dtadm,
            true
        );
        $this->node->appendChild($infoRegPrelim);
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
        //tag deste evento em particular
        $infoRegPrelim = $this->dom->createElement("infoRegPrelim");
        $this->dom->addChild(
            $infoRegPrelim,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtAdm",
            $this->std->dtadm,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "matricula",
            $this->std->matricula,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "codCateg",
            $this->std->codcateg,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "natAtividade",
            $this->std->natatividade ?? null,
            false
        );
        if (!empty($this->std->inforegctps)) {
            $info = $this->std->inforegctps;
            $infoRegCTPS = $this->dom->createElement("infoRegCTPS");
            $this->dom->addChild(
                $infoRegCTPS,
                "CBOCargo",
                $info->cbocargo,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "vrSalFx",
                $info->vrsalfx,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "undSalFixo",
                $info->undsalfixo,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "tpContr",
                $info->tpcontr,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "dtTerm",
                !empty($info->dtTerm) ? $info->dtTerm : null,
                false
            );
            $infoRegPrelim->appendChild($infoRegCTPS);
        }
        $this->node->appendChild($infoRegPrelim);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
