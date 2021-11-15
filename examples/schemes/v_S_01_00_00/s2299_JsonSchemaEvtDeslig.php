<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2299 versão inicial e-social simplificado v1.0.0

$evento  = 'evtDeslig';
$version = 'S_01_00_00';

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
                    "pattern": "^[0-9]{14}$"
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
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
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
                                                    "pattern": "^(A|B|C|D|E|G|H)$"
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
                                "maximum": 4
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
        "quarentena": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtfimquar": {
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
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789';
$std->indguia = 1;
$std->cpftrab = '99999999999';
$std->matricula = '1234infomv56788-56478ABC';
$std->mtvdeslig = '02';
$std->dtdeslig = '2017-11-25';
$std->indpagtoapi = 'S';
$std->dtprojfimapi = '2017-11-25';
$std->pensalim = 2;
$std->percaliment = 22;
$std->vralim = 1234.45;
$std->nrproctrab = '12345678901234567890';
$std->infoInterm[0] = new \stdClass();
$std->infoInterm[0]->dia = 12;

$std->observacoes[0] = new \stdClass();
$std->observacoes[0]->observacao = 'observacao';

$std->sucessaovinc = new \stdClass();
$std->sucessaovinc->tpinsc = 1;
$std->sucessaovinc->nrinsc = '12345678901234';

$std->transftit = new \stdClass();
$std->transftit->cpfsubstituto = '12345678901';
$std->transftit->dtnascto = '1969-10-04';

$std->mudancacpf = new \stdClass();
$std->mudancacpf->novocpf = '12345678901';

$std->verbasresc = new \stdClass();
$std->verbasresc->dmdev[1] = new \stdClass();
$std->verbasresc->dmdev[1]->idedmdev = 'akakakak737477382828282828282';
$std->verbasresc->dmdev[1]->infoperapur = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->nrinsc = '12345678901234';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->codlotacao = 'asdfg';

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->idetabrubr = '12345678';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->qtdrubr = 25.45;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->fatorrubr = 1.56;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->vrrubr = 200.56;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->indapurir = 0;

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo->grauexp = 2;

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->dmdev[1]->infoperant = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dtacconv = '2017-04-02';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->tpacconv = 'A';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dsc = 'kksksks k skjskjskjs sk';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->perref = '2017-01';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->nrinsc = '12345678901234';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->codlotacao = 'asdfg';

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->idetabrubr = '12345678';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->qtdrubr = 25.45;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->fatorrubr = 1.56;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->vrrubr = 200.56;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->indapurir = 0;

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo->grauexp = 2;

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->procjudtrab[1] = new \stdClass();
$std->verbasresc->procjudtrab[1]->tptrib = 3;
$std->verbasresc->procjudtrab[1]->nrprocjud = '12345678901234567890';
$std->verbasresc->procjudtrab[1]->codsusp = '12345678901234';

$std->verbasresc->infomv = new \stdClass();
$std->verbasresc->infomv->indmv = 2;

$std->verbasresc->infomv->remunoutrempr[1] = new \stdClass();
$std->verbasresc->infomv->remunoutrempr[1]->tpinsc = 1;
$std->verbasresc->infomv->remunoutrempr[1]->nrinsc = '12345678901234';
$std->verbasresc->infomv->remunoutrempr[1]->codcateg = '001';
$std->verbasresc->infomv->remunoutrempr[1]->vlrremunoe = 2535.97;

$std->verbasresc->proccs = new \stdClass();
$std->verbasresc->proccs->nrprocjud = '12345678901234567890';
 
$std->quarentena = new \stdClass();
$std->quarentena->dtfimquar = '2018-12-20';
         
$std->consigfgts[0] = new \stdClass();
$std->consigfgts[0]->insconsig = '12345';
$std->consigfgts[0]->nrcontr = '123456789012345';

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
