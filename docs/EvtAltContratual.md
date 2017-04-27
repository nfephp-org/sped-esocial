# EvtAltContratual

## Evento
 *evtAltContratual*

## Alias
 *S-2206 - Alteração de Contrato de Trabalho*


## Detalhamento

**Conceito do evento:** este evento registra as alterações do contrato de trabalho,
tais como: remuneração e periodicidade de pagamento, duração do contrato, local, 
cargo ou função, jornada, etc.

**Quem está obrigado:** todo empregador/órgão público em relação ao vínculo do 
empregado/servidor, ou a empresa de trabalho temporário em relação ao trabalhador 
temporário, cujo contrato de trabalho/ficha funcional seja objeto de alteração.

**Prazo de envio:** deve ser transmitido até o dia 07 (sete) do mês subsequente 
ao da competência informada no evento ou até o envio dos eventos mensais de folha 
de pagamento da competência em que ocorreu a alteração contratual, para evitar 
inconsistências entre o contrato de trabalho e a folha de pagamento. Antecipa-se 
o vencimento para o dia útil imediatamente anterior quando não houver expediente bancário.

**Pré-requisitos:** os dados originais do Contrato de Trabalho do vínculo já 
devem ter sido enviados através dos eventos “S-2100 - Cadastramento Inicial do Vínculo” ou “S-2200 – Admissão do
Trabalhador”.


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

    $evt = Event::evtAltContratual($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```


A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAltContratual/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAltContratual/v02_02_01 ../schemes/evtAltContratual.xsd ">
  <evtAltContratual Id="idvalue0">
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
    <altContratual>
      <dtAlteracao>2001-01-01</dtAlteracao>
      <vinculo>
        <tpRegTrab>0</tpRegTrab>
        <tpRegPrev>0</tpRegPrev>
      </vinculo>
      <infoRegimeTrab/>
      <infoContrato>
        <codCateg>0</codCateg>
        <remuneracao>
          <vrSalFx>0.0</vrSalFx>
          <undSalFixo>0</undSalFixo>
        </remuneracao>
        <duracao>
          <tpContr>0</tpContr>
        </duracao>
        <localTrabalho/>
      </infoContrato>
    </altContratual>
  </evtAltContratual>
  <Signature/>
</eSocial>

```
