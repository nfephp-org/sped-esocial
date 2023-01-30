<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-1210

$evento  = 'evtPgtos';
$version = 'S_01_01_00';

$jsonSchema = '{
    "title": "evtPgtos",
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
        "cpfbenef": {
            "required": true,
            "type": "string",
            "maxLength": 11,
            "minLength": 11
        },
        "infopgto": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 999,
            "items": {
                "type": "object",
                "properties": {
                    "dtpgto": {
                        "required": true,
                        "type": "string",
                        "$ref": "#/definitions/data"
                    },
                    "tppgto": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 5
                    },
                    "perref": {
                        "required": true,
                        "type": "string",
                        "$ref": "#/definitions/periodo"
                    },
                    "idedmdev": {
                        "required": true,
                        "type": "string",
                        "minLength": 1,
                        "maxLength": 30
                    },
                    "vrliq": {
                        "required": true,
                        "type": "number"
                    },
                    "paisresidext": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^[0-9]{3}"
                    },
                    "infopgtoext": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "indnif": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 3
                            },
                            "nifbenef": {
                                "required": false,
                                "type": ["string","null"],
                                "minLength": 1,
                                "maxLength": 30
                            },
                            "frmtribut": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{2}$"
                            },
                            "endext": {
                                "required": false,
                                "type": ["object","null"],
                                "properties": {
                                    "enddsclograd": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "minLength": 1,
                                        "maxLength": 80
                                    },
                                    "endnrlograd": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "minLength": 1,
                                        "maxLength": 10
                                    },
                                    "endcomplem": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "minLength": 1,
                                        "maxLength": 30
                                    },
                                    "endbairro": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "minLength": 1,
                                        "maxLength": 60
                                    },
                                    "endcidade": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "minLength": 1,
                                        "maxLength": 40
                                    },
                                    "endestado": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "minLength": 1,
                                        "maxLength": 40
                                    },
                                    "endcodpostal": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "pattern": "^[0-9]{1,12}$"
                                    },
                                    "telef": {
                                        "required": false,
                                        "type": ["string","null"],
                                        "pattern": "^[0-9]{8,15}$"
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}';

$std = new \stdClass();
//$std->sequencial = 1; //Opcional
$std->indretif = 1; //Obrigatório
$std->nrrecibo = null; //Opcional
$std->perapur = '2017-12';  //Obrigatório
$std->indguia = 1; //Opcional
$std->cpfbenef = '12345678901';  //Obrigatório

//Informações dos pagamentos efetuados.
$std->infopgto[0] = new \stdClass(); //Obrigatório
$std->infopgto[0]->dtpgto = '2018-01-15';  //Obrigatório
$std->infopgto[0]->tppgto = 4;  //Obrigatório
$std->infopgto[0]->perref = '2020';  //Obrigatório
$std->infopgto[0]->idedmdev = 'sjksjskjslsjksjsj';  //Obrigatório
$std->infopgto[0]->vrliq = 1000.33;  //Obrigatório
$std->infopgto[0]->paisresidext = '001'; //opcional
//Informar o código do país de residência para fins fiscais, quando no exterior, conforme Tabela 06.
//Somente informar este campo caso o país de residência para fins fiscais seja diferente de Brasil. Se não informado,
//implica que o país de residência fiscal é Brasil.
//O campo apenas pode ser preenchido se {perApur}(1210_ideEvento_perApur) >= [2023-03]. Se informado, deve ser um
// código válido e existente na Tabela 06, exceto [105].

$std->infopgto[0]->infopgtoext = new \stdClass(); //Opcional
//Informações complementares relativas a pagamentos a residente fiscal no exterior.
//CONDICAO_GRUPO: O (se {paisResidExt}(../paisResidExt) for informado); N (nos demais casos)
$std->infopgto[0]->infopgtoext->indnif = 1; //Obrigatório
//Indicativo do Número de Identificação Fiscal (NIF).
//1 - Beneficiário com NIF
//2 - Beneficiário dispensado do NIF
//3 - País não exige NIF
$std->infopgto[0]->infopgtoext->nifbenef = 'ABC1234'; //Opcional
//Número de Identificação Fiscal (NIF).
//Preenchimento obrigatório se {indNIF}(./indNIF) = [1].
$std->infopgto[0]->infopgtoext->frmtribut = '11'; //Obrigatório
//Forma de tributação, conforme opções disponíveis na Tabela 30.
//Deve ser um código válido e existente na Tabela 30

$std->infopgto[0]->infopgtoext->endext = new \stdClass(); //Opcional
//Endereço do beneficiário residente ou domiciliado no exterior.
////CONDICAO_GRUPO: OC
$std->infopgto[0]->infopgtoext->endext->enddsclograd = "5 AVE"; //Opcional
//Descrição do logradouro
$std->infopgto[0]->infopgtoext->endext->endnrlograd = "2222"; //Opcional
//Número do logradouro.
//Devem ser utilizados apenas caracteres alfanuméricos com, pelo menos, um caractere numérico.
$std->infopgto[0]->infopgtoext->endext->endcomplem = "Box 1201"; //Opcional
//Complemento do endereço
$std->infopgto[0]->infopgtoext->endext->endbairro = "Down Town"; //Opcional
//Nome do bairro/distrito.
$std->infopgto[0]->infopgtoext->endext->endcidade = "New York"; //Opcional
//Nome da cidade.
$std->infopgto[0]->infopgtoext->endext->endestado = "NY"; //Opcional
//Nome da província/estado.
$std->infopgto[0]->infopgtoext->endext->endcodpostal = "01234"; //Opcional
//Código de Endereçamento Postal.
//Devem ser informados apenas caracteres numéricos.
$std->infopgto[0]->infopgtoext->endext->telef = "55555555555"; //Opcional
//Número do telefone.
//Devem ser informados apenas caracteres numéricos


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
