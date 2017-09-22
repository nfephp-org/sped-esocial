<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtAvPrevio';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtAvPrevio",
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
        "idevinculo": {
            "required": true,
            "type": "object",
            "properties": {
                "cpftrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "nistrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "matricula": {
                    "required": true,
                    "type": "string",
                    "maxLength": 30
                }
            }
        },
        "infoavprevio": {
            "required": true,
            "type": "object",
            "properties": {
                "dtavprv": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "dtprevdeslig": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "tpavprevio": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "(1|2|4|5){1}$"
                },
                "observacao": {
                    "required": false,
                    "type": "string",
                    "maxLength": 255
                }
            }
        },
        "cancavprevio": {
            "required": false,
            "type": "object",
            "properties": {
                "dtcancavprv": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "observacao": {
                    "required": false,
                    "type": "string",
                    "maxLength": 255
                },
                "mtvcancavprevio": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "(1|2|3|9){1}$"
                }
            }
        }
    }
}';

$std             = new \stdClass();
$std->sequencial = 1;
$std->indretif   = 2;

$idevinculo            = new \stdClass();
$idevinculo->cpftrab   = '11111111111';
$idevinculo->nistrab   = '11111111111';
$idevinculo->matricula = '11111111111';

$std->idevinculo = $idevinculo;

$infoavprevio               = new \stdClass();
$infoavprevio->dtavprv      = '2008-09-28';
$infoavprevio->dtprevdeslig = '2014-09-18';
$infoavprevio->tpavprevio   = 2;

$std->infoavprevio = $infoavprevio;

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
