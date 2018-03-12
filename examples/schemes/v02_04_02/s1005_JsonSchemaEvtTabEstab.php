<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1005

$evento = 'evtTabEstab';
$version = '02_04_02';

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
                        "aliqratajust": {
                            "required": false,
                            "type": ["number","null"],
                            "minimum": 0.5,
                            "maximum": 6
                        },
                        "procadmjudrat": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "tpproc": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 2
                                },
                                "nrproc": {
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
                        },
                        "procadmjudfap": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "tpproc": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 2
                                },
                                "nrproc": {
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
                    "required": true,
                    "type": "object",
                    "properties": {
                        "regpt": {
                            "required": true,
                            "type": "integer",
                            "minimum": 0,
                            "maximum": 6
                        },
                        "infoapr": {
                            "required": true,
                            "type": "object",
                            "properties": {
                                "contapr": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 0,
                                    "maximum": 2
                                },
                                "nrprocjud": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "maxLength": 20
                                },
                                "contented": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "S|N"
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
                                "contpdc": {
                                   "required": true,
                                   "type": "integer",
                                    "minimum": 0,
                                    "maximum": 9
                                },
                                "nrprocjud": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "maxLength": 20
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
$std->dadosestab->aliqgilrat->aliqratajust = 1 * 0.5000;
$std->dadosestab->aliqgilrat->procadmjudrat = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudrat->tpproc = 1;
$std->dadosestab->aliqgilrat->procadmjudrat->nrproc = '123568kjdkdjkdjkdj';
$std->dadosestab->aliqgilrat->procadmjudrat->codsusp = '14524578901';
$std->dadosestab->aliqgilrat->procadmjudfap = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudfap->tpproc = 1;
$std->dadosestab->aliqgilrat->procadmjudfap->nrproc = 'kdjkdkdjdkjdkj';
$std->dadosestab->aliqgilrat->procadmjudfap->codsusp = '123445';
$std->dadosestab->infocaepf = new \stdClass();
$std->dadosestab->infocaepf->tpcaepf = 1;
$std->dadosestab->infoobra = new \stdClass();
$std->dadosestab->infoobra->indsubstpatrobra = 1;
$std->dadosestab->infotrab = new \stdClass();
$std->dadosestab->infotrab->regpt = 0;
$std->dadosestab->infotrab->infoapr = new \stdClass();
$std->dadosestab->infotrab->infoapr->contapr = 0;
$std->dadosestab->infotrab->infoapr->nrprocjud = 'dkjdkjdkdjkdj';
$std->dadosestab->infotrab->infoapr->contented = 'S';
$std->dadosestab->infotrab->infoapr->infoenteduc[0] = new \stdClass();
$std->dadosestab->infotrab->infoapr->infoenteduc[0]->nrinsc = '12345678901234';
$std->dadosestab->infotrab->infopdc = new \stdClass();
$std->dadosestab->infotrab->infopdc->contpdc = 0;
$std->dadosestab->infotrab->infopdc->nrprocjud = 'kjdkjdkdjkdj';

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
$schemaStorage->addSchema('file://mySchema', $jsonSchemaObject);

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
