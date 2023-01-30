<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2306

$evento = 'evtTSVAltContr';
$version = 'S_01_01_00';

$jsonSchema = '{
    "title": "evtTSVAltContr",
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
        "trabsemvinculo": {
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
                    "pattern": "^.{1,30}$"
                },
                "codcateg": {
                    "required": false,
                    "type": ["string","null"],
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
                    "$ref": "#/definitions/data"
                },
                "natatividade": {
                    "required": false,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                }
            }
        },
        "cargofuncao": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nmcargo": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 100
                },
                "cbocargo": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{6}$"
                },
                "nmfuncao": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 100
                },
                "cbofuncao": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{6}$"
                }
            }
        },
        "remuneracao": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "vrsalfx": {
                    "required": true,
                    "type": "number"
                },
                "undsalfixo": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 7
                },
                "dscsalvar": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 999
                }
            }
        },
        "dirigentesindical": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tpregprev": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                }
            }
        },
        "trabcedido": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tpregprev": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                }
            }
        },
        "mandelelt": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "indremuncargo": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(S|N)$"
                },
                "tpregprev": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                }
            }
        },
        "estagiario": {
            "required": false,
            "type": ["object","null"],
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
                    "type": ["string","null"],
                    "maxLength": 100
                },
                "nrapol": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 30
                },
                "dtprevterm": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "instensino": {
                    "required": true,
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
                            "type": ["string","null"],
                            "maxLength": 100
                        },
                        "nrlograd": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 10
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 90
                        },
                        "cep": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{8}$"
                        },
                        "codmunic": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{7}$"
                        },
                        "uf": {
                            "required": false,
                            "type": "string",
                            "$ref": "#/definitions/siglauf"
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
                        }
                    }
                },
                "supervisor": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "cpfsupervisor": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{11}$"
                        }
                    }
                }
            }
        }
    }
}';


$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 2;
$std->nrrecibo = '1.1.1234567890123456789';

$std->trabsemvinculo = new \stdClass();
$std->trabsemvinculo->cpftrab = '11111111111';
$std->trabsemvinculo->matricula = 'ABC11111111111';
$std->trabsemvinculo->codcateg = '101';

$std->tsvalteracao = new \stdClass();
$std->tsvalteracao->dtalteracao = '2017-08-25';
$std->tsvalteracao->natatividade = 1;

$std->cargofuncao = new \stdClass();
$std->cargofuncao->nmcargo = 'Empilhador de caixas';
$std->cargofuncao->cbocargo = '123456';
$std->cargofuncao->nmfuncao = 'Empilhador de caixas';
$std->cargofuncao->cbofuncao = '123456';

$std->remuneracao = new \stdClass();
$std->remuneracao->vrsalfx = 1500;
$std->remuneracao->undsalfixo = 6;
$std->remuneracao->dscsalvar = 'desc salario variavel';

$std->dirigentesindical = new \stdClass();
$std->dirigentesindical->tpregprev = 1;

$std->trabcedido = new \stdClass();
$std->trabcedido->tpregprev = 1;

$std->mandelet = new \stdClass();
$std->mandelet->indremuncargo = 'S';
$std->mandelet->tpregprev = 1;

$std->estagiario = new \stdClass();
$std->estagiario->natestagio = 'O';
$std->estagiario->nivestagio = 1;
$std->estagiario->areaatuacao = 'ATUACAO';
$std->estagiario->nrapol = '12345681';
$std->estagiario->vlrbolsa = 1500;
$std->estagiario->dtprevterm = '2017-08-25';

$std->estagiario->instensino = new \stdClass();
$std->estagiario->instensino->cnpjinstensino = '11111111111111';
$std->estagiario->instensino->nmrazao = 'INSTITUICAO DE ENSINO';
$std->estagiario->instensino->dsclograd = 'lrogradouro';
$std->estagiario->instensino->nrlograd = "numero";
$std->estagiario->instensino->bairro = "bairro";
$std->estagiario->instensino->cep = "12345678";
$std->estagiario->instensino->codmunic = "1234567";
$std->estagiario->instensino->uf = "AC";

$std->estagiario->ageintegracao = new \stdClass();
$std->estagiario->ageintegracao->cnpjagntinteg = '11111111111111';

$std->estagiario->supervisor = new \stdClass();
$std->estagiario->supervisor->cpfsupervisor = '11111111111';


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
