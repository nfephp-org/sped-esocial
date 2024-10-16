<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2400


$evento  = 'evtCdBenefIn';
$version = 'S_01_03_00';

$jsonSchema = '{
    "title": "evtCdBenefIn",
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
        "cpfbenef": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "nmbenefic": {
            "required": true,
            "type": "string",
            "maxLength": 70
        },
        "dtnascto": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "dtinicio": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "sexo": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^(M|F)$"
        },
        "racacor": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 6
        },
        "estciv": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 5
        },
        "incfismen": {
            "required": true,
            "type": "string",
            "pattern": "^(S|N)$"
        },
        "dtincfismen": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/data"
        },
        "endereco": {
            "required": true,
            "type": "object",
            "properties": {
                "brasil": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "tplograd": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^.{1,3}$"
                        },
                        "dsclograd": {
                            "required": true,
                            "type": "string",
                            "pattern": "^.{1,100}$"
                        },
                        "nrlograd": {
                        "required": true,
                            "type": "string",
                            "pattern": "^.{1,10}$"
                        },
                        "complemento": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^.{1,30}$"
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^.{1,90}$"
                        },
                        "cep": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{8}$"
                        },
                        "codmunic": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{7}$"
                        },
                        "uf": {
                            "required": true,
                            "type": "string",
                            "$ref": "#/definitions/siglauf"
                        }
                    }
                },
                "exterior": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "paisresid": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{3}$"
                        },
                        "dsclograd": {
                            "required": true,
                            "type": "string",
                            "pattern": "^.{1,100}$"
                        },
                        "nrlograd": {
                            "required": true,
                            "type": "string",
                            "pattern": "^.{1,10}$"
                        },
                        "complemento": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^.{1,30}$"
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^.{1,90}$"
                        },
                        "nmcid": {
                            "required": true,
                            "type": "string",
                            "pattern": "^.{2,50}$"
                        },
                        "codpostal": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^.{4,12}$"
                        }
                    }
                }
            }
        },
        "dependente": {
            "required": false,
            "type": ["array","null"],
            "minItems": 1,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "tpdep": {
                       "required": true,
                        "type": "string",
                        "pattern": "^[0-9]{2}$"
                    },
                    "nmdep": {
                        "required": true,
                        "type": "string",
                        "pattern": "^.{2,70}$"
                    },
                    "dtnascto": {
                        "required": true,
                        "type": "string",
                        "$ref": "#/definitions/data"
                    },
                    "cpfdep": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^[0-9]{11}$"
                    },
                    "sexodep": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^(M|F)$"
                    },
                    "depirrf": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    },
                    "incfismen": {
                        "required": true,
                        "type": "string",
                         "pattern": "^(S|N)$"
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
}';


$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;

$std->cpfbenef = '11111111111';
$std->nmbenefic = 'NOME';
$std->dtnascto = '1987-01-01';
$std->dtinicio = '1987-01-01';
$std->sexo = "M";
$std->racacor = '1';
$std->estciv = '1';
$std->incfismen = 'S';
$std->dtincfismen = '1999-12-12';

$std->endereco = new \stdClass();
$std->endereco->brasil = new \stdClass();
$std->endereco->brasil->tplograd = 'AV';
$std->endereco->brasil->dsclograd = 'Avenida da Paz';
$std->endereco->brasil->nrlograd = '1000';
$std->endereco->brasil->complemento = 'sobre loja';
$std->endereco->brasil->bairro = 'Centro';
$std->endereco->brasil->cep = '04178000';
$std->endereco->brasil->codmunic = '3550308';
$std->endereco->brasil->uf = 'SP';

$std->endereco->exterior = new \stdClass();
$std->endereco->exterior->paisresid = '805';
$std->endereco->exterior->dsclograd = 'Bodega Street';
$std->endereco->exterior->nrlograd = '1000';
$std->endereco->exterior->complemento = null;
$std->endereco->exterior->bairro = 'New City';
$std->endereco->exterior->nmcid = 'Fakaofo';
$std->endereco->exterior->codpostal = 'Z001';

$std->dependente[0] = new \stdClass();
$std->dependente[0]->tpdep = '03';
$std->dependente[0]->nmdep = 'Luluzinha';
$std->dependente[0]->dtnascto = '2010-04-12';
$std->dependente[0]->cpfdep = '12345678901';
$std->dependente[0]->sexodep = 'F';
$std->dependente[0]->depirrf = 'S';
$std->dependente[0]->incfismen = 'N';


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
