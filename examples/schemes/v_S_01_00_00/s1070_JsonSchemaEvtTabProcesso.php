<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1070
//Campos {tpProc} – incluído novo valor válido [1-4].
//Campos {nrProc} – alterados tamanho e validação 20 -> 21.
//Campos {indMatProc} – alterada descrição do valor [7].
//Campos {inclusao/dadosProc/observacao} e {alteracao/dadosProc/observacao} – criados.
//Campos {indSusp} – alterada validação.
//S-1070 sem alterações da 2.4.2 => 2.5.0
//versão S_1.00

$evento = 'evtTabProcesso';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtTabProcesso",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "tpproc": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 4
        },
        "nrproc": {
            "required": true,
            "type": "string",
            "maxLength": 21
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
        "dadosproc": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "indautoria": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 2
                },
                "indmatproc": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 99
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 255
                },
                "dadosprocjud": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "ufvara": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
                        },
                        "codmunic": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{7}$"
                        },
                        "idvara": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{1,4}$"
                        }
                    }
                },
                "infosusp": {
                    "required": false,
                    "type": ["array","null"],
                    "minItems": 0,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "codsusp": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{1,14}$"
                            },
                            "indsusp": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{2}$"
                            },
                            "dtdecisao": {
                                "required": true,
                                "type": "string",
                                "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                            },
                            "inddeposito": {
                                "required": true,
                                "type": "string",
                                "pattern": "^(S|N)$"
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
$std->tpproc = 1;
$std->nrproc = 'alksldkdjkj';
$std->inivalid = '12017-01';
$std->fimvalid = '2017-12';
$std->modo = 'INC';

$std->dadosproc = new \stdClass();
$std->dadosproc->indautoria = 1;
$std->dadosproc->indmatproc = 99;
$std->dadosproc->observacao = 'lalsksksksksk';

$std->dadosproc->dadosprocjud = new \stdClass();
$std->dadosproc->dadosprocjud->ufvara = 'SP';
$std->dadosproc->dadosprocjud->codmunic = '3550308';
$std->dadosproc->dadosprocjud->idvara = '234';

$std->dadosproc->infosusp[0] = new \stdClass();
$std->dadosproc->infosusp[0]->codsusp = '12345678901234';
$std->dadosproc->infosusp[0]->indsusp = '00';
$std->dadosproc->infosusp[0]->dtdecisao = '2017-07-22';
$std->dadosproc->infosusp[0]->inddeposito = 'N';

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
