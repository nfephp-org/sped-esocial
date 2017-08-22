<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtFechaEvPer';
$version = '02_03_00';

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
            "type": "string"
        },
        "iderespinf": {
            "required": true,
            "type": "object",
            "properties": {
                "nmresp": {
                    "required": true,
                    "type": "string",
                    "maxLength": 70
                },
                "cpfresp": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "telefone": {
                    "required": true,
                    "type": "string",
                    "maxLength": 13,
                    "minLength": 10
                },
                "email": {
                    "required": false,
                    "type": "string",
                    "maxLength": 60
                }
            }
        },
        "infofech": {
            "required": true,
            "type": "object",
            "properties": {
                "evtremun": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "evtpgtos": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "evtaqprod": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "evtcomprod": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "evtcontratavnp": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "evtinfocomplper": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "compsemmovto": {
                    "required": false,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                }
            }
        }
    }
}';

$jsonToValidateObject              = new \stdClass();
$jsonToValidateObject->sequencial  = 1;
$jsonToValidateObject->indapuracao = 1;
$jsonToValidateObject->perapur     = '2017-08';

$iderespinf           = new \stdClass();
$iderespinf->nmresp   = 'JOAO';
$iderespinf->cpfresp  = '11111111111';
$iderespinf->telefone = '1122223333';

$jsonToValidateObject->iderespinf = $iderespinf;

$infofech                  = new \stdClass();
$infofech->evtremun        = 'N';
$infofech->evtpgtos        = 'N';
$infofech->evtaqprod       = 'N';
$infofech->evtcomprod      = 'N';
$infofech->evtcontratavnp  = 'N';
$infofech->evtinfocomplper = 'N';

$jsonToValidateObject->infofech = $infofech;

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
