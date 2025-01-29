<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1202


$evento = 'evtRmnRPPS';
$version = 'S_01_03_00';

$jsonSchema = '{
    "title": "evtEvtRmnRPPS",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": false,
            "type": [
                "integer",
                "null"
            ],
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
            "type": [
                "string",
                "null"
            ],
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
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "infocomplem": {
            "required": false,
            "type": [
                "object",
                "null"
            ],
            "properties": {
                "nmtrab": {
                    "required": true,
                    "type": "string",
                    "minLength": 2,
                    "maxLength": 70
                },
                "dtnascto": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "sucessaovinc": {
                    "required": false,
                    "type": [
                        "object",
                        "null"
                    ],
                    "properties": {
                        "cnpjorgaoant": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{14}$"
                        },
                        "matricant": {
                            "required": false,
                            "type": [
                                "string",
                                "null"
                            ],
                            "minLength": 1,
                            "maxLength": 30
                        },
                        "dtexercicio": {
                            "required": true,
                            "type": "string",
                            "$ref": "#/definitions/data"
                        },
                        "observacao": {
                            "required": false,
                            "type": [
                                "string",
                                "null"
                            ],
                            "minLength": 1,
                            "maxLength": 255
                        }
                    }
                }
            }
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
                    "codcateg": {
                        "required": true,
                        "type": "string",
                        "pattern": "^[0-9]{3}$"
                    },
                    "indrra": {
                        "required": false,
                        "type": [
                            "string",
                            "null"
                        ],
                        "pattern": "^(S)$"
                    },
                    "inforra": {
                        "required": false,
                        "type": [
                            "object",
                            "null"
                        ],
                        "properties": {
                            "tpprocrra": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 2
                            },
                            "nrprocrra": {
                                "required": false,
                                "type": [
                                    "string",
                                    "null"
                                ],
                                "pattern": "^([0-9]{17}|[0-9]{20}|[0-9]{21}|)$"
                            },
                            "descrra": {
                                "required": true,
                                "type": "string",
                                "minLength": 1,
                                "maxLength": 50
                            },
                            "qtdmesesrra": {
                                "required": true,
                                "type": "number"
                            },
                            "despprocjud": {
                                "required": false,
                                "type": [
                                    "object",
                                    "null"
                                ],
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
                                "minItems": 0,
                                "maxItems": 99,
                                "items": {
                                  "type": "object",
                                  "properties": {
                                     "tpinsc": {
                                     "required": true,
                                                    "type": "integer",
                                                    "minimum": 1,
                                                    "maximum": 6
                                                },
                                                "nrinsc": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^[0-9]{11,14}$"
                                                },
                                                "vlradv": {
                                                    "required": true,
                                                    "type": "number"
                                                }
                                            }
                                        }
                                    }
                        }
                    },
                    "infoperapur": {
                        "required": false,
                        "type": [
                            "object",
                            "null"
                        ],
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
                                        "remunperapur": {
                                            "required": true,
                                            "type": "array",
                                            "minItems": 1,
                                            "maxItems": 8,
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "matricula": {
                                                        "required": false,
                                                        "type": [
                                                            "string",
                                                            "null"
                                                        ],
                                                        "minLength": 1,
                                                        "maxLength": 30
                                                    },
                                                    "itensremun": {
                                                        "required": true,
                                                        "type": "array",
                                                        "minItems": 1,
                                                        "maxItems": 200,
                                                        "items": {
                                                            "type": "object",
                                                            "properties": {
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
                                                                    "type": [
                                                                        "number",
                                                                        "null"
                                                                    ]
                                                                },
                                                                "fatorrubr": {
                                                                    "required": false,
                                                                    "type": [
                                                                        "number",
                                                                        "null"
                                                                    ]
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
                                                                },
                                                                "descfolha": {
                                                                    "required": false,
                                                                    "type": ["object", "null"],
                                                                    "properties": {
                                                                        "tpdesc": { 
                                                                            "required": true,
                                                                            "type": "integer",
                                                                            "minimum": 1,
                                                                            "maximum": 1                                     
                                                                        },
                                                                        "instfinanc": { 
                                                                            "required": true,
                                                                            "type": "string",
                                                                            "pattern":  "^[0-9]{3}$"
                                                                        },
                                                                        "nrdoc": { 
                                                                            "required": true,
                                                                            "type": "string",
                                                                            "minLength": 8,
                                                                            "maxLength": 12
                                                                        },
                                                                        "observacao": { 
                                                                            "required": false,
                                                                            "type": ["string","null"],
                                                                            "maxLength": 255
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
                    },
                    "infoperant": {
                        "required": false,
                        "type": [
                            "object",
                            "null"
                        ],
                        "properties": {
                            "remunorgsuc": {
                                "required": true,
                                "type": "string",
                                "pattern": "^(S|N)$"
                            },
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
                                                    "remumperant": {
                                                        "required": true,
                                                        "type": "array",
                                                        "minItems": 1,
                                                        "maxItems": 8,
                                                        "items": {
                                                            "type": "object",
                                                            "properties": {
                                                                "matricula": {
                                                                    "required": false,
                                                                    "type": [
                                                                        "string",
                                                                        "null"
                                                                    ],
                                                                    "minLength": 1,
                                                                    "maxLength": 30
                                                                },
                                                                "itensremum": {
                                                                    "required": true,
                                                                    "type": "array",
                                                                    "minItems": 1,
                                                                    "maxItems": 200,
                                                                    "items": {
                                                                        "type": "object",
                                                                        "properties": {
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
                                                                                "type": [
                                                                                    "number",
                                                                                    "null"
                                                                                ]
                                                                            },
                                                                            "fatorrubr": {
                                                                                "required": false,
                                                                                "type": [
                                                                                    "number",
                                                                                    "null"
                                                                                ]
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
                    }
                }
            }
        }
    }
}';

$std = new \stdClass();
//$std->sequencial = 1; //Opcional
$std->indretif = 1; //Obritatório
$std->nrrecibo = null;  //Obritatório caso indretif == 2
$std->indapuracao = 1;  //Obritatório
$std->perapur = '2017-08'; //Obritatório
$std->cpftrab = '11111111111'; //Obritatório

//Grupo preenchido quando o evento de remuneração se referir a trabalhador cuja categoria não está sujeita ao
//evento de admissão ou ao evento TSVE - Início, bem como para informar remuneração devida pelo órgão sucessor a
//servidor desligado ainda no sucedido. No caso das categorias em que o evento TSVE - Início for opcional, o
//preenchimento do grupo somente é exigido se não existir o respectivo evento. As informações complementares são
//necessárias para correta identificação do trabalhador.
$std->infocomplem = new \stdClass(); //Opcional
$std->infocomplem->nmtrab = "Jose da Silva"; //Obritatório
$std->infocomplem->dtnascto = "1984-11-16"; //Obritatório

//Grupo de informações da sucessão de vínculo.
$std->infocomplem->sucessaovinc = new \stdClass(); //Opcional
$std->infocomplem->sucessaovinc->cnpjorgaoant = "12345678901234"; //Obritatório
$std->infocomplem->sucessaovinc->matricant = "12345678"; //Opcional
$std->infocomplem->sucessaovinc->dtexercicio = "2021-11-05"; //Obritatório
$std->infocomplem->sucessaovinc->observacao = 'bla bla bla bla bla bla bla bla '; //Opcional


//dentificação de cada um dos demonstrativos de valores devidos ao trabalhador.
$std->dmdev[0] = new \stdClass(); //Obritatório
$std->dmdev[0]->idedmdev = '213789'; //Obritatório
$std->dmdev[0]->codcateg = '103';  //Obritatório

$std->dmdev[0]->indrra = 'S'; //Opcional
//S se houve Rendimentos Recebidos Acumuladamente - RRA
$std->dmdev[0]->inforra = new \stdClass(); //Opcional
//Informações complementares de RRA.
//Informações complementares relativas a Rendimentos Recebidos Acumuladamente - RRA.
//se {indRRA}(../indRRA) = [S]); N nos demais casos
$std->dmdev[0]->inforra->tpprocrra = 1; //Obrigatório
// 1 - Administrativo
// 2 - Judicial
$std->dmdev[0]->inforra->nrprocrra = '12345678901234567'; //Opcional
//Informar o número do processo/requerimento administrativo/judicial.
//Informação obrigatória se {tpProcRRA}(./tpProcRRA) = [2] e opcional se {tpProcRRA}(./tpProcRRA) = [1].
// Deve ser número de processo válido e
//a) Se {tpProcRRA}(./tpProcRRA) = [1], deve possuir 17 (dezessete) ou 21 (vinte e um) algarismos;
//b) Se {tpProcRRA}(./tpProcRRA) = [2], deve possuir 20 (vinte) algarismos.

$std->dmdev[0]->inforra->descrra = 'bla bla bla'; //Obrigatório
//Descrição dos Rendimentos Recebidos Acumuladamente - RRA.

$std->dmdev[0]->inforra->qtdmesesrra = 111.3; //Obrigatório
//Número de meses relativo aos Rendimentos Recebidos Acumuladamente - RRA. de 0 até 999.9

$std->dmdev[0]->inforra->despprocjud = new \stdClass(); //Opcional
//Despesas com processo judicial. Detalhamento das despesas com processo judicial.

$std->dmdev[0]->inforra->despprocjud->vlrdespcustas = 1000;  //Obrigatório
//Preencher com o valor das despesas com custas judiciais.

$std->dmdev[0]->inforra->despprocjud->vlrdespadvogados = 1543.12; //obrigatório
//Preencher com o valor total das despesas com advogado(s).

$std->dmdev[0]->inforra->ideadv[0] = new \stdClass(); //Opcional
//Identificação dos advogados.
$std->dmdev[0]->inforra->ideadv[0]->tpinsc = 1;
//Preencher com o código correspondente ao tipo de inscrição, conforme Tabela 05.
//1 CNPJ
//2 CPF
//3 CAEPF (Cadastro de Atividade Econômica de Pessoa Física)
//4 CNO (Cadastro Nacional de Obra)
//5 CGC
//6 CEI
$std->dmdev[0]->inforra->ideadv[0]->nrinsc = '12345678901';
//Informar o número de inscrição do advogado.
//Deve ser um número de inscrição válido, de acordo com o tipo de inscrição indicado no campo {ideAdv/tpInsc}(./tpInsc),
//considerando as particularidades aplicadas à informação de CNPJ de órgão público em S-1000.
//Se {ideAdv/tpInsc}(./tpInsc) = [1], deve possuir 14 (catorze) algarismos e, no caso de declarante pessoa jurídica,
//ser diferente do CNPJ base do empregador (exceto se {ideEmpregador/nrInsc}(/ideEmpregador_nrInsc) tiver
//14 (catorze) algarismos).
//Se {ideAdv/tpInsc}(./tpInsc) = [2], deve possuir 11 (onze) algarismos e, no caso de declarante pessoa física, ser
//diferente do CPF do empregador.
$std->dmdev[0]->inforra->ideadv[0]->vlradv = 1543.12;

//Informações relativas ao período de apuração.
$std->dmdev[0]->infoperapur = new \stdClass(); //Opcional

//Identificação da unidade do órgão público na qual o servidor possui remuneração.
$std->dmdev[0]->infoperapur->ideestab[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->tpinsc = 1; //Obrigatório somente pode ser 1 - cnpj
$std->dmdev[0]->infoperapur->ideestab[0]->nrinsc = '11111111111111'; //Obrigatório

//Informações relativas à remuneração do trabalhador no período de apuração.
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->matricula = '12365110'; //Opcional

//Rubricas que compõem a remuneração do trabalhador
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->codrubr = '123150'; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->idetabrubr = '12345678'; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->qtdrubr = 1; //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->fatorrubr = 1; //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->vrrubr = 1.00; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->indapurir = 0; //Obrigatório

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha = new \stdClass(); //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha->tpdesc = "1"; //Indicativo do tipo de desconto. Valores válidos: 1 - eConsignado
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha->instfinanc = "123"; //Código da Instituição Financeira concedente do empréstimo.
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha->nrdoc = "12345678111"; //Número do contrato referente ao empréstimo.
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha->observacao = "klasjdkljasdkljaskldj"; //opcional

//Grupo destinado às informações de:
// a) remuneração relativa a diferenças de vencimento provenientes de disposições legais;
// b) verbas de natureza salarial ou não salarial devidas após o desligamento;
// c) decisões administrativas ou judiciais relativas a diferenças de remuneração.
// OBS.: As informações previstas acima podem se referir ao período de apuração definido em perApur ou a períodos anteriores a perApur.
$std->dmdev[0]->infoperant = new \stdClass(); //Opcional
$std->dmdev[0]->infoperant->remunorgsuc = 'S'; //Obrigatório

//Identificação do período ao qual se referem as diferenças de remuneração.
$std->dmdev[0]->infoperant->ideperiodo[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->perref = '2021-10'; //Obrigatório

//Identificação da unidade do órgão público na qual o servidor possui remuneração.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->tpinsc = 1; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->nrinsc = '12345678901234'; //Obrigatório

//nformações relativas à remuneração do trabalhador em períodos anteriores.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->matricula = '123456'; //Opcional

//Rubricas que compõem a remuneração do trabalhador.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->codrubr = '123150'; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->idetabrubr = '12345678'; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->qtdrubr = 1;  //Opcional
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->fatorrubr = 1; //Opcional
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->vrrubr = 1; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->indapurir = 0; //Obrigatório


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
$definitions = realpath(__DIR__ . "/../../../jsonSchemes/definitions.schema");
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
