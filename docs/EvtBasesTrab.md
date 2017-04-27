# EvtBasesTrab

## Evento
 *evtBasesTrab*

## Alias
 *S-5001 - Informações das contribuições sociais por trabalhador*


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
    $evt = Event::evtBasesTrab($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtBasesTrab/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtBasesTrab/v02_02_01 ../schemes/evtBasesTrab.xsd ">
  <evtBasesTrab Id="idvalue0">
    <ideEvento>
      <indApuracao>0</indApuracao>
      <perApur>perApur</perApur>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <ideTrabalhador>
      <cpfTrab>cpfTrab</cpfTrab>
    </ideTrabalhador>
    <infoCpCalc>
      <tpCR>0</tpCR>
      <vrCpSeg>0.0</vrCpSeg>
      <vrDescSeg>0.0</vrDescSeg>
    </infoCpCalc>
    <infoCp>
      <ideEstabLot>
        <tpInsc>0</tpInsc>
        <nrInsc>nrInsc</nrInsc>
        <codLotacao>codLotacao</codLotacao>
        <infoCategIncid>
          <codCateg>0</codCateg>
        </infoCategIncid>
      </ideEstabLot>
    </infoCp>
  </evtBasesTrab>
  <Signature/>
</eSocial>

```
