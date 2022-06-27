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
        $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ideTrabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->node->appendChild($ideTrabalhador);
        $alteracao = $this->dom->createElement("alteracao");
        $this->dom->addChild(
            $alteracao,
            "dtAlteracao",
            $this->std->dtalteracao,
            true
        );
        $trabalhador = $this->dom->createElement("dadosTrabalhador");
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
            $this->std->nascimento->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "codMunic",
            !empty($this->std->nascimento->codmunic) ? $this->std->nascimento->codmunic : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "uf",
            !empty($this->std->nascimento->uf) ? $this->std->nascimento->uf : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->nascimento->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->nascimento->paisnac,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "nmMae",
            !empty($this->std->nascimento->nmmae) ? $this->std->nascimento->nmmae : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "nmPai",
            !empty($this->std->nascimento->nmpai) ? $this->std->nascimento->nmpai : null,
            false
        );
        $trabalhador->appendChild($nascimento);
        $documentos = null;
        if (!empty($this->std->ctps)) {
            $ct = $this->std->ctps;
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
        if (!empty($this->std->ric)) {
            $ct = $this->std->ric;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
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
        if (!empty($this->std->rg)) {
            $ct = $this->std->rg;
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
        if (!empty($this->std->rne)) {
            $ct = $this->std->rne;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
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
        if (!empty($this->std->oc)) {
            $ct = $this->std->oc;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
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
        if (!empty($this->std->cnh)) {
            $ct = $this->std->cnh;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
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
        if (!is_null($documentos)) {
            $trabalhador->appendChild($documentos);
        }
        
        $endereco = $this->dom->createElement("endereco");
        if (!empty($this->std->brasil)) {
            $ct = $this->std->brasil;
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
        } elseif (!empty($this->std->exterior)) {
            $ct = $this->std->exterior;
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
        $trabalhador->appendChild($endereco);
        
        if (!empty($this->std->trabestrangeiro)) {
            $ct = $this->std->trabestrangeiro;
            $trabEstrangeiro = $this->dom->createElement("trabEstrangeiro");
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
            $trabalhador->appendChild($trabEstrangeiro);
        }
        
        if (!empty($this->std->infodeficiencia)) {
            $ct = $this->std->infodeficiencia;
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
        
        if (!empty($this->std->aposentadoria)) {
            $aposentadoria = $this->dom->createElement("aposentadoria");
            $this->dom->addChild(
                $aposentadoria,
                "trabAposent",
                $this->std->aposentadoria->trabaposent,
                true
            );
            $trabalhador->appendChild($aposentadoria);
        }
        
        if (!empty($this->std->contato)) {
            $ct = $this->std->contato;
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
            $trabalhador->appendChild($contato);
        }
        
        $alteracao->appendChild($trabalhador);
        
        $this->node->appendChild($alteracao);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);;
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
        $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ideTrabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->node->appendChild($ideTrabalhador);
        $alteracao = $this->dom->createElement("alteracao");
        $this->dom->addChild(
            $alteracao,
            "dtAlteracao",
            $this->std->dtalteracao,
            true
        );
        $trabalhador = $this->dom->createElement("dadosTrabalhador");
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
        $this->dom->addChild(
            $trabalhador,
            "paisNac",
            $this->std->paisnac,
            true
        );
        $endereco = $this->dom->createElement("endereco");
        if (!empty($this->std->endereco->brasil)) {
            $ct = $this->std->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            if (! empty($ct->tplograd)) {
                $this->dom->addChild(
                    $brasil,
                    "tpLograd",
                    $ct->tplograd,
                    true
                );
            }
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
        } elseif (!empty($this->std->endereco->exterior)) {
            $ct = $this->std->endereco->exterior;
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
                "infoCota",
                !empty($def->infocota) ? $def->infocota  : null,
                false
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
                    "sexoDep",
                    !empty($dep->sexodep) ? $dep->sexodep : null,
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
        
        $alteracao->appendChild($trabalhador);
        
        $this->node->appendChild($alteracao);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);;
        $this->sign();
    }
}
