<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2500

$evento  = 'evtProcTrab';
$version = 'S_01_03_00';

$jsonSchema = '{
    "title": "evtProcTrab",
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
        "ideresp": {
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
                    "pattern": "^[0-9]{11,14}$"
                }
            }
        },
        "origem": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "nrproctrab": {
            "required": true,
            "type": "string",
            "pattern": "^([0-9]{15}|[0-9]{20})$"
        },
        "obsproctrab": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 999
        },
        "infoprocjud": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtsent": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "ufvara": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/siglauf"
                },
                "codmunic": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{7}$"
                },
                "idvara": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{1,4}$"
                }
            }
        },
        "infoccp": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtccp": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "tpccp": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                },
                "cnpjccp": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{14}$"
                }
            }
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "nmtrab": {
            "required": false,
            "type": ["string","null"],
            "minLength": 2,
            "maxLength": 70
        },
        "dtnascto": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/data"
        },
        "infocontr": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "tpcontr": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 9
                    },
                    "indcontr": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    },
                    "dtadmorig": {
                        "required": false,
                        "type": ["string","null"],
                        "$ref": "#/definitions/data"
                    },
                    "indreint": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^(S|N)$"
                    },
                    "indcateg": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    },
                    "indnatativ": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    },
                    "indmotdeslig": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
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
                    },
                    "dtinicio": {
                        "required": false,
                        "type": ["string","null"],
                        "$ref": "#/definitions/data"
                    },
                    "infocompl": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "codcbo": {
                                "required": false,
                                "type": ["string","null"],
                                "pattern": "^[0-9]{6}$"
                            },
                            "natatividade": {
                                "required": false,
                                "type": ["integer","null"],
                                "minimum": 1,
                                "maximum": 2
                            },
                            "remuneracao": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 0,
                                "maxItems": 99,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "dtremun": {
                                            "required": true,
                                            "type": "string",
                                            "$ref": "#/definitions/data"
                                        },
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
                                }
                            },
                            "infovinc": {
                                "required": false,
                                "type": ["object","null"],
                                "properties": {
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
                                    },
                                    "dtadm": {
                                        "required": true,
                                        "type": "string",
                                        "$ref": "#/definitions/data"
                                    },
                                    "tmpparc": {
                                        "required": false,
                                        "type": ["integer","null"],
                                        "minimum": 0,
                                        "maximum": 3
                                    },
                                    "duracao": {
                                        "required": false,
                                        "type": ["object","null"],
                                        "properties": {
                                            "tpcontr": {
                                                "required": true,
                                                "type": "integer",
                                                "minimum": 1,
                                                "maximum": 3
                                            },
                                            "dtterm": {
                                                "required": false,
                                                "type": ["string","null"],
                                                "$ref": "#/definitions/data"
                                            },
                                            "clouassec": {
                                                "required": false,
                                                "type": ["string","null"],
                                                "pattern": "^(S|N)$"
                                            },
                                            "objdet": {
                                                "required": false,
                                                "type": ["string","null"],
                                                "minLength": 1,
                                                "maxLength": 255
                                            }
                                        }
                                    },
                                    "observacoes": {
                                        "required": false,
                                        "type": ["array","null"],
                                        "minItems": 0,
                                        "maxItems": 99,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "observacao": {
                                                    "required": true,
                                                    "type": "string",
                                                    "minLength": 1,
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
                                                "maximum": 6
                                            },
                                            "nrinsc": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{11,14}$"
                                            },
                                            "matricant": {
                                                "required": false,
                                                "type": ["string","null"],
                                                "pattern": "^.{1,30}$"
                                            },
                                            "dttransf": {
                                                "required": true,
                                                "type": "string",
                                                "$ref": "#/definitions/data"
                                            }
                                        }
                                    },
                                    "infodeslig": {
                                        "required": true,
                                        "type": "object",
                                        "properties": {
                                            "dtdeslig": {
                                                "required": true,
                                                "type": "string",
                                                "$ref": "#/definitions/data"
                                            },
                                            "mtvdeslig": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{2}$"
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
                                            }
                                        }
                                    }
                                }
                            },
                            "infoterm": {
                                "required": false,
                                "type": ["object","null"],
                                "properties": {
                                    "dtterm": {
                                        "required": true,
                                        "type": "string",
                                        "$ref": "#/definitions/data"
                                    },
                                    "mtvdesligtsv": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "pattern": "^(01|02|03|04|05|06|99)$"
                                    }
                                }
                            }
                        }
                    },
                    "mudcategativ": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 99,
                        "items": {
                            "type": "object",
                            "properties": {
                                "codcateg": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{3}$"
                                },
                                "natatividade": {
                                    "required": false,
                                    "type": ["integer","null"],
                                    "minimum": 1,
                                    "maximum": 2
                                },
                                "dtmudcategativ": {
                                    "required": true,
                                    "type": "string",
                                    "$ref": "#/definitions/data"
                                }
                            }
                        }
                    },
                    "uniccontr": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 99,
                        "items": {
                            "type": "object",
                            "properties": {
                                "matunic": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{1,30}$"
                                },
                                "codcateg": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^[0-9]{3}$"
                                },
                                "dtinicio": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "$ref": "#/definitions/data"
                                }
                            }
                        }
                    },
                    "ideestab": {
                        "required": true,
                        "type": "object",
                        "properties": {
                            "tpinsc": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 4
                            },
                            "nrinsc": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{12,14}$"
                            },
                            "infovlr": {
                                "required": true,
                                "type": "object",
                                "properties": {
                                    "compini": {
                                        "required": true,
                                        "type": "string",
                                        "$ref": "#/definitions/periodo"
                                    },
                                    "compfim": {
                                        "required": true,
                                        "type": "string",
                                        "$ref": "#/definitions/periodo"
                                    },
                                    "indreperc": {
                                        "required": true,
                                        "type": "integer",
                                        "minimum": 1,
                                        "maximum": 3
                                    },
                                    "indensd": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "pattern": "^(S)$"
                                    },
                                    "indenabono": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "pattern": "^(S)$"
                                    },
                                    "abono": {
                                        "required": false,
                                        "type": ["array","null"],
                                        "minItems": 0,
                                        "maxItems": 9,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "anobase": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^[0-9]{4}$"
                                                }
                                            }
                                        }
                                    },
                                    "ideperiodo": {
                                        "required": false,
                                        "type": ["array","null"],
                                        "minItems": 0,
                                        "maxItems": 999,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "perref": {
                                                    "required": true,
                                                    "type": "string",
                                                    "$ref": "#/definitions/periodo"
                                                },
                                                "basecalculo": {
                                                    "required": false,
                                                    "type": ["object","null"],
                                                    "properties": {
                                                        "vrbccpmensal": {
                                                            "required": true,
                                                            "type": "number"
                                                        },
                                                        "vrbccp13": {
                                                            "required": false,
                                                            "type": ["number","null"]
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
                                                        }
                                                    }
                                                },
                                                "infofgts": {
                                                    "required": false,
                                                    "type": ["object","null"],
                                                    "properties": {
                                                        "vrbcfgtsproctrab": {
                                                            "required": true,
                                                            "type": "number"
                                                        },
                                                        "vrbcfgtssefip": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "vrbcfgtsdecant": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        }
                                                    }
                                                },
                                                "basemudcateg": {
                                                    "required": false,
                                                    "type": ["object","null"],
                                                    "properties": {
                                                        "codcateg": {
                                                            "required": true,
                                                            "type": "string",
                                                            "pattern": "^[0-9]{3}$"
                                                        },
                                                        "vrbccprev": {
                                                            "required": true,
                                                            "type": "number"
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
$std->sequencial = 1;
$std->indretif = 1; //obrigatorio
$std->nrrecibo = '1.4.1234567890123456789'; //opcional

$std->ideresp = new \stdClass(); //Opcional
$std->ideresp->tpinsc = 1;
$std->ideresp->nrinsc = '12345678901234';

$std->origem = 1; //obrigatprio
$std->nrproctrab = '12345678901234567890'; //obrigatório
$std->obsproctrab = 'Bla bla bla'; //opcional até 999

$std->infoprocjud = new \stdClass();
$std->infoprocjud->dtsent = '2022-12-03';
$std->infoprocjud->ufvara = 'SP';
$std->infoprocjud->codmunic = '3504808';
$std->infoprocjud->idvara = '12';

$std->infocccp = new \stdClass();
$std->infocccp->dtccp = '2022-12-03';
$std->infocccp->tpccp = 1;
$std->infocccp->cnpjccp = '12345678901234';

$std->cpftrab = '12345678901'; //obrigatório
$std->nmtrab = 'Fulano da Silva'; //opcional
$std->dtnascto = '1997-02-22'; //opcional

$std->infocontr[0] = new \stdClass(); //de 1 a 99
$std->infocontr[0]->tpcontr = 1; //obrigatório
$std->infocontr[0]->indcontr = 'S'; //obrigatório
$std->infocontr[0]->dtadmorig = '2021-11-03'; //opcional
$std->infocontr[0]->indreint = 'N'; //opcional
$std->infocontr[0]->indcateg = 'N'; //obrigatório
$std->infocontr[0]->indnatativ = 'N'; //obrigatório
$std->infocontr[0]->indmotdeslig = 'N'; //obrigatório
$std->infocontr[0]->matricula = 'ABC23434'; //opcional
$std->infocontr[0]->codcateg = "101"; //opcional
$std->infocontr[0]->dtinicio = '2022-11-05'; //opcional

$std->infocontr[0]->infocompl = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->codcbo = '123456'; //opcional
$std->infocontr[0]->infocompl->natatividade = 1; //opcional

$std->infocontr[0]->infocompl->remuneracao[0] = new \stdClass(); //opcional 0 a 99
$std->infocontr[0]->infocompl->remuneracao[0]->dtremun = '2022-12-15'; //Obrigatório
$std->infocontr[0]->infocompl->remuneracao[0]->vrsalfx = 2500.00; //Obrigatório
$std->infocontr[0]->infocompl->remuneracao[0]->undsalfixo = 5; //Obrigatório
$std->infocontr[0]->infocompl->remuneracao[0]->descsalvar = 'bla bla bla'; //opcional

$std->infocontr[0]->infocompl->infovinc = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infovinc->tpregtrab = 1;
$std->infocontr[0]->infocompl->infovinc->tpregprev = 1;
$std->infocontr[0]->infocompl->infovinc->dtadm = '2022-11-03';
$std->infocontr[0]->infocompl->infovinc->tmpparc = 0; //opcional

$std->infocontr[0]->infocompl->infovinc->duracao = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infovinc->duracao->tpcontr = 1;
$std->infocontr[0]->infocompl->infovinc->duracao->dtterm = '2023-11-15'; //opcional
$std->infocontr[0]->infocompl->infovinc->duracao->clauassec = 'S';  //opcional
$std->infocontr[0]->infocompl->infovinc->duracao->objdet = 'bla bla bla'; //opcional

$std->infocontr[0]->infocompl->infovinc->observacoes[0] = new \stdClass(); //opcional 0-99
$std->infocontr[0]->infocompl->infovinc->observacoes[0]->observacao = 'bla bla bla';

$std->infocontr[0]->infocompl->infovinc->sucessaovinc = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infovinc->sucessaovinc->tpinsc = 1;
$std->infocontr[0]->infocompl->infovinc->sucessaovinc->nrinsc = '12345678901234';
$std->infocontr[0]->infocompl->infovinc->sucessaovinc->matricant = '2222';
$std->infocontr[0]->infocompl->infovinc->sucessaovinc->dttransf = '2023-03-04';

$std->infocontr[0]->infocompl->infovinc->infodeslig = new \stdClass(); //Obrigatprio
$std->infocontr[0]->infocompl->infovinc->infodeslig->dtdeslig = '2023-11-15';
$std->infocontr[0]->infocompl->infovinc->infodeslig->mtvdeslig = '01';
$std->infocontr[0]->infocompl->infovinc->infodeslig->dtprojfimapi = '2023-12-15';
$std->infocontr[0]->infocompl->infovinc->infodeslig->pensalim = 0;
$std->infocontr[0]->infocompl->infovinc->infodeslig->percaliment = 10.00;
$std->infocontr[0]->infocompl->infovinc->infodeslig->vralim = 250.00;

$std->infocontr[0]->infocompl->infoterm = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infoterm->dtterm = '2023-11-15';
$std->infocontr[0]->infocompl->infoterm->mtvdesligtsv = '01';

$std->infocontr[0]->mudcategativ[0] = new \stdClass(); //opcional 0-99
$std->infocontr[0]->mudcategativ[0]->codcateg = '101';
$std->infocontr[0]->mudcategativ[0]->natatividade = 1;
$std->infocontr[0]->mudcategativ[0]->dtmudcategativ = '2023-10-01';

$std->infocontr[0]->uniccontr[0] = new \stdClass(); //opcional 0-99
$std->infocontr[0]->uniccontr[0]->matunic = '123445555';
$std->infocontr[0]->uniccontr[0]->codcateg = '101';
$std->infocontr[0]->uniccontr[0]->dtinicio = '2023-05-01';

$std->infocontr[0]->ideestab = new \stdClass(); //obrigatório
$std->infocontr[0]->ideestab->tpinsc = 1;
$std->infocontr[0]->ideestab->nrinsc = '12345678901234';

$std->infocontr[0]->ideestab->infovlr = new \stdClass(); //obrigatório
$std->infocontr[0]->ideestab->infovlr->compini = '2023-10';
$std->infocontr[0]->ideestab->infovlr->compfim = '2023-11';
$std->infocontr[0]->ideestab->infovlr->indreperc = 1;
$std->infocontr[0]->ideestab->infovlr->indensd = 'S';
$std->infocontr[0]->ideestab->infovlr->indenabono = 'S';

$std->infocontr[0]->ideestab->infovlr->abono[0] = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->abono[0]->anobase = '2023';

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0] = new \stdClass(); //opcional 0-999
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->perref = '2023-10';
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo->vrbccpmensal = 2500;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo->vrbccp13 = 2500;

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo->infoagnocivo = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo->infoagnocivo->grauexp = 1;

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts->vrbcfgtsproctrab = 532.54;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts->vrbcfgtssefip = 2000;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts->vrbcfgtsdecant = 1000;

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basemudcateg = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basemudcateg->codcateg = '101';
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basemudcateg->vrbccprev = 3333.33;




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
