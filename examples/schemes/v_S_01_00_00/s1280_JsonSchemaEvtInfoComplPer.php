<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1280 sem alterações da 2.4.1 => 2.4.2
//S-1280 sem alterações da 2.4.2 => 2.5.0

$evento = 'evtInfoComplPer';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtInfoComplPer",
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
        "indapuracao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "perapur": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/periodo"
        },
        "indguia": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 1
        },
        "infosubstpatr": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "indsubstpatr": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "percpedcontrib": {
                     "required": true,
                     "type": "number"
                }
            }
        },
        "infosubstpatropport": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 9999,
            "items": {
                "type": "object",
                "properties": {
                    "codlotacao": {
                        "required": true,
                        "type": "string",
                        "minLength": 1,
                        "maxLength": 30
                    }
                }
            }
        },
        "infoativconcom": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "fatormes": {
                     "required": true,
                     "type": "number"
                },
                "fator13": {
                     "required": true,
                     "type": "number"
                }
            }
        }
    }
}';

$std = new \stdClass();
//$std->sequencial = 1; //Opcional
$std->indretif = 1; //Obrigatório
$std->nrrecibo = null; //Obrigatório apenas se indretif = 2
$std->indapuracao = 1; //Obrigatório
$std->perapur = '2017-08'; //Obrigatório
$std->indguia = 1; //Opcional

//Grupo preenchido exclusivamente por empresa enquadrada nos arts. 7o a 9o da Lei 12.546/2011,
// conforme classificação tributária indicada no evento S-1000.
$std->infosubstpatr = new \stdClass(); //Opcional
$std->infosubstpatr->indsubstpatr = 1; //Obrigatório
$std->infosubstpatr->percpedcontrib = 2.50; //Obrigatório

//Grupo preenchido exclusivamente pelo Órgão Gestor de Mão de Obra - OGMO (classTrib em S-1000 = [09]), 
//listando apenas seus códigos de lotação com operadores portuários enquadrados nos arts. 7o a 9o
//da Lei 12.546/2011.
$std->infosubstpatropport[0] = new \stdClass(); //Opcional
$std->infosubstpatropport[0]->codlotacao = '11111111111111'; //Obrigatório

//Grupo preenchido por empresa enquadrada no regime de tributação Simples Nacional com tributação
//previdenciária substituída e não substituída.
$std->infoativconcom = new \stdClass();  //Opcional
$std->infoativconcom->fatormes = 1.11; //Obrigatório
$std->infoativconcom->fator13 = 0.22; //Obrigatório


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
        $std, $jsonSchemaObject, Constraint::CHECK_MODE_COERCE_TYPES  //tenta converter o dado no tipo indicado no schema
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
