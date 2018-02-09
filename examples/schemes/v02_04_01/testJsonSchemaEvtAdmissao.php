<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtAdmissao';
$version = '02_04_01';

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
        "nrrecibo": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 40
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}"
        },
        "nistrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}"
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
            "minLength": 2,
            "maxLength": 2,
            "pattern": "01|02|03|04|05|06|07|08|09|10|11|12"
        },
        "indpriempr": {
            "required": true,
            "type": "string",
            "pattern": "S|N"
        },
        "nmsoc": {
            "required": false,
            "type": ["string","null"],
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
            "maxLength": 7
        },
        "uf": {
            "required": false,
            "type": ["string","null"],
            "maxLength": 2
        },
        "paisnascto": {
            "required": true,
            "type": "string",
            "minLength": 3,
            "maxLength": 3,
            "pattern": "^[0-9]{3}"
        },
        "paisnac": {
            "required": true,
            "type": "string",
            "minLength": 3,
            "maxLength": 3,
            "pattern": "^[0-9]{3}"
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
        },
        "ctps": {
            "required": false,
            "type": ["object","null"],
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
            "type": ["object","null"],
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
                    "maxLength": 14,
                    "pattern": "^[0-9]"
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
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
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
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
                    "maxLength": 14
                },
                "orgaoemissor": {
                    "required": true,
                    "type": "string",
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
                    "type": ["object","null"],
                    "properties": {
                        "paisresid": {
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
        "deficiencia": {
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
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "observacao": {
                    "required": false,
                    "type": "string",
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
                        "maxLength": 2
                    },
                    "nmdep": {
                        "required": true,
                        "type": "string",
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
                        "maxLength": 11,
                        "minLength": 11
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
                    "maxLength": 13
                },
                "fonealternat": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 13
                },
                "emailprinc": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 60
                },
                "emailalternat": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 60
                }
            }
        },
        "vinculo": {
            "required": true,
            "type": "object",
            "properties": {
                "matricula": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 30
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
                "nrrecinfprelim": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 40
                },
                "cadini": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "infoceletista": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "dtadm": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "tpadmissao": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 5
                        },
                        "indadmissao": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 3
                        },
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
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 12
                        },
                        "cnpjsindcategprof": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{14}"
                        },
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
                        },
                        "trabtemporario": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "hipleg": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 2
                                },
                                "justcontr": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 999
                                },
                                "tpinclcontr": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 3
                                },
                                "idetomadorserv": {
                                    "required": true,
                                    "type": "object",
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
                                            "pattern": "^[0-9]{11,14}"
                                        },
                                        "ideestabvinc": {
                                            "required": false,
                                            "type": "object",
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
                                                    "pattern": "^[0-9]{11,14}"
                                                }
                                            }
                                        }
                                    }
                                },
                                "idetrabsubstituido": {
                                    "required": false,
                                    "type": ["array","null"],
                                    "minItems": 0,
                                    "maxItems": 9,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "cpftrabsubst": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^[0-9]{11}"
                                            }
                                        }
                                    }
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
                                    "pattern": "^[0-9]{11,14}"
                                }
                            }
                        }
                    }    
                },
                "infoestatutario": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "indprovim": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 2
                        },
                        "tpprov": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 99
                        },
                        "dtnomeacao": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "dtposse": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "dtexercicio": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "tpplanrp": {
                            "required": false,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 2
                        },
                        "infodecjud": {
                            "required": false,
                            "type": ["object","null"],
                            "properties": {
                                "nrprocjud": {
                                    "required": false,
                                    "type": "string",
                                    "maxLength": 20
                                }
                            }
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
                              "maxLength": 30
                        },
                        "codfuncao": {
                              "required": false,
                              "type": ["string","null"],
                              "maxLength": 30
                        },
                        "codcateg": {
                              "required": true,
                              "type": "integer",
                              "minimum": 101,
                              "maximum": 905
                        },
                        "codcarreira": {
                              "required": false,
                              "type": ["string","null"],
                              "maxLength": 30
                        },
                        "dtingrcarr": {
                            "required": false,
                            "type": "string",
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
                            "maxLength": 90
                        },
                        "tpcontr": {
                            "required": true,
                            "type": "integer",
                            "minimum": 1,
                            "maximum": 2
                        },
                        "dtterm": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "clauasseg": {
                            "required": false,
                            "type": ["string","null"],
                            "pattern": "S|N"
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
                                    "pattern": "^[0-9]{11,14}"
                                },
                                "desccomp": {
                                      "required": false,
                                      "type": ["string","null"],
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
                                    "pattern": "^[0-9]{8}"
                                },
                                "codmunic": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{7}"
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
                                    "minimum": 0.1
                                },
                                "tpjornada": {
                                    "required": true,
                                    "type": "integer",
                                    "minimum": 1,
                                    "maximum": 9
                                },
                                "dsctpjorn": {
                                      "required": false,
                                      "type": "string",
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
                            "maxItems": 1,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "cnpjsindtrab": {
                                        "required": true,
                                        "type": "string",
                                        "pattern": "^[0-9]{14}"
                                    }
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
                                    "maxLength": 20
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
                        }
                    }    
                },
                "sucessaovinc": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "cnpjempregant": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{14}"
                        },
                        "matricant": {
                              "required": false,
                              "type": ["string","null"],
                              "maxLength": 30
                        },
                        "dttransf": {
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
                "transfdom": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "cpfsubstituido": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{11}"
                        },
                        "matricant": {
                              "required": false,
                              "type": ["string","null"],
                              "maxLength": 30
                        },
                        "dttransf": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
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
                "desligamento": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "dtdeslig": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
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
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab = '11111111111';
$std->nistrab = '11111111111';
$std->nmtrab = 'JOSE DA SILVA';
$std->sexo = 'M';
$std->racacor = 5;
$std->estciv = 1;
$std->grauinstr = '07';
$std->indpriempr = 'N';
$std->nmsoc = 'Chiquinho';
$std->dtnascto = '1980-01-01';
$std->codmunic = '1234567';
$std->uf = 'AC';
$std->paisnascto = '105'; // 105 = Brasil
$std->paisnac = '105';
$std->nmmae = 'Fulana de Tal';
$std->nmpai = 'Ciclano de Tal';

