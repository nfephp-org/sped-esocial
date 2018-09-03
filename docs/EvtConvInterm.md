# EvtConvInterm

## Evento
 *evtConvInterm*

## Alias
 *S-2260 - Convocação para Trabalho Intermitente*

## Detalhamento

## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:

## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
    $evt = Event::evtConvInterm($configJson, $std);
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
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtConvInterm/v02_04_02"
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtConvInterm/v02_04_02/schemes/evtConvInterm.xsd">
    <evtConvInterm Id="1">
        <ideEvento>
            <indRetif>...</indRetif>
            <nrRecibo>...</nrRecibo>
            <tpAmb>...</tpAmb>
            <procEmi>...</procEmi>
            <verProc>...</verProc>
        </ideEvento>
        <ideEmpregador>
            <tpInsc>...</tpInsc>
            <nrInsc>...</nrInsc>
        </ideEmpregador>
        <ideVinculo>
            <cpfTrab>...</cpfTrab>
            <nisTrab>...</nisTrab>
            <matricula>...</matricula>
        </ideVinculo>
        <infoConvInterm>
            <codConv>...</codConv>
            <dtInicio>...</dtInicio>
            <dtFim>...</dtFim>
            <dtPrevPgto>...</dtPrevPgto>
            <jornada>
                <codHorContrat>...</codHorContrat>
                <dscJornada>...</dscJornada>
            </jornada>
            <localTrab>
                <indLocal>...</indLocal>
                <localTrabInterm>
                    <tpLograd>...</tpLograd>
                    <dscLograd>...</dscLograd>
                    <nrLograd>...</nrLograd>
                    <complem>...</complem>
                    <bairro>...</bairro>
                    <cep>...</cep>
                    <codMunic>...</codMunic>
                    <uf>...</uf>
                </localTrabInterm>
            </localTrab>
        </infoConvInterm>
    </evtConvInterm>
    <Signature/>
</eSocial>

```
