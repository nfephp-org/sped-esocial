<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2220
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
            "indRetif",
            $this->std->indretif,
            true
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
            "nisTrab",
            !empty($this->std->idevinculo->nistrab) ? $this->std->idevinculo->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            !empty($this->std->idevinculo->matricula) ? $this->std->idevinculo->matricula : null,
            false
        );
        $this->node->appendChild($ideVinculo);

        if ($this->layoutStr !== 'v02_05_00') {
            $aso = $this->dom->createElement("aso");
            $this->dom->addChild(
                $aso,
                "dtAso",
                $this->std->aso->dtaso,
                true
            );
            $this->dom->addChild(
                $aso,
                "resAso",
                $this->std->aso->resaso,
                true
            );
            if (isset($this->std->aso->exame)) {
                foreach ($this->std->aso->exame as $exa) {
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
                        !empty($exa->procrealizado) ? $exa->procrealizado : null,
                        false
                    );
                    $this->dom->addChild(
                        $exame,
                        "obsProc",
                        !empty($exa->obsproc) ? $exa->obsproc : null,
                        false
                    );
                    $this->dom->addChild(
                        $exame,
                        "interprExm",
                        $exa->interprexm,
                        true
                    );
                    $this->dom->addChild(
                        $exame,
                        "ordExame",
                        !empty($exa->ordexame) ? $exa->ordexame : null,
                        false
                    );
                    $this->dom->addChild(
                        $exame,
                        "dtIniMonit",
                        $exa->dtinimonit,
                        true
                    );
                    $this->dom->addChild(
                        $exame,
                        "dtFimMonit",
                        !empty($exa->dtfimmonit) ? $exa->dtfimmonit : null,
                        false
                    );
                    $this->dom->addChild(
                        $exame,
                        "indResult",
                        !empty($exa->indresult) ? $exa->indresult : null,
                        false
                    );
                    $respMonit = $this->dom->createElement("respMonit");
                    $resm = $exa->respmonit;
                    $this->dom->addChild(
                        $respMonit,
                        "nisResp",
                        $resm->nisresp,
                        true
                    );
                    $this->dom->addChild(
                        $respMonit,
                        "nrConsClasse",
                        $resm->nrconsclasse,
                        true
                    );
                    $this->dom->addChild(
                        $respMonit,
                        "ufConsClasse",
                        !empty($resm->ufconsclasse) ? $resm->ufconsclasse : null,
                        false
                    );
                    $exame->appendChild($respMonit);
                    $aso->appendChild($exame);
                }
            }
            $ideServSaude = $this->dom->createElement("ideServSaude");
            $sers = $this->std->aso->ideservsaude;
            $this->dom->addChild(
                $ideServSaude,
                "codCNES",
                !empty($sers->codcnes) ? $sers->codcnes : null,
                false
            );
            $this->dom->addChild(
                $ideServSaude,
                "frmCtt",
                $sers->frmctt,
                true
            );
            $this->dom->addChild(
                $ideServSaude,
                "email",
                !empty($sers->email) ? $sers->email : null,
                false
            );
            $medico = $this->dom->createElement("medico");
            $med = $sers->medico;
            $this->dom->addChild(
                $medico,
                "nmMed",
                $med->nmmed,
                true
            );
            $crm = $this->dom->createElement("crm");
            $this->dom->addChild(
                $crm,
                "nrCRM",
                $med->nrcrm,
                true
            );
            $this->dom->addChild(
                $crm,
                "ufCRM",
                $med->ufcrm,
                true
            );
            $medico->appendChild($crm);
            $ideServSaude->appendChild($medico);
            $aso->appendChild($ideServSaude);
            $this->node->appendChild($aso);
        } else {
            $this->v020500();
        }
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    protected function v020500()
    {
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
            $stdaso->resaso,
            true
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
            "cpfMed",
            !empty($stdmed->cpfmed) ? $stdmed->cpfmed : null,
            false
        );
        $this->dom->addChild(
            $medico,
            "nisMed",
            !empty($stdmed->nismed) ? $stdmed->nismed : null,
            false
        );
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
            $stdaso->resaso,
            true
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
}
