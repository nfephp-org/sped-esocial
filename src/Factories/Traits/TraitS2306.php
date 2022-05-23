<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2306
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
            "nisTrab",
            !empty($this->std->trabsemvinculo->nistrab) ? $this->std->trabsemvinculo->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ideTrabSemVinculo,
            "codCateg",
            !empty($this->std->trabsemvinculo->codcateg) ? $this->std->trabsemvinculo->codcateg : null,
            false
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
        $infoComplementares = $this->dom->createElement("infoComplementares");
        $infoTSVAlteracao->appendChild($infoComplementares);
        if (isset($this->std->cargofuncao)) {
            $cargoFuncao = $this->dom->createElement("cargoFuncao");
            $this->dom->addChild(
                $cargoFuncao,
                "codCargo",
                $this->std->cargofuncao->codcargo,
                true
            );
            $this->dom->addChild(
                $cargoFuncao,
                "codFuncao",
                !empty($this->std->cargofuncao->codfuncao) ? $this->std->cargofuncao->codfuncao : null,
                false
            );
            $infoComplementares->appendChild($cargoFuncao);
        }
        if (isset($this->std->remuneracao)) {
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
            $infoComplementares->appendChild($remuneracao);
        }
        if (isset($this->std->estagiario)) {
            $infoEstagiario = $this->dom->createElement("infoEstagiario");
            $this->dom->addChild(
                $infoEstagiario,
                "natEstagio",
                $this->std->estagiario->natestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nivEstagio",
                $this->std->estagiario->nivestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "areaAtuacao",
                !empty($this->std->estagiario->areaatuacao) ? $this->std->estagiario->areaatuacao : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nrApol",
                !empty($this->std->estagiario->nrapol) ? $this->std->estagiario->nrapol : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "vlrBolsa",
                !empty($this->std->estagiario->vlrbolsa) ? $this->std->estagiario->vlrbolsa : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "dtPrevTerm",
                $this->std->estagiario->dtprevterm,
                true
            );
            if (isset($this->std->estagiario->instituicao)) {
                $instEnsino = $this->dom->createElement("instEnsino");
                $this->dom->addChild(
                    $instEnsino,
                    "cnpjInstEnsino",
                    $this->std->estagiario->instituicao->cnpjinstensino,
                    true
                );
                $this->dom->addChild(
                    $instEnsino,
                    "nmRazao",
                    $this->std->estagiario->instituicao->nmrazao,
                    true
                );
                $this->dom->addChild(
                    $instEnsino,
                    "dscLograd",
                    !empty($this->std->estagiario->instituicao->dsclograd) ?
                        $this->std->estagiario->instituicao->dsclograd : null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "nrLograd",
                    !empty($this->std->estagiario->instituicao->nrlograd) ?
                        $this->std->estagiario->instituicao->nrlograd : null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "bairro",
                    !empty($this->std->estagiario->instituicao->bairro) ? $this->std->estagiario->instituicao->bairro :
                        null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "cep",
                    !empty($this->std->estagiario->instituicao->cep) ? $this->std->estagiario->instituicao->cep : null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "codMunic",
                    !empty($this->std->estagiario->instituicao->codmunic) ?
                        $this->std->estagiario->instituicao->codmunic : null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "uf",
                    !empty($this->std->estagiario->instituicao->uf) ? $this->std->estagiario->instituicao->uf : null,
                    false
                );
                $infoEstagiario->appendChild($instEnsino);
            }
            if (isset($this->std->estagiario->ageintegracao)) {
                $ageIntegracao = $this->dom->createElement("ageIntegracao");
                $this->dom->addChild(
                    $ageIntegracao,
                    "cnpjAgntInteg",
                    $this->std->estagiario->ageintegracao->cnpjagntinteg,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "nmRazao",
                    $this->std->estagiario->ageintegracao->nmrazao,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "dscLograd",
                    $this->std->estagiario->ageintegracao->dsclograd,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "nrLograd",
                    $this->std->estagiario->ageintegracao->nrlograd,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "bairro",
                    !empty($this->std->estagiario->ageintegracao->bairro) ?
                        $this->std->estagiario->ageintegracao->bairro : null,
                    false
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "cep",
                    $this->std->estagiario->ageintegracao->cep,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "codMunic",
                    $this->std->estagiario->ageintegracao->codmunic,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "uf",
                    $this->std->estagiario->ageintegracao->uf,
                    true
                );
                $infoEstagiario->appendChild($ageIntegracao);
            }
            if (isset($this->std->estagiario->supervisor)) {
                $supervisorEstagio = $this->dom->createElement("supervisorEstagio");
                $this->dom->addChild(
                    $supervisorEstagio,
                    "cpfSupervisor",
                    $this->std->estagiario->supervisor->cpfsupervisor,
                    true
                );
                $this->dom->addChild(
                    $supervisorEstagio,
                    "nmSuperv",
                    $this->std->estagiario->supervisor->nmsuperv,
                    true
                );
                $infoEstagiario->appendChild($supervisorEstagio);
            }
            $infoComplementares->appendChild($infoEstagiario);
        }
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
            !empty($this->std->trabsemvinculo->codcateg) ? $this->std->trabsemvinculo->codcateg : null,
            false
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
            if (empty($ens->cnpjinstensino)) {
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
            }
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
