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
1. O empregador/contribuinte/órgão público pode manter a sua própria tabela de rubricas utilizada atualmente, não sendo obrigatória a modificação de sua nomenclatura para adesão ao eSocial. No entanto, caso o empregador/contribuinte/órgão público deseje, poderá proceder a uma readequação/depuração das suas rubricas antes da utilização do eSocial;

2. Este evento exige uma análise prévia da tabela de rubricas do empregador/contribuinte/órgão público com vistas a verificar as suas incidências para o FGTS, Previdência Social, Imposto de Renda Retido na Fonte e/ou Contribuição Sindical Laboral.

3. Antes do envio desse evento o empregador/contribuinte/órgão público deve correlacionar a tabela de rubricas da empresa com a tabela 3 – Tabela de Natureza das Rubricas da Folha de Pagamento do eSocial, deste manual.

4. Apenas para efeito informativo e para uma melhor localização e vinculação das rubricas da empresa/órgão público, a tabela 3 – Natureza das Rubricas da Folha de Pagamento do eSocial está organizada de acordo com a seguinte estrutura, observando-se os dois primeiros dígitos dos códigos identificadores de grupo.

5. O empregador/contribuinte/órgão público deve observar a existência de rubricas informativas, que integram a remuneração exclusivamente para fins de cálculos dos valores a serem recolhidos ao FGTS, como, por exemplo, a remuneração que seria devida ao empregado afastado para prestar serviço militar obrigatório, que possui vinculação com o código 9905 (Serviço militar - Valor da remuneração a que teria direito, se em atividade, o trabalhador afastado do trabalho para prestação do serviço militar obrigatório) da Tabela 3 do eSocial;

6. Caso o empregador/contribuinte/órgão público possua processo administrativo ou judicial com decisão/sentença favorável, suspendendo a incidência tributária sobre determinada rubrica, devem ser informados, nos campos {codIncCP}, {codIncIRRF} e {codIncFGTS}, os códigos de incidência suspensa. O evento “S-1070 – Tabela de Processos Administrativos/Judiciais” deve ser enviado antes deste evento;
 
7. Para outros afastamentos, como a remuneração que seria devida ao empregado/servidor afastado por motivo de acidente de trabalho, observar o código 9989 (Outros valores informativos, que não sejam proventos nem descontos);

8. Caso o empregador/contribuinte/órgão público possua uma única tabela de rubricas, no campo {multTabRubricas} do evento “S-1000 – Informações do Empregador/Contribuinte/Órgão Público” deve constar “N” e o campo {ideTabRubr}, dos eventos “S-1010 – Tabela de Rubricas”, “S-1200 – Remuneração do Trabalhador vinculado ao Regime Geral da Previdência Social”, “S-1202 - Remuneração de servidor vinculado a Regime Próprio de Previdência Social”, “S-2399 - Trabalhador Sem Vínculo de Emprego/Estatutário – Término” e “S-2299 – Desligamento”, não deve ser preenchido.

9. Em relação ao banco de horas, observar os códigos 9950 e 9951 da Tabela 3 – Natureza das Rubricas da Folha de Pagamento, deste manual;

10. A Tabela de Rubricas guarda as informações de forma histórica, não podendo haver dados diferentes para a mesma rubrica e o mesmo período de validade. Havendo alteração nos dados desta tabela, faz-se necessário enviar novo evento com a data de início da nova informação.

11. Caso o empregador/contribuinte/órgão público possua mais de uma tabela de rubricas, deve: 
a. Preencher “S” no campo {multTabRubricas} do evento “S-1000 – Informações do Empregador/Contribuinte/Órgão Público”;
b. Na utilização dos códigos de rubrica nos eventos S-1010 – Tabela de Rubricas, S-1200 - Remuneração do Trabalhador. “S-2399 - Trabalhador Sem Vínculo de Emprego/Estatutário – Término” e “S-2299 - Desligamento”, o campo {ideTabRubr} deve ser informado para identificar a tabela a que se refere o código de rubrica informado.

12. Bases de incidência e não incidência:

a. Integram a remuneração para fins de cálculos dos valores devidos à Previdência Social e a serem recolhidos para o FGTS, dentre outras, as seguintes parcelas:

| N | Parcela |
| :---: | :--- |
| I | Abonos ou gratificações de férias, excedentes aos limites legais (art. 144 da CLT); |
| II | Abonos de qualquer natureza, exceto aqueles cuja incidência seja expressamente excluída por lei; |
| III | Adicionais de insalubridade, periculosidade, trabalho noturno, por tempo de serviço, por transferência de local de trabalho ou função; |
|IV | Auxílio-doença (quinze primeiros dias de afastamento); |
| V | Aviso prévio trabalhado; |
| VI | Bonificações; |
| VII | Comissões; |
| VIII | Décimo terceiro salário; |
| IX | Diárias para viagem, pelo seu valor total, quando excederem a cinqüenta por cento da remuneração mensal do empregado; |
| X | Etapas (marítimos); |
| XI | Férias normais gozadas na vigência do contrato de trabalho (inclusive um terço constitucional); |
| XII | Gorjetas (espontâneas ou compulsórias); |
| XIII | Gratificações ajustadas (expressas ou tácitas); |
| XIV | Horas extras; |
| XV | Prêmios contratuais ou habituais; |
| XVI | Produtividade; |
| XVII | Quebra de caixa; |
| XVIII | Repouso semanal remunerado; |
| XIX | Representação; |
| XX | Retiradas de diretores não empregados equiparados aos trabalhadores sujeitos a regime do FGTS (art. 16 da Lei no 8.036/90); |
| XXI | Salário in natura; |
| XXII | Salário-família, que exceder ao valor legal obrigatório; |
| XXIII | Salário-maternidade; |
| XXIV | Salário; |
| XXV | Saldo de salário. |





## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtTabRubrica($configJson, $std);
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
