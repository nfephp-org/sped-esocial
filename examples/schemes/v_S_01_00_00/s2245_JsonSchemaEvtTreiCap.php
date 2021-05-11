<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2245 2.5.0

$evento = 'evtTreiCap';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtTreiCap",
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
            "type": ["string","null"]
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
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{11}$"
                },
                "matricula": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 30
                },
                "codcateg": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 3
                }
            }
        },
        "treicap": {
            "required": true,
            "type": "object",
            "properties": {
                "codtreicap": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{4}$"
                },
                "obstreicap": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^.{4,999}$"
                },
                "infocomplem": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "dttreicap": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "durtreicap": {
                            "required": true,
                            "type": "number"
                        },
                        "modtreicap": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        },
                        "tptreicap": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 5
                        },
                        "indtreinant": {
                            "required": true,
                            "type": "string",
                            "pattern": "^S|N$"
                        },
                        "ideprofresp": {
                            "required": true,
                            "type": "array",
                            "minItems": 1,
                            "maxItems": 99,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "cpfprof": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "pattern": "^[0-9]{11}$"
                                    },
                                    "nmprof": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^.{1,70}$"
                                    },
                                    "tpprof": {
                                        "required": true,
                                        "type": "integer",
                                        "minimum": 1,
                                        "maximum": 2
                                    },
                                    "formprof": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^.{1,255}$"
                                    },
                                    "codcbo": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^[0-9]{6}$"
                                    },
                                    "nacprof": {
                                        "required": true,
                                        "type": "integer",
                                        "minimum": 1,
                                        "maximum": 2
                                    }
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
$std->nrrecibo = 'lklskslkskslkslk';

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

$std->treicap = new \stdClass();
$std->treicap->codtreicap = '2222';
$std->treicap->obstreicap = 'bla bla bla';

$std->treicap->infocomplem = new \stdClass(); //opcional
$std->treicap->infocomplem->dttreicap = '2018-11-12';
$std->treicap->infocomplem->durtreicap = 22.4;
$std->treicap->infocomplem->modtreicap = 3; //1-3
$std->treicap->infocomplem->tptreicap = 5; //1-5
$std->treicap->infocomplem->indtreinant = 'N';

$std->treicap->infocomplem->ideprofresp[0] = new \stdClass();
$std->treicap->infocomplem->ideprofresp[0]->cpfprof = '12345678901';
$std->treicap->infocomplem->ideprofresp[0]->nmprof = 'Beltrano de Tal';
$std->treicap->infocomplem->ideprofresp[0]->tpprof = 1; //1-2
$std->treicap->infocomplem->ideprofresp[0]->formprof = 'bla bla bla';
$std->treicap->infocomplem->ideprofresp[0]->codcbo = '123456'; 
$std->treicap->infocomplem->ideprofresp[0]->nacprof = 1; //1-2


// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);

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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
