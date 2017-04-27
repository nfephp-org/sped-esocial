# EvtCS

## Evento
 *evtCS*

## Alias
 *S-5011 - Informações das contribuições sociais consolidadas por contribuinte*


## Detalhamento

Os eventos totalizadores (S-5001/S-5002/S-5011/S-5012) são eventos de retorno ao contribuinte. Para maiores esclarecimentos sobre estes eventos, verificar as orientações específicas para o evento S-4000 - Solicitação de Totalização de Eventos, Bases e Contribuições, no capítulo III.


## Parâmetros



## Modo de USO

```php
use NFePHP\eSocial\Event;

try {
    $std = new \stdClass();
    $evt = Event::evtCS($configJson, $std);
} catch (\Exception $e) {
    //aqui você trata as exceptions
}
```

A classe pode retornar: string XML, string JSON ou array com os dados

## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtCS/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtCS/v02_02_01 ../schemes/evtCS.xsd ">
  <evtCS Id="idvalue0">
    <ideEvento>
      <indApuracao>0</indApuracao>
      <perApur>perApur</perApur>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <infoCS>
      <indExistInfo>0</indExistInfo>
      <infoContrib>
        <classTrib>classTrib</classTrib>
      </infoContrib>
      <ideEstab>
        <tpInsc>0</tpInsc>
        <nrInsc>nrInsc</nrInsc>
      </ideEstab>
    </infoCS>
  </evtCS>
  <Signature/>
</eSocial>

```
