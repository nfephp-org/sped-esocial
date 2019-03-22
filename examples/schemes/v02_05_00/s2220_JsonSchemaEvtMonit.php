<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2220 sem alterações da 2.4.1 => 2.4.2

$evento = 'evtMonit';
$version = '02_05_00';

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
        "exmedocup": {
            "tpexameocup": {
                "required": true,
                "type": "integer",
                "minimum": 0,
                "maximum": 9
            },
            "aso": {
                "dtaso": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "resaso": {
                     "required": true,
                     "type": "integer",
                     "minumum": 1,
                     "maximum": 2
                },
                "exame": {
                    "required": true,
                    "type": "array",
                    "minItems": 1,
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
                                "type": ["string","null"],
                                "pattern": "^[0-9]{4}$"
                            },
                            "obsproc": {
                                "required": false,
                                "type": ["string","null"],
                                "maxLength": 200
                            },
                            "ordexame": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 2
                            },
                            "indresult": {
                                "required": false,
                                "type": ["integer","null"],
                                "minimum": 1,
                                "maximum": 4
                            }
                        }
                    }
                },
                "medico": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "cpfmed": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{11}$"
                        },
                        "nismed": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{11}$"
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
                            "maxLength": 2
                        }
                    }
                }  
            },
            "respmonit": {
                "required": true,
                "type": "object",
                "properties": {
                    "cpfresp": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^[0-9]{11}$"
                    },
                    "nmresp": {
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
                        "maxLength": 2
                    }
                }
            }
        }
    }
}';



$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

$std->exmedocup = new \stdClass();
$std->exmedocup->tpexameocup = 1;

$std->exmedocup->aso = new \stdClass();
$std->exmedocup->aso->dtaso = '2017-08-18';
$std->exmedocup->aso->resaso = 1;

$std->exmedocup->aso->exame[0] = new \stdClass();
$std->exmedocup->aso->exame[0]->dtexm = '2017-08-18';
$std->exmedocup->aso->exame[0]->procrealizado = 1010;
$std->exmedocup->aso->exame[0]->obsproc = 'observação do exame';
$std->exmedocup->aso->exame[0]->ordexame = 1;
$std->exmedocup->aso->exame[0]->indresult = 1;

$std->exmedocup->aso->medico = new \stdClass();
$std->exmedocup->aso->medico->cpfmed = '12345678901';
$std->exmedocup->aso->medico->nismed = '12345678901';
$std->exmedocup->aso->medico->nmmed = 'NOME DO MEDICO';
$std->exmedocup->aso->medico->nrcrm = '12345678';
$std->exmedocup->aso->medico->ufcrm = 'SP';

$std->exmedocup->respmonit = new \stdClass();
$std->exmedocup->respmonit->cpfresp = '12345678901';
$std->exmedocup->respmonit->nmresp= 'Fulano de Tal';
$std->exmedocup->respmonit->nrcrm = '12345678';
$std->exmedocup->respmonit->ufcrm = 'AC';   

    
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
