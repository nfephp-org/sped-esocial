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
        },
        "idebenef": {
            "required": true,
            "type": "object",
            "properties": {
                "cpfbenef": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "nmbenefic": {
                    "required": true,
                    "type": "string",
                    "maxLength": 70
                },
                "dadosbenef": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "cpfbenef": {
                            "required": true,
                            "type": "string",
                            "maxLength": 11,
                            "minLength": 11
                        },
                        "nmbenefic": {
                            "required": true,
                            "type": "string",
                            "maxLength": 70
                        },
                        "dadosnasc": {
                            "required": true,
                            "type": "object",
                            "properties": {
                                "dtnascto": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                },
                                "codmunic": {
                                    "required": false,
                                    "type": "integer",
                                    "maxLength": 7
                                },
                                "uf": {
                                    "required": true,
                                    "type": "string",
                                    "length": 2
                                },
                                "paisnascto": {
                                    "required": true,
                                    "type": "string",
                                    "length": 3
                                },
                                "paisnac": {
                                    "required": true,
                                    "type": "string",
                                    "length": 3
                                },
                                "nmmae": {
                                    "required": false,
                                    "type": "string",
                                    "maxLength": 70
                                },
                                "nmpai": {
                                    "required": false,
                                    "type": "string",
                                    "maxLength": 70
                                }
                            }
                        },
                        "endereco": {
                            "required": true,
                            "type": "object",
                            "properties": {
                                "brasil": {
                                    "required": false,
                                    "type": "object",
                                    "properties": {
                                        "tplograd": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 4
                                        },
                                        "dsclograd": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 80
                                        },
                                        "nrlograd": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 10
                                        },
                                        "complemento": {
                                            "required": false,
                                            "type": "string",
                                            "maxLength": 30
                                        },
                                        "bairro": {
                                            "required": false,
                                            "type": "string",
                                            "maxLength": 60
                                        },
                                        "cep": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 8
                                        },
                                        "codmunic": {
                                            "required": true,
                                            "type": "integer",
                                            "maxLength": 7
                                        },
                                        "uf": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 2
                                        }
                                    }
                                },
                                "exterior": {
                                    "required": false,
                                    "type": "object",
                                    "properties": {
                                        "paisResid": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 3
                                        },
                                        "dsclograd": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 80
                                        },
                                        "nrlograd": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 10
                                        },
                                        "complemento": {
                                            "required": false,
                                            "type": "string",
                                            "maxLength": 30
                                        },
                                        "bairro": {
                                            "required": false,
                                            "type": "string",
                                            "maxLength": 60
                                        },
                                        "nmcid": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 50
                                        },
                                        "codpostal": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 12
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        },
        "infobeneficio": {
            "required": true,
            "type": "object",
            "properties": {
                "tpplanrp": {
                     "required": true,
                     "type": "integer",
                     "maxLength": 1,
                     "pattern": "([1-2]){1}$"
                },
                "inibeneficio": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "tpbenef": {
                             "required": true,
                             "type": "integer",
                             "maxLength": 2
                        },
                        "nrbenefic": {
                             "required": true,
                             "type": "string",
                             "maxLength": 20
                        },
                        "dtinibenef": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "vrbenef": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 14
                        },
                        "infopenmorte": {
                            "required": true,
                            "type": "object",
                            "properties": {
                                "idquota": {
                                     "required": true,
                                     "type": "string",
                                     "maxLength": 30
                                },
                                "cpfinst": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 11,
                                    "minLength": 11
                                }
                            }
                        }
                    }
                },
                "altbeneficio": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "tpbenef": {
                             "required": true,
                             "type": "integer",
                             "maxLength": 2
                        },
                        "nrbenefic": {
                             "required": true,
                             "type": "string",
                             "maxLength": 20
                        },
                        "dtinibenef": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "vrbenef": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 14
                        },
                        "infopenmorte": {
                            "required": true,
                            "type": "object",
                            "properties": {
                                "idquota": {
                                     "required": true,
                                     "type": "string",
                                     "maxLength": 30
                                },
                                "cpfinst": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 11,
                                    "minLength": 11
                                }
                            }
                        }
                    }
                },
                "fimbeneficio": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "tpbenef": {
                             "required": true,
                             "type": "integer",
                             "maxLength": 2
                        },
                        "nrbenefic": {
                             "required": true,
                             "type": "string",
                             "maxLength": 20
                        },
                        "dtfimbenef": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "mtvfim": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 2
                        }
                    }
                }
            }
        }
    }
}';

