<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2205 de 02_04_01 para 02_04_02
//Campo {cpfDep} – alterada validação da alínea a).
//Campo {racaCor} – alterada descrição dos valores [2, 3, 4].
//Campo {dtChegada} – alterada ocorrência e inserida validação.
//Criado o grupo {nascimento} e respectivos campos.
//S-2205 sem alterações de 02_04_02 para 02_05_00

$evento  = 'evtAltCadastral';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtAltCadastral",
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
        "dtalteracao": {
            "required": true,
            "type": "string",
            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
        },
        "nistrab": {
            "required": false,
            "type": ["string","null"],
            "pattern": "^[0-9]{11}$"
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
            "minimum": 1,
            "maximum": 6
        },
        "estciv": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 5
        },
        "grauinstr": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{2}$"
        },
        "nmsoc": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 70
        },
        "nascimento": {
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
                    "type": ["string","null"],
                    "pattern": "^[0-9]{7}$"
                },
                "uf": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 2,
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
                    "type": ["string","null"],
                    "maxLength": 70
                },
                "nmpai": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 70
                }
            }
        },
        "ctps": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nrctps": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 11,
                    "pattern": "^[0-9]"
                },
                "seriectps": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 5,
                    "pattern": "^[0-9]"
                },
                "ufctps": {
                    "required": true,
                    "type": "string",
                    "minLength": 2,
                    "maxLength": 2
                }
            }
        },
        "ric": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nrric": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 20
                },
                "dtexped": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "rg": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nrrg": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 20
                },
                "dtexped": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "rne": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nrrne": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 20
                },
                "dtexped": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "oc": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nroc": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 20
                },
                "dtexped": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "dtvalid": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "cnh": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nrregcnh": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 12
                },
                "dtexped": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "ufcnh": {
                    "required": true,
                    "type": "string",
                    "minLength": 2,
                    "maxLength": 2
                },
                "dtvalid": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "dtprihab": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "categoriacnh": {
                    "required": true,
                    "type": "string",
                    "pattern": "A|B|C|D|E|AB|AC|AD|AE"
                }
            }
        },
        "brasil": {
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
                    "minLength": 1,
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
        "exterior": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "paisresid": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 3
                },
                "dsclograd": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
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
                    "maxLength": 30
                },
                "bairro": {
                    "required": false,
                    "type": ["string","null"],
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
                    "minLength": 4,
                    "maxLength": 12
                }
            }
        },
        "trabestrangeiro": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtchegada": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "classtrabestrang": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 12
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
        "infodeficiencia": {
            "required": false,
            "type": ["object","null"],
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
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "S|N"
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 6,
                    "maxLength": 255
                }
            }
        },
        "dependente": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "tpdep": {
                        "required": true,
                        "type": "string",
                        "minLength": 2,
                        "maxLength": 2,
                        "pattern": "^[0-9]"
                    },
                    "nmdep": {
                        "required": true,
                        "type": "string",
                        "minLength": 2,
                        "maxLength": 70
                    },
                    "dtnascto": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                    },
                    "cpfdep": {
                        "required": false,
                        "type": ["string","null"],
                        "minLength": 11,
                        "maxLength": 11,
                        "pattern": "^[0-9]"
                    },
                    "depirrf": {
                        "required": true,
                        "type": "string",
                        "pattern": "S|N"
                    },
                    "depsf": {
                        "required": true,
                        "type": "string",
                        "pattern": "S|N"
                    },
                    "inctrab": {
                        "required": true,
                        "type": "string",
                        "pattern": "S|N"
                    }
                }
            }
        },
        "aposentadoria": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "trabaposent": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                }
            }
        },
        "contato": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "foneprinc": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 8,
                    "maxLength": 13
                },
                "fonealternat": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 8,
                    "maxLength": 13
                },
                "emailprinc": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 6,
                    "maxLength": 60
                },
                "emailalternat": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 6,
                    "maxLength": 60
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
$std->dtalteracao = '2017-11-11';

$std->nistrab = '12345678901';
$std->nmtrab = 'Fulano de Tal';
$std->sexo = 'M';
$std->racacor = 1;
$std->estciv = 1;
$std->grauinstr = '10';
$std->nmsoc = null;

