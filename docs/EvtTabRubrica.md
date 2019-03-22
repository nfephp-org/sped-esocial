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

Table: tabrubricas

|field|type|comment|
|---|---|---|
|id|integer|id da tabela|
|codigo|string|código interno da rubrica|
|inivalid|datetime|inicio da validade|
|fimvalid|datetime|fim da validade|
|desc|string|descrição da rubrica|
|natureza|


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
