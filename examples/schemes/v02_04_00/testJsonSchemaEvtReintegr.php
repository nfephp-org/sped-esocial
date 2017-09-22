<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtReintegr';
$version = '02_04_00';

$jsonSchema = '{
    "title": "evtReintegr",
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
        "cpftrab": {
            "required": true,
            "type": "string",
            "minLength": 11,
            "maxLength": 11
        },
        "nistrab": {
            "required": true,
            "type": "string",
            ""minLength": 11,
            "maxLength": 11
        },
        "matricula": {
            "required": true,
            "type": "string",
            "maxLength": 30
        },
        "tpreint": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 9
        },
        "nrprocjud": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 20
        },
        "nrleianistia": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 13
        },
        "dtefetretorno": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "dtefeito": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "indpagtojuizo": {
            "required": true,
            "type": "string",
            "pattern": "S|N"
        }
    }
}';

$std                = new \stdClass();
$std->sequencial    = 1;
$std->indretif      = 1;
$std->nrrecibo      = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab       = '99999999999';
$std->nistrab       = '11111111111';
$std->matricula     = '123456788-56478ABC';
$std->tpreint       = 1;
$std->nrprocjud     = '192929-0220';
$std->nrleianistia  = null;
$std->dtefetretorno = '2017-08-22';
$std->dtefeito      = '2017-08-13';
$std->indpagtojuizo = 'N';

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
