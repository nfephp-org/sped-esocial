<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2555
{
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S 1.0.0 !!");
    }

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S 1.1.0 !!");
    }

    /**
     * builder for version S.1.2.0
     */
    protected function toNodeS120()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S 1.2.0 !!");
    }

     /**
     * builder for version S.1.3.0
     */
    protected function toNodeS130()
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
        
        $ideProc = $this->dom->createElement("ideProc");
        $this->dom->addChild(
            $ideProc,
            "nrProcTrab",
            $this->std->ideproc->nrproctrab,
            true
        );
        $this->dom->addChild(
            $ideProc,
            "perApurPgto",
            $this->std->ideproc->perapurpgto,
            true
        );
        $this->node->appendChild($ideProc);        
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign(); 
    }
}
