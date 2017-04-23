# EvtAvPrevio

## Evento
 *evtAvPrevio*

## Alias
 **


## Detalhamento



## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtAvPrevio($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAvPrevio/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAvPrevio/v02_02_01 ../schemes/evtAvPrevio.xsd ">
  <evtAvPrevio Id="idvalue0">
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
    <infoAvPrevio>
      <detAvPrevio>
        <dtAvPrv>2001-01-01</dtAvPrv>
        <dtPrevDeslig>2001-01-01</dtPrevDeslig>
        <tpAvPrevio>0</tpAvPrevio>
      </detAvPrevio>
    </infoAvPrevio>
  </evtAvPrevio>
  <Signature/>
</eSocial>

```
