<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtBasesTrab';
$version = '02_04_00';

$jsonSchema = '{
    "title": "evtBasesTrab",
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
        "indapuracao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
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
        "procjudtrab": {
            "required": false,
            "type": "array",
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "nrprocjud": {
                        "required": true,
                        "type": "string",
                        "maxLength": 20
                    },
                    "codsusp": {
                        "required": true,
                        "type": "string",
                        "maxLength": 14
                    }
                }
            }
        },
        "infocpcalc": {
            "required": false,
            "type": "array",
            "minItems": 0,
            "maxItems": 9,
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
                    "vrcpseg": {
                        "required": true,
                        "type": "number"
                    },
                    "vrdescseg": {
                        "required": true,
                        "type": "number"
                    }
                }
            }
        },
        "ideestablot": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "tpinsc": {
                        "required": false,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 4
                    },
                    "nrinsc": {
                        "required": true,
                        "type": "string",
                        "minLength": 8,
                        "maxLength": 15,
                        "pattern": "^[0-9]"
                    },    
                    "codlotacao": {
                        "required": true,
                        "type": "string",
                        "maxLength": 30
                    },
                    "infocategincid": {
                        "required": true,
                        "type": "array",
                        "minItems": 1,
                        "maxItems": 10,
                        "items": {
                            "type": "object",
                            "properties": {
                                "matricula": {
                                    "required": false,
                                    "type": ["string", "null"],
                                    "maxLength": 30
                                },
                                "codcateg": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 101,
                                    "maximum": 905
                                },
                                "indsimples": {
                                    "required": false,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 3
                                },
                                "infobasecs": {
                                    "required": false,
                                    "type": "array",
                                    "minItems": 0,
                                    "maxItems": 99,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "ind13": {
                                                "required": true,
                                                "type": "integer",
                                                "minimum": 0,
                                                "maximum": 1
                                            },
                                            "tpvalor": {
                                                "required": true,
                                                "type": "integer",
                                                "minimum": 12,
                                                "maximum": 94
                                            },
                                            "valor": {
                                                "required": true,
                                                "type": "number"
                                            }
                                        }
                                    }    
                                },
                                "calcterc": {
                                    "required": false,
                                    "type": "array",
                                    "minItems": 0,
                                    "maxItems": 2,
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
                                            "vrcssegterc": {
                                                "required": true,
                                                "type": "number"
                                            },
                                            "vrdescterc": {
                                                "required": true,
                                                "type": "number"
                                            }
                                        }
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

// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);

if (empty($jsonSchemaObject)) {
    echo "Erro no JSON SCHEMA";
    die;
}

$std               = new \stdClass();
$std->sequencial   = 1;
$std->nrrecarqbase = 'kjskjsksjksjksjksjksjskjsksksjskj';
$std->indapuracao  = 1;
$std->perapur      = '2017-08';
$std->cpftrab      = '99999999999';

$procjudtrab[0]            = new \stdClass();
$procjudtrab[0]->nrprocjud = '282828282';
$procjudtrab[0]->codsusp   = '73737337';
$std->procjudtrab          = $procjudtrab;

$infocpcalc[0]            = new \stdClass();
$infocpcalc[0]->tpcr      = '108204';
$infocpcalc[0]->vrcpseg   = 100.23;
$infocpcalc[0]->vrdescseg = 10;
$std->infocpcalc          = $infocpcalc;

$ideestablot[0]             = new \stdClass();
$ideestablot[0]->tpinsc     = 1;
$ideestablot[0]->nrinsc     = '12345678';
$ideestablot[0]->codlotacao = '12323455666677';

$infoCategIncid[0]             = new \stdClass();
$infoCategIncid[0]->matricula  = 'aaaaaaaaaa';
$infoCategIncid[0]->codcateg   = 105;
$infoCategIncid[0]->indsimples = 1;

$infoBaseCS[0]          = new \stdClass();
$infoBaseCS[0]->ind13   = 1;
$infoBaseCS[0]->tpvalor = 12;
$infoBaseCS[0]->valor   = 1000.02;

$infoCategIncid[0]->infobasecs = $infoBaseCS;

$calcterc[0]              = new \stdClass();
$calcterc[0]->tpcr        = '121802';
$calcterc[0]->vrcssegterc = 500;
$calcterc[0]->vrdescterc  = 111.09;

$infoCategIncid[0]->calcterc = $calcterc;

$ideestablot[0]->infocategincid = $infoCategIncid;

$std->ideestablot = $ideestablot;

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
