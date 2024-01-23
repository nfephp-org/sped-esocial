<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2299

$evento  = 'evtDeslig';
$version = 'S_01_02_00';

$jsonSchema = '{
    "title": "evtDeslig",
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
        "indguia": {
            "required": false,
            "type": ["integer", "null"],
            "minimum": 1,
            "maximum": 1
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "matricula": {
            "required": true,
            "type": "string",
            "maxLength": 30
        },
        "mtvdeslig": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{2}$"
        },
        "dtdeslig": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "dtavprv": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/data"
        },
        "indpagtoapi": {
            "required": true,
            "type": "string",
            "pattern": "^(S|N)$"
        },
        "dtprojfimapi": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/data"
        },
        "pensalim": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 0,
            "maximum": 3
        },
        "percaliment": {
            "required": false,
            "type": ["number","null"]
        },
        "vralim": {
            "required": false,
            "type": ["number","null"]
        },
        "nrproctrab": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^.{20}$"
        },
        "infoInterm": {
            "required": false,
            "type": ["array", "null"],
            "minItems": 0,
            "maxItems": 31,
            "items": {
                "type": "object",
                "properties": {
                    "dia": {
                        "required": true,
                        "type": "integer",
                        "minimum": 0,
                        "maximum": 31
                    }
                }
            }
        },
        "observacoes": {
            "required": false,
            "type": ["array", "null"],
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "observacao": {
                        "required": true,
                        "type": "string",
                        "maxLength": 255
                    }
                }
            }
        },
        "sucessaovinc": {
            "required": false,
            "type": ["object","null"],
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
                    "pattern": "^[0-9]{11}|[0-9]{14}$"
                }
            }
        },
        "transftit": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cpfsubstituto": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{11}$"
                },
                "dtnascto": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                }
            }
        },
        "mudancacpf": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "novocpf": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{11}$"
                }
            }
        },
        "verbasresc": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dmdev": {
                    "required": true,
                    "type": "array",
                    "minItems": 1,
                    "maxItems": 50,
                    "items": {
                        "type": "object",
                        "properties": {
                            "idedmdev": {
                                "required": true,
                                "type": "string",
                                "maxLength": 30
                            },
                            "indrra": {
                                "required": false,
                                "type": "string",
                                "pattern": "^(S)$"
                            },
                            "infoperapur": {
                                "required": false,
                                "type": ["object","null"],
                                "properties": {
                                    "ideestablot": {
                                        "required": true,
                                        "type": "array",
                                        "minItems": 1,
                                        "maxItems": 24,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "tpinsc": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^(1|3|4)$"
                                                },
                                                "nrinsc": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^[0-9]{12}|[0-9]{14}$"
                                                },
                                                "codlotacao": {
                                                    "required": true,
                                                    "type": "string",
                                                    "minLength": 1,
                                                    "maxLength": 30
                                                },
                                                "detverbas": {
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
                                                                "required": false,
                                                                "type": ["integer","null"],
                                                                "minimum": 0,
                                                                "maximum": 1
                                                            }
                                                        }
                                                    }
                                                },
                                                "infoagnocivo": {
                                                    "required": false,
                                                    "type": ["object","null"],
                                                    "properties": {
                                                        "grauexp": {
                                                            "required": true,
                                                            "type": "integer",
                                                            "minimum": 1,
                                                            "maximum": 4
                                                        }
                                                    }
                                                },
                                                "infosimples": {
                                                    "required": false,
                                                    "type": ["object","null"],
                                                    "properties": {
                                                        "indsimples": {
                                                            "required": true,
                                                            "type": "integer",
                                                            "minimum": 1,
                                                            "maximum": 3
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
                                "type": ["object","null"],
                                "properties": {
                                    "ideadc": {
                                        "required": true,
                                        "type": "array",
                                        "minItems": 1,
                                        "maxItems": 8,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "dtacconv": {
                                                    "required": true,
                                                    "type": "string",
                                                    "$ref": "#/definitions/data"
                                                },
                                                "tpacconv": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^(A|B|C|D|E|G|H|I)$"
                                                },
                                                "dsc": {
                                                    "required": true,
                                                    "type": "string",
                                                    "maxLength": 255
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
                                                            "ideestablot": {
                                                                "required": true,
                                                                "type": "array",
                                                                "minItems": 1,
                                                                "maxItems": 24,
                                                                "items": {
                                                                    "type": "object",
                                                                    "properties": {
                                                                        "tpinsc": {
                                                                            "required": true,
                                                                            "type": "string",
                                                                            "pattern": "^(1|3|4)$"
                                                                        },
                                                                        "nrinsc": {
                                                                            "required": true,
                                                                            "type": "string",
                                                                            "pattern": "^[0-9]{8,14}"
                                                                        },
                                                                        "codlotacao": {
                                                                            "required": true,
                                                                            "type": "string",
                                                                            "maxLength": 30
                                                                        },
                                                                        "detverbas": {
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
                                                                                        "maxLength": 30
                                                                                    },
                                                                                    "idetabrubr": {
                                                                                        "required": true,
                                                                                        "type": "string",
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
                                                                                        "required": false,
                                                                                        "type": ["integer","null"],
                                                                                        "minimum": 0,
                                                                                        "maximum": 1
                                                                                    }
                                                                                }
                                                                            }
                                                                        },
                                                                        "infoagnocivo": {
                                                                            "required": false,
                                                                            "type": ["object","null"],
                                                                            "properties": {
                                                                                "grauexp": {
                                                                                    "required": true,
                                                                                    "type": "integer",
                                                                                    "minimum": 1,
                                                                                    "maximum": 4
                                                                                }
                                                                            }
                                                                        },
                                                                        "infosimples": {
                                                                            "required": false,
                                                                            "type": ["object","null"],
                                                                            "properties": {
                                                                                "indsimples": {
                                                                                    "required": true,
                                                                                    "type": "integer",
                                                                                    "minimum": 1,
                                                                                    "maximum": 3
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
                },
                "procjudtrab": {
                    "required": false,
                    "type": ["array","null"],
                    "minItems": 0,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "tptrib": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 2
                            },
                            "nrprocjud": {
                                "required": true,
                                "type": "string",
                                "pattern": "^.{20}$"
                            },
                            "codsusp": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{1,14}$"
                            }
                        }
                    }
                },
                "infomv": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "indmv": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        },
                        "remunoutrempr": {
                            "required": true,
                            "type": "array",
                            "minItems": 1,
                            "maxItems": 999,
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
                                        "pattern": "^[0-9]{8,14}$"
                                    },
                                    "codcateg": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^[0-9]{3}$"
                                    },
                                    "vlrremunoe": {
                                        "required": true,
                                        "type": "number"
                                    }
                                }
                            }
                        }
                    }
                },
                "procs": {
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
        },
        "remunaposdeslig": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "indremun": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 3
                },
                "dtfimremun": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                }
            }
        },
        "consigfgts": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "insconsig": {
                        "required": true,
                        "type": "string",
                        "minLength": 1,
                        "maxLength": 5
                    },
                    "nrcontr": {
                        "required": true,
                        "type": "string",
                        "minLength": 1,
                        "maxLength": 40
                    }
                }
            }
        }
    }
}';

