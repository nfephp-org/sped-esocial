<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2205
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

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
        return $this->toNodeS100();
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
                $this->dom->addChild(
                    $dependente,
                    "descrDep",
                    $dep->descrdep ?? null,
                    false
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
