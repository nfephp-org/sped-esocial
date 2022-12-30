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
            !empty($this->std->inforegprelim->natatividade)
            ? $this->std->inforegprelim->natatividade
            : 1,
            false
        );
        if (isset($this->std->inforegprelim->inforegctps) && !empty($this->std->inforegprelim->inforegctps)) {
            $infoRegCTPS = $this->dom->createElement("infoRegCTPS");
            $infoCtps = $this->std->inforegprelim->inforegctps[0]; 
            $this->dom->addChild(
                $infoRegCTPS,
                "CBOCargo",
                $infoCtps->cbocargo,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "vrSalFx",
                $infoCtps->vrsalfx,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "undSalFixo",
                $infoCtps->undsalfixo,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "tpContr",
                $infoCtps->tpcontr,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "dtTerm",
                !empty($infoCtps->dtterm)
                ? $infoCtps->dtterm
                : null,
                false
            );
            $infoRegPrelim->appendChild($infoRegCTPS);
        }
        $this->node->appendChild($infoRegPrelim);
       
        //finalização do xml
        $this->eSocial->appendChild($this->node);
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
            !empty($this->std->inforegprelim->natatividade)
            ? $this->std->inforegprelim->natatividade
            : 1,
            false
        );
        if (isset($this->std->inforegprelim->inforegctps) && !empty($this->std->inforegprelim->inforegctps)) {
            $infoRegCTPS = $this->dom->createElement("infoRegCTPS");
            $infoCtps = $this->std->inforegprelim->inforegctps[0]; 
            $this->dom->addChild(
                $infoRegCTPS,
                "CBOCargo",
                $infoCtps->cbocargo,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "vrSalFx",
                $infoCtps->vrsalfx,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "undSalFixo",
                $infoCtps->undsalfixo,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "tpContr",
                $infoCtps->tpcontr,
                true
            );
            $this->dom->addChild(
                $infoRegCTPS,
                "dtTerm",
                !empty($infoCtps->dtterm)
                ? $infoCtps->dtterm
                : null,
                false
            );
            $infoRegPrelim->appendChild($infoRegCTPS);
        }
        $this->node->appendChild($infoRegPrelim);
       
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
