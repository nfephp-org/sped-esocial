<?php

namespace NFePHP\eSocial\Factories\Traits;

use NFePHP\eSocial\Common\FactoryId;

trait TraitS2306
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

        $evtTSVAltContr = $this->dom->createElement("evtTSVAltContr");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtTSVAltContr->appendChild($att);

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);

        $ideEvento = $this->dom->createElement("ideEvento");

        $this->dom->addChild(
            $ideEvento,
            "indRetif",
            $this->std->indretif,
            true
        );

        if (isset($this->std->nrrecibo)) {
            $this->dom->addChild(
              $ideEvento,
              "nrRecibo",
              $this->std->nrrecibo,
              false
            );
        }

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

        $ideTrabSemVinculo = $this->dom->createElement("ideTrabSemVinculo");

        $this->dom->addChild(
            $ideTrabSemVinculo,
            "cpfTrab",
            $this->std->idetrabsemvinculo->cpftrab,
            true
        );

        $this->dom->addChild(
            $ideTrabSemVinculo,
            "nisTrab",
            !empty($this->std->idetrabsemvinculo->nistrab) ? $this->std->idetrabsemvinculo->nistrab : null,
            false
        );

        $this->dom->addChild(
            $ideTrabSemVinculo,
            "codCateg",
            $this->std->idetrabsemvinculo->codcateg,
            true
        );

        $this->node->appendChild($ideTrabSemVinculo);

        $infoTSVAlteracao = $this->dom->createElement("infoTSVAlteracao");

        $this->dom->addChild(
            $infoTSVAlteracao,
            "dtAlteracao",
            $this->std->infotsvalteracao->dtalteracao,
            true
        );

        $this->dom->addChild(
            $infoTSVAlteracao,
            "natAtividade",
            !empty($this->std->infotsvalteracao->natatividade) ? $this->std->infotsvalteracao->natatividade : null,
            false
        );

        $infoComplementares = $this->dom->createElement("infoComplementares");

        if (isset($this->std->infotsvalteracao->infocomplementares->cargofuncao)) {
            $stdCargofuncao = $this->std->infotsvalteracao->infocomplementares->cargofuncao;
            $cargoFuncao = $this->dom->createElement("cargoFuncao");

            $this->dom->addChild(
                $cargoFuncao,
                "codCargo",
                $stdCargofuncao->codcargo,
                true
            );

            $this->dom->addChild(
                $cargoFuncao,
                "codFuncao",
                !empty($stdCargofuncao->codfuncao) ? $stdCargofuncao->codfuncao : null,
                false
            );

            $infoComplementares->appendChild($cargoFuncao);
        }

        if (isset($this->std->infotsvalteracao->infocomplementares->remuneracao)) {
            $remuneracao = $this->dom->createElement("remuneracao");
            $stdRemuneracao = $this->std->infotsvalteracao->infocomplementares->remuneracao;

            $this->dom->addChild(
                $remuneracao,
                "vrSalFx",
                $stdRemuneracao->vrsalfx,
                true
            );

            $this->dom->addChild(
                $remuneracao,
                "undSalFixo",
                $stdRemuneracao->undsalfixo,
                true
            );

            $this->dom->addChild(
                $remuneracao,
                "dscSalVar",
                !empty($stdRemuneracao->dscsalVar) ? $stdRemuneracao->dscsalVar : null,
                false
            );

            $infoComplementares->appendChild($remuneracao);
        }

        if (isset($this->std->infotsvalteracao->infocomplementares->infoestagiario)) {
            $stdEstagiario = $this->std->infotsvalteracao->infocomplementares->infoestagiario;
            $infoEstagiario = $this->dom->createElement("infoEstagiario");

            $this->dom->addChild(
                $infoEstagiario,
                "natEstagio",
                $stdEstagiario->natestagio,
                true
            );

            $this->dom->addChild(
                $infoEstagiario,
                "nivEstagio",
                $stdEstagiario->nivestagio,
                true
            );

            $this->dom->addChild(
                $infoEstagiario,
                "areaAtuacao",
                !empty($stdEstagiario->areaatuacao) ? $stdEstagiario->areaatuacao : null,
                false
            );

            $this->dom->addChild(
                $infoEstagiario,
                "nrApol",
                !empty($stdEstagiario->nrapol) ? $stdEstagiario->nrapol : null,
                false
            );

            $this->dom->addChild(
                $infoEstagiario,
                "vlrBolsa",
                !empty($stdEstagiario->vlrbolsa) ? $stdEstagiario->vlrbolsa : null,
                false
            );

            $this->dom->addChild(
                $infoEstagiario,
                "dtPrevTerm",
                $stdEstagiario->dtprevterm,
                true
            );

            if (isset($stdEstagiario->instensino)) {
                $instEnsino = $this->dom->createElement("instEnsino");

                $this->dom->addChild(
                    $instEnsino,
                    "cnpjInstEnsino",
                    $stdEstagiario->instensino->cnpjinstensino,
                    true
                );

                $this->dom->addChild(
                    $instEnsino,
                    "nmRazao",
                    $stdEstagiario->instensino->nmrazao,
                    true
                );

                $this->dom->addChild(
                    $instEnsino,
                    "dscLograd",
                    !empty($stdEstagiario->instensino->dsclograd) ?
                        $stdEstagiario->instensino->dsclograd : null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "nrLograd",
                    !empty($stdEstagiario->instensino->nrlograd) ?
                        $stdEstagiario->instensino->nrlograd : null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "bairro",
                    !empty($stdEstagiario->instensino->bairro) ? $stdEstagiario->instensino->bairro :
                        null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "cep",
                    !empty($stdEstagiario->instensino->cep) ? $stdEstagiario->instensino->cep : null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "codMunic",
                    !empty($stdEstagiario->instensino->codmunic) ?
                        $stdEstagiario->instensino->codmunic : null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "uf",
                    !empty($stdEstagiario->instensino->uf) ? $stdEstagiario->instensino->uf : null,
                    false
                );

                $infoEstagiario->appendChild($instEnsino);
            }

            if (isset($stdEstagiario->ageintegracao)) {
                $ageIntegracao = $this->dom->createElement("ageIntegracao");

                $this->dom->addChild(
                    $ageIntegracao,
                    "cnpjAgntInteg",
                    $stdEstagiario->ageintegracao->cnpjagntinteg,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "nmRazao",
                    $stdEstagiario->ageintegracao->nmrazao,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "dscLograd",
                    $stdEstagiario->ageintegracao->dsclograd,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "nrLograd",
                    $stdEstagiario->ageintegracao->nrlograd,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "bairro",
                    !empty($stdEstagiario->ageintegracao->bairro) ?
                        $stdEstagiario->ageintegracao->bairro : null,
                    false
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "cep",
                    $stdEstagiario->ageintegracao->cep,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "codMunic",
                    $stdEstagiario->ageintegracao->codmunic,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "uf",
                    $stdEstagiario->ageintegracao->uf,
                    true
                );

                $infoEstagiario->appendChild($ageIntegracao);
            }

            if (isset($stdEstagiario->supervisorestagio)) {
                $supervisorEstagio = $this->dom->createElement("supervisorEstagio");

                $this->dom->addChild(
                    $supervisorEstagio,
                    "cpfSupervisor",
                    $stdEstagiario->supervisorestagio->cpfsupervisor,
                    true
                );

                $this->dom->addChild(
                    $supervisorEstagio,
                    "nmSuperv",
                    $stdEstagiario->supervisorestagio->nmsuperv,
                    true
                );


                $infoEstagiario->appendChild($supervisorEstagio);
            }

            $infoComplementares->appendChild($infoEstagiario);
        }

        $infoTSVAlteracao->appendChild($infoComplementares);
        $this->node->appendChild($infoTSVAlteracao);

        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
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
        if ($this->std->indretif == 2) {
            $this->dom->addChild(
                $ideEvento,
                "nrRecibo",
                $this->std->nrrecibo,
                true
            );
        }
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
        $ideTrabSemVinculo = $this->dom->createElement("ideTrabSemVinculo");
        $this->dom->addChild(
            $ideTrabSemVinculo,
            "cpfTrab",
            $this->std->trabsemvinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideTrabSemVinculo,
            "matricula",
            !empty($this->std->trabsemvinculo->matricula) ? $this->std->trabsemvinculo->matricula : null,
            false
        );
        $this->dom->addChild(
            $ideTrabSemVinculo,
            "codCateg",
            $this->std->trabsemvinculo->codcateg,
            true
        );
        $this->node->appendChild($ideTrabSemVinculo);
        $infoTSVAlteracao = $this->dom->createElement("infoTSVAlteracao");
        $this->dom->addChild(
            $infoTSVAlteracao,
            "dtAlteracao",
            $this->std->tsvalteracao->dtalteracao,
            true
        );
        $this->dom->addChild(
            $infoTSVAlteracao,
            "natAtividade",
            !empty($this->std->tsvalteracao->natatividade) ? $this->std->tsvalteracao->natatividade : null,
            false
        );
        $infoComplementares = null;
        if (!empty($this->std->cargofuncao)) {
            $carg = $this->std->cargofuncao;
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $cargoFuncao  = $this->dom->createElement("cargoFuncao");
            $this->dom->addChild(
                $cargoFuncao,
                "nmCargo",
                !empty($carg->nmcargo) ? $carg->nmcargo : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "CBOCargo",
                !empty($carg->cbocargo) ? $carg->cbocargo : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "nmFuncao",
                !empty($carg->nmfuncao) ? $carg->nmfuncao : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "CBOFuncao",
                !empty($carg->cbofuncao) ? $carg->cbofuncao : null,
                false
            );
            $infoComplementares->appendChild($cargoFuncao);
        }
        if (!empty($this->std->remuneracao)) {
            $remun = $this->std->remuneracao;
            $remuneracao = $this->dom->createElement("remuneracao");
            $this->dom->addChild(
                $remuneracao,
                "vrSalFx",
                $this->std->remuneracao->vrsalfx,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "undSalFixo",
                $this->std->remuneracao->undsalfixo,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "dscSalVar",
                !empty($this->std->remuneracao->dscsalvar) ? $this->std->remuneracao->dscsalvar : null,
                false
            );
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoComplementares->appendChild($remuneracao);
        }
        if (!empty($this->std->dirigentesindical)) {
            $sind = $this->std->dirigentesindical;
            $infoDirigenteSindical = $this->dom->createElement("infoDirigenteSindical");
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpRegPrev",
                $sind->tpregprev,
                true
            );
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoComplementares->appendChild($infoDirigenteSindical);
        }
        if (!empty($this->std->trabcedido)) {
            $trab = $this->std->trabcedido;
            $infoTrabCedido = $this->dom->createElement("infoTrabCedido");
            $this->dom->addChild(
                $infoTrabCedido,
                "tpRegPrev",
                $trab->tpregprev,
                true
            );
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoComplementares->appendChild($infoTrabCedido);
        }
        if (!empty($this->std->mandelet)) {
            $mand = $this->std->mandelet;
            $infoMandElet = $this->dom->createElement("infoMandElet");
            $this->dom->addChild(
                $infoMandElet,
                "indRemunCargo",
                !empty($mand->indremuncargo) ? $mand->indremuncargo : null,
                false
            );
            $this->dom->addChild(
                $infoMandElet,
                "tpRegPrev",
                $mand->tpregprev,
                true
            );
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoComplementares->appendChild($infoMandElet);
        }
        if (!empty($this->std->estagiario)) {
            $estag = $this->std->estagiario;
            $infoEstagiario = $this->dom->createElement("infoEstagiario");
            $this->dom->addChild(
                $infoEstagiario,
                "natEstagio",
                $estag->natestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nivEstagio",
                $estag->nivestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "areaAtuacao",
                !empty($estag->areaatuacao) ? $estag->areaatuacao : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nrApol",
                !empty($estag->nrapol) ? $estag->nrapol : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "dtPrevTerm",
                $estag->dtprevterm,
                true
            );
            $ens = $estag->instensino;
            $instEnsino = $this->dom->createElement("instEnsino");
            $this->dom->addChild(
                $instEnsino,
                "cnpjInstEnsino",
                !empty($ens->cnpjinstensino) ? $ens->cnpjinstensino : null,
                false
            );
            $this->dom->addChild(
                $instEnsino,
                "nmRazao",
                !empty($ens->nmrazao) ? $ens->nmrazao : null,
                false
            );
            $this->dom->addChild(
                $instEnsino,
                "dscLograd",
                !empty($ens->dsclograd) ? $ens->dsclograd : null,
                false
            );
            $this->dom->addChild(
                $instEnsino,
                "nrLograd",
                !empty($ens->nrlograd) ? $ens->nrlograd : null,
                false
            );
            $this->dom->addChild(
                $instEnsino,
                "bairro",
                !empty($ens->bairro) ? $ens->bairro : null,
                false
            );
            $this->dom->addChild(
                $instEnsino,
                "cep",
                !empty($ens->cep) ? $ens->cep : null,
                false
            );
            $this->dom->addChild(
                $instEnsino,
                "codMunic",
                !empty($ens->codmunic) ? $ens->codmunic : null,
                false
            );
            $this->dom->addChild(
                $instEnsino,
                "uf",
                !empty($ens->uf) ? $ens->uf : null,
                false
            );
            $infoEstagiario->appendChild($instEnsino);
            if (!empty($estag->ageintegracao)) {
                $ageIntegracao = $this->dom->createElement("ageIntegracao");
                $this->dom->addChild(
                    $ageIntegracao,
                    "cnpjAgntInteg",
                    $estag->ageintegracao->cnpjagntinteg,
                    true
                );
                $infoEstagiario->appendChild($ageIntegracao);
            }
            if (!empty($estag->supervisorestagio)) {
                $supervisorEstagio = $this->dom->createElement("supervisorEstagio");
                $this->dom->addChild(
                    $supervisorEstagio,
                    "cpfSupervisor",
                    $estag->supervisorestagio->cpfsupervisor,
                    true
                );
                $infoEstagiario->appendChild($supervisorEstagio);
            }
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoComplementares->appendChild($infoEstagiario);
        }
        
        if (!empty($infoComplementares)) {
            $infoTSVAlteracao->appendChild($infoComplementares);
        }
        
        $this->node->appendChild($infoTSVAlteracao);
        
        $this->node->appendChild($infoTSVAlteracao);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
