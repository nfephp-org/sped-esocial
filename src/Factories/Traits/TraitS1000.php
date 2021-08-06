<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1000
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
        $infoEmpregador = $this->dom->createElement("infoEmpregador");
        //periodo
        $idePeriodo = $this->dom->createElement("idePeriodo");
        $this->dom->addChild(
            $idePeriodo,
            "iniValid",
            $this->std->ideperiodo->inivalid,
            true
        );
        $this->dom->addChild(
            $idePeriodo,
            "fimValid",
            !empty($this->std->ideperiodo->fimvalid) ? $this->std->ideperiodo->fimvalid : '',
            false
        );
        //infoCadastro
        if (isset($this->std->infocadastro)) {
            $cad = $this->std->infocadastro;
            $infoCadastro = $this->dom->createElement("infoCadastro");
            $this->dom->addChild(
                $infoCadastro,
                "nmRazao",
                $cad->nmrazao,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "classTrib",
                $cad->classtrib,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "natJurid",
                !empty($cad->natjurid) ? $cad->natjurid : null,
                ($this->tpInsc == 1) ? true : false //obrigatorio para pessoa juridica
            );
            $this->dom->addChild(
                $infoCadastro,
                "indCoop",
                isset($cad->indcoop) ? $cad->indcoop : null,
                ($this->tpInsc == 1) ? true : false //obrigatorio para pessoa juridica
            );
            $this->dom->addChild(
                $infoCadastro,
                "indConstr",
                isset($cad->indconstr) ? $cad->indconstr : null,
                ($this->tpInsc == 1) ? true : false //obrigatorio para pessoa juridica
            );
            $this->dom->addChild(
                $infoCadastro,
                "indDesFolha",
                $cad->inddesfolha,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "indOpcCP",
                !empty($cad->indopccp) ? $cad->indopccp : null,
                false
            );
            $this->dom->addChild(
                $infoCadastro,
                "indPorte",
                !empty($cad->indporte) ? $cad->indporte : null,
                false
            );
            $this->dom->addChild(
                $infoCadastro,
                "indOptRegEletron",
                $cad->indoptregeletron,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "indEntEd",
                !empty($cad->indented) ? $cad->indented : null,
                false
            );
            $this->dom->addChild(
                $infoCadastro,
                "indEtt",
                !empty($cad->indett) ? $cad->indett : null,
                false
            );
            $this->dom->addChild(
                $infoCadastro,
                "nrRegEtt",
                !empty($cad->nrregett) ? $cad->nrregett : null,
                false
            );
        }
        if (isset($this->std->dadosisencao) && !empty($infoCadastro)) {
            $cad  = $this->std->dadosisencao;
            $info = $this->dom->createElement("dadosIsencao");
            $this->dom->addChild(
                $info,
                "ideMinLei",
                $cad->ideminlei,
                true
            );
            $this->dom->addChild(
                $info,
                "nrCertif",
                $cad->nrcertif,
                true
            );
            $this->dom->addChild(
                $info,
                "dtEmisCertif",
                $cad->dtemiscertif,
                true
            );
            $this->dom->addChild(
                $info,
                "dtVencCertif",
                $cad->dtvenccertif,
                true
            );
            $this->dom->addChild(
                $info,
                "nrProtRenov",
                !empty($cad->nrprotrenov) ? $cad->nrprotrenov : null,
                false
            );
            $this->dom->addChild(
                $info,
                "dtProtRenov",
                !empty($cad->dtprotrenov) ? $cad->dtprotrenov : null,
                false
            );
            $this->dom->addChild(
                $info,
                "dtDou",
                !empty($cad->dtdou) ? $cad->dtdou : null,
                false
            );
            $this->dom->addChild(
                $info,
                "pagDou",
                !empty($cad->pagdou) ? $cad->pagdou : null,
                false
            );
            $infoCadastro->appendChild($info);
        }
        if (isset($this->std->contato) && !empty($infoCadastro)) {
            $cad  = $this->std->contato;
            $info = $this->dom->createElement("contato");
            $this->dom->addChild(
                $info,
                "nmCtt",
                $cad->nmctt,
                true
            );
            $this->dom->addChild(
                $info,
                "cpfCtt",
                $cad->cpfctt,
                true
            );
            $this->dom->addChild(
                $info,
                "foneFixo",
                !empty($cad->fonefixo) ? $cad->fonefixo : '',
                false
            );
            $this->dom->addChild(
                $info,
                "foneCel",
                !empty($cad->fonecel) ? $cad->fonecel : null,
                false
            );
            $this->dom->addChild(
                $info,
                "email",
                !empty($cad->email) ? $cad->email : null,
                false
            );
            $infoCadastro->appendChild($info);
            if (isset($this->std->infoop)  && !empty($infoCadastro)) {
                $cad  = $this->std->infoop;
                $infoOP = $this->dom->createElement("infoOP");
                $this->dom->addChild(
                    $infoOP,
                    "nrSiafi",
                    $cad->nrsiafi,
                    true
                );
                if (isset($this->std->infoefr)) {
                    $cad  = $this->std->infoefr;
                    $infoEFR = $this->dom->createElement("infoEFR");
                    $this->dom->addChild(
                        $infoEFR,
                        "ideEFR",
                        $cad->ideefr,
                        true
                    );
                    $this->dom->addChild(
                        $infoEFR,
                        "cnpjEFR",
                        !empty($cad->cnpjefr) ? $cad->cnpjefr : null,
                        false
                    );
                    $infoOP->appendChild($infoEFR);
                }
                if (isset($this->std->infoente)) {
                    $cad  = $this->std->infoente;
                    $infoEnte = $this->dom->createElement("infoEnte");
                    $this->dom->addChild(
                        $infoEnte,
                        "nmEnte",
                        $cad->nmente,
                        true
                    );
                    $this->dom->addChild(
                        $infoEnte,
                        "uf",
                        $cad->uf,
                        true
                    );
                    $this->dom->addChild(
                        $infoEnte,
                        "codMunic",
                        !empty($cad->codmunic) ? $cad->codmunic : null,
                        false
                    );
                    $this->dom->addChild(
                        $infoEnte,
                        "indRPPS",
                        $cad->indrpps,
                        true
                    );
                    $this->dom->addChild(
                        $infoEnte,
                        "subteto",
                        $cad->subteto,
                        true
                    );
                    $this->dom->addChild(
                        $infoEnte,
                        "vrSubteto",
                        number_format($cad->vrsubteto, 2, ".", ""),
                        true
                    );
                    $infoOP->appendChild($infoEnte);
                }
                $infoCadastro->appendChild($infoOP);
            }
        }
        if (isset($this->std->infoorginternacional) && !empty($infoCadastro)) {
            $cad = $this->std->infoorginternacional;
            $info = $this->dom->createElement("infoOrgInternacional");
            $this->dom->addChild(
                $info,
                "indAcordoIsenMulta",
                $cad->indacordoisenmulta,
                true
            );
            $infoCadastro->appendChild($info);
        }
        if (isset($this->std->softwarehouse) && !empty($infoCadastro)) {
            foreach ($this->std->softwarehouse as $sh) {
                $info = $this->dom->createElement("softwareHouse");
                $this->dom->addChild(
                    $info,
                    "cnpjSoftHouse",
                    $sh->cnpjsofthouse,
                    true
                );
                $this->dom->addChild(
                    $info,
                    "nmRazao",
                    $sh->nmrazao,
                    true
                );
                $this->dom->addChild(
                    $info,
                    "nmCont",
                    $sh->nmcont,
                    true
                );
                $this->dom->addChild(
                    $info,
                    "telefone",
                    $sh->telefone,
                    true
                );
                $this->dom->addChild(
                    $info,
                    "email",
                    !empty($sh->email) ? $sh->email : null,
                    false
                );
                $infoCadastro->appendChild($info);
            }
        }
        if (isset($this->std->situacaopj)) {
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $sh = $this->std->situacaopj;
            $info = $this->dom->createElement("situacaoPJ");
            $this->dom->addChild(
                $info,
                "indSitPJ",
                $sh->indsitpj,
                true
            );
            $infoComplementares->appendChild($info);
        } elseif (isset($this->std->situacaopf)) {
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $sh = $this->std->situacaopf;
            $info = $this->dom->createElement("situacaoPF");
            $this->dom->addChild(
                $info,
                "indSitPF",
                $sh->indsitpf,
                true
            );
            $infoComplementares->appendChild($info);
        }
        if (isset($this->std->novavalidade)) {
            $sh = $this->std->novavalidade;
            $novavalidade = $this->dom->createElement("novaValidade");
            $this->dom->addChild(
                $novavalidade,
                "iniValid",
                $sh->inivalid,
                true
            );
            $this->dom->addChild(
                $novavalidade,
                "fimValid",
                !empty($sh->fimValid) ? $sh->fimValid : null,
                false
            );
        }
        switch ($this->std->modo) {
            case "ALT":
                $node = $this->dom->createElement("alteracao");
                $node->appendChild($idePeriodo);
                if (isset($infoComplementares) && isset($infoCadastro)) {
                    $infoCadastro->appendChild($infoComplementares);
                }
                isset($infoCadastro) ? $node->appendChild($infoCadastro) : null;
                isset($novavalidade) ? $node->appendChild($novavalidade) : null;
                break;
            case "EXC":
                $node = $this->dom->createElement("exclusao");
                $node->appendChild($idePeriodo);
                break;
            case "INC":
            default:
                $node = $this->dom->createElement("inclusao");
                $node->appendChild($idePeriodo);
                if (isset($infoComplementares) && isset($infoCadastro)) {
                    $infoCadastro->appendChild($infoComplementares);
                }
                isset($infoCadastro) ? $node->appendChild($infoCadastro) : null;
        }
        $infoEmpregador->appendChild($node);
        $this->node->appendChild($infoEmpregador);
        //finalização do xml
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
        $infoEmpregador = $this->dom->createElement("infoEmpregador");
        //periodo
        $idePeriodo = $this->dom->createElement("idePeriodo");
        $this->dom->addChild(
            $idePeriodo,
            "iniValid",
            $this->std->ideperiodo->inivalid,
            true
        );
        $this->dom->addChild(
            $idePeriodo,
            "fimValid",
            !empty($this->std->ideperiodo->fimvalid) ? $this->std->ideperiodo->fimvalid : '',
            false
        );
        //infoCadastro
        if (isset($this->std->infocadastro)) {
            $cad = $this->std->infocadastro;
            $infoCadastro = $this->dom->createElement("infoCadastro");
            $this->dom->addChild(
                $infoCadastro,
                "classTrib",
                $cad->classtrib,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "indCoop",
                isset($cad->indcoop) ? $cad->indcoop : null,
                ($this->tpInsc == 1) ? true : false //obrigatorio para pessoa juridica
            );
            $this->dom->addChild(
                $infoCadastro,
                "indConstr",
                isset($cad->indconstr) ? $cad->indconstr : null,
                ($this->tpInsc == 1) ? true : false //obrigatorio para pessoa juridica
            );
            $this->dom->addChild(
                $infoCadastro,
                "indDesFolha",
                $cad->inddesfolha,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "indOpcCP",
                !empty($cad->indopccp) ? $cad->indopccp : null,
                false
            );
            $this->dom->addChild(
                $infoCadastro,
                "indPorte",
                !empty($cad->indporte) ? $cad->indporte : null,
                false
            );
            $this->dom->addChild(
                $infoCadastro,
                "indOptRegEletron",
                $cad->indoptregeletron,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "cnpjEFR",
                !empty($cad->cnpjefr) ? $cad->cnpjefr : null,
                false
            );
        }
        if (isset($this->std->dadosisencao) && !empty($infoCadastro)) {
            $cad  = $this->std->dadosisencao;
            $info = $this->dom->createElement("dadosIsencao");
            $this->dom->addChild(
                $info,
                "ideMinLei",
                $cad->ideminlei,
                true
            );
            $this->dom->addChild(
                $info,
                "nrCertif",
                $cad->nrcertif,
                true
            );
            $this->dom->addChild(
                $info,
                "dtEmisCertif",
                $cad->dtemiscertif,
                true
            );
            $this->dom->addChild(
                $info,
                "dtVencCertif",
                $cad->dtvenccertif,
                true
            );
            $this->dom->addChild(
                $info,
                "nrProtRenov",
                !empty($cad->nrprotrenov) ? $cad->nrprotrenov : null,
                false
            );
            $this->dom->addChild(
                $info,
                "dtProtRenov",
                !empty($cad->dtprotrenov) ? $cad->dtprotrenov : null,
                false
            );
            $this->dom->addChild(
                $info,
                "dtDou",
                !empty($cad->dtdou) ? $cad->dtdou : null,
                false
            );
            $this->dom->addChild(
                $info,
                "pagDou",
                !empty($cad->pagdou) ? $cad->pagdou : null,
                false
            );
            $infoCadastro->appendChild($info);
        }
        if (isset($this->std->infoorginternacional) && !empty($infoCadastro)) {
            $cad = $this->std->infoorginternacional;
            $info = $this->dom->createElement("infoOrgInternacional");
            $this->dom->addChild(
                $info,
                "indAcordoIsenMulta",
                $cad->indacordoisenmulta,
                true
            );
            $infoCadastro->appendChild($info);
        }
        if (isset($this->std->novavalidade)) {
            $sh = $this->std->novavalidade;
            $novavalidade = $this->dom->createElement("novaValidade");
            $this->dom->addChild(
                $novavalidade,
                "iniValid",
                $sh->inivalid,
                true
            );
            $this->dom->addChild(
                $novavalidade,
                "fimValid",
                !empty($sh->fimValid) ? $sh->fimValid : null,
                false
            );
        }
        switch ($this->std->modo) {
            case "ALT":
                $node = $this->dom->createElement("alteracao");
                $node->appendChild($idePeriodo);
                if (isset($infoComplementares) && isset($infoCadastro)) {
                    $infoCadastro->appendChild($infoComplementares);
                }
                isset($infoCadastro) ? $node->appendChild($infoCadastro) : null;
                isset($novavalidade) ? $node->appendChild($novavalidade) : null;
                break;
            case "EXC":
                $node = $this->dom->createElement("exclusao");
                $node->appendChild($idePeriodo);
                break;
            case "INC":
            default:
                $node = $this->dom->createElement("inclusao");
                $node->appendChild($idePeriodo);
                if (isset($infoComplementares) && isset($infoCadastro)) {
                    $infoCadastro->appendChild($infoComplementares);
                }
                isset($infoCadastro) ? $node->appendChild($infoCadastro) : null;
        }
        $infoEmpregador->appendChild($node);
        $this->node->appendChild($infoEmpregador);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
