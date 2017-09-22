<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtTabCargo';
$version = '02_02_02';

$jsonSchema = '{
    "title": "evtTabCargo",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "codcargo": {
            "required": true,
            "type": "string",
            "maxLength": 30,
            "pattern": "^(?!eSocial)"
        },
        "inivalid": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
        },
        "fimvalid": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
        },
        "modo": {
            "required": true,
            "type": "string",
            "pattern": "INC|ALT|EXC"
        },
        "dadoscargo": {
            "required": true,
            "type": "object",
            "properties": {
                "nmcargo": {
                    "required": true,
                    "type": "string",
                    "minLength": 8,
                    "maxLength": 100
                },
                "codcbo": {
                    "required": true,
                    "type": "string",
                    "minLength": 6,
                    "maxLength": 6,
                    "pattern": "^[0-9]"
                },
                "cargopublico": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "acumcargo": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 4
                        },
                        "contagemesp": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 4
                        },
                        "dedicexcl": {
                            "required": true,
                            "type": "string",
                            "pattern": "S|N"
                        },
                        "nrlei": {
                            "required": true,
                            "type": "string",
                            "minLength": 3,
                            "maxLength": 12
                        },
                        "dtlei": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "sitcargo": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        }
                    }
                }
            }
        },
        "novavalidade": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "inivalid": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                },
                "fimvalid": {
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
$std->codcargo = 'assistente';
$std->inivalid = '2017-01';
$std->fimvalid = '2017-12';
$std->modo = 'INC';

$std->dadoscargo = new \stdClass();
$std->dadoscargo->nmcargo = 'descricao do cargo';
$std->dadoscargo->codcbo = '123456';
$std->dadoscargo->cargopublico = new \stdClass();
$std->dadoscargo->cargopublico->acumcargo = 1;
$std->dadoscargo->cargopublico->contagemesp = 1;
$std->dadoscargo->cargopublico->dedicexcl = 'S';
$std->dadoscargo->cargopublico->nrlei = '1234325';
$std->dadoscargo->cargopublico->dtlei = '2017-02-22';
$std->dadoscargo->cargopublico->sitcargo = 2;

$std->novavalidade = new \stdClass();
$std->novavalidade->inivalid = '2017-01';
$std->novavalidade->fimvalid = '2017-12';

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
