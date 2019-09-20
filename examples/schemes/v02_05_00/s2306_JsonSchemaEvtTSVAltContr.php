<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2306
//Grupos {cargoFuncao} – alterada condição.
//Grupos {remuneracao} – alterada condição.
//Grupo {ideTrabSemVinculo} – inserido campo {codCateg} como chave.
//Grupo {infoTSVAlteracao} – inserido campo {dtAlteracao} como chave.

$evento = 'evtTSVAltContr';
$version = '02_05_00';

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
        "nrrecibo": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 40
        },
        "trabsemvinculo": {
            "required": true,
            "type": "object",
            "properties": {
                "cpftrab": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{11}$"
                },
                "nistrab": {
                    "required": false,
                    "type": "string",
                    "pattern": "^[0-9]{11}$"
                },
                "codcateg": {
                      "required": true,
                      "type": "string",
                      "pattern": "^[0-9]{3}$"
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
                    "type": "number"
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
                    "maxLength": 255
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
                    "pattern": "^(O|N)$"
                },
                "nivestagio": {
                     "required": true,
                     "type": "integer",
                     "minimum": 1,
                     "maximum": 9
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
                    "type": "number"
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
                            "type": "string",
                            "pattern": "^[0-9]{14}$"
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
                            "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
                        }
                    }
                },
                "ageintegracao": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "cnpjagntinteg": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{14}$"
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
                            "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
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
                            "pattern": "^[0-9]{11}$"
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

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 2;
$std->nrrecibo = '292929jdjdkjananananannana';

$std->trabsemvinculo = new \stdClass();
$std->trabsemvinculo->cpftrab = '11111111111';
$std->trabsemvinculo->nistrab = '11111111111';
$std->trabsemvinculo->codcateg = '101';

$std->tsvalteracao = new \stdClass();
$std->tsvalteracao->dtalteracao = '2017-08-25';

$std->cargofuncao = new \stdClass();
$std->cargofuncao->codcargo = '12345678955';

$std->remuneracao = new \stdClass();
$std->remuneracao->vrsalfx = 1500;
$std->remuneracao->undsalfixo = 5;

$std->estagiario = new \stdClass();
$std->estagiario->natestagio = 'O';
$std->estagiario->nivestagio = 1;
$std->estagiario->areaatuacao = 'ATUACAO';
$std->estagiario->nrapol = '12345681';
$std->estagiario->vlrbolsa = 1500;
$std->estagiario->dtprevterm = '2017-08-25';

$std->estagiario->instituicao = new \stdClass();
$std->estagiario->instituicao->cnpjinstensino = '11111111111111';
$std->estagiario->instituicao->nmrazao = 'INSTITUICAO';

$std->estagiario->ageintegracao = new \stdClass();
$std->estagiario->ageintegracao->cnpjagntinteg = '11111111111111';
$std->estagiario->ageintegracao->nmrazao = 'RAZAO';
$std->estagiario->ageintegracao->dsclograd = 'LOGRADOURO';
$std->estagiario->ageintegracao->nrlograd = 'S/N';
$std->estagiario->ageintegracao->bairro = 'BAIRRO';
$std->estagiario->ageintegracao->cep = '12345789';
$std->estagiario->ageintegracao->codmunic = 3550308;
$std->estagiario->ageintegracao->uf = 'SP';

$std->estagiario->supervisor = new \stdClass();
$std->estagiario->supervisor->cpfsupervisor = '11111111111';
$std->estagiario->supervisor->nmsuperv = 'SUPERVISOR';

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
