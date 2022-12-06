<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2206 versão inicial e-social simplificado v1.0.0

$evento  = 'evtAltContratual';
$version = 'S_01_00_00';

$jsonSchema = '{
    "title": "evtAltContratual",
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
            "maxLength": 40,
            "$ref": "#/definitions/recibo"
        },
        "cpftrab": {
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
            "$ref": "#/definitions/data"
        },
        "dtef": {
            "required": false,
            "type": ["string","null"],
            "$ref": "#/definitions/data"
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
                "trabtemporario": {
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
                },
                "indtetorgps": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "indabonoperm": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                }
            }
        },
        "infocontrato": {
            "required": true,
            "type": "object",
            "properties": {
                "nmcargo": {
                      "required": false,
                      "type": ["string","null"],
                      "maxLength": 100
                },
                "cbocargo": {
                      "required": false,
                      "type": ["string","null"],
                      "maxLength": 6
                },
                "nmfuncao": {
                      "required": false,
                      "type": ["string","null"],
                      "maxLength": 100
                },
                "cbofuncao": {
                      "required": false,
                      "type": ["string","null"],
                      "maxLength": 6
                },
                "acumcargo": {
                      "required": false,
                      "type": ["string","null"],
                      "pattern": "^(S|N)$"
                },
                "codcateg": {
                      "required": true,
                      "type": "integer",
                      "minimum": 101,
                      "maximum": 905
                },
                "vrsalfx": {
                    "required": false,
                    "type": "number"
                },
                "undsalfixo": {
                    "required": false,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 7
                },
                "dscsalvar": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 255
                },
                "tpcontr": {
                    "required": false,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                },
                "dtterm": {
                    "required": false,
                    "type": ["string","null"],
                    "$ref": "#/definitions/data"
                },
                "objdet": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^.{1,255}$"
                },
                "localtrabgeral": {
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
                            "pattern": "^[0-9]{11,14}$"
                        },
                        "desccomp": {
                              "required": false,
                              "type": ["string","null"],
                              "maxLength": 80
                        }
                    }
                },
                "localtempdom": {
                    "required": false,
                    "type": ["object","null"],
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
                            "type": ["string","null"],
                            "maxLength": 30
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 60
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
                            "maxLength": 2
                        }
                    }
                },
                "horcontratual": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "qtdhrssem": {
                            "required": true,
                            "type": "number",
                            "minimum": 0.1,
                            "maximum": 99.99
                        },
                        "tpjornada": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 9
                        },
                        "tmpparc": {
                            "required": true,
                            "type": "integer",
                            "minimum": 0,
                            "maximum": 3
                        },
                        "hornoturno": {
                            "required": false,
                            "type": ["string", "null"],
                            "pattern": "^(S|N)$"
                        },
                        "dscjorn": {
                            "required": true,
                            "type": ["string", "null"],
                            "maxLength": 999
                        }
                    }
                },
                "alvarajudicial": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "nrprocjud": {
                            "required": false,
                            "type": ["string","null"],
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
                                "maxLength": 255
                            }
                        }
                    }
                },
                "treicap": {
                    "required": false,
                    "type": ["array","null"],
                    "minItems": 0,
                    "maxItems": 99,
                    "items": {
                        "type": "object",
                        "properties": {
                            "codtreicap": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 9999
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
$std->nrrecibo = '1.1.1234567890123456789';
$std->cpftrab = '12345678901';
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
$std->infoceletista->trabtemporario = new \stdClass();
$std->infoceletista->trabtemporario->justprorr = 'kss kj s ljslkjsk slkjsl slksjlksjslkjs ';
$std->infoceletista->aprend = new \stdClass();
$std->infoceletista->aprend->tpinsc = 1;
$std->infoceletista->aprend->nrinsc = '12345678901234';

$std->infoestatutario = new \stdClass();
$std->infoestatutario->tpplanrp = 1;
$std->infoestatutario->indtetorgps = 'S';
$std->infoestatutario->indabonoperm = 'S';

$std->infocontrato = new \stdClass();
$std->infocontrato->nmcargo = 'Melhor cargo do país';
$std->infocontrato->cbocargo = '123456';
$std->infocontrato->nmfuncao = 'Melhor função de todas';
$std->infocontrato->cbofuncao = '654321';
$std->infocontrato->acumcargo = 'S';
$std->infocontrato->codcateg = 101;
$std->infocontrato->vrsalfx = 2547.56;
$std->infocontrato->undsalfixo = 7;
$std->infocontrato->dscsalvar = 'ksksksksk';
$std->infocontrato->tpcontr = 1;
$std->infocontrato->dtterm = '2018-01-01';
$std->infocontrato->objdet = 'ksksks';

$std->infocontrato->localtrabgeral = new \stdClass();
$std->infocontrato->localtrabgeral->tpinsc = 2;
$std->infocontrato->localtrabgeral->nrinsc = '12345678901234';
$std->infocontrato->localtrabgeral->desccomp = 'lkdldkldkldk';

$std->infocontrato->localtempdom = new \stdClass();
$std->infocontrato->localtempdom->tplograd = 'AV';
$std->infocontrato->localtempdom->dsclograd = 'sm,sm,sms,ms,ms';
$std->infocontrato->localtempdom->nrlograd = '27272';
$std->infocontrato->localtempdom->complemento = 'sjsksjhsh';
$std->infocontrato->localtempdom->bairro = 'sjhsj';
$std->infocontrato->localtempdom->cep = '99999999';
$std->infocontrato->localtempdom->codmunic = '1234567';
$std->infocontrato->localtempdom->uf = 'AC';

$std->infocontrato->horcontratual = new \stdClass();
$std->infocontrato->horcontratual->qtdhrssem = 99.50;
$std->infocontrato->horcontratual->tpjornada = 9;
$std->infocontrato->horcontratual->dsctpjorn = 'kjsksjsjs';
$std->infocontrato->horcontratual->tmpparc = 0;
$std->infocontrato->horcontratual->hornoturno = 'N';
$std->infocontrato->horcontratual->dscjorn = 'De 2a a 6a feira, das 8:00 às 12:00 e das 13:00 às 17:00 e no sábado das 8:00 às 12:00';

$std->infocontrato->alvarajudicial = new \stdClass();
$std->infocontrato->alvarajudicial->nrprocjud = '12345678901234567890';

$std->infocontrato->observacoes[0] = new \stdClass();
$std->infocontrato->observacoes[0]->observacao = 'kjskjsksksj';

$std->infocontrato->treicap[0] = new \stdClass();
$std->infocontrato->treicap[0]->codtreicap = 1001;

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
