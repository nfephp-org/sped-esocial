# EvtContrSindPatr

## Evento: evtContrSindPatr

## Alias: 


## Detalhamento





## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtContrSindPatr($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtContrSindPatr/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtContrSindPatr/v02_02_01 ../schemes/evtContrSindPatr.xsd ">
  <evtContrSindPatr Id="idvalue0">
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
    <contribSind>
      <cnpjSindic>cnpjSindic</cnpjSindic>
      <tpContribSind>0</tpContribSind>
      <vlrContribSind>0.0</vlrContribSind>
    </contribSind>
  </evtContrSindPatr>
  <Signature/>
</eSocial>

```
