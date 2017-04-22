# EvtInfoEmpregador

## Evento: evtInfoEmpregador

## Alias: 


## Detalhamento


## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtInfoEmpregador($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtInfoEmpregador/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtInfoEmpregador/v02_02_01 ../schemes/evtInfoEmpregador.xsd ">
  <evtInfoEmpregador Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoEmpregador>
      <inclusao>
        <idePeriodo>
          <iniValid>iniValid</iniValid>
        </idePeriodo>
        <infoCadastro>
          <nmRazao>nmRazao</nmRazao>
          <classTrib>classTrib</classTrib>
          <indDesFolha>0</indDesFolha>
          <indOptRegEletron>0</indOptRegEletron>
          <multTabRubricas>multTabRubricas</multTabRubricas>
          <indEtt>indEtt</indEtt>
          <contato>
            <nmCtt>nmCtt</nmCtt>
            <cpfCtt>cpfCtt</cpfCtt>
          </contato>
          <infoComplementares/>
        </infoCadastro>
      </inclusao>
    </infoEmpregador>
  </evtInfoEmpregador>
  <Signature/>
</eSocial>

```
