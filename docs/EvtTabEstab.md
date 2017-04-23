# EvtTabEstab

## Evento
 *evtTabEstab*

## Alias
 *S-1005 - Tabela de Estabelecimentos, Obras ou Unidades de Órgãos Públicos*


## Detalhamento
**Conceito do evento:** O evento identifica os estabelecimentos e obras de construção civil da empresa, detalhando as informações de cada estabelecimento (matriz e filiais) do empregador/contribuinte, como: informações relativas ao CNAE Preponderante, FAP, alíquota GILRAT, indicativo de substituição da contribuição patronal de obra de construção civil, dentre outras. As pessoas físicas devem cadastrar neste evento seus CAEPF – Cadastro de Atividade Econômica Pessoa Física. As informações prestadas no evento são utilizadas na apuração das contribuições incidentes sobre as remunerações dos trabalhadores dos referidos estabelecimentos, obras e CAEPF.
O órgão público informará as suas respectivas unidades, individualizadas por CNPJ, como estabelecimento. 

**Quem está obrigado:** O empregador/contribuinte, na implantação do eSocial e toda vez que for criado um estabelecimento ou obra, ou quando for alterada uma determinada informação sobre um estabelecimento/obra. O próprio estabelecimento matriz da empresa deve ser cadastrado nesse evento para correta informação do CNAE Preponderante. 

**Prazo de envio:** O evento Tabela de Estabelecimentos e Obras de Construção Civil deve ser enviado antes dos eventos S-2100 - Cadastramento Inicial do Vínculo, S-2200 - Admissão de Trabalhador e S-1200 - Remuneração do Trabalhador.

**Pré-requisitos:** O evento exige o cadastro Empregador/Contribuinte/Órgão público - Evento S-1000.

**Informações adicionais:**

1. O evento exige uma análise dos estabelecimentos da empresa e definição das informações relativas ao CNAE preponderante, alíquotas GILRAT, Fator Acidentário de Proteção etc;

2. Caso a empresa possua processo judicial/administrativo com decisão/sentença favorável às alíquotas GILRAT, FAP ou contribuição para Outras Entidades e Fundos, por exemplo, este evento deve ser enviado após o evento S-1070 – Tabela de Processos Administrativos/Judiciais;

3. A empresa deve informar a alíquota do GILRAT e o eSocial validará esta informação com a alíquota relacionada ao CNAE preponderante do estabelecimento, só aceitando alíquota diferente no caso de existir processo administrativo ou processo judicial com decisão favorável ao contribuinte, cadastrado no evento “S-1070 - Tabela de Processos Administrativos/Judiciais”;

4. A partir da implantação do eSocial, os empregadores/contribuinte são identificados apenas pelo CNPJ, se pessoa jurídica, e pelo CPF, se pessoa física;

5. Para as obras de construção civil, que possuem responsáveis pessoas físicas ou jurídicas, a matrícula CEI é substituída pelo CNO – Cadastro Nacional de Obras, sempre vinculado a um CNPJ ou a um CPF. As matrículas CEI ativas na data de implantação do CNO relativas as obras, passam a compor o cadastro inicial do CNO;

6. Até a implantação do Cadastro Nacional de Obras, deverá ser usado o CEI da obra no lugar do CNO no eSocial.

7. O CAEPF deve ser cadastrado como estabelecimento, ele deverá ter pelo menos uma lotação tributária.

8. A Tabela de Estabelecimentos/Obras de Construção Civil guarda as informações de forma histórica, não podendo haver dados diferentes para o mesmo estabelecimento/obras de construção civil e o mesmo período de validade. Havendo alteração nos dados desta tabela, faz-se necessário informar a data do fim de validade da informação anterior e enviar novo evento com a data de início da nova informação.

9. O campo {IndAcordoIsenMulta} do grupo [InfOrgIntenacional], é de preenchimento exclusivo de entidades cuja natureza jurídica sejam enquadradas no grupo 5 – Organizações Internacionais e Outras Instituições Extraterritoriais da Tabela 21 – Natureza Jurídica.

10. Neste evento deve ser informada a opção de registro de ponto (jornada) adotada pelo estabelecimento (sistema preponderante): 0 - Não utiliza sistema de controle de ponto; 1 - Sistema manual; 2 - Sistema mecânico; 3 - Sistema de Registro Eletrônico do Ponto - SREP
(portaria MTE 1.510/2009); 4 - Sistema não eletrônico alternativo (art. 1° da Portaria MTE 373/2011); 5 - Sistema eletrônico alternativo (art. 2° da Portaria MTE 373/2011).

11. Caso o estabelecimento contrate aprendiz por intermédio de entidade (s) educativa (s) sem fins lucrativos que tenha (m) por objetivo a assistência ao adolescente e à educação profissional (art. 430, inciso II, CLT), deverá informar o(s) número(s) de inscrição dessa(s) entidade(s).

12. As informações do grupo [infoPCD] – Informações sobre a contratação de pessoa com deficiência (PCD) – referem-se a toda a empresa (matriz e filiais) e devem ser prestadas apenas no estabelecimento “Matriz”.



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:


## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtTabEstab($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtTabEstab/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtTabEstab/v02_02_01 ../schemes/evtTabEstab.xsd ">
  <evtTabEstab Id="idvalue0">
    <ideEvento>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoEstab>
      <inclusao>
        <ideEstab>
          <tpInsc>0</tpInsc>
          <nrInsc>nrInsc</nrInsc>
          <iniValid>iniValid</iniValid>
        </ideEstab>
        <dadosEstab>
          <cnaePrep>0</cnaePrep>
          <aliqGilrat>
            <aliqRat>0</aliqRat>
          </aliqGilrat>
          <infoTrab>
            <regPt>0</regPt>
            <infoApr>
              <contApr>0</contApr>
            </infoApr>
          </infoTrab>
        </dadosEstab>
      </inclusao>
    </infoEstab>
  </evtTabEstab>
  <Signature/>
</eSocial>

```
