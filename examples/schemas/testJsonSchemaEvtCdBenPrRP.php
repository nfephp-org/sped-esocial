<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtCdBenPrRP';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtCdBenPrRP",
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
        }
    }
}';

$jsonToValidateObject             = new \stdClass();
$jsonToValidateObject->sequencial = 1;
$jsonToValidateObject->indretif   = 1;

$idevinculo            = new \stdClass();
$idevinculo->cpftrab   = '11111111111';
$idevinculo->nistrab   = '11111111111';
$idevinculo->matricula = '11111111111';

$jsonToValidateObject->idevinculo = $idevinculo;

$aso         = new \stdClass();
$aso->dtaso  = '2017-08-18';
$aso->tpaso  = 0;
$aso->resaso = 1;

$jsonToValidateObject->aso = $aso;

$exame[0]                = new \stdClass();
$exame[0]->dtexm         = '2017-08-18';
$exame[0]->procrealizado = 10102019;
$exame[0]->obsproc       = 'observação do exame';
$exame[0]->interprexm    = 1;
$exame[0]->ordexame      = 1;
$exame[0]->dtiniCdBenPrRP    = '2017-08-18';
$exame[0]->dtfimCdBenPrRP    = '2018-08-18';
$exame[0]->indresult     = 1;

$jsonToValidateObject->exame = $exame;

$respCdBenPrRP               = new \stdClass();
$respCdBenPrRP->nisresp      = '11111111111';
$respCdBenPrRP->nrconsclasse = '11111111';

$jsonToValidateObject->respCdBenPrRP = $respCdBenPrRP;

$ideservsaude          = new \stdClass();
$ideservsaude->codcnes = '1111111';
$ideservsaude->frmctt  = 'CONTATO';
$ideservsaude->email   = 'teste@exemplo.com.br';

$jsonToValidateObject->ideservsaude = $ideservsaude;

$medico        = new \stdClass();
$medico->nmmed = 'NOME DO MEDICO';
$medico->nrcrm = '12345678';
$medico->ufcrm = 'SP';

$jsonToValidateObject->medico = $medico;

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
    $jsonToValidateObject,
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
file_put_contents("../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
