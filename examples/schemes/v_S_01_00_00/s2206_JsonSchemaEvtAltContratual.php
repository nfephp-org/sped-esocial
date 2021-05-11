<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2206
//Campo {dtTerm} – alterada validação.

$evento  = 'evtAltContratual';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtAltContratual",
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
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "matricula": {
            "required": true,
            "type": "string",
            "maxLength": 30
        },
        "dtalteracao": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "dtef": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "dscalt": {
            "required": false,
            "type": ["string","null"],
            "minLength": 3,
            "maxLength": 150
        },
        "tpregprev": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 3
        },
        "infoceletista": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tpregjor": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 4
                },
                "natatividade": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "dtbase": {
                    "required": false,
                    "type": ["integer","null"],
                    "minimum": 1,
                    "maximum": 12
                },
                "cnpjsindcategprof": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{8,14}$" 
                },
                "trabtemp": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "justprorr": {
                            "required": true,
                            "type": "string",
                            "minLength": 3,
                            "maxLength": 999
                        }
                    }
                },
                "aprend": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "tpinsc": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 2
                        },
                        "nrinsc": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{8,14}$"
                        }
                    }
                }
            }
        },
        "infoestatutario": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tpplanrp": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                }
            }
        },
        "infocontrato": {
            "required": true,
            "type": "object",
            "properties": {
                "codcargo": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 30
                },
                "codfuncao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 30
                },
                "codcateg": {
                    "required": true,
                    "type": "integer",
                    "maximum": 999
                },
                "codcarreira": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 30
                },
                "dtingrcarr": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "vrsalfx": {
                    "required": true,
                    "type": "number"
                },
                "undsalfixo": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 7
                },
                "dscsalvar": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 3,
                    "maxLength": 255
                },
                "tpcontr": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                },
                "dtterm": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "objdet": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^.{1,255}$"
                }
            }
        },
        "localtrabgeral": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tpinsc": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 4
                },
                "nrinsc": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{8,14}$"
                },
                "desccomp": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 80
                }
            }
        },
        "localtrabdom": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "tplograd": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 4
                },
                "dsclograd": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 80
                },
                "nrlograd": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 10
                },
                "complemento": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 30
                },
                "bairro": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 60
                },
                "cep": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{8}$"
                },
                "codmunic": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 9999999
                },
                "uf": {
                    "required": true,
                    "type": "string",
                    "minLength": 2,
                    "maxLength": 2
                }
            }
        },
        "horcontratual": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "qtdhrssem": {
                    "required": false,
                    "type": ["number","null"]
                },
                "tpjornada": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 9
                },
                "dsctpjorn": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 3,
                    "maxLength": 100
                },
                "tmpparc": {
                    "required": true,
                    "type": "integer",
                    "minimum": 0,
                    "maximum": 3
                },
                "horario": {
                    "required": false,
                    "type": ["array","null"],
                    "minItems": 0,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "dia": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 8
                            },
                            "codhorcontrat": {
                                "required": true,
                                "type": "string",
                                "minLength": 1,
                                "maxLength": 30
                            }
                        }
                    }
                }
            }
        },
        "filiacaosindical": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 2,
            "items": {
                "type": "object",
                "properties": {
                    "cnpjsindtrab": {
                        "required": true,
                        "type": "string",
                        "minLength": 14,
                        "maxLength": 14,
                        "pattern": "^[0-9]"
                    }
                }
            }    
        },
        "alvarajudicial": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nrprocjud": {
                    "required": true,
                    "type": "string",
                    "pattern": "^.{20}$"
                }
            }
        },
        "observacoes": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "observacao": {
                        "required": true,
                        "type": "string",
                        "pattern": "^.{3,255}$"
                    }
                }
            }    
        },
        "servpubl": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "mtvalter": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 9
                }
            }
        }
    }
}';

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab = '12345678901';
$std->nistrab = '12345678901';
$std->matricula = '12345678901';
$std->dtalteracao = '2017-11-11';
$std->dtef = '2017-11-11';
$std->dscalt = 'lkslkslksçl çs çskçsk slkslsk';
$std->tpregprev = 1;

$std->infoceletista = new \stdClass();
$std->infoceletista->tpregjor = 1;
$std->infoceletista->natatividade = 2;
$std->infoceletista->dtbase = 11;
$std->infoceletista->cnpjsindcategprof = '12345678901234';
$std->infoceletista->trabtemp = new \stdClass();
$std->infoceletista->trabtemp->justprorr = 'kss kj s ljslkjsk slkjsl slksjlksjslkjs ';
$std->infoceletista->aprend = new \stdClass();
$std->infoceletista->aprend->tpinsc = 1;
$std->infoceletista->aprend->nrinsc = '12345678901234';

$std->infoestatutario = new \stdClass();
$std->infoestatutario->tpplanrp = 1;

$std->infocontrato = new \stdClass();
$std->infocontrato->codcargo = 'xxxx';
$std->infocontrato->codfuncao = 'ffff';
$std->infocontrato->codcateg = 101;
$std->infocontrato->codcarreira = 'carreira x';
$std->infocontrato->dtingrcarr = '2000-10-10';
$std->infocontrato->vrsalfx = 2589.55;
$std->infocontrato->undsalfixo = 4;
$std->infocontrato->dscsalvar = 'kjkjskjskjksjksjksjksjs';
$std->infocontrato->tpcontr = 2;
$std->infocontrato->dtterm = '2018-02-22';
$std->infocontrato->objdet = 'sksksksk';

$std->localtrabgeral = new \stdClass();
$std->localtrabgeral->tpinsc = 3; //1,3,ou 4
$std->localtrabgeral->nrinsc = '12345678901234';
$std->localtrabgeral->desccomp = 'çaçlks sçaçlsskjsjksh ksjh sjh';

$std->localtrabdom = new \stdClass();
$std->localtrabdom->tplograd = 'A';
$std->localtrabdom->dsclograd = 'sei la 2';
$std->localtrabdom->nrlograd = '25n';
$std->localtrabdom->complemento = 'por cima';
$std->localtrabdom->bairro = 'si de baixo';
$std->localtrabdom->cep = '04598777';
$std->localtrabdom->codmunic = 3512458;
$std->localtrabdom->uf = 'AL';

$std->horcontratual = new \stdClass();
$std->horcontratual->qtdhrssem = 46.25;
$std->horcontratual->tpjornada = 1;
$std->horcontratual->dsctpjorn = 'kslksçksçlksçlsk';
$std->horcontratual->tmpparc = 0;

$std->horcontratual->horario[1] = new \stdClass();
$std->horcontratual->horario[1]->dia = 1;
$std->horcontratual->horario[1]->codhorcontrat = 'sss';


$std->filiacaosindical[1] = new \stdClass();
$std->filiacaosindical[1]->cnpjsindtrab = '12345678901234';
$std->filiacaosindical[2] = new \stdClass();
$std->filiacaosindical[2]->cnpjsindtrab = '01234567890123';

$std->alvarajudicial = new \stdClass();
$std->alvarajudicial->nrprocjud = '12345678901234567890';

$std->observacoes[1] = new \stdClass();
$std->observacoes[1]->observacao = 'lkslslkslksls ls lks lskls slks lsk lskls s';
$std->observacoes[2] = new \stdClass();
$std->observacoes[2]->observacao = 'uoeiueouoiueoiueieu eue eue euoeueiueoieu eu';


$std->servpubl = new \stdClass();
$std->servpubl->mtvalter = 8;


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