$std = new \stdClass();
//$std->sequencial = 1; //Opcional
$std->indretif = 1; //Obrigatório
$std->nrrecibo = '1.1.1234567890123456789'; //Obrigatório caso indretif = 2
$std->indguia = 1; //Opcional
$std->cpftrab = '99999999999'; //Obrigatório
$std->matricula = '1234infomv56788-56478ABC'; //Obrigatório
$std->mtvdeslig = '02'; //Obrigatório
$std->dtdeslig = '2017-11-25'; //Obrigatório
$std->dtavprv = '2017-11-25'; //Opcional
$std->indpagtoapi = 'S'; //Obrigatório
$std->dtprojfimapi = '2017-11-25'; //Opcional
$std->pensalim = 2; //Opcional
$std->percaliment = 22; //Opcional
$std->vralim = 1234.45; //Opcional
$std->nrproctrab = '12345678901234567890'; //Opcional

//Informações relativas ao trabalho intermitente.
$std->infoInterm[0] = new \stdClass(); //Opcional
$std->infoInterm[0]->dia = 12; //Obrigatório

//Observações sobre o desligamento.
$std->observacoes[0] = new \stdClass(); //Opcional
$std->observacoes[0]->observacao = 'observacao'; //Obrigatório

//Grupo preenchido exclusivamente nos casos de sucessão do vínculo trabalhista,
//com a identificação da empresa sucessora.
$std->sucessaovinc = new \stdClass(); //Opcional
$std->sucessaovinc->tpinsc = 1; //Obrigatório
$std->sucessaovinc->nrinsc = '12345678901234'; //Obrigatório

//Transferência de titularidade do empregado doméstico
//para outro representante da mesma unidade familiar.
$std->transftit = new \stdClass(); //Opcional
$std->transftit->cpfsubstituto = '12345678901'; //Obrigatório
$std->transftit->dtnascto = '1969-10-04'; //Obrigatório

//Informação do novo CPF do trabalhador.
$std->mudancacpf = new \stdClass(); //Opcional
$std->mudancacpf->novocpf = '12345678901'; //Obrigatório

//Grupo onde são prestadas as informações relativas às
//verbas devidas ao trabalhador na rescisão contratual.
$std->verbasresc = new \stdClass(); //Opcional

//Identificação de cada um dos demonstrativos de valores devidos ao trabalhador
$std->verbasresc->dmdev[1] = new \stdClass();  //Obrigatório
$std->verbasresc->dmdev[1]->idedmdev = 'akakakak737477382828282828282';  //Obrigatório

$std->verbasresc->dmdev[1]->indrra = 'S';

