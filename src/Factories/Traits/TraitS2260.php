<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2260
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
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
        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);
        $this->node->insertBefore($ideEvento, $ideEmpregador);

        //ideVinculo
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
        $this->node->appendChild($ideVinculo);

        //infoConvInterm
        $infoConvInterm = $this->dom->createElement("infoConvInterm");
        $this->dom->addChild(
            $infoConvInterm,
            "codConv",
            $this->std->infoconvinterm->codconv,
            true
        );
        $this->dom->addChild(
            $infoConvInterm,
            "dtInicio",
            $this->std->infoconvinterm->dtinicio,
            true
        );
        $this->dom->addChild(
            $infoConvInterm,
            "dtFim",
            $this->std->infoconvinterm->dtfim,
            true
        );
        $this->dom->addChild(
            $infoConvInterm,
            "dtPrevPgto",
            $this->std->infoconvinterm->dtprevpgto,
            true
        );
        //Jornada
        $jornada = $this->dom->createElement("jornada");
        $this->dom->addChild(
            $jornada,
            "codHorContrat",
            !empty($this->std->infoconvinterm->jornada->codhorcontrat) ? $this->std->infoconvinterm->jornada->codhorcontrat : null,
            false
        );
        $this->dom->addChild(
            $jornada,
            "dscJornada",
            !empty($this->std->infoconvinterm->jornada->dscjornada) ? $this->std->infoconvinterm->jornada->dscjornada : null,
            false
        );
        $infoConvInterm->appendChild($jornada);

        //localTrab
        $localTrab = $this->dom->createElement("localTrab");
        $this->dom->addChild(
            $localTrab,
            "indLocal",
            $this->std->infoconvinterm->localtrab->indlocal,
            true
        );

        //localtrabinterm
        if (!empty($this->std->infoconvinterm->localtrab->localtrabinterm)) {
            $localTrabInterm = $this->dom->createElement("localTrabInterm");
            $this->dom->addChild(
                $localTrabInterm,
                "tpLograd",
                $this->std->infoconvinterm->localtrab->localtrabinterm->tplograd,
                true
            );
            $this->dom->addChild(
                $localTrabInterm,
                "dscLograd",
                $this->std->infoconvinterm->localtrab->localtrabinterm->dsclograd,
                true
            );
            $this->dom->addChild(
                $localTrabInterm,
                "nrLograd",
                $this->std->infoconvinterm->localtrab->localtrabinterm->nrlograd,
                true
            );
            $this->dom->addChild(
                $localTrabInterm,
                "complem",
                !empty($this->std->infoconvinterm->localtrab->localtrabinterm->complem) ? $this->std->infoconvinterm->localtrab->localtrabinterm->complem : null,
                false
            );
            $this->dom->addChild(
                $localTrabInterm,
                "bairro",
                !empty($this->std->infoconvinterm->localtrab->localtrabinterm->bairro) ? $this->std->infoconvinterm->localtrab->localtrabinterm->bairro : null,
                false
            );
            $this->dom->addChild(
                $localTrabInterm,
                "cep",
                $this->std->infoconvinterm->localtrab->localtrabinterm->cep,
                true
            );
            $this->dom->addChild(
                $localTrabInterm,
                "codMunic",
                $this->std->infoconvinterm->localtrab->localtrabinterm->codmunic,
                true
            );
            $this->dom->addChild(
                $localTrabInterm,
                "uf",
                $this->std->infoconvinterm->localtrab->localtrabinterm->uf,
                true
            );
            $localTrab->appendChild($localTrabInterm);
        }

        $infoConvInterm->appendChild($localTrab);
        $this->node->appendChild($infoConvInterm);
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S_1.0 !!");
    }
}
