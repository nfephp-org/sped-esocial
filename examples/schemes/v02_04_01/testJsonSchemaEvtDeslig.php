<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtDeslig';
$version = '02_04_01';

$jsonSchema = '{
    "title": "evtDeslig",
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
        "cpftrab": {
            "required": true,
            "type": "string",
            "minLength": 11,
            "maxLength": 11
        },
        "nistrab": {
            "required": true,
            "type": "string",
            "minLength": 11,
            "maxLength": 11
        },
        "matricula": {
            "required": true,
            "type": "string",
            "maxLength": 30
        },
        "mtvdeslig": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{2}"
        },
        "dtdeslig": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "indpagtoapi": {
            "required": true,
            "type": "string",
            "pattern": "S|N"
        },
        "dtprojfimapi": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "pensalim": {
            "required": true,
            "type": "integer",
            "minimum": 0,
            "maximum": 3
        },
        "percaliment": {
            "required": false,
            "type": ["number","null"],
            "minimum": 0,
            "maximum": 100
        },
        "vralim": {
            "required": false,
            "type": ["number","null"]
        },
        "nrcertobito": {
            "required": false,
            "type": ["string","null"],
            "minLength": 32,
            "maxLength": 32,
            "pattern": "^[0-9]"
        },
        "nrproctrab": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 20
        },
        "indcumprparc": {
            "required": true,
            "type": "integer",
            "minimum": 0,
            "maximum": 4
        },
        "observacao": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 255
        },
        "sucessaovinc": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cnpjsucessora": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{14}"
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
                    "pattern": "^[0-9]{11}"
                },
                "dtnascto": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
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
                                                    "type": "integer",
                                                    "minimum": 1,
                                                    "maximum": 4
                                                },
                                                "nrinsc": {
                                                    "required": true,
                                                    "type": "string",
                                                    "maxLength": 15
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
                                                            "vrunit": {
                                                                "required": false,
                                                                "type": ["number","null"]
                                                            },
                                                            "vrrubr": {
                                                                "required": true,
                                                                "type": "number"
                                                            }
                                                        }
                                                    }
                                                },
                                                "infosaudecolet": {
                                                    "required": false,
                                                    "type": ["object","null"],
                                                    "properties": {
                                                        "detoper": {
                                                            "required": true,
                                                            "type": "array",
                                                            "minItems": 1,
                                                            "maxItems": 99,
                                                            "items": {
                                                                "required": true,
                                                                "type": "object",
                                                                "properties": {
                                                                    "cnpjoper": {
                                                                        "required": true,
                                                                        "type": "string",
                                                                        "pattern": "^[0-9]{14}"
                                                                    },
                                                                    "regans": {
                                                                        "required": true,
                                                                        "type": "string",
                                                                        "maxLength": 6
                                                                    },
                                                                    "vrpgtit": {
                                                                        "required": true,
                                                                        "type": "number"
                                                                    },
                                                                    "detplano": {
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
                                                                                    "pattern": "^[0-9]{2}"
                                                                                },
                                                                                "cpfdep": {
                                                                                    "required": false,
                                                                                    "type": ["string","null"],
                                                                                    "pattern": "^[0-9]{11}"
                                                                                },
                                                                                "nmdep": {
                                                                                    "required": true,
                                                                                    "type": "string",
                                                                                    "maxLength": 70
                                                                                },
                                                                                "dtnascto": {
                                                                                    "required": true,
                                                                                    "type": "string",
                                                                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                                                                },
                                                                                "vlrpgdep": {
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
                                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                                },
                                                "tpacconv": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "A|B|C|D|E"
                                                },
                                                "compacconv": {
                                                    "required": false,
                                                    "type": ["string","null"],
                                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                                                },
                                                "dtefacconv": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
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
                                                                "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
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
                                                                            "type": "integer",
                                                                            "minimum": 1,
                                                                            "maximum": 4
                                                                        },
                                                                        "nrinsc": {
                                                                            "required": true,
                                                                            "type": "string",
                                                                            "maxLength": 15
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
                                                                                    "vrunit": {
                                                                                        "required": false,
                                                                                        "type": ["number","null"]
                                                                                    },
                                                                                    "vrrubr": {
                                                                                        "required": true,
                                                                                        "type": "number"
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
                            },
                            "infotrabinterm": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 0,
                                "maxItems": 99,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "codconv": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 30
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
                                "maximum": 4
                            },
                            "nrprocjud": {
                                "required": true,
                                "type": "string",
                                "maxLength": 20
                            },
                            "codsusp": {
                                "required": true,
                                "type": "string",
                                "maxLength": 14,
                                "pattern": "^[0-9]"
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
                            "maxItems": 10,
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
                                        "maxLength": 15,
                                        "pattern": "^[0-9]"
                                    },
                                    "codcateg": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 3,
                                        "pattern": "^[0-9]"
                                    },
                                    "vlrremunoe": {
                                        "required": true,
                                        "type": "number"
                                    }
                                }
                            }
                        }
                    }
                }
            }
        },
        "quarentena": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtfimquar": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "consigfgts": {
            "required": true,
            "type": "object",
            "properties": {
                "idconsig": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "insconsig": {
                    "required": true,
                    "type": "string",
                    "maxLength": 5
                },
                "nrcontr": {
                    "required": true,
                    "type": "string",
                    "maxLength": 15
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab = '99999999999';
$std->nistrab = '11111111111';
$std->matricula = '1234infomv56788-56478ABC';
$std->mtvdeslig = '02';
$std->dtdeslig = '2017-11-25';
$std->indpagtoapi = 'S';
$std->dtprojfimapi = '2017-11-25';
$std->pensalim = 2;
$std->percaliment = 22;
$std->vralim = 1234.45;
$std->nrcertobito = '1234567890';
$std->nrProcTrab = '1234567890';
$std->indcumprparc = 2;
$std->observacao = 'observacao';

$std->sucessaovinc = new \stdClass();
$std->sucessaovinc->cnpjsucessora = '12345678901234';

$std->transftit = new \stdClass();
$std->transftit->cpfsubstituto = '12345678901';
$std->transftit->dtnascto = '1969-10-04';

$std->verbasresc = new \stdClass();
$std->verbasresc->dmdev[1] = new \stdClass();
$std->verbasresc->dmdev[1]->idedmdev = 'akakakak737477382828282828282';
$std->verbasresc->dmdev[1]->infoperapur = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->nrinsc = '123456789012345';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->codlotacao = 'asdfg';

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->idetabrubr = '12345678';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->qtdrubr = 25.45;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->fatorrubr = 1.56;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->vrunit = 20.15;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->vrrubr = 200.56;

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->cnpjoper = '12345678901234';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->regans = '123456';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->vrpgtit = 986.49;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->tpdep = '01';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->cpfdep = '12345678901';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->nmdep = 'Fulano de Tal';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->dtnascto = '2005-06-05';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->vlrpgdep = 199.41;


$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo->grauexp = 2;

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->dmdev[1]->infoperant = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dtacconv = '2017-04-02';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->tpacconv = 'A';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->compacconv = '2017-04';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dtefacconv = '2017-06-02';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dsc = 'kksksks k skjskjskjs sk';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->perref = '2017-01';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->nrinsc = '123456789012345';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->codlotacao = 'asdfg';

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->idetabrubr = '12345678';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->qtdrubr = 25.45;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->fatorrubr = 1.56;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->vrunit = 20.15;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->vrrubr = 200.56;

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo->grauexp = 2;

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->dmdev[1]->infotrabinterm[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infotrabinterm[1]->codconv = 'ksksksksksk';


$std->verbasresc->procjudtrab[1] = new \stdClass();
$std->verbasresc->procjudtrab[1]->tptrib = 3;
$std->verbasresc->procjudtrab[1]->nrprocjud = 'lalalalalalal';
$std->verbasresc->procjudtrab[1]->codsusp = '12345678901234';

$std->verbasresc->infomv = new \stdClass();
$std->verbasresc->infomv->indmv = 2;

$std->verbasresc->infomv->remunoutrempr[1] = new \stdClass();
$std->verbasresc->infomv->remunoutrempr[1]->tpinsc = 1;
$std->verbasresc->infomv->remunoutrempr[1]->nrinsc = '123456789012345';
$std->verbasresc->infomv->remunoutrempr[1]->codcateg = '001';
$std->verbasresc->infomv->remunoutrempr[1]->vlrremunoe = 2535.97;

 
$std->quarentena = new \stdClass();
$std->quarentena->dtfimquar = '2018-12-20';
         
$std->consigfgts = new \stdClass();
$std->consigfgts->idconsig = 'S';
$std->consigfgts->insconsig = '12345';
$std->consigfgts->nrcontr = '123456789012345';


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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
