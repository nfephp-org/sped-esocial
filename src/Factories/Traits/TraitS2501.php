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
}
