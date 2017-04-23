# EvtTabRubrica

## Evento
 *evtTabRubrica*

## Alias
 **


## Detalhamento



## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtTabRubrica($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTabRubrica/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTabRubrica/v02_02_01 ../schemes/evtTabRubrica.xsd ">
  <evtTabRubrica Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoRubrica>
      <inclusao>
        <ideRubrica>
          <codRubr>codRubr</codRubr>
          <iniValid>iniValid</iniValid>
        </ideRubrica>
        <dadosRubrica>
          <dscRubr>dscRubr</dscRubr>
          <natRubr>0</natRubr>
          <tpRubr>0</tpRubr>
          <codIncCP>codIncCP</codIncCP>
          <codIncIRRF>codIncIRRF</codIncIRRF>
          <codIncFGTS>codIncFGTS</codIncFGTS>
          <codIncSIND>codIncSIND</codIncSIND>
          <repDSR>repDSR</repDSR>
          <rep13>rep13</rep13>
          <repFerias>repFerias</repFerias>
          <repAviso>repAviso</repAviso>
        </dadosRubrica>
      </inclusao>
    </infoRubrica>
  </evtTabRubrica>
  <Signature/>
</eSocial>

```
