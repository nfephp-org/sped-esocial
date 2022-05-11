<?php

namespace NFePHP\eSocial\Factories\Traits;

use NFePHP\eSocial\Common\FactoryId;

trait TraitS2231
{
    /**
     * builder for version 2.5.0
     */
    protected function toNode250()
    {
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );

        $evtAfastTemp = $this->dom->createElement("evtCessao");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtAfastTemp->appendChild($att);

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
        $evtAfastTemp->appendChild($ideEvento);

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
            "nisTrab",
            $this->std->idevinculo->nistrab,
            true
        );
        if (isset($this->std->idevinculo->matricula) && !empty($this->std->idevinculo->matricula)){
            $this->dom->addChild(
                $ideVinculo,
                "matricula",
                $this->std->idevinculo->matricula,
                false
            );
        }
        $this->node->appendChild($ideVinculo);

        $infoCessao = $this->dom->createElement("infoCessao");

        if (!empty($this->std->infoCessao->inicessao)) {
            $iniCessao = $this->dom->createElement("iniCessao");

            $this->dom->addChild(
                $iniCessao,
                "dtIniCessao",
                $this->std->infoCessao->inicessao->dtIniCessao,
                true
            );

            $this->dom->addChild(
                $iniCessao,
                "cnpjCess",
                $this->std->infoCessao->inicessao->cnpjCess,
                true
            );

            $this->dom->addChild(
                $iniCessao,
                "respRemun",
                $this->std->infoCessao->inicessao->respRemun,
                true
            );
        }

        if (!empty($this->std->infoCessao->fimCessao)) {
            $fimCessao = $this->dom->createElement("fimCessao");
            $this->dom->addChild(
                $fimCessao,
                "dtTermCessao",
                $this->std->infoCessao->fimCessao->dtTermCessao,
                true
            );
            $infoCessao->appendChild($fimCessao);
        }
        
        $this->node->appendChild($infoCessao);

        $this->eSocial->appendChild($this->node);
        $this->sign();
    }

    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );

        $evtAfastTemp = $this->dom->createElement("evtCessao");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtAfastTemp->appendChild($att);

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
        $evtAfastTemp->appendChild($ideEvento);

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
            "nisTrab",
            $this->std->idevinculo->nistrab,
            true
        );
        if (isset($this->std->idevinculo->matricula) && !empty($this->std->idevinculo->matricula)){
            $this->dom->addChild(
                $ideVinculo,
                "matricula",
                $this->std->idevinculo->matricula,
                false
            );
        }
        $this->node->appendChild($ideVinculo);

        $infoCessao = $this->dom->createElement("infoCessao");

        if (!empty($this->std->infoCessao->inicessao)) {
            $iniCessao = $this->dom->createElement("iniCessao");

            $this->dom->addChild(
                $iniCessao,
                "dtIniCessao",
                $this->std->infoCessao->inicessao->dtIniCessao,
                true
            );

            $this->dom->addChild(
                $iniCessao,
                "cnpjCess",
                $this->std->infoCessao->inicessao->cnpjCess,
                true
            );

            $this->dom->addChild(
                $iniCessao,
                "respRemun",
                $this->std->infoCessao->inicessao->respRemun,
                true
            );
        }

        if (!empty($this->std->infoCessao->fimCessao)) {
            $fimCessao = $this->dom->createElement("fimCessao");
            $this->dom->addChild(
                $fimCessao,
                "dtTermCessao",
                $this->std->infoCessao->fimCessao->dtTermCessao,
                true
            );
            $infoCessao->appendChild($fimCessao);
        }
        
        $this->node->appendChild($infoCessao);

        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}