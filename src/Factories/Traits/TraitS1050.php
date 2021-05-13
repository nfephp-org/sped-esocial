<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1050
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
        $ide = $this->dom->createElement("ideHorContratual");
        $this->dom->addChild(
            $ide,
            "codHorContrat",
            $this->std->codhorcontrat,
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
            !empty($this->std->fimvalid) ? $this->std->fimvalid : null,
            false
        );
        $dados = '';
        if (!empty($this->std->dadoshorcontratual)) {
            $da = $this->std->dadoshorcontratual;
            $dados = $this->dom->createElement("dadosHorContratual");
            $this->dom->addChild(
                $dados,
                "hrEntr",
                $da->hrentr,
                true
            );
            $this->dom->addChild(
                $dados,
                "hrSaida",
                $da->hrsaida,
                true
            );
            $this->dom->addChild(
                $dados,
                "durJornada",
                $da->durjornada,
                true
            );
            $this->dom->addChild(
                $dados,
                "perHorFlexivel",
                $da->perhorflexivel,
                true
            );
            if (!empty($da->horariointervalo)) {
                foreach ($da->horariointervalo as $inter) {
                    $intervalo = $this->dom->createElement("horarioIntervalo");
                    $this->dom->addChild(
                        $intervalo,
                        "tpInterv",
                        $inter->tpinterv,
                        true
                    );
                    $this->dom->addChild(
                        $intervalo,
                        "durInterv",
                        $inter->durinterv,
                        true
                    );
                    $this->dom->addChild(
                        $intervalo,
                        "iniInterv",
                        !empty($inter->iniinterv) ? $inter->iniinterv : null,
                        false
                    );
                    $this->dom->addChild(
                        $intervalo,
                        "termInterv",
                        !empty($inter->terminterv) ? $inter->terminterv : null,
                        false
                    );
                    $dados->appendChild($intervalo);
                }
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
        $info = $this->dom->createElement("infoHorContratual");
        //seleção do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
            $node->appendChild($ide);
            $node->appendChild($dados);
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
            $node->appendChild($ide);
            $node->appendChild($dados);
            if (isset($nova)) {
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
