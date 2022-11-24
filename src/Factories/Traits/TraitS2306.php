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
            $this->std->idetrabsemvinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideTrabSemVinculo,
            "matricula",
            !empty($this->std->idetrabsemvinculo->matricula) ? $this->std->idetrabsemvinculo->matricula : null,
            false
        );
        $this->dom->addChild(
            $ideTrabSemVinculo,
            "codCateg",
            !empty($this->std->idetrabsemvinculo->codcateg) ? $this->std->idetrabsemvinculo->codcateg : null,
            false
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
        $infoComplementares = null;

        if (isset($this->std->infotsvalteracao->infocomplementares->cargofuncao)) {
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $stdCargofuncao = $this->std->infotsvalteracao->infocomplementares->cargofuncao;
            $cargoFuncao = $this->dom->createElement("cargoFuncao");

            if (isset($stdCargofuncao->nmcargo) && !empty($stdCargofuncao->nmcargo)) {
                $this->dom->addChild(
                    $cargoFuncao,
                    "nmCargo",
                    $stdCargofuncao->nmcargo,
                    true
                );
            }

            if (isset($stdCargofuncao->cbocargo) && !empty($stdCargofuncao->cbocargo)) {
                $this->dom->addChild(
                    $cargoFuncao,
                    "CBOCargo",
                    $stdCargofuncao->cbocargo,
                    true
                );
            }

            if (isset($stdCargofuncao->nmfuncao) && !empty($stdCargofuncao->nmfuncao)) {
                $this->dom->addChild(
                    $cargoFuncao,
                    "nmFuncao",
                    !empty($stdCargofuncao->nmfuncao) ? $stdCargofuncao->nmfuncao : null,
                    false
                );
            }

            if (isset($stdCargofuncao->cbofuncao) && !empty($stdCargofuncao->cbofuncao)) {
                $this->dom->addChild(
                    $cargoFuncao,
                    "CBOFuncao",
                    $stdCargofuncao->cbofuncao,
                    true
                );
            }

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
                !empty($stdRemuneracao->dscsalvar) ? $stdRemuneracao->dscsalvar : null,
                false
            );
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoComplementares->appendChild($remuneracao);
        }

        if (!empty($this->std->infoComplementares->dirigentesindical)) {
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


        if (!empty($this->std->infoComplementares->trabcedido)) {
            $trab = $this->std->infoComplementares->trabcedido;
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

        if (!empty($this->std->infoComplementares->mandelet)) {
            $mand = $this->std->infoComplementares->mandelet;
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

        if (isset($this->std->infotsvalteracao->infocomplementares->infoestagiario)) {
            $stdEstagiario = $this->std->infotsvalteracao->infocomplementares->infoestagiario;
            $infoEstagiario = $this->dom->createElement("infoEstagiario");

            $this->dom->addChild(
                $infoEstagiario,
                "natEstagio",
                $stdEstagiario->natestagio,
                true
            );

            if (isset($stdEstagiario->nivestagio) && !empty($stdEstagiario->nivestagio)) {
                $this->dom->addChild(
                    $infoEstagiario,
                    "nivEstagio",
                    $stdEstagiario->nivestagio,
                    true
                );
            }

            if (isset($stdEstagiario->areaatuacao) && !empty($stdEstagiario->areaatuacao)) {
                $this->dom->addChild(
                    $infoEstagiario,
                    "areaAtuacao",
                    !empty($stdEstagiario->areaatuacao) ? $stdEstagiario->areaatuacao : null,
                    false
                );
            }

            if (isset($stdEstagiario->nrapol) && !empty($stdEstagiario->nrapol)) {
                $this->dom->addChild(
                    $infoEstagiario,
                    "nrApol",
                    !empty($stdEstagiario->nrapol) ? $stdEstagiario->nrapol : null,
                    false
                );
            }

            $this->dom->addChild(
                $infoEstagiario,
                "dtPrevTerm",
                $stdEstagiario->dtprevterm,
                true
            );

            if (isset($stdEstagiario->instensino)) {
                $instEnsino = $this->dom->createElement("instEnsino");

                if (isset($stdEstagiario->instensino->cnpjinstensino) && !empty($stdEstagiario->instensino->cnpjinstensino)) {
                    $this->dom->addChild(
                        $instEnsino,
                        "cnpjInstEnsino",
                        $stdEstagiario->instensino->cnpjinstensino,
                        true
                    );
                }

                if (isset($stdEstagiario->instensino->nmrazao) && !empty($stdEstagiario->instensino->nmrazao)) {
                    $this->dom->addChild(
                        $instEnsino,
                        "nmRazao",
                        $stdEstagiario->instensino->nmrazao,
                        true
                    );
                }

                if (isset($stdEstagiario->instensino->dsclograd) && !empty($stdEstagiario->instensino->dsclograd)) {
                    $this->dom->addChild(
                        $instEnsino,
                        "dscLograd",
                        !empty($stdEstagiario->instensino->dsclograd) ?
                            $stdEstagiario->instensino->dsclograd : null,
                        false
                    );
                }

                if (isset($stdEstagiario->instensino->nrlograd) && !empty($stdEstagiario->instensino->nrlograd)) {
                    $this->dom->addChild(
                        $instEnsino,
                        "nrLograd",
                        !empty($stdEstagiario->instensino->nrlograd) ?
                            $stdEstagiario->instensino->nrlograd : null,
                        false
                    );
                }

                if (isset($stdEstagiario->instensino->bairro) && !empty($stdEstagiario->instensino->bairro)) {
                    $this->dom->addChild(
                        $instEnsino,
                        "bairro",
                        !empty($stdEstagiario->instensino->bairro) ? $stdEstagiario->instensino->bairro :
                            null,
                        false
                    );
                }

                if (isset($stdEstagiario->instensino->cep) && !empty($stdEstagiario->instensino->cep)) {
                    $this->dom->addChild(
                        $instEnsino,
                        "cep",
                        !empty($stdEstagiario->instensino->cep) ? $stdEstagiario->instensino->cep : null,
                        false
                    );
                }

                if (isset($stdEstagiario->instensino->codmunic) && !empty($stdEstagiario->instensino->codmunic)) {
                    $this->dom->addChild(
                        $instEnsino,
                        "codMunic",
                        !empty($stdEstagiario->instensino->codmunic) ?
                            $stdEstagiario->instensino->codmunic : null,
                        false
                    );
                }

                if (isset($stdEstagiario->instensino->uf) && !empty($stdEstagiario->instensino->uf)) {
                    $this->dom->addChild(
                        $instEnsino,
                        "uf",
                        !empty($stdEstagiario->instensino->uf) ? $stdEstagiario->instensino->uf : null,
                        false
                    );
                }

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
