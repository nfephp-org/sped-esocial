<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2260 v2.5.0


$evento = 'evtConvInterm';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtConvInterm",
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
            "type": "string",
            "maxLength": 40
        },
        "idevinculo": {
            "required": true,
            "type": "object",
            "properties": {
                "cpftrab": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{11}$"
                },
                "nistrab": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{11}$"
                },
                "matricula": {
                    "required": true,
                    "type": "string",
                    "maxLength": 30
                }
            }
        },
        "infoconvinterm": {
            "required": true,
            "type": "object",
            "properties": {
                "codconv": {
                    "required": true,
                    "type": "string",
                    "pattern": "^.{1,30}$"
                },
                "dtinicio": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "dtfim": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "dtprevpgto": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "jornada": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "codhorcontrat": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^.{1,30}$"
                        },
                        "dscjornada": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^.{1,999}$"
                        }
                    }
                },
                "localtrab": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "indlocal": {
                            "required": true,
                            "type": "integer",
                            "minimum": 0,
                            "maximum": 2
                        },
                        "localtrabinterm": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "tplograd": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{1,4}$"
                                },
                                "dsclograd": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{1,100}$"
                                },
                                "nrlograd": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{1,10}$"
                                },
                                "complem": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{1,30}$"
                                },
                                "bairro": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{1,90}$"
                                },
                                "cep": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{8}$"
                                },
                                "codmunic": {
                                    "required": true,
                                     "type": "string",
                                     "pattern": "^[0-9]{7}$"
                                },
                                "uf": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{2}$"
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
$std->indretif = 2;
$std->nrrecibo = 'lalalalalalalal';

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

$std->infoconvinterm = new \stdClass();
$std->infoconvinterm->codconv = 'bla bla bla';
$std->infoconvinterm->dtinicio = '2108-10-02';
$std->infoconvinterm->dtfim = '2018-12-30';
$std->infoconvinterm->dtprevpgto = '2018-12-30';

$std->infoconvinterm->jornada = new \stdClass();
$std->infoconvinterm->jornada->codhorcontrat = 'bal bla bla';
$std->infoconvinterm->jornada->dscjornada = 'mais bla bla bla';

$std->infoconvinterm->localtrab = new \stdClass();
$std->infoconvinterm->localtrab->indlocal = 0; //0-2

$std->infoconvinterm->localtrab->localtrabinterm = new \stdClass(); 
$std->infoconvinterm->localtrab->localtrabinterm->tplograd = 'RUA';
$std->infoconvinterm->localtrab->localtrabinterm->dsclograd = 'SEM NOME';
$std->infoconvinterm->localtrab->localtrabinterm->nrlograd = 'ZERO';
$std->infoconvinterm->localtrab->localtrabinterm->complem = 'SUBSOLO';
$std->infoconvinterm->localtrab->localtrabinterm->bairro = 'BAIRRO';
$std->infoconvinterm->localtrab->localtrabinterm->cep = '00000000';
$std->infoconvinterm->localtrab->localtrabinterm->codmunic = '1234567';
$std->infoconvinterm->localtrab->localtrabinterm->uf = 'AC';

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
