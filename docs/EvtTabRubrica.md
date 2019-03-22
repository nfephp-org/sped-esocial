# EvtTabRubrica

## Evento
 *evtTabRubrica*

## Alias
 *S-1010 - Tabela de Rubricas*


## Detalhamento

**Conceito do evento:** Apresenta o detalhamento das informações das rubricas constantes da folha de pagamento do empregador/contribuinte/órgão público, permitindo a correlação destas com as constantes da tabela de natureza das rubricas da folha de pagamento do eSocial. É utilizado para inclusão, alteração e exclusão de registros na tabela de RUBRICAS do empregador/contribuinte/órgão público. As informações consolidadas desta tabela são utilizadas para validação do evento de Remuneração dos trabalhadores.

**Quem está obrigado:** O empregador/contribuinte/órgão público, na primeira vez que utilizar o eSocial e toda vez que for criada, alterada ou excluída uma determinada rubrica. 

**Prazo de envio:** O evento Tabela de Rubricas deve ser enviado antes dos eventos relacionados à Remuneração do Trabalhador - Evento “S-1200 - Remuneração de Trabalhador vinculado ao Regime Geral de Previdência Social”, “S-1202 - Remuneração de servidor vinculado a Regime Próprio de Previdência Social” e “S-1207 - Benefícios previdenciários – RPPS”, bem como antes dos eventos S-2299 – Desligamento e S-2399 – Trabalhador sem Vínculo de Emprego/Estatutário - Término, que referenciam rubricas pagas na rescisão.
Pré-requisitos: Cadastro completo das Informações do Empregador/Contribuinte/órgão Público - Evento S-1000.

**Informações adicionais:**

Vide Manual

## Comentário

Dentre as informações que as empresas devem inserir no eSocial, uma das principais e mais importantes são as rubricas, que podem ser conceituadas como os eventos relativos aos valores devidos aos empregados, sejam os salários, adicionais, benefícios ou quaisquer outros que vinculam-se à folha de pagamento.

Para tanto, quando da parametrização da tabela de rubricas, faz-se necessário, primeiramente, a inserção daquelas já previamente constantes na referida tabela, que podem seguir a nomenclatura lá constante ou outra similar, desde que não altere a sua estrutura.

Caso existam outras não mencionadas na tabela, a empresa poderá criá-las, com códigos próprios, informando uma nomenclatura e sua natureza.

Como exemplo, podemos citar um "biênio" determinado pelo sindicato, que não encontra-se na tabela pré estabelecida no sistema, mas que será inserida pela própria empresa com código e natureza incluídas manualmente.

Isso porque a inclusão das rubricas propiciará o cruzamento dos dados lançados na folha de pagamento com a sua tabela.

Após a inserção de todas as rubricas existentes na empresa, é imprescindível uma análise rigorosa quanto às suas incidências, haja vista que qualquer inconsistência pode gerar graves problemas, seja de autuação, ou ainda de cobranças pela ausência da tributação cabível ou pagamento de tributos indevidos.

Essa parametrização deve levar em consideração o código da rubrica, sua natureza e tipo, podendo ser de vencimento, desconto, informativa e informativa dedutora. Lembrando que as rubricas já utilizadas pela empresa não precisam, necessariamente, ter suas nomenclaturas alteradas para implantação do eSocial, mas deverão ser adequadas à Tabela de Natureza das Rubricas da Folha de Pagamento do Manual de Orientação do eSocial.

Assim sendo, desde as rubricas mais simples como o salário em si, bem como determinações da convenção coletiva devem ser obrigatoriamente informadas e estes devem ser seguidos pela correspondente incidência em FGTS, INSS e Imposto de Renda.

Inclusive, no tocante à existência de processos administrativos ou judiciais relativos à suspensão de incidência tributária, caso haja decisão favorável, esta deverá ser informada no eSocial vinculada à rubrica objeto da ação, para justificar a exclusão da contribuição.

Recomendamos atenção na elaboração da tabela de rubricas, de modo a evitar que o envio de dados ocorra de forma inconsistente, fato que poderia ensejar multa à empresa, tanto pela incorreção dos mesmos, quanto pela omissão da tributação das verbas informadas.

Lembramos que, mesmo que o envio seja feito por uma contabilidade externa, eventual autuação será dirigida à empresa, haja vista que esta sempre será considerada responsável pelos dados.

