# EvtCdBenPrRP

## Evento
 *evtCdBenPrRP*

## Alias
 **


## Detalhamento



## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtCdBenPrRP($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtCdBenPrRP/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtCdBenPrRP/v02_02_01 ../schemes/evtCdBenPrRP.xsd ">
  <evtCdBenPrRP Id="idvalue0">
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
    <ideBenef>
      <cpfBenef>cpfBenef</cpfBenef>
      <nmBenefic>nmBenefic</nmBenefic>
      <dadosBenef>
        <cpfBenef>cpfBenef</cpfBenef>
        <nmBenefic>nmBenefic</nmBenefic>
        <dadosNasc>
          <dtNascto>2001-01-01</dtNascto>
          <paisNascto>paisNascto</paisNascto>
          <paisNac>paisNac</paisNac>
        </dadosNasc>
        <endereco>
          <brasil>
            <tpLograd>tpLograd</tpLograd>
            <dscLograd>dscLograd</dscLograd>
            <nrLograd>nrLograd</nrLograd>
            <cep>cep</cep>
            <codMunic>0</codMunic>
            <uf>AC</uf>
          </brasil>
        </endereco>
      </dadosBenef>
    </ideBenef>
    <infoBeneficio>
      <tpPlanRP>0</tpPlanRP>
    </infoBeneficio>
  </evtCdBenPrRP>
  <Signature/>
</eSocial>

```
