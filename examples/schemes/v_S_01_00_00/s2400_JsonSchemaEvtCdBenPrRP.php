<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2400 sem alterações da 2.4.1 => 2.4.2

$evento  = 'evtCdBenPrRP';
$version = '02_05_00';

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
                    "pattern": "^[0-9]{11}$"
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
                                    "type": "integer"
                                },
                                "uf": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
                                },
                                "paisnascto": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{3}$"
                                },
                                "paisnac": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{3}$"
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
                                            "pattern": "^[0-9]{1,10}|(S\/N)$"
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
                                            "pattern": "^[0-9]{8}$"
                                        },
                                        "codmunic": {
                                            "required": true,
                                            "type": "integer"
                                        },
                                        "uf": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
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
                                            "pattern": "^[0-9]{3}$"
                                        },
                                        "dsclograd": {
                                            "required": true,
                                            "type": "string",
                                            "maxLength": 80
                                        },
                                        "nrlograd": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^[0-9]{1,10}|(S\/N)$"
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
                     "minimum": 1,
                     "maximum": 2
                },
                "inibeneficio": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "tpbenef": {
                             "required": true,
                             "type": "integer",
                             "minimum": 1,
                             "maximum": 99
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
                            "type": "number"
                        },
                        "infopenmorte": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "idquota": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 30
                                },
                                "cpfinst": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{11}$"
                                }
                            }
                        }
                    }
                },
                "altbeneficio": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "tpbenef": {
                             "required": true,
                             "type": "integer",
                             "minimum": 1,
                             "maximum": 99
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
                            "type": "number"
                        },
                        "infopenmorte": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "idquota": {
                                     "required": true,
                                     "type": "string",
                                     "maxLength": 30
                                },
                                "cpfinst": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{11}$"
                                }
                            }
                        }
                    }
                },
                "fimbeneficio": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "tpbenef": {
                             "required": true,
                             "type": "integer",
                             "minimum": 1,
                             "maximum": 99
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
                            "minimum": 1,
                            "maximum": 8
                        }
                    }
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;

$std->idebenef = new \stdClass();
$std->idebenef->cpfbenef = '11111111111';
$std->idebenef->nmbenefic = 'NOME';

$std->idebenef->dadosbenef = new \stdClass();
$std->idebenef->dadosbenef->dadosnasc = new \stdClass();
$std->idebenef->dadosbenef->dadosnasc->dtnascto = '1987-01-01';
$std->idebenef->dadosbenef->dadosnasc->codmunic = 3550308;
$std->idebenef->dadosbenef->dadosnasc->uf = 'SP';
$std->idebenef->dadosbenef->dadosnasc->paisnascto = '105';
$std->idebenef->dadosbenef->dadosnasc->paisnac = '105';

$std->idebenef->dadosbenef->endereco = new \stdClass();
$std->idebenef->dadosbenef->endereco->brasil = new \stdClass();
$std->idebenef->dadosbenef->endereco->brasil->tplograd = 'R';
$std->idebenef->dadosbenef->endereco->brasil->dsclograd = 'DESCRICAO';
$std->idebenef->dadosbenef->endereco->brasil->nrlograd = '123';
$std->idebenef->dadosbenef->endereco->brasil->cep = '12345678';
$std->idebenef->dadosbenef->endereco->brasil->codmunic = 3550308;
$std->idebenef->dadosbenef->endereco->brasil->uf = 'SP';

$std->infobeneficio = new \stdClass();
$std->infobeneficio->tpplanrp = 1;

$std->infobeneficio->inibeneficio = new \stdClass();
$std->infobeneficio->inibeneficio->tpbenef = 1;
$std->infobeneficio->inibeneficio->nrbenefic = '123165050';
$std->infobeneficio->inibeneficio->dtinibenef = '2017-08-28';
$std->infobeneficio->inibeneficio->vrbenef = 1500.33;

$std->infobeneficio->inibeneficio->infopenmorte = new \stdClass();
$std->infobeneficio->inibeneficio->infopenmorte->idquota = '123131561';
$std->infobeneficio->inibeneficio->infopenmorte->cpfinst = '11122233344';

$std->infobeneficio->altbeneficio = new \stdClass();
$std->infobeneficio->altbeneficio->tpbenef = 1;
$std->infobeneficio->altbeneficio->nrbenefic = '123165050';
$std->infobeneficio->altbeneficio->dtinibenef = '2017-08-28';
$std->infobeneficio->altbeneficio->vrbenef = 1500.50;

$std->infobeneficio->altbeneficio->infopenmorte = new \stdClass();
$std->infobeneficio->altbeneficio->infopenmorte->idquota = '123131561';
$std->infobeneficio->altbeneficio->infopenmorte->cpfinst = '11122233344';

$std->infobeneficio->fimbeneficio = new \stdClass();
$std->infobeneficio->fimbeneficio->tpbenef = 1;
$std->infobeneficio->fimbeneficio->nrbenefic = '123165050';
$std->infobeneficio->fimbeneficio->dtfimbenef = '2017-08-28';
$std->infobeneficio->fimbeneficio->mtvfim = 3;

// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);

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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
