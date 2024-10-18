<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-3500

$evento = 'evtExcProcTrab';
$version = 'S_01_03_00';

$jsonSchema = '{
    "title": "evtExcProcTrab",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": false,
            "type": ["integer","null"],
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
                    "pattern": "^S-[1-2]{1}[0-9]{3}$"
                },
                "nrrecevt": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/recibo"
                }
            }
        },
        "ideproctrab": {
            "required": true,
             "type": "object",
            "properties": {
                "nrproctrab": {
                    "required": true,
                    "type": "string",
                    "minLength": 15,
                    "maxLength": 20
                },
                "cpftrab": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{11}$"
                },
                "perapurpgto": {
                    "required": false,
                    "type": ["string","null"],
                    "$ref": "#/definitions/periodo"
                },
                "ideseqproc": {
                    "required": false,
                    "type": "string",
                    "pattern": "^.{1,3}$"
                }
            }
        }
    }
}';


$std = new \stdClass();
$std->sequencial = 1;

$std->infoexclusao = new \stdClass();
$std->infoexclusao->tpevento = 'S-2500';
$std->infoexclusao->nrrecevt = '1.9.1234567890123456789';

$std->ideproctrab = new \stdClass();
$std->ideproctrab->nrproctrab = '123456789012345';
$std->ideproctrab->cpftrab = '11111111111';
$std->ideproctrab->perapurpgto = '2023-01';
$std->ideproctrab->ideseqproc = "654";

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
file_put_contents("../../../jsonSchemes/v_$version/$evento.schema", $jsonSchema);
