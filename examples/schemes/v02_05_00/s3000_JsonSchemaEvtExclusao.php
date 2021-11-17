<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-3000 sem alterações da 2.4.1 => 2.4.2

$evento = 'evtExclusao';
$version = '02_05_00';

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
        "infoexclusao": {
            "required": true,
            "type": "object",
            "properties": {
                "tpevento": {
                    "required": true,
                    "type": "string",
                    "maxLength": 6,
                    "minLength": 5
                },
                "nrrecevt": {
                    "required": true,
                    "type": "string",
                    "maxLength": 40,
                    "minLength": 1
                }
            }
        },
        "idefolhapagto": {
            "required": false,
            "type": "object",
            "properties": {
                "indapuracao": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "perapur": {
                    "required": true,
                    "type": "string"
                }
            }
        },
        "idetrabalhador": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cpftrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "nistrab": {
                    "required": false,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;

$std->infoexclusao = new \stdClass();
$std->infoexclusao->tpevento = 'S-2190';
$std->infoexclusao->nrrecevt = '1234567-1234567-1234567';

$std->idefolhapagto = new \stdClass();
$std->idefolhapagto->indapuracao = 1;
$std->idefolhapagto->perapur = '2017-08';

$std->idetrabalhador = new \stdClass();
$std->idetrabalhador->cpftrab = '11111111111';
$std->idetrabalhador->nistrab = '11111111111';


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
        $std, $jsonSchemaObject, Constraint::CHECK_MODE_COERCE_TYPES  //tenta converter o dado no tipo indicado no schema
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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
