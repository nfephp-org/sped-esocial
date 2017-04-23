# EvtTSVTermino

## Evento
 *evtTSVTermino*

## Alias
 **


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtTSVTermino($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTSVTermino/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTSVTermino/v02_02_01 ../schemes/evtTSVTermino.xsd ">
  <evtTSVTermino Id="idvalue0">
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
    <ideTrabSemVinculo>
      <cpfTrab>cpfTrab</cpfTrab>
      <codCateg>0</codCateg>
    </ideTrabSemVinculo>
    <infoTSVTermino>
      <dtTerm>2001-01-01</dtTerm>
    </infoTSVTermino>
  </evtTSVTermino>
  <Signature/>
</eSocial>

```
