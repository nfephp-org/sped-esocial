# CONFIG

A strign de configuração básica 

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

