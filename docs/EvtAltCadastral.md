# EvtAltCadastral

## Evento
 *evtAltCadastral*

## Alias
 **


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:


## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtAltCadastral($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAltCadastral/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAltCadastral/v02_02_01 ../schemes/evtAltCadastral.xsd ">
  <evtAltCadastral Id="idvalue0">
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
    <ideTrabalhador>
      <cpfTrab>cpfTrab</cpfTrab>
    </ideTrabalhador>
    <alteracao>
      <dtAlteracao>2001-01-01</dtAlteracao>
      <dadosTrabalhador>
        <nmTrab>nmTrab</nmTrab>
        <sexo>sexo</sexo>
        <racaCor>0</racaCor>
        <grauInstr>grauInstr</grauInstr>
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
      </dadosTrabalhador>
    </alteracao>
  </evtAltCadastral>
  <Signature/>
</eSocial>

```
