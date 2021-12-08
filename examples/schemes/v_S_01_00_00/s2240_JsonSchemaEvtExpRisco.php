<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2240 versão inicial e-social simplificado v1.0.0

$evento = 'evtExpRisco';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtExpRisco",
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
        "cpftrab": {
            "required": true,
            "type": "string",
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
            "pattern": "^[0-9]{3}$"
        },
        "dtinicondicao": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "infoamb": {
            "required": true,
            "type": "object",
            "properties": {
                "localamb": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "dscsetor": {
                    "required": true,
                    "type": "string",
                    "maxLength": 100
                },
                "tpinsc": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 4
                },
                "nrinsc": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{8,14}$"
                }
            }
        },
        "dscativdes": {
            "required": true,
            "type": "string",
            "maxLength": 999
        },
        "agnoc": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 999,
            "items": {
                "required": true,
                "type": "object",
                "properties": {
                    "codagnoc": {
                        "required": true,
                        "type": "string",
                        "pattern": "^([0-9][0-9.]*[0-9])$"
                    },
                    "dscagnoc": {
                        "required": false,
                        "type": ["string","null"],
                        "maxLength": 999
                    },
                    "tpaval": {
                        "required": false,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 2
                    },
                    "intconc": {
                        "required": false,
                        "type": ["number","null"]
                    },
                    "limtol": {
                        "required": false,
                        "type": ["number","null"]
                    },
                    "umed": {
                        "required": false,
                        "type": ["integer","null"],
                        "minimum": 1,
                        "maximum": 30
                    },
                    "tecmedicao": {
                        "required": false,
                        "type": ["string","null"],
                        "maxLength": 40
                    },
                    "epcepi": {
                        "required": true,
                        "type": "object",
                        "properties": {
                            "utilizepc": {
                               "required": true,
                                "type": "integer",
                                "minimum": 0,
                                "maximum": 2
                            },
                            "eficepc": {
                                "required": false,
                                "type": ["string","null"],
                                "pattern": "^(S|N)$"
                            },
                            "utilizepi": {
                                "required": true,
                                "type": "integer",
                                "minimum": 0,
                                "maximum": 2
                            },
                            "eficepi": {
                                "required": true,
                                "type": "string",
                                "pattern": "^(S|N)$"
                            },
                            "epi": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 0,
                                "maxItems": 50,
                                "items": {
                                    "required": true,
                                    "type": "object",
                                    "properties": {
                                        "docaval": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "maxLength": 255
                                        },
                                        "dscepi": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "maxLength": 999
                                        },
                                        "medprotecao": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "condfuncto": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "usoinint": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "przvalid": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "periodictroca": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "higienizacao": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        }
                                    }
                                }
                            }    
                        }
                    }
                }    
            }
        },
        "respreg": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 9,
            "items": {
                "required": true,
                "type": "object",
                "properties": {
                    "cpfresp": {
                        "required": true,
                        "type": "string",
                        "pattern": "^[0-9]{11}$"
                    },
                    "ideoc": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 9
                    },
                    "dscoc": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^.{1,20}$"
                    },
                    "nroc": {
                        "required": true,
                        "type": "string",
                        "maxLength": 14
                    },
                    "ufoc": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^.{2}$"
                    }
                }
            }    
        },
        "obscompl": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^.{2,999}$"
        }
    }    
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = null;
$std->cpftrab = '12345678901';
$std->matricula = '002zcbv';
$std->codcateg = '111';
$std->dtinicondicao = '2016-02-01';

$std->infoamb = new \stdClass();
$std->infoamb->localamb = 1;
$std->infoamb->dscsetor = 'Administrativo';
$std->infoamb->tpinsc = 1;
$std->infoamb->nrinsc = '12345678901234';

$std->dscativdes = 'lkskslkslsklsks  lsk slsklsk';

$std->agnoc[0] = new \stdClass();
$std->agnoc[0]->codagnoc = '01.01.012';
$std->agnoc[0]->dscagnoc = 'Cair um meteoro na cabeça';
$std->agnoc[0]->tpaval = 1;
$std->agnoc[0]->intconc = 20;
$std->agnoc[0]->limtol = 22.34;
$std->agnoc[0]->unmed = 15;
$std->agnoc[0]->tecmedicao = 'dosimetro Geiger- Muller de halogenio';

$std->agnoc[0]->epcepi = new \stdClass();
$std->agnoc[0]->epcepi->utilizepc = 1; // 0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado.
$std->agnoc[0]->epcepi->eficepc = 'S';
$std->agnoc[0]->epcepi->utilizepi = 1; //0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado
$std->agnoc[0]->epcepi->eficepi = 'S';

$std->agnoc[0]->epcepi->epi[0] = new \stdClass();
$std->agnoc[0]->epcepi->epi[0]->docaval = '111xxx';
$std->agnoc[0]->epcepi->epi[0]->dscePI = 'macacao';
$std->agnoc[0]->epcepi->epi[0]->medprotecao = 'S';
$std->agnoc[0]->epcepi->epi[0]->condfuncto = 'S';
$std->agnoc[0]->epcepi->epi[0]->usoinint = 'S';
$std->agnoc[0]->epcepi->epi[0]->przvalid = 'S';
$std->agnoc[0]->epcepi->epi[0]->periodictroca = 'S';
$std->agnoc[0]->epcepi->epi[0]->higienizacao = 'S';

$std->respreg[0] = new \stdClass();
$std->respreg[0]->cpfresp = '12345678901';
$std->respreg[0]->ideoc = 4;
$std->respreg[0]->dscoc = 'bla bla bla';
$std->respreg[0]->nroc = '12345678901234';
$std->respreg[0]->ufoc = 'SP';

$std->obscompl = 'kslksj s sljsljs ks';

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
$jsonValidator->validate($std, $jsonSchemaObject);

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
