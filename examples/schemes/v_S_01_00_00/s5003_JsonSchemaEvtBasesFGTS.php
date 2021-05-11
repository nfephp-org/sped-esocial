<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-5003 evtBasesFGTS


$evento = 'evtBasesFGTS';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtBasesFGTS",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "nrrecarqbase": {
            "required": true,
            "type": "string",
            "maxLength": 40
        },
        "perapur": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "nistrab": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{11}$"
        },
        "infofgts": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtvenc": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "ideestablot": {
                    "type": "array",
                    "minItems": 1,
                    "items": {
                        "type": "object",
                        "properties": {
                            "tpinsc": {
                                "required": true,
                                "type": "integer",
                                "minumum": 1,
                                "maximum": 5
                            },
                            "nrinsc": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{8,14}$"
                            },
                            "codlotacao": {
                                "required": true,
                                "type": "string",
                                "minLength": 1,
                                "maxLength": 30
                            },
                            "infotrabfgts": {
                                "type": "array",
                                "minItems": 1,
                                "maxItens": 10,
                                "items": {
                                    "type": "object",
                                    "properties": {
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
                                        "dtadm": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                        },
                                        "dtdeslig": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                        },
                                        "dtinicio": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                        },
                                        "mtvdeslig": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "pattern": "^[0-9]{2}$"
                                        },
                                        "dtterm": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                        },
                                        "mtvdesligtsv": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "pattern": "^(01|02|03|04|05|06|07|99)$"
                                        },
                                        "infobasefgts": {
                                            "required": false,
                                            "type": ["object","null"],
                                            "properties": {
                                                "baseperapur": {
                                                    "type": "array",
                                                    "minItems": 0,
                                                    "maxItens": 21,
                                                    "items": {
                                                        "type": "object",
                                                        "properties": {
                                                            "tpvalor": {
                                                                "required": true,
                                                                "type": "string",
                                                                "pattern": "^[0-9]{2}$"
                                                            },
                                                            "remfgts": {
                                                                "required": true,
                                                                "type": "number"
                                                            }
                                                        }
                                                    }    
                                                },
                                                "infobaseperante": {
                                                    "type": "array",
                                                    "minItems": 0,
                                                    "maxItens": 180,
                                                    "items": {
                                                        "type": "object",
                                                        "properties": {
                                                            "perref": {
                                                                "required": true,
                                                                "type": "string",
                                                                "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
                                                            },
                                                            "baseperante": {
                                                                "type": "array",
                                                                "minItems": 1,
                                                                "maxItens": 11,
                                                                "items": {
                                                                    "type": "object",
                                                                    "properties": {
                                                                        "tpvalore": {
                                                                            "required": true,
                                                                            "type": "string",
                                                                            "pattern": "^[0-9]{2}$"
                                                                        },
                                                                        "remfgtse": {
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
                },
                "infodpsfgts": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "infotrabdps": {
                            "type": "array",
                            "minItems": 1,
                            "maxItens": 10,
                            "items": {
                                "type": "object",
                                "properties": {
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
                                    "dpsperapur": {
                                        "type": "array",
                                        "minItems": 0,
                                        "maxItens": 20,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "tpdps": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^[0-9]{2}$"
                                                },
                                                "dpsfgts": {
                                                    "required": true,
                                                    "type": "number"
                                                }
                                            }
                                        }    
                                    },
                                    "infodpsperante": {
                                        "type": "array",
                                        "minItems": 0,
                                        "maxItens": 180,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "perref": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
                                                },
                                                "dpsperante": {
                                                    "type": "array",
                                                    "minItems": 0,
                                                    "maxItens": 10,
                                                    "items": {
                                                        "type": "object",
                                                        "properties": {
                                                            "tpdpse": {
                                                                "required": true,
                                                                "type": "string",
                                                                "pattern": "^[0-9]{2}$"
                                                            },
                                                            "dpsfgtse": {
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
}';

// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);

if (empty($jsonSchemaObject))
{
    echo "Erro no JSON SCHEMA";
    die;
}

$std = new \stdClass();
$std->sequencial = 1;
$std->nrrecarqbase = 'kjskjsksjksjksjksjksjskjsksksjskj';
$std->perapur = '2017-08';
$std->cpftrab = '99999999999';
$std->nistrab = '99999999999';


$std->infofgts = new \stdClass();
$std->infofgts->dtvenc = '2019-04-07';

$std->infofgts->ideestablot[0] = new \stdClass();
$std->infofgts->ideestablot[0]->tpinsc = 1;
$std->infofgts->ideestablot[0]->nrinsc = '12345678';
$std->infofgts->ideestablot[0]->codlotacao = '12323455666677';

$std->infofgts->ideestablot[0]->infotrabfgts[0] = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->matricula = '10';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->codcateg = '101';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->dtadm = '2017-05-12';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->dtdeslig = '2019-01-05';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->dtinicio = '2017-05-20';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->mtvdeslig = '01';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->dtterm = '2019-01-05';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->mtvdesligtsv = '01';

$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->baseperapur[0] = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->baseperapur[0]->tpvalor = '12';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->baseperapur[0]->remfgts = 2547.22;

$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0] = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0]->perref = '2018-12';

$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0]->baseperante[0] = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0]->baseperante[0]->tpvalore = '13';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0]->baseperante[0]->remfgtse = 15897.65;

$std->infofgts->infodpsfgts = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0] = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0]->matricula = '10';
$std->infofgts->infodpsfgts->infotrabdps[0]->codcateg = '101';

$std->infofgts->infodpsfgts->infotrabdps[0]->dpsperapur[0] = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0]->dpsperapur[0]->tpdps = '51';
$std->infofgts->infodpsfgts->infotrabdps[0]->dpsperapur[0]->dpsfgts = 15487.99;

$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0] = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0]->perref = '2019-01';

$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0]->dpsperante[0] = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0]->dpsperante[0]->tpdpse = '51';
$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0]->dpsperante[0]->dpsfgtse = 25987.56;


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
        $std, $jsonSchemaObject
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
