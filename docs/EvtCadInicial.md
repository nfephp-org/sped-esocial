# EvtCadInicial

## Evento
 *evtCadInicial*

## Alias
 *S-2100 - Cadastramento Inicial do Vínculo*


## Detalhamento

**Conceito do evento:** Este evento se refere ao arquivo que será enviado pela 
empresa/órgão público no início da implantação do eSocial, com todos os vínculos 
ativos, com seus dados cadastrais atualizados, servindo de base para construção 
do "Registro de Eventos Trabalhistas" - RET, o qual será utilizado para validação 
dos eventos de folha de pagamento e demais eventos enviados posteriormente.
É o retrato dos vínculos empregatícios existentes na data da implantação do eSocial.

**Quem está obrigado:** todo empregador/contribuinte/órgão público que já possua 
vínculos trabalhistas ativos na data de implantação do eSocial, assim como as 
empresas de trabalho temporário (Lei no 6.019/74), que possuam trabalhadores 
temporários com contratos em vigor na data dessa implantação. Os vínculos não-ativos 
na data de implantação (desligados antes da implantação do eSocial) não são objeto 
deste Cadastramento Inicial.

**Prazo de envio:** deverá ser transmitido antes do envio de qualquer evento 
periódico ou não periódico relativos a esses vínculos e até o dia 7 (sete) do 
mês subsequente ao do início de sua obrigatoriedade.

**Pré-requisitos:** envio do evento “S-1000 - Informações do Empregador/Contribuinte/Órgão Público/Órgão Público e envio das tabelas do empregador/contribuinte/órgão público no eSocial.

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

    $evt = Event::evtCadInicial($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados

## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtCadInicial/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtCadInicial/v02_02_01 ../schemes/evtCadInicial.xsd ">
  <evtCadInicial Id="idvalue0">
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
    <trabalhador>
      <cpfTrab>cpfTrab</cpfTrab>
      <nisTrab>nisTrab</nisTrab>
      <nmTrab>nmTrab</nmTrab>
      <sexo>sexo</sexo>
      <racaCor>0</racaCor>
      <grauInstr>grauInstr</grauInstr>
      <nascimento>
        <dtNascto>2001-01-01</dtNascto>
        <paisNascto>paisNascto</paisNascto>
        <paisNac>paisNac</paisNac>
      </nascimento>
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
    </trabalhador>
    <vinculo>
      <matricula>matricula</matricula>
      <tpRegTrab>0</tpRegTrab>
      <tpRegPrev>0</tpRegPrev>
      <infoRegimeTrab>
        <infoCeletista>
          <dtAdm>2001-01-01</dtAdm>
          <tpAdmissao>0</tpAdmissao>
          <indAdmissao>0</indAdmissao>
          <tpRegJor>0</tpRegJor>
          <natAtividade>0</natAtividade>
          <cnpjSindCategProf>cnpjSindCategProf</cnpjSindCategProf>
          <FGTS>
            <opcFGTS>0</opcFGTS>
          </FGTS>
        </infoCeletista>
      </infoRegimeTrab>
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
    </vinculo>
  </evtCadInicial>
  <Signature/>
</eSocial>

```
