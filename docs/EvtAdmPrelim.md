# EvtAdmPrelim

## Evento
 *evtAdmPrelim*

## Alias
 *S-2190 - Admissão de Trabalhador - Registro Preliminar*


## Detalhamento

**Conceito do evento:** Este evento é opcional, a ser utilizado quando não for 
possível enviar todas as informações do evento “S-2200 – Admissão de Trabalhador” 
até o final do dia imediatamente anterior ao do início da respectiva prestação 
do serviço. Para tanto, deve ser informado: CNPJ/CPF do empregador, CPF do 
trabalhador, data de nascimento e data de admissão do empregado. 
É imprescindível o envio posterior do evento “S-2200 - Admissão de Trabalhador” 
para complementar as informações da admissão e regularizar o registro do 
empregado. 

**Quem está obrigado:** este evento é opcional. Só deve ser utilizado pelo 
empregador que admitir um empregado em situação em que não disponha de todas as 
informações necessárias ao envio do evento “S-2200 – Admissão do Trabalhador”.

**Prazo de envio:** deve ser enviado até o final do dia imediatamente anterior 
ao do início da prestação do serviço pelo trabalhador admitido. No caso de 
admissão de empregado na data do início da obrigatoriedade do eSocial, o prazo 
de envio da informação de admissão é o próprio dia da admissão.

**Pré-requisitos:** envio do evento S-1000 - Informações do Empregador/Contribuinte/Órgão Público/Órgão Público.

## Parâmetros
**$std** nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.

- sequencial, numero sequencial do evento;
- cpfTrab, CPF do trabalhador;
- dtNascto, data de nascimento do trabalhador em um \DateTime;
- dtAdm, data de admissão do trabalhador em um \DateTime;

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
    $std->sequencial = 1;
    $std->cpfTrab = '00232133417';
    $std->dtNascto = new \DateTime('1961-02-12');
    $std->dtAdm = new \DateTime('2017-04-12');

    $xml = Event::evtAdmPrelim($configJson, $std, $certificate)->toXML();

} catch (\Exception $e) {
    //aqui você trata as possiveis exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados

## Exemplo do XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAdmPrelim/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <evtAdmPrelim Id="ID1999999999999992017042711185900001">
        <ideEvento>
            <tpAmb>3</tpAmb>
            <procEmi>1</procEmi>
            <verProc>2_2_01</verProc>
        </ideEvento>
        <ideEmpregador>
            <tpInsc>1</tpInsc>
            <nrInsc>99999999999999</nrInsc>
        </ideEmpregador>
        <infoRegPrelim>
            <cpfTrab>00232133417</cpfTrab>
            <dtNascto>1961-02-12</dtNascto>
            <dtAdm>2017-04-12</dtAdm>
        </infoRegPrelim>
    </evtAdmPrelim>
    <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
        <SignedInfo>
            <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
            <SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1"/>
            <Reference URI="#ID1999999999999992017042711185900001">
                <Transforms>
                    <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
                    <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
                </Transforms>
                <DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"/>
                <DigestValue>nlpSXAtP7wKcoe6UmkauxboU9ts=</DigestValue>
            </Reference>
        </SignedInfo>
        <SignatureValue>qM2eK1t3KV8bDk6OGdS3BpCBnRkL/lBnsaaNP3mbMM2EOaDhdKJsk1ISVlbOrxa1DonAdtMvUXn8O1L2Mn9ufEmzP0NAkfKl7NhGh9maZ/uLwJs67b3gnHBhimwzKLwrMyYtOeO14T+JRlvUM6//tmQA9w25UkEJ7SJjw/qHvCs=</SignatureValue>
        <KeyInfo>
            <X509Data>
                <X509Certificate>MIIEqzCCA5OgAwIBAgIDMTg4MA0GCSqGSIb3DQEBBQUAMIGSMQswCQYDVQQGEwJCUjELMAkGA1UECBMCUlMxFTATBgNVBAcTDFBvcnRvIEFsZWdyZTEdMBsGA1UEChMUVGVzdGUgUHJvamV0byBORmUgUlMxHTAbBgNVBAsTFFRlc3RlIFByb2pldG8gTkZlIFJTMSEwHwYDVQQDExhORmUgLSBBQyBJbnRlcm1lZGlhcmlhIDEwHhcNMDkwNTIyMTcwNzAzWhcNMTAxMDAyMTcwNzAzWjCBnjELMAkGA1UECBMCUlMxHTAbBgNVBAsTFFRlc3RlIFByb2pldG8gTkZlIFJTMR0wGwYDVQQKExRUZXN0ZSBQcm9qZXRvIE5GZSBSUzEVMBMGA1UEBxMMUE9SVE8gQUxFR1JFMQswCQYDVQQGEwJCUjEtMCsGA1UEAxMkTkZlIC0gQXNzb2NpYWNhbyBORi1lOjk5OTk5MDkwOTEwMjcwMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCx1O/e1Q+xh+wCoxa4pr/5aEFt2dEX9iBJyYu/2a78emtorZKbWeyK435SRTbHxHSjqe1sWtIhXBaFa2dHiukT1WJyoAcXwB1GtxjT2VVESQGtRiujMa+opus6dufJJl7RslAjqN/ZPxcBXaezt0nHvnUB/uB1K8WT9G7ES0V17wIDAQABo4IBfjCCAXowIgYDVR0jAQEABBgwFoAUPT5TqhNWAm+ZpcVsvB7malDBjEQwDwYDVR0TAQH/BAUwAwEBADAPBgNVHQ8BAf8EBQMDAOAAMAwGA1UdIAEBAAQCMAAwgawGA1UdEQEBAASBoTCBnqA4BgVgTAEDBKAvBC0yMjA4MTk3Nzk5OTk5OTk5OTk5MDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDCgEgYFYEwBAwKgCQQHREZULU5GZaAZBgVgTAEDA6AQBA45OTk5OTA5MDkxMDI3MKAXBgVgTAEDB6AOBAwwMDAwMDAwMDAwMDCBGmRmdC1uZmVAcHJvY2VyZ3MucnMuZ292LmJyMCAGA1UdJQEB/wQWMBQGCCsGAQUFBwMCBggrBgEFBQcDBDBTBgNVHR8BAQAESTBHMEWgQ6BBhj9odHRwOi8vbmZlY2VydGlmaWNhZG8uc2VmYXoucnMuZ292LmJyL0xDUi9BQ0ludGVybWVkaWFyaWEzOC5jcmwwDQYJKoZIhvcNAQEFBQADggEBAJFytXuiS02eJO0iMQr/Hi+Ox7/vYiPewiDL7s5EwO8A9jKx9G2Baz0KEjcdaeZk9a2NzDEgX9zboPxhw0RkWahVCP2xvRFWswDIa2WRUT/LHTEuTeKCJ0iF/um/kYM8PmWxPsDWzvsCCRp146lc0lz9LGm5ruPVYPZ/7DAoimUk3bdCMW/rzkVYg7iitxHrhklxH7YWQHUwbcqPt7Jv0RJxclc1MhQlV2eM2MO1iIlk8Eti86dRrJVoicR1bwc6/YDqDp4PFONTi1ddewRu6elGS74AzCcNYRSVTINYiZLpBZO0uivrnTEnsFguVnNtWb9MAHGt3tkR0gAVs6S0fm8=</X509Certificate>
            </X509Data>
        </KeyInfo>
    </Signature>
</eSocial>

```
