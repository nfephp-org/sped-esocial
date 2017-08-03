# CONFIG

A string de configuração básica, essa variável irá passar as infrmações básicas as classes responsáveis por construir cada evento do eSocial. 

```php
$config = [
    'tpAmb' => 2, //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_2_02', //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.2.2', //versão do layout do evento
    'serviceVersion' => '1.1.0',//versão do webservice
    'empregador' => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999', //numero do documento do empregador
        'nmRazao' => 'Razao Social'
    ],    
    'transmissor' => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999' //numero do documento do transmissor
    ]
];
$configJson = json_encode($arrconfig);
```
| Propriedade | Tipo | Ocorrência | Tamanho | Dec | Descrição |
| :---  | :---: | :---: | :---: | :---: | :--- |
| tpAmb | N | 1-1 | 1 | - | Identificação do ambiente: <p>1 - Produção;</p><p>2 - Produção restrita - dados reais;</p><p>3 - Produção restrita - dados fictícios.</p><p>6 - Homologação</p><p>7 - Validação</p><p>8 - Testes</p><p>9 - Desenvolvimento</p>|
| verProc | C | 1-1 | 20 | - | Versão do processo de emissão do evento.  Informar a versão do aplicativo emissor do evento. |
| eventoVersion | C | 1-1 | 10 | Informar a versão do layout do evento |
| serviceVersion | C | 1-1 | 10 | Informar a versão do layout do metodo de comunicação | 
| empregador | A | 1-1 | -- | Dados do empregador |
| tpInsc | N | 1-1 | 1 | - | Preencher com o código correspondente ao tipo de inscrição, conforme tabela 5. Validação: Deve ser igual a [1] (CNPJ) ou [2] (CPF) |
| nrInsc | C | 1-1 | 15 | - | Informar o número de inscrição do contribuinte de acordo com o tipo de inscrição indicado no campo {tpInsc}. Se for um CNPJ deve ser informada apenas a Raiz/Base de oito posições, exceto se natureza jurídica de administração pública direta federal ([101-5], [104-0], [107-4], [116-3], situação em que o campo deve ser preenchido com o CNPJ completo (14 posições). Validação: Se {tpInsc} for igual a [1], deve ser um número de CNPJ válido. Se {tpInsc} for igual a [2], deve ser um CPF válido. |
| nmRazao | C | 1-1 | 100 | Infrormar a razão social do empregador |
| transmissor | A | 1-1 | -- | Dados do transmissor do evento |
| tpInsc | N | 1-1 | 1 | - | Preencher com o código correspondente ao tipo de inscrição, conforme tabela 5. Validação: Deve ser igual a [1] (CNPJ) ou [2] (CPF) |
| nrInsc | C | 1-1 | 15 | - | Informar o número de inscrição do contribuinte de acordo com o tipo de inscrição indicado no campo {tpInsc}. Se for um CNPJ deve ser informada apenas a Raiz/Base de oito posições, exceto se natureza jurídica de administração pública direta federal ([101-5], [104-0], [107-4], [116-3], situação em que o campo deve ser preenchido com o CNPJ completo (14 posições). Validação: Se {tpInsc} for igual a [1], deve ser um número de CNPJ válido. Se {tpInsc} for igual a [2], deve ser um CPF válido. |



