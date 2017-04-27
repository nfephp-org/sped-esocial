# EvtAfastTemp

## Evento
 *evtAfastTemp*

## Alias
 *S-2230 - Afastamento Temporário*


## Detalhamento

**Conceito do evento:** evento utilizado para informar os afastamentos temporários 
dos empregados/servidores e trabalhadores avulsos, por quaisquer dos motivos 
elencados na tabela 18 – Motivos de Afastamento, bem como eventuais alterações e prorrogações.
Caso o empregado/servidor possua mais de um vínculo, é necessário o envio do 
evento para cada um deles.

**Quem está obrigado:** o empregador/contribuinte/órgão público, toda vez que o 
trabalhador se afastar de suas atividades laborais em decorrência de um dos 
motivos constantes na tabela 18, com indicação de obrigatória, conforme quadro 
constante no item 18 das informações adicionais. 

**Prazo de envio:** o evento de afastamento temporário deve ser informado nos seguintes prazos:
1. Afastamento temporário ocasionado por acidente de trabalho, agravo de saúde ou doença decorrentes do trabalho com duração não superior a 15 (quinze) dias, deve ser enviado até o dia 7 (sete) do mês subsequente da sua ocorrência.
2. Afastamento temporário ocasionado por acidente de qualquer natureza, agravo de saúde ou doença não relacionados ao trabalho, com duração entre 3 (três) a 15 (quinze) dias, deve ser enviado até o dia 7 (sete) do mês subsequente da sua ocorrência.
3. Afastamento temporário ocasionado por acidente de trabalho, acidente de qualquer natureza, agravo de saúde ou doença com duração superior a 15 (quinze) dias deve ser enviado até o 16o dia da sua ocorrência, caso não tenha transcorrido o prazo previsto itens 1 e 2.
4. Afastamento temporário ocasionado pelo mesmo acidente, agravo de saúde ou doença, que ocorrerem dentro do prazo de 60 (sessenta) dias e totalizar, na somatória dos tempos duração superior a 15 (quinze) dias, independentemente da duração individual de cada afastamento, devem ser enviados, isoladamente, no 16o dia do afastamento.
5. Demais afastamentos devem ser enviados até o dia 7 (sete) do mês subsequente ao da sua ocorrência ou até o envio dos eventos mensais de remuneração a que se relacionem.
6. Alteração e término de afastamento: até o dia 07 (sete) do mês subsequente à competência em que ocorreu a alteração ou até o envio do evento “S-1299 – Fechamento dos Eventos Periódicos”, o que ocorrer primeiro.
7. Para servidores de regime jurídico estatutário vinculados ao RPPS e regime administrativo especial vinculados ao RPPS, deverão ser observados os prazos previstos na legislação específica.

**Pré-requisitos:** envio do evento “S-2100 - Cadastramento Inicial do Vínculo”,
“S-2200 – Admissão do Trabalhador” e S-2300 - Trabalhadores Sem Vínculo de Emprego\Estatutário - Início.

## Parâmetros
**$std** nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.

. sequencial, numero sequnecial do evento;
. 
. 
. 

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
    $evt = Event::evtAfastTemp($configJson, $std);
} catch (\Exception $e) {
    //aqui você trata as exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados

## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAfastTemp/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAfastTemp/v02_02_01 ../schemes/evtAfastTemp.xsd ">
  <evtAfastTemp Id="idvalue0">
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
    </ideVinculo>
    <infoAfastamento/>
  </evtAfastTemp>
  <Signature/>
</eSocial>

```
