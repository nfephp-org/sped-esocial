<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1050 sem alterações da 2.4.1 => 2.4.2
//S-1050 sem alterações da 2.4.2 => 2.5.0

$evento  = 'evtTabHorTur';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtTabHorTur",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "codhorcontrat": {
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
        "dadoshorcontratual": {
            "required": true,
            "type": "object",
            "properties": {
                "hrentr": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(?:2[0-3]|[0-1]?[0-9])[0-5]?[0-9]$"
                },
                "hrsaida": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(?:2[0-3]|[0-1]?[0-9])[0-5]?[0-9]$"
                },
                "durjornada": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 9999
                },
                "perhorflexivel": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "horariointervalo" : {
                    "required": false,
                    "type": ["array","null"],
                    "minItems": 0,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "tpinterv": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 2
                            },
                            "durinterv": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 999
                            },
                            "iniinterv": {
                                "required": false,
                                "type": ["string","null"],
                                "pattern": "^(?:2[0-3]|[0-1]?[0-9])[0-5]?[0-9]$"
                            },
                            "terminterv": {
                                "required": false,
                                "type": ["string","null"],
                                "pattern": "^(?:2[0-3]|[0-1]?[0-9])[0-5]?[0-9]$"
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
$std->codhorcontrat = 'jornada';
$std->inivalid = '2017-01';
$std->fimvalid = '2017-12';
$std->modo = 'INC';

$std->dadoshorcontratual = new \stdClass();
$std->dadoshorcontratual->hrentr = '0800';
$std->dadoshorcontratual->hrsaida = '1630';
$std->dadoshorcontratual->durjornada = 258;
$std->dadoshorcontratual->perhorflexivel = 'N';

$std->dadoshorcontratual->horariointervalo[0] = new \stdClass();
$std->dadoshorcontratual->horariointervalo[0]->tpinterv = 1;
$std->dadoshorcontratual->horariointervalo[0]->durinterv = 30;
$std->dadoshorcontratual->horariointervalo[0]->iniinterv = '1110';
$std->dadoshorcontratual->horariointervalo[0]->terminterv = '1140';

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
