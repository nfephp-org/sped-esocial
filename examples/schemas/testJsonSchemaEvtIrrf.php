<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Validator;
use JsonSchema\SchemaStorage;
use JsonSchema\Constraints\Factory;
use JsonSchema\Constraints\Constraint;

$evento = 'evtIrrf';
$version = '02_03_00';

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
            "maxLength": 7,
            "minLength": 7
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
                        "maxLength": 6,
                        "minLength": 6,
                        "pattern": "^[0-9]"
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


$jsonToValidateObject = new \stdClass();
$jsonToValidateObject->sequencial = 1;
$jsonToValidateObject->perapur = '2017-08';

$jsonToValidateObject->infoirrf = new \stdClass();
$jsonToValidateObject->infoirrf->nrrecarqbase = '1234567-1234567-1234567';
$jsonToValidateObject->infoirrf->indexistinfo = 1;

$infocrcontrib[0] = new \stdClass();
$infocrcontrib[0]->tpcr = '056109';
$infocrcontrib[0]->vrcr = 14527.00;

$infocrcontrib[1] = new \stdClass();
$infocrcontrib[1]->tpcr = '056101';
$infocrcontrib[1]->vrcr = 1342.45;

$jsonToValidateObject->infocrcontrib = $infocrcontrib;



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
