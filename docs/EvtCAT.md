# EvtCAT

## Evento
 *evtCAT*

## Alias
 *S-2210 - Comunicação de Acidente de Trabalho*


## Detalhamento

**Conceito do evento:** evento a ser utilizado para comunicar acidente de trabalho 
envolvendo empregado e/ou trabalhador avulso, ainda que não haja afastamento de 
suas atividades laborais.

**Quem está obrigado:** o empregador, a cooperativa, o sindicato de trabalhadores 
avulsos não portuários e o órgão gestor de mão de obra, Órgãos Públicos para 
servidores vinculados ao Regime Geral de Previdência Social - RGPS. No caso de 
servidores vinculados ao Regime Próprio de Previdência Social - RPPS o envio da 
informação é facultativo.

**Quem pode enviar o evento:** o empregador, o próprio acidentado, seus dependentes, 
a entidade sindical competente, o médico que o assistiu ou qualquer autoridade 
pública. 

**Prazo de envio:** a comunicação do acidente de trabalho deve ser comunicada 
até o primeiro dia útil seguinte ao da ocorrência e, em caso de morte, de imediato.

**Pré-requisitos:** envio dos eventos S-2100 - Cadastramento Inicial do Vínculo ou 
S-2200 - Admissão e S-2300 - Trabalhadores Sem Vínculo Emprego/Estatutário - Início.


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

    $evt = Event::evtCAT($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados

## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtCAT/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtCAT/v02_02_01 ../schemes/evtCAT.xsd ">
  <evtCAT Id="idvalue0">
    <ideEvento>
      <indRetif>0</indRetif>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideRegistrador>
      <tpRegistrador>0</tpRegistrador>
    </ideRegistrador>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <ideTrabalhador>
      <cpfTrab>cpfTrab</cpfTrab>
    </ideTrabalhador>
    <cat>
      <dtAcid>2001-01-01</dtAcid>
      <tpAcid>tpAcid</tpAcid>
      <hrAcid>hrAcid</hrAcid>
      <hrsTrabAntesAcid>hrsTrabAntesAcid</hrsTrabAntesAcid>
      <tpCat>0</tpCat>
      <indCatObito>indCatObito</indCatObito>
      <indComunPolicia>indComunPolicia</indComunPolicia>
      <iniciatCAT>0</iniciatCAT>
      <localAcidente>
        <tpLocal>0</tpLocal>
      </localAcidente>
      <parteAtingida>
        <codParteAting>0</codParteAting>
        <lateralidade>0</lateralidade>
      </parteAtingida>
      <agenteCausador>
        <codAgntCausador>0</codAgntCausador>
      </agenteCausador>
    </cat>
  </evtCAT>
  <Signature/>
</eSocial>

```
