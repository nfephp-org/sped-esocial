<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1280 sem alterações da 2.4.1 => 2.4.2
//S-1280 sem alterações da 2.4.2 => 2.5.0

$evento = 'evtInfoComplPer';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtInfoComplPer",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
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
            "type": "string",
            "maxLength": 40
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
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
        },
        "infosubstpatr": {
            "required": false,
            "type": "object",
            "properties": {
                "indsubstpatr": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "percpedcontrib": {
                     "required": true,
                     "type": "number"
                }
            }
        },
        "infosubstpatropport": {
            "required": false,
            "type": "array",
            "minItems": 0,
            "maxItems": 9999,
            "items": {
                "type": "object",
                "properties": {
                    "cnpjopportuario": {
                        "required": true,
                        "type": "string",
                        "pattern": "^[0-9]{14}$"
                    }
                }
            }
        },
        "infoativconcom": {
            "required": false,
            "type": "object",
            "properties": {
                "fatormes": {
                     "required": true,
                     "type": "number"
                },
                "fator13": {
                     "required": true,
                     "type": "number"
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1111111111111';
$std->indapuracao = 1;
$std->perapur = '2017-08';

$std->infosubstpatr = new \stdClass();
$std->infosubstpatr->indsubstpatr = 1;
$std->infosubstpatr->percpedcontrib = 1;

$std->infosubstpatropport[0] = new \stdClass();
$std->infosubstpatropport[0]->cnpjopportuario = '11111111111111';

$std->infoativconcom = new \stdClass();
$std->infoativconcom->fatormes = 1.11;
$std->infoativconcom->fator13 = 0.22;


// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);

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
