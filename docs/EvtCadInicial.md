# EvtCadInicial

## Evento
 *evtCadInicial*

## Alias
 **


## Detalhamento



## Parâmetros
O stdClass deve ser carregado com os seguintes parâmetros:



## Modo de USO

```php
use NFePHP\eSocial\Event;

$std = new \stdClass();
$evt = Event::evtCadInicial($configJson, $std);
```

Onde:
- $std nesta variavel são inseridos os dados referentes ao evento, usando a mesma nomenclatura estabelecida no XSD ou descrita no manual.
- $configJson contêm as informações básicas da empresa [Config](Config.md).

A classe pode retornar: string XML, string JSON ou array com os dados


## Exemplo de XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtCadInicial/v02_02_01" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.esocial.gov.br/schema/evt/evtCadInicial/v02_02_01 ../schemes/evtCadInicial.xsd ">
  <evtCadInicial Id="idvalue0">
    <ideEvento>
      <indRetif>0</indRetif>
      <tpAmb>0</tpAmb>
      <procEmi>0</procEmi>
      <verProc>verProc</verProc>
    </ideEvento>
    <ideEmpregador>
      <tpInsc>0</tpInsc>
      <nrInsc>nrInsc</nrInsc>
    </ideEmpregador>
    <trabalhador>
      <cpfTrab>cpfTrab</cpfTrab>
      <nisTrab>nisTrab</nisTrab>
      <nmTrab>nmTrab</nmTrab>
      <sexo>sexo</sexo>
      <racaCor>0</racaCor>
      <grauInstr>grauInstr</grauInstr>
      <nascimento>
        <dtNascto>2001-01-01</dtNascto>
        <paisNascto>paisNascto</paisNascto>
        <paisNac>paisNac</paisNac>
      </nascimento>
      <endereco>
        <brasil>
          <tpLograd>tpLograd</tpLograd>
          <dscLograd>dscLograd</dscLograd>
          <nrLograd>nrLograd</nrLograd>
          <cep>cep</cep>
          <codMunic>0</codMunic>
          <uf>AC</uf>
        </brasil>
      </endereco>
    </trabalhador>
    <vinculo>
      <matricula>matricula</matricula>
      <tpRegTrab>0</tpRegTrab>
      <tpRegPrev>0</tpRegPrev>
      <infoRegimeTrab>
        <infoCeletista>
          <dtAdm>2001-01-01</dtAdm>
          <tpAdmissao>0</tpAdmissao>
          <indAdmissao>0</indAdmissao>
          <tpRegJor>0</tpRegJor>
          <natAtividade>0</natAtividade>
          <cnpjSindCategProf>cnpjSindCategProf</cnpjSindCategProf>
          <FGTS>
            <opcFGTS>0</opcFGTS>
          </FGTS>
        </infoCeletista>
      </infoRegimeTrab>
      <infoContrato>
        <codCateg>0</codCateg>
        <remuneracao>
          <vrSalFx>0.0</vrSalFx>
          <undSalFixo>0</undSalFixo>
        </remuneracao>
        <duracao>
          <tpContr>0</tpContr>
        </duracao>
        <localTrabalho/>
      </infoContrato>
    </vinculo>
  </evtCadInicial>
  <Signature/>
</eSocial>

```