$jsonToValidateObject             = new \stdClass();
$jsonToValidateObject->sequencial = 1;
$jsonToValidateObject->indretif   = 1;

$jsonToValidateObject->idebenef            = new \stdClass();
$jsonToValidateObject->idebenef->cpfbenef  = '11111111111';
$jsonToValidateObject->idebenef->nmbenefic = 'NOME';

$jsonToValidateObject->idebenef->dadosbenef            = new \stdClass();
$jsonToValidateObject->idebenef->dadosbenef->cpfbenef  = '11111111111';
$jsonToValidateObject->idebenef->dadosbenef->nmbenefic = 'NOME';

$jsonToValidateObject->idebenef->dadosbenef->dadosnasc             = new \stdClass();
$jsonToValidateObject->idebenef->dadosbenef->dadosnasc->dtnascto   = '1987-01-01';
$jsonToValidateObject->idebenef->dadosbenef->dadosnasc->codmunic   = 3550308;
$jsonToValidateObject->idebenef->dadosbenef->dadosnasc->uf         = 'SP';
$jsonToValidateObject->idebenef->dadosbenef->dadosnasc->paisnascto = '105';
$jsonToValidateObject->idebenef->dadosbenef->dadosnasc->paisnac    = '105';

$jsonToValidateObject->idebenef->dadosbenef->endereco                    = new \stdClass();
$jsonToValidateObject->idebenef->dadosbenef->endereco->brasil            = new \stdClass();
$jsonToValidateObject->idebenef->dadosbenef->endereco->brasil->tplograd  = 'R';
$jsonToValidateObject->idebenef->dadosbenef->endereco->brasil->dsclograd = 'DESCRICAO';
$jsonToValidateObject->idebenef->dadosbenef->endereco->brasil->nrlograd  = '123';
$jsonToValidateObject->idebenef->dadosbenef->endereco->brasil->cep       = '12345678';
$jsonToValidateObject->idebenef->dadosbenef->endereco->brasil->codmunic  = 3550308;
$jsonToValidateObject->idebenef->dadosbenef->endereco->brasil->uf        = 'SP';

$jsonToValidateObject->infobeneficio           = new \stdClass();
$jsonToValidateObject->infobeneficio->tpplanrp = 1;

$jsonToValidateObject->infobeneficio->inibeneficio             = new \stdClass();
$jsonToValidateObject->infobeneficio->inibeneficio->tpbenef    = 1;
$jsonToValidateObject->infobeneficio->inibeneficio->nrbenefic  = '123165050';
$jsonToValidateObject->infobeneficio->inibeneficio->dtinibenef = '2017-08-28';
$jsonToValidateObject->infobeneficio->inibeneficio->vrbenef    = 1500;

$jsonToValidateObject->infobeneficio->inibeneficio->infopenmorte          = new \stdClass();
$jsonToValidateObject->infobeneficio->inibeneficio->infopenmorte->idquota = '123131561';
$jsonToValidateObject->infobeneficio->inibeneficio->infopenmorte->cpfinst = '11122233344';

$jsonToValidateObject->infobeneficio->altbeneficio             = new \stdClass();
$jsonToValidateObject->infobeneficio->altbeneficio->tpbenef    = 1;
$jsonToValidateObject->infobeneficio->altbeneficio->nrbenefic  = '123165050';
$jsonToValidateObject->infobeneficio->altbeneficio->dtinibenef = '2017-08-28';
$jsonToValidateObject->infobeneficio->altbeneficio->vrbenef    = 1500;

$jsonToValidateObject->infobeneficio->altbeneficio->infopenmorte          = new \stdClass();
$jsonToValidateObject->infobeneficio->altbeneficio->infopenmorte->idquota = '123131561';
$jsonToValidateObject->infobeneficio->altbeneficio->infopenmorte->cpfinst = '11122233344';

$jsonToValidateObject->infobeneficio->fimbeneficio             = new \stdClass();
$jsonToValidateObject->infobeneficio->fimbeneficio->tpbenef    = 1;
$jsonToValidateObject->infobeneficio->fimbeneficio->nrbenefic  = '123165050';
$jsonToValidateObject->infobeneficio->fimbeneficio->dtfimbenef = '2017-08-28';
$jsonToValidateObject->infobeneficio->fimbeneficio->mtvfim     = 3;

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
