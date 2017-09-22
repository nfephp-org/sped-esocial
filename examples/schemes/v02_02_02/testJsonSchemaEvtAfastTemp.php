<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtAfastTemp';
$version = '02_02_00';

$jsonSchema = '{
    "title": "evtAfastTemp",
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
        "idevinculo": {
            "required": true,
            "type": "object",
            "properties": {
                "cpftrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "nistrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "matricula": {
                    "required": true,
                    "type": "string",
                    "maxLength": 30
                },
                "codcateg": {
                    "required": false,
                    "type": "integer",
                    "maxLength": 3
                }
            }
        },
        "iniafastamento": {
            "required": true,
            "type": "object",
            "properties": {
                "dtiniafast": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "codmotafast": {
                    "required": true,
                    "type": "string",
                    "maxLength": 2
                },
                "infomesmomtv": {
                    "required": false,
                    "type": "string",
                    "pattern": "S|N"
                },
                "tpacidtransito": {
                    "required": false,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "([1-3]){1}$"
                },
                "observacao": {
                    "required": false,
                    "type": "string",
                    "maxLength": 255
                },
                "infoatestado": {
                    "required": false,
                    "type": "array",
                    "minItems": 0,
                    "maxItems": 9,
                    "items": {
                        "type": "object",
                        "properties": {
                            "codcid": {
                                "required": false,
                                "type": "string",
                                "maxLength": 4
                            },
                            "qtddiasafast": {
                                "required": true,
                                "type": "integer",
                                "maxLength": 3
                            },
                            "emitente": {
                                "required": false,
                                "type": "object",
                                "properties": {
                                    "nmemit": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 70
                                    },
                                    "ideoc": {
                                        "required": false,
                                        "type": "integer",
                                        "maxLength": 1,
                                        "pattern": "([1-3]){1}$"
                                    },
                                    "nroc": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 14,
                                        "minLength": 14
                                    },
                                    "ufoc": {
                                        "required": false,
                                        "type": "string",
                                        "maxLength": 2
                                    }
                                }
                            }
                        }
                    }
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
                    "maxLength": 14,
                    "minLength": 14
                },
                "infonus": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "([1-3]){1}$"
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
                    "maxLength": 14,
                    "minLength": 14
                },
                "infonusremun": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "([1-3]){1}$"
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
                    "maxLength": 1,
                    "pattern": "([1-3]){1}$"
                },
                "tpproc": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "([1-2]){1}$"
                },
                "nrproc": {
                    "required": false,
                    "type": "string",
                    "maxLength": 20
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
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "codmotafast": {
                    "required": false,
                    "type": "string",
                    "maxLength": 2
                }
            }
        }
    }
}';

$std             = new \stdClass();
$std->sequencial = 1;
$std->indretif   = 1;

$idevinculo            = new \stdClass();
$idevinculo->cpftrab   = '11111111111';
$idevinculo->nistrab   = '11111111111';
$idevinculo->matricula = '11111111111';

$std->idevinculo = $idevinculo;

$iniafastamento              = new \stdClass();
$iniafastamento->dtiniafast  = '2017-08-21';
$iniafastamento->codmotafast = '01';

$infoatestado[0]               = new \stdClass();
$infoatestado[0]->codcid       = '0101';
$infoatestado[0]->qtddiasafast = 120;

$emitente         = new \stdClass();
$emitente->nmemit = 'NOME DO EMITENTE';
$emitente->ideoc  = 1;
$emitente->nroc   = '11111111111111';
$emitente->ufoc   = 'SP';

$infoatestado[0]->emitente = $emitente;

$iniafastamento->infoatestado = $infoatestado;

$std->iniafastamento = $iniafastamento;

$infocessao           = new \stdClass();
$infocessao->cnpjcess = '11111111111111';
$infocessao->infonus  = 1;

$std->infocessao = $infocessao;

$infomandsind               = new \stdClass();
$infomandsind->cnpjsind     = '11111111111111';
$infomandsind->infonusremun = 1;

$std->infomandsind = $infomandsind;

$inforetif            = new \stdClass();
$inforetif->origretif = 1;
$inforetif->tpproc    = 1;

$std->inforetif = $inforetif;

$fimafastamento              = new \stdClass();
$fimafastamento->dttermafast = '2017-08-21';
$fimafastamento->codmotafast = '01';

$std->fimafastamento = $fimafastamento;

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
file_put_contents("../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
