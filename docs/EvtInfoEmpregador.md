# EvtInfoEmpregador

## Evento
 *evtInfoEmpregador*

## Alias
 *S-1000 - Informações do Empregador/Contribuinte/Órgão Público*


## Detalhamento
**Conceito do evento:** Evento onde são fornecidas pelo empregador/contribuinte/órgão público as informações cadastrais, alíquotas e demais dados necessários ao preenchimento e validação dos demais eventos do eSocial, inclusive para apuração das contribuições previdenciárias devidas ao RGPS e do FGTS. Este é o primeiro evento que deve ser transmitido pelo empregador/contribuinte/órgão público. Não pode ser enviado qualquer outro evento antes deste.

**Quem está obrigado:** O empregador/contribuinte/órgão público, no início da utilização do eSocial e toda vez que ocorra alguma alteração nas informações relacionadas aos campos envolvidos nesse evento.

**Prazo de envio:** A informação prestada neste evento deve ser enviada no início da utilização do eSocial e pode ser alterada no decorrer do tempo, hipótese em que deve ser enviado este mesmo evento com a informação nova, quando da sua ocorrência.

**Pré-requisitos:** Não há. Este é o primeiro evento a ser transmitido pelo empregador/contribuinte/órgão público.

**Informações adicionais:**

Vide Manual


## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:

