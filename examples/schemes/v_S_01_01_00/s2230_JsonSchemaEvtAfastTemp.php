<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2230

$evento = 'evtAfastTemp';
$version = 'S_01_01_00';

$jsonSchema = '{
    "title": "evtAfastTemp",
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
        "idevinculo": {
            "required": true,
            "type": "object",
            "properties": {
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
                    "type": ["integer","null"],
                    "maxLength": 3
                }
            }
        },
        "iniafastamento": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtiniafast": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "codmotafast": {
                    "required": true,
                    "type": "string",
                    "maxLength": 2
                },
                "infomesmomtv": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(S|N)$"
                },
                "tpacidtransito": {
                    "required": false,
                    "type": ["integer","null"],
                    "minumum": 1,
                    "maximum": 3
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 255
                },
                "peraquis": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "dtinicio": {
                            "required": true,
                            "type": "string",
                            "$ref": "#/definitions/data"
                        },
                        "dtfim": {
                            "required": false,
                            "type": ["string","null"],
                            "$ref": "#/definitions/data"
                        }
                    }
                },
                "infocessao": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "cnpjcess": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{14}$"
                        },
                        "infonus": {
                            "required": true,
                            "type": "integer",
                            "minumum": 1,
                            "maximum": 3
                        }
                    }
                },
                "infomandsind": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "cnpjsind": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{14}$"
                        },
                        "infonusremun": {
                            "required": true,
                            "type": "integer",
                            "minumum": 1,
                            "maximum": 3
                        }
                    }
                },
                "infomandelet": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "cnpjmandelet": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{14}$"
                        },
                        "indremuncargo": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^(S|N)$"
                        }
                    }
                }
            }
        },
        "inforetif": {
            "required": false,
            "type": "object",
            "properties": {
                "origretif": {
                    "required": true,
                    "type": "integer",
                    "minumum": 1,
                    "maximum": 3
                },
                "tpproc": {
                    "required": false,
                    "type": ["integer","null"],
                    "minumum": 1,
                    "maximum": 3
                },
                "nrproc": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 21
                }
            }
        },
        "fimafastamento": {
            "required": false,
            "type": "object",
            "properties": {
                "dttermafast": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789';

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

//Opcional 1 ou Opcional 2 ou Opcional 3
$std->iniafastamento = new \stdClass();
$std->iniafastamento->dtiniafast = '2017-08-21';
$std->iniafastamento->codmotafast = '01';
$std->iniafastamento->infomesmomtv = 'N';
$std->iniafastamento->tpacidtransit = 3;
$std->iniafastamento->observacao = 'blablablabla';

$std->iniafastamento->peraquis = new \stdClass();
$std->iniafastamento->peraquis->dtinicio = '2016-08-21';
$std->iniafastamento->peraquis->dtfim = '2017-08-20';

$std->iniafastamento->infocessao = new \stdClass();
$std->iniafastamento->infocessao->cnpjcess = '11111111111111';
$std->iniafastamento->infocessao->infonus = 1;

$std->iniafastamento->infomandsind = new \stdClass();
$std->iniafastamento->infomandsind->cnpjsind = '11111111111111';
$std->iniafastamento->infomandsind->infonusremun = 1;

$std->iniafastamento->infomandelet = new \stdClass();
$std->iniafastamento->infomandelet->cnpjmandelet = '11111111111111';
$std->iniafastamento->infomandelet->indremuncargo = 'N';

//Opcional 2
$std->inforetif = new \stdClass();
$std->inforetif->origretif = 1;
$std->inforetif->tpproc = 1;
$std->inforetif->nrproc = '1234567890';

//Opcional 3
$std->fimafastamento = new \stdClass();
$std->fimafastamento->dttermafast = '2017-08-21';

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
