<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-8299 EvtBaixa

$evento = 'evtBaixa';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtBaixa",
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
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{1,30}$"
        },
        "mtvdeslig": {
            "required": true,
            "type": "string",
            "pattern": "^(11|12|13|25|28|29|30|34|36)$"
        },
        "dtdeslig": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "dtprojfimapi": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/data"
        },
        "nrproctrab": {
            "required": true,
            "type": "string",
            "pattern": "^.{20}$"
        },
        "observacao": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 255
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1; //obrigatorio Informe [1] para arquivo original ou [2] para arquivo de retificação.
$std->nrrecibo = "1.2.1234567890123456789"; //opcional Preencher com o número do recibo do arquivo a ser retificado.
$std->cpftrab = "12345678901"; //obrigatorio Preencher com o número do CPF do trabalhador
$std->matricula = "123456789012345678901234567890"; //obrigatorio Matrícula atribuída ao trabalhador pela empresa
$std->mtvdeslig = "11"; //obrigatorio Código de motivo do desligamento. [11, 12, 13, 25, 28, 29, 30, 34, 36]
$std->dtdeslig = "2021-02-03"; //obrigatorio Preencher com a data de desligamento do vínculo (último dia trabalhado).
$std->dtprojfimapi =  "2021-03-03"; //opcional Data projetada para o término do aviso prévio indenizado
$std->nrproctrab = "C21-029010.23456789c"; //obrigatorio Número que identifica o processo judicial onde a baixa do vínculo foi determinada.
$std->observacao = "teste de geracao do evento"; //opcional Observação relevante sobre o desligamento do trabalhador, que não esteja consignada em outros campos.

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
