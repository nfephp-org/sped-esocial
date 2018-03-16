<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1210
//Grupo {detPgtoFer} – inserido campo {matricula} como chave.
//Campo {cpfBenef} – alterada validação da alínea b).
//Grupo {detPgtoFl/infoPgtoParc} – alterada descrição no registro do evento.
//Campo {detPgtoFl/infoPgtoParc/matricula} – criado.
//Campo {detPgtoFl/infoPgtoParc/codRubr} – alterada validação.
//Grupo {detPgtoBenPr/infoPgtoParc} – alterada descrição no registro do evento.
//Campo {detPgtoBenPr/infoPgtoParc/codRubr} – alterada validação.
//Campo {detPgtoFer/matricula} – criado.
//Campo {detRubrFer/codRubr} – alterada validação.

$evento  = 'evtPagtos';
$version = '02_04_02';

$jsonSchema = '{
    "title": "evtPagtos",
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
            "minLength": 1,
            "maxLength": 40
        },
        "indapuracao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "perapur": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "maxLength": 11,
            "minLength": 11
        },
        "deps": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "vrdeddep": {
                    "required": true,
                    "type": "number"
                }
            }
        },
        "infopgto": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 60,
            "items": {
                "type": "object",
                "properties": {
                    "dtpgto": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                    },
                    "tppgto": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 9
                    },
                    "indresbr": {
                        "required": true,
                        "type": "string",
                        "maxLength": 1,
                        "pattern": "S|N"
                    },
                    "detpgtofl": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 200,
                        "items": {
                            "type": "object",
                            "properties": {
                                "perref": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
                                },
                                "idedmdev": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 30
                                },
                                "indpgtott": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 1,
                                    "pattern": "S|N"
                                },
                                "vrliq": {
                                    "required": true,
                                    "type": "number"
                                },
                                "nrrecarq": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "maxLength": 40
                                }
                            }
                        }    
                    }
                }
            }    
        }
    }    
}';


$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = 'abcdefghijklmnopq';
$std->indapuracao = 2;
$std->perapur = '2017-12';
$std->cpftrab = '12345678901';

$std->deps = new \stdClass();
$std->deps->vrdeddep = 1000.00;

$std->infopgto[0] = new \stdClass();
$std->infopgto[0]->dtpgto = '2018-01-15';
$std->infopgto[0]->tppgto = 4;
$std->infopgto[0]->indresbr = 'N';

$std->infopgto[0]->detpgtofl[0] = new \stdClass();
$std->infopgto[0]->detpgtofl[0]->perref = '2018-12';
$std->infopgto[0]->detpgtofl[0]->idedmdev = 'jlkjkj112121';
$std->infopgto[0]->detpgtofl[0]->indpgtott = 'N';
$std->infopgto[0]->detpgtofl[0]->vrliq = 1001.55;
$std->infopgto[0]->detpgtofl[0]->nrrecarq = 'dkjhdkjdhkjdh dkjhdkjhdkj';


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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
