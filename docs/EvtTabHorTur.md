# EvtTabHorTur

## Evento
 *evtTabHorTur*

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
     $evt = Event::evtTabHorTur($configJson, $std);
} catch (\Exception $e) {
    //aqui você trata as exceptions}
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTabHorTur/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTabHorTur/v02_02_01 ../schemes/evtTabHorTur.xsd ">
  <evtTabHorTur Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoHorContratual>
      <inclusao>
        <ideHorContratual>
          <codHorContrat>codHorContrat</codHorContrat>
          <iniValid>iniValid</iniValid>
        </ideHorContratual>
        <dadosHorContratual>
          <hrEntr>hrEntr</hrEntr>
          <hrSaida>hrSaida</hrSaida>
          <durJornada>0</durJornada>
          <perHorFlexivel>perHorFlexivel</perHorFlexivel>
        </dadosHorContratual>
      </inclusao>
    </infoHorContratual>
  </evtTabHorTur>
  <Signature/>
</eSocial>

```
