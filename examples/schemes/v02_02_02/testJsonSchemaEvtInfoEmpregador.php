<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtInfoEmpregador';
$version = '02_02_02';

$jsonSchema = '{
    "title": "evtInfoEmpregador",
    "type": "object",
    "properties": {
        "sequencial": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 99999
        },
        "modo": {
            "required": true,
            "type": "string",
            "pattern": "INC|ALT|EXC"
        },
        "ideperiodo": {
            "required": false,
            "type": "object",
            "properties": {
                "inivalid": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                },
                "fimvalid": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                }
            }    
        },
        "infocadastro": {
            "required": false,
            "type": "object",
            "properties": {
                "nmrazao": {
                    "required": true,
                    "type": "string",
                    "maxLength": 100
                },
                "classtrib": {
                    "required": true,
                    "type": "string",
                    "maxLength": 2
                },
                "natjurid": {
                    "required": false,
                    "type": ["string", "null"],
                    "maxLength": 4
                },
                "indcoop": {
                    "required": false,
                    "type": "integer",
                    "minimum": 0,
                    "maximum": 3
                },
                "indconstr": {
                    "required": false,
                    "type": "integer",
                    "minimum": 0,
                    "maximum": 1
                },
                "inddesfolha": {
                    "required": true,
                    "type": "integer",
                    "minimum": 0,
                    "maximum": 1
                },
                "indoptregeletron": {
                    "required": true,
                    "type": "integer",
                    "minimum": 0,
                    "maximum": 1
                },
                "indented": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "S|N"
                },
                "indett": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "nrregett": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 30,
                    "pattern": "^[0-9]"
                }
            }
        },
        "dadosisencao": {
            "required": false,
            "type": "object",
            "properties": {
                "ideminlei": {
                    "required": true,
                    "type": "string",
                    "maxLength": 70
                },
                "nrcertif": {
                    "required": true,
                    "type": "string",
                    "maxLength": 40
                },
                "dtemiscertif": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "dtvenccertif": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "nrprotrenov": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 40
                },
                "dtprotrenov": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "dtdou": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "pagdou": {
                    "required": false,
                    "type": ["integer","null"],
                    "maximum": 99999
                }
            }
        },
        "contato": {
            "required": false,
            "type": "object",
            "properties": {
                "nmctt": {
                    "required": true,
                    "type": "string",
                    "maxLength": 70
                },
                "cpfctt": {
                    "required": true,
                    "type": "string",
                    "maxLength": 11
                },
                "fonefixo": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 13
                },
                "fonecel": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 13
                },
                "email": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 60
                }
            }
        },
        "infoop": {
            "required": false,
            "type": "object",
            "properties": {
                "nrsiafi": {
                    "required": true,
                    "type": "string",
                    "maxLength": 6
                }
            }
        },
        "infoefr": {
            "required": false,
            "type": "object",
            "properties": {
                "ideefr": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "cnpjefr": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 14,
                    "pattern": "^[0-9]"
                }
            }
        },
        "infoente": {
            "required": false,
            "type": "object",
            "properties": {
                "nmente": {
                    "required": true,
                    "type": "string",
                    "maxLength": 100
                },
                "uf": {
                    "required": true,
                    "type": "string",
                    "minLength": 2,
                    "maxLength": 2
                },
                "codmunic": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 6,
                    "pattern": "^[0-9]"
                },
                "indrpps": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "subteto": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 9
                },
                "vrsubteto": {
                    "required": true,
                    "type": "number"
                }
            }
        },
        "infoorginternacional": {
            "required": false,
            "type": "object",
            "properties": {
                "indacordoisenmulta": {
                    "required": true,
                    "type": "integer",
                    "minimum": 0,
                    "maximum": 1
                }
            }
        },
        "softwarehouse": {
            "required": false,
            "type": "array",
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "cnpjsofthouse": {
                        "required": true,
                        "type": "string",
                        "maxLength": 14,
                        "pattern": "^[0-9]"
                    },
                    "nmrazao": {
                        "required": true,
                        "type": "string",
                        "maxLength": 100
                    },
                    "nmcont": {
                        "required": true,
                        "type": "string",
                        "maxLength": 70
                    },
                    "telefone": {
                        "required": true,
                        "type": "string",
                        "maxLength": 13
                    },
                    "email": {
                        "required": false,
                        "type": ["string","null"],
                        "maxLength": 60
                    }
                }
            }    
        },        
        "situacaopj": {
            "required": false,
            "type": "object",
            "properties": {
                "indsitpj": {
                    "required": true,
                    "type": "integer",
                    "minimum": 0,
                    "maximum": 4
                }
            }
        },
        "situacaopf": {
            "required": false,
            "type": "object",
            "properties": {
                "indsitpf": {
                    "required": true,
                    "type": "integer",
                    "minimum": 0,
                    "maximum": 2
                }
            }
        },
        "novavalidade": {
            "required": false,
            "type": "object",
            "properties": {
                "inivalid": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                },
                "fimvalid": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])$"
                }            
            }
        }
    }
}';

