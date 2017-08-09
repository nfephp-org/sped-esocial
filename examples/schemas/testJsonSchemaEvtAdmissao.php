<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento = 'evtAdmissao';
$version = '02_03_00';

$jsonSchema = '{
    "title": "evtAdmissao",
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
        "trabalhador": {
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
                "nmtrab": {
                    "required": true,
                    "type": "string",
                    "maxLength": 70
                },
                "sexo": {
                    "required": true,
                    "type": "string",
                    "pattern": "M|F"
                },
                "racacor": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "([1-6]){1}$"
                },
                "estciv": {
                    "required": false,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "([1-5]){1}$"
                },
                "grauinstr": {
                    "required": true,
                    "type": "string",
                    "maxLength": 2
                },
                "indpriempr": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "nmsoc": {
                    "required": false,
                    "type": "string",
                    "maxLength": 70
                },
                "nmsoc": {
                    "required": false,
                    "type": "string",
                    "maxLength": 70
                },
                "dtnascto": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "codmunic": {
                    "required": false,
                    "type": "string",
                    "maxLength": 7
                },
                "uf": {
                    "required": false,
                    "type": "string",
                    "maxLength": 2
                },
                "paisnascto": {
                    "required": true,
                    "type": "string",
                    "maxLength": 3
                },
                "paisnac": {
                    "required": true,
                    "type": "string",
                    "maxLength": 3
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
        "ctps": {
            "required": false,
            "type": "object",
            "properties": {
                "nrctps": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11
                },
                "seriectps": {
                    "required": true,
                    "type": "string",
                    "maxLength": 5
                },
                "ufctps": {
                    "required": true,
                    "type": "string",
                    "maxLength": 2
                }
            }
        },
        "nrric": {
            "required": false,
            "type": "object",
            "properties": {
                "nrric": {
                    "required": true,
                    "type": "string",
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
                    "maxLength": 20
                },
                "dtexped": {
                    "required": false,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "rg": {
            "required": false,
            "type": "object",
            "properties": {
                "nrrg": {
                    "required": true,
                    "type": "string",
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
                    "maxLength": 20
                },
                "dtexped": {
                    "required": false,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "rne": {
            "required": false,
            "type": "object",
            "properties": {
                "nrrne": {
                    "required": true,
                    "type": "string",
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
                    "maxLength": 20
                },
                "dtexped": {
                    "required": false,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "oc": {
            "required": false,
            "type": "object",
            "properties": {
                "nroc": {
                    "required": true,
                    "type": "string",
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
                    "maxLength": 20
                },
                "dtexped": {
                    "required": false,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "dtvalid": {
                    "required": false,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "cnh": {
            "required": false,
            "type": "object",
            "properties": {
                "nrregcnh": {
                    "required": true,
                    "type": "string",
                    "maxLength": 12
                },
                "dtexped": {
                    "required": false,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "ufcnh": {
                    "required": true,
                    "type": "string",
                    "maxLength": 2
                },
                "dtvalid": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "dtprihab": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
               "categoriacnh": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 2
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
        },
        "trabestrangeiro": {
            "required": false,
            "type": "object",
            "properties": {
                "dtchegada": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "classtrabestrang": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 2,
                    "pattern": "([1-12]){1}$"
                },
                "casadobr": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "filhosbr": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                }
            }
        },
        "deficiencia": {
            "required": false,
            "type": "object",
            "properties": {
                "deffisica": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "defvisual": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "defauditiva": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "defmental": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "defintelectual": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "reabreadap": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "infocota": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "observacao": {
                    "required": true,
                    "type": "string",
                    "maxLength": 255
                }
            }
        }
        
    }
}';


$jsonToValidateObject = new \stdClass();
$jsonToValidateObject->sequencial = 1;
$jsonToValidateObject->indretif = 1;

$trabalhador = new \stdClass();
$trabalhador->cpftrab = '11111111111';
$trabalhador->nistrab = '11111111111';
$trabalhador->nmtrab = 'JOSE DA SILVA';
$trabalhador->sexo = 'M';
$trabalhador->racacor = 5;
$trabalhador->grauinstr = '07';
$trabalhador->indpriempr = 'N';
$trabalhador->dtnascto = '1980-01-01';
$trabalhador->paisnascto = '105'; // 105 = Brasil
$trabalhador->paisnac = '105';

$jsonToValidateObject->trabalhador = $trabalhador;

$endereco = new \stdClass();
$brasil = new \stdClass();
$brasil->tplograd = 'R';
$brasil->dsclograd = 'Av. Paulista';
$brasil->nrlograd = '1850';
$brasil->bairro = 'Bela Vista';
$brasil->cep = '01311200';
$brasil->codmunic = 3550308;
$brasil->uf = 'SP';

$endereco->brasil = $brasil;
$jsonToValidateObject->endereco = $endereco;

$vinculo = new \stdClass();
$vinculo->matricula = '1020304050';
$vinculo->tpregtrab = 1;
$vinculo->tpregprev = 1;
$vinculo->cadini = 'N';

$celetista = new \stdClass();
$celetista->dtadm = '2017-08-08';
$celetista->tpadmissao = 1;
$celetista->indadmissao = 1;
$celetista->tpregjor = 1;
$celetista->natatividade = 1;
$celetista->cnpjsindcategprof = '77721644000101';
$celetista->opcfgts = 1;

$vinculo->celetista = $celetista;

$contrato = new \stdClass();
$contrato->codcateg = '101';
$contrato->vrsalfx = 5000;
$contrato->undsalfixo = 5;
$contrato->tpcontr = 1;

$vinculo->contrato = $contrato;

$jsonToValidateObject->vinculo = $vinculo;

$ctps = new \stdClass();
$ctps->nrctps = '12012315';
$ctps->seriectps = '500';
$ctps->ufctps = 'SP';

$jsonToValidateObject->ctps = $ctps;

$ric = new \stdClass();
$ric->nrric = '15150505';
$ric->orgaoemissor = 'SSP';
$ric->dtexped = '2015-01-01';

$jsonToValidateObject->ric = $ric;

$rg = new \stdClass();
$rg->nrrg = '11111111';
$rg->orgaoemissor = 'SSP';
$rg->dtexped = '2015-01-01';

$jsonToValidateObject->rg = $rg;

$oc = new \stdClass();
$oc->nroc = '12315861';
$oc->orgaoemissor = 'SSP';
$oc->dtexped = '2015-01-01';

$jsonToValidateObject->oc = $oc;

$cnh = new \stdClass();
$cnh->nrregcnh = '1231531';
$cnh->dtexped = '2015-01-01';
$cnh->ufcnh = 'SP';
$cnh->dtvalid = '2019-01-01';
$cnh->dtprihab = '2015-01-01';
$cnh->categoriacnh = 'AB';

$jsonToValidateObject->cnh = $cnh;

$dependente[0] = new \stdClass();
$dependente[0]->tpdep = '01';
$dependente[0]->nmdep = 'WATSON';
$dependente[0]->dtnascto = '2015-01-01';
$dependente[0]->cpfdep = '12345678985';
$dependente[0]->depirrf = 'N';
$dependente[0]->depsf = 'N';
$dependente[0]->inctrab = 'N';

$jsonToValidateObject->dependente = $dependente;

$contato = new \stdClass();
$contato->foneprinc = '1144443333';
$contato->fonealternat = '1122228888';
$contato->emailprinc = 'email@email.com.br';
$contato->emailalternat = 'emailalt@email.com.br';

$jsonToValidateObject->contato = $contato;

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