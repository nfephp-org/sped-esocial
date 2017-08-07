<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento = 'evtExclusao';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtExclusao",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "infoExclusao": {
            "required": true,
            "type": "object",
            "properties": {
                "tpEvento": {
                    "required": true,
                    "type": "string",
                    "maxLength": 6,
                    "minLength": 5
                },
                "nrRecEvt": {
                    "required": true,
                    "type": "string",
                    "maxLength": 40,
                    "minLength": 1
                }
            }
        },
        "ideFolhaPagto": {
            "required": true,
            "type": "object",
            "properties": {
                "indApuracao": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "perApur": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                }
            }
        },
        "ideTrabalhador": {
            "required": true,
            "type": "object",
            "properties": {
                "cpfTrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "nisTrab": {
                    "required": false,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                }
            }
        }
    }
}';


$jsonToValidateObject = new \stdClass();
$jsonToValidateObject->sequencial = 1;

$infoExclusao = new \stdClass();
$infoExclusao->tpEvento = 'S-2190';
$infoExclusao->nrRecEvt = '1234567-1234567-1234567';

$jsonToValidateObject->infoExclusao = $infoExclusao;

$ideFolhaPagto = new \stdClass();
$ideFolhaPagto->indApuracao = 1;
$ideFolhaPagto->perApur = '2017-08';

$jsonToValidateObject->ideFolhaPagto = $ideFolhaPagto;

$ideTrabalhador = new \stdClass();
$ideTrabalhador->cpfTrab = '11111111111';
$ideTrabalhador->nisTrab = '11111111111';

$jsonToValidateObject->ideTrabalhador = $ideTrabalhador;


// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);

// The SchemaStorage can resolve references, loading additional schemas from file as needed, etc.
$schemaStorage = new SchemaStorage();

// This does two things:
// 1) Mutates $jsonSchemaObject to normalize the references (to file://mySchema#/definitions/integerData, etc)
// 2) Tells $schemaStorage that references to file://mySchema... should be resolved by looking in $jsonSchemaObject
$schemaStorage->addSchema('file://mySchema', $jsonSchemaObject);

// Provide $schemaStorage to the Validator so that references can be resolved during validation
$jsonValidator = new Validator(new Factory($schemaStorage));

// Do validation (use isValid() and getErrors() to check the result)
$jsonValidator->validate(
    $jsonToValidateObject,
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
file_put_contents("../../jsonSchemes/v$version/$evento.schema", $jsonSchema);