<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2300
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
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
            ! empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
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
            "nisTrab",
            !empty($this->std->nistrab) ? $this->std->nistrab : null,
            false
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
            "codMunic",
            !empty($this->std->codmunic) ? $this->std->codmunic : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "uf",
            !empty($this->std->uf) ? $this->std->uf : null,
            false
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
        $this->dom->addChild(
            $nascimento,
            "nmMae",
            !empty($this->std->nmmae) ? $this->std->nmmae : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "nmPai",
            !empty($this->std->nmpai) ? $this->std->nmpai : null,
            false
        );
        $trabalhador->appendChild($nascimento);

        $documentos = null;
        if (!empty($this->std->ctps)) {
            $doc = $this->std->ctps;
            $documentos = $this->dom->createElement("documentos");
            $ctps = $this->dom->createElement("CTPS");
            $this->dom->addChild(
                $ctps,
                "nrCtps",
                $doc->nrctps,
                true
            );
            $this->dom->addChild(
                $ctps,
                "serieCtps",
                $doc->seriectps,
                true
            );
            $this->dom->addChild(
                $ctps,
                "ufCtps",
                $doc->ufctps,
                true
            );
            $documentos->appendChild($ctps);
        }

        if (!empty($this->std->ric)) {
            $doc = $this->std->ric;
            if (empty($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $ric = $this->dom->createElement("RIC");
            $this->dom->addChild(
                $ric,
                "nrRic",
                $doc->nrric,
                true
            );
            $this->dom->addChild(
                $ric,
                "orgaoEmissor",
                $doc->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $ric,
                "dtExped",
                !empty($doc->dtexped) ? $doc->dtexped : null,
                false
            );
            $documentos->appendChild($ric);
        }

        if (!empty($this->std->rg)) {
            $doc = $this->std->rg;
            if (empty($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $rg = $this->dom->createElement("RG");
            $this->dom->addChild(
                $rg,
                "nrRg",
                $doc->nrrg,
                true
            );
            $this->dom->addChild(
                $rg,
                "orgaoEmissor",
                $doc->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $rg,
                "dtExped",
                !empty($doc->dtexped) ? $doc->dtexped : null,
                false
            );
            $documentos->appendChild($rg);
        }

        if (!empty($this->std->rne)) {
            $doc = $this->std->rne;
            if (empty($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $rne = $this->dom->createElement("RNE");
            $this->dom->addChild(
                $rne,
                "nrRne",
                $doc->nrrne,
                true
            );
            $this->dom->addChild(
                $rne,
                "orgaoEmissor",
                $doc->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $rne,
                "dtExped",
                !empty($doc->dtexped) ? $doc->dtexped : null,
                false
            );
            $documentos->appendChild($rne);
        }

        if (!empty($this->std->oc)) {
            $doc = $this->std->oc;
            if (empty($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $oc = $this->dom->createElement("OC");
            $this->dom->addChild(
                $oc,
                "nrOc",
                $doc->nroc,
                true
            );
            $this->dom->addChild(
                $oc,
                "orgaoEmissor",
                $doc->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $oc,
                "dtExped",
                !empty($doc->dtexped) ? $doc->dtexped : null,
                false
            );
            $this->dom->addChild(
                $oc,
                "dtValid",
                !empty($doc->dtvalid) ? $doc->dtvalid : null,
                false
            );
            $documentos->appendChild($oc);
        }

        if (!empty($this->std->cnh)) {
            $doc = $this->std->cnh;
            if (empty($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $cnh = $this->dom->createElement("CNH");
            $this->dom->addChild(
                $cnh,
                "nrRegCnh",
                $doc->nrregcnh,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtExped",
                !empty($doc->dtexped) ? $doc->dtexped : null,
                false
            );
            $this->dom->addChild(
                $cnh,
                "ufCnh",
                $doc->ufcnh,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtValid",
                $doc->dtvalid,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtPriHab",
                !empty($doc->dtprihab) ? $doc->dtprihab : null,
                false
            );
            $this->dom->addChild(
                $cnh,
                "categoriaCnh",
                $doc->categoriacnh,
                true
            );
            $documentos->appendChild($cnh);
        }

        if (!empty($documentos)) {
            $trabalhador->appendChild($documentos);
        }

        $endereco = $this->dom->createElement("endereco");
        if (!empty($this->std->brasil)) {
            $end = $this->std->brasil;
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                $end->tplograd,
                true
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
        } elseif (!empty($this->std->exterior)) {
            $end = $this->std->exterior;
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

        if (!empty($this->std->trabestrangeiro)) {
            $trabEstrangeiro = $this->dom->createElement("trabEstrangeiro");
            $this->dom->addChild(
                $trabEstrangeiro,
                "dtChegada",
                !empty($this->std->trabestrangeiro->dtchegada) ? $this->std->trabestrangeiro->dtchegada : null,
                false
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "classTrabEstrang",
                $this->std->trabestrangeiro->classtrabestrang,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "casadoBr",
                $this->std->trabestrangeiro->casadobr,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "filhosBr",
                $this->std->trabestrangeiro->filhosbr,
                true
            );
            $trabalhador->appendChild($trabEstrangeiro);
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
                "foneAlternat",
                !empty($con->fonealternat) ? $con->fonealternat : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                !empty($con->emailprinc) ? $con->emailprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailAlternat",
                !empty($con->emailalternat) ? $con->emailalternat : null,
                false
            );
            $trabalhador->appendChild($contato);
        }
        $this->node->appendChild($trabalhador);

        $infoTSVInicio = $this->dom->createElement("infoTSVInicio");
        $ii = $this->std->infotsvinicio;
        $this->dom->addChild(
            $infoTSVInicio,
            "cadIni",
            $ii->cadini,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "codCateg",
            $ii->codcateg,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "dtInicio",
            $ii->dtinicio,
            true
        );
        $this->dom->addChild(
            $infoTSVInicio,
            "natAtividade",
            !empty($ii->natatividade) ? $ii->natatividade : null,
            false
        );
        $infoComplementares = null;
        if (!empty($this->std->cargofuncao)) {
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $rem = $this->std->cargofuncao;
            $cargoFuncao = $this->dom->createElement("cargoFuncao");
            $this->dom->addChild(
                $cargoFuncao,
                "codCargo",
                $rem->codcargo,
                true
            );
            $this->dom->addChild(
                $cargoFuncao,
                "codFuncao",
                !empty($rem->codfuncao) ? $rem->codfuncao : null,
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
            $fgts = $this->dom->createElement("fgts");
            $this->dom->addChild(
                $fgts,
                "opcFGTS",
                $fg->opcfgts,
                true
            );
            $this->dom->addChild(
                $fgts,
                "dtOpcFGTS",
                !empty($fg->dtopcfgts) ? $fg->dtopcfgts : null,
                false
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
                "cnpjOrigem",
                !empty($sind->cnpjorigem) ? $sind->cnpjorigem : null,
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
            $this->dom->addChild(
                $infoTrabCedido,
                "infOnus",
                $this->std->infotrabcedido->infonus,
                true
            );
            $infoComplementares->appendChild($infoTrabCedido);
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
                "vlrBolsa",
                !empty($est->vlrbolsa) ? $est->vlrbolsa : null,
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
            $this->dom->addChild(
                $instEnsino,
                "nmRazao",
                $ens->nmrazao,
                true
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

            if (!empty($est->ageintegracao)) {
                $agt = $est->ageintegracao;
                $ageIntegracao = $this->dom->createElement("ageIntegracao");
                $this->dom->addChild(
                    $ageIntegracao,
                    "cnpjAgntInteg",
                    $agt->cnpjagntinteg,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "nmRazao",
                    $agt->nmrazao,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "dscLograd",
                    $agt->dsclograd,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "nrLograd",
                    $agt->nrlograd,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "bairro",
                    !empty($agt->bairro) ? $agt->bairro : null,
                    false
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "cep",
                    $agt->cep,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "codMunic",
                    !empty($agt->codmunic) ? $agt->codmunic : null,
                    false
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "uf",
                    $agt->uf,
                    true
                );
                $infoEstagiario->appendChild($ageIntegracao);
            }
            if (!empty($est->supervisorestagio)) {
                $supervisorEstagio = $this->dom->createElement("supervisorEstagio");
                $this->dom->addChild(
                    $supervisorEstagio,
                    "cpfSupervisor",
                    $est->supervisorestagio->cpfsupervisor,
                    true
                );
                $this->dom->addChild(
                    $supervisorEstagio,
                    "nmSuperv",
                    $est->supervisorestagio->nmsuperv,
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
                    empty($ens->nmrazao) ? $ens->nmrazao : null,
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
}
