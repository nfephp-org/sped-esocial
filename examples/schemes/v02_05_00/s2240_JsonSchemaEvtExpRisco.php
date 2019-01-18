<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2240 sem alterações da 2.4.1 => 2.4.2
//S-2240 
//Grupo {ativPericInsal} – alterada ocorrência.
//Campo {dtIniCondicao} – alterada descrição.
//Campo {limTol} – incluída validação.
//Campo {unMed} – alterada descrição dos valores [14, 37] e incluídos valores [45, 46, 47].
//Campo {eficEpc} – alterada ocorrência.
//Campo {ideOC} – excluído valor [2] e incluído valor [4].
//Campo {dscOC} – alterada validação.
//Campo {metErg} – incluída validação.
//Campo {observacao} – alterado nome (para {obsCompl}) e incluída validação.

$evento = 'evtExpRisco';
$version = '02_05_00';

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
            "pattern": "^[0-9]{11}$"
        },
        "nistrab": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{11}$"
        },
        "matricula": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 30
        },
        "codcateg": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{3}$"
        },
        "dtcondicao": {
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
                "required": true,
                "type": "object",
                "properties": {
                    "codamb": {
                        "required": true,
                        "type": "string",
                        "maxLength": 30
                    }
                }
            }
        },
        "infoativ": {
            "required": true,
            "type": "object",
            "properties": {
                "dscativdes": {
                    "required": true,
                    "type": "string",
                    "maxLength": 999
                },
                "ativpericinsal": {
                    "required": true,
                    "type": "array",
                    "minItems": 1,
                    "maxItems": 99,
                    "items": {
                        "required": true,
                        "type": "object",
                        "properties": {
                            "codativ": {
                                "required": true,
                                "type": "string",
                                "maxLength": 6
                            }
                        }
                    }    
                }
            }
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
                        "pattern": "^([0-9][0-9.]*[0-9])$"
                    },
                    "tpaval": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 2
                    },
                    "intconc": {
                        "required": false,
                        "type": ["number","null"]
                    },
                    "limtol": {
                        "required": false,
                        "type": ["number","null"]
                    },
                    "umed": {
                        "required": false,
                        "type": ["integer","null"],
                        "minimum": 1,
                        "maximum": 47
                    },
                    "tecmedicao": {
                        "required": false,
                        "type": ["string","null"],
                        "maxLength": 40
                    },
                    "insalubridade": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^(S|N)$"
                    },
                    "periculosidade": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^(S|N)$"
                    },
                    "aposentesp": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^(S|N)$"
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
                            "eficepc": {
                                "required": false,
                                "type": ["string","null"],
                                "pattern": "^(S|N)$"
                            },
                            "utilizepi": {
                                "required": true,
                                "type": "integer",
                                "minimum": 0,
                                "maximum": 2
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
                                        "dscepi": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "maxLength": 999
                                        },
                                        "eficepi": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "medprotecao": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "condfuncto": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "usoinint": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "przvalid": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "periodictroca": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        },
                                        "higienizacao": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^(S|N)$"
                                        }
                                    }
                                }
                            }    
                        }
                    }
                }    
            }
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
                    "cpfresp": {
                        "required": true,
                        "type": "string",
                        "pattern": "^[0-9]{11}$"
                    },
                    "nisresp": {
                        "required": true,
                        "type": "string",
                        "pattern": "^[0-9]{11}$"
                    },
                    "nmresp": {
                        "required": true,
                        "type": "string",
                        "pattern": "^.{1,70}$"
                    },
                    "ideoc": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 9
                    },
                    "dscoc": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^.{1,20}$"
                    },
                    "nroc": {
                        "required": true,
                        "type": "string",
                        "maxLength": 14
                    },
                    "ufoc": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^.{2}$"
                    }
                }
            }    
        },
        "obs": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "meterg": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^.{2,999}$"
                },
                "obscompl": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^.{2,999}$"
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
$std->codcateg = '111';
$std->dtcondicao = '2016-02-01';

$std->infoamb[0] = new \stdClass();
$std->infoamb[0]->codamb = 'abcdefg';

$std->infoamb[1] = new \stdClass();
$std->infoamb[1]->codamb = 'xxxxx';

$std->infoativ = new \stdClass();
$std->infoativ->dscativdes = 'lkskslkslsklsks  lsk slsklsk';
$std->infoativ->ativpericinsal[0] = new \stdClass();
$std->infoativ->ativpericinsal[0]->codativ = '221111';

$std->fatrisco[0] = new \stdClass();
$std->fatrisco[0]->codfatris = '01.01.012';
$std->fatrisco[0]->tpaval = 1;
$std->fatrisco[0]->intconc = 20;
$std->fatrisco[0]->limtol = 22.34;
$std->fatrisco[0]->unmed = 47;
$std->fatrisco[0]->tecmedicao = 'dosimetro Geiger- Muller de halogenio';
$std->fatrisco[0]->insalubridade = 'N';
$std->fatrisco[0]->periculosidade = 'N';
$std->fatrisco[0]->aposentesp = 'N';

$std->fatrisco[0]->epcepi = new \stdClass();
$std->fatrisco[0]->epcepi->utilizepc = 1; // 0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado.
$std->fatrisco[0]->epcepi->eficepc = 'S';
$std->fatrisco[0]->epcepi->utilizepi = 1; //0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado

$std->fatrisco[0]->epcepi->epi[0] = new \stdClass();
$std->fatrisco[0]->epcepi->epi[0]->caepi = '111xxx';
$std->fatrisco[0]->epcepi->epi[0]->dscepi = 'macacao';
$std->fatrisco[0]->epcepi->epi[0]->eficepi = 'S';
$std->fatrisco[0]->epcepi->epi[0]->medprotecao = 'S';
$std->fatrisco[0]->epcepi->epi[0]->condfuncto = 'S';
$std->fatrisco[0]->epcepi->epi[0]->usoinint = 'S';
$std->fatrisco[0]->epcepi->epi[0]->przvalid = 'S';
$std->fatrisco[0]->epcepi->epi[0]->periodictroca = 'S';
$std->fatrisco[0]->epcepi->epi[0]->higienizacao = 'S';

$std->respreg[0] = new \stdClass();
$std->respreg[0]->cpfresp = '12345678901';
$std->respreg[0]->nisresp = '12345678901';
$std->respreg[0]->nmresp = 'Fulano de Tal';
$std->respreg[0]->ideoc = 4;
$std->respreg[0]->dscoc = 'bla bla bla';
$std->respreg[0]->nroc = '12345678901234';
$std->respreg[0]->ufoc = 'SP';

$std->obs = new \stdClass();
$std->obs->meterg = 'slksjlskjs lks lksj s';
$std->obs->obscompl = 'kslksj s sljsljs ks';



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
$jsonValidator->validate($std, $jsonSchemaObject);

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
