<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1300
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );

        $evtContrSindPatr = $this->dom->createElement("evtContrSindPatr");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtContrSindPatr->appendChild($att);

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);

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
            !empty($this->std->ideempregador->nrrecibo) ? $this->std->ideempregador->nrrecibo : null,
            false
        );
        $this->dom->addChild(
            $ideEvento,
            "indApuracao",
            $this->std->ideempregador->indapuracao,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "perApur",
            $this->std->ideempregador->perapur,
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

        if (isset($this->std->contribsind)) {
            foreach ($this->std->contribsind as $contrib) {
                $contribSind = $this->dom->createElement("contribSind");

                $this->dom->addChild(
                    $contribSind,
                    "cnpjSindic",
                    $contrib->cnpjsindic,
                    true
                );

                $this->dom->addChild(
                    $contribSind,
                    "tpContribSind",
                    $contrib->tpcontribsind,
                    true
                );

                $this->dom->addChild(
                    $contribSind,
                    "vlrContribSind",
                    $contrib->vlrcontribsind,
                    true
                );

                $this->node->appendChild($contribSind);
            }
        }

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
