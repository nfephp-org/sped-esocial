<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtMonit';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtMonit",
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
        "aso": {
            "required": true,
            "type": "object",
            "properties": {
                "dtaso": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "tpaso": {
                     "required": true,
                     "type": "integer",
                     "maxLength": 1,
                     "pattern": "([0|1|2|3|4|8]){1}$"
                },
                "resaso": {
                     "required": true,
                     "type": "integer",
                     "maxLength": 1,
                     "pattern": "([1-2]){1}$"
                }
            }
        },
        "exame": {
            "required": true,
            "type": "array",
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "dtexm": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                    },
                    "procrealizado": {
                        "required": false,
                        "type": "integer",
                        "maxLength": 8
                    },
                    "obsproc": {
                        "required": false,
                        "type": "string",
                        "maxLength": 200
                    },
                    "interprexm": {
                        "required": true,
                        "type": "integer",
                        "maxLength": 1,
                        "pattern": "([1-3]){1}$"
                    },
                    "ordexame": {
                        "required": true,
                        "type": "integer",
                        "maxLength": 1,
                        "pattern": "([1-2]){1}$"
                    },
                    "dtinimonit": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                    },
                    "dtfimmonit": {
                        "required": false,
                        "type": "string",
                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                    },
                    "indresult": {
                        "required": false,
                        "type": "integer",
                        "maxLength": 1,
                        "pattern": "([1-4]){1}$"
                    }
                }
            }
        },
        "respmonit": {
            "required": true,
            "type": "object",
            "properties": {
                "nisresp": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "nrconsclasse": {
                    "required": false,
                    "type": "string",
                    "maxLength": 8
                },
                "ufconsclasse": {
                    "required": false,
                    "type": "string",
                    "maxLength": 2
                }
            }
        },
        "ideservsaude": {
            "required": true,
            "type": "object",
            "properties": {
                "codcnes": {
                    "required": false,
                    "type": "string",
                    "maxLength": 7
                },
                "frmctt": {
                    "required": true,
                    "type": "string",
                    "maxLength": 100
                },
                "email": {
                    "required": false,
                    "type": "string",
                    "maxLength": 60
                }
            }
        },
        "medico": {
            "required": true,
            "type": "object",
            "properties": {
                "nmmed": {
                    "required": false,
                    "type": "string",
                    "maxLength": 70
                },
                "nrcrm": {
                    "required": false,
                    "type": "string",
                    "maxLength": 8
                },
                "ufcrm": {
                    "required": false,
                    "type": "string",
                    "maxLength": 2
                }
            }
        }
    }
}';

$jsonToValidateObject             = new \stdClass();
$jsonToValidateObject->sequencial = 1;
$jsonToValidateObject->indretif   = 1;

$idevinculo            = new \stdClass();
$idevinculo->cpftrab   = '11111111111';
$idevinculo->nistrab   = '11111111111';
$idevinculo->matricula = '11111111111';

$jsonToValidateObject->idevinculo = $idevinculo;

$aso         = new \stdClass();
$aso->dtaso  = '2017-08-18';
$aso->tpaso  = 0;
$aso->resaso = 1;

$jsonToValidateObject->aso = $aso;

$exame[0]                = new \stdClass();
$exame[0]->dtexm         = '2017-08-18';
$exame[0]->procrealizado = 10102019;
$exame[0]->obsproc       = 'observação do exame';
$exame[0]->interprexm    = 1;
$exame[0]->ordexame      = 1;
$exame[0]->dtinimonit    = '2017-08-18';
$exame[0]->dtfimmonit    = '2018-08-18';
$exame[0]->indresult     = 1;

$jsonToValidateObject->exame = $exame;

$respmonit               = new \stdClass();
$respmonit->nisresp      = '11111111111';
$respmonit->nrconsclasse = '11111111';

$jsonToValidateObject->respmonit = $respmonit;

$ideservsaude          = new \stdClass();
$ideservsaude->codcnes = '1111111';
$ideservsaude->frmctt  = 'CONTATO';
$ideservsaude->email   = 'teste@exemplo.com.br';

$jsonToValidateObject->ideservsaude = $ideservsaude;

$medico        = new \stdClass();
$medico->nmmed = 'NOME DO MEDICO';
$medico->nrcrm = '12345678';
$medico->ufcrm = 'SP';

$jsonToValidateObject->medico = $medico;

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
