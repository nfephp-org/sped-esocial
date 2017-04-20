<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use stdClass;

class EvtAdmPrelim extends Factory implements FactoryInterface
{
    const EVT_NAME = 'evtAdmPrelim';

    public $id;
    public $tpAmb;
    public $procEmi;
    public $verProc;
    
    public $tpInsc;
    public $nrInsc;
    public $cpfTrab;
    public $dtNascto;
    public $dtAdm;
    
    public function __construct(stdClass $std)
    {
        parent::__construct($std);
    }
    

    public function toNode()
    {
        
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
