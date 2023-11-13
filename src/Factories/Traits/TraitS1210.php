<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS1210
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
            "perApur",
            $this->std->perapur,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "indGuia",
            !empty($this->std->indguia) ? $this->std->indguia : null,
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
        $ideBenef = $this->dom->createElement("ideBenef");
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        foreach ($this->std->infopgto as $pgto) {
            $infoPgto = $this->dom->createElement("infoPgto");
            $this->dom->addChild(
                $infoPgto,
                "dtPgto",
                $pgto->dtpgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "tpPgto",
                $pgto->tppgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "perRef",
                $pgto->perref,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "ideDmDev",
                $pgto->idedmdev,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "vrLiq",
                $pgto->vrliq,
                true
            );
            $ideBenef->appendChild($infoPgto);
        }
        $this->node->appendChild($ideBenef);
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
            "perApur",
            $this->std->perapur,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "indGuia",
            !empty($this->std->indguia) ? $this->std->indguia : null,
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
        $ideBenef = $this->dom->createElement("ideBenef");
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        foreach ($this->std->infopgto as $pgto) {
            $infoPgto = $this->dom->createElement("infoPgto");
            $this->dom->addChild(
                $infoPgto,
                "dtPgto",
                $pgto->dtpgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "tpPgto",
                $pgto->tppgto,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "perRef",
                $pgto->perref,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "ideDmDev",
                $pgto->idedmdev,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "vrLiq",
                $pgto->vrliq,
                true
            );
            $this->dom->addChild(
                $infoPgto,
                "paisResidExt",
                $pgto->paisresidext ?? null,
                false
            );
            if (!empty($pgto->paisresidext) && !empty($pgto->infopgtoext)) {
                $ext = $pgto->infopgtoext;
                $pgtoext = $this->dom->createElement("infoPgtoExt");
                $this->dom->addChild(
                    $pgtoext,
                    "indNIF",
                    $ext->indnif,
                    true
                );
                $this->dom->addChild(
                    $pgtoext,
                    "nifBenef",
                    $ext->nifbenef ?? null,
                    false
                );
                $this->dom->addChild(
                    $pgtoext,
                    "frmTribut",
                    $ext->frmtribut,
                    true
                );
                if (!empty($ext->endext)) {
                    $end = $ext->endext;
                    $endext = $this->dom->createElement("endExt");
                    $this->dom->addChild(
                        $endext,
                        "endDscLograd",
                        $end->enddsclograd ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endNrLograd",
                        $end->endnrlograd ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endComplem",
                        $end->endcomplem ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endBairro",
                        $end->endbairro ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endCidade",
                        $end->endcidade ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endEstado",
                        $end->endestado ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "endCodPostal",
                        $end->endcodpostal ?? null,
                        false
                    );
                    $this->dom->addChild(
                        $endext,
                        "telef",
                        $end->telef ?? null,
                        false
                    );
                    $pgtoext->appendChild($endext);
                }

                $infoPgto->appendChild($pgtoext);
            }
            $ideBenef->appendChild($infoPgto);
        }
        $this->node->appendChild($ideBenef);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
