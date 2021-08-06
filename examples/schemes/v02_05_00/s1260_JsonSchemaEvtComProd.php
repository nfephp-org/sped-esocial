<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1260 Campos {nrProc} – alterado tamanho. 20 -> 21

// S-1260 v2.5.0 
// Grupo {tpComerc} – alterada ocorrência.
// Grupo {ideAdquir} – alterada condição.
// Campos {vrTotCom} e {ideAdquir/tpInsc} – alterada validação.

$evento = 'evtComProd';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtComProd",
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
        "indapuracao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "perapur": {
            "required": true,
            "type": "string",
            "maxLength": 7
        },
        "estabelecimento": {
            "required": true,
            "type": "object",
            "properties": {
                "nrinscestabrural": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{14}$"
                },
                "tpcomerc": {
                    "required": true,
                    "type": "array",
                    "minItems": 1,
                    "maxItems": 5,
                    "items": {
                        "type": "object",
                        "properties": {
                            "indcomerc": {
                                "required": true,
                                "type": "string",
                                "pattern": "^(2|3|8|9)$"
                            },
                            "vrtotcom": {
                                "required": true,
                                "type": "number"
                            },
                            "ideadquir": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 0,
                                "maxItems": 9999,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "tpinsc": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^[1-2]{1}$"
                                        },
                                        "nrinsc": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^[0-9]{8,15}$"
                                        },
                                        "vrcomerc": {
                                            "required": true,
                                            "type": "number"
                                        },
                                        "nfs": {
                                            "required": false,
                                            "type": ["array","null"],
                                            "minItems": 0,
                                            "maxItems": 9999,
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "serie": {
                                                        "required": false,
                                                        "type": "string",
                                                        "maxLength": 5
                                                    },
                                                    "nrdocto": {
                                                        "required": true,
                                                        "type": "string",
                                                        "maxLength": 20
                                                    },
                                                    "dtemisnf": {
                                                        "required": true,
                                                        "type": "string",
                                                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                                    },
                                                    "vlrbruto": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrcpdescpr": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrsenardesc": {
                                                        "required": true,
                                                        "type": "number"
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            },
                            "infoprocjud": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 0,
                                "maxItems": 10,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "tpproc": {
                                            "required": true,
                                            "type": "integer",
                                            "minimum": 1,
                                            "maximum": 2
                                        },
                                        "nrproc": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 21
                                        },
                                        "codsusp": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 14,
                                            "pattern": "^[0-9]"
                                        },
                                        "vrcpsusp": {
                                            "required": false,
                                            "type": ["number","null"]
                                        },
                                        "vrratsusp": {
                                            "required": false,
                                            "type": ["number","null"]
                                        },
                                        "vrsenarsusp": {
                                            "required": false,
                                            "type": ["number","null"]
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

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '123456';
$std->indapuracao = 1;
$std->perapur = '2017-08';

$std->estabelecimento = new \stdClass();
$std->estabelecimento->nrinscestabrural = '12345678901234';

$std->estabelecimento->tpcomerc[0] = new \stdClass();
$std->estabelecimento->tpcomerc[0]->indcomerc = '2';
$std->estabelecimento->tpcomerc[0]->vrtotcom = 1500.00;

$std->estabelecimento->tpcomerc[0]->ideadquir[0] = new \stdClass();
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->tpinsc = '1';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nrinsc = '12345678';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->vrcomerc = 1500.22;

$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0] = new \stdClass();
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->serie = '12345';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->nrdocto = '1111111111111111111';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->dtemisnf = '2017-08-23';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vlrbruto = 1500.44;
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vrcpdescpr = 1500.55;
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vrratdescpr = 1500.66;
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vrsenardesc = 1500.77;

$std->estabelecimento->tpcomerc[0]->infoprocjud[0] = new \stdClass();
$std->estabelecimento->tpcomerc[0]->infoprocjud[0]->tpproc = 1;
$std->estabelecimento->tpcomerc[0]->infoprocjud[0]->nrproc = '111111111111111111';
$std->estabelecimento->tpcomerc[0]->infoprocjud[0]->codsusp = '11111111111111';


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
