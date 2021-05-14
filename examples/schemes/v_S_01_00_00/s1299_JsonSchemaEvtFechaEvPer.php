<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1299

$evento = 'evtFechaEvPer';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtFechaEvPer",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "indapuracao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "perapur": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/periodo"
        },
        "indguia": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 1
        },
        "infofech": {
            "type": "object",
            "properties": {
                "evtremun": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "evtcomprod": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "evtcontratavnp": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "evtinfocomplper": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "indexcapur1250": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(S)$"
                }
            }
        }    
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indapuracao = 1; //obrigatorio
//Indicativo de período de apuração. 1 - Mensal 2 - Anual (13° salário)

$std->perapur = '2017-08';  //obrigatorio
//Informar o mês/ano (formato AAAA-MM) de referência das informações, se indApuracao for igual a [1], 
//ou apenas o ano (formato AAAA), se indApuracao for igual a [2].

$std->indguia = 1; //opcional
//Indicativo do tipo de guia. 1 - Documento de Arrecadação do eSocial - DAE

//informações para o fechamento
$std->infofech = new \stdClass();
$std->infofech->evtremun = 'N';  //obrigatorio
//Possui informações relativas a remuneração de trabalhadores ou provento/pensão de 
//beneficiários no período de apuração?
//Se for igual a [S], deve existir evento de remuneração (S-1200, S-1202, S-1207, S-2299 ou S-2399)
//para o período de apuração. Caso contrário, não deve existir evento de remuneração.

$std->infofech->evtcomprod = 'N';  //obrigatorio
//Possui informações de comercialização de produção?
//Se for igual a [S], deve existir o evento S-1260 para o período de apuração. Caso contrário, não deve existir o evento.

$std->infofech->evtcontratavnp = 'N';  //obrigatorio
//Contratou, por intermédio de sindicato, serviços de trabalhadores avulsos não portuários?
//Se for igual a [S], deve existir o evento S-1270 para o período de apuração. Caso contrário, não deve existir o evento.

$std->infofech->evtinfocomplper = 'N'; //obrigatorio
//Possui informações de desoneração de folha de
//pagamento ou, sendo empresa enquadrada no Simples,
//possui informações sobre a receita obtida em atividades
//cuja contribuição previdenciária incidente sobre a folha de
//pagamento é concomitantemente substituída e não
//substituída?

$std->infofech->indexcapur1250 = 'S'; //opcional
//Indicativo de exclusão de apuração das aquisições de produção rural (eventos S-1250) do período de apuração.
//Não informar se perApur >= [2021-05] ou se indApuracao = [2]. Preenchimento obrigatório caso o
//campo tenha sido informado em fechamento anterior do mesmo período de apuração


// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);
if (empty($jsonSchemaObject)) {
    echo "<h2>Erro de digitação no schema ! Revise</h2>";
    echo "<pre>";
    print_r($jsonSchema);
    echo "</pre>";
    die();
}

// The SchemaStorage can resolve references, loading additional schemas from file as needed, etc.
$schemaStorage = new SchemaStorage();

// This does two things:
// 1) Mutates $jsonSchemaObject to normalize the references (to file://mySchema#/definitions/integerData, etc)
// 2) Tells $schemaStorage that references to file://mySchema... should be resolved by looking in $jsonSchemaObject
$definitions = realpath(__DIR__."/../../../jsonSchemes/definitions.schema");
$schemaStorage->addSchema("file:{$definitions}", $jsonSchemaObject);

// Provide $schemaStorage to the Validator so that references can be resolved during validation
$jsonValidator = new Validator(new Factory($schemaStorage));

// Do validation (use isValid() and getErrors() to check the result)
$jsonValidator->validate(
    $std,
    $jsonSchemaObject,
    Constraint::CHECK_MODE_COERCE_TYPES  //tenta converter o dado no tipo indicado no schema
);

if ($jsonValidator->isValid()) {
    echo "The supplied JSON validates against the schema.<br/>";
} else {
    echo "JSON does not validate. Violations:<br/>";
    foreach ($jsonValidator->getErrors() as $error) {
        echo sprintf("[%s] %s<br/>", $error['property'], $error['message']);
    }
    die;
}
//salva se sucesso
file_put_contents("../../../jsonSchemes/v_$version/$evento.schema", $jsonSchema);
