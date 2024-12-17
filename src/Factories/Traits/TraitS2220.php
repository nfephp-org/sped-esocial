<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2220
{
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

        $exMedOcup = $this->dom->createElement("exMedOcup");
        $this->dom->addChild(
            $exMedOcup,
            "tpExameOcup",
            $this->std->exmedocup->tpexameocup,
            true
        );
        $stdaso = $this->std->exmedocup->aso;
        $aso = $this->dom->createElement("aso");
        $this->dom->addChild(
            $aso,
            "dtAso",
            $stdaso->dtaso,
            true
        );
        $this->dom->addChild(
            $aso,
            "resAso",
            !empty($stdaso->resaso) ? $stdaso->resaso : null,
            false
        );

        foreach ($this->std->exmedocup->aso->exame as $exa) {
            $exame = $this->dom->createElement("exame");
            $this->dom->addChild(
                $exame,
                "dtExm",
                $exa->dtexm,
                true
            );
            $this->dom->addChild(
                $exame,
                "procRealizado",
                $exa->procrealizado,
                true
            );
            $this->dom->addChild(
                $exame,
                "obsProc",
                !empty($exa->obsproc) ? $exa->obsproc : null,
                false
            );
            $this->dom->addChild(
                $exame,
                "ordExame",
                !empty($exa->ordexame) ? $exa->ordexame : null,
                false
            );
            $this->dom->addChild(
                $exame,
                "indResult",
                !empty($exa->indresult) ? $exa->indresult : null,
                false
            );
            $aso->appendChild($exame);
        }

        $stdmed = $this->std->exmedocup->aso->medico;
        $medico = $this->dom->createElement("medico");
        $this->dom->addChild(
            $medico,
            "nmMed",
            $stdmed->nmmed,
            true
        );
        $this->dom->addChild(
            $medico,
            "nrCRM",
            $stdmed->nrcrm,
            true
        );
        $this->dom->addChild(
            $medico,
            "ufCRM",
            $stdmed->ufcrm,
            true
        );
        $aso->appendChild($medico);
        $exMedOcup->appendChild($aso);

        if (!empty($this->std->exmedocup->respmonit)) {
            $stdmon = $this->std->exmedocup->respmonit;
            $monit = $this->dom->createElement("respMonit");
            $this->dom->addChild(
                $monit,
                "cpfResp",
                !empty($stdmon->cpfresp) ? $stdmon->cpfresp : null,
                false
            );
            $this->dom->addChild(
                $monit,
                "nmResp",
                $stdmon->nmresp,
                true
            );
            $this->dom->addChild(
                $monit,
                "nrCRM",
                $stdmon->nrcrm,
                true
            );
            $this->dom->addChild(
                $monit,
                "ufCRM",
                $stdmon->ufcrm,
                true
            );
            $exMedOcup->appendChild($monit);
        }
        $this->node->appendChild($exMedOcup);

        //finalização do xml
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
