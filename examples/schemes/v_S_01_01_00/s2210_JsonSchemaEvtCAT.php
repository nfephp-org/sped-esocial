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
$version = 'S_01_01_00';

$jsonSchema = '{
    "title": "evtCAT",
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
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "matricula": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 30
        },
        "codcateg": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{3}$"
        },
        "dtacid": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "tpacid": {
            "required": true,
            "type": "integer",
            "minumum": 1,
            "maximum": 3
        },
        "hracid": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^(0[0-9]|1[0-9]|2[0-3])([0-5][0-9])$"
        },
        "hrstrabantesacid": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^([0-9]{2}[0-5][0-9])$"
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
            "pattern": "^(S|N)$"
        },
        "dtobito": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/data"
        },
        "indcomunpolicia": {
            "required": true,
            "type": "string",
            "pattern": "^(S|N)$"
        },
        "codsitgeradora": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{9}$"
        },
        "iniciatcat": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 3
        },
        "obscat": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 999
        },
        "ultdiatrab": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "houveafast": {
            "required": true,
            "type": "string",
            "pattern": "^(S|N)$"
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
            "minLength": 1,
            "maxLength": 255
        },
        "tplograd": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 4
        },
        "dsclograd": {
            "required": true,
            "type": "string",
            "minLength": 1,
            "maxLength": 100
        },
        "nrlograd": {
            "required": true,
            "type": "string",
            "minLength": 1,
            "maxLength": 10
        },
        "complemento": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 30
        },
        "bairro": {
            "required": false,
            "type": ["string","null"],
            "minLength": 1,
            "maxLength": 90
        },
        "cep": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{8}$"
        },
        "codmunic": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{7}$"
        },
        "uf": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/siglauf"
        },
        "pais": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{3}$"
        },
        "codpostal": {
            "required": false,
            "type": ["string","null"],
            "minLength": 4,
            "maxLength": 12
        },
        "idelocalacid": {
            "required": false,
            "type": ["object","null"],
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
                    "pattern": "^[0-9]{8,14}$"
                }
            }
        },
        "parteatingida": {
            "required": true,
            "type": "object",
            "properties": {
                "codparteating": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{9}$"
                },
                "lateralidade": {
                    "required": true,
                    "type": "integer",
                    "minimum": 0,
                    "maximum": 3
                }
            }
        },
        "agentecausador": {
            "required": true,
            "type": "object",
            "properties": {
                "codagntcausador": {
                    "required": true,
                    "type": "string",
                    "maxLength": 9,
                    "pattern": "^[0-9]{9}$"
                }
            }
        },
        "atestado": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtatendimento": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "hratendimento": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(0[0-9]|1[0-9]|2[0-3])([0-5][0-9])$"
                },
                "indinternacao": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
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
                    "pattern": "^(S|N)$"
                },
                "dsclesao": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{9}$"
                },
                "dsccompLesao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 200
                },
                "diagprovavel": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 100
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
                    "minLength": 1,
                    "maxLength": 255
                },
                "nmemit": {
                    "required": true,
                    "type": "string",
                    "minLength": 2,
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
                    "minLength": 1,
                    "maxLength": 14
                },
                "ufoc": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/siglauf"
                }
            }
        },
        "catorigem": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nrreccatorig": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/recibo"
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789';

//$std->tpinsc = 1;
//$std->nrinsc = '12345678901234';

$std->cpftrab = '12345678901';
$std->matricula = '9292kkk';
$std->codcateg = '123';

$std->dtacid = '2017-12-10';
$std->tpacid = 1;
$std->hracid = '0522';
$std->hrstrabantesacid = '0559';

$std->tpcat = 1;
$std->indcatobito = 'S';
$std->dtobito = '2017-12-10';

$std->indcomunpolicia = 'S';
$std->codsitgeradora = '123456789';

$std->iniciatcat = 3;
$std->obscat = 'lksjlskjlskjslkjslkjslkjslksjl';

$std->tplocal = 9;
$std->dsclocal = 'klçkdçldkdlkdlk';
$std->tplograd = 'AAAA';
$std->dsclograd = 'poiwpoiwowiowi';
$std->nrlograd = '2929b';
$std->complemento = 'lslslsl';
$std->bairro = 'nsnnsnsn';
$std->cep = '04154000';
$std->codmunic = '1200104';
$std->uf = 'AC';
$std->pais = '105';
$std->codpostal = '123456789012';

$std->idelocalacid = new \stdClass();
$std->idelocalacid->tpinsc = 1;
$std->idelocalacid->nrinsc = '12345678901234';


$std->parteatingida = new \stdClass();
$std->parteatingida->codparteating = '123456789';
$std->parteatingida->lateralidade = 0;

$std->agentecausador = new \stdClass();
$std->agentecausador->codagntcausador = '123456789';

$std->atestado = new \stdClass();
$std->atestado->dtatendimento = '2017-02-01';
$std->atestado->hratendimento = '0000';
$std->atestado->indinternacao = 'S';
$std->atestado->durtrat = 2;
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
$std->catorigem->nrreccatorig = '1.1.1234567890123456789';

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
