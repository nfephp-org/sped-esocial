<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1005
//Campos {procAdmJudFap/tpProc} – incluído novo valor válido [1,2,4].
//Campos {nrProc} – alterado tamanho. 20 -> 21
//S-1005 sem alterações da 2.4.2 => 2.5.0
//versão S_1.00

$evento = 'evtTabEstab';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtTabEstab",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "tpinsc": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 3
        },
        "nrinsc": {
            "required": true,
            "type": "string",
            "maxLength": 15
        },
        "inivalid": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
        },
        "fimvalid": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
        },
        "modo": {
            "required": true,
            "type": "string",
            "pattern": "INC|ALT|EXC"
        },
        "dadosestab": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cnaeprep": {
                    "required": true,
                    "type": "integer"
                },
                "aliqgilrat": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "aliqrat": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        },
                        "fap": {
                            "required": false,
                            "type": ["number","null"],
                            "minimum": 0.5,
                            "maximum": 2
                        },
                        "procadmjudrat": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "tpproc": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 4
                                },
                                "nrproc": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{2,21}$"
                                },
                                "codsusp": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 14,
                                    "pattern": "^[0-9]"
                                }
                            }
                        },
                        "procadmjudfap": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "tpproc": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 4
                                },
                                "nrproc": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^.{2,21}$"
                                },
                                "codsusp": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 14,
                                    "pattern": "^[0-9]"
                                }
                            }
                        }
                    }
                },
                "infocaepf": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "tpcaepf": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        }
                    }    
                },
                "infoobra": {
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
                },
                "infotrab": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "infoapr": {
                            "required": false,
                            "type": ["object", "null"],
                            "properties": {
                                "nrprocjud": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^.{20}$"
                                },
                                "infoenteduc": {
                                    "required": false,
                                    "type": ["array","null"],
                                    "minItems": 0,
                                    "maxItems": 99,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "nrinsc": {
                                                "required": true,
                                                "type": "string",
                                                "minLength": 14,
                                                "maxLength": 15,
                                                "pattern": "^[0-9]"
                                            }
                                        }
                                    }    
                                }
                            }
                        },
                        "infopdc": {
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
                }
            }
        },    
        "novavalidade": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "inivalid": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                },
                "fimvalid": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                }
            }    
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->tpinsc = 1;
$std->nrinsc = '123456789012345';
$std->inivalid = '2017-01';
$std->fimvalid = '2017-12'; //opcional
$std->modo = 'INC';

$std->dadosestab = new \stdClass();
$std->dadosestab->cnaeprep = 26213;
$std->dadosestab->aliqgilrat = new \stdClass();
$std->dadosestab->aliqgilrat->aliqrat = 1;
$std->dadosestab->aliqgilrat->fap = 0.5000; //Deve ser um número maior ou igual a 0,5000 e menor ou igual a 2,0000.

//campo opcional
$std->dadosestab->aliqgilrat->procadmjudrat = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudrat->tpproc = 1;
$std->dadosestab->aliqgilrat->procadmjudrat->nrproc = '12345678901234567890';
$std->dadosestab->aliqgilrat->procadmjudrat->codsusp = '14524578901';

//campo opcional
$std->dadosestab->aliqgilrat->procadmjudfap = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudfap->tpproc = 1;
$std->dadosestab->aliqgilrat->procadmjudfap->nrproc = '12345678901234567890';
$std->dadosestab->aliqgilrat->procadmjudfap->codsusp = '123445';

//campo opcional
$std->dadosestab->infocaepf = new \stdClass();
$std->dadosestab->infocaepf->tpcaepf = 1;

//campo opcional
$std->dadosestab->infoobra = new \stdClass();
$std->dadosestab->infoobra->indsubstpatrobra = 1;

//campo opcional
$std->dadosestab->infotrab = new \stdClass();
$std->dadosestab->infotrab->infoapr = new \stdClass();
$std->dadosestab->infotrab->infoapr->nrprocjud = '12345678901234567890';

//campo ARRAY opcional
$std->dadosestab->infotrab->infoapr->infoenteduc[0] = new \stdClass();
$std->dadosestab->infotrab->infoapr->infoenteduc[0]->nrinsc = '12345678901234';

//campo opcional
$std->dadosestab->infotrab->infopdc = new \stdClass();
$std->dadosestab->infotrab->infopdc->nrprocjud = '12345678901234567890';

//campo opcional somente deve ser usado em alterações
$std->novavalidade = new \stdClass();
$std->novavalidade->inivalid = '2017-12';
//$std->novavalidade->fimvalid = '2018-12';

// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);

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
file_put_contents("../../../jsonSchemes/v_$version/$evento.schema", $jsonSchema);
