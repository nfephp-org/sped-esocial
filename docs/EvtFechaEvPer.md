# EvtFechaEvPer

## Evento
 *evtFechaEvPer*

## Alias
 **


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
     $evt = Event::evtFechaEvPer($configJson, $std);
} catch (\Exception $e) {
    //aqui você trata as exceptions
}
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtFechaEvPer/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtFechaEvPer/v02_02_01 ../schemes/evtFechaEvPer.xsd ">
  <evtFechaEvPer Id="idvalue0">
    <ideEvento>
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
    <ideRespInf>
      <nmResp>nmResp</nmResp>
      <cpfResp>cpfResp</cpfResp>
      <telefone>telefone</telefone>
    </ideRespInf>
    <infoFech>
      <evtRemun>evtRemun</evtRemun>
      <evtPgtos>evtPgtos</evtPgtos>
      <evtAqProd>evtAqProd</evtAqProd>
      <evtComProd>evtComProd</evtComProd>
      <evtContratAvNP>evtContratAvNP</evtContratAvNP>
      <evtInfoComplPer>evtInfoComplPer</evtInfoComplPer>
    </infoFech>
  </evtFechaEvPer>
  <Signature/>
</eSocial>

```
