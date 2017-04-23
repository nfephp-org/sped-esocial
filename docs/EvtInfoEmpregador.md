# EvtInfoEmpregador

## Evento: evtInfoEmpregador

## Alias: S-1000 - Informações do Empregador/Contribuinte/Órgão Público


## Detalhamento


**Conceito do evento:** Evento onde são fornecidas pelo empregador/contribuinte/órgão público as informações cadastrais, alíquotas e demais dados necessários ao preenchimento e validação dos demais eventos do eSocial, inclusive para apuração das contribuições previdenciárias devidas ao RGPS e do FGTS. Este é o primeiro evento que deve ser transmitido pelo empregador/contribuinte/órgão público. Não pode ser enviado qualquer outro evento antes deste.

**Quem está obrigado:** O empregador/contribuinte/órgão público, no início da utilização do eSocial e toda vez que ocorra alguma alteração nas informações relacionadas aos campos envolvidos nesse evento.

**Prazo de envio:** A informação prestada neste evento deve ser enviada no início da utilização do eSocial e pode ser alterada no decorrer do tempo, hipótese em que deve ser enviado este mesmo evento com a informação nova, quando da sua ocorrência.

**Pré-requisitos:** Não há. Este é o primeiro evento a ser transmitido pelo empregador/contribuinte/órgão público.

**Informações adicionais:**
1. Neste evento estão discriminadas informações que influenciarão a apuração correta das contribuições previdenciárias devidas ao RGPS e do FGTS, como a classificação tributária do contribuinte, indicativo de desoneração da folha, isenções para entidades beneficentes de assistência social, acordos internacionais para isenção de multa, situação da empresa (normal, extinção, fusão, cisão ou incorporação), cooperativas de trabalho, construtoras, opção pelo registro eletrônico de empregados, processos judiciais e administrativos, entre outras.

2. No caso de informações complementares de empregador pessoa física, o empregador/contribuinte deve informar nesse evento as situações de Declaração Final de Espólio e Comunicação de Saída Definitiva do País, se for o caso. 

3. O cadastro do empregador/contribuinte/órgão público guarda as informações de forma histórica, não podendo haver informações diferentes para o mesmo evento e período de validade. Havendo alteração nos dados deste cadastro, faz-se necessário informar a data do fim de validade da informação anterior e enviar novo evento com a data de início da nova informação.

4. O empregador/contribuinte/órgão público deve observar atentamente as informações constantes do evento S-1070 relativas ao indicativo de suspensão, campo {indSusp}, verificando a situação em que se encontra o processo judicial/administrativo e suas repercussões para o cálculo das contribuições e impostos. O empregador/contribuinte também deve informar se é uma entidade educativa sem fins lucrativos que tenha por objetivo a assistência ao adolescente e à educação profissional (art. 430, inciso II, CLT), bem como se é Empresa de Trabalho Temporário (Lei n° 6.019/1974), com registro no Ministério do Trabalho.

5. Se for informada natureza jurídica de Administração Pública Federal (códigos 101-5, 104-0, 107-4 e 116-3) o campo {tpInsc} deve ser preenchido o CNPJ completo com 14 (quatorze) posições. Nos demais casos, deve ser informado o CNPJ com 8 (oito) posições, exceto pessoa física que deverá ser um CPF válido.

6. Os órgãos públicos, prestarão as respectivas informações do número SIAFI no grupo [infoOP], complementando a informação do ente federativo no grupo [InfoEnte].


## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtInfoEmpregador($configJson, $std);
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
