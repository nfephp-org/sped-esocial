# EvtAltContratual

## Evento
 *evtAltContratual*

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
     $evt = Event::evtAltContratual($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAltContratual/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAltContratual/v02_02_01 ../schemes/evtAltContratual.xsd ">
  <evtAltContratual Id="idvalue0">
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
    <ideVinculo>
      <cpfTrab>cpfTrab</cpfTrab>
      <nisTrab>nisTrab</nisTrab>
      <matricula>matricula</matricula>
    </ideVinculo>
    <altContratual>
      <dtAlteracao>2001-01-01</dtAlteracao>
      <vinculo>
        <tpRegTrab>0</tpRegTrab>
        <tpRegPrev>0</tpRegPrev>
      </vinculo>
      <infoRegimeTrab/>
      <infoContrato>
        <codCateg>0</codCateg>
        <remuneracao>
          <vrSalFx>0.0</vrSalFx>
          <undSalFixo>0</undSalFixo>
        </remuneracao>
        <duracao>
          <tpContr>0</tpContr>
        </duracao>
        <localTrabalho/>
      </infoContrato>
    </altContratual>
  </evtAltContratual>
  <Signature/>
</eSocial>

```
