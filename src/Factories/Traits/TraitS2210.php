<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2210
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
            !empty($this->std->matricula) ? $this->std->matricula : null,
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
        $this->dom->addChild(
            $cat,
            "ultDiaTrab",
            $this->std->ultdiatrab,
            true
        );
        $this->dom->addChild(
            $cat,
            "houveAfast",
            $this->std->houveafast,
            true
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
        return $this->toNodeS100();
    }

    /**
     * builder for version S.1.3.0
     */
    protected function toNodeS130()
    {
        return $this->toNodeS100();
    }
}
