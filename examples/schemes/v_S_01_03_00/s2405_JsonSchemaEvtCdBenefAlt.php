<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2405


$evento  = 'evtCdBenefAlt';
$version = 'S_01_03_00';

$jsonSchema = '{
    "title": "evtCdBenefAlt",
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
        "cpfbenef": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "dtalteracao": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "dadosbenef": {
            "required": true,
            "type": "object",
            "properties": {
                "nmbenefic": {
                    "required": true,
                    "type": "string",
                    "pattern": "^.{2,70}$"
                },
                "sexo": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(M|F)$"
                },
                "racacor": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 6
                },
                "estciv": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 5
                },
                "incfismen": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "endereco": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "brasil": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "tplograd": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{1,4}$"
                                },
                                "dsclograd": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{1,100}$"
                                },
                                "nrlograd": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{1,10}$"
                                },
                                "complemento": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{1,30}$"
                                },
                                "bairro": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{1,90}$"
                                },
                                "cep": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{8}$"
                                },
                                "codmunic": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{7}$"
                                },
                                "uf": {
                                    "required": true,
                                    "type": "string",
                                    "$ref": "#/definitions/siglauf"
                                }
                            }
                        },
                        "exterior": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "paisresid": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{3}$"
                                },
                                "dsclograd": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{1,100}$"
                                },
                                "nrlograd": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{1,10}$"
                                },
                                "complemento": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{1,30}$"
                                },
                                "bairro": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{1,90}$"
                                },
                                "nmcid": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{2,50}$"
                                },
                                "codpostal": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{4,12}$"
                                }
                            }
                        }
                    }
                },
                "dependente": {
                    "required": false,
                    "type": ["array","null"],
                    "minItems": 0,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "tpdep": {
                                "required": true,
                                "type": "string",
                                "pattern": "^0[1-9]{1}|1[0-2]{1}|99$"
                            },
                            "nmdep": {
                                "required": true,
                                "type": "string",
                                "pattern": "^.{2,70}$"
                            },
                            "dtnascto": {
                                "required": true,
                                "type": "string",
                                "$ref": "#/definitions/data"
                            },
                            "cpfdep": {
                                "required": false,
                                "type": ["string","null"],
                                "pattern": "^[0-9]{11}$"
                            },
                            "sexodep": {
                                "required": true,
                                "type": "string",
                                "pattern": "^(M|F)$"
                            },
                            "depirrf": {
                                "required": true,
                                "type": "string",
                                "pattern": "^(S|N)$"
                            },
                            "incfismen": {
                                "required": true,
                                "type": "string",
                                "pattern": "^(S|N)$"
                            },
                            "descrdep": {
                                "required": false,
                                "type": ["string","null"],
                                "minLength": 1,
                                "maxLength": 1000
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
$std->indretif = 1; //obrigatório
$std->nrrecibo = '1.4.1234567890123456789'; //opcional
$std->cpfbenef = '12345678901'; //obrigatório
$std->dtalteracao = '2021-02-01'; //obrigatório

//campo obrigatório
$std->dadosbenef = new \stdClass();
$std->dadosbenef->nmbenefic = "Fulano de Tal"; //obrigatório
$std->dadosbenef->sexo = 'M';
$std->dadosbenef->racacor = '1';
$std->dadosbenef->estciv = '1';
$std->dadosbenef->incfismen = 'N';

//campo obrigatório
$std->dadosbenef->endereco = new \stdClass();
//campo opcional
$std->dadosbenef->endereco->brasil = new \stdClass();
$std->dadosbenef->endereco->brasil->tplograd = 'AV';
$std->dadosbenef->endereco->brasil->dsclograd = 'UM';
$std->dadosbenef->endereco->brasil->nrlograd = '123';
$std->dadosbenef->endereco->brasil->complemento = 'apto 21';
$std->dadosbenef->endereco->brasil->bairro = 'CENTRO';
$std->dadosbenef->endereco->brasil->cep = '12345678';
$std->dadosbenef->endereco->brasil->codmunic = '1234567';
$std->dadosbenef->endereco->brasil->uf = 'AC';

//campo opcional
/*
$std->dadosbenef->endereco->exterior = new \stdClass();
$std->dadosbenef->endereco->exterior->paisresid = '';
$std->dadosbenef->endereco->exterior->dsclograd = '';
$std->dadosbenef->endereco->exterior->nrlograd = '';
$std->dadosbenef->endereco->exterior->complemento = '';
$std->dadosbenef->endereco->exterior->bairro = '';
$std->dadosbenef->endereco->exterior->nmcid = '';
$std->dadosbenef->endereco->exterior->codpostal = '';
 */

$std->dadosbenef->dependente[0] = new \stdClass();
$std->dadosbenef->dependente[0]->tpdep = '09';
$std->dadosbenef->dependente[0]->nmdep = 'CICLANO DE TAL';
$std->dadosbenef->dependente[0]->dtnascto = '1955-11-27';
$std->dadosbenef->dependente[0]->cpfdep = '12345678901';
$std->dadosbenef->dependente[0]->sexodep = 'M';
$std->dadosbenef->dependente[0]->depirrf = 'S';
$std->dadosbenef->dependente[0]->incfismen = 'S';
$std->dadosbenef->dependente[0]->descrdep = 'Amantegado';


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
file_put_contents("../../../jsonSchemes/v_$version/$evento.schema", $jsonSchema);
