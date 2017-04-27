# EvtAltCadastral

## Evento
 *evtAltCadastral*

## Alias
 *S-2205 - Alteração de Dados Cadastrais do Trabalhador*


## Detalhamento

**Conceito do evento:** Este evento registra as alterações de dados cadastrais 
do trabalhador, tais como: documentação pessoal, endereço, escolaridade, estado 
civil, contato, etc. Deve ser utilizado tanto para empregados/servidores, 
inseridos através dos eventos S-2100 e S-2200, quanto para outros trabalhadores 
sem vínculo de emprego cuja informação foi enviada originalmente através do 
evento específico de “S-2300 - Trabalhador Sem Vínculo de Emprego/Estatutário – Início”.

**Quem está obrigado:** todo empregador/órgão público cujo trabalhador, informado 
através dos eventos “S-2100 – Cadastramento Inicial do Vínculo”, “S-2200 – 
Admissão do Trabalhador” e “S-2300 – Trabalhadores Sem Vínculo de emprego/Estatutário – Início”, apresente alteração de dados cadastrais.

**Prazo de envio:** deve ser transmitido até o dia 07 do mês subsequente ao do 
mês de referência informando no evento ou até o envio dos eventos mensais de 
folha de pagamento da competência em que ocorreu a alteração cadastral, para 
evitar inconsistências entre o cadastro e a folha de pagamento. Antecipa-se o 
vencimento para o dia útil imediatamente anterior quando não houver expediente bancário.

**Pré-requisitos:** os dados cadastrais originais do trabalhador já devem ter 
sido enviados através dos eventos “S-2100 - Cadastramento Inicial do Vínculo”, 
“S-2200 - Admissão de Trabalhador” ou “S-2300 - Trabalhador sem Vínculo de Emprego/Estatutário – Início”.

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

    $evt = Event::evtAltCadastral($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados

## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAltCadastral/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAltCadastral/v02_02_01 ../schemes/evtAltCadastral.xsd ">
  <evtAltCadastral Id="idvalue0">
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
    <ideTrabalhador>
      <cpfTrab>cpfTrab</cpfTrab>
    </ideTrabalhador>
    <alteracao>
      <dtAlteracao>2001-01-01</dtAlteracao>
      <dadosTrabalhador>
        <nmTrab>nmTrab</nmTrab>
        <sexo>sexo</sexo>
        <racaCor>0</racaCor>
        <grauInstr>grauInstr</grauInstr>
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
      </dadosTrabalhador>
    </alteracao>
  </evtAltCadastral>
  <Signature/>
</eSocial>

```
