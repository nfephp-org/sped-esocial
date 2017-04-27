# EvtContrSindPatr

## Evento
 *evtContrSindPatr*

## Alias
 *S-1300 - Contribuição Sindical Patronal*


## Detalhamento

**Conceito do evento:** Este evento registra o valor a ser pago relativo às 
contribuições sindicais e a identificação dos sindicatos para os quais o 
empregador/contribuinte/órgão público efetuará as respectivas contribuições.

**Quem está obrigado:** O empregador/contribuinte/órgão público que esteja 
obrigado a recolher contribuição a sindicato patronal prevista nos arts. 579 e 
580 da CLT e no Decreto-lei no 1.166, de 15 de abril de 1971. Quanto às demais 
espécies de contribuições sindicais patronais, a prestação da informação é facultativa.

**Prazo de envio:** o evento relativo à contribuição sindical prevista nos arts. 
579 e 580, deve ser transmitido até o dia 7 (sete) de fevereiro de cada ano, 
para as empresas urbanas em atividade no mês de janeiro, ou até o dia 7 (sete) 
do mês subsequente ao que for obtido o registro ou a licença para o exercício da 
respectiva atividade. Em relação ao envio do evento pelos empregadores rurais, 
relativo à contribuição sindical prevista no Decreto-lei no 1.166, de 15 de 
abril de 1971, o prazo é o dia 7 (sete) de outubro de cada ano.

**Pré-requisitos:** O evento exige o cadastro completo das Informações do Empregador/Contribuinte/Órgão Público - Evento S-1000.

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

    $evt = Event::evtContrSindPatr($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtContrSindPatr/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtContrSindPatr/v02_02_01 ../schemes/evtContrSindPatr.xsd ">
  <evtContrSindPatr Id="idvalue0">
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
    <contribSind>
      <cnpjSindic>cnpjSindic</cnpjSindic>
      <tpContribSind>0</tpContribSind>
      <vlrContribSind>0.0</vlrContribSind>
    </contribSind>
  </evtContrSindPatr>
  <Signature/>
</eSocial>

```