Diante disso, alertamos para a necessidade de um profissional qualificado para o acompanhamento da inserção das informações no sistema e consequente análise quanto à tributação das verbas para que a empresa fique resguardada de quaisquer custos decorrentes de multas e cobranças futuras.

## Recomendação para Tabela de Base de Dados

### Table: rubricas - tabela de rubricas

|field|type|comment|
|:---|:---:|:---|
|id|integer|id da tabela|
|codRubr|string|código interno da rubrica|
|iniValid|datetime|inicio da validade|
|fimValid|datetime|fim da validade|
|dscRubr|string|descrição da rubrica|
|natRubr|string|Tabela 3 - Tabela de Natureza das Rubricas da Folha de Pagamento|
|tpRubr|integer|Tipo de rubrica: 1 - Vencimento, provento ou pensão; 2 - Desconto; 3 - Informativa; 4 - Informativa dedutora|
|codIncCP|string|Código de incidência tributária da rubrica para a Previdência Social|
|codIncIRRF|string|Código de incidência tributária da rubrica para o IRRF|
|codIncFGTS|string|Código de incidência da rubrica para o FGTS|
|codIncSIND|string|Código de incidência tributária da rubrica para a Contribuição Sindical Laboral|
|id_rubricasprocs|integer|id da tabela dos processos adminsitrativos RELACIONADOS as rubricas|
|id_rubricasprocirrf|integer|id da tabela dos processos correlatos a IRRF RELACIONADOS as rubricas|
|id_rubricasprocfgts|integer|id da tabela dos processos correlatos a FGTS RELACIONADOS as rubricas|
|id_rubricasprocfgts|integer|id da tabela dos processos correlatos a Contribuição Sindical RELACIONADOS as rubricas|

### Table: rubricasprocs - tabela de processos administrativos e judiciais

|field|type|comment|
|:---|:---:|:---|
|id|integer|id da tabela|
|tpProc|integer|Preencher com o código correspondente ao tipo de processo: 1 - Administrativo; 2 - Judicial.|
|nrProc|string|Informar um número de processo cadastrado através do evento S-1070, cujo {indMatProc} seja igual a [1]|
|extDecisao|integer|Extensão da Decisão/Sentença: 1 - Contribuição Previdenciária Patronal; 2 - Contribuição Previdenciária Patronal + Descontada dos Segurados.|
|codSusp|string|Código do Indicativo da Suspensão, atribuído pelo empregador em S-1070.|

### Table: rubricasprocirrf - tabela de processos judiciais relativos a IRRF

|field|type|comment|
|:---|:---:|:---|
|id|integer|id da tabela|
|nrProc|string|Informar um número de processo cadastrado através do evento S-1070, cujo {indMatProc} seja igual a [1].|
|codSusp|string|Código do Indicativo da Suspensão, atribuído pelo empregador em S-1070|

### Table: rubricasprocfgts - tabela de processos judiciais relativos a FGTS

|field|type|comment|
|:---|:---:|:---|
|id|integer|id da tabela|
|nrProc|string|Informar um número de processo cadastrado através do evento S-1070, cujo {indMatProc} seja igual a [1, 7]|

### Table: rubricasprocsind - tabela de processos judiciais relativos a Sindicatos

|field|type|comment|
|:---|:---:|:---|
|id|integer|id da tabela|
|nrProc|string|Informar um número de processo cadastrado através do evento S-1070, cujo {indMatProc} seja igual a [8]|

## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:


## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
    $evt = Event::evtTabRubrica($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTabRubrica/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTabRubrica/v02_02_01 ../schemes/evtTabRubrica.xsd ">
  <evtTabRubrica Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoRubrica>
      <inclusao>
        <ideRubrica>
          <codRubr>codRubr</codRubr>
          <iniValid>iniValid</iniValid>
        </ideRubrica>
        <dadosRubrica>
          <dscRubr>dscRubr</dscRubr>
          <natRubr>0</natRubr>
          <tpRubr>0</tpRubr>
          <codIncCP>codIncCP</codIncCP>
          <codIncIRRF>codIncIRRF</codIncIRRF>
          <codIncFGTS>codIncFGTS</codIncFGTS>
          <codIncSIND>codIncSIND</codIncSIND>
          <repDSR>repDSR</repDSR>
          <rep13>rep13</rep13>
          <repFerias>repFerias</repFerias>
          <repAviso>repAviso</repAviso>
        </dadosRubrica>
      </inclusao>
    </infoRubrica>
  </evtTabRubrica>
  <Signature/>
</eSocial>

```
