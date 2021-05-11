<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2221 2.5.0

$evento = 'evtToxic';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtToxic",
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
            "type": ["string","null"],
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
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 11,
                    "minLength": 11
                },
                "matricula": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 30
                },
                "codcateg": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{3}$"
                }
            }
        },
        "toxicologico": {
            "required": true,
            "type": "object",
            "properties": {
                "dtexame": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "cnpjlab": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{14}$"
                },
                "codseqexame": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^([0-9]{2}|[a-zA-Z]{2})([0-9]{9})$"
                },
                "nmmed": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 70
                },
                "nrcrm": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 8
                },
                "ufcrm": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(AC|AL|AM|AN|AP|BA|CE|DF|ES|GO|MA|MG|MS|MT|PA|PB|PE|PI|PR|RJ|RN|RO|RR|RS|SC|SE|SP|TO)$"
                },
                "indrecusa": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1231513';

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';
$std->idevinculo->codcateg = '101';

$std->toxicologico = new \stdClass();
$std->toxicologico->dtexame = "2019-03-12";
$std->toxicologico->cnpjlab = "12345678901234";
$std->toxicologico->codseqexame = "AT123456789";
$std->toxicologico->nmmed = "Fulano de Tal";
$std->toxicologico->nrcrm = "12345678";
$std->toxicologico->ufcrm = "SP";
$std->toxicologico->indrecusa = "N";

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
