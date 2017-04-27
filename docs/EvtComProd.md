# EvtComProd

## Evento
 *evtComProd*

## Alias
 *S-1260 - Comercialização da Produção Rural Pessoa Física*


## Detalhamento

**Conceito do evento:** são as informações relativas à comercialização da produção 
rural prestadas pelo produtor rural pessoa física e pelo segurado especial.

**Quem está obrigado:** o produtor rural pessoa física e o segurado especial, 
devem informar o valor da receita bruta da comercialização da produção rural própria 
e dos subprodutos e resíduos, se houver, quando comercializar com:
- adquirente domiciliado no exterior (exportação);
- consumidor pessoa física, no varejo;
- outro produtor rural pessoa física;
- outro segurado especial;
- pessoa jurídica, na qualidade de adquirente, consumidora ou consignatária;
- pessoa física não produtor rural, quando adquire produção para venda, no varejo ou a consumidor pessoa física;
- destinatário incerto ou quando não houver comprovação formal do destino da produção.

**Prazo de envio:** este evento deve ser enviado até o dia 07 do mês seguinte ou 
antes do envio do evento S-1299 – Fechamento dos Eventos Periódicos, o que ocorrer 
primeiro. Antecipa-se o envio deste evento para o dia útil imediatamente anterior 
quando não houver expediente bancário. 

**Pré-requisitos:** envio do evento S-1000 - Informações do Empregador/Contribuinte/Órgão Público.

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

    $evt = Event::evtComProd($configJson, $std, $certificate);
} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados

## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtComProd/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtComProd/v02_02_01 ../schemes/evtComProd.xsd ">
  <evtComProd Id="idvalue0">
    <ideEvento>
      <indRetif>0</indRetif>
      <indApuracao>0</indApuracao>
      <perApur>perApur</perApur>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoComProd>
      <ideEstabel>
        <nrInscEstabRural>nrInscEstabRural</nrInscEstabRural>
        <tpComerc>
          <indComerc>0</indComerc>
          <vrTotCom>0.0</vrTotCom>
        </tpComerc>
      </ideEstabel>
    </infoComProd>
  </evtComProd>
  <Signature/>
</eSocial>

```
