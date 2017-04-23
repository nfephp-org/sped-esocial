# CONFIG

A string de configuração básica, essa variável irá passar as infrmações básicas as classes responsáveis por construir cada evento do eSocial. 

```php
$arrconfig = [
    'tpInsc' => 1,  //1-CNPJ, 2-CPF da Empresa
    'nrInsc' => '99999999999999', //numero do documento do CFP ou do CNPJ da Empresa
    'company' => 'Razao Social',
    'tpAmb' => 3, //tipo de ambiente 1 - Produção;2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_2_01', //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'layout' => '2.2.1' //versão do layout a ser usado (atualmente 2.2.1)
];
$configJson = json_encode($arrconfig);
```
| Propriedade | Tipo | Ocorrência | Tamanho | Descrição |
| ----------- | ---- | ---------- | ------- | --------- |
| tpAmb | N | 1-1 | 1 | Identificação do ambiente: <p>1 - Produção;</p><p>2 - Produção restrita - dados reais;</p><p>3 - Produção restrita - dados fictícios. Valores Válidos: 1, 2, 3. |
| procEmi | N | 1-1 | 1 | Processo de emissão do evento: <p>1- Aplicativo do empregador;</p><p>2 - Aplicativo governamental.</p> Valores Válidos: 1, 2. |
| verProc | C | 1-1 | 20 | Versão do processo de emissão do evento.  Informar a versão do aplicativo emissor do evento. |