| Propriedade | Tipo | Ocorrência | Tamanho | Dec | Descrição |
| :---  | :---: | :---: | :---: | :---: | :--- |
| iniValid | C | 1-1 | 7 | - | Preencher com o mês e ano de início da validade das informações prestadas no evento, no formato AAAA-MM. Validação: Deve ser uma data válida, igual ou posterior à data inicial de implantação do eSocial, no formato AAAA-MM. |
| fimValid | C | 0-1 | 7 | - | Preencher com o mês e ano de término da validade das informações, se houver. Validação: Se informado, deve estar no formato AAAA-MM e ser um período igual ou posterior a {iniValid} |
| nmRazao | C | 1-1 | 115 | - | Informar a razão social, no caso de pessoa jurídica ou órgão público. |
| classTrib | C | 1-1 | 2 | - | Preencher com o código correspondente à classificação tributária do contribuinte, conforme tabela 8. Validação: Deve ser um dos códigos existentes na tabela.  Os códigos [21] e [22] somente podem ser utilizados se {tpInsc} for igual a [2].  Para os demais códigos, {tpInsc} deve ser igual a [1]. |
| natJurid | C | 0-1 | 4 | - | Preencher com o código da Natureza Jurídica do Contribuinte, conforme tabela 21. Validação: O preenchimento do campo é obrigatório e exclusivo para empregador PJ e administração pública. Neste caso, deve ser um código existente na tabela 21 e compatível com a informação constante no CNPJ. Se {classtrib} = [85], o número da {natJurid} deve iniciar por 1 (exemplo: 101- 5, 112-0, etc.). |
| indCoop | N | 0-1 | 1 | - | Indicativo de Cooperativa: 0 - Não é cooperativa; |
| indConstr | N | 0-1 | 1 | - | Indicativo de Construtora: 0 - Não é Construtora; 1 - Empresa Construtora. Validação: O preenchimento do campo é exclusivo e obrigatório para PJ. Valores Válidos: 0, 1. |
| indDesFolha | N | 1-1 | 1 | - | Indicativo de Desoneração da Folha: 0 - Não Aplicável; 1 - Empresa enquadrada nos art. 7º a 9º da Lei 12.546/2011. Validação: Pode ser igual a [1] apenas se a classificação tributária for igual a [02,03,99].  Nos demais casos, deve ser igual a [0]. Valores Válidos: 0, 1. |
| indOptRegEletron | N | 1-1 | 1 | - | Indica se houve opção pelo registro eletrônico de empregados: 0 - Não optou pelo registro eletrônico de empregados; 1 - Optou pelo registro eletrônico de empregados. Valores Válidos: 0, 1. |
| multTabRubricas | C | 1-1 | 1 | - | Informar se a empresa utiliza mais de uma tabela de rubricas: S - Sim; N - Não. Valores Válidos: S, N. |
| indEntEd | C | 0-1 | 1 | - | Indicativo de entidade educativa sem fins lucrativos que tenha por objetivo a assistência ao adolescente e à educação profissional (art. 430, inciso II, CLT): N - Não é entidade educativa sem fins lucrativos; S - É entidade educativa sem fins lucrativos. Validação: O preenchimento é exclusivo e obrigatório para Pessoa Jurídica. Valores Válidos: S,N. |
| indEtt | C | 1-1 | 1 | - | Indicativo de Empresa de Trabalho Temporário (Lei n° 6.019/1974), com registro no Ministério do Trabalho: N - Não é Empresa de Trabalho Temporário; S - Empresa de Trabalho Temporário. Valores Válidos: S,N. |
| nrRegEtt | N | 0-1 | 30 | - | Número do registro da Empresa de Trabalho Temporário no Ministério do Trabalho. Validação: Preenchimento obrigatório se {indEtt} = [S]. Não pode ser informado nos demais casos. |
| ideMinLei | C | 1-1 | 70 | - | Sigla e nome do Ministério ou Lei que concedeu o Certificado |
| nrCertif | C | 1-1 | 40 | - | Número do Certificado de Entidade Beneficente de Assistência Social, número da portaria de concessão do Certificado, ou, no caso de concessão através de Lei específica, o número da Lei. |
| dtEmisCertif | D | 1-1 | - | - | Data de Emissão do Certificado/publicação da Lei |
| dtVencCertif | D | 1-1 | - | - | Data de Vencimento do Certificado Validação: Não pode ser anterior a {dtEmisCertif} |
| nrProtRenov | C | 0-1 | 40 | - | Protocolo pedido renovação |
| dtProtRenov | D | 0-1 | - | - | Data do protocolo de renovação |
| dtDou | D | 0-1 | - | - | Preencher com a data de publicação no Diário Oficial da União |
| pagDou | N | 0-1 | 5 | - | Preencher com o número da página no DOU referente à publicação do documento de concessão do certificado. |
| nmCtt | C | 1-1 | 70 | - | Nome do contato na empresa. Pessoa responsável por ser o contato do empregador com os órgãos gestores do eSocial Regra de validação: REGRA_GERAL_VALIDA_NOME |
| cpfCtt | C | 1-1 | 11 | - | Preencher com o número do CPF do contato. Validação: A inscrição é validada na base de dados do CPF da RFB. |
| foneFixo | C | 0-1 | 13 | - | Informar o número do telefone, com DDD. Validação: O preenchimento é obrigatório se o campo {foneCel} não for preenchido. Se preenchido, deve conter apenas números, com o mínimo de dez dígitos. |
| foneCel | C | 0-1 | 13 | - | Telefone celular, com DDD Validação: Se preenchido, deve conter apenas números, com o mínimo de dez dígitos. |
| email | C | 0-1 | 60 | - | Endereço eletrônico Validação: O e-mail deve possuir o caractere "@" e este não pode estar no início e no fim do e-mail. Deve possuir no mínimo um caractere "." depois do @ e não pode estar no fim do e-mail. |
| nrSiafi | C | 1-1 | 6 | - | Preencher com o número SIAFI - Sistema Integrado de Administração Financeira, caso seja órgão público usuário do sistema. |
| ideEFR | C | 1-1 | 1 | - | Informar se o Órgão Público é o Ente Federativo Responsável - EFR ou se é |
| cnpjEFR | C | 0-1 | 14 | - | CNPJ do Ente Federativo Responsável - EFR Validação: Preenchimento obrigatório se {ideEFR} = [N]. Informação validada no cadastro do CNPJ da RFB. |
| nmEnte | C | 1-1 | 115 | - | Nome do Ente Federativo ao qual o órgão está vinculado |
| uf | C | 1-1 | 2 | - | Preencher com a sigla da Unidade da Federação Validação: Deve ser uma UF válida. |
| codMunic | N | 0-1 | 7 | - | Preencher com o código do município, conforme tabela do IBGE Validação: Se informado, deve ser um código existente na tabela do IBGE. |
| indRPPS | C | 1-1 | 1 | - | Informar se o ente público possui Regime Próprio de Previdência Social - RPPS. S - Sim; N - Não. Valores Válidos: S, N |
| subteto | N | 1-1 | 1 | - | Preencher com o poder a que se refere o subeto: 1 - Executivo; 2 - Judiciário; 3 - Legislativo; 9 - Todos os poderes. Valores Válidos: 1, 2, 3, 9. |
| vrSubteto | N | 1-1 | 14 | 2 | Preencher com o valor do subteto do Ente Federativo. |
| indAcordoIsenMulta | N | 1-1 | 1 | - | Indicativo da existência de acordo internacional para isenção de multa: 0 - Sem acordo; 1 - Com acordo. Valores Válidos: 0, 1. |
| cnpjSoftHouse | C | 1-1 | 14 | - | CNPJ da empresa desenvolvedora do software. Se o software foi desenvolvido pelo próprio empregador, informar o CNPJ do estabelecimento do empregador responsável pelo desenvolvimento. Regra de validação: REGRA_VALIDA_CNPJ |
| nmRazao | C | 1-1 | 115 | - | Informar a razão social, no caso de pessoa jurídica ou órgão público. |
| nmCont | C | 1-1 | 70 | - | Nome do contato na empresa. Regra de validação: REGRA_GERAL_VALIDA_NOME |
| telefone | C | 1-1 | 13 | - | Informar o número do telefone, com DDD. Validação: Deve conter apenas números, com o mínimo de dez dígitos. |
| email | C | 0-1 | 60 | - | Endereço eletrônico Validação: O e-mail deve possuir o caractere "@" e este não pode estar no início e no fim do e-mail. Deve possuir no mínimo um caractere "." depois do @ e não pode estar no fim do e-mail. |
| indSitPJ | N | 1-1 | 1 | - | Indicativo da Situação da Pessoa Jurídica: 0 - Situação Normal; 1 - Extinção; 2 - Fusão; 3 - Cisão; 4 - Incorporação. Valores Válidos: 0, 1, 2, 3, 4 |
| indSitPF | N | 1-1 | 1 | - | Indicativo da Situação da Pessoa Física: 0 - Situação Normal; 1 - Encerramento de espólio; 2 - Saída do país em caráter permanente. Valores Válidos: 0, 1, 2 |
| iniValid | C | 1-1 | 7 | - | Preencher com o mês e ano de início da validade das informações prestadas no evento, no formato AAAA-MM. Validação: Deve ser uma data válida, igual ou posterior à data inicial de implantação do eSocial, no formato AAAA-MM. |
| fimValid | C | 0-1 | 7 | - | Preencher com o mês e ano de término da validade das informações, se houver. Validação: Se informado, deve estar no formato AAAA-MM e ser um período igual ou posterior a {iniValid} |
| nmRazao | C | 1-1 | 115 | - | Informar a razão social, no caso de pessoa jurídica ou órgão público. |
| classTrib | C | 1-1 | 2 | - | Preencher com o código correspondente à classificação tributária do contribuinte, conforme tabela 8. |
| natJurid | C | 0-1 | 4 | - | Preencher com o código da Natureza Jurídica do Contribuinte, conforme tabela 21. Validação: O preenchimento do campo é obrigatório e exclusivo para empregador PJ e administração pública. Neste caso, deve ser um código existente na tabela 21 e compatível com a informação constante no CNPJ. Se {classtrib} = [85], o número da {natJurid} deve iniciar por 1 (exemplo: 101- 5, 112-0, etc.). |
| indCoop | N | 0-1 | 1 | - | Indicativo de Cooperativa: 0 - Não é cooperativa; 1 - Cooperativa de Trabalho; 2 - Cooperativa de Produção; 3 - Outras Cooperativas. Validação: O preenchimento do campo é exclusivo e obrigatório para PJ. Somente pode ser diferente de  ZERO se {natJurid} for igual a [2143] e {classTrib} for igual a [06, 07, 99].  Para {classTrib} for igual a [06,07] o campo deverá ser preenchido apenas com [0,2]. Valores Válidos: 0, 1, 2, 3. |
| indConstr | N | 0-1 | 1 | - | Indicativo de Construtora: 0 - Não é Construtora; 1 - Empresa Construtora. Validação: O preenchimento do campo é exclusivo e obrigatório para PJ. Valores Válidos: 0, 1. |
| indDesFolha | N | 1-1 | 1 | - | Indicativo de Desoneração da Folha: 0 - Não Aplicável; 1 - Empresa enquadrada nos art. 7º a 9º da Lei 12.546/2011. Validação: Pode ser igual a [1] apenas se a classificação tributária for igual a [02,03,99].  Nos demais casos, deve ser igual a [0]. Valores Válidos: 0, 1. |
| indOptRegEletron | N | 1-1 | 1 | - | Indica se houve opção pelo registro eletrônico de empregados: 0 - Não optou pelo registro eletrônico de empregados; 1 - Optou pelo registro eletrônico de empregados. Valores Válidos: 0, 1. |
| multTabRubricas | C | 1-1 | 1 | - | Informar se a empresa utiliza mais de uma tabela de rubricas: S - Sim; N - Não. Valores Válidos: S, N. |
| indEntEd | C | 0-1 | 1 | - | Indicativo de entidade educativa sem fins lucrativos que tenha por objetivo a assistência ao adolescente e à educação profissional (art. 430, inciso II, CLT): N - Não é entidade educativa sem fins lucrativos; S - É entidade educativa sem fins lucrativos. Validação: O preenchimento é exclusivo e obrigatório para Pessoa Jurídica. Valores Válidos: S,N. |
| indEtt | C | 1-1 | 1 | - | Indicativo de Empresa de Trabalho Temporário (Lei n° 6.019/1974), com registro no Ministério do Trabalho: N - Não é Empresa de Trabalho Temporário; S - Empresa de Trabalho Temporário. Valores Válidos: S,N. |
| nrRegEtt | N | 0-1 | 30 | - | Número do registro da Empresa de Trabalho Temporário no Ministério do Trabalho. Validação: Preenchimento obrigatório se {indEtt} = [S]. Não pode ser informado nos demais casos. |
| ideMinLei | C | 1-1 | 70 | - | Sigla e nome do Ministério ou Lei que concedeu o Certificado |
| nrCertif | C | 1-1 | 40 | - | Número do Certificado de Entidade Beneficente de Assistência Social, número da portaria de concessão do Certificado, ou, no caso de concessão através de Lei específica, o número da Lei. |
| dtEmisCertif | D | 1-1 | - | - | Data de Emissão do Certificado/publicação da Lei |
| dtVencCertif | D | 1-1 | - | - | Data de Vencimento do Certificado Validação: Não pode ser anterior a {dtEmisCertif} |
| nrProtRenov | C | 0-1 | 40 | - | Protocolo pedido renovação |
| dtProtRenov | D | 0-1 | - | - | Data do protocolo de renovação |
| dtDou | D | 0-1 | - | - | Preencher com a data de publicação no Diário Oficial da União |
| pagDou | N | 0-1 | 5 | - | Preencher com o número da página no DOU referente à publicação do documento de concessão do certificado. |
| nmCtt | C | 1-1 | 70 | - | Nome do contato na empresa. Pessoa responsável por ser o contato do empregador com os órgãos gestores do eSocial Regra de validação: REGRA_GERAL_VALIDA_NOME |
| cpfCtt | C | 1-1 | 11 | - | Preencher com o número do CPF do contato. Validação: A inscrição é validada na base de dados do CPF da RFB. |
| foneFixo | C | 0-1 | 13 | - | Informar o número do telefone, com DDD. Validação: O preenchimento é obrigatório se o campo {foneCel} não for preenchido. Se preenchido, deve conter apenas números, com o mínimo de dez dígitos. |
| foneCel | C | 0-1 | 13 | - | Telefone celular, com DDD Validação: Se preenchido, deve conter apenas números, com o mínimo de dez dígitos. |
| email | C | 0-1 | 60 | - | Endereço eletrônico Validação: O e-mail deve possuir o caractere "@" e este não pode estar no início e no fim do e-mail. Deve possuir no mínimo um caractere "." depois do @ e não pode estar no fim do e-mail. |
| nrSiafi | C | 1-1 | 6 | - | Preencher com o número SIAFI - Sistema Integrado de Administração Financeira, caso seja órgão público usuário do sistema. |
| ideEFR | C | 1-1 | 1 | - | Informar se o Órgão Público é o Ente Federativo Responsável - EFR ou se é uma unidade administrativa autônoma vinculada a um EFR; S - É EFR; N - Não é EFR. Validação: Essa informação é validada no cadastro do CNPJ na RFB. Valores Válidos: S, N. |
| cnpjEFR | C | 0-1 | 14 | - | CNPJ do Ente Federativo Responsável - EFR Validação: Preenchimento obrigatório se {ideEFR} = [N]. Informação validada no cadastro do CNPJ da RFB. |
| nmEnte | C | 1-1 | 115 | - | Nome do Ente Federativo ao qual o órgão está vinculado |
| uf | C | 1-1 | 2 | - | Preencher com a sigla da Unidade da Federação Validação: Deve ser uma UF válida. |
| codMunic | N | 0-1 | 7 | - | Preencher com o código do município, conforme tabela do IBGE Validação: Se informado, deve ser um código existente na tabela do IBGE. |
| indRPPS | C | 1-1 | 1 | - | Informar se o ente público possui Regime Próprio de Previdência Social - RPPS. S - Sim; N - Não. Valores Válidos: S, N |
| subteto | N | 1-1 | 1 | - | Preencher com o poder a que se refere o subeto: 1 - Executivo; 2 - Judiciário; 3 - Legislativo; 9 - Todos os poderes. Valores Válidos: 1, 2, 3, 9. |
| vrSubteto | N | 1-1 | 14 | 2 | Preencher com o valor do subteto do Ente Federativo. |
| indAcordoIsenMulta | N | 1-1 | 1 | - | Indicativo da existência de acordo internacional para isenção de multa: 0 - Sem acordo; 1 - Com acordo. Valores Válidos: 0, 1. |
| cnpjSoftHouse | C | 1-1 | 14 | - | CNPJ da empresa desenvolvedora do software. Se o software foi desenvolvido pelo próprio empregador, informar o CNPJ do estabelecimento do empregador responsável pelo desenvolvimento. Regra de validação: REGRA_VALIDA_CNPJ |
| nmRazao | C | 1-1 | 115 | - | Informar a razão social, no caso de pessoa jurídica ou órgão público. |
| nmCont | C | 1-1 | 70 | - | Nome do contato na empresa. Regra de validação: REGRA_GERAL_VALIDA_NOME |
| telefone | C | 1-1 | 13 | - | Informar o número do telefone, com DDD. Validação: Deve conter apenas números, com o mínimo de dez dígitos. |
| email | C | 0-1 | 60 | - | Endereço eletrônico Validação: O e-mail deve possuir o caractere "@" e este não pode estar no início e no fim do e-mail. Deve possuir no mínimo um caractere "." depois do @ e não pode estar no fim do e-mail. |
| indSitPJ | N | 1-1 | 1 | - | Indicativo da Situação da Pessoa Jurídica: 0 - Situação Normal; 1 - Extinção; 2 - Fusão; 3 - Cisão; 4 - Incorporação. Valores Válidos: 0, 1, 2, 3, 4 |
| indSitPF | N | 1-1 | 1 | - | Indicativo da Situação da Pessoa Física: 0 - Situação Normal; 1 - Encerramento de espólio; 2 - Saída do país em caráter permanente. Valores Válidos: 0, 1, 2 |
| iniValid | C | 1-1 | 7 | - | Preencher com o mês e ano de início da validade das informações prestadas no evento, no formato AAAA-MM. Validação: Deve ser uma data válida, igual ou posterior à data inicial de implantação do eSocial, no formato AAAA-MM. |
| fimValid | C | 0-1 | 7 | - | Preencher com o mês e ano de término da validade das informações, se houver. Validação: Se informado, deve estar no formato AAAA-MM e ser um período igual ou posterior a {iniValid} |

## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
    $evt = Event::evtInfoEmpregador($configJson, $std);
} catch (\Exception $e) {
    //aqui você trata as exceptions
}
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtInfoEmpregador/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtInfoEmpregador/v02_02_01 ../schemes/evtInfoEmpregador.xsd ">
  <evtInfoEmpregador Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoEmpregador>
      <inclusao>
        <idePeriodo>
          <iniValid>iniValid</iniValid>
        </idePeriodo>
        <infoCadastro>
          <nmRazao>nmRazao</nmRazao>
          <classTrib>classTrib</classTrib>
          <indDesFolha>0</indDesFolha>
          <indOptRegEletron>0</indOptRegEletron>
          <multTabRubricas>multTabRubricas</multTabRubricas>
          <indEtt>indEtt</indEtt>
          <contato>
            <nmCtt>nmCtt</nmCtt>
            <cpfCtt>cpfCtt</cpfCtt>
          </contato>
          <infoComplementares/>
        </infoCadastro>
      </inclusao>
    </infoEmpregador>
  </evtInfoEmpregador>
  <Signature/>
</eSocial>

```
