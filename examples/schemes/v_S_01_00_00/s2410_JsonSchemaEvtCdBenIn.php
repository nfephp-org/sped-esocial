<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2410
//versão S_1.00

$evento  = 'evtCdBenIn';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtCdBenIn",
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
        "cpfbenef": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "matricula": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^.{1,30}$"
        },
        "cnpjorigem": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{14}$"
        },
        "cadini": {
            "required": true,
            "type": "string",
            "pattern": "^(S|N)$"
        },
        "indsitbenef": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 3
        },
        "nrbeneficio": {
            "required": true,
            "type": "string",
            "pattern": "^.{1,20}$"
        },
        "dtinibeneficio": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "dtpublic": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/data"
        },
        "tpbeneficio": {
            "required": true,
            "type": "string",
            "pattern": "^[0-1]{1}[0-9]{3}$"
        },
        "tpplanrp": {
            "required": true,
            "type": "integer",
            "minimum": 0,
            "maximum": 3 
        },
        "dsc": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^.{1,255}$"
        },
        "inddecjud": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^(S|N)$"
        },
        "infopenmorte": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tppenmorte": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "instpenmorte": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "cpfinst": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{11}$"
                        },
                        "dtinst": {
                            "required": true,
                            "type": "string",
                            "$ref": "#/definitions/data"
                        }
                    }
                }
            }
        },
        "sucessaobenef": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cnpjorgaoant": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{14}$"
                },
                "nrbeneficioant": {
                    "required": true,
                    "type": "string",
                    "pattern": "^.{1,20}$"
                },
                "dttransf": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^.{1,255}$"
                }
            }
        },
        "mudancacpf": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cpfant": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{11}$"
                },
                "nrbeneficioant": {
                    "required": true,
                    "type": "string",
                    "pattern": "^.{1,20}$"
                },
                "dtaltcpf": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^.{1,255}$"
                }
            }
        },
        "infobentermino": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dttermbeneficio": {
                    "required": true,
                    "type": "string",
                    "$ref": "#/definitions/data"
                },
                "mtvtermino": {
                    "required": true,
                    "type": "string",
                    "pattern": "^0[1-8]{1}|11$"
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1; //obrigatorio
$std->nrrecibo = '1.4.1234567890123456789'; //opcional
$std->cpfbenef = '12345678901'; //obrigatorio
$std->matricula = '12345'; //opcional
$std->cnpjorigem = '12345678901234'; //opcional
$std->cadini = 'S'; //obrigatorio
$std->indsitbenef = '1'; //opcional
$std->nrbeneficio = '12345'; //obrigatorio
$std->dtinibeneficio = '2021-01-01'; //obrigatorio
$std->dtpublic = '2021-01-01'; //opcional
$std->tpbeneficio = "0805"; //obrigatorio
$std->tpplanrp = 0; //obrigatorio
$std->dsc = "bla bla bla bla"; //opcional
$std->inddecjud = 'N'; //opcional

//campo opcional
$std->infopenmorte = new \stdClass();
$std->infopenmorte->tppenmorte = 1; //obrigatório
//campo opcional
$std->infopenmorte->instpenmorte = new \stdClass();
$std->infopenmorte->instpenmorte->cpfinst = '12345678901'; //obrigatório
$std->infopenmorte->instpenmorte->dtinst = '2020-12-12'; //obrigatório

//campo opcional
$std->sucessaobenef = new \stdClass();
$std->sucessaobenef->cnpjorgaoant = '12345678901234'; //obrigatório
$std->sucessaobenef->nrbeneficioant = 'cd2345';  //obrigatório
$std->sucessaobenef->dttransf = '2020-12-20';  //obrigatório
$std->sucessaobenef->observacao = 'texto livre'; //opcional 

//campo opcional
$std->mudancacpf = new \stdClass();
$std->mudancacpf->cpfant = '12345678901'; //obrigatório
$std->mudancacpf->nrbeneficioant= 'cd2345'; //obrigatório
$std->mudancacpf->dtaltcpf = '2019-01-01'; //obrigatório
$std->mudancacpf->observacao = 'outro texto livre'; //opcional

//campo opcional
$std->infobentermino = new \stdClass();
$std->infobentermino->dttermbeneficio = '2121-05-01';
$std->infobentermino->mtvtermino = '11';



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
