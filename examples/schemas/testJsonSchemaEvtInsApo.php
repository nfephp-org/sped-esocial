<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtInsApo';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtInsApo",
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
        "idevinculo": {
            "required": true,
            "type": "object",
            "properties": {
                "cpftrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "nistrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11,
                    "minLength": 11
                },
                "matricula": {
                    "required": true,
                    "type": "string",
                    "maxLength": 30
                }
            }
        },
        "insalperic": {
            "required": false,
            "type": "object",
            "properties": {
                "iniinsalperic": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "dtinicondicao": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "infoamb": {
                            "required": true,
                            "type": "array",
                            "minItems": 1,
                            "maxItems": 99,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "codamb": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 30
                                    },
                                    "fatrisco": {
                                        "required": true,
                                        "type": "array",
                                        "minItems": 1,
                                        "maxItems": 999,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "codfatris": {
                                                    "required": true,
                                                    "type": "string",
                                                    "maxLength": 30
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                "altinsalperic": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "dtaltcondicao": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "infoamb": {
                            "required": true,
                            "type": "array",
                            "minItems": 1,
                            "maxItems": 99,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "codamb": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 30
                                    },
                                    "fatrisco": {
                                        "required": true,
                                        "type": "array",
                                        "minItems": 1,
                                        "maxItems": 999,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "codfatris": {
                                                    "required": true,
                                                    "type": "string",
                                                    "maxLength": 30
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                "fiminsalperic": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "dtfimcondicao": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "infoamb": {
                            "required": true,
                            "type": "array",
                            "minItems": 1,
                            "maxItems": 99,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "codamb": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 30
                                    }
                                }
                            }
                        }
                    }
                }
            }
        },
        "aposentesp": {
            "required": false,
            "type": "object",
            "properties": {
                "iniaposentesp": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "dtinicondicao": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "infoamb": {
                            "required": true,
                            "type": "array",
                            "minItems": 1,
                            "maxItems": 99,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "codamb": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 30
                                    },
                                    "fatrisco": {
                                        "required": true,
                                        "type": "array",
                                        "minItems": 1,
                                        "maxItems": 999,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "codfatris": {
                                                    "required": true,
                                                    "type": "string",
                                                    "maxLength": 30
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                "altaposentesp": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "dtaltcondicao": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "infoamb": {
                            "required": true,
                            "type": "array",
                            "minItems": 1,
                            "maxItems": 99,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "codamb": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 30
                                    },
                                    "fatrisco": {
                                        "required": true,
                                        "type": "array",
                                        "minItems": 1,
                                        "maxItems": 999,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "codfatris": {
                                                    "required": true,
                                                    "type": "string",
                                                    "maxLength": 30
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                "fimaposentesp": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "dtfimcondicao": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "infoamb": {
                            "required": true,
                            "type": "array",
                            "minItems": 1,
                            "maxItems": 99,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "codamb": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 30
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

$jsonToValidateObject             = new \stdClass();
$jsonToValidateObject->sequencial = 1;
$jsonToValidateObject->indretif   = 1;

$jsonToValidateObject->idevinculo            = new \stdClass();
$jsonToValidateObject->idevinculo->cpftrab   = '11111111111';
$jsonToValidateObject->idevinculo->nistrab   = '11111111111';
$jsonToValidateObject->idevinculo->matricula = '11111111111';

$jsonToValidateObject->insalperic                               = new \stdClass();
$jsonToValidateObject->insalperic->iniinsalperic                = new \stdClass();
$jsonToValidateObject->insalperic->iniinsalperic->dtinicondicao = '2017-08-28';

$jsonToValidateObject->insalperic->iniinsalperic->infoamb[0]         = new \stdClass();
$jsonToValidateObject->insalperic->iniinsalperic->infoamb[0]->codamb = '123546';

$jsonToValidateObject->insalperic->iniinsalperic->infoamb[0]->fatrisco[0]            = new \stdClass();
$jsonToValidateObject->insalperic->iniinsalperic->infoamb[0]->fatrisco[0]->codfatris = '123456';

$jsonToValidateObject->insalperic->altinsalperic                = new \stdClass();
$jsonToValidateObject->insalperic->altinsalperic->dtaltcondicao = '2017-08-28';

$jsonToValidateObject->insalperic->altinsalperic->infoamb[0]         = new \stdClass();
$jsonToValidateObject->insalperic->altinsalperic->infoamb[0]->codamb = '123456';

$jsonToValidateObject->insalperic->altinsalperic->infoamb[0]->fatrisco[0]            = new \stdClass();
$jsonToValidateObject->insalperic->altinsalperic->infoamb[0]->fatrisco[0]->codfatris = '123456';


$jsonToValidateObject->insalperic->fiminsalperic                = new \stdClass();
$jsonToValidateObject->insalperic->fiminsalperic->dtfimcondicao = '2017-08-28';

$jsonToValidateObject->insalperic->fiminsalperic->infoamb[0]         = new \stdClass();
$jsonToValidateObject->insalperic->fiminsalperic->infoamb[0]->codamb = '123456';

$jsonToValidateObject->aposentesp                               = new \stdClass();
$jsonToValidateObject->aposentesp->iniaposentesp                = new \stdClass();
$jsonToValidateObject->aposentesp->iniaposentesp->dtinicondicao = '2017-08-28';

$jsonToValidateObject->aposentesp->iniaposentesp->infoamb[0]         = new \stdClass();
$jsonToValidateObject->aposentesp->iniaposentesp->infoamb[0]->codamb = '123456';

$jsonToValidateObject->aposentesp->iniaposentesp->infoamb[0]->fatrisco[0]            = new \stdClass();
$jsonToValidateObject->aposentesp->iniaposentesp->infoamb[0]->fatrisco[0]->codfatris = '9101';

$jsonToValidateObject->aposentesp->altaposentesp                = new \stdClass();
$jsonToValidateObject->aposentesp->altaposentesp->dtaltcondicao = '2017-08-28';

$jsonToValidateObject->aposentesp->altaposentesp->infoamb[0]         = new \stdClass();
$jsonToValidateObject->aposentesp->altaposentesp->infoamb[0]->codamb = '123456';

$jsonToValidateObject->aposentesp->altaposentesp->infoamb[0]->fatrisco[0]            = new \stdClass();
$jsonToValidateObject->aposentesp->altaposentesp->infoamb[0]->fatrisco[0]->codfatris = '9101';

$jsonToValidateObject->aposentesp->fimaposentesp                = new \stdClass();
$jsonToValidateObject->aposentesp->fimaposentesp->dtfimcondicao = '2017-08-28';

$jsonToValidateObject->aposentesp->fimaposentesp->infoamb[0]         = new \stdClass();
$jsonToValidateObject->aposentesp->fimaposentesp->infoamb[0]->codamb = '123456';

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
