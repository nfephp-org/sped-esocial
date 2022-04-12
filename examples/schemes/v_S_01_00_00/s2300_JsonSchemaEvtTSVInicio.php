<?php
error_reporting(E_ALL);
ini_set('display_errors|On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2300
//versão S_1.00

$evento  = 'evtTSVInicio';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtTSVInicio",
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
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "nmtrab": {
            "required": true,
            "type": "string",
            "minLength": 2,
            "maxLength": 70
        },
        "sexo": {
            "required": true,
            "type": "string",
            "pattern": "^(F|M)$"
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
        "grauinstr": {
            "required": true,
            "type": "string",
            "pattern": "^(01|02|03|04|05|06|07|08|09|10|11|12)$"
        },
        "nmsoc": {
            "required": false,
            "type": ["string","null"],
            "minLength": 2,
            "maxLength": 70
        },
        "dtnascto": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "paisnascto": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{3}$"
        },
        "paisnac": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{3}$"
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
                            "maxLength": 4
                        },
                        "dsclograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 100
                        },
                        "nrlograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 10
                        },
                        "complemento": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 30
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 90
                        },
                        "cep": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{8}$"
                        },
                        "codmunic": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{7}"
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
                            "pattern": "^[0-9]{3}"
                        },
                        "dsclograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 100
                        },
                        "nrlograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 10
                        },
                        "complemento": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 30
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 90
                        },
                        "nmcid": {
                            "required": true,
                            "type": "string",
                            "maxLength": 50
                        },
                        "codpostal": {
                            "required": true,
                            "type": ["string","null"],
                            "minLength": 4,
                            "maxLength": 12
                        }
                    }
                }
            }
        },
        "trabimig": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tmpresid": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 2
                },
                "conding": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 7
                }
            }
        },
        "infodeficiencia": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "deffisica": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defvisual": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defauditiva": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defmental": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defintelectual": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "reabreadap": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 255
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
                        "pattern": "^0[1-7]{1}|09|1[0-2]{1}|99$"
                    },
                    "nmdep": {
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
                    "cpfdep": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^[0-9]{11}$"
                    },
                    "depirrf": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    },
                    "depsf": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    },
                    "inctrab": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    }
                }
            }
        },
        "contato": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "foneprinc": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{10,13}$"
                },
                "emailprinc": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 6,
                    "maxLength": 60
                }
            }
        },
        "cadini": {
            "required": true,
            "type": "string",
            "pattern": "^(S|N)$"
        },
        "matricula": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 30
        },
        "codcateg": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{3}$"
        },
        "dtinicio": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "nrproctrab": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^.{20}$"
        },
        "natatividade": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 2
        },
        "cargoduncao": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nmcargo": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 100
                },
                "cbocargo": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{6}$"
                },
                "nmfuncao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 100
                },
                "cbofuncao": {
                    "required": true,
                    "type": "string",
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
        "fgts": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtopcfgts": {
                    "required": false,
                    "type": ["string","null"],
                    "$ref": "#/definitions/data"
                }
            }
        },
        "infodirigentesindical": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "categorig": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{3}$"
                },
                "tpinsc": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 2
                },
                "nrinsc": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{11,14}"
                },
                "dtadmorig": {
                    "required": false,
                    "type": ["string","null"],
                    "$ref": "#/definitions/data"
                },
                "matricorig": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 30
                },
                "tpregtrab": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 2
                },
                "tpregprev": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 3
                }
            }
        },
        "infotrabcedido": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "categorig": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{3}$"
                },
                "cnpjcednt": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{14}$"
                },
                "matricced": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 30
                },
                "dtadmced": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "tpregtrab": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "tpregprev": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                }
            }
        },
        "infomandelet": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "indremuncargo": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(S|N)$"
                },
                "tpregtrab": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "tpregprev": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                }
            }
        },
        "infoestagiario": {
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
                    "minLength": 1,
                    "maxLength": 100
                },
                "nrapol": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
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
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{14}$"
                        },
                        "nmrazao": {
                            "required": false,
                            "type": ["string","null"],
                            "minLength": 1,
                            "maxLength": 100
                        },
                        "dsclograd": {
                            "required": false,
                            "type": ["string","null"],
                            "minLength": 1,
                            "maxLength": 100
                        },
                        "nrlograd": {
                            "required": false,
                            "type": ["string","null"],
                            "minLength": 1,
                            "maxLength": 10
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "minLength": 1,
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
                            "pattern": "^[0-9]{7}"
                        },
                        "uf": {
                            "required": false,
                            "type": ["string","null"],
                            "$ref": "#/definitions/siglauf"
                        }
                    }
                },
                "cnpjagntinteg": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{14}$"
                },
                "cpfsupervisor": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{11}$"
                }
            }
        },
        "mudancacpf": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cpfant": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{11}$"
                },
                "matricant": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 30
                },
                "dtaltcpf": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 255
                }
            }
        },
        "afastamento": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtiniafast": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "codmotafast": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{2}"
                }
            }
        },
        "termino": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtterm": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                }
            }
        }
    }
}';

