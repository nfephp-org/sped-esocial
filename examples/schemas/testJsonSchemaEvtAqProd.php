<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtAqProd';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtAqProd",
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
            "required": true,
            "type": "string",
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
            "maximum": 1
        },
        "ideestabadquir": {
            "required": true,
            "type": "object",
            "properties": {
                "tpinscadq": {
                    "required": true,
                    "type": "integer",
                    "pattern": "1|3"
                },
                "nrinscadq": {
                    "required": true,
                    "type": "string",
                    "maxLength": 15
                },
                "tpaquis": {
                    "required": true,
                    "type": "array",
                    "minItems": 1,
                    "maxItems": 3,
                    "items": {
                        "type": "object",
                        "properties": {
                            "indaquis": {
                                "required": true,
                                "type": "integer",
                                "maxLength": 1,
                                "pattern": "([1-3]){1}$"
                            },
                            "vlrtotaquis": {
                                "required": true,
                                "type": "integer",
                                "maxLength": 14
                            },
                            "ideprodutor": {
                                "required": true,
                                "type": "array",
                                "minItems": 1,
                                "maxItems": 9999,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "tpinscprod": {
                                            "required": true,
                                            "type": "integer",
                                            "maxLength": 1,
                                            "pattern": "([1-2]){1}$"
                                        },
                                        "nrinscprod": {
                                            "required": true,
                                            "type": "integer",
                                            "maxLength": 14
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
                                        "vrratdescpr": {
                                            "required": true,
                                            "type": "integer",
                                            "maxLength": 14
                                        },
                                        "vrsenardesc": {
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
                                        },
                                        "infoprocjud": {
                                            "required": false,
                                            "type": "array",
                                            "minItems": 0,
                                            "maxItems": 10,
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
                                                        "type": "integer",
                                                        "maxLength": 14
                                                    },
                                                    "vrcpnret": {
                                                        "required": true,
                                                        "type": "integer",
                                                        "maxLength": 14
                                                    },
                                                    "vrratnret": {
                                                        "required": true,
                                                        "type": "integer",
                                                        "maxLength": 14
                                                    },
                                                    "vrsenarnret": {
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
                    }
                }
            }
        }
        
    }
}';


$jsonToValidateObject              = new \stdClass();
$jsonToValidateObject->sequencial  = 1;
$jsonToValidateObject->indretif    = 1;
$jsonToValidateObject->nrrecibo    = '123456';
$jsonToValidateObject->indapuracao = 1;
$jsonToValidateObject->perapur     = '2017-08';

$ideestabadquir            = new \stdClass();
$ideestabadquir->tpinscadq = 1;
$ideestabadquir->nrinscadq = '11111111111111';

$tpaquis[0]              = new \stdClass();
$tpaquis[0]->indaquis    = 1;
$tpaquis[0]->vlrtotaquis = 1500;

$ideprodutor[0]              = new \stdClass();
$ideprodutor[0]->tpinscprod  = 1;
$ideprodutor[0]->nrinscprod  = '11111111111111';
$ideprodutor[0]->vlrbruto    = 1500;
$ideprodutor[0]->vrcpdescpr  = 0;
$ideprodutor[0]->vrratdescpr = 0;
$ideprodutor[0]->vrsenardesc = 0;

$nfs[0]              = new \stdClass();
$nfs[0]->serie       = '12345';
$nfs[0]->nrdocto     = '11111111111111111111';
$nfs[0]->dtemisnf    = '2017-08-22';
$nfs[0]->vlrbruto    = 1500;
$nfs[0]->vrcpdescpr  = 0;
$nfs[0]->vrratdescpr = 0;
$nfs[0]->vrsenardesc = 0;

$ideprodutor[0]->nfs = $nfs;

$infoprocjud[0]              = new \stdClass();
$infoprocjud[0]->nrprocjud   = '111111111111111';
$infoprocjud[0]->codsusp     = '11111111111111';
$infoprocjud[0]->vrcpnret    = 1500;
$infoprocjud[0]->vrratnret   = 1500;
$infoprocjud[0]->vrsenarnret = 1500;

$ideprodutor[0]->infoprocjud = $infoprocjud;

$tpaquis[0]->ideprodutor = $ideprodutor;

$ideestabadquir->tpaquis = $tpaquis;

$jsonToValidateObject->ideestabadquir = $ideestabadquir;

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
    $jsonToValidateObject,
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
file_put_contents("../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
