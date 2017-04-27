# EvtAdmissao

## Evento
 *evtAdmissao*

## Alias
 *S-2200 - Admissão / Ingresso de Trabalhador*

## Detalhamento

**Conceito do evento:** Este evento registra a admissão do empregado ou o ingresso 
de servidores estatutários. Trata-se do primeiro evento relativo a um determinado 
vínculo – excetuado a situação prevista para o evento “S-2190 - Admissão de 
Trabalhador - Registro Preliminar”, registrando as informações cadastrais e do 
contrato de trabalho. Pode ocorrer também quando o empregado é transferido 
de uma empresa do mesmo grupo econômico ou em decorrência de uma sucessão, 
fusão ou incorporação.

**Quem está obrigado:** todo empregador/órgão público que admitir empregado/servidor. 
Ainda que o empregador/órgão público se utilize do evento “S-2190 – Admissão de 
Trabalhador - Registro Preliminar”, está obrigado a enviar o S-2200. 
Os órgãos públicos também estão obrigados, tanto em relação aos servidores 
abrangidos pelo Regime Geral de Previdência Social - RGPS, quanto aos do
Regime Próprio de Previdência Social – RPPS, assim como as empresas de trabalho 
temporário (Lei no 6.019/74), que possuam trabalhadores temporários com 
contratos em vigor na data dessa implantação.

**Prazo de envio:** as informações da admissão do empregado devem ser enviadas 
até o final do dia imediatamente anterior ao do início da prestação do serviço. 
No caso de admissão de empregado na data do início da obrigatoriedade do eSocial, 
o prazo de envio da informação de admissão é o próprio dia da admissão. 
Para os órgãos públicos, independente do regime previdenciário ao qual o 
servidor esteja vinculado, até o dia 7 (sete) do mês subsequente ao da entrada 
em exercício, antecipando-se este vencimento para o dia útil imediatamente 
anterior quando não houver expediente bancário.
Se o empregador fizer a opção de enviar as informações preliminares de admissão 
por meio do evento “S-2190 – Admissão do Trabalhador – Registro Preliminar”, 
o prazo de envio do evento S-2200 – Admissão é até o dia 7 (sete) do mês 
subsequente ao da sua ocorrência, antecipando-se este vencimento para o dia útil 
imediatamente anterior quando não houver expediente bancário, ou antes da 
transmissão de qualquer outro evento relativo a esse trabalhador.
O arquivo somente pode ser enviado em data igual ou posterior àquela definida 
para início do eSocial. Os vínculos ativos cuja admissão se deu em período 
anterior à implantação do eSocial devem ser objeto do evento “S-2100 - 
Cadastramento Inicial do Vínculo”. 

**Pré-requisitos:** envio pela empresa/órgão público do evento “S-1000 - 
Informações do Empregador/Contribuinte/Órgão Público” e envio das tabelas do 
empregador/contribuinte/órgão público no eSocial.

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

    $evt = Event::evtAdmissao($configJson, $std, $certificate);

} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados

## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAdmissao/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtAdmissao/v02_02_01 ../schemes/evtAdmissao.xsd ">
  <evtAdmissao Id="idvalue0">
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
      <indPriEmpr>indPriEmpr</indPriEmpr>
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
  </evtAdmissao>
  <Signature/>
</eSocial>

```