//file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);

//campos OBRIGATORIOS
$std             = new \stdClass();
$std->sequencial = 1; //numero sequencial
$std->modo       = 'INC'; //INC inclusão, ALT alteração EXC exclusão

$std->ideperiodo           = new \stdClass();
$std->ideperiodo->inivalid = '2017-01'; //aaaa-mm do inicio da validade
//$std->ideperiodo->fimvalid = '2017-07'; //yyyy-mm do fim da validade

//campo OPCIONAL
//usar em Inclusão ou alteração apenas
$std->infocadastro                   = new \stdClass();
$std->infocadastro->nmrazao          = 'Fake Ind. e Com. Ltda'; //Razão Social
$std->infocadastro->classtrib        = '01'; // classificação tributária do contribuinte, conforme tabela 8
$std->infocadastro->natjurid         = '2062'; //código da Natureza Jurídica do Contribuinte, conforme tabela 21
$std->infocadastro->indcoop          = 0;//Indicativo de Cooperativa: 0 - Não é cooperativa; 1 - Cooperativa de Trabalho; 2 - Cooperativa de Produção; 3 - Outras Cooperativas.
$std->infocadastro->indconstr        = 0;//Indicativo de Construtora: 0 - Não é Construtora; 1 - Empresa Construtora.
$std->infocadastro->inddesfolha      = 0; //Indicativo de Desoneração da Folha: 0 - Não Aplicável; 1 - Empresa enquadrada nos art. 7º a 9º da Lei 12.546/2011.
$std->infocadastro->indoptregeletron = 0; //registro eletrônico de empregados: 0 - Não optou pelo registro eletrônico de empregados; 1 - Optou pelo registro eletrônico de empregados

//não existe na versão 2.2.2
//$std->infocadastro->indented         = 'N';//realiza a contratação de aprendiz por entidade N - Não é entidade educativa sem fins lucrativos; S - É entidade educativa sem fins lucrativos

$std->infocadastro->indett           = 'N';//Indicativo de Empresa de Trabalho Temporário N - Não é Empresa de Trabalho Temporário; S - Empresa de Trabalho Temporário.
$std->infocadastro->nrregett         = null;//Número do registro da Empresa de Trabalho Temporário

//campo OPCIONAL
//Informações Complementares - Empresas Isentas - Dados da Isenção
//usar esses campos somente de declarar infocadastro
//$std->dadosisencao = new \stdClass();
//$std->dadosisencao->ideminlei = 'seila';//Sigla e nome do Ministério ou Lei que concedeu o Certificado
//$std->dadosisencao->nrcertif = '987654321';//Número do Certificado de Entidade Beneficente de Assistência Social, número da portaria de concessão do Certificado, ou, no caso de concessão através de Lei específica, o número da Lei.
//$std->dadosisencao->dtemiscertif = '2016-11-04';//Data de Emissão do Certificado/publicação da Lei
//$std->dadosisencao->dtvenccertif = '2018-11-03';//Data de Vencimento do Certificado 
//$std->dadosisencao->nrprotrenov = null;//Protocolo pedido renovação
//$std->dadosisencao->dtprotrenov = null;//Data do protocolo de renovação
//$std->dadosisencao->dtdou = null;//Preencher com a data de publicação no Diário Oficial da União
//$std->dadosisencao->pagdou = null;// número da página no DOU referente à publicação do documento de concessão do certificado.

