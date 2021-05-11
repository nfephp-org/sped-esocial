<?php
error_reporting(E_ALL);
ini_set('display_errors|On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

//S-2300
//Campo {cpfDep} – alterada validação da alínea a).
//Campo {racaCor} – alterada descrição dos valores [2, 3, 4].
//Campo {dtChegada} – alterada ocorrência e inserida validação.
//Grupos {cargoFuncao} – alterada condição.
//Grupos {remuneracao} – alterada condição.

$evento  = 'evtTSVInicio';
$version = '02_05_00';

$jsonSchema = '{
    "title": "evtTSVInicio",
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
            "maxLength": 11
        },
        "nmtrab": {
            "required": true,
            "type": "string",
            "minLength": 3,
            "maxLength": 70
        },
        "sexo": {
            "required": true,
            "type": "string",
            "pattern": "^(F|M)$"
        },
        "racacor": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 6
        },
        "estciv": {
            "required": true,
            "type": "integer",
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
            "minLength": 3,
            "maxLength": 70
        },
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
            "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
        },
        "paisnascto": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{3}$"
        },
        "paisnac": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{3}$"
        },
        "nmmae": {
            "required": false,
            "type": ["string","null"],
            "minLength": 3,
            "maxLength": 70
        },
        "nmpai": {
            "required": false,
            "type": ["string","null"],
            "minLength": 3,
            "maxLength": 70
        },
        "ctps": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nrctps": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 11
                },
                "seriectps": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 5
                },
                "ufctps": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
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
                    "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
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
                    "pattern": "^(A|B|C|D|E|AB|AC|AD|AE)$"
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
                    "minLength": 3,
                    "maxLength": 30
                },
                "bairro": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 3,
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
                    "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
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
                    "pattern": "^[0-9]{3}$"
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
                    "minLength": 3,
                    "maxLength": 30
                },
                "bairro": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 3,
                    "maxLength": 60
                },
                "nmcid": {
                    "required": true,
                    "type": "string",
                    "minLength": 3,
                    "maxLength": 50
                },
                "codpostal": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
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
                    "pattern": "^(S|N)$"
                },
                "filhosbr": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
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
                    "pattern": "^(S|N)$"
                },
                "defvisual": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defauditiva": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defmental": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "defintelectual": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "reabreadap": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 3,
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
                        "pattern": "^[0-9]{2}$"
                    },
                    "nmdep": {
                        "required": true,
                        "type": "string",
                        "minLength": 3,
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
                        "pattern": "^[0-9]{11}$"
                    },
                    "depirrf": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    },
                    "depsf": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    },
                    "inctrab": {
                        "required": true,
                        "type": "string",
                        "pattern": "^(S|N)$"
                    }
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
                    "pattern": "^[0-9]{10,13}$"
                },
                "fonealternat": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{10,13}$"
                },
                "emailprinc": {
                    "required": false,
                    "type": ["string","null"],
                    "format": "email"
                },
                "emailalternat": {
                    "required": false,
                    "type": ["string","null"],
                    "format": "email"
                }
            }
        },
        "infotsvinicio": {
            "required": true,
            "type": "object",
            "properties": {
                "cadini": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(S|N)$"
                },
                "codcateg": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{3}$"
                },
                "dtinicio": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "natatividade": {
                    "required": false,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                }
            }
        },
        "cargofuncao": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "codcargo": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 30
                },
                "codfuncao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 30
                }
            }
        },
        "remuneracao": {
            "required": false,
            "type": ["object","null"],
            "properties": {
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
                }
            }
        },
        "fgts": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "opcfgts": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "dtopcfgts": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                }
            }
        },
        "infodirigentesindical": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "categorig": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{3}$"
                },
                "cnpjorigem": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{14}$"
                },
                "dtadmorig": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "matricorig": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 30
                }
            }
        },
        "infotrabcedido": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "categorig": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{3}$"
                },
                "cnpjcednt": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{14}$"
                },
                "matricced": {
                    "required": true,
                    "type": "string",
                    "minLength": 1,
                    "maxLength": 30
                },
                "dtadmced": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "tpregtrab": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 2
                },
                "tpregprev": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                },
                "infonus": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                }
            }
        },
        "infoestagiario": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "natestagio": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(O|N)$"
                },
                "nivestagio": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 9
                },
                "areaatuacao": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 3,
                    "maxLength": 50
                },
                "nrapol": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 30
                },
                "vlrbolsa": {
                    "required": false,
                    "type": ["number","null"]
                },
                "dtprevterm": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "instensino": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "cnpjinstensino": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{14}$"
                        },
                        "nmrazao": {
                            "required": true,
                            "type": "string",
                            "minLength": 3,
                            "maxLength": 100
                        },
                        "dsclograd": {
                            "required": false,
                            "type": ["string","null"],
                            "minLength": 1,
                            "maxLength": 80
                        },
                        "nrlograd": {
                            "required": false,
                            "type": ["string","null"],
                            "minLength": 1,
                            "maxLength": 10
                        },
                        "bairro": {
                            "required": false,
                            "type": ["string","null"],
                            "minLength": 1,
                            "maxLength": 60
                        },
                        "cep": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{8}$"
                        },
                        "codmunic": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{7}"
                        },
                        "uf": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
                        }
                    }
                },
                "ageintegracao": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "cnpjagntinteg": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{14}$"
                        },
                        "nmrazao": {
                            "required": true,
                            "type": "string",
                            "minLength": 3,
                            "maxLength": 100
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
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^[0-9]{7}$"
                        },
                        "uf": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$"
                        }
                    }
                },
                "supervisorestagio": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "cpfsupervisor": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{11}$"
                        },
                        "nmsuperv": {
                            "required": true,
                            "type": "string",
                            "minLength": 3,
                            "maxLength": 70
                        }
                    }
                }
            }
        },
        "mudancacpf": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "cpfant": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{11}$"
                },
                "dtaltcpf": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "observacao": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 255
                }
            }
        },
        "afastamento": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtiniafast": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                },
                "codmotafast": {
                    "required": true,
                    "type": "string",
                    "pattern": "^[0-9]{2}"
                }
            }
        },
        "termino": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "dtterm": {
                    "required": true,
                    "type": "string",
                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
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
$std->nistrab = '1234';
$std->nmtrab = 'Fulano de Tal';
$std->sexo = 'M';
$std->racacor = 2;
$std->estciv = 3;
$std->grauinstr = '03';
$std->nmsoc = 'Fulano de Tal';
$std->dtnascto = '1996-06-11';
$std->codmunic = '1234567';
$std->uf = 'AC';
$std->paisnascto = '105';
$std->paisnac = '105';
$std->nmmae = 'Maria de Tal';
$std->nmpai = "Joao de Tal";
//documentos
$std->ctps = new \stdClass();
$std->ctps->nrctps = '11215454';
$std->ctps->seriectps = '011';
$std->ctps->ufctps = 'AC';

$std->ric = new \stdClass();
$std->ric->nrric = '28282828';
$std->ric->orgaoemissor = 'sslkjslkjslksj';
$std->ric->dtexped = '2011-07-07';

$std->rg = new \stdClass();
$std->rg->nrrg = '1234567';
$std->rg->orgaoemissor = 'sslkslkslks';
$std->rg->dtexped = '2011-06-06';

$std->rne = new \stdClass();
$std->rne->nrrne = '8829822982982';
$std->rne->orgaoemissor = 'slkslsklsklsk';
$std->rne->dtexped = '2011-08-08';

$std->oc = new \stdClass();
$std->oc->nroc = '1929282882828';
$std->oc->orgaoemissor = 'lslslsls';
$std->oc->dtexped = '2011-10-10';
$std->oc->dtvalid = '2022-10-10';

$std->cnh = new \stdClass();
$std->cnh->nrregcnh = '123456789012';
$std->cnh->dtexped = '2017-05-05';
$std->cnh->ufcnh = 'AC';
$std->cnh->dtvalid = '2022-05-05';
$std->cnh->dtprihab = '2011-01-01';
$std->cnh->categoriacnh = 'AB';

//endereço
$std->brasil = new \stdClass();
$std->brasil->tplograd = 'av';
$std->brasil->dsclograd = 'slkslkslkslsk';
$std->brasil->nrlograd = 'sksks';
$std->brasil->complemento = 'owpososomsmm';
$std->brasil->bairro = 'sksksksk';
$std->brasil->cep = '12345678';
$std->brasil->codmunic = '1234567';
$std->brasil->uf = 'AC';

$std->exterior = new \stdClass();
$std->exterior->paisresid = '158';
$std->exterior->dsclograd = 'kkssjksjsk';
$std->exterior->nrlograd = '1112sss';
$std->exterior->complemento = 'lslslsls';
$std->exterior->bairro = 'lslslsl';
$std->exterior->nmcid = 'slkskslks';
$std->exterior->codpostal = '1234';

$std->trabestrangeiro = new \stdClass();
$std->trabestrangeiro->dtchegada = '2015-11-11';
$std->trabestrangeiro->classtrabestrang = 12;
$std->trabestrangeiro->casadobr = 'N';
$std->trabestrangeiro->filhosbr = 'N';

$std->infodeficiencia = new \stdClass();
$std->infodeficiencia->deffisica = 'N';
$std->infodeficiencia->defvisual = 'N';
$std->infodeficiencia->defauditiva = 'N';
$std->infodeficiencia->defmental = 'N';
$std->infodeficiencia->defintelectual = 'N';
$std->infodeficiencia->reabreadap = 'N';
$std->infodeficiencia->observacao = 'lkslkslkslkslkslks';

$std->dependente[1]  = new \stdClass();
$std->dependente[1]->tpdep = '01';
$std->dependente[1]->nmdep = 'Fulaninho de Tal';
$std->dependente[1]->dtnascto = '2016-11-25';
$std->dependente[1]->cpfdep = '12345678901';
$std->dependente[1]->depirrf = 'N';
$std->dependente[1]->depsf = 'N';
$std->dependente[1]->inctrab = 'N';

$std->contato = new \stdClass();
$std->contato->foneprinc = '1234567890';
$std->contato->fonealternat = '0912345678';
$std->contato->emailprinc = 'ele@mail.com';
$std->contato->emailalternat = 'ela@email.com.br';

$std->infotsvinicio = new \stdClass();
$std->infotsvinicio->cadini = 'S';
$std->infotsvinicio->codcateg = '101';
$std->infotsvinicio->dtinicio = '2017-05-12';
$std->infotsvinicio->natatividade = 2;

$std->cargofuncao = new \stdClass();
$std->cargofuncao->codcargo = 'oaoaoa';
$std->cargofuncao->codfuncao = 'ksksksksk sk';

$std->remuneracao = new \stdClass();
$std->remuneracao->vrsalfx = 1200.00;
$std->remuneracao->undsalfixo = 7;
$std->remuneracao->dscsalvar = 'lkklslskksl s lks lsklsks ';

$std->fgts = new \stdClass();
$std->fgts->opcfgts = 1;
$std->fgts->dtopcfgts = '2017-05-12';

$std->infodirigentesindical = new \stdClass();
$std->infodirigentesindical->categorig = '001';
$std->infodirigentesindical->cnpjorigem = '12345678901234';
$std->infodirigentesindical->dtadmorig = '2017-05-12';
$std->infodirigentesindical->matricorig = 'ytuytuystyst';

$std->infotrabcedido = new \stdClass();
$std->infotrabcedido->categorig = '001';
$std->infotrabcedido->cnpjcednt = '12345678901234';
$std->infotrabcedido->matricced = 'lksçkçslksl';
$std->infotrabcedido->dtadmced = '2017-05-12';
$std->infotrabcedido->tpregtrab = 2;
$std->infotrabcedido->tpregprev = 3;
$std->infotrabcedido->infonus = 3;

$std->infoestagiario = new \stdClass();
$std->infoestagiario->natestagio = 'N';
$std->infoestagiario->nivestagio = 8;
$std->infoestagiario->areaatuacao = 'ksksksksk';
$std->infoestagiario->nrapol = 'kak228282828';
$std->infoestagiario->vlrbolsa = 1200.00;
$std->infoestagiario->dtprevterm = '2017-12-31';

$std->infoestagiario->instensino = new \stdClass();
$std->infoestagiario->instensino->cnpjinstensino = '12345678901234';
$std->infoestagiario->instensino->nmrazao = 'dlkdldkldkd';
$std->infoestagiario->instensino->dsclograd = 'lslsppopapap';
$std->infoestagiario->instensino->nrlograd = '12244';
$std->infoestagiario->instensino->bairro = 'kakakaka';
$std->infoestagiario->instensino->cep = '12345678';
$std->infoestagiario->instensino->codmunic = '1234567';
$std->infoestagiario->instensino->uf = 'AC';

$std->infoestagiario->ageintegracao = new \stdClass();
$std->infoestagiario->ageintegracao->cnpjagntinteg = '12345678901234';
$std->infoestagiario->ageintegracao->nmrazao = 'mamaamamamam';
$std->infoestagiario->ageintegracao->dsclograd = 'oaoaoaoao';
$std->infoestagiario->ageintegracao->nrlograd = 'msmsmsmsms';
$std->infoestagiario->ageintegracao->bairro = 'lslslslsl';
$std->infoestagiario->ageintegracao->cep = '12345678';
$std->infoestagiario->ageintegracao->codmunic = '1234567';
$std->infoestagiario->ageintegracao->uf = 'AC';

$std->infoestagiario->supervisorestagio = new \stdClass();
$std->infoestagiario->supervisorestagio->cpfsupervisor = '12345678901';
$std->infoestagiario->supervisorestagio->nmsuperv = 'lksklskslkslkslk slkslkslkskslk';

$std->mudancacpf = new \stdClass();
$std->mudancacpf->cpfant = '12345678901';
$std->mudancacpf->dtaltcpf = '2018-11-10';
$std->mudancacpf->observacao = 'bla bla bla';

$std->afastamento = new \stdClass();
$std->afastamento->dtiniafast = '2017-06-01';
$std->afastamento->codmotafast = '01';

$std->termino = new \stdClass();
$std->termino->dtterm = '2017-12-31';

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
