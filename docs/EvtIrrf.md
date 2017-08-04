# EvtIrrf

## Evento
 *evtIrrf*

## Alias
 *S-5012 - Informações do IRRF consolidadas por contribuinte*


## Detalhamento
Evento consolidado por contribuinte relativo ao Imposto de Renda Retido na Fonte incidente sobre remunerações pagas a seus trabalhadores.


## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:

```php
$std = new \stdClass();
$std->sequencial = 1;
$std->perapur = '2017-08';

$std->infoirrf = new \stdClass();
$std->infoirrf->nrrecarqbase = '1234567-1234567-1234567';
$std->infoirrf->indexistinfo = 1;

$infocrcontrib[0] = new \stdClass();
$infocrcontrib[0]->tpcr = '056109';
$infocrcontrib[0]->vrcr = 14527.00;

$infocrcontrib[1] = new \stdClass();
$infocrcontrib[1]->tpcr = '056101';
$infocrcontrib[1]->vrcr = 1342.45;

$std->infocrcontrib = $infocrcontrib;
```

## Modo de USO

```php
use NFePHP\eSocial\Event;
use NFePHP\Common\Certificate;
use stdClass;

$config = [
    'tpAmb' => 2, //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_3_00', //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.3.0', //versão do layout do evento
    'serviceVersion' => '1.1.0',//versão do webservice
    'empregador' => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999', //numero do documento
        'nmRazao' => 'Razao Social'
    ],    
    'transmissor' => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999' //numero do documento
    ]
];
$configJson = json_encode($config, JSON_PRETTY_PRINT);

try {
    //instância Certificate::class com o 
    //$content = conteudo do certificado PFX
    //$password = senha de acesso ao certificado PFX
    $certificate = Certificate::readPfx($content, $password);

    $std = new \stdClass();
    $evt = Event::evtIrrf($configJson, $std, $certificate);

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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtIrrf/v02_03_00" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <evtIrrf Id="ID1999999999999992017080409055800001">
        <ideEvento>
            <perApur>2017-08</perApur>
        </ideEvento>
        <ideEmpregador>
            <tpInsc>1</tpInsc>
            <nrInsc>99999999999999</nrInsc>
        </ideEmpregador>
        <infoIRRF>
            <nrRecArqBase>1234567-1234567-1234567</nrRecArqBase>
            <indExistInfo>1</indExistInfo>
            <infoCRContrib>
                <tpCR>056109</tpCR>
                <vrCR>14527</vrCR>
            </infoCRContrib>
            <infoCRContrib>
                <tpCR>056101</tpCR>
                <vrCR>1342.45</vrCR>
            </infoCRContrib>
        </infoIRRF>
    </evtIrrf>
    <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
        <SignedInfo>
            <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
            <SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
            <Reference URI="">
                <Transforms>
                    <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
                    <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
                </Transforms>
                <DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
                <DigestValue>VOkVKUQi3eSP66Q8qqxVG1Lcz11utLJm1zeFovibJvk=</DigestValue>
            </Reference>
        </SignedInfo>
        <SignatureValue>Hh</SignatureValue>
        <KeyInfo>
            <X509Data>
                <X509Certificate>MII</X509Certificate>
            </X509Data>
        </KeyInfo>
    </Signature>
</eSocial>
```
