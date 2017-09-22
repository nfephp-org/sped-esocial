<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtEvtRmnRPPS';
$version = '02_02_02';

$jsonSchema = '{
    "title": "evtEvtRmnRPPS",
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
            "type": "string",
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
        "idetrabalhador": {
            "required": true,
            "type": "object",
            "properties": {
                "cpftrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "nistrab": {
                    "required": false,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "qtddepfp": {
                    "required": false,
                    "type": "integer",
                    "maxLength": 2
                },
                "procjudtrab": {
                    "required": false,
                    "type": "array",
                    "minItems": 0,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "tptrib": {
                                 "required": true,
                                 "type": "integer",
                                 "maxLength": 1,
                                 "pattern": "([1-4]){1}$"
                            },
                            "nrprocjud": {
                                "required": true,
                                "type": "string",
                                "maxLength": 20
                            },
                            "codsusp": {
                                "required": true,
                                "type": "integer",
                                "maxLength": 14
                            }
                        }
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
                    "infoperapur": {
                        "required": true,
                        "type": "object",
                        "properties": {
                            "ideestab": {
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
                                            "minLength": 8,
                                            "maxLength": 15,
                                            "pattern": "^[0-9]"
                                        },
                                        "remunperapur": {
                                            "required": true,
                                            "type": "array",
                                            "minItems": 1,
                                            "maxItems": 10,
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "matricula": {
                                                        "required": false,
                                                        "type": "string",
                                                        "maxLength": 30
                                                    },
                                                    "codcateg": {
                                                        "required": true,
                                                        "type": "integer",
                                                        "minimum": 101,
                                                        "maximum": 905
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
                                                                    "type": "integer",
                                                                    "maxLength": 6
                                                                },
                                                                "fatorrubr": {
                                                                    "required": false,
                                                                    "type": "integer",
                                                                    "maxLength": 5
                                                                },
                                                                "vrunit": {
                                                                    "required": false,
                                                                    "type": "integer",
                                                                    "maxLength": 14
                                                                },
                                                                "vrrubr": {
                                                                    "required": true,
                                                                    "type": "integer",
                                                                    "maxLength": 14
                                                                }
                                                            }
                                                        }
                                                    },
                                                    "infosaudecolet": {
                                                        "required": false,
                                                        "type": "object",
                                                        "properties": {
                                                            "detoper": {
                                                                "required": true,
                                                                "type": "array",
                                                                "minItems": 1,
                                                                "maxItems": 99,
                                                                "items": {
                                                                    "type": "object",
                                                                    "properties": {                                       
                                                                        "cnpjoper": {
                                                                            "required": true,
                                                                            "type": "string",
                                                                            "maxLength": 14
                                                                        },
                                                                        "regans": {
                                                                            "required": true,
                                                                            "type": "string",
                                                                            "maxLength": 6
                                                                        },
                                                                        "vrpgtit": {
                                                                            "required": true,
                                                                            "type": "integer",
                                                                            "maxLength": 14
                                                                        },
                                                                        "detplano": {
                                                                            "required": false,
                                                                            "type": "array",
                                                                            "minItems": 0,
                                                                            "maxItems": 99,
                                                                            "items": {
                                                                                "type": "object",
                                                                                "properties": {                                       
                                                                                    "tpdep": {
                                                                                        "required": true,
                                                                                        "type": "string",
                                                                                        "maxLength": 2
                                                                                    },
                                                                                    "cpfdep": {
                                                                                        "required": false,
                                                                                        "type": "string",
                                                                                        "maxLength": 11
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
                                                                                        "type": "integer",
                                                                                        "maxLength": 14
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
                    "infoperant": {
                        "required": true,
                        "type": "object",
                        "properties": {
                            "ideadc": {
                                "required": true,
                                "type": "array",
                                "minItems": 0,
                                "maxItems": 99,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "dtlei": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                        },
                                        "nrlei": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 12
                                        },
                                        "dtef": {
                                            "required": false,
                                            "type": "string",
                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                        },
                                        "ideperiodo": {
                                            "required": true,
                                            "type": "array",
                                            "minItems": 1,
                                            "maxItems": 200,
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "perref": {
                                                        "required": true,
                                                        "type": "string",
                                                        "maxLength": 7
                                                    },
                                                    "ideestab": {
                                                        "required": true,
                                                        "type": "array",
                                                        "minItems": 1,
                                                        "maxItems": 24,
                                                        "items": {
                                                            "type": "object",
                                                            "properties": {
                                                                "remunperant": {
                                                                    "required": true,
                                                                    "type": "array",
                                                                    "minItems": 1,
                                                                    "maxItems": 10,
                                                                    "items": {
                                                                        "type": "object",
                                                                        "properties": {
                                                                            "matricula": {
                                                                                "required": false,
                                                                                "type": "string",
                                                                                "maxLength": 30
                                                                            },
                                                                            "codcateg": {
                                                                                "required": true,
                                                                                "type": "integer",
                                                                                "minimum": 101,
                                                                                "maximum": 905
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
                                                                                            "type": "integer",
                                                                                            "maxLength": 6
                                                                                        },
                                                                                        "fatorrubr": {
                                                                                            "required": false,
                                                                                            "type": "integer",
                                                                                            "maxLength": 5
                                                                                        },
                                                                                        "vrunit": {
                                                                                            "required": false,
                                                                                            "type": "integer",
                                                                                            "maxLength": 14
                                                                                        },
                                                                                        "vrrubr": {
                                                                                            "required": true,
                                                                                            "type": "integer",
                                                                                            "maxLength": 14
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
            }
        }
    }
}';

$std              = new \stdClass();
$std->sequencial  = 1;
$std->indretif    = 1;
$std->nrrecibo    = '123456';
$std->indapuracao = 1;
$std->perapur     = '2017-08';

$std->idetrabalhador          = new \stdClass();
$std->idetrabalhador->cpftrab = '11111111111';

$std->idetrabalhador->procjudtrab[0]            = new \stdClass();
$std->idetrabalhador->procjudtrab[0]->tptrib    = 1;
$std->idetrabalhador->procjudtrab[0]->nrprocjud = '12456';
$std->idetrabalhador->procjudtrab[0]->codsusp   = 123456;

$std->dmdev[0]           = new \stdClass();
$std->dmdev[0]->idedmdev = '213789';

$std->dmdev[0]->infoperapur = new \stdClass();

$std->dmdev[0]->infoperapur->ideestab[0]         = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->tpinsc = 1;
$std->dmdev[0]->infoperapur->ideestab[0]->nrinsc = '11111111111111';

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]            = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->matricula = '12365110';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->codcateg  = 101;

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]             = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->codrubr    = '123150';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->idetabrubr = '12345678';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->qtdrubr    = 1;
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->fatorrubr  = 1;
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->vrrubr     = 1;

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet                       = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]           = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->cnpjoper = '11111111111111';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->regans   = '111111';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->vrpgtit  = 1500;

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]           = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->tpdep    = '01';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->cpfdep   = '11111111111';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->nmdep    = 'NOME';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->dtnascto = '1987-01-01';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->vlrpgdep = 1500;

$std->dmdev[0]->infoperant                   = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]        = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->dtlei = '2017-08-29';
$std->dmdev[0]->infoperant->ideadc[0]->nrlei = '20170829';
$std->dmdev[0]->infoperant->ideadc[0]->dtef  = '2017-08-29';

$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]         = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->perref = '2017-08';

$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]         = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->tpinsc = 1;
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->nrinsc = '11111111111111';

$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]           = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->codcateg = 101;

$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]             = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]->codrubr    = '1615615';
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]->idetabrubr = '1615615';
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]->qtdrubr    = 12345;
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]->fatorrubr  = 12345;
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]->vrunit     = 1500;
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]->vrrubr     = 1500;


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
file_put_contents("../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
