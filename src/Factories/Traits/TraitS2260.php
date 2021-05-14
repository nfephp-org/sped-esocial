<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2260
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
        
        $i = $this->std->infoconvinterm;
        $info = $this->dom->createElement("infoConvInterm");
        $this->dom->addChild(
            $info,
            "codConv",
            $i->codconv,
            true
        );
        $this->dom->addChild(
            $info,
            "dtInicio",
            $i->dtinicio,
            true
        );
        $this->dom->addChild(
            $info,
            "dtFim",
            $i->dtfim,
            true
        );
        $this->dom->addChild(
            $info,
            "dtPrevPgto",
            $i->dtprevpgto,
            true
        );
        $jornada = $this->dom->createElement("jornada");
        $this->dom->addChild(
            $jornada,
            "codHorContrat",
            !empty($i->jornada->codhorcontrat) ? $i->jornada->codhorcontrat : null,
            false
        );
        $this->dom->addChild(
            $jornada,
            "dscJornada",
            !empty($i->jornada->dscjornada) ? $i->jornada->dscjornada : null,
            false
        );
        $info->appendChild($jornada);
        
        $localTrab = $this->dom->createElement("localTrab");
        $this->dom->addChild(
            $localTrab,
            "indLocal",
            $i->localtrab->indlocal,
            true
        );
        if (!empty($i->localtrab->localtrabinterm)) {
            $l = $i->localtrab->localtrabinterm;
            $local = $this->dom->createElement("localTrabInterm");
            $this->dom->addChild(
                $local,
                "tpLograd",
                $l->tplograd,
                true
            );
            $this->dom->addChild(
                $local,
                "dscLograd",
                $l->dsclograd,
                true
            );
            $this->dom->addChild(
                $local,
                "nrLograd",
                $l->nrlograd,
                true
            );
            $this->dom->addChild(
                $local,
                "complem",
                !empty($l->complem) ? $l->complem : null,
                false
            );
            $this->dom->addChild(
                $local,
                "bairro",
                !empty($l->bairro) ? $l->bairro : null,
                false
            );
            $this->dom->addChild(
                $local,
                "cep",
                $l->cep,
                true
            );
            $this->dom->addChild(
                $local,
                "codMunic",
                $l->codmunic,
                true
            );
            $this->dom->addChild(
                $local,
                "uf",
                $l->uf,
                true
            );
            $localTrab->appendChild($local);
        }
        $info->appendChild($localTrab);
        $this->node->appendChild($info);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
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
