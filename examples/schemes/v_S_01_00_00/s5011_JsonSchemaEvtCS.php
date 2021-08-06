<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-5011
//Grupo {infoComplObra} – alterada condição.
//Campo {vrSuspBcCp00} – alterada descrição da origem.
//Campo {vrSuspBcCp15} – alterada descrição da origem.
//Campo {vrSuspBcCp20} – alterada descrição da origem.
//Campo {vrSuspBcCp25} – alterada descrição da origem.
//Campo {vrCPCalcPR} – alterado cálculo da alínea a).

$evento  = 'evtCS';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtCS",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
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
            "pattern": "^([0-9]{4}-(0[1-9]{1}|1[0-2]{1}))$"
        },
        "nrrecarqbase": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 40
        },
        "indexistinfo": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 3
        },
        "infocpseg": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "vrdesccp": {
                    "required": true,
                    "type": "number"
                },
                "vrcpseg": {
                    "required": true,
                    "type": "number"
                }
            }
        },
        "infocontrib": {
            "required": true,
            "type": "object",
            "properties": {
                "classtrib": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{2}$"
                },
                "infopj": {
                    "indcoop": {
                        "required": false,
                        "type": ["integer","null"],
                        "minimum": 0,
                        "maximum": 3
                    },
                    "indconstr": {
                        "required": true,
                        "type": "integer",
                        "minimum": 0,
                        "maximum": 1
                    },
                    "indsubstpatr": {
                        "required": false,
                        "type": ["integer","null"],
                        "minimum": 1,
                        "maximum": 2
                    },
                    "percredcontrib": {
                        "required": false,
                        "type": ["number","null"]
                    },
                    "infoatconc": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "fatormes": {
                                "required": true,
                                "type": "number"
                            },
                            "fator13": {
                                "required": true,
                                "type": "number"
                            }
                        }
                    }
                }
            }    
        },
        "ideestab": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 9999,
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
                        "pattern": "^[0-9]{8,14}$"
                    },
                    "infoestab": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "cnaeprep": {
                                "required": true,
                                "type": "integer"
                            },
                            "aliqrat": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 4
                            },
                            "fap": {
                                "required": true,
                                "type": "number",
                                "minimum": 0.5,
                                "maximum": 2.0
                            },
                            "aliqratajust": {
                                "required": true,
                                "type": "number",
                                "maximun": 6
                            },
                            "infocomplobra": {
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
                            }
                        },
                        "idelotacao": {
                            "required": false,
                            "type": ["array","null"],
                            "minItems": 0,
                            "maxItems": 99,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "codlotacao": {
                                        "required": true,
                                        "type": "string",
                                        "minLength": 1,
                                        "maxLength": 30
                                    },
                                    "fpas": {
                                        "required": true,
                                        "type": "integer"
                                    },
                                    "codtercs": {
                                        "required": true,
                                        "type": "string",
                                        "minLength": 4,
                                        "maxLength": 4
                                    },
                                    "codtercssusp": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "minLength": 4,
                                        "maxLength": 4
                                    },
                                    "infotercsusp": {
                                        "required": false,
                                        "type": ["array","null"],
                                        "minItems": 0,
                                        "maxItems": 15,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "codterc": {
                                                    "required": true,
                                                    "type": "string",
                                                    "minLength": 4,
                                                    "maxLength": 4
                                                }
                                            }
                                        }
                                    },
                                    "infoemprparcial": {
                                        "required": false,
                                        "type": "object",
                                        "properties": {
                                            "tpinsccontrat": {
                                                "required": true,
                                                "type": "integer",
                                                "minimum": 1,
                                                "maximum": 2
                                            },
                                            "nrinsccontrat": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{11,14}$"
                                            },
                                            "tpinscprop": {
                                                "required": true,
                                                "type": "integer",
                                                "minimum": 1,
                                                "maximum": 2
                                            },
                                            "nrinscprop": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{11,14}$"
                                            },
                                            "cnoobra": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{12}$"
                                            }
                                        }
                                    },
                                    "dadosopport": {
                                        "required": false,
                                        "type": "object",
                                        "properties": {
                                            "cnpjopportuario": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{14}$"
                                            },
                                            "aliqrat": {
                                                "required": true,
                                                "type": "integer",
                                                "minimum": 1,
                                                "maximum": 3
                                            },
                                            "fap": {
                                                "required": true,
                                                "type": "number"
                                            },
                                            "aliqratajust": {
                                                "required": true,
                                                "type": "number",
                                                "maximun": 6
                                            }
                                        }
                                    },
                                    "basesremun": {
                                        "required": false,
                                        "type": ["array","null"],
                                        "minItems": 0,
                                        "maxItems": 99,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "indincid": {
                                                    "required": true,
                                                    "type": "integer",
                                                    "minimum": 1,
                                                    "maximum": 9
                                                },
                                                "codcateg": {
                                                    "required": true,
                                                    "type": "integer",
                                                    "minumum": 101,
                                                    "maximum": 999
                                                }
                                            },
                                            "basescp": {
                                                "required": true,
                                                "type": "object",
                                                "properties": {
                                                    "vrbccp00": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrbccp15": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrbccp20": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrbccp25": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrsuspbccp00": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrsuspbccp15": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrsuspbccp20": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrsuspbccp25": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrdescsest": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrcalcsest": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrdescsenat": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrcalcsenat": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrsalfam": {
                                                        "required": true,
                                                        "type": "number"
                                                    },
                                                    "vrsalmat": {
                                                        "required": true,
                                                        "type": "number"
                                                    }
                                                }
                                            }
                                        }    
                                    },
                                    "basesavnport": {
                                        "required": false,
                                        "type": ["object","null"],
                                        "properties": {
                                            "vrbccp00": {
                                                "required": true,
                                                "type": "number"
                                            },
                                            "vrbccp15": {
                                                "required": true,
                                                "type": "number"
                                            },
                                            "vrbccp20": {
                                                "required": true,
                                                "type": "number"
                                            },
                                            "vrbccp25": {
                                                "required": true,
                                                "type": "number"
                                            },
                                            "vrbccp13": {
                                                "required": true,
                                                "type": "number"
                                            },
                                            "vrbcfgts": {
                                                "required": true,
                                                "type": "number"
                                            },
                                            "vrdesccp": {
                                                "required": true,
                                                "type": "number"
                                            }
                                        }
                                    },
                                    "infosubstpatropport": {
                                        "required": false,
                                        "type": ["array","null"],
                                        "minItems": 0,
                                        "maxItems": 999,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "cnpjopportuario": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^[0-9]{14}$"
                                                }
                                            }
                                        }    
                                    }
                                }    
                            }    
                        }
                    },
                    "basesaquis": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 3,
                        "items": {
                            "type": "object",
                            "properties": {
                                "indaquis": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 3
                                },
                                "vlraquis": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrcpdescpr": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrcpnret": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrratnret": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrsenarnret": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrcpcalcpr": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrratdescpr": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrratcalcpr": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrsenardesc": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrsenarcalc": {
                                    "required": true,
                                    "type": "number"
                                }
                            }
                        }
                    },
                    "basescomerc": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 4,
                        "items": {
                            "type": "object",
                            "properties": {
                                "indcomerc": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 2,
                                    "maximum": 9
                                },
                                "vrbccompr": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrcpsusp": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrratsusp": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrsenarsusp": {
                                    "required": true,
                                    "type": "number"
                                }
                            }
                        }    
                    },
                    "infocrestab": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 99,
                        "items": {
                            "type": "object",
                            "properties": {
                                "tpcr": {
                                    "required": true,
                                    "type": "integer"
                                },
                                "vrcr": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrsuspcr": {
                                    "required": true,
                                    "type": "number"
                                }
                            }
                        }    
                    }
                }    
            }    
        },
        "infocrcontrib": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "tpcr": {
                        "required": true,
                        "type": "integer"
                    },
                    "vrcr": {
                        "required": true,
                        "type": "number"
                    },
                    "vrcrsusp": {
                        "required": true,
                        "type": "number"
                    }
                }
            }            
        }
    }    
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indapuracao = 1;
$std->perapur = '2017-11';
$std->nrrecarqbase = 'ksksksk1211_40';
$std->indexistinfo = 3;