$std->nascimento = new \stdClass();
$std->nascimento->dtnascto = '1982-11-02';
$std->nascimento->codmunic = '1234567';
$std->nascimento->uf = 'SP';
$std->nascimento->paisnascto = '090';
$std->nascimento->paisnac = '105';
$std->nascimento->nmmae = 'Fulana de Tal';
$std->nascimento->nmpai = 'Ciclano de Tal';

$std->ctps = new \stdClass();
$std->ctps->nrctps = '12345678901';
$std->ctps->seriectps = '12345';
$std->ctps->ufctps = 'SP';

$std->ric = new \stdClass();
$std->ric->nrric = '12345678901234';
$std->ric->orgaoemissor = 'LSLSLLSLLLSLSL';
$std->ric->dtexped = '2000-12-21';

$std->rg  = new \stdClass();
$std->rg->nrrg = '12345678901234';
$std->rg->orgaoemissor = 'jdjdjqjeiiei';
$std->rg->dtexped = '1998-01-25';

$std->rne = new \stdClass();
$std->rne->nrrne = '12345678901234';
$std->rne->orgaoemissor = 'lslslsllslllslslls';
$std->rne->dtexped = '2010-10-10';

$std->oc = new \stdClass();
$std->oc->nroc = '12345678901234';
$std->oc->orgaoemissor = 'lklklk3iosiosislk';
$std->oc->dtexped = '2011-11-06';
$std->oc->dtvalid = '2018-11-06';

$std->cnh = new \stdClass();
$std->cnh->nrregcnh = '123456789012';
$std->cnh->dtexped = '2013-12-05';
$std->cnh->ufcnh = 'SP';
$std->cnh->dtvalid = '2018-12-05';
$std->cnh->dtprihab = '1999-05-28';
$std->cnh->categoriacnh = 'AE';

$std->brasil = new \stdClass();
$std->brasil->tplograd = 'VRT';
$std->brasil->dsclograd = 'sei la';
$std->brasil->nrlograd = '123';
$std->brasil->complemento = 'fundos';
$std->brasil->bairro = 'fora da vila';
$std->brasil->cep = '99999999';
$std->brasil->codmunic = 1545648;
$std->brasil->uf = 'SP';

$std->exterior = new \stdClass();
$std->exterior->paisresid = 'ALB';
$std->exterior->dsclograd = 'ksksksksksks';
$std->exterior->nrlograd = '235 /1';
$std->exterior->complemento = 'lkslsklk';
$std->exterior->bairro = 'lksksksksksks';
$std->exterior->nmcid = 'Voskow';
$std->exterior->codpostal = '123456789012';

$std->trabestrangeiro = new \stdClass();
$std->trabestrangeiro->dtchegada = '2000-01-01';
$std->trabestrangeiro->classtrabestrang = 3;
$std->trabestrangeiro->casadobr = 'N';
$std->trabestrangeiro->filhosbr = 'N';

$std->infodeficiencia = new \stdClass();
$std->infodeficiencia->deffisica = 'N';
$std->infodeficiencia->defvisual = 'N';
$std->infodeficiencia->defauditiva = 'N';
$std->infodeficiencia->defmental = 'S';
$std->infodeficiencia->defintelectual = 'N';
$std->infodeficiencia->reabreadap = 'N';
$std->infodeficiencia->infocota = 'N';
$std->infodeficiencia->observacao = 'qualquer coisa lorem ipsum';

$std->dependente[1] = new \stdClass();
$std->dependente[1]->tpdep = '03';
$std->dependente[1]->nmdep = '123 de oliveira 4';
$std->dependente[1]->dtnascto = '2005-06-08';
$std->dependente[1]->cpfdep = '12345678901';
$std->dependente[1]->depirrf = 'N';
$std->dependente[1]->depsf = 'N';
$std->dependente[1]->inctrab = 'N';

$std->aposentadoria = new \stdClass();
$std->aposentadoria->trabaposent = 'N';

$std->contato = new \stdClass();
$std->contato->foneprinc = '888888888';
$std->contato->fonealternat = '55555555';
$std->contato->emailprinc = 'ciclano@email.com.br';
$std->contato->emailalternat = 'fulano@mail.com';

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
