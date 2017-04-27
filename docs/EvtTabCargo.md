# EvtTabCargo

## Evento
 *evtTabCargo*

## Alias
 *S-1030 - Tabela de Cargos/Empregos Públicos*


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
    $evt = Event::evtTabCargo($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTabCargo/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTabCargo/v02_02_01 ../schemes/evtTabCargo.xsd ">
  <evtTabCargo Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoCargo>
      <inclusao>
        <ideCargo>
          <codCargo>codCargo</codCargo>
          <iniValid>iniValid</iniValid>
        </ideCargo>
        <dadosCargo>
          <nmCargo>nmCargo</nmCargo>
          <codCBO>codCBO</codCBO>
        </dadosCargo>
      </inclusao>
    </infoCargo>
  </evtTabCargo>
  <Signature/>
</eSocial>

```