$std->infocpseg = new \stdClass();
$std->infocpseg->vrdesccp = 222.56;
$std->infocpseg->vrcpseg = 333.89;
$std->infocontrib = new \stdClass();
$std->infocontrib->classtrib = '02';
$std->infocontrib->infopj = new \stdClass();
$std->infocontrib->infopj->indcoop = 0;
$std->infocontrib->infopj->indconstr = 1;
$std->infocontrib->infopj->indsubstpatr = 2;
$std->infocontrib->infopj->percredcontrib = 23.45;
$std->infocontrib->infopj->infoatconc = new \stdClass();
$std->infocontrib->infopj->infoatconc->fatormes = 0.96;
$std->infocontrib->infopj->infoatconc->fator13 = 0.01;

$std->ideestab[1] = new \stdClass();
$std->ideestab[1]->tpinsc = 4;
$std->ideestab[1]->nrinsc = '12345678901234';
$std->ideestab[1]->infoestab = new \stdClass();
$std->ideestab[1]->infoestab->cnaeprep = 12345;
$std->ideestab[1]->infoestab->aliqrat = 4;
$std->ideestab[1]->infoestab->fap = 0.5;
$std->ideestab[1]->infoestab->aliqratajust = 2.00;
$std->ideestab[1]->infoestab->infocomplobra = new \stdClass();
$std->ideestab[1]->infoestab->infocomplobra->indsubstpatrobra = 1;

