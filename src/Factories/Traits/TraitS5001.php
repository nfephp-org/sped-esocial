<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS5001
{

    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão 2.5.0 !!");
    }

    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão 1.0.0 !!");
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
            "nrRecArqBase",
            $this->std->nrrecarqbase,
            true
        );
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
        $this->node->insertBefore($ideEvento, $ideEmpregador);
        $ide = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ide,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->node->appendChild($ide);
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
