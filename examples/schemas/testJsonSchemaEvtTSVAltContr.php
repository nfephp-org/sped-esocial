<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtTSVAltContr';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtTSVAltContr",
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
        "trabsemvinculo": {
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
                    "required": false,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "codcateg": {
                      "required": true,
                      "type": "integer",
                      "maxLength": 3
                }
            }
        },
        "tsvalteracao": {
            "required": true,
            "type": "object",
            "properties": {
                "dtalteracao": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "natatividade": {
                     "required": false,
                     "type": "integer",
                     "maxLength": 1,
                     "pattern": "([1-2]){1}$"
                }
            }
        },
        "cargofuncao": {
            "required": false,
            "type": "object",
            "properties": {
                "codcargo": {
                      "required": true,
                      "type": "string",
                      "maxLength": 30
                },
                "codfuncao": {
                      "required": false,
                      "type": "string",
                      "maxLength": 30
                }
            }
        },
        "remuneracao": {
            "required": false,
            "type": "object",
            "properties": {
                "vrsalfx": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 14
                },
                "undsalfixo": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "([1-7]){1}$"
                },
                "dscsalvar": {
                    "required": false,
                    "type": "string",
                    "maxLength": 90
                }
            }
        },
        "estagiario": {
            "required": false,
            "type": "object",
            "properties": {
                "natestagio": {
                    "required": true,
                    "type": "string",
                    "maxLength": 1,
                    "pattern": "O|N"
                },
                "nivestagio": {
                     "required": true,
                     "type": "integer",
                     "maxLength": 1,
                     "pattern": "([1|2|3|4|8|9]){1}$"
                },
                "areaatuacao": {
                    "required": false,
                    "type": "string",
                    "maxLength": 50
                },
                "nrapol": {
                    "required": false,
                    "type": "string",
                    "maxLength": 30
                },
                "vlrbolsa": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 14
                },
                "dtprevterm": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "instituicao": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "cnpjinstensino": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 14
                        },
                        "nmrazao": {
                            "required": true,
                            "type": "string",
                            "maxLength": 100
                        },
                        "dsclograd": {
                            "required": false,
                            "type": "string",
                            "maxLength": 80
                        },
                        "nrlograd": {
                            "required": false,
                            "type": "string",
                            "maxLength": 10
                        },
                        "bairro": {
                            "required": false,
                            "type": "string",
                            "maxLength": 60
                        },
                        "cep": {
                            "required": false,
                            "type": "string",
                            "maxLength": 8
                        },
                        "codmunic": {
                            "required": false,
                            "type": "integer",
                            "maxLength": 7
                        },
                        "uf": {
                            "required": false,
                            "type": "string",
                            "minLength": 2,
                            "maxLength": 2
                        }
                    }
                },
                "ageintegracao": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "cnpjagntinteg": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 14
                        },
                        "nmrazao": {
                            "required": true,
                            "type": "string",
                            "maxLength": 100
                        },
                        "dsclograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 80
                        },
                        "nrlograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 10
                        },
                        "bairro": {
                            "required": false,
                            "type": "string",
                            "maxLength": 60
                        },
                        "cep": {
                            "required": true,
                            "type": "string",
                            "maxLength": 8
                        },
                        "codmunic": {
                            "required": false,
                            "type": "integer",
                            "maxLength": 7
                        },
                        "uf": {
                            "required": true,
                            "type": "string",
                            "minLength": 2,
                            "maxLength": 2
                        }
                    }
                },
                "supervisor": {
                    "required": false,
                    "type": "object",
                    "properties": {
                    "cpfsupervisor": {
                            "required": true,
                            "type": "string",
                            "maxLength": 11,
                            "minLength": 11
                        }
                    },
                    "nmsuperv": {
                        "required": true,
                        "type": "string",
                        "maxLength": 70
                    }
                }
            }
        }
    }
}';

$jsonToValidateObject             = new \stdClass();
$jsonToValidateObject->sequencial = 1;
$jsonToValidateObject->indretif   = 1;

$jsonToValidateObject->trabsemvinculo           = new \stdClass();
$jsonToValidateObject->trabsemvinculo->cpftrab  = '11111111111';
$jsonToValidateObject->trabsemvinculo->nistrab  = '11111111111';
$jsonToValidateObject->trabsemvinculo->codcateg = 101;

$jsonToValidateObject->tsvalteracao              = new \stdClass();
$jsonToValidateObject->tsvalteracao->dtalteracao = '2017-08-25';

$jsonToValidateObject->cargofuncao           = new \stdClass();
$jsonToValidateObject->cargofuncao->codcargo = '12345678955';

$jsonToValidateObject->remuneracao             = new \stdClass();
$jsonToValidateObject->remuneracao->vrsalfx    = 1500;
$jsonToValidateObject->remuneracao->undsalfixo = 5;

$jsonToValidateObject->estagiario              = new \stdClass();
$jsonToValidateObject->estagiario->natestagio  = 'O';
$jsonToValidateObject->estagiario->nivestagio  = 1;
$jsonToValidateObject->estagiario->areaatuacao = 'ATUACAO';
$jsonToValidateObject->estagiario->nrapol      = '12345681';
$jsonToValidateObject->estagiario->vlrbolsa    = 1500;
$jsonToValidateObject->estagiario->dtprevterm  = '2017-08-25';

$jsonToValidateObject->estagiario->instituicao                 = new \stdClass();
$jsonToValidateObject->estagiario->instituicao->cnpjinstensino = '11111111111111';
$jsonToValidateObject->estagiario->instituicao->nmrazao        = 'INSTITUICAO';

$jsonToValidateObject->estagiario->ageintegracao                = new \stdClass();
$jsonToValidateObject->estagiario->ageintegracao->cnpjagntinteg = '11111111111111';
$jsonToValidateObject->estagiario->ageintegracao->nmrazao       = 'RAZAO';
$jsonToValidateObject->estagiario->ageintegracao->dsclograd     = 'LOGRADOURO';
$jsonToValidateObject->estagiario->ageintegracao->nrlograd      = 'S/N';
$jsonToValidateObject->estagiario->ageintegracao->bairro        = 'BAIRRO';
$jsonToValidateObject->estagiario->ageintegracao->cep           = '12345789';
$jsonToValidateObject->estagiario->ageintegracao->codmunic      = 3550308;
$jsonToValidateObject->estagiario->ageintegracao->uf            = 'SP';

$jsonToValidateObject->estagiario->supervisor                = new \stdClass();
$jsonToValidateObject->estagiario->supervisor->cpfsupervisor = '11111111111';
$jsonToValidateObject->estagiario->supervisor->nmsuperv      = 'SUPERVISOR';

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
