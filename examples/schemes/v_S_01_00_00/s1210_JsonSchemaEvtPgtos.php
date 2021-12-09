<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1210
//Grupo {detPgtoFer} – inserido campo {matricula} como chave.
//Campo {cpfBenef} – alterada validação da alínea b).
//Grupo {detPgtoFl/infoPgtoParc} – alterada descrição no registro do evento.
//Campo {detPgtoFl/infoPgtoParc/matricula} – criado.
//Campo {detPgtoFl/infoPgtoParc/codRubr} – alterada validação.
//Grupo {detPgtoBenPr/infoPgtoParc} – alterada descrição no registro do evento.
//Campo {detPgtoBenPr/infoPgtoParc/codRubr} – alterada validação.
//Campo {detPgtoFer/matricula} – criado.
//Campo {detRubrFer/codRubr} – alterada validação.
//S-1210 sem alterações da 2.4.2 => 2.5.0

$evento  = 'evtPgtos';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtPgtos",
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
        "deps": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "vrdeddep": {
                    "required": true,
                    "type": "number"
                }
            }
        },
        "infopgto": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 60,
            "items": {
                "type": "object",
                "properties": {
                    "dtpgto": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                    },
                    "tppgto": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 9
                    },
                    "indresbr": {
                        "required": true,
                        "type": "string",
                        "maxLength": 1,
                        "pattern": "S|N"
                    },
                    "detpgtofl": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 200,
                        "items": {
                            "type": "object",
                            "properties": {
                                "perref": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
                                },
                                "idedmdev": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 30
                                },
                                "indpgtott": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 1,
                                    "pattern": "S|N"
                                },
                                "vrliq": {
                                    "required": true,
                                    "type": "number"
                                },
                                "nrrecarq": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "maxLength": 40
                                },
                                "retpgtotot": {
                                    "required": false,
                                    "type": ["array","null"],
                                    "minItems": 0,
                                    "maxItems": 99,
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
                                            },
                                            "penalim": {
                                                "required": false,
                                                "type": ["array","null"],
                                                "minItems": 0,
                                                "maxItems": 99,
                                                "items": {
                                                    "type": "object",
                                                    "properties": {
                                                        "cpfbenef": {
                                                            "required": true,
                                                            "type": "string",
                                                            "pattern": "[0-9]{11}"
                                                        },
                                                        "dtnasctobenef": {
                                                            "required": false,
                                                            "type": ["string","null"],
                                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                                        },
                                                        "nmbenefic": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 70
                                                        },
                                                        "vlrpensao": {
                                                            "required": true,
                                                            "type": "number"
                                                        }
                                                    }
                                                }    
                                            }
                                        }
                                    }    
                                },
                                "infopgtoparc": {
                                    "required": false,
                                    "type": ["array","null"],
                                    "minItems": 0,
                                    "maxItems": 99,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "matricula": {
                                                "required": false,
                                                "type": ["string","null"],
                                                "maxLength": 30
                                            },
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
                                }
                            }
                        }    
                    },
                    "detpgtobenpr": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "perref": {
                                "required": true,
                                "type": "string",
                                "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
                            },
                            "idedmdev": {
                                "required": true,
                                "type": "string",
                                "maxLength": 30
                            },
                            "indpgtott": {
                                "required": true,
                                "type": "string",
                                "maxLength": 1,
                                "pattern": "S|N"
                            },
                            "vrliq": {
                                "required": true,
                                "type": "number"
                            },
                            "retpgtotot": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 0,
                                "maxItems": 99,
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
                            "infopgtoparc": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 0,
                                "maxItems": 99,
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
                            }
                        }
                    },
                    "detpgtofer": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 5,
                        "items": {
                            "type": "object",
                            "properties": {
                                "codcateg": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 101,
                                    "maximum": 999
                                },
                                "matricula": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "maxLength": 30
                                },
                                "dtinigoz": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                },
                                "qtdias": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 99
                                },
                                "vrliq": {
                                    "required": true,
                                    "type": "number"
                                },
                                "detrubrfer": {
                                    "required": true,
                                    "type": "array",
                                    "minItems": 1,
                                    "maxItems": 99,
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
                                            },
                                            "penalim": {
                                                "required": false,
                                                "type": ["array","null"],
                                                "minItems": 0,
                                                "maxItems": 99,
                                                "items": {
                                                    "type": "object",
                                                    "properties": {
                                                        "cpfbenef": {
                                                            "required": true,
                                                            "type": "string",
                                                            "pattern": "[0-9]{11}"
                                                        },
                                                        "dtnasctobenef": {
                                                            "required": false,
                                                            "type": ["string","null"],
                                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                                        },
                                                        "nmbenefic": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 70
                                                        },
                                                        "vlrpensao": {
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
                    },
                    "detpgtoant": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 99,
                        "items": {
                            "type": "object",
                            "properties": {
                                "codcateg": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 101,
                                    "maximum": 999
                                },
                                "infopgtoant": {
                                    "required": true,
                                    "type": "array",
                                    "minItems": 1,
                                    "maxItems": 99,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "tpbcirrf": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "[0-9]{2}"
                                            },
                                            "vrbcirrf": {
                                                "required": true,
                                                "type": "number"
                                            }
                                        }
                                    }    
                                }
                            }
                        }    
                    },
                    "idepgtoext": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "codpais": {
                                "required": true,
                                "type": "string",
                                "pattern": "[0-9]{3}"
                            },
                            "indnif": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 3
                            },
                            "nifbenef": {
                                "required": false,
                                "type": ["string","null"],
                                "maxLength": 20
                            },
                            "endext": {
                                "required": true,
                                "type": "object",
                                "properties": {
                                    "dsclograd": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 80
                                    },
                                    "nrlograd": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "maxLength": 10
                                    },
                                    "complem": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "maxLength": 30
                                    },
                                    "bairro": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "maxLength": 60
                                    },
                                    "nmcid": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 50
                                    },
                                    "codpostal": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "maxLength": 12
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
$std->indretif = 1;
$std->nrrecibo = 'abcdefghijklmnopq';
$std->indapuracao = 2;
$std->perapur = '2017-12';
$std->cpfbenef = '12345678901';

