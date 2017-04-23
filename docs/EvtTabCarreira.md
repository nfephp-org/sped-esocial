# EvtTabCarreira

## Evento
 *evtTabCarreira*

## Alias
 **


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtTabCarreira($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTabCarreira/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTabCarreira/v02_02_01 ../schemes/evtTabCarreira.xsd ">
  <evtTabCarreira Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoCarreira>
      <inclusao>
        <ideCarreira>
          <codCarreira>codCarreira</codCarreira>
          <iniValid>iniValid</iniValid>
        </ideCarreira>
        <dadosCarreira>
          <dscCarreira>dscCarreira</dscCarreira>
          <dtLeiCarr>2001-01-01</dtLeiCarr>
          <sitCarr>0</sitCarr>
        </dadosCarreira>
      </inclusao>
    </infoCarreira>
  </evtTabCarreira>
  <Signature/>
</eSocial>

```
