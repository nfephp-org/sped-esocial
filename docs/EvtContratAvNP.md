# EvtContratAvNP

## Evento
 *evtContratAvNP*

## Alias
 *S-1270 - Contratação de Trabalhadores Avulsos Não Portuários*


## Detalhamento

**Conceito do evento:** São informações prestadas exclusivamente pelos tomadores 
de serviços de trabalhadores avulsos não portuários.

**Quem está obrigado:** Os tomadores de serviços de trabalhadores avulsos não 
portuários intermediados pelo sindicato.

**Prazo de envio:** este evento deve ser enviado até o dia 07 do mês seguinte ou 
antes do envio do evento S-1299 – Fechamento dos Eventos Periódico - remuneração, 
o que ocorrer primeiro. Antecipa-se o envio deste evento para o dia útil imediatamente 
anterior quando não houver expediente bancário.

**Pré-requisitos:** envio do evento S-1000 - Informações do Empregador/Contribuinte/Órgão Público.

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

    $evt = Event::evtContratAvNP($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtContratAvNP/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtContratAvNP/v02_02_01 ../schemes/evtContratAvNP.xsd ">
  <evtContratAvNP Id="idvalue0">
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
    <remunAvNP>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
      <codLotacao>codLotacao</codLotacao>
      <vrBcCp00>0.0</vrBcCp00>
      <vrBcCp15>0.0</vrBcCp15>
      <vrBcCp20>0.0</vrBcCp20>
      <vrBcCp25>0.0</vrBcCp25>
      <vrBcCp13>0.0</vrBcCp13>
      <vrBcFgts>0.0</vrBcFgts>
      <vrDescCP>0.0</vrDescCP>
    </remunAvNP>
  </evtContratAvNP>
  <Signature/>
</eSocial>

```
