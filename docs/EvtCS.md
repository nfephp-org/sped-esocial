# EvtCS

## Evento
 *evtCS*

## Alias
 **


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:


## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtCS($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtCS/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtCS/v02_02_01 ../schemes/evtCS.xsd ">
  <evtCS Id="idvalue0">
    <ideEvento>
      <indApuracao>0</indApuracao>
      <perApur>perApur</perApur>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoCS>
      <indExistInfo>0</indExistInfo>
      <infoContrib>
        <classTrib>classTrib</classTrib>
      </infoContrib>
      <ideEstab>
        <tpInsc>0</tpInsc>
        <nrInsc>nrInsc</nrInsc>
      </ideEstab>
    </infoCS>
  </evtCS>
  <Signature/>
</eSocial>

```
