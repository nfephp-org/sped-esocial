<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS5002
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
            "nrRecArqBase",
            ! empty($this->std->nrrecarqbase) ? $this->std->nrrecarqbase : null,
            false
        );
        $this->dom->addChild(
            $ideEvento,
            "perApur",
            $this->std->perapur,
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
        if (! empty($this->std->vrdeddep)) {
            $infoDep = $this->dom->createElement("infoDep");
            $this->dom->addChild(
                $infoDep,
                "vrDedDep",
                $this->std->vrdeddep,
                true
            );
            $this->node->appendChild($infoDep);
        }
        foreach ($this->std->infoirrf as $nIrrf) {
            $infoIrrf = $this->dom->createElement("infoIrrf");
            $this->dom->addChild(
                $infoIrrf,
                "codCateg",
                ! empty($nIrrf->codcateg) ? $nIrrf->codcateg : null,
                false
            );
            $this->dom->addChild(
                $infoIrrf,
                "indResBr",
                $nIrrf->indresbr,
                true
            );
            foreach ($nIrrf->basesirrf as $base) {
                $basesIrrf = $this->dom->createElement("basesIrrf");
                $this->dom->addChild(
                    $basesIrrf,
                    "tpValor",
                    $base->tpvalor,
                    true
                );
                $this->dom->addChild(
                    $basesIrrf,
                    "valor",
                    $base->valor,
                    true
                );
                $infoIrrf->appendChild($basesIrrf);
            }
            foreach ($nIrrf->irrf as $base) {
                $irrf = $this->dom->createElement("irrf");
                $this->dom->addChild(
                    $irrf,
                    "tpCR",
                    $base->tpcr,
                    true
                );
                $this->dom->addChild(
                    $irrf,
                    "vrIrrfDesc",
                    $base->vrirrfdesc,
                    true
                );
                $infoIrrf->appendChild($irrf);
            }
            if (isset($nIrrf->idepgtoext)) {
                $idePgtoExt = $this->dom->createElement("idePgtoExt");
                $idePais    = $this->dom->createElement("idePais");
                $this->dom->addChild(
                    $idePais,
                    "codPais",
                    $nIrrf->idepgtoext->codpais,
                    true
                );
                $this->dom->addChild(
                    $idePais,
                    "indNIF",
                    $nIrrf->idepgtoext->indnif,
                    true
                );
                $this->dom->addChild(
                    $idePais,
                    "nifBenef",
                    ! empty($nIrrf->idepgtoext->nifbenef) ? $nIrrf->idepgtoext->nifbenef : null,
                    false
                );
                $idePgtoExt->appendChild($idePais);

                $endExt = $this->dom->createElement("endExt");
                $this->dom->addChild(
                    $endExt,
                    "dscLograd",
                    $nIrrf->idepgtoext->dsclograd,
                    true
                );
                $this->dom->addChild(
                    $endExt,
                    "nrLograd",
                    ! empty($nIrrf->idepgtoext->nrlograd) ? $nIrrf->idepgtoext->nrlograd : null,
                    false
                );
                $this->dom->addChild(
                    $endExt,
                    "complem",
                    ! empty($nIrrf->idepgtoext->complem) ? $nIrrf->idepgtoext->complem : null,
                    false
                );
                $this->dom->addChild(
                    $endExt,
                    "bairro",
                    ! empty($nIrrf->idepgtoext->bairro) ? $nIrrf->idepgtoext->bairro : null,
                    false
                );
                $this->dom->addChild(
                    $endExt,
                    "nmCid",
                    $nIrrf->idepgtoext->nmcid,
                    true
                );
                $this->dom->addChild(
                    $endExt,
                    "codPostal",
                    ! empty($nIrrf->idepgtoext->codpostal) ? $nIrrf->idepgtoext->codpostal : null,
                    false
                );
                $idePgtoExt->appendChild($endExt);
                $infoIrrf->appendChild($idePgtoExt);
                $this->node->appendChild($infoIrrf);
            }
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
    
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("TODO !!");
    }
}
