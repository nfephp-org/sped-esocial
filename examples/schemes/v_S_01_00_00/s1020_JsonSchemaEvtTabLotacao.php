<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1020 sem alterações da 2.4.1 => 2.4.2
//S-1020 sem alterações da 2.4.2 => 2.5.0
//versão S_1.00

$evento  = 'evtTabLotacao';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtTabLotacao",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "codlotacao": {
            "required": true,
            "type": "string",
            "maxLength": 30,
            "pattern": "^(?!eSocial)"
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
        "dadoslotacao": {
            "required": true,
            "type": "object",
            "properties": {
                "tplotacao": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{2}$"
                },
                "tpinsc": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 4
                },
                "nrinsc": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{11,14}$"
                },
                "fpas": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 999
                },
                "codtercs": {
                    "required": true,
                    "type": "string",
                    "maxLength": 4,
                    "pattern": "^[0-9]"
                },
                "codtercssusp": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 4,
                    "pattern": "^[0-9]"
                },
                "procjudterceiro": {
                    "required": false,
                    "type": ["array","null"],
                    "minItems": 0,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "codterc": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{4}$"
                            },
                            "nrprocjud": {
                                "required": true,
                                "type": "string",
                                "maxLength": 20
                            },
                            "codsusp": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{1,14}"
                            }
                        }
                    }
                },
                "infoemprparcial": {
                    "required": false,
                    "type": ["object","null"],
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
                            "pattern": "^[0-9]{11,14}"
                        },
                        "tpinscprop": {
                            "required": false,
                            "type": ["integer","null"],
                            "minimum": 1,
                            "maximum": 2
                        },
                        "nrinscprop": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{11,14}"
                        }
                    }
                },
                "dadosopport": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "aliqrat": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        },
                        "fap": {
                            "required": true,
                            "type": "number"
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
$std->codlotacao = 'assistente';
$std->inivalid = '2017-01';
$std->fimvalid = '2017-12';
$std->modo = 'INC';

//campo obrigatório
$std->dadoslotacao = new \stdClass();
$std->dadoslotacao->tplotacao = '01';
$std->dadoslotacao->tpinsc = 1;
$std->dadoslotacao->nrinsc = '12345678901234';
$std->dadoslotacao->fpas = 507;
$std->dadoslotacao->codtercs = '0064';
$std->dadoslotacao->codtercssusp = '0072';

//campo opcional
$std->dadoslotacao->procjudterceiro[0] = new \stdClass();
$std->dadoslotacao->procjudterceiro[0]->codterc = '0064';
$std->dadoslotacao->procjudterceiro[0]->nrprocjud = '12345678901234567890';
$std->dadoslotacao->procjudterceiro[0]->codsusp = '1234567';

//campo opcional
$std->dadoslotacao->infoemprparcial = new \stdClass();
$std->dadoslotacao->infoemprparcial->tpinsccontrat = 1;
$std->dadoslotacao->infoemprparcial->nrinsccontrat = '12345678901234';
$std->dadoslotacao->infoemprparcial->tpinscprop = 2;
$std->dadoslotacao->infoemprparcial->nrinscprop = '12345678901234';

//campo opcional
$std->dadoslotacao->dadosopport = new \stdClass();
$std->dadoslotacao->dadosopport->aliqrat = 3;
$std->dadoslotacao->dadosopport->fap = 2.04;

//campo opcional, usar somente qunado alteração
$std->novavalidade = new \stdClass();
$std->novavalidade->inivalid = '2017-01';
$std->novavalidade->fimvalid = '2017-12';

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