$std->ctps = new \stdClass();
$std->ctps->nrctps = '12012315';
$std->ctps->seriectps = '500';
$std->ctps->ufctps = 'SP';

$std->ric = new \stdClass();
$std->ric->nrric = '15150505';
$std->ric->orgaoemissor = 'SSP';
$std->ric->dtexped = '2015-01-01';

$std->rg = new \stdClass();
$std->rg->nrrg = '11111111';
$std->rg->orgaoemissor = 'SSP';
$std->rg->dtexped = '2015-01-01';

$std->oc = new \stdClass();
$std->oc->nroc = '12315861';
$std->oc->orgaoemissor = 'SSP';
$std->oc->dtexped = '2015-01-01';

$std->cnh = new \stdClass();
$std->cnh->nrregcnh = '1231531';
$std->cnh->dtexped = '2015-01-01';
$std->cnh->ufcnh = 'SP';
$std->cnh->dtvalid = '2019-01-01';
$std->cnh->dtprihab = '2015-01-01';
$std->cnh->categoriacnh = 'AB';

$std->endereco = new \stdClass();
$std->endereco->brasil = new \stdClass();
$std->endereco->brasil->tplograd = 'R';
$std->endereco->brasil->dsclograd = 'Av. Paulista';
$std->endereco->brasil->nrlograd = '1850';
$std->endereco->brasil->bairro = 'Bela Vista';
$std->endereco->brasil->cep = '01311200';
$std->endereco->brasil->codmunic  = 3550308;
$std->endereco->brasil->uf = 'SP';

$std->endereco->exterior = new \stdClass();
$std->endereco->exterior->paisresid = '108';
$std->endereco->exterior->dsclograd = '5 Av';
$std->endereco->exterior->nrlograd = '2222';
$std->endereco->exterior->complemento = 'Apto 200';
$std->endereco->exterior->bairro = 'Manhattan';
$std->endereco->exterior->nmcid = 'New York';
$std->endereco->exterior->codpostal  = '111111';

$std->trabestrangeiro = new \stdClass();
$std->trabestrangeiro->dtchegada = '2001-10-10';
$std->trabestrangeiro->classtrabestrang = 10;
$std->trabestrangeiro->casadobr = 'S';
$std->trabestrangeiro->filhosbr = 'S';

