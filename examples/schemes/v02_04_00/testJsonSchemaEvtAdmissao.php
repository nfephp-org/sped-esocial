<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$evento  = 'evtAdmissao';
$version = '02_04_00';

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
                    "required": false,
                    "type": "string",
                    "maxLength": 255
                }
            }
        },
        "dependente": {
            "required": false,
            "type": "array",
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
                        "type": "string",
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
            "type": "object",
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
            "type": "object",
            "properties": {
                "foneprinc": {
                    "required": false,
                    "type": "string",
                    "maxLength": 13
                },
                "fonealternat": {
                    "required": false,
                    "type": "string",
                    "maxLength": 13
                },
                "emailprinc": {
                    "required": false,
                    "type": "string",
                    "maxLength": 60
                },
                "emailalternat": {
                    "required": false,
                    "type": "string",
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
                    "type": "string",
                    "maxLength": 30
                },
                "tpregtrab": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "([1-2]){1}$"
                },
                "tpregprev": {
                    "required": true,
                    "type": "integer",
                    "maxLength": 1,
                    "pattern": "([1-3]){1}$"
                },
                "nrrecinfprelim": {
                    "required": false,
                    "type": "string",
                    "maxLength": 40
                },
                "cadini": {
                    "required": true,
                    "type": "string",
                    "pattern": "S|N"
                },
                "celetista": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "dtadm": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "tpadmissao": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 1,
                            "pattern": "([1-4]){1}$"
                        },
                        "indadmissao": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 1,
                            "pattern": "([1-3]){1}$"
                        },
                        "tpregjor": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 1,
                            "pattern": "([1-3]){1}$"
                        },
                        "natatividade": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 1,
                            "pattern": "([1-2]){1}$"
                        },
                        "dtbase": {
                            "required": false,
                            "type": "integer",
                            "minLength": 1,
                            "pattern": "([1-12]){1}$"
                        },
                        "cnpjsindcategprof": {
                            "required": true,
                            "type": "string",
                            "maxLength": 14
                        },
                        "opcfgts": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 1,
                            "pattern": "([1-2]){1}$"
                        },
                        "dtopcfgts": {
                            "required": false,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "trabtemporario": {
                            "required": false,
                            "type": "object",
                            "properties": {
                                "hipleg": {
                                    "required": true,
                                    "type": "integer",
                                    "maxLength": 1,
                                    "pattern": "([1-2]){1}$"
                                },
                                "justcontr": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 999
                                },
                                "tpinclcontr": {
                                    "required": true,
                                    "type": "integer",
                                    "maxLength": 1,
                                    "pattern": "([1-3]){1}$"
                                },
                                "tomador": {
                                    "required": true,
                                    "type": "object",
                                    "properties": {
                                        "tpinsc": {
                                            "required": true,
                                            "type": "integer",
                                            "maxLength": 1,
                                            "pattern": "([1-2]){1}$"
                                        },
                                        "nrinsc": {
                                            "required": true,
                                            "type": "string",
                                            "minLength": 8,
                                            "maxLength": 15,
                                            "pattern": "^[0-9]"
                                        }
                                    }
                                },
                                "estabvinc": {
                                    "required": false,
                                    "type": "object",
                                    "properties": {
                                        "tpinsc": {
                                            "required": true,
                                            "type": "integer",
                                            "maxLength": 1,
                                            "pattern": "([1-2]){1}$"
                                        },
                                        "nrinsc": {
                                            "required": true,
                                            "type": "string",
                                            "minLength": 8,
                                            "maxLength": 15,
                                            "pattern": "^[0-9]"
                                        }
                                    }
                                },
                                "substituido": {
                                    "required": false,
                                    "type": "array",
                                    "minItems": 0,
                                    "maxItems": 9,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "cpftrabsubst": {
                                                "required": true,
                                                "type": "string",
                                                "maxLength": 11,
                                                "minLength": 11
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        "aprendiz": {
                            "required": false,
                            "type": "object",
                            "properties": {
                                "tpinsc": {
                                    "required": true,
                                    "type": "integer",
                                    "maxLength": 1,
                                    "pattern": "([1-2]){1}$"
                                },
                                "nrinsc": {
                                    "required": true,
                                    "type": "string",
                                    "minLength": 8,
                                    "maxLength": 15,
                                    "pattern": "^[0-9]"
                                }
                            }
                        }
                    },
                    "estatutario": {
                        "required": false,
                        "type": "object",
                        "properties": {
                            "indprovim": {
                                "required": true,
                                "type": "integer",
                                "maxLength": 1,
                                "pattern": "([1-3]){1}$"
                            },
                            "tpprov": {
                                "required": true,
                                "type": "integer",
                                "minLength": 1,
                                "maxLength": 99
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
                                "maxLength": 1,
                                "pattern": "([1-2]){1}$"
                            },
                            "judicial": {
                                "required": false,
                                "type": "object",
                                "properties": {
                                    "nrprocjud": {
                                          "required": false,
                                          "type": "string",
                                          "maxLength": 20
                                    }
                                }
                            }
                        }
                    }
                },
                "contrato": {
                    "required": true,
                    "type": "object",
                    "properties": {
                        "codcargo": {
                              "required": false,
                              "type": "string",
                              "maxLength": 30
                        },
                        "codfuncao": {
                              "required": false,
                              "type": "string",
                              "maxLength": 30
                        },
                        "codcateg": {
                              "required": true,
                              "type": "integer",
                              "maxLength": 3
                        },
                        "codcarreira": {
                              "required": false,
                              "type": "string",
                              "maxLength": 30
                        },
                        "dtingrcarr": {
                            "required": false,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "vrsalfx": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 1
                        },
                        "undsalfixo": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 1,
                            "pattern": "([1-7]){1}$"
                        },
                        "dscsalvar": {
                            "required": false,
                            "type": "string",
                            "maxLength": 90
                        },
                        "tpcontr": {
                            "required": true,
                            "type": "integer",
                            "maxLength": 1,
                            "pattern": "([1-2]){1}$"
                        },
                        "dtterm": {
                            "required": false,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "clauasseg": {
                            "required": false,
                            "type": "string",
                            "pattern": "S|N"
                        },
                        "local": {
                            "required": false,
                            "type": "object",
                            "properties": {
                                "tpinsc": {
                                    "required": true,
                                    "type": "integer",
                                    "maxLength": 1,
                                    "pattern": "([1-2]){1}$"
                                },
                                "nrinsc": {
                                    "required": true,
                                    "type": "string",
                                    "minLength": 8,
                                    "maxLength": 15,
                                    "pattern": "^[0-9]"
                                },
                                "desccomp": {
                                      "required": false,
                                      "type": "string",
                                      "maxLength": 80
                                }
                            }
                        },
                        "domestico": {
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
                        "horcontratual": {
                            "required": false,
                            "type": "object",
                            "properties": {
                                "qtdhrssem": {
                                    "required": true,
                                    "type": "integer",
                                    "minLength": 1,
                                    "maxLength": 4
                                },
                                "tpjornada": {
                                    "required": true,
                                    "type": "integer",
                                    "maxLength": 1,
                                    "pattern": "(1|2|3|9){1}$"
                                },
                                "dsctpjorn": {
                                      "required": false,
                                      "type": "string",
                                      "maxLength": 100
                                },
                                "tmpparc": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "S|N"
                                },
                                "horario": {
                                    "required": false,
                                    "type": "array",
                                    "minItems": 0,
                                    "maxItems": 99,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "dia": {
                                                "required": true,
                                                "type": "integer",
                                                "maxLength": 2,
                                                "pattern": "([1-8]){1}$"
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
                            "type": "array",
                            "minItems": 0,
                            "maxItems": 1,
                            "items": {
                                "type": "object",
                                "properties": {
                                    "cnpjSindTrab": {
                                        "required": true,
                                        "type": "string",
                                        "maxLength": 14
                                    }
                                }
                            }
                        },
                        "judicial": {
                            "required": false,
                            "type": "object",
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
                "sucessao": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "cnpjempregant": {
                              "required": true,
                              "type": "string",
                              "maxLength": 14
                        },
                        "matricant": {
                              "required": false,
                              "type": "string",
                              "maxLength": 30
                        },
                        "dtinivinculo": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "observacao": {
                            "required": false,
                            "type": "string",
                            "maxLength": 255
                        }
                    }
                },
                "afastamento": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "dtiniafast": {
                            "required": true,
                            "type": "string",
                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                        },
                        "codmotafast": {
                             "required": true,
                             "type": "integer",
                             "maxLength": 1,
                             "pattern": "([1-2]){1}$"
                        }
                    }
                },
                "desligamento": {
                    "required": false,
                    "type": "object",
                    "properties": {
                        "dtDeslig": {
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

$std             = new \stdClass();
$std->sequencial = 1;
$std->indretif   = 1;

$trabalhador             = new \stdClass();
$trabalhador->cpftrab    = '11111111111';
$trabalhador->nistrab    = '11111111111';
$trabalhador->nmtrab     = 'JOSE DA SILVA';
$trabalhador->sexo       = 'M';
$trabalhador->racacor    = 5;
$trabalhador->grauinstr  = '07';
$trabalhador->indpriempr = 'N';
$trabalhador->dtnascto   = '1980-01-01';
$trabalhador->paisnascto = '105'; // 105 = Brasil
$trabalhador->paisnac    = '105';

$std->trabalhador = $trabalhador;

$endereco          = new \stdClass();
$brasil            = new \stdClass();
$brasil->tplograd  = 'R';
$brasil->dsclograd = 'Av. Paulista';
$brasil->nrlograd  = '1850';
$brasil->bairro    = 'Bela Vista';
$brasil->cep       = '01311200';
$brasil->codmunic  = 3550308;
$brasil->uf        = 'SP';

$endereco->brasil               = $brasil;
$std->endereco = $endereco;

$vinculo            = new \stdClass();
$vinculo->matricula = '1020304050';
$vinculo->tpregtrab = 1;
$vinculo->tpregprev = 1;
$vinculo->cadini    = 'N';

$celetista                    = new \stdClass();
$celetista->dtadm             = '2017-08-08';
$celetista->tpadmissao        = 1;
$celetista->indadmissao       = 1;
$celetista->tpregjor          = 1;
$celetista->natatividade      = 1;
$celetista->cnpjsindcategprof = '77721644000101';
$celetista->opcfgts           = 1;

$vinculo->celetista = $celetista;

$contrato             = new \stdClass();
$contrato->codcateg   = '101';
$contrato->vrsalfx    = 5000;
$contrato->undsalfixo = 5;
$contrato->tpcontr    = 1;

$vinculo->contrato = $contrato;

$std->vinculo = $vinculo;

$ctps            = new \stdClass();
$ctps->nrctps    = '12012315';
$ctps->seriectps = '500';
$ctps->ufctps    = 'SP';

$std->ctps = $ctps;

$ric               = new \stdClass();
$ric->nrric        = '15150505';
$ric->orgaoemissor = 'SSP';
$ric->dtexped      = '2015-01-01';

$std->ric = $ric;

$rg               = new \stdClass();
$rg->nrrg         = '11111111';
$rg->orgaoemissor = 'SSP';
$rg->dtexped      = '2015-01-01';

$std->rg = $rg;

$oc               = new \stdClass();
$oc->nroc         = '12315861';
$oc->orgaoemissor = 'SSP';
$oc->dtexped      = '2015-01-01';

$std->oc = $oc;

$cnh               = new \stdClass();
$cnh->nrregcnh     = '1231531';
$cnh->dtexped      = '2015-01-01';
$cnh->ufcnh        = 'SP';
$cnh->dtvalid      = '2019-01-01';
$cnh->dtprihab     = '2015-01-01';
$cnh->categoriacnh = 'AB';

$std->cnh = $cnh;

$dependente[0]           = new \stdClass();
$dependente[0]->tpdep    = '01';
$dependente[0]->nmdep    = 'WATSON';
$dependente[0]->dtnascto = '2015-01-01';
$dependente[0]->cpfdep   = '12345678985';
$dependente[0]->depirrf  = 'N';
$dependente[0]->depsf    = 'N';
$dependente[0]->inctrab  = 'N';

$std->dependente = $dependente;

$contato                = new \stdClass();
$contato->foneprinc     = '1144443333';
$contato->fonealternat  = '1122228888';
$contato->emailprinc    = 'email@email.com.br';
$contato->emailalternat = 'emailalt@email.com.br';

$std->contato = $contato;

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
