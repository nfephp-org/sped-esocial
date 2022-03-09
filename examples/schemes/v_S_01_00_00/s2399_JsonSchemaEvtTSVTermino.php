<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2399
//Campo {cpfDep} – alterada validação da alínea a).
//Campo {codSusp} – alteradas ocorrência e validação.
//versão S_1.00

$evento  = 'evtTSVTermino';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtTSVTermino",
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
        "indguia": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 1
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "matricula": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^.{1,30}$"
        },
        "codcateg": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 100,
            "maximum": 999
        },
        "dtterm": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "mtvdesligtsv": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{2}"
        },
        "pensalim": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 0,
            "maximum": 3
        },
        "percaliment": {
            "required": false,
            "type": ["number","null"]
        },
        "vralim": {
            "required": false,
            "type": ["number","null"]
        },
        "nrproctrab": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^.{20}"
        },
        "novocpf": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{11}"
        },
        "verbasresc": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dmdev": {
                    "required": true,
                    "type": "array",
                    "minItems": 1,
                    "maxItems": 50,
                    "items": {
                        "type": "object",
                        "properties": {
                            "idedmdev": {
                                "required": true,
                                "type": "string",
                                "minLength": 1,
                                "maxLength": 30
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
                                            "required": true,
                                            "type": "integer",
                                            "minimum": 1,
                                            "maximum": 2
                                        },
                                        "nrinsc": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^[0-9]{8,14}$"
                                        },
                                        "codlotacao": {
                                            "required": true,
                                            "type": "string",
                                            "minLength": 1,
                                            "maxLength": 30
                                        },
                                        "detverbas": {
                                            "required": true,
                                            "type": "array",
                                            "minItems": 1,
                                            "maxItems": 200,
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "codrubr": {
                                                        "required": true,
                                                        "type": "string",
                                                        "minLength": 1,
                                                        "maxLength": 30
                                                    },
                                                    "idetabrubr": {
                                                        "required": true,
                                                        "type": "string",
                                                        "minLength": 1,
                                                        "maxLength": 8
                                                    },
                                                    "qtdrubr": {
                                                        "required": false,
                                                        "type": ["number","null"]
                                                    },
                                                    "fatorrubr": {
                                                        "required": false,
                                                        "type": ["number","null"]
                                                    },
                                                    "vrrubr": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "indapurir": {
                                                        "required": false,
                                                        "type": ["integer","null"],
                                                        "minimum": 0,
                                                        "maximum": 1
                                                    }
                                                }
                                            }    
                                        },
                                        "infosimples": {
                                            "required": false,
                                            "type": ["object","null"],
                                            "properties": {
                                                "indsimples": {
                                                    "required": true,
                                                    "type": "integer",
                                                    "minimum": 1,
                                                    "maximum": 3
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                "procjudtrab": {
                    "required": false,
                    "type": ["array","null"],
                    "minItems": 0,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "tptrib": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 2
                            },
                            "nrprocjud": {
                                "required": true,
                                "type": "string",
                                "pattern": "^.{20}$"
                            },
                            "codsusp": {
                                "required": false,
                                "type": ["string","null"],
                                "pattern": "^[0-9]{1,14}$"
                            }
                        }
                    }   
                },
                "infomv": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "indmv": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        },
                        "remunoutrempr": {
                            "required": true,
                            "type": "array",
                            "minItems": 1,
                            "maxItems": 10,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "tpinsc": {
                                        "required": true,
                                        "type": "integer",
                                        "minimum": 1,
                                        "maximum": 2
                                    },
                                    "nrinsc": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^[0-9]{8,14}$"
                                    },
                                    "codcateg": {
                                        "required": true,
                                        "type": "integer",
                                        "minimum": 100,
                                        "maximum": 999
                                    },
                                    "vlrremunoe": {
                                        "required": true,
                                        "type": "number"
                                    }
                                }
                            }   
                        }
                    }
                }
            }
        },
        "quarentena": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtfimquar": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                }
            }
        }
    }
}';


$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789';
$std->indguia = 1;
$std->cpftrab = '12345678901';
$std->matricula = 'ABC12345678902';
$std->codcateg = 101;
$std->dtterm = '2017-12-22';
$std->mtvdesligtsv = '01';
$std->pensalim = 3;
$std->percaliment = 10.00;
$std->vralim = 600.23;
$std->nrproctrab = "12345678901234567890";
$std->novocpf = "12345678901";
    
$std->verbasresc = new \stdClass();
$std->verbasresc->dmdev[1] = new \stdClass();
$std->verbasresc->dmdev[1]->idedmdev = 'ksksksksksksksk';

$std->verbasresc->dmdev[1]->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->ideestablot[1]->nrinsc = '12345678901234';
$std->verbasresc->dmdev[1]->ideestablot[1]->codlotacao = 'assss';

$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->codrubr = '2323dffdf';
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->idetabrubr = 'sdser234';
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->qtdrubr = 256.20;
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->fatorrubr = 25.56;
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->vrrubr = 12345.56;
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->indapurir = 0;

$std->verbasresc->dmdev[1]->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->procjudtrab[1] = new \stdClass();
$std->verbasresc->procjudtrab[1]->tptrib = 2;
$std->verbasresc->procjudtrab[1]->nrprocjud = '12345678901234567890';
$std->verbasresc->procjudtrab[1]->codsusp = '12345678901234';
$std->verbasresc->infomv = new \stdClass();
$std->verbasresc->infomv->indmv = 3;
$std->verbasresc->infomv->remunoutrempr[1] = new \stdClass();
$std->verbasresc->infomv->remunoutrempr[1]->tpinsc = 1;
$std->verbasresc->infomv->remunoutrempr[1]->nrinsc = '12345678901234';
$std->verbasresc->infomv->remunoutrempr[1]->codcateg = 905;
$std->verbasresc->infomv->remunoutrempr[1]->vlrremunoe = 2598.56;

$std->quarentena = new \stdClass();
$std->quarentena->dtfimquar = '2018-12-20';

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
