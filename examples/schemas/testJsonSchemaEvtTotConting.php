<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtTotConting';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtTotConting",
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
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
        },
        "nmresp": {
            "required": true,
            "type": "string",
            "minLength": 1,
            "maxLength": 70
        },
        "cpfresp": {
            "required": true,
            "type": "string",
            "maxLength": 11,
            "pattern": "^[0-9]"
        },
        "telefone": {
            "required": true,
            "type": "string",
            "minLength": 10,
            "maxLength": 13,
            "pattern": "^[0-9]"
        },
        "email": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 60,
            "format": "email"
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indapuracao = 1;
$std->perapur = '2017';
$std->nmresp = 'Fulano de Tal';
$std->cpfresp = '12345678901';
$std->telefone = '1123456789';
$std->email = 'test@mail.com';


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
    $jsonSchemaObject
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
