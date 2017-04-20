<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use stdClass;

class EvtAltContratual extends Factory implements FactoryInterface
{
    const EVT_NAME = 'evtAltContratual';

    public function __construct(stdClass $std)
    {
        parent::__construct($std);
    }
    

    public function toNode()
    {
/*
 <?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAltContratual/v02_02_01"
 *  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
 * xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAltContratual/v02_02_01 
 * ../schemes/evtAltContratual.xsd ">
  <evtAltContratual Id="idvalue0">
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
      <nisTrab>nisTrab</nisTrab>
      <matricula>matricula</matricula>
    </ideVinculo>
    <altContratual>
      <dtAlteracao>2001-01-01</dtAlteracao>
      <vinculo>
        <tpRegTrab>0</tpRegTrab>
        <tpRegPrev>0</tpRegPrev>
      </vinculo>
      <infoRegimeTrab/>
      <infoContrato>
        <codCateg>0</codCateg>
        <remuneracao>
          <vrSalFx>0.0</vrSalFx>
          <undSalFixo>0</undSalFixo>
        </remuneracao>
        <duracao>
          <tpContr>0</tpContr>
        </duracao>
        <localTrabalho/>
      </infoContrato>
    </altContratual>
  </evtAltContratual>
  <Signature/>
</eSocial>

 */
    }
}
