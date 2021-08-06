<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1020
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

        $ide = $this->dom->createElement("ideLotacao");
        $this->dom->addChild(
            $ide,
            "codLotacao",
            $this->std->idelotacao->codlotacao,
            true
        );
        $this->dom->addChild(
            $ide,
            "iniValid",
            $this->std->idelotacao->inivalid,
            true
        );
        $this->dom->addChild(
            $ide,
            "fimValid",
            ! empty($this->std->idelotacao->fimvalid) ? $this->std->idelotacao->fimvalid : null,
            false
        );


        if (!empty($this->std->dadoslotacao)) {
            $da = $this->std->dadoslotacao;

            $dados = $this->dom->createElement("dadosLotacao");
            $this->dom->addChild(
                $dados,
                "tpLotacao",
                $da->tplotacao,
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
            $fpasLotacao = $this->dom->createElement("fpasLotacao");

            $this->dom->addChild(
                $fpasLotacao,
                "fpas",
                $da->fpaslotacao->fpas,
                true
            );
            $this->dom->addChild(
                $fpasLotacao,
                "codTercs",
                $da->fpaslotacao->codtercs,
                true
            );
            $this->dom->addChild(
                $fpasLotacao,
                "codTercsSusp",
                !empty($da->fpaslotacao->codtercssusp) ? $da->fpaslotacao->codtercssusp : null,
                false
            );

            if (!empty($da->fpaslotacao->procjudterceiro)) {

                $procjud = $this->dom->createElement("infoProcJudTerceiros");
                foreach ($da->fpaslotacao->procjudterceiro as $proc) {
                    $pjt = $this->dom->createElement("procJudTerceiro");
                    $this->dom->addChild(
                        $pjt,
                        "codTerc",
                        $proc->codterc,
                        true
                    );
                    $this->dom->addChild(
                        $pjt,
                        "nrProcJud",
                        $proc->nrprocjud,
                        true
                    );
                    $this->dom->addChild(
                        $pjt,
                        "codSusp",
                        $proc->codsusp,
                        true
                    );
                    $procjud->appendChild($pjt);
                }
                $fpasLotacao->appendChild($procjud);
            }
            $dados->appendChild($fpasLotacao);

            if (!empty($da->infoemprparcial)) {
                $parcial = $this->dom->createElement("infoEmprParcial");
                $this->dom->addChild(
                    $parcial,
                    "tpInscContrat",
                    $da->infoemprparcial->tpinsccontrat,
                    true
                );
                $this->dom->addChild(
                    $parcial,
                    "nrInscContrat",
                    $da->infoemprparcial->nrinsccontrat,
                    true
                );
                $this->dom->addChild(
                    $parcial,
                    "tpInscProp",
                    $da->infoemprparcial->tpinscprop,
                    true
                );
                $this->dom->addChild(
                    $parcial,
                    "nrInscProp",
                    $da->infoemprparcial->nrinscprop,
                    true
                );
                $dados->appendChild($parcial);
            }
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

        $info = $this->dom->createElement("infoLotacao");
        //selecao do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
            $node->appendChild($ide);
            $node->appendChild($dados);
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
            $node->appendChild($ide);
            $node->appendChild($dados);
            if (!is_null($nova)) {
                $node->appendChild($nova);
            }
        } else {
            $node = $this->dom->createElement("exclusao");
            $node->appendChild($ide);
        }

        $info->appendChild($node);
        $this->node->appendChild($info);
        $this->eSocial->appendChild($this->node);

        $this->sign();
    }
}