$std = new \stdClass();
//$std->sequencial = 1;
$std->indretif = 1; //Obrigatório
$std->nrrecibo = '1.1.1234567890123456789'; //Opcional

//Informações do trabalhador.
$std->cpftrab = '12345678901'; //Obrigatório
$std->nmtrab = 'Fulano de Tal'; //Obrigatório
$std->sexo = 'M'; //Obrigatório
$std->racacor = 2; //Obrigatório
$std->estciv = 3; //Opcional
$std->grauinstr = '03'; //Obrigatório
$std->nmsoc = null; //Opcional
$std->dtnascto = '1996-06-11'; //Obrigatório
$std->paisnascto = '105'; //Obrigatório
$std->paisnac = '105'; //Obrigatório

$std->endereco = new \stdClass(); //Obrigatório
//Endereço no Brasil.
$std->endereco->brasil = new \stdClass(); //Opcional
$std->endereco->brasil->tplograd = 'R'; //Opcional
$std->endereco->brasil->dsclograd = 'Av. Paulista'; //Obrigatório
$std->endereco->brasil->nrlograd = '1850'; //Obrigatório
$std->endereco->brasil->complemento = "apto 123"; //Opcional
$std->endereco->brasil->bairro = 'Bela Vista'; //Opcional
$std->endereco->brasil->cep = '01311200'; //Obrigatório
$std->endereco->brasil->codmunic  = '3550308'; //Obrigatório
$std->endereco->brasil->uf = 'SP'; //Obrigatório

//Endereço no exterior.
$std->endereco->exterior = new \stdClass(); //Opcional
$std->endereco->exterior->paisresid = '108'; //Obrigatório
$std->endereco->exterior->dsclograd = '5 Av'; //Obrigatório
$std->endereco->exterior->nrlograd = '2222'; //Obrigatório
$std->endereco->exterior->complemento = 'Apto 200'; //Opcional
$std->endereco->exterior->bairro = 'Manhattan'; //Opcional
$std->endereco->exterior->nmcid = 'New York'; //Obrigatório
$std->endereco->exterior->codpostal  = null; //Opcional

//Informações do trabalhador imigrante.
$std->trabimig = new \stdClass(); //Opcional
$std->trabimig->tmpresid = 1; //Opcional
$std->trabimig->conding = 1; //Obrigatório

//Pessoa com deficiência.
$std->infodeficiencia = new \stdClass(); //Opcional
$std->infodeficiencia->deffisica = 'N'; //Obrigatório
$std->infodeficiencia->defvisual = 'N'; //Obrigatório
$std->infodeficiencia->defauditiva = 'N'; //Obrigatório
$std->infodeficiencia->defmental = 'N'; //Obrigatório
$std->infodeficiencia->defintelectual = 'N'; //Obrigatório
$std->infodeficiencia->reabreadap = 'N'; //Obrigatório
$std->infodeficiencia->observacao = 'lkslkslkslkslkslks'; //Opcional

//Informações dos dependentes.
$std->dependente[1]  = new \stdClass(); //Opcional
$std->dependente[1]->tpdep = '01'; //Obrigatório
$std->dependente[1]->nmdep = 'Fulaninho de Tal'; //Obrigatório
$std->dependente[1]->dtnascto = '2016-11-25'; //Obrigatório
$std->dependente[1]->cpfdep = '12345678901'; //Opcional
$std->dependente[1]->depirrf = 'N'; //Obrigatório
$std->dependente[1]->depsf = 'N'; //Obrigatório
$std->dependente[1]->inctrab = 'N'; //Obrigatório

//Informações de contato.
$std->contato = new \stdClass(); //Opcional
$std->contato->foneprinc = '1234567890'; //Opcional 
$std->contato->emailprinc = 'ele@mail.com'; //Opcional

//Trabalhador Sem Vínculo de Emprego/Estatutário - TSVE - Início.
$std->cadini = 'S'; //Obrigatório
$std->matricula = '123456789'; //Opcional
$std->codcateg = '101'; //Obrigatório
$std->dtinicio = '2017-05-12'; //Obrigatório
$std->nrproctrab = null; //Opcional
$std->natatividade = 2; //Opcional

