# EvtAvPrevio

## Evento
 *evtAvPrevio*

## Alias
 *S-2250 - Aviso Prévio*


## Detalhamento

**Conceito do evento:** este evento tem como objetivo registrar a comunicação e 
o possível cancelamento do aviso prévio de iniciativa do empregador ou do empregado. 
Aviso prévio é o documento de comunicação, antecipada e obrigatória, em que uma 
das partes contratantes (empregador ou empregado) deseja rescindir, sem justa 
causa, o contrato de trabalho vigente.

**Quem está obrigado:** o empregador, sempre que ocorrer a comunicação da rescisão 
do contrato de trabalho, sem justa causa. Este evento não se aplica aos servidores 
estatutários.

**Prazo de envio:** este evento deve ser enviado em até 10 (dez) dias de sua comunicação.

**Pré-requisitos:** envio dos eventos S-2100 - Cadastramento inicial do vínculo ou 
S-2200 – Admissão de Trabalhador.

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

    $evt = Event::evtAvPrevio($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAvPrevio/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAvPrevio/v02_02_01 ../schemes/evtAvPrevio.xsd ">
  <evtAvPrevio Id="idvalue0">
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
    <ideVinculo>
      <cpfTrab>cpfTrab</cpfTrab>
      <nisTrab>nisTrab</nisTrab>
      <matricula>matricula</matricula>
    </ideVinculo>
    <infoAvPrevio>
      <detAvPrevio>
        <dtAvPrv>2001-01-01</dtAvPrv>
        <dtPrevDeslig>2001-01-01</dtPrevDeslig>
        <tpAvPrevio>0</tpAvPrevio>
      </detAvPrevio>
    </infoAvPrevio>
  </evtAvPrevio>
  <Signature/>
</eSocial>

```
