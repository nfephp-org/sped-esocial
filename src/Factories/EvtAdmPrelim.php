<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use NFePHP\eSocial\Factories\EvtId;
use stdClass;

class EvtAdmPrelim extends Factory implements FactoryInterface
{
    const EVT_NAME = 'evtAdmPrelim';
    const EVT_CODE = 'S-2190';
  
    public $sequencial; //sequencial do evento
    public $cpfTrab; //string Length value="11" "\d{11}"
    public $dtNascto; //date
    public $dtAdm; //date
    
    protected $parameters = [];

    /* '        'cpfTrab' => [
            'type'     => 'string',
            'regex'    => '\d{11}',
            'format'   => '11',
            'required' => true,
            'force'    => true
        ],
    ];*/

    public function __construct($config, stdClass $std)
    {
        parent::__construct($config, $std, $this);
    }

    public function toNode()
    {
        $evtid = EvtId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );
        $eSocial = $this->dom->getElementsByTagName("eSocial")->item(0);
        $evtAdmPrelim = $this->dom->createElement("evtAdmPrelim");
        $att = $this->dom->createAttribute('Id');
        $att->value = $evtid;
        $evtAdmPrelim->appendChild($att);
        
        $ideEvento = $this->dom->createElement("ideEvento");
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
        $evtAdmPrelim->appendChild($ideEvento);
        
    
        $ideEmpregador = $this->dom->createElement("ideEmpregador");
        $this->dom->addChild(
            $ideEmpregador,
            "tpInsc",
            $this->tpInsc,
            true
        );
        $this->dom->addChild(
            $ideEmpregador,
            "nrInsc",
            $this->nrInsc,
            true
        );
        $evtAdmPrelim->appendChild($ideEmpregador);
        
        
        $infoRegPrelim = $this->dom->createElement("infoRegPrelim");
        $this->dom->addChild(
            $infoRegPrelim,
            "cpfTrab",
            $this->cpfTrab,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtNascto",
            $this->dtNascto->format('Y-m-d'),
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtAdm",
            $this->dtAdm->format('Y-m-d'),
            true
        );
        $evtAdmPrelim->appendChild($infoRegPrelim);
        $eSocial->appendChild($evtAdmPrelim);
        $this->node = $eSocial;
        return $this->node;
/*    
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAdmPrelim/v02_02_01" 
 * xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
 * xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAdmPrelim/v02_02_01 
 * ../schemes/evtAdmPrelim.xsd ">
  <evtAdmPrelim Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoRegPrelim>
      <cpfTrab>cpfTrab</cpfTrab>
      <dtNascto>2001-01-01</dtNascto>
      <dtAdm>2001-01-01</dtAdm>
    </infoRegPrelim>
  </evtAdmPrelim>
  <Signature/>
</eSocial>
*/
    }
}