$std->infodeficiencia = new \stdClass();
$std->infodeficiencia->deffisica = 'N';
$std->infodeficiencia->defvisual = 'N';
$std->infodeficiencia->defauditiva = 'N';
$std->infodeficiencia->defmental = 'N';
$std->infodeficiencia->defintelectual = 'N';
$std->infodeficiencia->reabreadap = 'N';
$std->infodeficiencia->infocota = 'N';
$std->infodeficiencia->observacao = 'slsklskslkslkslkssklsklsjksjskjs';

$std->dependente[0] = new \stdClass();
$std->dependente[0]->tpdep = '01';
$std->dependente[0]->nmdep = 'WATSON';
$std->dependente[0]->dtnascto = '2015-01-01';
$std->dependente[0]->cpfdep = '12345678985';
$std->dependente[0]->depirrf = 'N';
$std->dependente[0]->depsf = 'N';
$std->dependente[0]->inctrab = 'N';

$std->aposentadoria = new \stdClass();
$std->aposentadoria->trabaposent = 'N';

$std->contato = new \stdClass();
$std->contato->foneprinc = '1155555555';
$std->contato->fonealternat = '11999999999';
$std->contato->emailprinc = 'beltrano@mail.com.br';
$std->contato->emailalternat = 'ciclano@mail.com.br';

$std->vinculo = new \stdClass();
$std->vinculo->matricula = '1020304050';
$std->vinculo->tpregtrab = 1;
$std->vinculo->tpregprev = 1;
$std->vinculo->nrrecinfprelim = '12345678901234556';
$std->vinculo->cadini = 'N';

$std->vinculo->infoceletista = new \stdClass();
$std->vinculo->infoceletista->dtadm = '2017-08-08';
$std->vinculo->infoceletista->tpadmissao = 1;
$std->vinculo->infoceletista->indadmissao = 1;
$std->vinculo->infoceletista->tpregjor = 1;
$std->vinculo->infoceletista->natatividade = 1;
$std->vinculo->infoceletista->cnpjsindcategprof = '77721644000101';
$std->vinculo->infoceletista->opcfgts = 1;
$std->vinculo->infoceletista->dtopcfgts = '2017-01-01';

$std->vinculo->infoceletista->trabtemporario = new \stdClass();
$std->vinculo->infoceletista->trabtemporario->hipleg = 1;
$std->vinculo->infoceletista->trabtemporario->justcontr = 'jwkjwkjwkjwk';
$std->vinculo->infoceletista->trabtemporario->tpinclcontr = 3;

$std->vinculo->infoceletista->trabtemporario->idetomadorserv = new \stdClass();
$std->vinculo->infoceletista->trabtemporario->idetomadorserv->tpinsc = 2;
$std->vinculo->infoceletista->trabtemporario->idetomadorserv->nrinsc = '12345678901234';

$std->vinculo->infoceletista->trabtemporario->idetomadorserv->ideestabvinc = new \stdClass();
$std->vinculo->infoceletista->trabtemporario->idetomadorserv->ideestabvinc->tpinsc = 2;
$std->vinculo->infoceletista->trabtemporario->idetomadorserv->ideestabvinc->nrinsc = '12345678901234';

$std->vinculo->infoceletista->trabtemporario->idetrabsubstituido[0] = new \stdClass();
$std->vinculo->infoceletista->trabtemporario->idetrabsubstituido[0]->cpftrabsubst = '12345678901';

$std->vinculo->infoceletista->aprend = new \stdClass();
$std->vinculo->infoceletista->aprend->tpinsc = 1;
$std->vinculo->infoceletista->aprend->nrinsc = '12345678901';

$std->vinculo->infoestatutario = new \stdClass();
$std->vinculo->infoestatutario->indprovim = 1;
$std->vinculo->infoestatutario->tpprov = 99;
$std->vinculo->infoestatutario->dtnomeacao = '2017-01-01';
$std->vinculo->infoestatutario->dtposse = '2017-02-01';
$std->vinculo->infoestatutario->dtexercicio = '2017-02-01';
$std->vinculo->infoestatutario->tpplanrp = 2;

