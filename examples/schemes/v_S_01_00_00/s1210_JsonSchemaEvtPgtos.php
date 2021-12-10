<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1210
//Grupo {detPgtoFer} – inserido campo {matricula} como chave.
//Campo {cpfBenef} – alterada validação da alínea b).
//Grupo {detPgtoFl/infoPgtoParc} – alterada descrição no registro do evento.
//Campo {detPgtoFl/infoPgtoParc/matricula} – criado.
//Campo {detPgtoFl/infoPgtoParc/codRubr} – alterada validação.
//Grupo {detPgtoBenPr/infoPgtoParc} – alterada descrição no registro do evento.
//Campo {detPgtoBenPr/infoPgtoParc/codRubr} – alterada validação.
//Campo {detPgtoFer/matricula} – criado.
//Campo {detRubrFer/codRubr} – alterada validação.
//S-1210 sem alterações da 2.4.2 => 2.5.0

$evento  = 'evtPgtos';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtPgtos",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 99999
        },
        "indretif": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "nrrecibo": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/recibo"
        },
        "perapur": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/periodo"
        },
        "indguia": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 1
        },
        "cpfbenef": {
            "required": true,
            "type": "string",
            "maxLength": 11,
            "minLength": 11
        },
        "infopgto": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 999,
            "items": {
                "type": "object",
                "properties": {
                    "dtpgto": {
                        "required": true,
                        "type": "string",
                        "$ref": "#/definitions/data"
                    },
                    "tppgto": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 5
                    },
                    "perref": {
                        "required": true,
                        "type": "string",
                        "$ref": "#/definitions/periodo"
                    },
                    "idedmdev": {
                        "required": true,
                        "type": "string",
                        "minLength": 1,
                        "maxLength": 30
                    },
                    "vrliq": {
                        "required": true,
                        "type": "number"
                    }
                }
            }    
        }
    }    
}';

$std = new \stdClass();
//$std->sequencial = 1; //Opcional
$std->indretif = 1; //Obrigatório
$std->nrrecibo = null; //Opcional
$std->perapur = '2017-12';  //Obrigatório
$std->indguia = 1; //Opcional
$std->cpfbenef = '12345678901';  //Obrigatório

//Informações dos pagamentos efetuados.
$std->infopgto[0] = new \stdClass(); //Obrigatório
$std->infopgto[0]->dtpgto = '2018-01-15';  //Obrigatório
$std->infopgto[0]->tppgto = 4;  //Obrigatório
$std->infopgto[0]->perref = '2020';  //Obrigatório
$std->infopgto[0]->idedmdev = 'sjksjskjslsjksjsj';  //Obrigatório
$std->infopgto[0]->vrliq = 1000.33;  //Obrigatório


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
    $jsonSchemaObject
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
