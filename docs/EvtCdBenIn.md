# EvtCdBenIn

## Evento
 *evtCdBenIn*

## Alias
 *S-2410 - Cadastro de Benefício - Entes Públicos - Início*


## Detalhamento

**Conceito do evento:** São as informações relativas ao início de benefícios pagos pelos entes públicos, como aposentadorias e pensões. O evento registra o beneficiário, o número do benefício, a data de início, o tipo de benefício e o plano de previdência.

**Quem está obrigado:** Todos os Órgãos Públicos que efetuam pagamento de benefícios a servidores e militares.

**Prazo de envio:** O evento deve ser enviado antes do primeiro evento "S-1210 – Pagamentos de Rendimentos do Trabalho" relativo ao beneficiário.

**Pré-requisitos:** O evento exige o cadastro prévio do beneficiário no evento "S-2400 - Cadastro de Benefíciário" e as informações do órgão público no evento "S-1000 - Informações do Empregador/Contribuinte/Órgão Público".

## Parâmetros

**$std** nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.

- `sequencial` — número sequencial do evento (opcional)
- `indretif` — indicativo de retificação: 1=Original, 2=Retificação (obrigatório)
- `nrrecibo` — número do recibo do evento a ser retificado (obrigatório se indretif=2)
- `cpfbenef` — CPF do beneficiário (obrigatório)
- `matricula` — matrícula do servidor no sistema de RH do órgão (opcional)
- `cnpjorigem` — CNPJ do órgão responsável pela matrícula (opcional)
- `cadini` — indica se o benefício é anterior à obrigatoriedade do eSocial: S/N (obrigatório)
- `indsitbenef` — situação do benefício: 1=Concedido, 2=Transferido, 3=Mudança de CPF (opcional)
- `nrbeneficio` — número do benefício (obrigatório)
- `dtinibeneficio` — data de início do benefício (obrigatório)
- `dtpublic` — data de publicação do ato concessório, se retroativo (opcional)
- `tpbeneficio` — tipo de benefício conforme Tabela 25 (obrigatório)
- `tpplanrp` — tipo de plano de previdência: 0-3 (obrigatório)
- `dsc` — descrição do instrumento que originou o benefício (opcional)
- `inddecjud` — indica se o benefício foi concedido por decisão judicial: S/N (opcional)

### Grupos opcionais

- `infopenmorte` — informações de pensão por morte
  - `tppenmorte` — tipo de pensão: 1 ou 2 (obrigatório no grupo)
  - `instpenmorte` — dados do instituidor da pensão (opcional no grupo)
    - `cpfinst` — CPF do instituidor (obrigatório)
    - `dtinst` — data de óbito do instituidor (obrigatório)

- `sucessaobenef` — informações de transferência de benefício de outro órgão
  - `cnpjorgaoant` — CNPJ do órgão anterior (obrigatório no grupo)
  - `nrbeneficioant` — número do benefício no órgão anterior (obrigatório no grupo)
  - `dttransf` — data da transferência (obrigatório no grupo)
  - `observacao` — observações (opcional)

- `mudancacpf` — informações de mudança de CPF do beneficiário
  - `cpfant` — CPF anterior do beneficiário (obrigatório no grupo)
  - `nrbeneficioant` — número do benefício anterior (obrigatório no grupo)
  - `dtaltcpf` — data de alteração do CPF (obrigatório no grupo)
  - `observacao` — observações (opcional)

- `infobentermino` — informações de cessação do benefício (para cadastros iniciais)
  - `dttermbeneficio` — data de cessação (obrigatório no grupo)
  - `mtvtermino` — motivo da cessação conforme Tabela 26 (obrigatório no grupo)

- `infohomolog` — informações de homologação do benefício *(layout v_S_01_03_00)*
  - `sithomolog` — situação da homologação: 0, 1 ou 2 (obrigatório no grupo)
  - `dthomolog` — data de homologação (opcional)

**$configJson** contêm as informações básicas da empresa [Config](Config.md).

## Modo de USO

```php
use NFePHP\eSocial\Event;
use NFePHP\Common\Certificate;
use stdClass;

$config = [
    'tpAmb' => 2,
    'verProc' => 'S_1.3.0',
    'eventoVersion' => 'S.1.3.0',
    'serviceVersion' => '1.5.0',
    'empregador' => [
        'tpInsc' => 1,
        'nrInsc' => '99999999',
        'nmRazao' => 'Razao Social',
    ],
    'transmissor' => [
        'tpInsc' => 1,
        'nrInsc' => '99999999999999'
    ],
];
$configJson = json_encode($config);

$std = new \stdClass();
$std->indretif = 1;
$std->cpfbenef = '12345678901';
$std->cadini = 'S';
$std->nrbeneficio = '12345';
$std->dtinibeneficio = '2021-01-01';
$std->tpbeneficio = '0805';
$std->tpplanrp = 0;

// Homologação do benefício (opcional, exclusivo layout 1.3)
$std->infohomolog = new \stdClass();
$std->infohomolog->sithomolog = 1; // obrigatório no grupo
$std->infohomolog->dthomolog = '2021-06-01'; // opcional

try {
    $certificate = Certificate::readPfx($content, $password);

    $xml = Event::evtCdBenIn(
        $configJson,
        $std,
        $certificate
    )->toXml();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtCdBenIn/v_S_01_03_00">
  <evtCdBenIn Id="...">
    <ideEvento>
      <indRetif>1</indRetif>
      <tpAmb>2</tpAmb>
      <procEmi>1</procEmi>
      <verProc>S_1.3.0</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>1</tpInsc>
      <nrInsc>99999999</nrInsc>
    </ideEmpregador>
    <beneficiario>
      <cpfBenef>12345678901</cpfBenef>
    </beneficiario>
    <infoBenInicio>
      <cadIni>S</cadIni>
      <nrBeneficio>12345</nrBeneficio>
      <dtIniBeneficio>2021-01-01</dtIniBeneficio>
      <dadosBeneficio>
        <tpBeneficio>0805</tpBeneficio>
        <tpPlanRP>0</tpPlanRP>
      </dadosBeneficio>
      <infoHomolog>
        <sitHomolog>1</sitHomolog>
        <dtHomolog>2021-06-01</dtHomolog>
      </infoHomolog>
    </infoBenInicio>
  </evtCdBenIn>
  <Signature/>
</eSocial>
```

## Observações

- O nó `infoHomolog` é **exclusivo do layout v_S_01_03_00** (versão 1.3). Em versões anteriores o campo é ignorado.
- Dentro do grupo `infoHomolog`, o campo `sitHomolog` é obrigatório. O campo `dtHomolog` é opcional.
- Valores válidos para `sitHomolog`: `0`, `1`, `2`.
