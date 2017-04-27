# EvtCdBenPrRP

## Evento
 *evtCdBenPrRP*

## Alias
 *S-2400 - Cadastro de Benefícios Previdenciários - RPPS*


## Detalhamento

**Conceito do evento:** São as informações relativas ao cadastro dos benefícios 
previdenciários pagos pelos entes federativos, diretamente ou por seus Regimes 
Próprios de Previdência Social – RPPS, bem como as complementações de benefícios 
do Regime Geral de Previdência Social - RGPS.

**Quem está obrigado:** Todos os Órgãos Públicos que efetuam pagamento de benefícios previdenciários.

**Prazo de envio:** O evento deve ser enviado antes do evento “S-1207 – Benefícios 
Previdenciários – RPPS”.

**Pré-requisitos:** O evento exige o cadastro completo das informações dos órgãos 
públicos constantes no evento “S-1000 - Informações do Empregador/Contribuinte/Órgão Público”.

## Parâmetros
**$std** nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.

- sequencial, numero sequencial do evento;
- 
- 
- 

**$configJson** contêm as informações básicas da empresa [Config](Config.md).

## Modo de USO

```php
use NFePHP\eSocial\Event;
use NFePHP\Common\Certificate;
use stdClass;

//constroi o json da configuração
$config = [
    'tpInsc' => 1,  //1-CNPJ, 2-CPF
    'nrInsc' => '99999999999999', //numero do documento
    'company' => 'Razao Social',
    'tpAmb' => 3, //tipo de ambiente 1 - Produção;2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_2_01', //Informar a versão do aplicativo emissor do evento.
    'layout' => '2.2.1' //versão do layout
];
$configJson = json_encode($config);

try {
    //instancia Certificate::class com o 
    //$content = conteudo do certificado PFX
    //$password = senha de acesso ao certificado PFX
    $certificate = Certificate::readPfx($content, $password);

    $std = new \stdClass();

    $evt = Event::evtCdBenPrRP($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

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
