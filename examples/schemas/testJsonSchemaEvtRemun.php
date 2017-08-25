<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtRemun';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtRemun",
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
            "minLength": 1,
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
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
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
                                "type": "integer",
                                "minimum": 101,
                                "maximum": 999
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
        "infocomplem": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nmtrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 70
                },
                "dtnascto": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "codcbo": {
                    "required": true,
                    "type": "string",
                    "minLength": 6,
                    "maxLength": 6,
                    "pattern": "^[0-9]"
                },
                "natatividade": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 2
                },
                "qtddiastrab": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 31
                },
                "sucessaovinc": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "cnpjempregant": {
                            "required": true,
                            "type": "string",
                            "maxLength": 14,
                            "pattern": "^[0-9]"
                        },
                        "matricant": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 30
                        },
                        "dtinivinculo": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "observacao": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 255
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
                        "maxLength": 14
                    }
                }
            }    
        },
        "dmdev": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "idedmdev": {
                        "required": true,
                        "type": "string",
                        "maxLength": 30
                    },
                    "codcateg": {
                        "required": true,
                        "type": "integer",
                        "minimum": 101,
                        "maximum": 999
                    },
                    "ideestablot": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 500,
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
                                    "maxLength": 15,
                                    "pattern": "^[0-9]"
                                },
                                "codlotacao": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 30
                                },
                                "qtddiasav": {
                                    "required": false,
                                    "type": ["integer","null"],
                                    "minimum": 1
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
                                                "type": ["string","null"],
                                                "maxLength": 30
                                            },
                                            "indsimples": {
                                                "required": false,
                                                "type": ["integer","null"],
                                                "minimum": 1,
                                                "maximum": 3
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
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        }
                                                    }
                                                }    
                                            },
                                            "detoper": {
                                                "required": false,
                                                "type": ["array","null"],
                                                "minItems": 0,
                                                "maxItems": 99,
                                                "items": {
                                                    "type": "object",
                                                    "properties": {
                                                        "cnpjoper": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 14,
                                                            "pattern": "^[0-9]"
                                                        },
                                                        "regans": {
                                                            "required": true,
                                                            "type": "string",
                                                            "minLength": 6,
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
                                                                        "maxLength": 2,
                                                                        "pattern": "^[0-9]"
                                                                    },
                                                                    "cpfdep": {
                                                                        "required": false,
                                                                        "type": ["string","null"],
                                                                        "maxLength": 11,
                                                                        "pattern": "^[0-9]"
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
                                    }    
                                }
                            }
                        }    
                    },
                    "ideadc": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 8,
                        "items": {
                            "type": "object",
                            "properties": {
                                "dtacconv": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                },
                                "tpacconv": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "A|B|C|D|E|F"
                                },
                                "compacconv": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
                                },
                                "dtefacconv": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                },
                                "dsc": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 255
                                },
                                "remunsuc": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 1,
                                    "pattern": "S|N"
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
                                                "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
                                            },
                                            "ideestablot": {
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
                                                            "maximum": 3
                                                        },
                                                        "nrinsc": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 15,
                                                            "pattern": "^[0-9]"
                                                        },
                                                        "codlotacao": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 30
                                                        },
                                                        "remunperant": {
                                                            "required": true,
                                                            "type": "array",
                                                            "minItems": 1,
                                                            "maxItems": 8,
                                                            "items": {
                                                                "type": "object",
                                                                "properties": {
                                                                    "matricula": {
                                                                        "required": false,
                                                                        "type": ["string","null"],
                                                                        "maxLength": 30
                                                                    },
                                                                    "indsimples": {
                                                                        "required": false,
                                                                        "type": ["integer","null"],
                                                                        "minimum": 1,
                                                                        "maximum": 3
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
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = 'abcdefghijklmnopq';
$std->indapuracao = 2;
$std->perapur = '2017-12';
$std->cpfTrab = '12345678901';
$std->nisTrab = '10987654321';

$std->infomv = new \stdClass();
$std->infomv->indmv = 1;
$std->infomv->remunoutrempr[0] = new \stdClass();
$std->infomv->remunoutrempr[0]->tpinsc = 1;
$std->infomv->remunoutrempr[0]->nrinsc = '123456789012345';
$std->infomv->remunoutrempr[0]->codcateg = 901;
$std->infomv->remunoutrempr[0]->vlrremunoe = 2345.09;

$std->infocomplem = new \stdClass();
$std->infocomplem->nmtrab = 'Fulano de Tal';
$std->infocomplem->dtnascto = '1985-02-14';
$std->infocomplem->codcbo = '123456';
$std->infocomplem->natatividade = 1;
$std->infocomplem->qtddiastrab = 6;

$std->infocomplem->sucessaovinc = new \stdClass();
$std->infocomplem->sucessaovinc->cnpjempregant = '12345678901234';
$std->infocomplem->sucessaovinc->matricant = 'jkdjkjdkjdjkd';
$std->infocomplem->sucessaovinc->dtinivinculo = '2017-06-07';
$std->infocomplem->sucessaovinc->observacao = 'nao obrigatorio';

$std->procjudtrab[0] = new \stdClass();
$std->procjudtrab[0]->tptrib = 2;
$std->procjudtrab[0]->nrprocjud = '123456789';
$std->procjudtrab[0]->codsusp = '12345678901234';

$std->dmdev[0] = new \stdClass();
$std->dmdev[0]->idedmdev = 'kjdkjdkjdkdj';
$std->dmdev[0]->codcateg = 101;

$std->dmdev[0]->ideestablot[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->tpinsc = 2;
$std->dmdev[0]->ideestablot[0]->nrinsc = '123456789012345';
$std->dmdev[0]->ideestablot[0]->codlotacao = 'qlkjakljwj';
$std->dmdev[0]->ideestablot[0]->qtddiasav = 20;

$std->dmdev[0]->ideestablot[0]->remunperapur[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->matricula = 'kjsksjksjskjsk';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->indsimples = 1;

$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->codrubr = 'ksksksks';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->idetabrubr = 'j2j2j';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->qtdrubr = 150.30;
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->fatorrubr = 1.20;
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->vrunit = 123.90;
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->vrrubr = 123.90;

$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->cnpjoper = '12345678901234';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->regans = 'asdfgh';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->vrpgtit = 1234.50;

$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->tpdep = '01';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->cpfdep = '12345678901';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->nmdep = 'Maria Maria de Tal';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->dtnascto = '1991-09-15';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->vlrpgdep = 912.68;

$std->dmdev[0]->ideestablot[0]->remunperapur[0]->infoagnocivo = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->infoagnocivo->grauexp = 1;

$std->dmdev[0]->ideadc[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->dtacconv = '2016-12-10';
$std->dmdev[0]->ideadc[0]->tpacconv = 'A';
$std->dmdev[0]->ideadc[0]->compacconv = '2017-01';
$std->dmdev[0]->ideadc[0]->dtefacconv = '2017-10-12';
$std->dmdev[0]->ideadc[0]->dsc = 'descricao';
$std->dmdev[0]->ideadc[0]->remunsuc = 'S';

$std->dmdev[0]->ideadc[0]->ideperiodo[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->perref = '2017-01';

$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->tpinsc = 1;
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->nrinsc = '12345678901234';
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->codlotacao = 'ksjskjkjskjjs';

$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->matricula = 'kjskjskjskjs';
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->indsimples = 1;

$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->codrubr = 'aaaaa';
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->idetabrubr = 'bbbbb';
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->qtdrubr = 12.65;
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->fatorrubr = 2.99;
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->vrunit = 123.02;
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->vrrubr = 169.99;

$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->infoagnocivo = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->infoagnocivo->grauexp = 2;

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
file_put_contents("../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
