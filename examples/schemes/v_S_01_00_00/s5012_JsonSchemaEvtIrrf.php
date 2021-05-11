<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-5012 sem alterações da 2.4.1 => 2.4.2

$evento = 'evtIrrf';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtIrrf",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "perapur": {
            "required": true,
            "type": "string",
            "pattern": "^([0-9]{4}-(0[1-9]{1}|1[0-2]{1}))$"
        },
        "infoirrf": {
            "required": true,
            "type": "object",
            "properties": {
                "nrrecarqbase": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 40,
                    "minLength": 1
                },
                "indexistinfo": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                }
            }
        },
        "infocrcontrib": {
            "required": false,
            "type": "array",
            "minItems": 0,
            "maxItems": 9,
            "items": {
                "type": "object",
                "properties": {
                    "tpcr": {
                        "required": true,
                        "type": "string",
                        "pattern": "^[0-9]{6}$"
                    },
                    "vrcr": {
                        "required": true,
                        "type": "number"
                    }
                }    
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->perapur = '2017-08';

$std->infoirrf = new \stdClass();
$std->infoirrf->nrrecarqbase = '1234567-1234567-1234567';
$std->infoirrf->indexistinfo = 1;

$std->infocrcontrib[0] = new \stdClass();
$std->infocrcontrib[0]->tpcr = '056109';
$std->infocrcontrib[0]->vrcr = 14527.00;

$std->infocrcontrib[1] = new \stdClass();
$std->infocrcontrib[1]->tpcr = '056101';
$std->infocrcontrib[1]->vrcr = 1342.45;


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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
