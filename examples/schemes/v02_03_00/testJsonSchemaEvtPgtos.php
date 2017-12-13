<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtPgtos';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtPgtos",
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
        "indapuracao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "perapur": {
            "required": true,
            "type": "string",
            "maxLength": 7
        },
        "idebenef": {
            "required": true,
            "type": "object",
            "properties": {
                "cpfbenef": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "vrdeddep": {
                    "required": false,
                    "type": ["number","null"]
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
                                "maximum": 6
                            },
                            "indresbr": {
                                "required": true,
                                "type": "string",
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
                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                                        },
                                        "idedmdev": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 30
                                        },
                                        "indpgtott": {
                                            "required": true,
                                            "type": "string",
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
                                                    }
                                                }
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
                                                            "maxLength": 11,
                                                            "minLength": 11
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
                                }
                            },
                            "detpgtobenpr": {
                                "required": false,
                                "type": "object",
                                "properties": {
                                    "perref": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                                    },
                                    "idedmdev": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 30
                                    },
                                    "indpgtott": {
                                        "required": true,
                                        "type": "string",
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
                                                                    "maxLength": 11,
                                                                    "minLength": 11
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
                                                        "maxLength": 2
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
                                        "minLength": 3,
                                        "maxLength": 3,
                                        "pattern": "^[0-9]"
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
                                    "dsclograd": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 80
                                    },
                                    "nrlograd": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 10
                                    },
                                    "complem": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 30
                                    },
                                    "bairro": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 60
                                    },
                                    "nmcid": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 50
                                    },
                                    "codpostal": {
                                        "required": true,
                                        "type": "string",
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
$std->nrrecibo = '123456';
$std->indapuracao = 1;
$std->perapur = '2017-08';

$std->idebenef = new \stdClass();
$std->idebenef->cpfbenef = '99999999999';
$std->idebenef->vrdeddep = 28657.59;
$std->idebenef->infopgto[0] = new \stdClass();
$std->idebenef->infopgto[0]->dtpgto = '2017-09-15';
$std->idebenef->infopgto[0]->tppgto = 1; //1,2,3,5,6
$std->idebenef->infopgto[0]->indresbr = 'S'; //SN
$std->idebenef->infopgto[0]->detpgtofl[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofl[0]->perref = '2017-09';
$std->idebenef->infopgto[0]->detpgtofl[0]->idedmdev = 'aaaaaaaa';
$std->idebenef->infopgto[0]->detpgtofl[0]->indpgtott = 'S'; //SN
$std->idebenef->infopgto[0]->detpgtofl[0]->vrliq = 1587.91;
$std->idebenef->infopgto[0]->detpgtofl[0]->nrrecarq = '234567';
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->codrubr = '2222222';
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->qtdrubr = 22.56;
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->fatorrubr = 50.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->vrrubr = 2000.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->cpfbenef = '99999999999';
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->dtnasctobenef = '1998-12-12';
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->nmbenefic = 'Fulano de Tal';
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->vlrpensao = 1024.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->codrubr = '2222222';
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->qtdrubr = 22.56;
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->fatorrubr = 50.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->vrrubr = 2000.00;
$std->idebenef->infopgto[0]->detpgtobenpr = new \stdClass();
$std->idebenef->infopgto[0]->detpgtobenpr->perref = '2018-09';
$std->idebenef->infopgto[0]->detpgtobenpr->idedmdev = 'dlkjdljdkdj';
$std->idebenef->infopgto[0]->detpgtobenpr->indpgtott = 'S';
$std->idebenef->infopgto[0]->detpgtobenpr->vrliq = 1000.00;
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->codrubr = 'lskslkslks';
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->qtdrubr = 22.56;
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->fatorrubr = 50.00;
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->vrrubr = 2000.00;
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->codrubr = 'lskslkslks';
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->qtdrubr = 22.56;
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->fatorrubr = 50.00;
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->vrrubr = 2000.00;
$std->idebenef->infopgto[0]->detpgtofer[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofer[0]->codcateg = 111;
$std->idebenef->infopgto[0]->detpgtofer[0]->dtinigoz = '2017-10-01';
$std->idebenef->infopgto[0]->detpgtofer[0]->qtdias = 30;
$std->idebenef->infopgto[0]->detpgtofer[0]->vrliq = 4598.65;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->codrubr = 'jssj98338w';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->qtdrubr = 22.25;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->fatorrubr = 100;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->vrrubr = 1000.00;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->cpfbenef = '99999999999';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->dtnasctobenef = '1987-10-22';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->nmbenefic = 'Fulano de Tal';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->vlrpensao = 1000.00;
$std->idebenef->infopgto[0]->detpgtoant[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtoant[0]->codcateg = 101;
$std->idebenef->infopgto[0]->detpgtoant[0]->infopgtoant[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtoant[0]->infopgtoant[0]->tpbcirrf = '01';
$std->idebenef->infopgto[0]->detpgtoant[0]->infopgtoant[0]->vrbcirrf = 22569.93;
$std->idebenef->infopgto[0]->idepgtoext = new \stdClass();
$std->idebenef->infopgto[0]->idepgtoext->codpais = '001';
$std->idebenef->infopgto[0]->idepgtoext->indnif = 1;
$std->idebenef->infopgto[0]->idepgtoext->nifbenef = '1245474';
$std->idebenef->infopgto[0]->idepgtoext->dsclograd = 'PARK AV';
$std->idebenef->infopgto[0]->idepgtoext->nrlograd = '123';
$std->idebenef->infopgto[0]->idepgtoext->complem = 'R13';
$std->idebenef->infopgto[0]->idepgtoext->bairro = 'SOHO';
$std->idebenef->infopgto[0]->idepgtoext->nmcid = 'NEW YORK';
$std->idebenef->infopgto[0]->idepgtoext->codpostal = '000000000000';


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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
