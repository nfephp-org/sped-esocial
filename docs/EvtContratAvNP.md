# EvtContratAvNP

## Evento
 *evtContratAvNP*

## Alias
 **


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtContratAvNP($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtContratAvNP/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtContratAvNP/v02_02_01 ../schemes/evtContratAvNP.xsd ">
  <evtContratAvNP Id="idvalue0">
    <ideEvento>
      <indRetif>0</indRetif>
      <indApuracao>0</indApuracao>
      <perApur>perApur</perApur>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <remunAvNP>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
      <codLotacao>codLotacao</codLotacao>
      <vrBcCp00>0.0</vrBcCp00>
      <vrBcCp15>0.0</vrBcCp15>
      <vrBcCp20>0.0</vrBcCp20>
      <vrBcCp25>0.0</vrBcCp25>
      <vrBcCp13>0.0</vrBcCp13>
      <vrBcFgts>0.0</vrBcFgts>
      <vrDescCP>0.0</vrDescCP>
    </remunAvNP>
  </evtContratAvNP>
  <Signature/>
</eSocial>

```
