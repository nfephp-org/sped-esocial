<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use NFePHP\eSocial\Factories\EvtId;
use stdClass;

class EvtAdmPrelim extends Factory implements FactoryInterface
{
    const EVT_NAME = 'evtAdmPrelim';
    const EVT_CODE = 'S-1000';
  
    public $sequencial; //sequencial do evento
    public $cpfTrab; //string Length value="11" "\d{11}"
    public $dtNascto; //date
    public $dtAdm; //date
    
    protected $parameters = [
        'cpfTrab' => [
            'type'     => 'string',
            'regex'    => '\d{11}',
            'format'   => '11',
            'required' => true,
            'force'    => true
        ],
    ];

    public function __construct($config, stdClass $std)
    {
        parent::__construct($config, $std);
    }

    public function toNode()
    {
        $evtid = EvtId::build(
            $this->doctype,
            $this->docnum,
            $this->date,
            $this->sequencial
        );
        
 
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
