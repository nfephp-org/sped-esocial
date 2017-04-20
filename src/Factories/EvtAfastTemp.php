<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use stdClass;

class EvtAfastTemp extends Factory implements FactoryInterface
{
    const EVT_NAME = 'evtAfastTemp';

    public function __construct(stdClass $std)
    {
        parent::__construct($std);
    }
    

    public function toNode()
    {
/*
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAfastTemp/v02_02_01" 
 * xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
 * xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAfastTemp/v02_02_01 
 * ../schemes/evtAfastTemp.xsd ">
  <evtAfastTemp Id="idvalue0">
    <ideEvento>
      <indRetif>0</indRetif>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <ideVinculo>
      <cpfTrab>cpfTrab</cpfTrab>
    </ideVinculo>
    <infoAfastamento/>
  </evtAfastTemp>
  <Signature/>
</eSocial>
 */
    }
}
