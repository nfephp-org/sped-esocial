# EvtIrrfBenef

## Evento
 *evtIrrfBenef*

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
     $evt = Event::evtIrrfBenef($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtIrrfBenef/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtIrrfBenef/v02_02_01 ../schemes/evtIrrfBenef.xsd ">
  <evtIrrfBenef Id="idvalue0">
    <ideEvento>
      <perApur>perApur</perApur>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <ideTrabalhador>
      <cpfTrab>cpfTrab</cpfTrab>
    </ideTrabalhador>
    <infoDep>
      <vrDedDep>0.0</vrDedDep>
    </infoDep>
    <infoIrrf>
      <indResBr>indResBr</indResBr>
      <basesIrrf>
        <tpValor>0</tpValor>
        <valor>0.0</valor>
      </basesIrrf>
    </infoIrrf>
  </evtIrrfBenef>
  <Signature/>
</eSocial>

```
