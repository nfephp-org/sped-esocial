<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1270 sem alterações da 2.4.1 => 2.4.2
//S-1270 sem alterações da 2.4.2 => 2.5.0

$evento = 'evtContratAvNP';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtContratAvNP",
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
            "maximum": 1
        },
        "remunavnp": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 999,
            "items": {
                "type": "object",
                "properties": {
                    "tpinsc": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 2
                    },
                    "tpinsc": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 4
                    },
                    "nrinsc": {
                        "required": true,
                        "type": "string",
                        "pattern": "^[0-9]{8,14}$"
                    },
                    "codlotacao": {
                        "required": true,
                        "type": "string",
                        "maxLength": 30
                    },
                    "vrbccp00": {
                        "required": true,
                        "type": "number"
                    },
                    "vrbccp15": {
                        "required": true,
                        "type": "number"
                    },
                    "vrbccp20": {
                        "required": true,
                        "type": "number"
                    },
                    "vrbccp25": {
                        "required": true,
                        "type": "number"
                    },
                    "vrbccp13": {
                        "required": true,
                        "type": "number"
                    },
                    "vrbcfgts": {
                        "required": true,
                        "type": "number"
                    },
                    "vrdesccp": {
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
$std->indretif = 1;
$std->nrrecibo = '1231513';
$std->indapuracao = 1;
$std->perapur = '2017-08';

$std->remunavnp[0] = new \stdClass();
$std->remunavnp[0]->tpinsc = 1;
$std->remunavnp[0]->nrinsc = '11111111111111';
$std->remunavnp[0]->codlotacao = '11111111111111';
$std->remunavnp[0]->vrbccp00 = 1500.11;
$std->remunavnp[0]->vrbccp15 = 1500.22;
$std->remunavnp[0]->vrbccp20 = 1500.33;
$std->remunavnp[0]->vrbccp25 = 1500.44;
$std->remunavnp[0]->vrbccp13 = 1500.55;
$std->remunavnp[0]->vrbcfgts = 1500.66;
$std->remunavnp[0]->vrdesccp = 1500.77;

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
