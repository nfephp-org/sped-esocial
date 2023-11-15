<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1005

//versão S_1.2.0

$evento = 'evtTabEstab';
$version = 'S_01_02_00';

$jsonSchema = '{
    "title": "evtTabEstab",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 99999
        },
        "tpinsc": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 3
        },
        "nrinsc": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{12}|[0-9]{14}$"
        },
        "inivalid": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/periodo"
        },
        "fimvalid": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/periodo"
        },
        "modo": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/modo"
        },
        "dadosestab": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cnaeprep": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/cnae"
                },
                "cnpjresp": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{14}"
                },
                "aliqgilrat": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "aliqrat": {
                            "required": false,
                            "type": ["integer","null"],
                            "minimum": 1,
                            "maximum": 3
                        },
                        "fap": {
                            "required": false,
                            "type": ["number","null"],
                            "minimum": 0.5,
                            "maximum": 2.0000
                        },
                        "procadmjudrat": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "tpproc": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 2
                                },
                                "nrproc": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{17}|.{20}|.{21}$"
                                },
                                "codsusp": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 14,
                                    "pattern": "^[0-9]{1,14}$"
                                }
                            }
                        },
                        "procadmjudfap": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "tpproc": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 4
                                },
                                "nrproc": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{16}|.{17}|.{20}|.{21}$"
                                },
                                "codsusp": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 14,
                                    "pattern": "^[0-9]{1,14}$"
                                }
                            }
                        }
                    }
                },
                "infocaepf": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "tpcaepf": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        }
                    }
                },
                "infoobra": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "indsubstpatrobra": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 2
                        }
                    }
                },
                "infotrab": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "infoapr": {
                            "required": false,
                            "type": ["object", "null"],
                            "properties": {
                                "nrprocjud": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{20}$"
                                },
                                "infoenteduc": {
                                    "required": false,
                                    "type": ["array","null"],
                                    "minItems": 0,
                                    "maxItems": 99,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "nrinsc": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{14}$"
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        "infopdc": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "nrprocjud": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{20}$"
                                }
                            }
                        }
                    }
                }
            }
        },
        "novavalidade": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "inivalid": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/periodo"
                },
                "fimvalid": {
                    "required": false,
                    "type": ["string","null"],
                    "$ref": "#/definitions/periodo"
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;

$std->tpinsc = 1; //obrigatório
//Preencher com o código correspondente ao tipo de inscrição, conforme Tabela 05
//Valores válidos: 1 - CNPJ 3 - CAEPF 4 - CNO

$std->nrinsc = '12345678901234'; //obrigatório
//Informar o número de inscrição do estabelecimento, obra
//de construção civil ou órgão público de acordo com o tipo
//de inscrição indicado no campo ideEstab/tpInsc.
//Validação: Deve ser compatível com o conteúdo do campo
//ideEstab/tpInsc. Deve ser um identificador válido, constante
//das bases da RFB, vinculado ao empregador.

$std->inivalid = '2017-01';  //obrigatório
//Preencher com o mês e ano de início da validade das
//informações prestadas no evento, no formato AAAA-MM.
//Validação: Deve ser uma data válida, igual ou posterior à
//data de início de obrigatoriedade deste evento para o
//empregador no eSocial, no formato AAAA-MM.

$std->fimvalid = '2017-12'; //opcional
//Preencher com o mês e ano de término da validade das
//informações, se houver.
//Validação: Se informado, deve estar no formato AAAA-MM
//e ser um período igual ou posterior a iniValid.


$std->modo = 'INC'; //INC, ALT ou EXC

//dados do estabelecimento
$std->dadosestab = new \stdClass(); //Opcional
$std->dadosestab->cnaeprep = "1234567";
//Preencher com o código CNAE conforme legislação vigente,
//referente à atividade econômica preponderante do
//estabelecimento.
//Validação: Deve ser um número existente na tabela CNAE.

$std->dadosestab->cnpjresp = '12345678901234';
//Preencher com o CNPJ responsável pela inscrição no cadastro de obras da RFB.
//Preenchimento obrigatório e exclusivo por Pessoa Jurídica e
// se {ideEstab/tpInsc}(1005_infoEstab_inclusao_ideEstab_tpInsc) = [4].
// Informação obrigatória se {iniValid}(1005_infoEstab_inclusao_ideEstab_iniValid) >= [2022-04].
//Deve ser um identificador válido, constante das bases da RFB, vinculado ao empregador.

$std->dadosestab->aliqgilrat = new \stdClass();
$std->dadosestab->aliqgilrat->aliqrat = 1;
//Informar a alíquota RAT, quando divergente da legislação
//vigente para a atividade (CNAE) preponderante. A
//divergência só é permitida se existir o grupo com
//informações sobre o processo administrativo/judicial que
//permite a aplicação de alíquota diferente.
//Valores válidos: 1, 2, 3
//Validação: Preenchimento obrigatório e exclusivo se a
//alíquota informada for diferente da definida na legislação
//vigente para o código CNAE informado (neste caso, deverá
//haver informações de processo em procAdmJudRat).
//Se informada, deve ser diferente da alíquota definida na
//legislação vigente para a atividade (CNAE) preponderante.

$std->dadosestab->aliqgilrat->fap = 0.5000; //opcional
//Fator Acidentário de Prevenção - FAP.
//Validação: Preenchimento obrigatório e exclusivo por
//Pessoa Jurídica e ideEstab/tpInsc = [4], ou se ideEstab/tpInsc [1] e o fator
//informado for diferente do definido pelo
//órgão governamental competente para o estabelecimento
//(neste caso, deverá haver informações de processo em procAdmJudFap).
//Se informado, deve ser um número maior ou igual a 0,5000
//e menor ou igual a 2,0000 e, se ideEstab/tpInsc = [1], deve
//ser diferente do valor definido pelo órgão governamental competente.


//campo opcional
$std->dadosestab->aliqgilrat->procadmjudrat = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudrat->tpproc = 1;
//Preencher com o código correspondente ao tipo de processo.
//Valores válidos: 1 - Administrativo 2 - Judicial

$std->dadosestab->aliqgilrat->procadmjudrat->nrproc = '12345678901234567890';
//Informar um número de processo cadastrado através do evento S-1070, cujo indMatProc
//seja igual a [1]. Validação: Deve ser um número de processo administrativo
//ou judicial válido e existente na Tabela de Processos (S-1070), com indMatProc = [1].

$std->dadosestab->aliqgilrat->procadmjudrat->codsusp = '14524578901';
//Código do indicativo da suspensão, atribuído pelo empregador em S-1070.
//Validação: A informação prestada deve estar de acordo com o que foi informado em S-1070.

//campo opcional
$std->dadosestab->aliqgilrat->procadmjudfap = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudfap->tpproc = 1;
//Preencher com o código correspondente ao tipo de processo.
//Valores válidos: 1 - Administrativo 2 - Judicial 4 - Processo FAP de exercício anterior a 2019

$std->dadosestab->aliqgilrat->procadmjudfap->nrproc = '12345678901234567890';
//Informar um número de processo cadastrado através do evento S-1070, cujo indMatProc seja igual a [1].
//Validação: Deve ser um número de processo administrativo ou judicial válido e
//existente na Tabela de Processos (S-1070), com indMatProc = [1].

$std->dadosestab->aliqgilrat->procadmjudfap->codsusp = '123445';
//Código do indicativo da suspensão, atribuído pelo empregador em S-1070.
//Validação: A informação prestada deve estar de acordo com o que foi informado em S-1070.

//campo opcional
$std->dadosestab->infocaepf = new \stdClass();
$std->dadosestab->infocaepf->tpcaepf = 1;
//Tipo de CAEPF. Valores válidos:
//1 - Contribuinte individual
//2 - Produtor rural
//3 - Segurado especial
//Validação: Deve ser compatível com o cadastro da RFB.

//campo opcional
$std->dadosestab->infoobra = new \stdClass();
$std->dadosestab->infoobra->indsubstpatrobra = 1;
//Indicativo de substituição da contribuição patronal de obra de construção civil.
//Valores válidos: 1 - Contribuição patronal substituída 2 - Contribuição patronal não substituída

//campo opcional
$std->dadosestab->infotrab = new \stdClass();
//campo opcional
$std->dadosestab->infotrab->infoapr = new \stdClass();
$std->dadosestab->infotrab->infoapr->nrprocjud = '12345678901234567890';
//Preencher com o número do processo judicial.
//Validação: Se informado, deve ser um número de processo judicial válido.

//campo ARRAY opcional
$std->dadosestab->infotrab->infoapr->infoenteduc[0] = new \stdClass();
$std->dadosestab->infotrab->infoapr->infoenteduc[0]->nrinsc = '12345678901234';
//Informar o número de inscrição da entidade educativa ou de prática desportiva.
//Validação: Deve ser um número de CNPJ válido, com 14 (catorze) algarismos.
//Se o empregador for pessoa jurídica, a raiz do CNPJ informado deve ser diferente de ideEmpregador/nrInsc.

//campo opcional
$std->dadosestab->infotrab->infopdc = new \stdClass();
$std->dadosestab->infotrab->infopdc->nrprocjud = '12345678901234567890';
//Preencher com o número do processo judicial.
//Validação: Deve ser um número de processo judicial válido.

//campo opcional somente deve ser usado em alterações
$std->novavalidade = new \stdClass();
$std->novavalidade->inivalid = '2017-12';
$std->novavalidade->fimvalid = '2018-12';

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
        $std, $jsonSchemaObject
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
