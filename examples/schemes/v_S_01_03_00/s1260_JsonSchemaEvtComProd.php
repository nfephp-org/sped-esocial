<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1260

$evento = 'evtComProd';
$version = 'S_01_03_00';

$jsonSchema = '{
    "title": "evtComProd",
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
        "perapur": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/periodo"
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
                                "pattern": "^(2|3|7|8|9)$"
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
                                            "pattern": "^([0-9]{11}|[0-9]{14})$"
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
                                            "pattern": "^([0-9]{17}|[0-9]{20}|[0-9]{21})$"
                                        },
                                        "codsusp": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^[0-9]{1,14}$"
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
//$std->sequencial = 1; //Opcional
$std->indretif = 1; //Obrigatório
$std->nrrecibo = "1.7.1234567890123456789"; //Obrigatório caso indretif = 2
$std->perapur = '2017-08'; //Obrigatório
$std->indgia = 1; //Opcional

//Identificação do estabelecimento que comercializou a produção.
$std->estabelecimento = new \stdClass(); //Obrigatório
$std->estabelecimento->nrinscestabrural = '12345678901234'; //Obrigatório

//Valor total da comercialização por "tipo" de comercialização
$std->estabelecimento->tpcomerc[0] = new \stdClass(); //Obrigatório
$std->estabelecimento->tpcomerc[0]->indcomerc = '2'; //Obrigatório
$std->estabelecimento->tpcomerc[0]->vrtotcom = 1500.00; //Obrigatório

//Identificação dos adquirentes da produção.
$std->estabelecimento->tpcomerc[0]->ideadquir[0] = new \stdClass(); //Opcional
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->tpinsc = '1'; //Obrigatório
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nrinsc = '12345678901234'; //Obrigatório
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->vrcomerc = 1500.22; //Obrigatório

//Detalhamento das notas fiscais relativas à comercialização
//de produção com o adquirente identificado no grupo superior.
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0] = new \stdClass(); //Opcional
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->serie = '12345'; //Opcional
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->nrdocto = '1111111111111111111'; //Obrigatório
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->dtemisnf = '2017-08-23'; //Obrigatório
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vlrbruto = 1500.44; //Obrigatório
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vrcpdescpr = 1500.55; //Obrigatório
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vrratdescpr = 1500.66; //Obrigatório
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vrsenardesc = 1500.77; //Obrigatório

//Informações de processos judiciais com decisão/sentença
//favorável ao contribuinte e relativos à contribuição
//incidente sobre a comercialização.
$std->estabelecimento->tpcomerc[0]->infoprocjud[0] = new \stdClass(); //Opcional
$std->estabelecimento->tpcomerc[0]->infoprocjud[0]->tpproc = 1; //Obrigatório
$std->estabelecimento->tpcomerc[0]->infoprocjud[0]->nrproc = '12345678901234567'; //Obrigatório
$std->estabelecimento->tpcomerc[0]->infoprocjud[0]->codsusp = '11111111111111'; //Obrigatório


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
