# EvtTSVTermino

## Evento
 *evtTSVTermino*

## Alias
 *S-2399 - Trabalhador Sem Vínculo de Emprego/Estatutário - Término*


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
    $evt = Event::evtTSVTermino($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTSVTermino/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTSVTermino/v02_02_01 ../schemes/evtTSVTermino.xsd ">
  <evtTSVTermino Id="idvalue0">
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
    <ideTrabSemVinculo>
      <cpfTrab>cpfTrab</cpfTrab>
      <codCateg>0</codCateg>
    </ideTrabSemVinculo>
    <infoTSVTermino>
      <dtTerm>2001-01-01</dtTerm>
    </infoTSVTermino>
  </evtTSVTermino>
  <Signature/>
</eSocial>

```

## Alterações v_S_01_03_00 (NT S-1.3 nº 06/2026)

### Campo `notAFT` (novo)
- **Localização:** `infoTSVTermino/verbasResc/dmDev/notAFT`
- **Tipo:** `TS_notAFT` — 9 caracteres alfanuméricos (`[A-Za-z0-9]{9}`)
- **Obrigatoriedade:** Opcional
- **Descrição:** Número da notificação do FGTS Digital. Só aplicável se mês/ano de `dtTerm` for igual ou posterior ao início do FGTS Digital.

### Campos `indRRA` e `infoRRA` (adicionados ao `toNodeS130`)
- A versão S130 do layout passa a suportar explicitamente `indRRA` e `infoRRA` dentro de `dmDev`, alinhando com a versão S1.2.0 do schema `evtTSVTermino.xsd`.