$std->deps = new \stdClass();
$std->deps->vrdeddep = 1000.00;

$std->infopgto[0] = new \stdClass();
$std->infopgto[0]->dtpgto = '2018-01-15';
$std->infopgto[0]->tppgto = 4;
$std->infopgto[0]->indresbr = 'N';

$std->infopgto[0]->detpgtofl[0] = new \stdClass();
$std->infopgto[0]->detpgtofl[0]->perref = '2018-12';
$std->infopgto[0]->detpgtofl[0]->idedmdev = 'jlkjkj112121';
$std->infopgto[0]->detpgtofl[0]->indpgtott = 'N';
$std->infopgto[0]->detpgtofl[0]->vrliq = 1001.55;
$std->infopgto[0]->detpgtofl[0]->nrrecarq = 'dkjhdkjdhkjdh dkjhdkjhdkj';

$std->infopgto[0]->detpgtofl[0]->retpgtotot[0] = new \stdClass();
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->codrubr = 'kjlsksksjs';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->idetabrubr = 'k2k3k2k3';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->qtdrubr = 1500.22;
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->fatorrubr = 11.55;
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->vrunit = 5894.56;
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->vrrubr = 8759.99;

$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0] = new \stdClass();
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->cpfbenef = '12345678901';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->dtnasctobenef = '2011-04-15';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->nmbenefic = 'Beltrano de Tal';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->vlrpensao = 1200.87;

