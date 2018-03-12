<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2210

$evento  = 'evtCAT';
$version = '02_04_02';

$jsonSchema = '{
    "title": "evtCAT",
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
            "maxLength": 40
        },
        "tpregistrador": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 9
        },
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
            "maxLength": 14,
            "pattern": "^[0-9]"
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}"
        },
        "nistrab": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 11
        },
        "dtacid": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "tpacid": {
            "required": true,
            "type": "string",
            "maxLength": 6
        },
        "hracid": {
            "required": true,
            "type": "string",
            "maxLength": 4,
            "pattern": "^[0-9]"
        },
        "hrstrabantesacid": {
            "required": true,
            "type": "string",
            "maxLength": 4,
            "pattern": "^[0-9]"
        },
        "tpcat": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 3
        },
        "indcatobito": {
            "required": true,
            "type": "string",
            "pattern": "S|N"
        },
        "dtobito": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "indcomunpolicia": {
            "required": true,
            "type": "string",
            "pattern": "S|N"
        },
        "codsitgeradora": {
            "required": false,
            "type": ["string","null"],
            "minLength": 3,
            "maxLength": 9,
            "pattern": "^[0-9]"
        },
        "iniciatcat": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 3
        },
        "observacao": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 255
        },
        "tplocal": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 9
        },
        "dsclocal": {
            "required": false,
            "type": ["string","null"],
            "minLength": 3,
            "maxLength": 80
        },
        "dsclograd": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 80
        },
        "nrlograd": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 10
        },
        "codmunic": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{7}"
        },
        "uf": {
            "required": false,
            "type": ["string","null"],
            "minLength": 2,
            "maxLength": 2
        },
        "cnpjlocalacid": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{8}|^[0-9]{14}"
        },
        "pais": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{3}"
        },
        "codpostal": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 12
        },
        "parteatingida": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "codparteating": {
                        "required": true,
                        "type": "string",
                        "maxLength": 9,
                        "pattern": "^[0-9]"
                    },
                    "lateralidade": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 3
                    }
                }
            }    
        },
        "agentecausador": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "codagntcausador": {
                        "required": true,
                        "type": "string",
                        "maxLength": 9,
                        "pattern": "^[0-9]"
                    }
                }
            }    
        },
        "atestado": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "codcnes": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 7
                },
                "dtatendimento": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "hratendimento": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-2][0-3][0-5][0-9]$"
                },
                "indinternacao": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "durtrat": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 9999
                },
                "indafast": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "dsclesao": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 9,
                    "pattern": "^[0-9]"
                },
                "dsccompLesao": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 200
                },
                "diagprovavel": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 200
                },
                "codcid": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 4
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 3,
                    "maxLength": 255
                },
                "nmemit": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 70
                },
                "ideoc": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                },
                "nroc": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 14
                },
                "ufoc": {
                    "required": true,
                    "type": "string",
                    "minLength": 2,
                    "maxLength": 2
                }
            }
        },
        "catorigem": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtcatorig": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "nrcatorig": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 40
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->tpregistrador = 5;
$std->tpinsc = 1;
$std->nrinsc = '12345678901234';
$std->cpftrab = '12345678901';
$std->nistrab = '12345678901';
$std->dtacid = '2017-12-10';
$std->tpacid = '12.456';
$std->hracid = '0522';
$std->hrstrabantesacid = '0522';
$std->tpcat = 2;
$std->indcatobito = 'N';
$std->dtobito = null;
$std->indcomunpolicia = 'S';
$std->codsitgeradora = '222';
$std->iniciatcat = 3;
$std->observacao = 'lksjlskjlskjslkjslkjslkjslksjl';
$std->tplocal = 8;
$std->dsclocal = 'klçkdçldkdlkdlk';
$std->dsclograd = 'poiwpoiwowiowi';
$std->nrlograd = '2929b';
$std->codmunic = '1200104';
$std->uf = 'AC';
$std->cnpjlocalacid = '12345678901234';
$std->pais = '105';
$std->codpostal = '123456789012';

$std->parteatingida[1] = new \stdClass();
$std->parteatingida[1]->codparteating = '123456789';
$std->parteatingida[1]->lateralidade = 2;

$std->agentecausador[1] = new \stdClass();
$std->agentecausador[1]->codagntcausador = '123456789';

$std->atestado = new \stdClass();
$std->atestado->codcnes = '8282828';
$std->atestado->dtatendimento = '2017-02-01';
$std->atestado->hratendimento = '1255';
$std->atestado->indinternacao = 'N';
$std->atestado->durtrat = 52;
$std->atestado->indafast = 'N';
$std->atestado->dsclesao = '123456789';
$std->atestado->dsccompLesao = 'lskjslkjslkjslksjlskjslkj';
$std->atestado->diagprovavel = 'kkhjskjhskjhskjhskjshkjh';
$std->atestado->codcid = 'a234';
$std->atestado->observacao = 'llksjlkjslksjlskjlsjlskj';
$std->atestado->nmemit = 'Dr Estranho';
$std->atestado->ideoc = 2;
$std->atestado->nroc = '12222kkkk';
$std->atestado->ufoc = 'AC';

$std->catorigem = new \stdClass();
$std->catorigem->dtcatorig = '2016-12-14';
$std->catorigem->nrcatorig = '2565656556';

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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
