# EvtCAT

## Evento: evtCAT

## Alias: 


## Detalhamento


## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtCAT($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtCAT/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtCAT/v02_02_01 ../schemes/evtCAT.xsd ">
  <evtCAT Id="idvalue0">
    <ideEvento>
      <indRetif>0</indRetif>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideRegistrador>
      <tpRegistrador>0</tpRegistrador>
    </ideRegistrador>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <ideTrabalhador>
      <cpfTrab>cpfTrab</cpfTrab>
    </ideTrabalhador>
    <cat>
      <dtAcid>2001-01-01</dtAcid>
      <tpAcid>tpAcid</tpAcid>
      <hrAcid>hrAcid</hrAcid>
      <hrsTrabAntesAcid>hrsTrabAntesAcid</hrsTrabAntesAcid>
      <tpCat>0</tpCat>
      <indCatObito>indCatObito</indCatObito>
      <indComunPolicia>indComunPolicia</indComunPolicia>
      <iniciatCAT>0</iniciatCAT>
      <localAcidente>
        <tpLocal>0</tpLocal>
      </localAcidente>
      <parteAtingida>
        <codParteAting>0</codParteAting>
        <lateralidade>0</lateralidade>
      </parteAtingida>
      <agenteCausador>
        <codAgntCausador>0</codAgntCausador>
      </agenteCausador>
    </cat>
  </evtCAT>
  <Signature/>
</eSocial>

```
