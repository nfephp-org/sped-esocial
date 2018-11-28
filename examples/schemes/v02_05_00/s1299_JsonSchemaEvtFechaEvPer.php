<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1299
//Campo {evtFechaEvPer} – excluída REGRA_EVE_FOPAG_IND_RETIFICACAO.
///Campo {evtRemun} – alterada validação.

//S-1299 sem alterações da 2.4.2 => 2.5.0

$evento = 'evtFechaEvPer';
$version = '02_05_00';

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
                    "pattern": "^[0-9]{11}$"
                },
                "telefone": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{10,13}$"
                },
                "email": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "mail"
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
                    "pattern": "^(S|N)$"
                },
                "evtpgtos": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "evtaqprod": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "evtcomprod": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "evtcontratavnp": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "evtinfocomplper": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "compsemmovto": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indapuracao = 1;
$std->perapur = '2017-08';

$std->iderespinf = new \stdClass();
$std->iderespinf->nmresp = 'JOAO';
$std->iderespinf->cpfresp = '11111111111';
$std->iderespinf->telefone = '1122223333';
$std->iderespinf->email = 'fulano@mail.com';

$std->infofech = new \stdClass();
$std->infofech->evtremun = 'N';
$std->infofech->evtpgtos = 'N';
$std->infofech->evtaqprod = 'N';
$std->infofech->evtcomprod = 'N';
$std->infofech->evtcontratavnp = 'N';
$std->infofech->evtinfocomplper = 'N';


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
