<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1060
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

        $ide = $this->dom->createElement("ideAmbiente");
        $this->dom->addChild(
            $ide,
            "codAmb",
            $this->std->codamb,
            true
        );
        $this->dom->addChild(
            $ide,
            "iniValid",
            $this->std->inivalid,
            true
        );
        $this->dom->addChild(
            $ide,
            "fimValid",
            ! empty($this->std->fimvalid) ? $this->std->fimvalid : null,
            false
        );
        $dados = null;
        if (!empty($this->std->dadosambiente)) {
            $da = $this->std->dadosambiente;
            $dados = $this->dom->createElement("dadosAmbiente");
            //incluso em 2.5.0
            $this->dom->addChild(
                $dados,
                "nmAmb",
                !empty($da->nmamb) ? $da->nmamb : null,
                !empty($da->nmamb) ? true : false
            );
            $this->dom->addChild(
                $dados,
                "dscAmb",
                $da->dscamb,
                true
            );
            $this->dom->addChild(
                $dados,
                "localAmb",
                $da->localamb,
                true
            );
            $this->dom->addChild(
                $dados,
                "tpInsc",
                !empty($da->tpinsc) ? $da->tpinsc : null,
                false
            );
            $this->dom->addChild(
                $dados,
                "nrInsc",
                !empty($da->nrinsc) ? $da->nrinsc : null,
                false
            );
            //incluso em 2.5.0
            $this->dom->addChild(
                $dados,
                "codLotacao",
                !empty($da->codlotacao) ? $da->codlotacao : null,
                false
            );
        }
        $nova = null;
        if (!empty($this->std->novavalidade)) {
            $nova = $this->dom->createElement("novaValidade");
            $this->dom->addChild(
                $nova,
                "iniValid",
                $this->std->novavalidade->inivalid,
                true
            );
            $this->dom->addChild(
                $nova,
                "fimValid",
                ! empty($this->std->novavalidade->fimvalid)
                    ? $this->std->novavalidade->fimvalid
                    : null,
                false
            );
        }
        $info = $this->dom->createElement("infoAmbiente");
        //seleção do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
            $node->appendChild($ide);
            if (!empty($dados)) {
                $node->appendChild($dados);
            }
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
            $node->appendChild($ide);
            if (!empty($dados)) {
                $node->appendChild($dados);
            }
            if (!empty($nova)) {
                $node->appendChild($nova);
            }
        } else {
            $node = $this->dom->createElement("exclusao");
            $node->appendChild($ide);
        }
        $info->appendChild($node);
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
