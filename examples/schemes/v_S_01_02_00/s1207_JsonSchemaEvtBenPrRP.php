<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1207


$evento = 'evtBenPrRP';
$version = 'S_01_02_00';

$jsonSchema = '{
    "title": "evtBenPrRP",
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
        "indapuracao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "perapur": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/periodo"
        },
        "cpfbenef": {
            "required": true,
            "type": "string",
            "maxLength": 11,
            "minLength": 11
        },
        "dmdev": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 999,
            "items": {
                "type": "object",
                "properties": {
                    "idedmdev": {
                        "required": true,
                        "type": "string",
                        "minLength": 1,
                        "maxLength": 30
                    },
                    "nrbeneficio": {
                        "required": true,
                        "type": "string",
                        "minLength": 1,
                        "maxLength": 20
                    },
                    "indrra": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^(S)$"
                    },
                    "inforra": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "tpprocrra": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 2
                            },
                            "nrprocrra": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{17}|[0-9]{20}|[0-9]{21}$"
                            },
                            "descrra": {
                                "required": true,
                                "type": "string",
                                "minLength": 1,
                                "maxLength": 50
                            },
                            "qtdmesesrra": {
                                "required": true,
                                "type": "number",
                                "minimum": 0,
                                "maximum": 999.9
                            },
                            "despprocjud": {
                                "required": false,
                                "type": ["object","null"],
                                "properties": {
                                    "vlrdespcustas": {
                                        "required": true,
                                        "type": "number"
                                    },
                                    "vlrdespadvogados": {
                                        "required": true,
                                        "type": "number"
                                    }
                                }
                            },
                            "ideadv": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 1,
                                "maxItems": 99,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "tpinsc": {
                                            "required": true,
                                            "type": "integer",
                                            "minimum": 1,
                                            "maximum": 2
                                        },
                                        "nrinsc": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^([0-9]{11}|[0-9]{14})$"
                                        }
                                    }
                                }
                            }
                        }
                    },
                    "infoperapur": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "ideestab": {
                                "required": true,
                                "type": "array",
                                "minItems": 1,
                                "maxItems": 500,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "tpinsc": {
                                            "required": true,
                                            "type": "integer",
                                            "minimum": 1,
                                            "maximum": 1
                                        },
                                        "nrinsc": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^[0-9]{14}$"
                                        },
                                        "itensremun": {
                                            "codrubr": {
                                                "required": true,
                                                "type": "string",
                                                "minLength": 1,
                                                "maxLength": 30
                                            },
                                            "idetabrubr": {
                                                "required": true,
                                                "type": "string",
                                                "minLength": 1,
                                                "maxLength": 8
                                            },
                                            "qtdrubr": {
                                                "required": false,
                                                "type": ["number","null"]
                                            },
                                            "fatorrubr": {
                                                "required": false,
                                                "type": ["number","null"]
                                            },
                                            "vrrubr": {
                                                "required": true,
                                                "type": "number"
                                            },
                                            "indapurir": {
                                                "required": true,
                                                "type": "integer",
                                                "minimum": 0,
                                                "maximum": 1
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    },
                    "infoperaant": {
                        "required": false,
                        "type": "object",
                        "properties": {
                            "ideperiodo": {
                                "required": true,
                                "type": "array",
                                "minItems": 1,
                                "maxItems": 180,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "perref": {
                                            "required": true,
                                            "type": "string",
                                            "$ref": "#/definitions/periodo"
                                        },
                                        "ideestab": {
                                            "required": true,
                                            "type": "array",
                                            "minItems": 1,
                                            "maxItems": 500,
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "tpinsc": {
                                                        "required": true,
                                                        "type": "integer",
                                                        "minimum": 1,
                                                        "maximum": 1
                                                    },
                                                    "nrinsc": {
                                                        "required": true,
                                                        "type": "string",
                                                        "pattern": "^[0-9]{14}$"
                                                    },
                                                    "itensremun": {
                                                        "codrubr": {
                                                            "required": true,
                                                            "type": "string",
                                                            "minLength": 1,
                                                            "maxLength": 30
                                                        },
                                                        "idetabrubr": {
                                                            "required": true,
                                                            "type": "string",
                                                            "minLength": 1,
                                                            "maxLength": 8
                                                        },
                                                        "qtdrubr": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "fatorrubr": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "vrrubr": {
                                                            "required": true,
                                                            "type": "number"
                                                        },
                                                        "indapurir": {
                                                            "required": true,
                                                            "type": "integer",
                                                            "minimum": 0,
                                                            "maximum": 1
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
    }
}';

$std = new \stdClass();
//$std->sequencial = 1; //Opcional
$std->indretif = 1;  //Obrigatório
$std->nrrecibo = null; //Opcional
$std->indapuracao = 1;  //Obrigatório
$std->perapur = '2017-08';  //Obrigatório
$std->cpfbenef = '11111111111';  //Obrigatório

//dentificação de cada um dos demonstrativos de valores devidos ao beneficiário.
$std->dmdev[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->idedmdev = '11111111111111111111'; //Obrigatório
$std->dmdev[0]->nrbeneficio = '11111111111111111111'; //Obrigatório

$std->dmdev[0]->indrra = 'S'; //S ou null
$std->dmdev[0]->inforra = new \stdClass(); //Opcional se indRRA for NULL
$std->dmdev[0]->inforra->tpprocrra = 1; //Obrigatorio 1 -Administrativo  ou 2 - judicial
$std->dmdev[0]->inforra->nrprocrra = '12345678901234567'; //Obrigatório
$std->dmdev[0]->inforra->descrra = 'Descrição do RRA'; //Obrigatório até 50 caracteres
$std->dmdev[0]->inforra->qtdmesesrra = 1; //Obrigatório de 9 atá 999.9
$std->dmdev[0]->inforra->despprocjud = new \stdClass(); //Opcional
$std->dmdev[0]->inforra->despprocjud->vlrdespcustas = 100.00; //Obrigatório
$std->dmdev[0]->inforra->despprocjud->vlrdespadvogados = 5000.00;  //Obrigatório
$std->dmdev[0]->inforra->ideadv[0] =  new \stdClass(); //Opcional até 1 até 99
$std->dmdev[0]->inforra->ideadv[0]->tpinsc = 1; //Obrigatório 1-CNPJ ou 2-CPF
$std->dmdev[0]->inforra->ideadv[0]->nrinsc = '12345678901234'; //Obrigatório


//Informações relativas ao período de apuração.
$std->dmdev[0]->infoperapur = new \stdClass(); //Opcional

//Identificação da unidade do órgão público na qual o beneficiário possui provento ou pensão.
$std->dmdev[0]->infoperapur->ideestab[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->tpinsc = 1; //Obrigatório e igual a 1
$std->dmdev[0]->infoperapur->ideestab[0]->nrinsc = "12345678901234"; //Obrigatório

//Rubricas que compõem o provento ou pensão do beneficiário.
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->codrubr = "slkjskjskj"; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->idetabrubr = "kkkk"; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->qtdrubr = 1; //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->fatorrubr = 2.2; //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->vrrubr = 100; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->indapurir = 0; //Obrigatório

//Grupo destinado às informações relativas a períodos anteriores. Somente preencher esse grupo se houver
//proventos ou pensões retroativos.
$std->dmdev[0]->infoperant = new \stdClass(); //Opcional

$std->dmdev[0]->infoperant->ideperiodo[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->perref = '2011-10'; //Obrigatório

//Identificação da unidade do órgão público na qual o beneficiário possui provento ou pensão.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->tpinsc = 1; //Obrigatório e igual a 1
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->nrinsc = "12345678901234"; //Obrigatório

//Rubricas que compõem o provento ou pensão do beneficiário.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->codrubr = "slkjskjskj"; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->idetabrubr = "kkkk"; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->qtdrubr = 1; //Opcional
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->fatorrubr = 2.2; //Opcional
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->vrrubr = 100; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->indapurir = 0; //Obrigatório

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
