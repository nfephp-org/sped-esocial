<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2210
{

    protected function tagRegistrador(\DOMElement $ideEmpregador)
    {
        $ideRegistrador = $this->dom->createElement("ideRegistrador");
        $this->dom->addChild(
            $ideRegistrador,
            "tpRegistrador",
            $this->std->tpregistrador,
            true
        );
        $this->dom->addChild(
            $ideRegistrador,
            "tpInsc",
            !empty($this->std->tpinsc) ? $this->std->tpinsc : null,
            false
        );
        $this->dom->addChild(
            $ideRegistrador,
            "nrInsc",
            !empty($this->std->nrinsc) ? $this->std->nrinsc : null,
            false
        );
        $this->node->insertBefore($ideRegistrador, $ideEmpregador);
    }

    protected function tagTrabalhador()
    {
        $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ideTrabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideTrabalhador,
            "nisTrab",
            !empty($this->std->nistrab) ? $this->std->nistrab : null,
            false
        );
        $this->node->appendChild($ideTrabalhador);
    }

    protected function tagVinculo()
    {
        $ideVinculo = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            !empty($this->std->nistrab) ? $this->std->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            isset($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "codCateg",
            !empty($this->std->codcateg) ? $this->std->codcateg : null,
            false
        );
        $this->node->appendChild($ideVinculo);
    }

    protected function tagCAT()
    {
        $cat = $this->dom->createElement("cat");
        $this->dom->addChild(
            $cat,
            "dtAcid",
            $this->std->dtacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "tpAcid",
            $this->std->tpacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "hrAcid",
            $this->std->hracid,
            true
        );
        $this->dom->addChild(
            $cat,
            "hrsTrabAntesAcid",
            $this->std->hrstrabantesacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "tpCat",
            $this->std->tpcat,
            true
        );
        $this->dom->addChild(
            $cat,
            "indCatObito",
            $this->std->indcatobito,
            true
        );
        $this->dom->addChild(
            $cat,
            "dtObito",
            !empty($this->std->dtobito) ? $this->std->dtobito : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "indComunPolicia",
            $this->std->indcomunpolicia,
            true
        );
        $this->dom->addChild(
            $cat,
            "codSitGeradora",
            !empty($this->std->codsitgeradora) ? $this->std->codsitgeradora : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "iniciatCAT",
            $this->std->iniciatcat,
            true
        );
        if ($this->layoutStr !== 'v02_04_02') {
            $this->dom->addChild(
                $cat,
                "obsCAT",
                !empty($this->std->obscat) ? $this->std->obscat : null,
                false
            );
        } else {
            $this->dom->addChild(
                $cat,
                "observacao",
                !empty($this->std->observacao) ? $this->std->observacao : null,
                false
            );
        }
        return $cat;
    }

    protected function tagLocalAcidente(\DOMElement &$cat)
    {
        $localAcidente = $this->dom->createElement("localAcidente");
        $this->dom->addChild(
            $localAcidente,
            "tpLocal",
            $this->std->tplocal,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLocal",
            !empty($this->std->dsclocal) ? $this->std->dsclocal : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codAmb",
            !empty($this->std->codamb) ? $this->std->codamb : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "tpLograd",
            !empty($this->std->tplograd) ? $this->std->tplograd : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLograd",
            !empty($this->std->dsclograd) ? $this->std->dsclograd : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "nrLograd",
            !empty($this->std->nrlograd) ? $this->std->nrlograd : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "complemento",
            !empty($this->std->complemento) ? $this->std->complemento : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "bairro",
            !empty($this->std->bairro) ? $this->std->bairro : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "cep",
            !empty($this->std->cep) ? $this->std->cep : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codMunic",
            !empty($this->std->codmunic) ? $this->std->codmunic : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "uf",
            !empty($this->std->uf) ? $this->std->uf : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "cnpjLocalAcid",
            !empty($this->std->cnpjlocalacid) ? $this->std->cnpjlocalacid : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "pais",
            !empty($this->std->pais) ? $this->std->pais : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codPostal",
            !empty($this->std->codpostal) ? $this->std->codpostal : null,
            false
        );
        $cat->appendChild($localAcidente);

        return $localAcidente;
    }

    protected function tagIdeLocalAcid(\DOMElement &$cat)
    {
        $ideLocalAcid = $this->dom->createElement("ideLocalAcid");
        $this->dom->addChild(
            $ideLocalAcid,
            "tpInsc",
            $this->std->idelocalacid->tpinsc,
            true
        );
        $this->dom->addChild(
            $ideLocalAcid,
            "nrInsc",
            $this->std->idelocalacid->nrinsc,
            true
        );
        $cat->appendChild($ideLocalAcid);
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
        
        $ideVinculo = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            isset($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "codCateg",
            !empty($this->std->codcateg) ? $this->std->codcateg : null,
            false
        );
        $this->node->appendChild($ideVinculo);
        
        $cat = $this->dom->createElement("cat");
        $this->dom->addChild(
            $cat,
            "dtAcid",
            $this->std->dtacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "tpAcid",
            $this->std->tpacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "hrAcid",
            !empty($this->std->hracid) ? $this->std->hracid : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "hrsTrabAntesAcid",
            !empty($this->std->hrstrabantesacid) ? $this->std->hrstrabantesacid : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "tpCat",
            $this->std->tpcat,
            true
        );
        $this->dom->addChild(
            $cat,
            "indCatObito",
            $this->std->indcatobito,
            true
        );
        $this->dom->addChild(
            $cat,
            "dtObito",
            !empty($this->std->dtobito) ? $this->std->dtobito : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "indComunPolicia",
            $this->std->indcomunpolicia,
            true
        );
        $this->dom->addChild(
            $cat,
            "codSitGeradora",
            $this->std->codsitgeradora,
            true
        );
        $this->dom->addChild(
            $cat,
            "iniciatCAT",
            $this->std->iniciatcat,
            true
        );
        $this->dom->addChild(
            $cat,
            "obsCAT",
            !empty($this->std->obscat) ? $this->std->obscat : null,
            false
        );
    /*  entra em producao dia 16/01/2023       
        $this->dom->addChild(
            $cat,
            "ultDiaTrab",
            !empty($this->std->ultdiatrab) ? $this->std->ultdiatrab : null,
            false
        );        
        $this->dom->addChild(
            $cat,
            "houveAfast",
            !empty($this->std->houveafast) ? $this->std->houveafast : null,
            false
        ); */
        $localAcidente = $this->dom->createElement("localAcidente");
        $this->dom->addChild(
            $localAcidente,
            "tpLocal",
            $this->std->tplocal,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLocal",
            !empty($this->std->dsclocal) ? $this->std->dsclocal : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "tpLograd",
            !empty($this->std->tplograd) ? $this->std->tplograd : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLograd",
            $this->std->dsclograd,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "nrLograd",
            $this->std->nrlograd,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "complemento",
            !empty($this->std->complemento) ? $this->std->complemento : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "bairro",
            !empty($this->std->bairro) ? $this->std->bairro : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "cep",
            !empty($this->std->cep) ? $this->std->cep : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codMunic",
            !empty($this->std->codmunic) ? $this->std->codmunic : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "uf",
            !empty($this->std->uf) ? $this->std->uf : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "pais",
            !empty($this->std->pais) ? $this->std->pais : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codPostal",
            !empty($this->std->codpostal) ? $this->std->codpostal : null,
            false
        );
        
        if (!empty($this->std->idelocalacid)) {
            $ide = $this->std->idelocalacid;
            $ideLocalAcid = $this->dom->createElement("ideLocalAcid");
            $this->dom->addChild(
                $ideLocalAcid,
                "tpInsc",
                $ide->tpinsc,
                true
            );
            $this->dom->addChild(
                $ideLocalAcid,
                "nrInsc",
                $ide->nrinsc,
                true
            );
            $localAcidente->appendChild($ideLocalAcid);
        }
        $cat->appendChild($localAcidente);
        
        $parteAtingida = $this->dom->createElement("parteAtingida");
        $parte = $this->std->parteatingida;
        $this->dom->addChild(
            $parteAtingida,
            "codParteAting",
            $parte->codparteating,
            true
        );
        $this->dom->addChild(
            $parteAtingida,
            "lateralidade",
            $parte->lateralidade,
            true
        );
        $cat->appendChild($parteAtingida);
        
        $agenteCausador = $this->dom->createElement("agenteCausador");
        $this->dom->addChild(
            $agenteCausador,
            "codAgntCausador",
            $this->std->agentecausador->codagntcausador,
            true
        );
        $cat->appendChild($agenteCausador);
        
        if (!empty($this->std->atestado)) {
            $ate = $this->std->atestado;
            $atestado = $this->dom->createElement("atestado");
            $this->dom->addChild(
                $atestado,
                "dtAtendimento",
                $ate->dtatendimento,
                true
            );
            $this->dom->addChild(
                $atestado,
                "hrAtendimento",
                $ate->hratendimento,
                true
            );
            $this->dom->addChild(
                $atestado,
                "indInternacao",
                $ate->indinternacao,
                true
            );
            $this->dom->addChild(
                $atestado,
                "durTrat",
                $ate->durtrat,
                true
            );
            $this->dom->addChild(
                $atestado,
                "indAfast",
                $ate->indafast,
                true
            );
            $this->dom->addChild(
                $atestado,
                "dscLesao",
                $ate->dsclesao,
                true
            );
            $this->dom->addChild(
                $atestado,
                "dscCompLesao",
                !empty($ate->dsccomplesao) ? $ate->dsccomplesao : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "diagProvavel",
                !empty($ate->diagprovavel) ? $ate->diagprovavel : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "codCID",
                $ate->codcid,
                true
            );
            $this->dom->addChild(
                $atestado,
                "observacao",
                !empty($ate->observacao) ? $ate->observacao : null,
                false
            );
            $emitente = $this->dom->createElement("emitente");
            $this->dom->addChild(
                $emitente,
                "nmEmit",
                $ate->nmemit,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ideOC",
                $ate->ideoc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "nrOC",
                $ate->nroc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ufOC",
                $ate->ufoc,
                true
            );
            $atestado->appendChild($emitente);
            $cat->appendChild($atestado);
        }
        
        if (!empty($this->std->catorigem)) {
            $catOrigem = $this->dom->createElement("catOrigem");
            $this->dom->addChild(
                $catOrigem,
                "nrRecCatOrig",
                $this->std->catorigem->nrreccatorig,
                true
            );
            $cat->appendChild($catOrigem);
        }
        $this->node->appendChild($cat);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
