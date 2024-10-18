<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2501

$evento  = 'evtContProc';
$version = 'S_01_03_00';

$jsonSchema = '{
    "title": "evtContProc",
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
        "nrproctrab": {
            "required": true,
            "type": "string",
            "pattern": "^(.{15}|.{20})$"
        },
        "perapurpgto": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/periodo"
        },
        "obs": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 999
        },
        "idetrab": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "items": {
                "type": "object",
                "properties": {
                    "cpftrab": {
                        "required": true,
                        "type": "string",
                        "pattern": "^[0-9]{11}$"
                    },
                    "calctrib": {
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
                                "vrbccpmensal": {
                                    "required": true,
                                    "type": "number"
                                },
                                "vrbccp13": {
                                    "required": true,
                                    "type": "number"
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
                                                "type": "string",
                                                "pattewrn": "^[0-9]{6}$"
                                            },
                                            "vrcr": {
                                                "required": true,
                                                "type": "number"
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    },
                    "infocrirrf": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 99,
                        "items": {
                            "type": "object",
                            "properties": {
                                "tpcr": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^(593656|188951)$"
                                },
                                "vrcr": {
                                    "required": true,
                                    "type": "number"
                                },
                                "infoir": {
                                    "required": false,
                                    "type": ["object","null"],
                                    "properties": {
                                        "vrrendtrib": {
                                            "required": false,
                                            "type": ["number","null"]
                                        },
                                        "vrrendtrib13": {
                                            "required": false,
                                            "type": ["number","null"]
                                        },
                                        "vrrendmolegrave": {
                                            "required": false,
                                            "type": ["number","null"]
                                        },
                                        "vrrendisen65": {
                                            "required": false,
                                            "type": ["number","null"]
                                        },
                                        "vrjurosmora": {
                                            "required": false,
                                            "type": ["number","null"]
                                        },
                                        "vrrendisenntrib": {
                                            "required": false,
                                            "type": ["number","null"]
                                        },
                                        "descisenntrib": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "minLength": 1,
                                            "maxLength": 60
                                        },
                                        "vrprevoficial": {
                                            "required": false,
                                            "type": ["number","null"]
                                        }
                                    }
                                },
                                "inforra": {
                                    "required": false,
                                    "type": ["object","null"],
                                    "properties": {
                                        "descrra": {
                                            "required": true,
                                            "type": "string",
                                            "minLength": 1,
                                            "maxLength": 50
                                        },
                                        "qtdmesesrra": {
                                            "required": true,
                                            "type": "integer",
                                            "minimum": 1,
                                            "maximum": 9999
                                        },
                                        "despprocjud": {
                                            "required": false,
                                            "type": ["object","null"],
                                            "properties": {
                                                "vlrdespcustas": {
                                                    "required": true,
                                                    "type": "number"
                                                },
                                                "vlrdespadvogados": {
                                                    "required": true,
                                                    "type": "number"
                                                },
                                                "ideadv": {
                                                    "required": false,
                                                    "type": ["array","null"],
                                                    "minItems": 0,
                                                    "maxItems": 99,
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
                                                                "pattern": "^[0-9]{11,14}$"
                                                            },
                                                            "vlradv": {
                                                                "required": false,
                                                                "type": ["number","null"]
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                },
                                "deddepen": {
                                    "required": false,
                                    "type": ["array","null"],
                                    "minItems": 0,
                                    "maxItems": 999,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "tprend": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^(11|12)$"
                                            },
                                            "cpfdep": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{11}$"
                                            },
                                            "vlrdeducao": {
                                                "required": true,
                                                "type": "number"
                                            }
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
                                            "tprend": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^(11|12|18|79)$"
                                            },
                                            "cpfdep": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{11}$"
                                            },
                                            "vlrpensao": {
                                                "required": true,
                                                "type": "number"
                                            }
                                        }
                                    }
                                },
                                "infoprocret": {
                                    "required": false,
                                    "type": ["array","null"],
                                    "minItems": 0,
                                    "maxItems": 50,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "tpprocret": {
                                                "required": true,
                                                "type": "integer",
                                                "minimum": 1,
                                                "maximum": 2
                                            },
                                            "nrprocret": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^(.{17}|.{20}|.{21})$"
                                            },
                                            "codsusp": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^(.{1,14})$"
                                            },
                                            "infovalores": {
                                                "required": false,
                                                "type": ["array","null"],
                                                "minItems": 0,
                                                "maxItems": 2,
                                                "items": {
                                                    "type": "object",
                                                    "properties": {
                                                        "indapuracao": {
                                                            "required": true,
                                                            "type": "integer",
                                                            "minimum": 1,
                                                            "maximum": 2
                                                        },
                                                        "vlrnretido": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "vlrdepjud": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "vlrcmpanocal": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "vlrcmpanoant": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "vlrrendsusp": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "dedsusp": {
                                                            "required": false,
                                                            "type": ["array","null"],
                                                            "minItems": 0,
                                                            "maxItems": 25,
                                                            "items": {
                                                                "type": "object",
                                                                "properties": {
                                                                    "indtpdeducao": {
                                                                        "required": true,
                                                                        "type": "string",
                                                                        "pattern": "^(1|5|7)$"
                                                                    },
                                                                    "vlrdedsusp": {
                                                                        "required": false,
                                                                        "type": ["number","null"]
                                                                    },
                                                                    "benefpen": {
                                                                        "required": false,
                                                                        "type": ["array","null"],
                                                                        "minItems": 0,
                                                                        "maxItems": 99,
                                                                        "items": {
                                                                            "type": "object",
                                                                            "properties": {
                                                                                "cpfdep": {
                                                                                    "required": true,
                                                                                    "type": "string",
                                                                                    "pattern": "^[0-9]{11}$"
                                                                                },
                                                                                "vlrdepensusp": {
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
                        }
                    },
                    "infoircomplem": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "dtlaudo": {
                                "required": false,
                                "type": ["string","null"],
                                "$ref": "#/definitions/data"
                            },
                            "infodep": {
                                "required": false,
                                "type": ["array","null"],
                                "minItems": 0,
                                "maxItems": 999,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "cpfdep": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^[0-9]{11}$"
                                        },
                                        "dtnascto": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "$ref": "#/definitions/data"
                                        },
                                        "nome": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "minLength": 2,
                                            "maxLength": 70
                                        },
                                        "depirrf": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "pattern": "^(S)$"
                                        },
                                        "tpdep": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "pattern": "^[0-9]{2}$"
                                        },
                                        "descrdep": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "minLength": 1,
                                            "maxLength": 100
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

$std->nrproctrab = '12345678901234567890'; //obrigatório
$std->perapurpgto = '2023-10';
$std->obs = 'Bla bla bla'; //opcional

$std->idetrab[0] = new \stdClass(); //obrigatório 1-n
$std->idetrab[0]->cpftrab = '12345678901';

$std->idetrab[0]->calctrib[0] = new \stdClass(); //opcional 0-999
$std->idetrab[0]->calctrib[0]->perref = '2023-10';
$std->idetrab[0]->calctrib[0]->vrbccpmensal = 2555.34;
$std->idetrab[0]->calctrib[0]->vrbccp13 = 2555.34;

$std->idetrab[0]->calctrib[0]->infocrcontrib[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->calctrib[0]->infocrcontrib[0]->tpcr = '113851';
$std->idetrab[0]->calctrib[0]->infocrcontrib[0]->vrcr = 325.87;

$std->idetrab[0]->infocrirrf[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->infocrirrf[0]->tpcr = '593656'; //593656 - IRRF - Decisão da Justiça do Trabalho 188951 - IRRF - RRA - Decisão da Justiça do Trabalho
$std->idetrab[0]->infocrirrf[0]->vrcr = 326.91;

$std->idetrab[0]->infocrirrf[0]->infoir = new \stdClass(); //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendtrib = 2555.34; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendtrib13 = 2555.34; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendmolegrave = 2000; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendisen65 = 2000; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrjurosmora = 32.48; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendisenntrib = 2000; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->descisenntrib = 'Bla bla bla'; //opcional 1-60
$std->idetrab[0]->infocrirrf[0]->infoir->vrprevoficial = 800; //opcional

$std->idetrab[0]->infocrirrf[0]->inforra = new \stdClass(); //opcional
$std->idetrab[0]->infocrirrf[0]->inforra->descrra = 'bla bla bla'; // 1-50
$std->idetrab[0]->infocrirrf[0]->inforra->qtdmesesrra = 4;

$std->idetrab[0]->infocrirrf[0]->inforra->despprocjud = new \stdClass(); //opcional
$std->idetrab[0]->infocrirrf[0]->inforra->despprocjud->vlrdespcustas = 200;
$std->idetrab[0]->infocrirrf[0]->inforra->despprocjud->vlrdespadvogados = 12000;

$std->idetrab[0]->infocrirrf[0]->inforra->ideadv[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->infocrirrf[0]->inforra->ideadv[0]->tpisnc = 1;
$std->idetrab[0]->infocrirrf[0]->inforra->ideadv[0]->nrisnc = '12345678901234';
$std->idetrab[0]->infocrirrf[0]->inforra->ideadv[0]->vlradv = 12000;

$std->idetrab[0]->infocrirrf[0]->deddepen[0] = new \stdClass(); //opcional 0-999
$std->idetrab[0]->infocrirrf[0]->deddepen[0]->tprend = '11';
$std->idetrab[0]->infocrirrf[0]->deddepen[0]->cpfdep = '12345678901';
$std->idetrab[0]->infocrirrf[0]->deddepen[0]->vlrdeducao = 300;

$std->idetrab[0]->infocrirrf[0]->penalim[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->infocrirrf[0]->penalim[0]->tprend = '11';
$std->idetrab[0]->infocrirrf[0]->penalim[0]->cpfdep = '12345678901';
$std->idetrab[0]->infocrirrf[0]->penalim[0]->vlrpensao = 1000;

$std->idetrab[0]->infocrirrf[0]->infoprocret[0] = new \stdClass(); //opcional 0-50
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->tpprocret = 1;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->nrprocret = '12345678901234567';
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->codsusp = '123'; //opcional

$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0] = new \stdClass(); //opcional 0-2
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->indapuracao = 1;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrnretido = 100;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrdepjud = 20;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrcmpanocal = 300;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrcmpanoant = 20;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrrendsusp = 400;

$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0] = new \stdClass(); //opcional 0-25
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->indtpdeducao = '1';
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->vlrdedsusp = 300;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->benefpen[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->benefpen[0]->cpfdep = '12345678901';
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->benefpen[0]->vlrdepensusp = 300;

$std->idetrab[0]->infoircomplem = new \stdClass(); //opcional
$std->idetrab[0]->infoircomplem->dtlaudo = '2023-10-31';
$std->idetrab[0]->infoircomplem->infodep[0] = new \stdClass(); //opcional 0-999
$std->idetrab[0]->infoircomplem->infodep[0]->cpfdep = '12345678901';
$std->idetrab[0]->infoircomplem->infodep[0]->dtnascto = '2020-12-01';
$std->idetrab[0]->infoircomplem->infodep[0]->nome = 'Chica da Silva';
$std->idetrab[0]->infoircomplem->infodep[0]->depirrf = 'S';
$std->idetrab[0]->infoircomplem->infodep[0]->tpdep = '03';
$std->idetrab[0]->infoircomplem->infodep[0]->descrdep = 'bla bla bla';





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
