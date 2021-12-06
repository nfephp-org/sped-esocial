<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//versão S_1.00

$evento = 'evtAdmPrelim';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtAdmPrelim",
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
            "pattern": "^[1]{1}.[0-9]{1}.[0-9]{19}$"
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "dtnascto": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "dtadm": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "matricula": {
            "required": true,
            "type": "string",
            "minLength": 1,
            "maxLength": 30
        },
        "codcateg": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{3}"
        },
        "natatividade": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 2
        },
        "inforegctps": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cbocargo": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{6}$"
                },
                "vrsalfx": {
                    "required": true,
                    "type": "number"
                },
                "undsalfixo": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 7
                },
                "tpcontr": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                },
                "dtterm": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = "1.7.1234567890123456789";
$std->cpftrab = '00232133417';
$std->dtnascto = '1931-02-12';
$std->dtadm = '2017-02-12';
$std->matricula = "abs1234";
$std->codcateg = "101";
$std->natatividade = 1;

$std->inforegctps = new \stdClass();
$std->inforegctps->cbocargo = "263105";
$std->inforegctps->vrsalfx = "2500";
$std->inforegctps->undsalfixo = 3;
$std->inforegctps->tpcontr = 1;
$std->inforegctps->dtterm = null;

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
