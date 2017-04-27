# EvtAqProd

## Evento
 *evtAqProd*

## Alias
 *S-1250 - Aquisição de Produção Rural*


## Detalhamento

**Conceito do Evento:** são as informações relativas à aquisição de produção 
rural de origem animal ou vegetal decorrente de responsabilidade tributária por 
substituição a que se submete, em decorrência da lei, a pessoa física (o intermediário), 
a empresa adquirente, consumidora ou consignatária, ou a cooperativa.

**Quem está obrigado:** 
a. Pessoas Jurídicas em geral, quando efetuar aquisição de produtos rurais de 
pessoa física ou de segurado especial, independentemente de as operações terem 
sido realizadas diretamente com o produtor ou com intermediário pessoa física;

b. Pessoa Física (intermediário) que adquire produção de produtor rural pessoa 
física ou de segurado especial para venda no varejo a consumidor final pessoa 
física, outro produtor rural pessoa física ou segurado especial;

c. Entidade inscrita no Programa de Aquisição de Alimentos (PAA), quando a mesma 
efetuar a aquisição de produtos rurais no âmbito do PAA, de produtor rural pessoa 
física ou pessoa jurídica;

d. A cooperativa adquirente de produto rural;

e. A Companhia Nacional de Abastecimento (CONAB), quando adquirir produtos do 
produtor rural pessoa física ou do produtor rural pessoa jurídica, destinados 
ao Programa de Aquisição de Alimentos, instituído pelo art. 19 da Lei no 10.696/2003.

**Prazo de envio:** este evento deve ser enviado até o dia 07 do mês seguinte ou 
antes do envio do evento S - 1299 – Fechamento dos Eventos Periódicos, o que 
ocorrer primeiro. Antecipa-se o envio deste evento para o dia útil imediatamente 
anterior quando não houver expediente bancário.

**Pré-requisitos:** envio do evento S-1000 - Informações do Empregador/Contribuinte/Órgão Público/Órgão Público.

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

    $evt = Event::evtAqProd($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAqProd/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAqProd/v02_02_01 ../schemes/evtAqProd.xsd ">
  <evtAqProd Id="idvalue0">
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
    <infoAquisProd>
      <ideEstabAdquir>
        <tpInscAdq>0</tpInscAdq>
        <nrInscAdq>nrInscAdq</nrInscAdq>
        <tpAquis>
          <indAquis>0</indAquis>
          <vlrTotAquis>0.0</vlrTotAquis>
          <ideProdutor>
            <tpInscProd>0</tpInscProd>
            <nrInscProd>nrInscProd</nrInscProd>
            <vlrBruto>0.0</vlrBruto>
            <vrCPDescPR>0.0</vrCPDescPR>
            <vrRatDescPR>0.0</vrRatDescPR>
            <vrSenarDesc>0.0</vrSenarDesc>
          </ideProdutor>
        </tpAquis>
      </ideEstabAdquir>
    </infoAquisProd>
  </evtAqProd>
  <Signature/>
</eSocial>

```
