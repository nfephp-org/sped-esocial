# EvtBenPrRP

## Evento
 *evtBenPrRP*

## Alias
 *S-1207 - Benefícios previdenciários - RPPS*


## Detalhamento

**Conceito do evento:** São as informações referentes ao pagamento das aposentadorias, 
pensões e demais benefícios dos segurados, no mês de referência.

**Quem está obrigado:** Todos os órgãos públicos que efetuem pagamento de 
benefícios previdenciários no mês de referência, inclusive os que não mantenham mais RPPS.

**Prazo de envio:** Deve ser transmitido até o dia 07 do mês subsequente ao do 
mês de referência informado no evento. Antecipa-se o vencimento para o dia útil 
imediatamente anterior quando não houver expediente bancário.

**Pré-requisito:** o envio anterior do evento “S-2400 – Cadastro de Benefícios Previdenciários –
RPPS”

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

    $evt = Event::evtBenPrRP($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados

## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtBenPrRP/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtBenPrRP/v02_02_01 ../schemes/evtBenPrRP.xsd ">
  <evtBenPrRP Id="idvalue0">
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
    <ideBenef>
      <cpfBenef>cpfBenef</cpfBenef>
    </ideBenef>
    <dmDev>
      <tpBenef>0</tpBenef>
      <nrBenefic>nrBenefic</nrBenefic>
      <ideDmDev>ideDmDev</ideDmDev>
      <itens>
        <codRubr>codRubr</codRubr>
        <vrRubr>0.0</vrRubr>
      </itens>
    </dmDev>
  </evtBenPrRP>
  <Signature/>
</eSocial>

```
