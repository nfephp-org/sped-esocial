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

Vide Manual


## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:


## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
     $evt = Event::evtTabEstab($configJson, $std);
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
