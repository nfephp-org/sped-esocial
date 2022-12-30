<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2210
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
        $this->dom->addChild(
            $cat,
            "observacao",
            !empty($this->std->observacao) ? $this->std->observacao : null,
            false
        );
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
        
        foreach ($this->std->parteatingida as $pa) {
            $parteAtingida = $this->dom->createElement("parteAtingida");
            $this->dom->addChild(
                $parteAtingida,
                "codParteAting",
                $pa->codparteating,
                true
            );
            $this->dom->addChild(
                $parteAtingida,
                "lateralidade",
                $pa->lateralidade,
                true
            );
            $cat->appendChild($parteAtingida);
        }

        foreach ($this->std->agentecausador as $pa) {
            $agenteCausador = $this->dom->createElement("agenteCausador");
            $this->dom->addChild(
                $agenteCausador,
                "codAgntCausador",
                $pa->codagntcausador,
                true
            );
            $cat->appendChild($agenteCausador);
        }
        if (!empty($this->std->atestado)) {
            $pa = $this->std->atestado;
            $atestado = $this->dom->createElement("atestado");
            $this->dom->addChild(
                $atestado,
                "codCNES",
                !empty($pa->codcnes) ? $pa->codcnes : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "dtAtendimento",
                $pa->dtatendimento,
                true
            );
            $this->dom->addChild(
                $atestado,
                "hrAtendimento",
                $pa->hratendimento,
                true
            );
            $this->dom->addChild(
                $atestado,
                "indInternacao",
                $pa->indinternacao,
                true
            );
            $this->dom->addChild(
                $atestado,
                "durTrat",
                $pa->durtrat,
                true
            );
            $this->dom->addChild(
                $atestado,
                "indAfast",
                $pa->indafast,
                true
            );
            $this->dom->addChild(
                $atestado,
                "dscLesao",
                !empty($pa->dsclesao) ? $pa->dsclesao : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "dscCompLesao",
                !empty($pa->dsccomplesao) ? $pa->dsccomplesao : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "diagProvavel",
                !empty($pa->diagprovavel) ? $pa->diagprovavel : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "codCID",
                $pa->codcid,
                true
            );
            $this->dom->addChild(
                $atestado,
                "observacao",
                !empty($pa->observacao) ? $pa->observacao : null,
                false
            );
            $emitente = $this->dom->createElement("emitente");
            $this->dom->addChild(
                $emitente,
                "nmEmit",
                $pa->nmemit,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ideOC",
                $pa->ideoc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "nrOc",
                $pa->nroc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ufOC",
                !empty($pa->ufoc) ? $pa->ufoc : null,
                true
            );
            $atestado->appendChild($emitente);
            $cat->appendChild($atestado);
        }
        if (!empty($this->std->catorigem)) {
            $pa = $this->std->catorigem;
            $catOrigem = $this->dom->createElement("catOrigem");
            $this->dom->addChild(
                $catOrigem,
                "dtCatOrig",
                $pa->dtcatorig,
                true
            );
            $this->dom->addChild(
                $catOrigem,
                "nrCatOrig",
                !empty($pa->nrcatorig) ? $pa->nrcatorig : null,
                false
            );
            $cat->appendChild($catOrigem);
        }
        $this->node->appendChild($cat);
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
            $this->std->idevinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            !empty($this->std->idevinculo->matricula) ? $this->std->idevinculo->matricula : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "codCateg",
            !empty($this->std->idevinculo->codcateg) ? $this->std->idevinculo->codcateg : null,
            false
        );
        $this->node->appendChild($ideVinculo);
        
        $cat = $this->dom->createElement("cat");
        $this->dom->addChild(
            $cat,
            "dtAcid",
            $this->std->cat->dtacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "tpAcid",
            $this->std->cat->tpacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "hrAcid",
            !empty($this->std->cat->hracid) ? $this->std->cat->hracid : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "hrsTrabAntesAcid",
            !empty($this->std->cat->hrstrabantesacid) ? $this->std->cat->hrstrabantesacid : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "tpCat",
            $this->std->cat->tpcat,
            true
        );
        $this->dom->addChild(
            $cat,
            "indCatObito",
            $this->std->cat->indcatobito,
            true
        );
        $this->dom->addChild(
            $cat,
            "dtObito",
            !empty($this->std->cat->dtobito) ? $this->std->cat->dtobito : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "indComunPolicia",
            $this->std->cat->indcomunpolicia,
            true
        );
        $this->dom->addChild(
            $cat,
            "codSitGeradora",
            $this->std->cat->codsitgeradora,
            true
        );
        $this->dom->addChild(
            $cat,
            "iniciatCAT",
            $this->std->cat->iniciatcat,
            true
        );
        $this->dom->addChild(
            $cat,
            "obsCAT",
            !empty($this->std->cat->obscat) ? $this->std->cat->obscat : null,
            false
        );
        $localAcidente = $this->dom->createElement("localAcidente");
        $local = $this->std->cat->localacidente;
        $this->dom->addChild(
            $localAcidente,
            "tpLocal",
            $local->tplocal,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLocal",
            !empty($local->dsclocal) ? $local->dsclocal : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "tpLograd",
            !empty($local->tplograd) ? $local->tplograd : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLograd",
            $local->dsclograd,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "nrLograd",
            $local->nrlograd,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "complemento",
            !empty($local->complemento) ? $local->complemento : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "bairro",
            !empty($local->bairro) ? $local->bairro : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "cep",
            !empty($local->cep) ? $local->cep : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codMunic",
            !empty($local->codmunic) ? $local->codmunic : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "uf",
            !empty($local->uf) ? $local->uf : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "pais",
            !empty($local->pais) ? $local->pais : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codPostal",
            !empty($local->codpostal) ? $local->codpostal : null,
            false
        );
        if (!empty($local->idelocalacid)) {
            $ide = $local->idelocalacid;
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
        $parte = $this->std->cat->parteatingida;
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
            $this->std->cat->agentecausador->codagntcausador,
            true
        );
        $cat->appendChild($agenteCausador);
        
        if (!empty($this->std->cat->atestado)) {
            $ate = $this->std->cat->atestado;
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
                $ate->emitente->nmemit,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ideOC",
                $ate->emitente->ideoc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "nrOC",
                $ate->emitente->nroc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ufOC",
                $ate->emitente->ufoc,
                true
            );
            $atestado->appendChild($emitente);
            $cat->appendChild($atestado);
        }
        
        if (!empty($this->std->cat->catorigem)) {
            $catOrigem = $this->dom->createElement("catOrigem");
            $this->dom->addChild(
                $catOrigem,
                "nrRecCatOrig",
                $this->std->cat->catorigem->nrreccatorig,
                true
            );
            $cat->appendChild($catOrigem);
        }
        $this->node->appendChild($cat);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    /**
     * builder for version S.1.1.0
     */
    /**
     * TODO
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
            $this->std->idevinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            !empty($this->std->idevinculo->matricula) ? $this->std->idevinculo->matricula : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "codCateg",
            !empty($this->std->idevinculo->codcateg) ? $this->std->idevinculo->codcateg : null,
            false
        );
        $this->node->appendChild($ideVinculo);
        
        $cat = $this->dom->createElement("cat");
        $this->dom->addChild(
            $cat,
            "dtAcid",
            $this->std->cat->dtacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "tpAcid",
            $this->std->cat->tpacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "hrAcid",
            !empty($this->std->cat->hracid) ? $this->std->cat->hracid : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "hrsTrabAntesAcid",
            !empty($this->std->cat->hrstrabantesacid) ? $this->std->cat->hrstrabantesacid : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "tpCat",
            $this->std->cat->tpcat,
            true
        );
        $this->dom->addChild(
            $cat,
            "indCatObito",
            $this->std->cat->indcatobito,
            true
        );
        $this->dom->addChild(
            $cat,
            "dtObito",
            !empty($this->std->cat->dtobito) ? $this->std->cat->dtobito : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "indComunPolicia",
            $this->std->cat->indcomunpolicia,
            true
        );
        $this->dom->addChild(
            $cat,
            "codSitGeradora",
            $this->std->cat->codsitgeradora,
            true
        );
        $this->dom->addChild(
            $cat,
            "iniciatCAT",
            $this->std->cat->iniciatcat,
            true
        );
        $this->dom->addChild(
            $cat,
            "obsCAT",
            !empty($this->std->cat->obscat) ? $this->std->cat->obscat : null,
            false
        );
        $localAcidente = $this->dom->createElement("localAcidente");
        $local = $this->std->cat->localacidente;
        $this->dom->addChild(
            $localAcidente,
            "tpLocal",
            $local->tplocal,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLocal",
            !empty($local->dsclocal) ? $local->dsclocal : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "tpLograd",
            !empty($local->tplograd) ? $local->tplograd : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLograd",
            $local->dsclograd,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "nrLograd",
            $local->nrlograd,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "complemento",
            !empty($local->complemento) ? $local->complemento : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "bairro",
            !empty($local->bairro) ? $local->bairro : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "cep",
            !empty($local->cep) ? $local->cep : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codMunic",
            !empty($local->codmunic) ? $local->codmunic : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "uf",
            !empty($local->uf) ? $local->uf : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "pais",
            !empty($local->pais) ? $local->pais : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codPostal",
            !empty($local->codpostal) ? $local->codpostal : null,
            false
        );
        if (!empty($local->idelocalacid)) {
            $ide = $local->idelocalacid;
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
        $parte = $this->std->cat->parteatingida;
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
            $this->std->cat->agentecausador->codagntcausador,
            true
        );
        $cat->appendChild($agenteCausador);
        
        if (!empty($this->std->cat->atestado)) {
            $ate = $this->std->cat->atestado;
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
                $ate->emitente->nmemit,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ideOC",
                $ate->emitente->ideoc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "nrOC",
                $ate->emitente->nroc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ufOC",
                $ate->emitente->ufoc,
                true
            );
            $atestado->appendChild($emitente);
            $cat->appendChild($atestado);
        }
        
        if (!empty($this->std->cat->catorigem)) {
            $catOrigem = $this->dom->createElement("catOrigem");
            $this->dom->addChild(
                $catOrigem,
                "nrRecCatOrig",
                $this->std->cat->catorigem->nrreccatorig,
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
