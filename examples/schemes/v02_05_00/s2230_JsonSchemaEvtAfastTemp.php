<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2230 de 02_04_01 para 02_04_02
//Campos {nrProc} – alterado tamanho. 20->21
//Grupo {emitente} – alteradas ocorrência e condição.
//Campo {dtIniAfast} – alterada validação da alínea a).
//Campo {dtTermAfast} – alterada validação da alínea b).

//S-2230 sem alterações significativas de 02_04_02 para 02_05_00

$evento = 'evtAfastTemp';
$version = '02_05_00';

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
        "nrrecibo": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 40
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
                "nistrab": {
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
                    "type": "integer",
                    "maxLength": 3
                }
            }
        },
        "iniafastamento": {
            "required": false,
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
                    "pattern": "^(S|N)$"
                },
                "tpacidtransito": {
                    "required": false,
                    "type": "integer",
                    "minumum": 1,
                    "maximum": 3
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
                                        "required": true,
                                        "type": "integer",
                                        "minumum": 1,
                                        "maximum": 3
                                    },
                                    "nroc": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^.{2,14}$"
                                    },
                                    "ufoc": {
                                        "required": false,
                                        "type": "string",
                                        "pattern": "^.{2}$"
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
                    "required": true,
                    "type": "integer",
                    "minumum": 1,
                    "maximum": 2
                },
                "nrproc": {
                    "required": false,
                    "type": "string",
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
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        }
    }
}';


$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1234567890';

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

//Opcional 1 ou Opcional 2 ou Opcional 3
$std->iniafastamento = new \stdClass();
$std->iniafastamento->dtiniafast = '2017-08-21';
$std->iniafastamento->codmotafast = '01';
$std->iniafastamento->infomesmomtv = 'N';
$std->iniafastamento->tpacidtransit = 3;
$std->iniafastamento->observacao = 'blablablabla';

$std->iniafastamento->infoatestado[0] = new \stdClass();
$std->iniafastamento->infoatestado[0]->codcid = '0101';
$std->iniafastamento->infoatestado[0]->qtddiasafast = 120;

$std->iniafastamento->infoatestado[0]->emitente = new \stdClass();
$std->iniafastamento->infoatestado[0]->emitente->nmemit = 'NOME DO EMITENTE';
$std->iniafastamento->infoatestado[0]->emitente->ideoc = 1;
$std->iniafastamento->infoatestado[0]->emitente->nroc = '11111111111111';
$std->iniafastamento->infoatestado[0]->emitente->ufoc = 'SP';

$std->iniafastamento->infocessao = new \stdClass();
$std->iniafastamento->infocessao->cnpjcess = '11111111111111';
$std->iniafastamento->infocessao->infonus = 1;

$std->iniafastamento->infomandsind = new \stdClass();
$std->iniafastamento->infomandsind->cnpjsind = '11111111111111';
$std->iniafastamento->infomandsind->infonusremun = 1;

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
