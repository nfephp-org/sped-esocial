<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1030
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

        $ide = $this->dom->createElement("ideCargo");
        $this->dom->addChild(
            $ide,
            "codCargo",
            $this->std->codcargo,
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


        if (!empty($this->std->dadoscargo)) {
            $da = $this->std->dadoscargo;
            $dados = $this->dom->createElement("dadosCargo");
            $this->dom->addChild(
                $dados,
                "nmCargo",
                $da->nmcargo,
                true
            );
            $this->dom->addChild(
                $dados,
                "codCBO",
                $da->codcbo,
                true
            );
            if (!empty($da->cargopublico)) {
                $cpub = $this->dom->createElement("cargoPublico");
                $this->dom->addChild(
                    $cpub,
                    "acumCargo",
                    $da->cargopublico->acumcargo,
                    true
                );
                $this->dom->addChild(
                    $cpub,
                    "contagemEsp",
                    $da->cargopublico->contagemesp,
                    true
                );
                $this->dom->addChild(
                    $cpub,
                    "dedicExcl",
                    $da->cargopublico->dedicexcl,
                    true
                );
                $lei = $this->dom->createElement("leiCargo");
                $this->dom->addChild(
                    $lei,
                    "nrLei",
                    $da->cargopublico->nrlei,
                    true
                );
                $this->dom->addChild(
                    $lei,
                    "dtLei",
                    $da->cargopublico->dtlei,
                    true
                );
                $this->dom->addChild(
                    $lei,
                    "sitCargo",
                    $da->cargopublico->sitcargo,
                    true
                );
                $cpub->appendChild($lei);
                $dados->appendChild($cpub);
            }
        }

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

        $info = $this->dom->createElement("infoCargo");
        //seleção do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
            $node->appendChild($ide);
            isset($dados) ? $node->appendChild($dados) : null;
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
            $node->appendChild($ide);
            isset($dados) ? $node->appendChild($dados): null;
            isset($nova) ? $node->appendChild($nova): null;
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