//Verbas rescisórias relativas ao mês/ano da data do desligamento.
$std->verbasresc->dmdev[1]->infoperapur = new \stdClass(); //Opcional

//Identificação do estabelecimento e da lotação
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->tpinsc = "3"; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->nrinsc = '12345678901234'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->codlotacao = 'asdfg'; //Obrigatório

//Detalhamento das verbas rescisórias devidas ao trabalhador
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->idetabrubr = '12345678'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->qtdrubr = 25.45; //Opcional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->fatorrubr = 1.56; //Opcional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->vrrubr = 200.56; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->indapurir = 0; //Opcional

//Grupo referente ao detalhamento do grau de exposição do trabalhador aos agentes nocivos
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo = new \stdClass(); //Opcional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo->grauexp = 2; //Obrigatório

//Informação relativa a empresas enquadradas no regime de tributação Simples Nacional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples = new \stdClass(); //Opcional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples->indsimples = 1; //Obrigatório

//Remuneração relativa a períodos anteriores, devida em função de acordos coletivos, legislação específica,
//convenção coletiva de trabalho, dissídio ou conversão de licença saúde em acidente de trabalho
$std->verbasresc->dmdev[1]->infoperant = new \stdClass(); //Opcional

//Identificação do instrumento ou situação ensejadora da remuneração relativa a períodos de apuração anteriores.
$std->verbasresc->dmdev[1]->infoperant->ideadc[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dtacconv = '2017-04-02'; //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->tpacconv = 'A';  //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dsc = 'kksksks k skjskjskjs sk';  //Obrigatório

//Identificação do período ao qual se referem as diferenças de remuneração.
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->perref = '2017-01'; //Obrigatório

//Identificação do estabelecimento e da lotação
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->tpinsc = "1"; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->nrinsc = '12345678901234'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->codlotacao = 'asdfg'; //Obrigatório

//Detalhamento das verbas rescisórias devidas ao trabalhador
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->idetabrubr = '12345678'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->qtdrubr = 25.45; //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->fatorrubr = 1.56; //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->vrrubr = 200.56; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->indapurir = 0; //Opcional

//Grupo referente ao detalhamento do grau de exposição do trabalhador aos agentes nocivos
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo = new \stdClass(); //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo->grauexp = 2; //Obrigatório

//Informação relativa a empresas enquadradas no regime de tributação Simples Nacional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples = new \stdClass(); //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples->indsimples = 1; //Obrigatório

//Informações sobre a existência de processos judiciais do trabalhador com decisão favorável quanto à não incidência
//de contribuições sociais e/ou Imposto de Renda.
$std->verbasresc->procjudtrab[1] = new \stdClass(); //Opcional
$std->verbasresc->procjudtrab[1]->tptrib = 2; //Obrigatório
$std->verbasresc->procjudtrab[1]->nrprocjud = '12345678901234567890'; //Obrigatório
$std->verbasresc->procjudtrab[1]->codsusp = '12345678901234'; //Obrigatório

//Grupo preenchido exclusivamente em caso de trabalhador que possua outros vínculos/atividades nos quais já tenha
//ocorrido desconto de contribuição previdenciária.
$std->verbasresc->infomv = new \stdClass(); //Opcional
$std->verbasresc->infomv->indmv = 2; //Obrigatório

//Informações relativas ao trabalhador que possui vínculo
//empregatício com outra(s) empresa(s) e/ou que exerce
//outras atividades como contribuinte individual, detalhando
$std->verbasresc->infomv->remunoutrempr[1] = new \stdClass(); //Obrigatório
$std->verbasresc->infomv->remunoutrempr[1]->tpinsc = 1; //Obrigatório
$std->verbasresc->infomv->remunoutrempr[1]->nrinsc = '12345678901234'; //Obrigatório
$std->verbasresc->infomv->remunoutrempr[1]->codcateg = '001'; //Obrigatório
$std->verbasresc->infomv->remunoutrempr[1]->vlrremunoe = 2535.97; //Obrigatório

//Informação sobre processo judicial que suspende a
//exigibilidade da Contribuição Social Rescisória
$std->verbasresc->proccs = new \stdClass(); //OPcional
$std->verbasresc->proccs->nrprocjud = '12345678901234567890'; //Obrigatório

$std->remunaposdeslig =  new \stdClass(); //Opcional
$std->remunaposdeslig->indremun = 3; //Opcional
    // 1 - Quarentena
    // 2 - Desligamento reconhecido judicialmente com data anterior a competências com remunerações já informadas no eSocial
    // 3 - Aposentadoria de servidor com data anterior a competências com remunerações já informadas no eSocial
$std->remunaposdeslig->dtfimremun = '2023-01-22'; //Obrigatório


//Informações sobre operação de crédito consignado com garantia de FGTS.
$std->consigfgts[0] = new \stdClass(); //Opcional
$std->consigfgts[0]->insconsig = '12345'; //Obrigatório
$std->consigfgts[0]->nrcontr = '123456789012345'; //Obrigatório

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