$std->ideestab[1]->idelotacao[1] = new \stdClass();
$std->ideestab[1]->idelotacao[1]->codlotacao = 'kjskjsksj';
$std->ideestab[1]->idelotacao[1]->fpas = 111;
$std->ideestab[1]->idelotacao[1]->codtercs = 'lsls';
$std->ideestab[1]->idelotacao[1]->codtercssusp = 'oeoe';
$std->ideestab[1]->idelotacao[1]->infotercsusp[1] = new \stdClass();
$std->ideestab[1]->idelotacao[1]->infotercsusp[1]->codterc = 'aaaa';
$std->ideestab[1]->idelotacao[1]->infoemprparcial = new \stdClass();
$std->ideestab[1]->idelotacao[1]->infoemprparcial->tpinsccontrat = 1;
$std->ideestab[1]->idelotacao[1]->infoemprparcial->nrinsccontrat = '12345678901234';
$std->ideestab[1]->idelotacao[1]->infoemprparcial->tpinscprop = 2;
$std->ideestab[1]->idelotacao[1]->infoemprparcial->nrinscprop = '12345678901';
$std->ideestab[1]->idelotacao[1]->infoemprparcial->cnoobra = '123456789012';

$std->ideestab[1]->idelotacao[1]->dadosopport = new \stdClass();
$std->ideestab[1]->idelotacao[1]->dadosopport->cnpjopportuario = '12345678901234';
$std->ideestab[1]->idelotacao[1]->dadosopport->aliqrat = 3;
$std->ideestab[1]->idelotacao[1]->dadosopport->fap = 1.0;
$std->ideestab[1]->idelotacao[1]->dadosopport->aliqratajust = 2.99;
$std->ideestab[1]->idelotacao[1]->basesremun[1] = new \stdClass();
$std->ideestab[1]->idelotacao[1]->basesremun[1]->indincid = 9;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->codcateg = 123;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp = new \stdClass();
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrbccp00 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrbccp15 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrbccp20 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrbccp25 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsuspbccp00 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsuspbccp15 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsuspbccp20 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsuspbccp25 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrdescsest = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrcalcsest = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrdescsenat = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrcalcsenat = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsalfam = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsalmat = 100.00;
$std->ideestab[1]->idelotacao[1]->basesavnport = new \stdClass();
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp00 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp15 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp20 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp25 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp13 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbcfgts = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrdesccp = 222.22;

$std->ideestab[1]->idelotacao[1]->infosubstpatropport[1] = new \stdClass();
$std->ideestab[1]->idelotacao[1]->infosubstpatropport[1]->cnpjopportuario = '12345678901234';

$std->ideestab[1]->basesaquis[1] = new \stdClass();
$std->ideestab[1]->basesaquis[1]->indaquis = 2;
$std->ideestab[1]->basesaquis[1]->vlraquis = 333.33;
$std->ideestab[1]->basesaquis[1]->vrcpdescpr = 333.33;
$std->ideestab[1]->basesaquis[1]->vrcpnret = 333.33;
$std->ideestab[1]->basesaquis[1]->vrratnret = 333.33;
$std->ideestab[1]->basesaquis[1]->vrsenarnret = 333.33;
$std->ideestab[1]->basesaquis[1]->vrcpcalcpr = 333.33;
$std->ideestab[1]->basesaquis[1]->vrratdescpr = 333.33;
$std->ideestab[1]->basesaquis[1]->vrratcalcpr = 333.33;
$std->ideestab[1]->basesaquis[1]->vrsenardesc = 333.33;
$std->ideestab[1]->basesaquis[1]->vrsenarcalc = 333.33;

$std->ideestab[1]->basescomerc[1] = new \stdClass();
$std->ideestab[1]->basescomerc[1]->indcomerc = 8;
$std->ideestab[1]->basescomerc[1]->vrbccompr = 44.44;
$std->ideestab[1]->basescomerc[1]->vrcpsusp = 44.44;
$std->ideestab[1]->basescomerc[1]->vrratsusp = 44.44;
$std->ideestab[1]->basescomerc[1]->vrsenarsusp = 44.44;

$std->ideestab[1]->infocrestab[1] = new \stdClass();
$std->ideestab[1]->infocrestab[1]->tpcr = 12345;
$std->ideestab[1]->infocrestab[1]->vrcr = 55.55;
$std->ideestab[1]->infocrestab[1]->vrsuspcr = 55.55;

$std->infocrcontrib[1] = new \stdClass();
$std->infocrcontrib[1]->tpcr = 122;
$std->infocrcontrib[1]->vrcr = 1458.65;
$std->infocrcontrib[1]->vrcrsusp = 1400.65;


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
