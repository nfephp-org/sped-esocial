<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-5013 EvtFGTS

$evento = 'evtFGTS';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtFGTS",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "perapur": {
            "required": true,
            "type": "string",
            "pattern": "^([0-9]{4}-(0[1-9]{1}|1[0-2]{1}))$"
        },
        "infofgts": {
            "required": true,
            "type": "object",
            "properties": {
                "nrrecarqbase": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 40
                },
                "indexistinfo": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                },
                "infobasefgts": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "baseperapur": {
                            "required": false,
                            "type": "array",
                            "minItems": 0,
                            "maxItems": 21,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "tpvalor": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^[0-9]{2}$"
                                    },
                                    "basefgts": {
                                        "required": true,
                                        "type": "number"
                                    }
                                }
                            }
                        },
                        "infobaseperante": {
                            "required": false,
                            "type": "array",
                            "minItems": 0,
                            "maxItems": 180,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "perref": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^([0-9]{4}-(0[1-9]{1}|1[0-2]{1}))$"
                                    },
                                    "baseperante": {
                                        "required": true,
                                        "type": "array",
                                        "minItems": 1,
                                        "maxItems": 11,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "tpvalore": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^[0-9]{2}$"
                                                },
                                                "basefgtse": {
                                                    "required": true,
                                                    "type": "number"
                                                }
                                            }
                                        }    
                                    }
                                }
                            }    
                        }
                    }
                },
                "infodpsfgts": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "dpsperapur": {
                            "required": false,
                            "type": "array",
                            "minItems": 0,
                            "maxItems": 20,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "tpdps": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^[0-9]{2}$"
                                    },
                                    "vrfgts": {
                                        "required": true,
                                        "type": "number"
                                    }
                                }
                            }    
                        },
                        "infodpsperante": {
                            "required": false,
                            "type": "array",
                            "minItems": 0,
                            "maxItems": 180,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "perref": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^([0-9]{4}-(0[1-9]{1}|1[0-2]{1}))$"
                                    },
                                    "dpsperante": {
                                        "required": true,
                                        "type": "array",
                                        "minItems": 1,
                                        "maxItems": 10,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "tpdpse": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^[0-9]{2}$"
                                                },
                                                "vrfgtse": {
                                                    "required": true,
                                                    "type": "number"
                                                }
                                            }
                                        } 
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
$std->sequencial = 1;
$std->perapur = '2019-01';

$std->infofgts = new \stdClass();
$std->infofgts->nrrecarqbase = '1234567-1234567-1234567';
$std->infofgts->indexistinfo = 1;

$std->infofgts->infobasefgts = new \stdClass();

$std->infofgts->infobasefgts->baseperapur[0] = new \stdClass();
$std->infofgts->infobasefgts->baseperapur[0]->tpvalor = '11';
$std->infofgts->infobasefgts->baseperapur[0]->basefgts = 2547.88;

$std->infofgts->infobasefgts->infobaseperante[0] = new \stdClass();
$std->infofgts->infobasefgts->infobaseperante[0]->perref = '2019-01';

$std->infofgts->infobasefgts->infobaseperante[0]->baseperante[0] = new \stdClass();
$std->infofgts->infobasefgts->infobaseperante[0]->baseperante[0]->tpvalore = '24';
$std->infofgts->infobasefgts->infobaseperante[0]->baseperante[0]->basefgtse = 18158.66;

$std->infofgts->infodpsfgts = new \stdClass();

$std->infofgts->infodpsfgts->dpsperapur[0] = new \stdClass();
$std->infofgts->infodpsfgts->dpsperapur[0]->tpdps = '51';
$std->infofgts->infodpsfgts->dpsperapur[0]->vrfgts = 1554.78;

$std->infofgts->infodpsfgts->infodpsperante[0] = new \stdClass();
$std->infofgts->infodpsfgts->infodpsperante[0]->perref = '2019-01';

$std->infofgts->infodpsfgts->infodpsperante[0]->dpsperante[0] = new \stdClass();
$std->infofgts->infodpsfgts->infodpsperante[0]->dpsperante[0]->tpdpse = '53';
$std->infofgts->infodpsfgts->infodpsperante[0]->dpsperante[0]->vrfgtse = 1554.78;


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
