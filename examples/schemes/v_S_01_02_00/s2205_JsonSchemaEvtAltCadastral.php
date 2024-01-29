<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2205

$evento  = 'evtAltCadastral';
$version = 'S_01_02_00';

$jsonSchema = '{
    "title": "evtAltCadastral",
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
        "dtalteracao": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/data"
        },
        "nmtrab": {
            "required": true,
            "type": "string",
            "minLength": 2,
            "maxLength": 70
        },
        "sexo": {
            "required": true,
            "type": "string",
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
        "grauinstr": {
            "required": true,
            "type": "string",
            "pattern": "^(0[0-9]{1}|1[0-2]{1})$"
        },
        "nmsoc": {
            "required": false,
            "type": ["string","null"],
            "minLength": 2,
            "maxLength": 70
        },
        "paisnac": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{3}$"
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
                            "maxLength": 4
                        },
                        "dsclograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 100
                        },
                        "nrlograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 10
                        },
                        "complemento": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 30
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 90
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
                            "maxLength": 100
                        },
                        "nrlograd": {
                            "required": true,
                            "type": "string",
                            "maxLength": 10
                        },
                        "complemento": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 30
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 90
                        },
                        "nmcid": {
                            "required": true,
                            "type": "string",
                            "maxLength": 50
                        },
                        "codpostal": {
                            "required": true,
                            "type": ["string","null"],
                            "minLength": 4,
                            "maxLength": 12
                        }
                    }
                }
            }
        },
        "trabimig": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tmpresid": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 2
                },
                "conding": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 7
                }
            }
        },
        "infodeficiencia": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "deffisica": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defvisual": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defauditiva": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defmental": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defintelectual": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "reabreadap": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "infocota": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(S|N)$"
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 255
                }
            }
        },
        "dependente": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "tpdep": {
                        "required": true,
                        "type": "string",
                        "pattern": "^0[1-7]{1}|09|1[0-2]{1}|99$"
                    },
                    "nmdep": {
                        "required": true,
                        "type": "string",
                        "minLength": 2,
                        "maxLength": 70
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
                    "depsf": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    },
                    "inctrab": {
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
        },
        "contato": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "foneprinc": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{10,13}$"
                },
                "emailprinc": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 6,
                    "maxLength": 60
                }
            }
        }
    }
}';

$std = new \stdClass();
//$std->sequencial = 1; //Opcional
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789'; //Obrigatório caso indretif = 2
$std->cpftrab = '12345678901';
$std->dtalteracao = '2017-11-11';
$std->nmtrab = 'Fulano de Tal';
$std->sexo = 'M';
$std->racacor = 1;
$std->estciv = 1;
$std->grauinstr = '10';
$std->nmsoc = null;
$std->paisnac = '105';

$std->endereco = new \stdClass(); //Obrigatório
//Endereço no Brasil.
$std->endereco->brasil = new \stdClass(); //Opcional
$std->endereco->brasil->tplograd = 'R'; //Opcional
$std->endereco->brasil->dsclograd = 'Av. Paulista'; //Obrigatório
$std->endereco->brasil->nrlograd = '1850'; //Obrigatório
$std->endereco->brasil->complemento = "apto 123"; //Opcional
$std->endereco->brasil->bairro = 'Bela Vista'; //Opcional
$std->endereco->brasil->cep = '01311200'; //Obrigatório
$std->endereco->brasil->codmunic  = '3550308'; //Obrigatório
$std->endereco->brasil->uf = 'SP'; //Obrigatório

//Endereço no exterior.
$std->endereco->exterior = new \stdClass(); //Opcional
$std->endereco->exterior->paisresid = '108'; //Obrigatório
$std->endereco->exterior->dsclograd = '5 Av'; //Obrigatório
$std->endereco->exterior->nrlograd = '2222'; //Obrigatório
$std->endereco->exterior->complemento = 'Apto 200'; //Opcional
$std->endereco->exterior->bairro = 'Manhattan'; //Opcional
$std->endereco->exterior->nmcid = 'New York'; //Obrigatório
$std->endereco->exterior->codpostal  = null; //Opcional

//Informações do trabalhador imigrante.
$std->trabimig = new \stdClass(); //Opcional
$std->trabimig->tmpresid = 1; //Opcional
$std->trabimig->conding = 1; //Obrigatório

//Pessoa com deficiência.
$std->infodeficiencia = new \stdClass(); //Opcional
$std->infodeficiencia->deffisica = 'N'; //Obrigatório
$std->infodeficiencia->defvisual = 'N'; //Obrigatório
$std->infodeficiencia->defauditiva = 'N'; //Obrigatório
$std->infodeficiencia->defmental = 'N'; //Obrigatório
$std->infodeficiencia->defintelectual = 'N'; //Obrigatório
$std->infodeficiencia->reabreadap = 'N'; //Obrigatório
$std->infodeficiencia->infocota = 'N'; //Opcional
$std->infodeficiencia->observacao = 'lkslkslkslkslkslks'; //Opcional

//Informações dos dependentes.
$std->dependente[1]  = new \stdClass(); //Opcional
$std->dependente[1]->tpdep = '01'; //Obrigatório
$std->dependente[1]->nmdep = 'Fulaninho de Tal'; //Obrigatório
$std->dependente[1]->dtnascto = '2016-11-25'; //Obrigatório
$std->dependente[1]->cpfdep = '12345678901'; //Opcional
$std->dependente[1]->depirrf = 'N'; //Obrigatório
$std->dependente[1]->depsf = 'N'; //Obrigatório
$std->dependente[1]->inctrab = 'N'; //Obrigatório
$std->dependente[1]->descrdep = 'Bla bla'; //opcional


//Informações de contato.
$std->contato = new \stdClass(); //Opcional
$std->contato->foneprinc = '1234567890'; //Opcional
$std->contato->emailprinc = 'ele@mail.com'; //Opcional

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