$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0] = new \stdClass();
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->matricula = 'slkjslskjslkjslksjks';
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->codrubr = 'sdkdjkdjdkjdkjd 29322929';
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->idetabrubr = 'ksks1234';
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->qtdrubr = 1000.34;
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->fatorrubr = 2.54;
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->vrunit = 1200.55;
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->vrrubr = 3988.77;

$std->infopgto[0]->detpgtobenpr = new \stdClass();
$std->infopgto[0]->detpgtobenpr->perref = '2018-02';
$std->infopgto[0]->detpgtobenpr->idedmdev = 'ljslksjksjksj';
$std->infopgto[0]->detpgtobenpr->indpgtott = 'N';
$std->infopgto[0]->detpgtobenpr->vrliq = 234.44;

$std->infopgto[0]->detpgtobenpr->retpgtotot[0] = new \stdClass();
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->codrubr = 'sdkdjkdjdkjdkjd 29322929';
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->idetabrubr = 'ksks1234';
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->qtdrubr = 2012.33;
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->fatorrubr = 3.66;
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->vrunit = 234.98;
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->vrrubr = 2654.87;

$std->infopgto[0]->detpgtobenpr->infopgtoparc[0] = new \stdClass();
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->codrubr = 'sdkdjkdjdkjdkjd 29322929';
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->idetabrubr = 'ksks1234';
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->qtdrubr = 2012.33;
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->fatorrubr = 3.66;
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->vrunit = 234.98;
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->vrrubr = 2654.87;

$std->infopgto[0]->detpgtofer[0] = new \stdClass();
$std->infopgto[0]->detpgtofer[0]->codcateg = 101;
$std->infopgto[0]->detpgtofer[0]->matricula = 'slkjslskjslkjslksjks';
$std->infopgto[0]->detpgtofer[0]->dtinigoz = '2018-03-01';
$std->infopgto[0]->detpgtofer[0]->qtdias = 22;
$std->infopgto[0]->detpgtofer[0]->vrliq = 2658.25;

$std->infopgto[0]->detpgtofer[0]->detrubrfer[0] = new \stdClass();
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->codrubr = 'sdkdjkdjdkjdkjd 29322929';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->idetabrubr = 'ksks1234';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->qtdrubr = 2012.33;
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->fatorrubr = 3.66;
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->vrunit = 234.98;
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->vrrubr = 2654.87;

$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0] = new \stdClass();
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->cpfbenef = '12345678901';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->dtnasctobenef = '2011-04-15';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->nmbenefic = 'Beltrano de Tal';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->vlrpensao = 1200.87;

$std->infopgto[0]->detpgtoant[0] = new \stdClass();
$std->infopgto[0]->detpgtoant[0]->codcateg = 101;

$std->infopgto[0]->detpgtoant[0]->infopgtoant[0] = new \stdClass();
$std->infopgto[0]->detpgtoant[0]->infopgtoant[0]->tpbcirrf = '01';
$std->infopgto[0]->detpgtoant[0]->infopgtoant[0]->vrbcirrf = 3452.87;

$std->infopgto[0]->idepgtoext = new \stdClass();
$std->infopgto[0]->idepgtoext->codpais = '008';
$std->infopgto[0]->idepgtoext->indnif = 3;
$std->infopgto[0]->idepgtoext->nifbenef = '298983927937';

$std->infopgto[0]->idepgtoext->endext = new \stdClass();
$std->infopgto[0]->idepgtoext->endext->dsclograd = 'lkjslkjsksj';
$std->infopgto[0]->idepgtoext->endext->nrlograd = '123';
$std->infopgto[0]->idepgtoext->endext->complem = 'kjdhkdjdhj';
$std->infopgto[0]->idepgtoext->endext->bairro = 'kjdlkdjkdjk';
$std->infopgto[0]->idepgtoext->endext->nmcid = 'lkwjlkjekj';
$std->infopgto[0]->idepgtoext->endext->codpostal = '1230099';

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
    $jsonSchemaObject
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
