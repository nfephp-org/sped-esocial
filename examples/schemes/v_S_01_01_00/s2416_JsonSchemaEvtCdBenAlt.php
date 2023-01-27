<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2416
//versão S_1.00

$evento  = 'evtCdBenAlt';
$version = 'S_01_01_00';

$jsonSchema = '{
    "title": "evtCdBenAlt",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": false,
            "type": ["integer","null"],
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
            "$ref": "#/definitions/recibo"
        },
        "cpfbenef": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "nrbeneficio": {
            "required": true,
            "type": "string",
            "pattern": "^.{1,20}$"
        },
        "dtaltbeneficio": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "tpbeneficio": {
            "required": true,
            "type": "string",
            "pattern": "^[0-1]{1}[0-9]{3}$"
        },
        "tpplanrp": {
            "required": true,
            "type": "integer",
            "minimum": 0,
            "maximum": 3
        },
        "dsc": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^.{1,255}$"
        },
        "indsuspensao": {
            "required": true,
            "type": "string",
            "pattern": "^(S|N)$"
        },
        "infopenmorte": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tppenmorte": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                }
            }
        },
        "suspensao": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "mtvsuspensao": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(01|99)$"
                },
                "dscSuspensao": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^.{1,255}$"
                }
            }
        }

    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1; //obrigatorio
$std->nrrecibo = '1.4.1234567890123456789'; //opcional
$std->cpfbenef = '12345678901'; //obrigatorio
$std->nrbeneficio = 'b1234'; //obrigatorio
$std->dtaltbeneficio = '2021-03-02';
$std->tpbeneficio = "0805";
$std->tpplanrp = 0;
$std->dsc = "bla bla bla bla";
$std->indsuspensao = "N";
//opcional
$std->infopenmorte = new \stdClass();
$std->infopenmorte->tppenmorte = 1; //obrigatorio
//opcional
$std->suspensao = new \stdClass();
$std->suspensao->mtvsuspensao = '01';
$std->suspensao->dscsuspensao = 'bla bla bla bla';



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
file_put_contents("../../../jsonSchemes/v_$version/$evento.schema", $jsonSchema);