//campo OPCIONAL / OBRIGATORIO somente de declarar infocadastro
//Informações de contato
$std->contato           = new \stdClass();
$std->contato->nmctt    = 'Fulano de Tal';// Pessoa responsável por ser o contato do empregador com os órgãos gestores do eSocial
$std->contato->cpfctt   = '99999999999';//CPF do contato
$std->contato->fonefixo = '1155555555';//número do telefone, com DDD
$std->contato->fonecel  = '11944444444';//celular, com DDD
$std->contato->email    = 'fulano@mail.com';//Endereço eletrônico

//campo OPCIONAL
//Informações relativas a Órgãos Públicos
//$std->infoop = new \stdClass();
//$std->infoop->nrsiafi = '12345'; //número SIAFI

//campo OPCIONAL
//Informações relativas a Ente Federativo Responsável - EFR
//$std->infoefr = new \stdClass();
//$std->infoefr->ideefr = 'S';//S - É EFR; N - Não é EFR.S
//$std->infoefr->cnpjefr = '12345678901234';//CNPJ do Ente Federativo Responsável - EFR

//campo OPCIONAL
//Informações relativas ao ente federativo estadual, distrital ou municipal
//$std->infoente = new \stdClass();
//$std->infoente->nmente = 'Ente seila';//Nome do Ente Federativo ao qual o órgão está vinculado
//$std->infoente->uf = 'PR';//sigla da Unidade da Federação
//$std->infoente->codmunic = '358854';// código do município
//$std->infoente->indrpps = 'N';//Regime Próprio de Previdência Social - RPPS. S - Sim; N - Não.
//$std->infoente->subteto = 9;//1 - Executivo; 2 - Judiciário; 3 - Legislativo; 9 - Todos os poderes.
//$std->infoente->vrsubteto = 10584.50;//valor do subteto do Ente Federativo

//campo OPCIONAL
//Informações exclusivas de organismos internacionais e outras instituições extraterritoriais
//$std->infoorginternacional = new \stdClass();
//$std->infoorginternacional->indacordoisenmulta = 0; //Indicativo da existência de acordo internacional para isenção de multa: 0 - Sem acordo; 1 - Com acordo.

//campo OPCIONAL
//Informações relativas ao desenvolvedor do software que gerou o arquivo xml.
//Array com até 99 ocorrências
$std->softwarehouse[0]                = new \stdClass();
$std->softwarehouse[0]->cnpjsofthouse = '00000000000000';//CNPJ da empresa desenvolvedora do software
$std->softwarehouse[0]->nmrazao       = 'Soft dot Com Ltd';//Informar a razão social, no caso de pessoa jurídica ou órgão público.
$std->softwarehouse[0]->nmcont        = 'Fulano da Tal';//Nome do contato na empresa
$std->softwarehouse[0]->telefone      = "1157777777";
$std->softwarehouse[0]->email         = "fulano@mail.com";

//campo OPCIONAL
//Informações Complementares - Pessoa Jurídica
//Se houver PJ não pode haver PF
$std->situacaopj           = new \stdClass();
$std->situacaopj->indsitpj = 0;//0 - Situação Normal; 1 - Extinção; 2 - Fusão; 3 - Cisão; 4 - Incorporação.

//campo OPCIONAL
//Informações Complementares - Pessoa Física
//Se houver PF não pode haver PJ
//$std->situacaopf = new \stdClass();
//$std->situacaopf->indsitpf = 0;//0 - Situação Normal; 1 - Encerramento de espólio; 2 - Saída do país em caráter permanente.

//campo OPCIONAL
//Informação preenchida exclusivamente em caso de alteração do período de validade das informações do registro identificado no evento, apresentando o novo período de validade.
//usar somente em caso de alteração
//$std->novavalidade = new \stdClass();
//$std->novavalidade->inivalid = '2017-06';//mês e ano de início da validade das informações prestadas no evento,
//$std->novavalidade->fimvalid = null;//mês e ano de término da validade das informações, se houve

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
