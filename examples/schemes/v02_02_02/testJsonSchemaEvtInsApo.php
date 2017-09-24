<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtInsApo';
$version = '02_02_02';

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

$std             = new \stdClass();
$std->sequencial = 1;
$std->indretif   = 1;

$std->idevinculo            = new \stdClass();
$std->idevinculo->cpftrab   = '11111111111';
$std->idevinculo->nistrab   = '11111111111';
$std->idevinculo->matricula = '11111111111';

$std->insalperic                               = new \stdClass();
$std->insalperic->iniinsalperic                = new \stdClass();
$std->insalperic->iniinsalperic->dtinicondicao = '2017-08-28';

$std->insalperic->iniinsalperic->infoamb[0]         = new \stdClass();
$std->insalperic->iniinsalperic->infoamb[0]->codamb = '123546';

$std->insalperic->iniinsalperic->infoamb[0]->fatrisco[0]            = new \stdClass();
$std->insalperic->iniinsalperic->infoamb[0]->fatrisco[0]->codfatris = '123456';

$std->insalperic->altinsalperic                = new \stdClass();
$std->insalperic->altinsalperic->dtaltcondicao = '2017-08-28';

$std->insalperic->altinsalperic->infoamb[0]         = new \stdClass();
$std->insalperic->altinsalperic->infoamb[0]->codamb = '123456';

$std->insalperic->altinsalperic->infoamb[0]->fatrisco[0]            = new \stdClass();
$std->insalperic->altinsalperic->infoamb[0]->fatrisco[0]->codfatris = '123456';


$std->insalperic->fiminsalperic                = new \stdClass();
$std->insalperic->fiminsalperic->dtfimcondicao = '2017-08-28';

$std->insalperic->fiminsalperic->infoamb[0]         = new \stdClass();
$std->insalperic->fiminsalperic->infoamb[0]->codamb = '123456';

$std->aposentesp                               = new \stdClass();
$std->aposentesp->iniaposentesp                = new \stdClass();
$std->aposentesp->iniaposentesp->dtinicondicao = '2017-08-28';

$std->aposentesp->iniaposentesp->infoamb[0]         = new \stdClass();
$std->aposentesp->iniaposentesp->infoamb[0]->codamb = '123456';

$std->aposentesp->iniaposentesp->infoamb[0]->fatrisco[0]            = new \stdClass();
$std->aposentesp->iniaposentesp->infoamb[0]->fatrisco[0]->codfatris = '9101';

$std->aposentesp->altaposentesp                = new \stdClass();
$std->aposentesp->altaposentesp->dtaltcondicao = '2017-08-28';

$std->aposentesp->altaposentesp->infoamb[0]         = new \stdClass();
$std->aposentesp->altaposentesp->infoamb[0]->codamb = '123456';

$std->aposentesp->altaposentesp->infoamb[0]->fatrisco[0]            = new \stdClass();
$std->aposentesp->altaposentesp->infoamb[0]->fatrisco[0]->codfatris = '9101';

$std->aposentesp->fimaposentesp                = new \stdClass();
$std->aposentesp->fimaposentesp->dtfimcondicao = '2017-08-28';

$std->aposentesp->fimaposentesp->infoamb[0]         = new \stdClass();
$std->aposentesp->fimaposentesp->infoamb[0]->codamb = '123456';

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
