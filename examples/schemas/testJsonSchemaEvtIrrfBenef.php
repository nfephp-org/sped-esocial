<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Validator;
use JsonSchema\SchemaStorage;
use JsonSchema\Constraints\Factory;
use JsonSchema\Constraints\Constraint;

$evento = 'evtIrrfBenef';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtIrrfBenef",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "nrrecarqbase": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 40
        },
        "perapur": {
            "required": true,
            "type": "string",
            "maxLength": 7,
            "minLength": 7
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "maxLength": 11,
            "minLength": 11
        },
        "vrdeddep": {
            "required": false,
            "type": "number"
        },
        "infoirrf": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 9,
            "items": {
                "type": "object",
                "properties": {
                    "codcateg": {
                        "required": false,
                        "type": "integer",
                        "minimum": 101,
                        "maximum": 905
                    },
                    "indresbr": {
                        "required": true,
                        "type": "string",
                        "pattern": "S|N"
                    }
                },
                "basesirrf": {
                    "required": true,
                    "type": "array",
                    "minItems": 1,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "tpvalor": {
                                "required": true,
                                "type": "string",
                                "minLength": 2,
                                "maxLength": 2,
                                "pattern": "^[0-9]"
                            },
                            "valor": {
                                "required": true,
                                "type": "number"
                            }
                        }
                    }
                },
                "irrf": {
                    "required": false,
                    "type": "array",
                    "minItems": 0,
                    "maxItems": 20,
                    "items": {
                        "type": "object",
                        "properties": {
                            "tpcr": {
                                "required": true,
                                "type": "string",
                                "minLength": 6,
                                "maxLength": 6,
                                "pattern": "^[0-9]"
                            },
                            "vrirrfdesc": {
                                "required": true,
                                "type": "number"
                            }
                        }
                    }
                },
                "idepgtoext": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "codpais": {
                            "required": true,
                            "type": "string",
                            "minLength": 3,
                            "maxLength": 3,
                            "pattern": "^[0-9]"
                        },
                        "indnif": {
                            "required": false,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        },
                        "nifbenef": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 20
                        },
                        "dsclograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 80
                        },
                        "nrlograd": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 10
                        },
                        "complem": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 30
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 60
                        },
                        "nmcid": {
                            "required": true,
                            "type": "string",
                            "maxLength": 50
                        },
                        "codpostal": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 12
                        }
                    }    
                }
            }
        }
    }
}';


// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);

$std = new \stdClass();
$std->sequencial = 1;
$std->nrrecarqbase = 'ljdkdjdlkjdlkdjkdjdkjdkjdkdjk';
$std->perapur = '2017-08';
$std->cpftrab = '99999999999';
$std->vrdeddep = '1234.56';

$infoirrf[0] = new \stdClass();
$infoirrf[0]->codcateg = '101';
$infoirrf[0]->indresbr = 'N';

$basesirrf[0] = new \stdClass();
$basesirrf[0]->tpvalor = '00';
$basesirrf[0]->valor = '1000';
$infoirrf[0]->basesirrf = $basesirrf;

$irrf[0] = new \stdClass();
$irrf[0]->tpcr = '056107';
$irrf[0]->vrirrfdesc = 12345.23;
$infoirrf[0]->irrf = $irrf;

$idepgtoext = new \stdClass();
$idepgtoext->codpais = '105';
$idepgtoext->indnif = 1;
$idepgtoext->nifbenef = 'lsklsslkslslsk';

$idepgtoext->dsclograd = 'RUA';
$idepgtoext->nrlograd = '123';
$idepgtoext->complem = 'ddddd';
$idepgtoext->bairro = 'eeee';
$idepgtoext->nmcid = 'nnnnnn';
$idepgtoext->codpostal = '123456789012';

$infoirrf[0]->idepgtoext = $idepgtoext;

$std->infoirrf = $infoirrf;



if (empty($jsonSchemaObject)) {
    echo "Erro no JSON SCHEMA";
    die;
}

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
