<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtBenPrRP';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtBenPrRP",
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
        "perapur": {
            "required": true,
            "type": "string",
            "maxLength": 7
        },
        "cpfbenef": {
            "required": true,
            "type": "string",
            "maxLength": 11,
            "minLength": 11
        },
        "dmdev": {
            "required": true,
            "type": "array",
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "tpbenef": {
                        "required": true,
                        "type": "integer",
                        "maxLength": 2
                    },
                    "nrbenefic": {
                        "required": true,
                        "type": "string",
                        "maxLength": 20
                    },
                    "idedmdev": {
                        "required": true,
                        "type": "string",
                        "maxLength": 30
                    },
                    "itens": {
                        "required": true,
                        "type": "array",
                        "minItems": 0,
                        "maxItems": 99,
                        "items": {
                            "type": "object",
                            "properties": {
                                "codrubr": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 30
                                },
                                "idetabrubr": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 8
                                },
                                "vrrubr": {
                                    "required": true,
                                    "type": "integer",
                                    "maxLength": 14
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}';

$std              = new \stdClass();
$std->sequencial  = 1;
$std->indretif    = 1;
$std->nrrecibo    = '1111111111111111111111';
$std->indapuracao = 1;
$std->perapur     = '2017-08';
$std->cpfbenef    = '11111111111';

$dmdev[0]            = new \stdClass();
$dmdev[0]->tpbenef   = 1;
$dmdev[0]->nrbenefic = '11111111111111111111';
$dmdev[0]->idedmdev  = '11111111111111111111';

$itens[0]             = new \stdClass();
$itens[0]->codrubr    = '11111111111111111111';
$itens[0]->idetabrubr = '11111111';
$itens[0]->vrrubr     = 1500;

$dmdev[0]->itens = $itens;

$std->dmdev = $dmdev;

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
file_put_contents("../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