//Grupo que apresenta o cargo e/ou função ocupada pelo TSVE.
$std->cargofuncao = new \stdClass(); //Opcional
$std->cargofuncao->nmcargo = 'lalalaloaoaoa'; //Opcional
$std->cargofuncao->cbocargo = '263105'; //Opcional 
$std->cargofuncao->nmfuncao = 'ksksksksk sk'; //Opcional
$std->cargofuncao->cbofuncao = '263105'; //Opcional

//Informações da remuneração e periodicidade de pagamento.
$std->remuneracao = new \stdClass(); //Opcional
$std->remuneracao->vrsalfx = 1200.00; //Obrigatório
$std->remuneracao->undsalfixo = 7; //Obrigatório
$std->remuneracao->dscsalvar = 'lkklslskksl s lks lsklsks '; //Opcional

//Informações do Fundo de Garantia do Tempo de Serviço - FGTS.
$std->fgts = new \stdClass(); //Opcional
$std->fgts->dtopcfgts = '2017-05-12'; //Obrigatório

//Informações relativas ao dirigente sindical.
$std->infodirigentesindical = new \stdClass(); //Opcional
$std->infodirigentesindical->categorig = '001'; //Obrigatório
$std->infodirigentesindical->tpinsc = 1; //Opcional
$std->infodirigentesindical->nrinsc = '12345678901234'; //Opcional
$std->infodirigentesindical->dtadmorig = '2017-05-12'; //Opcional
$std->infodirigentesindical->matricorig = 'ytuytuystyst'; //Opcional
$std->infodirigentesindical->tpregtrab = 1; //Opcional
$std->infodirigentesindical->tpregprev = 2; //Obrigatório

//Informações relativas ao trabalhador cedido/em exercício em outro órgão, preenchidas exclusivamente
//pelo cessionário/órgão de destino.
$std->infotrabcedido = new \stdClass(); //Opcional
$std->infotrabcedido->categorig = '001'; //Obrigatório
$std->infotrabcedido->cnpjcednt = '12345678901234'; //Obrigatório
$std->infotrabcedido->matricced = 'lksçkçslksl'; //Obrigatório
$std->infotrabcedido->dtadmced = '2017-05-12'; //Obrigatório
$std->infotrabcedido->tpregtrab = 2; //Obrigatório
$std->infotrabcedido->tpregprev = 3; //Obrigatório

//Informações relativas a servidor público exercente de mandato eletivo.
$std->infomandelet = new \stdClass(); //Opcional
$std->infomandelet->indremuncargo = 'S'; //Opcional
$std->infomandelet->tpregtrab = 2; //Obrigatório
$std->infomandelet->tpregprev = 3; //Obrigatório

//Informações relativas ao estagiário.
$std->infoestagiario = new \stdClass(); //Opcional
$std->infoestagiario->natestagio = 'N'; //Obrigatório
$std->infoestagiario->nivestagio = 8; //Obrigatório
$std->infoestagiario->areaatuacao = 'ksksksksk'; //Opcional
$std->infoestagiario->nrapol = 'kak228282828'; //Opcional
$std->infoestagiario->dtprevterm = '2017-12-31'; //Obrigatório

$std->infoestagiario->instensino = new \stdClass(); //Obrigatório
$std->infoestagiario->instensino->cnpjinstensino = '12345678901234'; //Opcional
$std->infoestagiario->instensino->nmrazao = 'dlkdldkldkd'; //Opcional
$std->infoestagiario->instensino->dsclograd = 'lslsppopapap'; //Opcional
$std->infoestagiario->instensino->nrlograd = '12244'; //Opcional
$std->infoestagiario->instensino->bairro = 'kakakaka'; //Opcional
$std->infoestagiario->instensino->cep = '12345678'; //Opcional
$std->infoestagiario->instensino->codmunic = '1234567'; //Opcional
$std->infoestagiario->instensino->uf = 'AC'; //Opcional

$std->infoestagiario->cnpjagntinteg = '12345678901234'; //Opcional
$std->infoestagiario->cpfsupervisor = '12345678901';  //Opcional

//Informações de mudança de CPF do trabalhador.
$std->mudancacpf = new \stdClass(); //Opcional
$std->mudancacpf->cpfant = '12345678901'; //Obrigatório
$std->mudancacpf->matriant = 'ABC1234'; //Opcional
$std->mudancacpf->dtaltcpf = '2018-11-10'; //Obrigatório
$std->mudancacpf->observacao = 'bla bla bla'; //Opcional

//Informações de afastamento do TSVE
$std->afastamento = new \stdClass(); //Opcional
$std->afastamento->dtiniafast = '2017-06-01'; //Obrigatório
$std->afastamento->codmotafast = '01'; //Obrigatório

//Informação do término do TSVE.
$std->termino = new \stdClass(); //Opcional
$std->termino->dtterm = '2017-12-31'; //Obrigatório

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
