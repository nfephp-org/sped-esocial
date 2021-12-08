<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2231
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        throw new \Exception("Este evento não existem na versão 2.5");
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
            !empty($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->node->appendChild($ideVinculo);
        $info = $this->dom->createElement("infoCessao");
        if (!empty($this->std->inicessao)) {
            $ini = $this->dom->createElement("iniCessao");
            $this->dom->addChild(
                $ini,
                "dtIniCessao",
                $this->std->inicessao->dtinicessao,
                true
            );
            $this->dom->addChild(
                $ini,
                "cnpjCess",
                $this->std->inicessao->cnpjcess,
                true
            );
            $this->dom->addChild(
                $ini,
                "respRemun",
                $this->std->inicessao->respremun,
                true
            );
            $info->appendChild($ini);
        }
        if (empty($this->std->inicessao) && !empty($this->std->fimcessao)) {
            $fim = $this->dom->createElement("fimCessao");
            $this->dom->addChild(
                $fim,
                "dtTermCesssao",
                $this->std->fimcessao->dttermcessao,
                true
            );
            $info->appendChild($fim);
        }
        $this->node->appendChild($info);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
