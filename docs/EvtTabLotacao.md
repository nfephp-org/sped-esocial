# EvtTabLotacao

## Evento
 *evtTabLotacao*

## Alias
 *S-1020 - Tabela de Lotações Tributárias*


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
     $evt = Event::evtTabLotacao($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTabLotacao/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTabLotacao/v02_02_01 ../schemes/evtTabLotacao.xsd ">
  <evtTabLotacao Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoLotacao>
      <inclusao>
        <ideLotacao>
          <codLotacao>codLotacao</codLotacao>
          <iniValid>iniValid</iniValid>
        </ideLotacao>
        <dadosLotacao>
          <tpLotacao>tpLotacao</tpLotacao>
          <fpasLotacao>
            <fpas>0</fpas>
            <codTercs>codTercs</codTercs>
          </fpasLotacao>
        </dadosLotacao>
      </inclusao>
    </infoLotacao>
  </evtTabLotacao>
  <Signature/>
</eSocial>

```
