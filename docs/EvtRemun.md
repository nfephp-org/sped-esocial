# EvtRemun

## Evento
 *evtRemun*

## Alias
 *S-1200 - Remuneração de trabalhador vinculado ao Regime Geral de Previd. Social*


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
    $evt = Event::evtRemun($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtRemun/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtRemun/v02_02_01 ../schemes/evtRemun.xsd ">
  <evtRemun Id="idvalue0">
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
    <ideTrabalhador>
      <cpfTrab>cpfTrab</cpfTrab>
    </ideTrabalhador>
    <dmDev>
      <ideDmDev>ideDmDev</ideDmDev>
      <codCateg>0</codCateg>
    </dmDev>
  </evtRemun>
  <Signature/>
</eSocial>

```

## Alterações v_S_01_03_00 (NT S-1.3 nº 06/2026)

### Campo `notAFT` (novo)
- **Localização:** `dmDev/notAFT`
- **Tipo:** `TS_notAFT` — 9 caracteres alfanuméricos (`[A-Za-z0-9]{9}`)
- **Obrigatoriedade:** Opcional
- **Descrição:** Número da notificação do FGTS Digital que originou a confissão de débito. Só pode ser preenchido se o mês/ano de `perApur` for igual ou posterior ao início do FGTS Digital.

### Campo `descFolha` em `itensRemun` (já suportado)
- **Localização:** `dmDev/infoPerApur/ideEstabLot/remunPerApur/itensRemun/descFolha`
- **Tipo:** `T_descFolha` — grupo eConsignado com `tpDesc`, `instFinanc`, `nrDoc`, `observacao?`
- **Obrigatoriedade:** Opcional — exclusivo quando `tpDesc=1` (Desconto em folha por consignado)
