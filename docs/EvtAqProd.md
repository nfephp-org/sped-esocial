# EvtAqProd

## Evento
 *evtAqProd*

## Alias
 **


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:


## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtAqProd($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAqProd/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAqProd/v02_02_01 ../schemes/evtAqProd.xsd ">
  <evtAqProd Id="idvalue0">
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
    <infoAquisProd>
      <ideEstabAdquir>
        <tpInscAdq>0</tpInscAdq>
        <nrInscAdq>nrInscAdq</nrInscAdq>
        <tpAquis>
          <indAquis>0</indAquis>
          <vlrTotAquis>0.0</vlrTotAquis>
          <ideProdutor>
            <tpInscProd>0</tpInscProd>
            <nrInscProd>nrInscProd</nrInscProd>
            <vlrBruto>0.0</vlrBruto>
            <vrCPDescPR>0.0</vrCPDescPR>
            <vrRatDescPR>0.0</vrRatDescPR>
            <vrSenarDesc>0.0</vrSenarDesc>
          </ideProdutor>
        </tpAquis>
      </ideEstabAdquir>
    </infoAquisProd>
  </evtAqProd>
  <Signature/>
</eSocial>

```
