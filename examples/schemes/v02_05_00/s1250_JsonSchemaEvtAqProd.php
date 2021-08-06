<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1250 sem alterações da 2.4.1 => 2.4.2
//S-1250 v2.5.0
//  Campos {indOpcCP} – criados
//  Grupo {nfs} – alterada condição.
//  Grupo {infoProcJud} – alterada descrição.
//  Criado o grupo {infoProcJ} e respectivos campos.
//  Campos dos grupos {tpAquis}, {ideProdutor}, {nfs} e {infoProcJud} – alterado elemento (para "A").

$evento = 'evtAqProd';
$version = '02_05_00';

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
            "required": false,
            "type": ["string","null"],
            "maxLength": 40
        },
        "indapuracao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 1
        },
        "perapur": {
            "required": true,
            "type": "string",
            "pattern": "^((19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2]))|(19[0-9][0-9]|2[0-9][0-9][0-9])$"
        },
        "ideestabadquir": {
            "required": true,
            "type": "object",
            "properties": {
                "tpinscadq": {
                    "required": true,
                    "type": "integer",
                    "minumum": 1,
                    "maximum": 3
                },
                "nrinscadq": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{14}"
                },
                "tpaquis": {
                    "required": true,
                    "type": "array",
                    "minItems": 1,
                    "maxItems": 6,
                    "items": {
                        "type": "object",
                        "properties": {
                            "indaquis": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 6
                            },
                            "vlrtotaquis": {
                                "required": true,
                                "type": "number"
                            },
                            "ideprodutor": {
                                "required": true,
                                "type": "array",
                                "minItems": 1,
                                "maxItems": 14999,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "tpinscprod": {
                                            "required": true,
                                            "type": "integer",
                                            "minimum": 1,
                                            "maximum": 2
                                        },
                                        "nrinscprod": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^[0-9]{11,14}$"
                                        },
                                        "vlrbruto": {
                                            "required": true,
                                            "type": "number"
                                        },
                                        "vrcpdescpr": {
                                            "required": true,
                                            "type": "number"
                                        },
                                        "vrratdescpr": {
                                            "required": true,
                                            "type": "number"
                                        },
                                        "vrsenardesc": {
                                            "required": true,
                                            "type": "number"
                                        },
                                        "indopccp": {
                                            "required": true,
                                            "type": "integer",
                                            "minimum": 1,
                                            "maximum": 2
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
                                                        "type": ["string","null"],
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
                                                        "type": "string",
                                                        "maxLength": 14
                                                    },
                                                    "vrcpnret": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrratnret": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrsenarnret": {
                                                        "required": true,
                                                        "type": "number"
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            },
                            "infoprocj": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 0,
                                "maxItems": 20,
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
                                        },
                                        "vrcpnret": {
                                            "required": true,
                                            "type": "number"
                                        },
                                        "vrratnret": {
                                            "required": true,
                                            "type": "number"
                                        },
                                        "vrsenarnret": {
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
}';


$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '123456';
$std->indapuracao = 1;
$std->perapur = '2017-08';

$std->ideestabadquir = new \stdClass();
$std->ideestabadquir->tpinscadq = 1;
$std->ideestabadquir->nrinscadq = '11111111111111';

$std->ideestabadquir->tpaquis[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->indaquis = 1;
$std->ideestabadquir->tpaquis[0]->vlrtotaquis = 1500.44;

$std->ideestabadquir->tpaquis[0]->ideprodutor[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->tpinscprod = 1;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nrinscprod = '11111111111111';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->vlrbruto = 1500.44;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->vrcpdescpr = 0.44;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->vrratdescpr = 0.92;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->vrsenardesc = 0.02;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->indopccp = 1;

$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->serie = '12345';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->nrdocto = '11111111111111111111';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->dtemisnf = '2017-08-22';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->vlrbruto = 1500.22;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->vrcpdescpr = 0.33;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->vrratdescpr = 0.55;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->vrsenardesc = 0.66;

$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->nrprocjud = '111111111111111';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->codsusp = '11111111111111';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->vrcpnret = 1500.93;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->vrratnret = 1500.88;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->vrsenarnret = 1500.14;

$std->ideestabadquir->tpaquis[0]->infoprocj[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->nrprocjud = '111111111111111';
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->codsusp = '11111111111111';
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->vrcpnret = 1500.93;
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->vrratnret = 1500.88;
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->vrsenarnret = 1500.14;

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
