<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-5002
//Campo {vrIrrfDesc} – alterada descrição para o código de receita 0473-01.

$evento = 'evtIrrfBenef';
$version = '02_05_00';

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
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
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
                        "pattern": "^(S|N)$"
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
                                "pattern": "^[0-9]{2}$"
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
                                "pattern": "^[0-9]{6}$"
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
                            "pattern": "^[0-9]{3}$"
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
$std->vrdeddep = 1234.56;

$std->infoirrf[0] = new \stdClass();
$std->infoirrf[0]->codcateg = 101;
$std->infoirrf[0]->indresbr = 'N';

$std->infoirrf[0]->basesirrf[0] = new \stdClass();
$std->infoirrf[0]->basesirrf[0]->tpvalor = '00';
$std->infoirrf[0]->basesirrf[0]->valor = '1000';

$std->infoirrf[0]->irrf[0] = new \stdClass();
$std->infoirrf[0]->irrf[0]->tpcr = '056107';
$std->infoirrf[0]->irrf[0]->vrirrfdesc = 12345.23;

$std->infoirrf[0]->idepgtoext = new \stdClass();
$std->infoirrf[0]->idepgtoext->codpais = '105';
$std->infoirrf[0]->idepgtoext->indnif = 1;
$std->infoirrf[0]->idepgtoext->nifbenef = 'lsklsslkslslsk';
$std->infoirrf[0]->idepgtoext->dsclograd = 'RUA';
$std->infoirrf[0]->idepgtoext->nrlograd = '123';
$std->infoirrf[0]->idepgtoext->complem = 'ddddd';
$std->infoirrf[0]->idepgtoext->bairro = 'eeee';
$std->infoirrf[0]->idepgtoext->nmcid = 'nnnnnn';
$std->infoirrf[0]->idepgtoext->codpostal = '123456789012';



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
