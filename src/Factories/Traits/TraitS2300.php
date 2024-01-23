<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2300
{
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
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
            !empty($this->std->nrrecibo) && ($this->std->indretif == 2) ? $this->std->nrrecibo : null,
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
        $trabalhador = $this->dom->createElement("trabalhador");
        $this->dom->addChild(
            $trabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmTrab",
            $this->std->nmtrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "sexo",
            $this->std->sexo,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "racaCor",
            $this->std->racacor,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "estCiv",
            !empty($this->std->estciv) ? $this->std->estciv : null,
            false
        );
        $this->dom->addChild(
            $trabalhador,
            "grauInstr",
            $this->std->grauinstr,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmSoc",
            !empty($this->std->nmsoc) ? $this->std->nmsoc : null,
            false
        );
        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->paisnac,
            true
        );
        $trabalhador->appendChild($nascimento);

        $endereco = $this->dom->createElement("endereco");
        if (!empty($this->std->endereco->brasil)) {
            $end = $this->std->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                !empty($end->tplograd) ? $end->tplograd : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $end->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $end->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($end->bairro) ? $end->bairro : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $end->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $end->codmunic,
                true
            );
            $this->dom->addChild(
                $brasil,
                "uf",
                $end->uf,
                true
            );
            $endereco->appendChild($brasil);
        } elseif (!empty($this->std->endereco->exterior)) {
            $end = $this->std->endereco->exterior;
            $exterior = $this->dom->createElement("exterior");
            $this->dom->addChild(
                $exterior,
                "paisResid",
                $end->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $end->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $end->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($end->bairro) ? $end->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $end->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                !empty($end->codpostal) ? $end->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $trabalhador->appendChild($endereco);

        if (!empty($this->std->trabimig)) {
            $trabimig = $this->dom->createElement("trabImig");
            $this->dom->addChild(
                $trabimig,
                "tmpResid",
                !empty($this->std->trabimig->tmpresid) ? $this->std->trabimig->tmpresid : null,
                false
            );
            $this->dom->addChild(
                $trabimig,
                "condIng",
                $this->std->trabimig->conding,
                true
            );
            $trabalhador->appendChild($trabimig);
        }

        if (!empty($this->std->infodeficiencia)) {
            $def = $this->std->infodeficiencia;
            $infoDeficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $infoDeficiencia,
                "defFisica",
                $def->deffisica,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defVisual",
                $def->defvisual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defAuditiva",
                $def->defauditiva,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defMental",
                $def->defmental,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defIntelectual",
                $def->defintelectual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "reabReadap",
                $def->reabreadap,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "observacao",
                !empty($def->observacao) ? $def->observacao : null,
                false
            );
            $trabalhador->appendChild($infoDeficiencia);
        }

        if (!empty($this->std->dependente)) {
            foreach ($this->std->dependente as $dep) {
                $dependente = $this->dom->createElement("dependente");
                $this->dom->addChild(
                    $dependente,
                    "tpDep",
                    $dep->tpdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "nmDep",
                    $dep->nmdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "dtNascto",
                    $dep->dtnascto,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "cpfDep",
                    !empty($dep->cpfdep) ? $dep->cpfdep : null,
                    false
                );
                $this->dom->addChild(
                    $dependente,
                    "depIRRF",
                    $dep->depirrf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "depSF",
                    $dep->depsf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "incTrab",
                    $dep->inctrab,
                    true
                );
                $trabalhador->appendChild($dependente);
            }
        }

        if (!empty($this->std->contato)) {
            $con = $this->std->contato;
            $contato = $this->dom->createElement("contato");
            $this->dom->addChild(
                $contato,
                "fonePrinc",
                !empty($con->foneprinc) ? $con->foneprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                !empty($con->emailprinc) ? $con->emailprinc : null,
                false
            );
            $trabalhador->appendChild($contato);
        }
        $this->node->appendChild($trabalhador);

        $infoTSVInicio = $this->dom->createElement("infoTSVInicio");
        $this->dom->addChild(
            $infoTSVInicio,
            "cadIni",
            $this->std->cadini,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "matricula",
            !empty($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "codCateg",
            $this->std->codcateg,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "dtInicio",
            $this->std->dtinicio,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "nrProcTrab",
            !empty($this->std->nrproctrab) ? $this->std->nrproctrab : null,
            false
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "natAtividade",
            !empty($this->std->natatividade) ? $this->std->natatividade : null,
            false
        );
        $infoComplementares = null;
        if (!empty($this->std->cargofuncao)) {
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $rem = $this->std->cargofuncao;
            $cargoFuncao = $this->dom->createElement("cargoFuncao");
            $this->dom->addChild(
                $cargoFuncao,
                "nmCargo",
                !empty($rem->nmcargo) ? $rem->nmcargo : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "CBOCargo",
                !empty($rem->cbocargo) ? $rem->cbocargo : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "nmFuncao",
                !empty($rem->nmfuncao) ? $rem->nmfuncao : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "CBOFuncao",
                !empty($rem->cbofuncao) ? $rem->cbofuncao : null,
                false
            );
            $infoComplementares->appendChild($cargoFuncao);
        }

        if (!empty($this->std->remuneracao)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $rem = $this->std->remuneracao;
            $remuneracao = $this->dom->createElement("remuneracao");
            $this->dom->addChild(
                $remuneracao,
                "vrSalFx",
                $rem->vrsalfx,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "undSalFixo",
                $rem->undsalfixo,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "dscSalVar",
                !empty($rem->dscsalvar) ? $rem->dscsalvar : null,
                false
            );
            $infoComplementares->appendChild($remuneracao);
        }

        if (!empty($this->std->fgts)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $fg = $this->std->fgts;
            $fgts = $this->dom->createElement("FGTS");
            $this->dom->addChild(
                $fgts,
                "dtOpcFGTS",
                $fg->dtopcfgts,
                true
            );
            $infoComplementares->appendChild($fgts);
        }

        if (!empty($this->std->infodirigentesindical)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $sind = $this->std->infodirigentesindical;
            $infoDirigenteSindical = $this->dom->createElement("infoDirigenteSindical");
            $this->dom->addChild(
                $infoDirigenteSindical,
                "categOrig",
                $sind->categorig,
                true
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpInsc",
                !empty($sind->tpinsc) ? $sind->tpinsc : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "nrInsc",
                !empty($sind->nrinsc) ? $sind->nrinsc : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "dtAdmOrig",
                !empty($sind->dtadmorig) ? $sind->dtadmorig : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "matricOrig",
                !empty($sind->matricorig) ? $sind->matricorig : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpRegTrab",
                !empty($sind->tpregtrab) ? $sind->tpregtrab : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpRegPrev",
                !empty($sind->tpregprev) ? $sind->tpregprev : null,
                false
            );
            $infoComplementares->appendChild($infoDirigenteSindical);
        }

        if (!empty($this->std->infotrabcedido)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoTrabCedido = $this->dom->createElement("infoTrabCedido");
            $this->dom->addChild(
                $infoTrabCedido,
                "categOrig",
                $this->std->infotrabcedido->categorig,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "cnpjCednt",
                $this->std->infotrabcedido->cnpjcednt,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "matricCed",
                $this->std->infotrabcedido->matricced,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "dtAdmCed",
                $this->std->infotrabcedido->dtadmced,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "tpRegTrab",
                $this->std->infotrabcedido->tpregtrab,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "tpRegPrev",
                $this->std->infotrabcedido->tpregprev,
                true
            );
            $infoComplementares->appendChild($infoTrabCedido);
        }

        if (!empty($this->std->infomandelet)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $man = $this->std->infomandelet;
            $mandelet = $this->dom->createElement("infoMandElet");
            $this->dom->addChild(
                $mandelet,
                "indRemunCargo",
                !empty($man->indremuncargo) ? $man->indremuncargo : null,
                false
            );
            $this->dom->addChild(
                $mandelet,
                "tpRegTrab",
                $man->tpregtrab,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "tpRegPrev",
                $man->tpregprev,
                true
            );
            $infoComplementares->appendChild($mandelet);
        }

        if (!empty($this->std->infoestagiario)) {
            $est = $this->std->infoestagiario;
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoEstagiario = $this->dom->createElement("infoEstagiario");
            $this->dom->addChild(
                $infoEstagiario,
                "natEstagio",
                $est->natestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nivEstagio",
                $est->nivestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "areaAtuacao",
                !empty($est->areaatuacao) ? $est->areaatuacao : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nrApol",
                !empty($est->nrapol) ? $est->nrapol : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "dtPrevTerm",
                $est->dtprevterm,
                true
            );
            $ens = $est->instensino;
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

            if (!empty($est->cnpjagntinteg)) {
                $ageIntegracao = $this->dom->createElement("ageIntegracao");
                $this->dom->addChild(
                    $ageIntegracao,
                    "cnpjAgntInteg",
                    $est->cnpjagntinteg,
                    true
                );
                $infoEstagiario->appendChild($ageIntegracao);
            }
            if (!empty($est->cpfsupervisor)) {
                $supervisorEstagio = $this->dom->createElement("supervisorEstagio");
                $this->dom->addChild(
                    $supervisorEstagio,
                    "cpfSupervisor",
                    $est->cpfsupervisor,
                    true
                );
                $infoEstagiario->appendChild($supervisorEstagio);
            }
            $infoComplementares->appendChild($infoEstagiario);
        }

        if (!empty($infoComplementares)) {
            $infoTSVInicio->appendChild($infoComplementares);
        }
        if (!empty($this->std->mudancacpf)) {
            $mudc = $this->std->mudancacpf;
            $mudancaCPF = $this->dom->createElement("mudancaCPF");
            $this->dom->addChild(
                $mudancaCPF,
                "cpfAnt",
                $mudc->cpfant,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "matricAnt",
                !empty($mudc->matricant) ? $mudc->matricant : null,
                false
            );
            $this->dom->addChild(
                $mudancaCPF,
                "dtAltCPF",
                $mudc->dtaltcpf,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "observacao",
                !empty($mudc->observacao) ? $mudc->observacao : null,
                false
            );
            $infoTSVInicio->appendChild($mudancaCPF);
        }
        if (!empty($this->std->afastamento)) {
            $afastamento = $this->dom->createElement("afastamento");
            $this->dom->addChild(
                $afastamento,
                "dtIniAfast",
                $this->std->afastamento->dtiniafast,
                true
            );
            $this->dom->addChild(
                $afastamento,
                "codMotAfast",
                $this->std->afastamento->codmotafast,
                true
            );
            $infoTSVInicio->appendChild($afastamento);
        }

        if (!empty($this->std->termino)) {
            $termino = $this->dom->createElement("termino");
            $this->dom->addChild(
                $termino,
                "dtTerm",
                $this->std->termino->dtterm,
                true
            );
            $infoTSVInicio->appendChild($termino);
        }

        $this->node->appendChild($infoTSVInicio);

        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
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
            !empty($this->std->nrrecibo) && ($this->std->indretif == 2) ? $this->std->nrrecibo : null,
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
        $trabalhador = $this->dom->createElement("trabalhador");
        $this->dom->addChild(
            $trabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmTrab",
            $this->std->nmtrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "sexo",
            $this->std->sexo,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "racaCor",
            $this->std->racacor,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "estCiv",
            !empty($this->std->estciv) ? $this->std->estciv : null,
            false
        );
        $this->dom->addChild(
            $trabalhador,
            "grauInstr",
            $this->std->grauinstr,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmSoc",
            !empty($this->std->nmsoc) ? $this->std->nmsoc : null,
            false
        );
        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->paisnac,
            true
        );
        $trabalhador->appendChild($nascimento);

        $endereco = $this->dom->createElement("endereco");
        if (!empty($this->std->endereco->brasil)) {
            $end = $this->std->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                !empty($end->tplograd) ? $end->tplograd : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $end->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $end->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($end->bairro) ? $end->bairro : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $end->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $end->codmunic,
                true
            );
            $this->dom->addChild(
                $brasil,
                "uf",
                $end->uf,
                true
            );
            $endereco->appendChild($brasil);
        } elseif (!empty($this->std->endereco->exterior)) {
            $end = $this->std->endereco->exterior;
            $exterior = $this->dom->createElement("exterior");
            $this->dom->addChild(
                $exterior,
                "paisResid",
                $end->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $end->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $end->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($end->bairro) ? $end->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $end->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                !empty($end->codpostal) ? $end->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $trabalhador->appendChild($endereco);

        if (!empty($this->std->trabimig)) {
            $trabimig = $this->dom->createElement("trabImig");
            $this->dom->addChild(
                $trabimig,
                "tmpResid",
                !empty($this->std->trabimig->tmpresid) ? $this->std->trabimig->tmpresid : null,
                false
            );
            $this->dom->addChild(
                $trabimig,
                "condIng",
                $this->std->trabimig->conding,
                true
            );
            $trabalhador->appendChild($trabimig);
        }

        if (!empty($this->std->infodeficiencia)) {
            $def = $this->std->infodeficiencia;
            $infoDeficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $infoDeficiencia,
                "defFisica",
                $def->deffisica,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defVisual",
                $def->defvisual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defAuditiva",
                $def->defauditiva,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defMental",
                $def->defmental,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defIntelectual",
                $def->defintelectual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "reabReadap",
                $def->reabreadap,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "observacao",
                !empty($def->observacao) ? $def->observacao : null,
                false
            );
            $trabalhador->appendChild($infoDeficiencia);
        }

        if (!empty($this->std->dependente)) {
            foreach ($this->std->dependente as $dep) {
                $dependente = $this->dom->createElement("dependente");
                $this->dom->addChild(
                    $dependente,
                    "tpDep",
                    $dep->tpdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "nmDep",
                    $dep->nmdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "dtNascto",
                    $dep->dtnascto,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "cpfDep",
                    !empty($dep->cpfdep) ? $dep->cpfdep : null,
                    false
                );
                $this->dom->addChild(
                    $dependente,
                    "depIRRF",
                    $dep->depirrf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "depSF",
                    $dep->depsf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "incTrab",
                    $dep->inctrab,
                    true
                );
                $trabalhador->appendChild($dependente);
            }
        }

        if (!empty($this->std->contato)) {
            $con = $this->std->contato;
            $contato = $this->dom->createElement("contato");
            $this->dom->addChild(
                $contato,
                "fonePrinc",
                !empty($con->foneprinc) ? $con->foneprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                !empty($con->emailprinc) ? $con->emailprinc : null,
                false
            );
            $trabalhador->appendChild($contato);
        }
        $this->node->appendChild($trabalhador);

        $infoTSVInicio = $this->dom->createElement("infoTSVInicio");
        $this->dom->addChild(
            $infoTSVInicio,
            "cadIni",
            $this->std->cadini,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "matricula",
            !empty($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "codCateg",
            $this->std->codcateg,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "dtInicio",
            $this->std->dtinicio,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "nrProcTrab",
            !empty($this->std->nrproctrab) ? $this->std->nrproctrab : null,
            false
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "natAtividade",
            !empty($this->std->natatividade) ? $this->std->natatividade : null,
            false
        );
        $infoComplementares = null;
        if (!empty($this->std->cargofuncao)) {
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $rem = $this->std->cargofuncao;
            $cargoFuncao = $this->dom->createElement("cargoFuncao");
            $this->dom->addChild(
                $cargoFuncao,
                "nmCargo",
                !empty($rem->nmcargo) ? $rem->nmcargo : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "CBOCargo",
                !empty($rem->cbocargo) ? $rem->cbocargo : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "nmFuncao",
                !empty($rem->nmfuncao) ? $rem->nmfuncao : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "CBOFuncao",
                !empty($rem->cbofuncao) ? $rem->cbofuncao : null,
                false
            );
            $infoComplementares->appendChild($cargoFuncao);
        }

        if (!empty($this->std->remuneracao)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $rem = $this->std->remuneracao;
            $remuneracao = $this->dom->createElement("remuneracao");
            $this->dom->addChild(
                $remuneracao,
                "vrSalFx",
                $rem->vrsalfx,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "undSalFixo",
                $rem->undsalfixo,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "dscSalVar",
                !empty($rem->dscsalvar) ? $rem->dscsalvar : null,
                false
            );
            $infoComplementares->appendChild($remuneracao);
        }

        if (!empty($this->std->fgts)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $fg = $this->std->fgts;
            $fgts = $this->dom->createElement("FGTS");
            $this->dom->addChild(
                $fgts,
                "dtOpcFGTS",
                $fg->dtopcfgts,
                true
            );
            $infoComplementares->appendChild($fgts);
        }

        if (!empty($this->std->infodirigentesindical)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $sind = $this->std->infodirigentesindical;
            $infoDirigenteSindical = $this->dom->createElement("infoDirigenteSindical");
            $this->dom->addChild(
                $infoDirigenteSindical,
                "categOrig",
                $sind->categorig,
                true
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpInsc",
                !empty($sind->tpinsc) ? $sind->tpinsc : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "nrInsc",
                !empty($sind->nrinsc) ? $sind->nrinsc : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "dtAdmOrig",
                !empty($sind->dtadmorig) ? $sind->dtadmorig : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "matricOrig",
                !empty($sind->matricorig) ? $sind->matricorig : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpRegTrab",
                !empty($sind->tpregtrab) ? $sind->tpregtrab : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpRegPrev",
                !empty($sind->tpregprev) ? $sind->tpregprev : null,
                false
            );
            $infoComplementares->appendChild($infoDirigenteSindical);
        }

        if (!empty($this->std->infotrabcedido)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoTrabCedido = $this->dom->createElement("infoTrabCedido");
            $this->dom->addChild(
                $infoTrabCedido,
                "categOrig",
                $this->std->infotrabcedido->categorig,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "cnpjCednt",
                $this->std->infotrabcedido->cnpjcednt,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "matricCed",
                $this->std->infotrabcedido->matricced,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "dtAdmCed",
                $this->std->infotrabcedido->dtadmced,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "tpRegTrab",
                $this->std->infotrabcedido->tpregtrab,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "tpRegPrev",
                $this->std->infotrabcedido->tpregprev,
                true
            );
            $infoComplementares->appendChild($infoTrabCedido);
        }

        if (!empty($this->std->infomandelet)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $man = $this->std->infomandelet;
            $mandelet = $this->dom->createElement("infoMandElet");
            $this->dom->addChild(
                $mandelet,
                "categOrig",
                $man->categorig,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "cnpjOrig",
                $man->cnpjorig,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "matricOrig",
                $man->matricorig,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "dtExercOrig",
                $man->dtexercorig,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "indRemunCargo",
                !empty($man->indremuncargo) ? $man->indremuncargo : null,
                false
            );
            $this->dom->addChild(
                $mandelet,
                "tpRegTrab",
                $man->tpregtrab,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "tpRegPrev",
                $man->tpregprev,
                true
            );
            $infoComplementares->appendChild($mandelet);
        }

        if (!empty($this->std->infoestagiario)) {
            $est = $this->std->infoestagiario;
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoEstagiario = $this->dom->createElement("infoEstagiario");
            $this->dom->addChild(
                $infoEstagiario,
                "natEstagio",
                $est->natestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nivEstagio",
                $est->nivestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "areaAtuacao",
                !empty($est->areaatuacao) ? $est->areaatuacao : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nrApol",
                !empty($est->nrapol) ? $est->nrapol : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "dtPrevTerm",
                $est->dtprevterm,
                true
            );
            $ens = $est->instensino;
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

            if (!empty($est->cnpjagntinteg)) {
                $ageIntegracao = $this->dom->createElement("ageIntegracao");
                $this->dom->addChild(
                    $ageIntegracao,
                    "cnpjAgntInteg",
                    $est->cnpjagntinteg,
                    true
                );
                $infoEstagiario->appendChild($ageIntegracao);
            }
            if (!empty($est->cpfsupervisor)) {
                $supervisorEstagio = $this->dom->createElement("supervisorEstagio");
                $this->dom->addChild(
                    $supervisorEstagio,
                    "cpfSupervisor",
                    $est->cpfsupervisor,
                    true
                );
                $infoEstagiario->appendChild($supervisorEstagio);
            }
            $infoComplementares->appendChild($infoEstagiario);
        }

        if (!empty($infoComplementares)) {
            $infoTSVInicio->appendChild($infoComplementares);
        }
        if (!empty($this->std->mudancacpf)) {
            $mudc = $this->std->mudancacpf;
            $mudancaCPF = $this->dom->createElement("mudancaCPF");
            $this->dom->addChild(
                $mudancaCPF,
                "cpfAnt",
                $mudc->cpfant,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "matricAnt",
                !empty($mudc->matricant) ? $mudc->matricant : null,
                false
            );
            $this->dom->addChild(
                $mudancaCPF,
                "dtAltCPF",
                $mudc->dtaltcpf,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "observacao",
                !empty($mudc->observacao) ? $mudc->observacao : null,
                false
            );
            $infoTSVInicio->appendChild($mudancaCPF);
        }
        if (!empty($this->std->afastamento)) {
            $afastamento = $this->dom->createElement("afastamento");
            $this->dom->addChild(
                $afastamento,
                "dtIniAfast",
                $this->std->afastamento->dtiniafast,
                true
            );
            $this->dom->addChild(
                $afastamento,
                "codMotAfast",
                $this->std->afastamento->codmotafast,
                true
            );
            $infoTSVInicio->appendChild($afastamento);
        }

        if (!empty($this->std->termino)) {
            $termino = $this->dom->createElement("termino");
            $this->dom->addChild(
                $termino,
                "dtTerm",
                $this->std->termino->dtterm,
                true
            );
            $infoTSVInicio->appendChild($termino);
        }

        $this->node->appendChild($infoTSVInicio);

        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    /**
     * builder for version S.1.2.0
     */
    protected function toNodeS120()
    {
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
            !empty($this->std->nrrecibo) && ($this->std->indretif == 2) ? $this->std->nrrecibo : null,
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
        $trabalhador = $this->dom->createElement("trabalhador");
        $this->dom->addChild(
            $trabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmTrab",
            $this->std->nmtrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "sexo",
            $this->std->sexo,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "racaCor",
            $this->std->racacor,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "estCiv",
            !empty($this->std->estciv) ? $this->std->estciv : null,
            false
        );
        $this->dom->addChild(
            $trabalhador,
            "grauInstr",
            $this->std->grauinstr,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmSoc",
            !empty($this->std->nmsoc) ? $this->std->nmsoc : null,
            false
        );
        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->paisnac,
            true
        );
        $trabalhador->appendChild($nascimento);

        $endereco = $this->dom->createElement("endereco");
        if (!empty($this->std->endereco->brasil)) {
            $end = $this->std->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                !empty($end->tplograd) ? $end->tplograd : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $end->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $end->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($end->bairro) ? $end->bairro : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $end->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $end->codmunic,
                true
            );
            $this->dom->addChild(
                $brasil,
                "uf",
                $end->uf,
                true
            );
            $endereco->appendChild($brasil);
        } elseif (!empty($this->std->endereco->exterior)) {
            $end = $this->std->endereco->exterior;
            $exterior = $this->dom->createElement("exterior");
            $this->dom->addChild(
                $exterior,
                "paisResid",
                $end->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $end->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $end->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($end->complemento) ? $end->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($end->bairro) ? $end->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $end->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                !empty($end->codpostal) ? $end->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $trabalhador->appendChild($endereco);

        if (!empty($this->std->trabimig)) {
            $trabimig = $this->dom->createElement("trabImig");
            $this->dom->addChild(
                $trabimig,
                "tmpResid",
                !empty($this->std->trabimig->tmpresid) ? $this->std->trabimig->tmpresid : null,
                false
            );
            $this->dom->addChild(
                $trabimig,
                "condIng",
                $this->std->trabimig->conding,
                true
            );
            $trabalhador->appendChild($trabimig);
        }

        if (!empty($this->std->infodeficiencia)) {
            $def = $this->std->infodeficiencia;
            $infoDeficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $infoDeficiencia,
                "defFisica",
                $def->deffisica,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defVisual",
                $def->defvisual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defAuditiva",
                $def->defauditiva,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defMental",
                $def->defmental,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defIntelectual",
                $def->defintelectual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "reabReadap",
                $def->reabreadap,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "observacao",
                !empty($def->observacao) ? $def->observacao : null,
                false
            );
            $trabalhador->appendChild($infoDeficiencia);
        }

        if (!empty($this->std->dependente)) {
            foreach ($this->std->dependente as $dep) {
                $dependente = $this->dom->createElement("dependente");
                $this->dom->addChild(
                    $dependente,
                    "tpDep",
                    $dep->tpdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "nmDep",
                    $dep->nmdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "dtNascto",
                    $dep->dtnascto,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "cpfDep",
                    !empty($dep->cpfdep) ? $dep->cpfdep : null,
                    false
                );
                $this->dom->addChild(
                    $dependente,
                    "depIRRF",
                    $dep->depirrf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "depSF",
                    $dep->depsf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "incTrab",
                    $dep->inctrab,
                    true
                );
                $trabalhador->appendChild($dependente);
            }
        }

        if (!empty($this->std->contato)) {
            $con = $this->std->contato;
            $contato = $this->dom->createElement("contato");
            $this->dom->addChild(
                $contato,
                "fonePrinc",
                !empty($con->foneprinc) ? $con->foneprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                !empty($con->emailprinc) ? $con->emailprinc : null,
                false
            );
            $trabalhador->appendChild($contato);
        }
        $this->node->appendChild($trabalhador);

        $infoTSVInicio = $this->dom->createElement("infoTSVInicio");
        $this->dom->addChild(
            $infoTSVInicio,
            "cadIni",
            $this->std->cadini,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "matricula",
            !empty($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "codCateg",
            $this->std->codcateg,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "dtInicio",
            $this->std->dtinicio,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "nrProcTrab",
            !empty($this->std->nrproctrab) ? $this->std->nrproctrab : null,
            false
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "natAtividade",
            !empty($this->std->natatividade) ? $this->std->natatividade : null,
            false
        );
        $infoComplementares = null;
        if (!empty($this->std->cargofuncao)) {
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $rem = $this->std->cargofuncao;
            $cargoFuncao = $this->dom->createElement("cargoFuncao");
            $this->dom->addChild(
                $cargoFuncao,
                "nmCargo",
                !empty($rem->nmcargo) ? $rem->nmcargo : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "CBOCargo",
                !empty($rem->cbocargo) ? $rem->cbocargo : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "nmFuncao",
                !empty($rem->nmfuncao) ? $rem->nmfuncao : null,
                false
            );
            $this->dom->addChild(
                $cargoFuncao,
                "CBOFuncao",
                !empty($rem->cbofuncao) ? $rem->cbofuncao : null,
                false
            );
            $infoComplementares->appendChild($cargoFuncao);
        }

        if (!empty($this->std->remuneracao)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $rem = $this->std->remuneracao;
            $remuneracao = $this->dom->createElement("remuneracao");
            $this->dom->addChild(
                $remuneracao,
                "vrSalFx",
                $rem->vrsalfx,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "undSalFixo",
                $rem->undsalfixo,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "dscSalVar",
                !empty($rem->dscsalvar) ? $rem->dscsalvar : null,
                false
            );
            $infoComplementares->appendChild($remuneracao);
        }

        if (!empty($this->std->fgts)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $fg = $this->std->fgts;
            $fgts = $this->dom->createElement("FGTS");
            $this->dom->addChild(
                $fgts,
                "dtOpcFGTS",
                $fg->dtopcfgts,
                true
            );
            $infoComplementares->appendChild($fgts);
        }

        if (!empty($this->std->infodirigentesindical)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $sind = $this->std->infodirigentesindical;
            $infoDirigenteSindical = $this->dom->createElement("infoDirigenteSindical");
            $this->dom->addChild(
                $infoDirigenteSindical,
                "categOrig",
                $sind->categorig,
                true
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpInsc",
                !empty($sind->tpinsc) ? $sind->tpinsc : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "nrInsc",
                !empty($sind->nrinsc) ? $sind->nrinsc : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "dtAdmOrig",
                !empty($sind->dtadmorig) ? $sind->dtadmorig : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "matricOrig",
                !empty($sind->matricorig) ? $sind->matricorig : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpRegTrab",
                !empty($sind->tpregtrab) ? $sind->tpregtrab : null,
                false
            );
            $this->dom->addChild(
                $infoDirigenteSindical,
                "tpRegPrev",
                !empty($sind->tpregprev) ? $sind->tpregprev : null,
                false
            );
            $infoComplementares->appendChild($infoDirigenteSindical);
        }

        if (!empty($this->std->infotrabcedido)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoTrabCedido = $this->dom->createElement("infoTrabCedido");
            $this->dom->addChild(
                $infoTrabCedido,
                "categOrig",
                $this->std->infotrabcedido->categorig,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "cnpjCednt",
                $this->std->infotrabcedido->cnpjcednt,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "matricCed",
                $this->std->infotrabcedido->matricced,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "dtAdmCed",
                $this->std->infotrabcedido->dtadmced,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "tpRegTrab",
                $this->std->infotrabcedido->tpregtrab,
                true
            );
            $this->dom->addChild(
                $infoTrabCedido,
                "tpRegPrev",
                $this->std->infotrabcedido->tpregprev,
                true
            );
            $infoComplementares->appendChild($infoTrabCedido);
        }

        if (!empty($this->std->infomandelet)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $man = $this->std->infomandelet;
            $mandelet = $this->dom->createElement("infoMandElet");
            $this->dom->addChild(
                $mandelet,
                "categOrig",
                $man->categorig,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "cnpjOrig",
                $man->cnpjorig,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "matricOrig",
                $man->matricorig,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "dtExercOrig",
                $man->dtexercorig,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "indRemunCargo",
                !empty($man->indremuncargo) ? $man->indremuncargo : null,
                false
            );
            $this->dom->addChild(
                $mandelet,
                "tpRegTrab",
                $man->tpregtrab,
                true
            );
            $this->dom->addChild(
                $mandelet,
                "tpRegPrev",
                $man->tpregprev,
                true
            );
            $infoComplementares->appendChild($mandelet);
        }

        if (!empty($this->std->infoestagiario)) {
            $est = $this->std->infoestagiario;
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $infoEstagiario = $this->dom->createElement("infoEstagiario");
            $this->dom->addChild(
                $infoEstagiario,
                "natEstagio",
                $est->natestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nivEstagio",
                $est->nivestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "areaAtuacao",
                !empty($est->areaatuacao) ? $est->areaatuacao : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nrApol",
                !empty($est->nrapol) ? $est->nrapol : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "dtPrevTerm",
                $est->dtprevterm,
                true
            );
            $ens = $est->instensino;
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

            if (!empty($est->cnpjagntinteg)) {
                $ageIntegracao = $this->dom->createElement("ageIntegracao");
                $this->dom->addChild(
                    $ageIntegracao,
                    "cnpjAgntInteg",
                    $est->cnpjagntinteg,
                    true
                );
                $infoEstagiario->appendChild($ageIntegracao);
            }
            if (!empty($est->cpfsupervisor)) {
                $supervisorEstagio = $this->dom->createElement("supervisorEstagio");
                $this->dom->addChild(
                    $supervisorEstagio,
                    "cpfSupervisor",
                    $est->cpfsupervisor,
                    true
                );
                $infoEstagiario->appendChild($supervisorEstagio);
            }
            $infoComplementares->appendChild($infoEstagiario);
        }

        if (!empty($this->std->localtrabgeral)) {
            if (empty($infoComplementares)) {
                $infoComplementares = $this->dom->createElement("infoComplementares");
            }
            $lg = $this->std->localtrabgeral;
            $local = $this->dom->createElement("localTrabGeral");
            $this->dom->addChild(
                $local,
                "tpInsc",
                $lg->tpinsc,
                true
            );
            $this->dom->addChild(
                $local,
                "nrInsc",
                $lg->nrinsc,
                true
            );
            $this->dom->addChild(
                $local,
                "descComp",
                $lg->desccomp ?? null,
                false
            );
            $infoComplementares->appendChild($local);
        }

        if (!empty($infoComplementares)) {
            $infoTSVInicio->appendChild($infoComplementares);
        }
        if (!empty($this->std->mudancacpf)) {
            $mudc = $this->std->mudancacpf;
            $mudancaCPF = $this->dom->createElement("mudancaCPF");
            $this->dom->addChild(
                $mudancaCPF,
                "cpfAnt",
                $mudc->cpfant,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "matricAnt",
                !empty($mudc->matricant) ? $mudc->matricant : null,
                false
            );
            $this->dom->addChild(
                $mudancaCPF,
                "dtAltCPF",
                $mudc->dtaltcpf,
                true
            );
            $this->dom->addChild(
                $mudancaCPF,
                "observacao",
                !empty($mudc->observacao) ? $mudc->observacao : null,
                false
            );
            $infoTSVInicio->appendChild($mudancaCPF);
        }
        if (!empty($this->std->afastamento)) {
            $afastamento = $this->dom->createElement("afastamento");
            $this->dom->addChild(
                $afastamento,
                "dtIniAfast",
                $this->std->afastamento->dtiniafast,
                true
            );
            $this->dom->addChild(
                $afastamento,
                "codMotAfast",
                $this->std->afastamento->codmotafast,
                true
            );
            $infoTSVInicio->appendChild($afastamento);
        }

        if (!empty($this->std->termino)) {
            $termino = $this->dom->createElement("termino");
            $this->dom->addChild(
                $termino,
                "dtTerm",
                $this->std->termino->dtterm,
                true
            );
            $infoTSVInicio->appendChild($termino);
        }

        $this->node->appendChild($infoTSVInicio);

        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
