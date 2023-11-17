<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2501
{
    protected function toNode250()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão 2.5.0 !!");
    }

    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S 1.0.0 !!");
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
        if ($this->std->indretif == 2) {
            $this->dom->addChild(
                $ideEvento,
                "nrRecibo",
                $this->std->nrrecibo,
                true
            );
        }
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
        $ideproc = $this->dom->createElement("ideProc");
        $this->dom->addChild(
            $ideproc,
            "nrProcTrab",
            $this->std->nrproctrab,
            true
        );
        $this->dom->addChild(
            $ideproc,
            "perApurPgto",
            $this->std->perapurpgto,
            true
        );
        $this->dom->addChild(
            $ideproc,
            "obs",
            !empty($this->std->obs) ? $this->std->obs : null,
            false
        );
        $this->node->appendChild($ideproc);
        $idetrab = $this->dom->createElement("ideTrab");
        $att = $this->dom->createAttribute('cpfTrab');
        $att->value = $this->std->cpftrab;
        $idetrab->appendChild($att);
        foreach($this->std->calctrib as $calc) {
            $calctrib = $this->dom->createElement("calcTrib");
            $att0 = $this->dom->createAttribute('perRef');
            $att0->value = $calc->perref;
            $calctrib->appendChild($att0);
            $att1 = $this->dom->createAttribute('vrBcCpMensal');
            $att1->value = $calc->vrbccpmensal;
            $calctrib->appendChild($att1);
            $att2 = $this->dom->createAttribute('vrBcCp13');
            $att2->value = $calc->vrbccp13;
            $calctrib->appendChild($att2);
            $att3 = $this->dom->createAttribute('vrRendIRRF');
            $att3->value = $calc->vrrendirrf;
            $calctrib->appendChild($att3);
            $att4 = $this->dom->createAttribute('vrRendIRRF13');
            $att4->value = $calc->vrrendirrf13;
            $calctrib->appendChild($att4);
            foreach($calc->infocrcontrib as $info) {
                $infocont = $this->dom->createElement("infoCRContrib");
                $att0 = $this->dom->createAttribute('tpCR');
                $att0->value = $info->tpcr;
                $infocont->appendChild($att0);
                $att1 = $this->dom->createAttribute('vrCR');
                $att1->value = $info->vrcr;
                $infocont->appendChild($att1);
                $calctrib->appendChild($infocont);
            }
            $idetrab->appendChild($calctrib);
        }
        foreach($this->std->infocrirrf as $cr) {
            $infoirrf = $this->dom->createElement("infoCRIRRF");
            $att0 = $this->dom->createAttribute('tpCR');
            $att0->value = $cr->tpcr;
            $infoirrf->appendChild($att0);
            $att1 = $this->dom->createAttribute('vrCR');
            $att1->value = $cr->vrcr;
            $infoirrf->appendChild($att1);
            $idetrab->appendChild($infoirrf);
        }
        $this->node->appendChild($idetrab);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }

    /**
     * builder for version S.1.2.0
     */
    protected function toNodeS120()
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
        if ($this->std->indretif == 2) {
            $this->dom->addChild(
                $ideEvento,
                "nrRecibo",
                $this->std->nrrecibo,
                true
            );
        }
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
        $ideproc = $this->dom->createElement("ideProc");
        $this->dom->addChild(
            $ideproc,
            "nrProcTrab",
            $this->std->nrproctrab,
            true
        );
        $this->dom->addChild(
            $ideproc,
            "perApurPgto",
            $this->std->perapurpgto,
            true
        );
        $this->dom->addChild(
            $ideproc,
            "obs",
            $this->std->obs ?? null,
            false
        );
        $this->node->appendChild($ideproc);
        foreach ($this->std->idetrab as $ide) {
            $idetrab = $this->dom->createElement("ideTrab");
            $this->dom->addAttribute($idetrab, 'cpfTrab', $ide->cpftrab);
            if (!empty($ide->calctrib)) {}
            if (!empty($ide->infocrirrf)) {
                foreach ($ide->infocrirrf as $cr) {
                    $infocrirrf = $this->dom->createElement("infoCRIRRF");
                    $this->dom->addAttribute($infocrirrf, 'tpCR', $cr->tpcr ?? null);
                    $this->dom->addAttribute($infocrirrf, 'vrCR', $cr->vrcr ?? null);
                    if (!empty($cr->infoir)) {
                        $iir = $cr->infoir;
                        $infoir = $this->dom->createElement("infoIR");
                        $this->dom->addAttribute($infoir, 'vrRendTrib', $iir->vrrendtrib ?? null);
                        $this->dom->addAttribute($infoir, 'vrRendTrib13', $iir->vrrendtrib13 ?? null);
                        $this->dom->addAttribute($infoir, 'vrRendMoleGrave', $iir->vrrendmolegrave ?? null);
                        $this->dom->addAttribute($infoir, 'vrRendIsen65', $iir->vrrendisen65 ?? null);
                        $this->dom->addAttribute($infoir, 'vrJurosMora', $iir->vrjurosmora ?? null);
                        $this->dom->addAttribute($infoir, 'vrRendIsenNTrib', $iir->vrrendisenntrib ?? null);
                        $this->dom->addAttribute($infoir, 'descIsenNTrib', $iir->descisenntrib ?? null);
                        $this->dom->addAttribute($infoir, 'vrPrevOficial', $iir->vrprevoficial ?? null);
                        $infocrirrf->appendChild($infoir);
                    }
                    if (!empty($cr->inforra)) {
                        $rra = $cr->inforra;
                        $inforra = $this->dom->createElement("infoRRA");
                        $this->dom->addAttribute($inforra, 'descRRA', $rra->descrra ?? null);
                        $this->dom->addAttribute($inforra, 'qtdMesesRRA', $rra->qtdmesesrra ?? null);
                        if (!empty($rra->despprocjud)) {
                            $des = $rra->despprocjud;
                            $despprocjud = $this->dom->createElement("despProcJud");
                            $this->dom->addAttribute($despprocjud, 'vlrDespCustas', $des->vlrdespcustas ?? null);
                            $this->dom->addAttribute($despprocjud, 'vlrDespAdvogados', $des->vlrdespadvogados ?? null);
                            $inforra->appendChild($despprocjud);
                        }
                        if (!empty($rra->ideadv)) {
                            foreach($rra->ideadv as $adv) {
                                $ideadv = $this->dom->createElement("ideAdv");
                                $this->dom->addAttribute($ideadv, 'tpInsc', $adv->tpinsc ?? null);
                                $this->dom->addAttribute($ideadv, 'nrInsc', $adv->nrinsc ?? null);
                                $this->dom->addAttribute($ideadv, 'vlrAdv', $adv->vlradv ?? null);
                                $inforra->appendChild($ideadv);
                            }
                        }
                        $infocrirrf->appendChild($inforra);
                    }
                    if (!empty($cr->deddepen)) {
                        foreach ($cr->deddepen as $ded) {
                            $deddepen = $this->dom->createElement("dedDepen");
                            $this->dom->addAttribute($deddepen, 'tpRend', $ded->tprend ?? null);
                            $this->dom->addAttribute($deddepen, 'cpfDep', $ded->cpfdep ?? null);
                            $this->dom->addAttribute($deddepen, 'vlrDeducao', $ded->vlrdeducao ?? null);
                            $infocrirrf->appendChild($deddepen);
                        }
                    }
                    if (!empty($cr->penalim)) {
                        foreach($cr->penalim as $pen) {
                            $penalim = $this->dom->createElement("penAlim");
                            $this->dom->addAttribute($penalim, 'tpRend', $pen->tprend ?? null);
                            $this->dom->addAttribute($penalim, 'cpfDep', $pen->cpfdep ?? null);
                            $this->dom->addAttribute($penalim, 'vlrPensao', $pen->vlrpensao ?? null);
                            $infocrirrf->appendChild($penalim);
                        }
                    }
                    if (!empty($cr->infoprocret)) {
                        foreach ($cr->infoprocret as $ret) {
                            $infoprocret = $this->dom->createElement("infoProcRet");
                            $this->dom->addAttribute($infoprocret, 'tpProcRet', $ret->tpprocret ?? null);
                            $this->dom->addAttribute($infoprocret, 'nrProcRet', $ret->nrprocret ?? null);
                            $this->dom->addAttribute($infoprocret, 'codSusp', $ret->codsusp ?? null);
                            if (!empty($ret->infovalores)) {
                                foreach($ret->infovalores as $val) {
                                    $infovalores = $this->dom->createElement("infoValores");
                                    $this->dom->addAttribute($infovalores, 'indApuracao', $val->indapuracao ?? null);
                                    $this->dom->addAttribute($infovalores, 'vlrNRetido', $val->vlrnretido ?? null);
                                    $this->dom->addAttribute($infovalores, 'vlrDepJud', $val->vlrdepjud ?? null);
                                    $this->dom->addAttribute($infovalores, 'vlrCmpAnoCal', $val->vlrcmpanocal ?? null);
                                    $this->dom->addAttribute($infovalores, 'vlrCmpAnoAnt', $val->vlrcmpanoant ?? null);
                                    $this->dom->addAttribute($infovalores, 'vlrRendSusp', $val->vlrrendsusp ?? null);
                                    if (!empty($val->dedsusp)) {
                                        foreach($val->dedsusp as $sus) {
                                            $dedsusp = $this->dom->createElement("dedSusp");
                                            $this->dom->addAttribute($dedsusp, 'indTpDeducao', $sus->indtpdeducao ?? null);
                                            $this->dom->addAttribute($dedsusp, 'vlrDedSusp', $sus->vlrdedsusp ?? null);
                                            if (!empty($sus->benefpen)) {
                                                foreach($sus->benefpen as $ben) {
                                                    $benefpen = $this->dom->createElement("benefPen");
                                                    $this->dom->addAttribute($benefpen, 'cpfDep', $ben->cpfdep ?? null);
                                                    $this->dom->addAttribute($benefpen, 'vlrDepenSusp', $ben->vlrdepensusp ?? null);
                                                    $dedsusp->appendChild($benefpen);
                                                }
                                            }
                                            $infovalores->appendChild($dedsusp);
                                        }
                                    }
                                    $infoprocret->appendChild($infovalores);
                                }
                            }
                            $infocrirrf->appendChild($infoprocret);
                        }
                    }
                    $idetrab->appendChild($infocrirrf);
                }
            }
            if (!empty($ide->infoircomplem)) {
                $infoircomplem = $this->dom->createElement("infoIRComplem");
                $this->dom->addAttribute($infoircomplem, 'dtLaudo', $ide->infoircomplem->dtlaudo ?? null);
                if (!empty($ide->infoircomplem->infodep)) {
                    foreach($ide->infoircomplem->infodep as $dep) {
                        $infodep = $this->dom->createElement("infoDep");
                        $this->dom->addAttribute($infodep, 'cpfDep', $dep->cpfdep ?? null);
                        $this->dom->addAttribute($infodep, 'dtNascto', $dep->dtnascto ?? null);
                        $this->dom->addAttribute($infodep, 'nome', $dep->nome ?? null);
                        $this->dom->addAttribute($infodep, 'depIRRF', $dep->depirrf ?? null);
                        $this->dom->addAttribute($infodep, 'tpDep', $dep->tpdep ?? null);
                        $this->dom->addAttribute($infodep, 'descrDep', $dep->descrdep ?? null);
                        $infoircomplem->appendChild($infodep);
                    }
                }
                $idetrab->appendChild($infoircomplem);
            }
        }
        $this->node->appendChild($idetrab);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
