<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2205
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
        $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ideTrabalhador,
            "cpfTrab",
            $this->std->idetrabalhador->cpftrab,
            true
        );
        $this->node->appendChild($ideTrabalhador);
        $alteracao = $this->dom->createElement("alteracao");
        $this->dom->addChild(
            $alteracao,
            "dtAlteracao",
            $this->std->alteracao->dtalteracao,
            true
        );
        $dadosTrabalhador = $this->dom->createElement("dadosTrabalhador");
        $this->dom->addChild(
            $dadosTrabalhador,
            "nisTrab",
            !empty($this->std->alteracao->dadostrabalhador->nistrab) ? $this->std->alteracao->dadostrabalhador->nistrab : null,
            false
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "nmTrab",
            $this->std->alteracao->dadostrabalhador->nmtrab,
            true
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "sexo",
            $this->std->alteracao->dadostrabalhador->sexo,
            true
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "racaCor",
            $this->std->alteracao->dadostrabalhador->racacor,
            true
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "estCiv",
            !empty($this->std->alteracao->dadostrabalhador->estciv) ? $this->std->alteracao->dadostrabalhador->estciv : null,
            false
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "grauInstr",
            $this->std->alteracao->dadostrabalhador->grauinstr,
            true
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "nmSoc",
            !empty($this->std->alteracao->dadostrabalhador->nmsoc) ? $this->std->alteracao->dadostrabalhador->nmsoc : null,
            false
        );

        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->alteracao->dadostrabalhador->nascimento->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "codMunic",
            !empty($this->std->alteracao->dadostrabalhador->nascimento->codmunic) ? $this->std->alteracao->dadostrabalhador->nascimento->codmunic : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "uf",
            !empty($this->std->alteracao->dadostrabalhador->nascimento->uf) ? $this->std->alteracao->dadostrabalhador->nascimento->uf : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->alteracao->dadostrabalhador->nascimento->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->alteracao->dadostrabalhador->nascimento->paisnac,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "nmMae",
            !empty($this->std->alteracao->dadostrabalhador->nascimento->nmmae) ? $this->std->alteracao->dadostrabalhador->nascimento->nmmae : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "nmPai",
            !empty($this->std->alteracao->dadostrabalhador->nascimento->nmpai) ? $this->std->alteracao->dadostrabalhador->nascimento->nmpai : null,
            false
        );
        $dadosTrabalhador->appendChild($nascimento);

        $documentos = null;
        if (!empty($this->std->alteracao->dadostrabalhador->documentos->ctps)) {
            $ct = $this->std->alteracao->dadostrabalhador->documentos->ctps;
            $documentos = $this->dom->createElement("documentos");
            $CTPS = $this->dom->createElement("CTPS");
            $this->dom->addChild(
                $CTPS,
                "nrCtps",
                $ct->nrctps,
                true
            );
            $this->dom->addChild(
                $CTPS,
                "serieCtps",
                $ct->seriectps,
                true
            );
            $this->dom->addChild(
                $CTPS,
                "ufCtps",
                $ct->ufctps,
                true
            );
            $documentos->appendChild($CTPS);
        }
        if (!empty($this->std->alteracao->dadostrabalhador->documentos->ric)) {
            $ct = $this->std->alteracao->dadostrabalhador->documentos->ric;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }

            if (!empty($ct->nrric)) {
                $RIC = $this->dom->createElement("RIC");
                $this->dom->addChild(
                    $RIC,
                    "nrRic",
                    $ct->nrric,
                    true
                );
                $this->dom->addChild(
                    $RIC,
                    "orgaoEmissor",
                    $ct->orgaoemissor,
                    true
                );
                $this->dom->addChild(
                    $RIC,
                    "dtExped",
                    !empty($ct->dtexped) ? $ct->dtexped : null,
                    false
                );
                $documentos->appendChild($RIC);
            }
        }
        if (!empty($this->std->alteracao->dadostrabalhador->documentos->rg)) {
            $ct = $this->std->alteracao->dadostrabalhador->documentos->rg;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $RG = $this->dom->createElement("RG");
            $this->dom->addChild(
                $RG,
                "nrRg",
                $ct->nrrg,
                true
            );
            $this->dom->addChild(
                $RG,
                "orgaoEmissor",
                $ct->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $RG,
                "dtExped",
                !empty($ct->dtexped) ? $ct->dtexped : null,
                false
            );
            $documentos->appendChild($RG);
        }
        if (!empty($this->std->alteracao->dadostrabalhador->documentos->rne)) {
            $ct = $this->std->alteracao->dadostrabalhador->documentos->rne;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            
            if (!empty($ct->nrrne)) {
                $RNE = $this->dom->createElement("RNE");
                $this->dom->addChild(
                    $RNE,
                    "nrRne",
                    $ct->nrrne,
                    true
                );
                $this->dom->addChild(
                    $RNE,
                    "orgaoEmissor",
                    $ct->orgaoemissor,
                    true
                );
                $this->dom->addChild(
                    $RNE,
                    "dtExped",
                    !empty($ct->dtexped) ? $ct->dtexped : null,
                    false
                );
                $documentos->appendChild($RNE);
            }
        }
        if (!empty($this->std->alteracao->dadostrabalhador->documentos->oc)) {
            $ct = $this->std->alteracao->dadostrabalhador->documentos->oc;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            if (!empty($ct->nroc)) {

                $OC = $this->dom->createElement("OC");
                $this->dom->addChild(
                    $OC,
                    "nrOc",
                    $ct->nroc,
                    true
                );
                $this->dom->addChild(
                    $OC,
                    "orgaoEmissor",
                    $ct->orgaoemissor,
                    true
                );
                $this->dom->addChild(
                    $OC,
                    "dtExped",
                    !empty($ct->dtexped) ? $ct->dtexped : null,
                    false
                );
                $this->dom->addChild(
                    $OC,
                    "dtValid",
                    !empty($ct->dtvalid) ? $ct->dtvalid : null,
                    false
                );
                $documentos->appendChild($OC);
            }
        }
        if (!empty($this->std->alteracao->dadostrabalhador->documentos->cnh)) {
            $ct = $this->std->alteracao->dadostrabalhador->documentos->cnh;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            if (!empty($ct->nrregcnh)) {
                $CNH = $this->dom->createElement("CNH");
            
                $this->dom->addChild(
                    $CNH,
                    "nrRegCnh",
                    $ct->nrregcnh,
                    true
                );

                $this->dom->addChild(
                    $CNH,
                    "dtExped",
                    !empty($ct->dtexped) ? $ct->dtexped : null,
                    false
                );


                $this->dom->addChild(
                    $CNH,
                    "ufCnh",
                    $ct->ufcnh,
                    true
                );


                $this->dom->addChild(
                    $CNH,
                    "dtValid",
                    $ct->dtvalid,
                    true
                );


                $this->dom->addChild(
                    $CNH,
                    "dtPriHab",
                    !empty($ct->dtprihab) ? $ct->dtprihab : null,
                    false
                );


                $this->dom->addChild(
                    $CNH,
                    "categoriaCnh",
                    $ct->categoriacnh,
                    true
                );

                $documentos->appendChild($CNH);
            }
        }

        if (!is_null($documentos)) {
            $dadosTrabalhador->appendChild($documentos);
        }

        $endereco = $this->dom->createElement("endereco");
        if (!empty($this->std->alteracao->dadostrabalhador->endereco->brasil)) {

            $ct = $this->std->alteracao->dadostrabalhador->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                $ct->tplograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $ct->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $ct->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($ct->complemento) ? $ct->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($ct->bairro) ? $ct->bairro : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $ct->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $ct->codmunic,
                true
            );
            $this->dom->addChild(
                $brasil,
                "uf",
                $ct->uf,
                true
            );
            $endereco->appendChild($brasil);
        } elseif (!empty($this->std->alteracao->dadostrabalhador->exterior)) {
            $ct = $this->std->alteracao->dadostrabalhador->exterior;
            $exterior = $this->dom->createElement("exterior");
            $this->dom->addChild(
                $exterior,
                "paisResid",
                $ct->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $ct->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $ct->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($ct->complemento) ? $ct->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($ct->bairro) ? $ct->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $ct->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                !empty($ct->codpostal) ? $ct->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $dadosTrabalhador->appendChild($endereco);

        if (!empty($this->std->alteracao->dadostrabalhador->trabestrangeiro)) {
            $ct = $this->std->alteracao->dadostrabalhador->trabestrangeiro;
            $trabEstrangeiro = $this->dom->createElement("trabEstrangeiro");
            if (!empty($ct->dtchegada)) {
                $this->dom->addChild(
                    $trabEstrangeiro,
                    "dtChegada",
                    $ct->dtchegada,
                    true
                );
                $this->dom->addChild(
                    $trabEstrangeiro,
                    "classTrabEstrang",
                    $ct->classtrabestrang,
                    true
                );
                $this->dom->addChild(
                    $trabEstrangeiro,
                    "casadoBr",
                    $ct->casadobr,
                    true
                );
                $this->dom->addChild(
                    $trabEstrangeiro,
                    "filhosBr",
                    $ct->filhosbr,
                    true
                );
                $dadosTrabalhador->appendChild($trabEstrangeiro);
            }
        }

        if (!empty($this->std->alteracao->dadostrabalhador->infodeficiencia)) {
            $ct = $this->std->alteracao->dadostrabalhador->infodeficiencia;
            $infoDeficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $infoDeficiencia,
                "defFisica",
                $ct->deffisica,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defVisual",
                $ct->defvisual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defAuditiva",
                $ct->defauditiva,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defMental",
                $ct->defmental,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defIntelectual",
                $ct->defintelectual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "reabReadap",
                $ct->reabreadap,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "infoCota",
                !empty($ct->infocota) ? $ct->infocota : null,
                false
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "observacao",
                !empty($ct->observacao) ? $ct->observacao : null,
                false
            );
            $dadosTrabalhador->appendChild($infoDeficiencia);
        }

        if (!empty($this->std->alteracao->dadostrabalhador->dependente)) {
            foreach ($this->std->alteracao->dadostrabalhador->dependente as $dep) {
                if (!empty($dep->cpfdep)) {
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
                    $dadosTrabalhador->appendChild($dependente);
                }
            }
        }

        if (!empty($this->std->alteracao->dadostrabalhador->aposentadoria)) {
            if (!empty($this->std->aposentadoria->trabaposent)) {
                $aposentadoria = $this->dom->createElement("aposentadoria");
                $this->dom->addChild(
                    $aposentadoria,
                    "trabAposent",
                    $this->std->aposentadoria->trabaposent,
                    true
                );
                $dadosTrabalhador->appendChild($aposentadoria);
            }
        }

        if (!empty($this->std->alteracao->dadostrabalhador->contato)) {
            $ct = $this->std->alteracao->dadostrabalhador->contato;
            $contato = $this->dom->createElement("contato");
            $this->dom->addChild(
                $contato,
                "fonePrinc",
                !empty($ct->foneprinc) ? $ct->foneprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "foneAlternat",
                !empty($ct->fonealternat) ? $ct->fonealternat : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                !empty($ct->emailprinc) ? $ct->emailprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailAlternat",
                !empty($ct->emailalternat) ? $ct->emailalternat : null,
                false
            );
            $dadosTrabalhador->appendChild($contato);
        }

        $alteracao->appendChild($dadosTrabalhador);

        $this->node->appendChild($alteracao);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("TODO !!");
    }
}