$std->vinculo->infoestatutario->infodecjud = new \stdClass();
$std->vinculo->infoestatutario->infodecjud->nrprocjud = 'kjsksjksj2222';

$std->vinculo->infocontrato = new \stdClass();
$std->vinculo->infocontrato->codcargo = 'wwww';
$std->vinculo->infocontrato->codfuncao = 'wwww';
$std->vinculo->infocontrato->codcateg = 101;
$std->vinculo->infocontrato->codcarreira = 'wwww';
$std->vinculo->infocontrato->dtingrcarr = '2017-01-01';
$std->vinculo->infocontrato->vrsalfx = 2547.56;
$std->vinculo->infocontrato->undsalfixo = 7;
$std->vinculo->infocontrato->dscsalvar = 'ksksksksk';
$std->vinculo->infocontrato->tpcontr = 1;
$std->vinculo->infocontrato->dtterm = '2018-01-01';
$std->vinculo->infocontrato->clauassec = 'N';

$std->vinculo->infocontrato->localtrabgeral = new \stdClass();
$std->vinculo->infocontrato->localtrabgeral->tpinsc = 2;
$std->vinculo->infocontrato->localtrabgeral->nrinsc = '12345678901234';
$std->vinculo->infocontrato->localtrabgeral->desccomp = 'lkdldkldkldk';

$std->vinculo->infocontrato->localtrabdom = new \stdClass();
$std->vinculo->infocontrato->localtrabdom->tplograd = 'AV';
$std->vinculo->infocontrato->localtrabdom->dsclograd = 'sm,sm,sms,ms,ms';
$std->vinculo->infocontrato->localtrabdom->nrlograd = '27272';
$std->vinculo->infocontrato->localtrabdom->complemento = 'sjsksjhsh';
$std->vinculo->infocontrato->localtrabdom->bairro = 'sjhsj';
$std->vinculo->infocontrato->localtrabdom->cep = '99999999';
$std->vinculo->infocontrato->localtrabdom->codmunic = '1234567';
$std->vinculo->infocontrato->localtrabdom->uf = 'AC';

$std->vinculo->infocontrato->horcontratual = new \stdClass();
$std->vinculo->infocontrato->horcontratual->qtdhrssem = 123.50;
$std->vinculo->infocontrato->horcontratual->tpjornada = 9;
$std->vinculo->infocontrato->horcontratual->dsctpjorn = 'kjsksjsjs';
$std->vinculo->infocontrato->horcontratual->tmpparc = 0;

$std->vinculo->infocontrato->horcontratual->horario[0] = new \stdClass();
$std->vinculo->infocontrato->horcontratual->horario[0]->dia = 1;
$std->vinculo->infocontrato->horcontratual->horario[0]->codhorcontrat = 'sssss';

$std->vinculo->infocontrato->filiacaosindical[0] = new \stdClass();
$std->vinculo->infocontrato->filiacaosindical[0]->cnpjsindtrab = '12345678901234';

$std->vinculo->infocontrato->alvarajudicial = new \stdClass();
$std->vinculo->infocontrato->alvarajudicial->nrprocjud = 'kjskjsksj';

$std->vinculo->infocontrato->observacoes[0] = new \stdClass();
$std->vinculo->infocontrato->observacoes[0]->observacao = 'kjskjsksksj';

$std->vinculo->sucessaovinc = new \stdClass();
$std->vinculo->sucessaovinc->cnpjempregant = '12345678901234';
$std->vinculo->sucessaovinc->matricant = 'sksksksk';
$std->vinculo->sucessaovinc->dttransf = '2017-01-01';
$std->vinculo->sucessaovinc->observacao = 'kjsksjksjksj';

$std->vinculo->transfdom = new \stdClass();
$std->vinculo->transfdom->cpfsubstituido = '12345678901';
$std->vinculo->transfdom->matricant = 'slslslsls';
$std->vinculo->transfdom->dttransf = '2017-01-01';

$std->vinculo->afastamento = new \stdClass();
$std->vinculo->afastamento->dtiniafast = '2017-05-01';
$std->vinculo->afastamento->codmotafast = '01';

$std->vinculo->desligamento = new \stdClass();
$std->vinculo->desligamento->dtdeslig = '2017-08-08';

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
file_put_contents("../../../jsonSchemes/v$version/$evento.schema", $jsonSchema);
