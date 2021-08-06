<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2220
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

        $evtMonit = $this->dom->createElement("evtMonit");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtMonit->appendChild($att);

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
            $this->std->idevinculo->nistrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->idevinculo->matricula,
            true
        );

        $this->node->appendChild($ideVinculo);

        $aso = $this->dom->createElement("aso");

        $this->dom->addChild(
            $aso,
            "dtAso",
            $this->std->aso->dtaso,
            true
        );

        $this->dom->addChild(
            $aso,
            "tpAso",
            $this->std->aso->tpaso,
            true
        );

        $this->dom->addChild(
            $aso,
            "resAso",
            $this->std->aso->resaso,
            true
        );

        if (isset($this->std->exame)) {
            foreach ($this->std->exame as $exam) {
                $exame = $this->dom->createElement("exame");

                $this->dom->addChild(
                    $exame,
                    "dtExm",
                    $exam->dtexm,
                    true
                );

                $this->dom->addChild(
                    $exame,
                    "procRealizado",
                    ! empty($exam->procrealizado) ? $exam->procrealizado : null,
                    false
                );

                $this->dom->addChild(
                    $exame,
                    "obsProc",
                    ! empty($exam->obsproc) ? $exam->obsproc : null,
                    false
                );

                $this->dom->addChild(
                    $exame,
                    "interprExm",
                    $exam->interprexm,
                    true
                );

                $this->dom->addChild(
                    $exame,
                    "ordExame",
                    $exam->ordexame,
                    true
                );

                $this->dom->addChild(
                    $exame,
                    "dtIniMonit",
                    $exam->dtinimonit,
                    true
                );

                $this->dom->addChild(
                    $exame,
                    "dtFimMonit",
                    ! empty($exam->dtfimmonit) ? $exam->dtfimmonit : null,
                    false
                );

                $this->dom->addChild(
                    $exame,
                    "indResult",
                    ! empty($exam->indresult) ? $exam->indresult : null,
                    false
                );

                $aso->appendChild($exame);
            }
        }

        $respMonit = $this->dom->createElement("respMonit");

        $this->dom->addChild(
            $respMonit,
            "nisResp",
            $this->std->respmonit->nisresp,
            true
        );

        $this->dom->addChild(
            $respMonit,
            "nrConsClasse",
            $this->std->respmonit->nrconsclasse,
            true
        );

        $this->dom->addChild(
            $respMonit,
            "ufConsClasse",
            ! empty($this->std->respmonit->ufconsclasse) ? $this->std->respmonit->ufconsclasse : null,
            false
        );

        $exame->appendChild($respMonit);

        $ideServSaude = $this->dom->createElement("ideServSaude");

        $this->dom->addChild(
            $ideServSaude,
            "codCNES",
            ! empty($this->std->ideservsaude->codcnes) ? $this->std->ideservsaude->codcnes : null,
            false
        );

        $this->dom->addChild(
            $ideServSaude,
            "frmCtt",
            $this->std->ideservsaude->frmctt,
            true
        );

        $this->dom->addChild(
            $ideServSaude,
            "email",
            ! empty($this->std->ideservsaude->email) ? $this->std->ideservsaude->email : null,
            false
        );

        $aso->appendChild($ideServSaude);

        $medico = $this->dom->createElement("medico");

        $this->dom->addChild(
            $medico,
            "nmMed",
            $this->std->medico->nmmed,
            true
        );

        $ideServSaude->appendChild($medico);

        $crm = $this->dom->createElement("crm");

        $this->dom->addChild(
            $crm,
            "nrCRM",
            $this->std->medico->nrcrm,
            true
        );

        $this->dom->addChild(
            $crm,
            "ufCRM",
            $this->std->medico->ufcrm,
            true
        );

        $medico->appendChild($crm);

        $this->node->appendChild($aso);

        $this->eSocial->appendChild($this->node);
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
            "matricula",
            !empty($this->std->idevinculo->matricula) ? $this->std->idevinculo->matricula : null,
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
                $exa->ordexame,
                true
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
        $this->node->appendChild($exMedOcup);
        
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
