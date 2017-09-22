<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtExpRisco';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtExpRisco",
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
        "nrrecibo": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 40
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "minLength": 11,
            "maxLength": 11
        },
        "nistrab": {
            "required": false,
            "type": ["string","null"],
            "minLength": 11,
            "maxLength": 11
        },
        "matricula": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 30
        },
        "respreg": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 9,
            "items": {
                "required": true,
                "type": "object",
                "properties": {
                    "dtini": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                    },
                    "dtfim": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                    },
                    "nisresp": {
                        "required": true,
                        "type": "string",
                        "minLength": 11,
                        "maxLength": 11
                    },
                    "nroc": {
                        "required": true,
                        "type": "string",
                        "maxLength": 14
                    },
                    "ufoc": {
                        "required": false,
                        "type": ["string","null"],
                        "minLength": 2,
                        "maxLength": 2
                    }
                }
            }
        },
        "modo": {
            "required": true,
            "type": "string",
            "pattern": "INI|ALT|FIM"
        },
        "dtcondicao": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "infoamb": {
            "required": false,
            "type": ["array","null"],
            "minItems": 1,
            "maxItems": 99,
            "items": {
                "required": true,
                "type": "object",
                "properties": {
                    "codamb": {
                        "required": true,
                        "type": "string",
                        "maxLength": 30
                    },
                    "dscativdes": {
                        "required": false,
                        "type": ["string","null"],
                        "maxLength": 999
                    },
                    "fatrisco": {
                        "required": true,
                        "type": "array",
                        "minItems": 1,
                        "maxItems": 999,
                        "items": {
                            "required": true,
                            "type": "object",
                            "properties": {
                                "codfatris": {
                                    "required": true,
                                    "type": "string",
                                    "minLength": 9,
                                    "maxLength": 10,
                                    "pattern": "[0-9][0-9.]*[0-9]"
                                },
                                "intconc": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "maxLength": 15
                                },
                                "tecmedicao": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "maxLength": 40
                                },
                                "epcepi": {
                                    "required": true,
                                    "type": "object",
                                    "properties": {
                                        "utilizepc": {
                                            "required": true,
                                            "type": "integer",
                                            "minimum": 0,
                                            "maximum": 2
                                        },
                                        "utilizepi": {
                                            "required": true,
                                            "type": "integer",
                                            "minimum": 0,
                                            "maximum": 2
                                        },
                                        "epc": {
                                            "required": false,
                                            "type": ["array","null"],
                                            "minItems": 0,
                                            "maxItems": 50,
                                            "items": {
                                                "required": true,
                                                "type": "object",
                                                "properties": {
                                                    "dscepc": {
                                                        "required": true,
                                                        "type": "string",
                                                        "maxLength": 70
                                                    },
                                                    "eficepc": {
                                                        "required": true,
                                                        "type": "string",
                                                        "minLength": 1,
                                                        "maxLength": 1,
                                                        "pattern": "S|N"
                                                    }
                                                }
                                            }
                                        },
                                        "epi": {
                                            "required": false,
                                            "type": ["array","null"],
                                            "minItems": 0,
                                            "maxItems": 50,
                                            "items": {
                                                "required": true,
                                                "type": "object",
                                                "properties": {
                                                    "caepi": {
                                                        "required": false,
                                                        "type": ["string","null"],
                                                        "maxLength": 20
                                                    },
                                                    "eficepi": {
                                                        "required": true,
                                                        "type": "string",
                                                        "minLength": 1,
                                                        "maxLength": 1,
                                                        "pattern": "S|N"
                                                    },
                                                    "medprotecao": {
                                                        "required": true,
                                                        "type": "string",
                                                        "minLength": 1,
                                                        "maxLength": 1,
                                                        "pattern": "S|N"
                                                    },
                                                    "condfuncto": {
                                                        "required": true,
                                                        "type": "string",
                                                        "minLength": 1,
                                                        "maxLength": 1,
                                                        "pattern": "S|N"
                                                    },
                                                    "przvalid": {
                                                        "required": true,
                                                        "type": "string",
                                                        "minLength": 1,
                                                        "maxLength": 1,
                                                        "pattern": "S|N"
                                                    },
                                                    "periodictroca": {
                                                        "required": true,
                                                        "type": "string",
                                                        "minLength": 1,
                                                        "maxLength": 1,
                                                        "pattern": "S|N"
                                                    },
                                                    "higienizacao": {
                                                        "required": true,
                                                        "type": "string",
                                                        "minLength": 1,
                                                        "maxLength": 1,
                                                        "pattern": "S|N"
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
    }    
}';


$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = null;
$std->cpftrab = '12345678901';
$std->nistrab = '12345678901';
$std->matricula = '002zcbv';
$std->respreg[] = new \stdClass();
$std->respreg[0]->dtini = '2015-02-04';
$std->respreg[0]->dtfim = null;
$std->respreg[0]->nisresp = '12345678901';
$std->respreg[0]->nroc = '12345678901234';
$std->respreg[0]->ufoc = 'SP';
$std->modo = 'INI'; //['INI', 'ALT', 'FIM']
$std->dtcondicao = '2016-02-01';

$std->infoamb[] = new \stdClass();
$std->infoamb[0]->codamb = 'abcdefg';

//opcional depende do modo
$std->infoamb[0]->dscativdes = 'Descricao das atividades, fisicas ou mentais, realizadas pelo trabalhador, por forca do poder de comando a que se submete.';
$std->infoamb[0]->fatrisco[] = new \stdClass();
$std->infoamb[0]->fatrisco[0]->codfatris = '01.01.012';
$std->infoamb[0]->fatrisco[0]->intconc = '20 mSv';
$std->infoamb[0]->fatrisco[0]->tecmedicao = 'dosimetro Geiger- Muller de halogenio';
$std->infoamb[0]->fatrisco[0]->epcepi = new \stdClass();
$std->infoamb[0]->fatrisco[0]->epcepi->utilizepc = 1;// 0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado.
$std->infoamb[0]->fatrisco[0]->epcepi->utilizepi = 1;//0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado
//opcional
$std->infoamb[0]->fatrisco[0]->epcepi->epc[] = new \stdClass();
$std->infoamb[0]->fatrisco[0]->epcepi->epc[0]->dscepc = 'barreira de contencao';
$std->infoamb[0]->fatrisco[0]->epcepi->epc[0]->eficepc = 'S'; //S - Sim; N - Não.
//opcional
$std->infoamb[0]->fatrisco[0]->epcepi->epi[] = new \stdClass();
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->caepi = 'macacao';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->eficepi = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->medprotecao = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->condfuncto = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->przvalid = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->periodictroca = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->higienizacao = 'S';


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
file_put_contents("../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
