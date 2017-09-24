<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtComProd';
$version = '02_04_00';

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
                    "maxLength": 15
                },
                "indcomerc": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "2|3|8|9"
                },
                "vrtotcom": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 14
                },
                "ideadquir": {
                    "required": false,
                    "type": "array",
                    "minItems": 0,
                    "maxItems": 9999,
                    "items": {
                        "type": "object",
                        "properties": {
                            "tpinsc": {
                                "required": true,
                                "type": "integer",
                                "maxLength": 1,
                                "pattern": "([1-2]){1}$"
                            },
                            "nrinsc": {
                                "required": true,
                                "type": "string",
                                "minLength": 8,
                                "maxLength": 15,
                                "pattern": "^[0-9]"
                            },
                            "vrcomerc": {
                                "required": true,
                                "type": "integer",
                                "maxLength": 14
                            },
                            "nfs": {
                                "required": false,
                                "type": "array",
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
                                            "type": "integer",
                                            "maxLength": 14
                                        },
                                        "vrcpdescpr": {
                                            "required": true,
                                            "type": "integer",
                                            "maxLength": 14
                                        },
                                        "vrsenardesc": {
                                            "required": true,
                                            "type": "integer",
                                            "maxLength": 14
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        },
        "infoprocjud": {
            "required": false,
            "type": "array",
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
                        "maxLength": 20
                    },
                    "codsusp": {
                        "required": true,
                        "type": "string",
                        "maxLength": 14,
                        "pattern": "^[0-9]"
                    },
                    "vrcpsusp": {
                        "required": false,
                        "type": "integer",
                        "maxLength": 14
                    },
                    "vrratsusp": {
                        "required": false,
                        "type": "integer",
                        "maxLength": 14
                    },
                    "vrsenarsusp": {
                        "required": false,
                        "type": "integer",
                        "maxLength": 14
                    }
                }
            }
        }
    }
}';

$std              = new \stdClass();
$std->sequencial  = 1;
$std->indretif    = 1;
$std->nrrecibo    = '123456';
$std->indapuracao = 1;
$std->perapur     = '2017-08';

$estabelecimento                   = new \stdClass();
$estabelecimento->nrinscestabrural = '111111111111111';
$estabelecimento->indcomerc        = 2;
$estabelecimento->vrtotcom         = 1500;

$ideadquir[0]           = new \stdClass();
$ideadquir[0]->tpinsc   = 1;
$ideadquir[0]->nrinsc   = '111111111111111';
$ideadquir[0]->vrcomerc = 1500;

$nfs[0]              = new \stdClass();
$nfs[0]->serie       = '12345';
$nfs[0]->nrdocto     = '1111111111111111111';
$nfs[0]->dtemisnf    = '2017-08-23';
$nfs[0]->vlrbruto    = 1500;
$nfs[0]->vrcpdescpr  = 1500;
$nfs[0]->vrratdescpr = 1500;
$nfs[0]->vrsenardesc = 1500;

$ideadquir[0]->nfs = $nfs;

$estabelecimento->ideadquir = $ideadquir;

$std->estabelecimento = $estabelecimento;

$infoprocjud[0]          = new \stdClass();
$infoprocjud[0]->tpproc  = 1;
$infoprocjud[0]->nrproc  = '111111111111111111';
$infoprocjud[0]->codsusp = '11111111111111';

$std->infoprocjud = $infoprocjud;

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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
