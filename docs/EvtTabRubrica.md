# EvtTabRubrica

## Evento
 *evtTabRubrica*

## Alias
 *S-1010 - Tabela de Rubricas*


## Detalhamento
**Conceito do evento:** Apresenta o detalhamento das informações das rubricas constantes da folha de pagamento do empregador/contribuinte/órgão público, permitindo a correlação destas com as constantes da tabela de natureza das rubricas da folha de pagamento do eSocial. É utilizado para inclusão, alteração e exclusão de registros na tabela de RUBRICAS do empregador/contribuinte/órgão público. As informações consolidadas desta tabela são utilizadas para validação do evento de Remuneração dos trabalhadores.

**Quem está obrigado:** O empregador/contribuinte/órgão público, na primeira vez que utilizar o eSocial e toda vez que for criada, alterada ou excluída uma determinada rubrica. 

**Prazo de envio:** O evento Tabela de Rubricas deve ser enviado antes dos eventos relacionados à Remuneração do Trabalhador - Evento “S-1200 - Remuneração de Trabalhador vinculado ao Regime Geral de Previdência Social”, “S-1202 - Remuneração de servidor vinculado a Regime Próprio de Previdência Social” e “S-1207 - Benefícios previdenciários – RPPS”, bem como antes dos eventos S-2299 – Desligamento e S-2399 – Trabalhador sem Vínculo de Emprego/Estatutário - Término, que referenciam rubricas pagas na rescisão.
Pré-requisitos: Cadastro completo das Informações do Empregador/Contribuinte/órgão Público - Evento S-1000.

**Informações adicionais:**

Vide Manual


## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
    $evt = Event::evtTabRubrica($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTabRubrica/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTabRubrica/v02_02_01 ../schemes/evtTabRubrica.xsd ">
  <evtTabRubrica Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoRubrica>
      <inclusao>
        <ideRubrica>
          <codRubr>codRubr</codRubr>
          <iniValid>iniValid</iniValid>
        </ideRubrica>
        <dadosRubrica>
          <dscRubr>dscRubr</dscRubr>
          <natRubr>0</natRubr>
          <tpRubr>0</tpRubr>
          <codIncCP>codIncCP</codIncCP>
          <codIncIRRF>codIncIRRF</codIncIRRF>
          <codIncFGTS>codIncFGTS</codIncFGTS>
          <codIncSIND>codIncSIND</codIncSIND>
          <repDSR>repDSR</repDSR>
          <rep13>rep13</rep13>
          <repFerias>repFerias</repFerias>
          <repAviso>repAviso</repAviso>
        </dadosRubrica>
      </inclusao>
    </infoRubrica>
  </evtTabRubrica>
  <Signature/>
</eSocial>

```
