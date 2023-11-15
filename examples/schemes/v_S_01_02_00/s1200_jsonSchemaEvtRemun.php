<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;


//S-1200

//versão S_1.2.0

$evento  = 'evtRemun';
$version = 'S_01_02_00';

$jsonSchema = '{
    "title": "evtRemun",
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
            "$ref": "#/definitions/recibo"
        },
        "indapuracao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "perapur": {
            "required": true,
            "type": "string",
            "$ref": "#/definitions/periodo"
        },
        "indguia": {
            "required": false,
            "type": ["integer","null"],
            "minimum": 1,
            "maximum": 1
        },
        "cpftrab": {
            "required": true,
            "type": "string",
            "pattern": "^[0-9]{11}$"
        },
        "infomv": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "indmv": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                },
                "remunoutrempr": {
                    "required": true,
                    "type": "array",
                    "minItems": 1,
                    "maxItems": 999,
                    "items": {
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
                            "codcateg": {
                                "required": true,
                                "type": "integer",
                                "minimum": 101,
                                "maximum": 999
                            },
                            "vlrremunoe": {
                                "required": true,
                                "type": "number"
                            }
                        }
                    }
                }
            }
        },
        "infocomplem": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "nmtrab": {
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
                "sucessaovinc": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "tpinsc": {
                            "required": true,
                            "type": "integer",
                            "minumum": 1,
                            "maximum": 2
                        },
                        "nrinsc": {
                            "required": true,
                            "type": "string",
                            "pattern": "^[0-9]{11,14}$"
                        },
                        "matricant": {
                            "required": false,
                            "type": ["string","null"],
                            "maxLength": 30
                        },
                        "dtadm": {
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
                }
            }
        },
        "procjudtrab": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 99,
            "items": {
                "type": "object",
                "properties": {
                    "tptrib": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 2
                    },
                    "nrprocjud": {
                        "required": true,
                        "type": "string",
                        "maxLength": 20
                    },
                    "codsusp": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^[0-9]{1,14}$"
                    }
                }
            }
        },
        "infointerm": {
            "required": false,
            "type": ["array","null"],
            "minItems": 0,
            "maxItems": 31,
            "items": {
                "properties": {
                    "dia": {
                        "required": true,
                        "type": "integer",
                        "minimum": 1,
                        "maximum": 31
                    }
                }
            }
        },
        "dmdev": {
            "required": true,
            "type": "array",
            "minItems": 1,
            "maxItems": 999,
            "items": {
                "type": "object",
                "properties": {
                    "idedmdev": {
                        "required": true,
                        "type": "string",
                        "maxLength": 30
                    },
                    "codcateg": {
                        "required": true,
                        "type": "integer",
                        "minimum": 101,
                        "maximum": 999
                    },
                    "indrra": {
                        "required": false,
                        "type": ["string","null"],
                        "pattern": "^(S)$"
                    },
                    "inforra": {
                        "required": false,
                        "type": [
                            "object",
                            "null"
                        ],
                        "properties": {
                            "tpprocrra": {
                                "required": true,
                                "type": "integer",
                                "minimum": 1,
                                "maximum": 2
                            },
                            "nrprocrra": {
                                "required": false,
                                "type": [
                                    "string",
                                    "null"
                                ],
                                "pattern": "^([0-9]{17}|[0-9]{20}|[0-9]{21}})$"
                            },
                            "descrra": {
                                "required": true,
                                "type": "string",
                                "minLength": 1,
                                "maxLength": 50
                            },
                            "qtdmesesrra": {
                                "required": true,
                                "type": "number"
                            },
                            "despprocjud": {
                                "required": false,
                                "type": [
                                    "object",
                                    "null"
                                ],
                                "properties": {
                                    "vlrdespcustas": {
                                        "required": true,
                                        "type": "number"
                                    },
                                    "vlrdespadvogados": {
                                        "required": true,
                                        "type": "number"
                                    }
                                }
                            },
                            "ideadv": {
                                        "required": false,
                                        "type": [
                                            "array",
                                            "null"
                                        ],
                                        "minItems": 0,
                                        "maxItems": 99,
                                        "items": {
                                            "type": "object",
                                            "properties": {
                                                "tpinsc": {
                                                    "required": true,
                                                    "type": "integer",
                                                    "minimum": 1,
                                                    "maximum": 6
                                                },
                                                "nrinsc": {
                                                    "required": true,
                                                    "type": "string",
                                                    "pattern": "^[0-9]{11,14}$"
                                                },
                                                "vlradv": {
                                                    "required": true,
                                                    "type": "number"
                                                }
                                            }
                                        }
                                    }
                        }
                    },
                    "infoperapur": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "ideestablot": {
                                "required": true,
                                "type": "array",
                                "minItems": 1,
                                "maxItems": 500,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "tpinsc": {
                                            "required": true,
                                            "type": "integer",
                                            "pattern": "^(1|3|4)$"
                                        },
                                        "nrinsc": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^.{12,14}$"
                                        },
                                        "codlotacao": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^.{1,30}$"
                                        },
                                        "qtddiasav": {
                                            "required": false,
                                            "type": ["integer","null"],
                                            "minumum": 1,
                                            "maximum": 31
                                        },
                                        "remunperapur": {
                                            "required": true,
                                            "type": "array",
                                            "minItems": 1,
                                            "maxItems": 8,
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "matricula": {
                                                        "required": false,
                                                        "type": ["string","null"],
                                                        "pattern": "^.{1,30}$"
                                                    },
                                                    "indsimples": {
                                                        "required": false,
                                                        "type": ["integer","null"],
                                                        "minumum": 1,
                                                        "maximum": 3
                                                    },
                                                    "itensremun": {
                                                        "required": true,
                                                        "type": "array",
                                                        "minItems": 1,
                                                        "maxItems": 200,
                                                        "items": {
                                                            "type": "object",
                                                            "properties": {
                                                                "codrubr": {
                                                                    "required": true,
                                                                    "type": "string",
                                                                    "pattern": "^.{1,30}$"
                                                                },
                                                                "idetabrubr": {
                                                                    "required": true,
                                                                    "type": "string",
                                                                    "pattern": "^.{1,8}$"
                                                                },
                                                                "qtdrubr": {
                                                                    "required": false,
                                                                    "type": ["number","null"]
                                                                },
                                                                "fatorrbr": {
                                                                    "required": false,
                                                                    "type": ["number","null"]
                                                                },
                                                                "vrrubr": {
                                                                    "required": true,
                                                                    "type": "number"
                                                                },
                                                                "indapurir": {
                                                                    "required": false,
                                                                    "type": ["integer","null"],
                                                                    "minumum": 0,
                                                                    "maximum": 3
                                                                }
                                                            }
                                                        }
                                                    },
                                                    "infoagnocivo": {
                                                        "required": false,
                                                        "type": ["object","null"],
                                                        "properties": {
                                                            "grauexp": {
                                                                "required": true,
                                                                "type": "integer",
                                                                "minumum": 1,
                                                                "maximum": 4
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
                    },
                    "infoperant": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "ideadc": {
                                "required": true,
                                "type": "array",
                                "minItems": 1,
                                "maxItems": 8,
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "dtacconv": {
                                            "required": false,
                                            "type": ["string","null"],
                                            "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                        },
                                        "tpacconv": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^[A-I]{1}$"
                                        },
                                        "dsc": {
                                            "required": true,
                                            "type": "string",
                                            "pattern": "^.{1,255}$"
                                        },
                                        "remunsuc": {
                                            "required": true,
                                            "type": "number"
                                        },
                                        "ideperiodo": {
                                            "required": true,
                                            "type": "array",
                                            "minItems": 1,
                                            "maxItems": 180,
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "perref": {
                                                        "required": true,
                                                        "type": "string",
                                                        "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))$"
                                                    },
                                                    "ideestablot": {
                                                        "required": true,
                                                        "type": "array",
                                                        "minItems": 1,
                                                        "maxItems": 500,
                                                        "items": {
                                                            "type": "object",
                                                            "properties": {
                                                                "tpinsc": {
                                                                    "required": true,
                                                                    "type": "integer",
                                                                    "pattern": "^(1|3|4)$"
                                                                },
                                                                "nrinsc": {
                                                                    "required": true,
                                                                    "type": "string",
                                                                    "pattern": "^[0-9]{11,14}"
                                                                },
                                                                "codlotacao": {
                                                                    "required": true,
                                                                    "type": "string",
                                                                    "maxLength": 30
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
                    },
                    "ideestablot": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 500,
                        "items": {
                            "type": "object",
                            "properties": {
                                "tpinsc": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^(1|3|4)$"
                                },
                                "nrinsc": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^[0-9]{8,14}"
                                },
                                "codlotacao": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 30
                                },
                                "qtddiasav": {
                                    "required": false,
                                    "type": ["integer","null"],
                                    "minimum": 1
                                },
                                "remunperapur": {
                                    "required": true,
                                    "type": "array",
                                    "minItems": 1,
                                    "maxItems": 8,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "matricula": {
                                                "required": false,
                                                "type": ["string","null"],
                                                "maxLength": 30
                                            },
                                            "indsimples": {
                                                "required": false,
                                                "type": ["integer","null"],
                                                "minimum": 1,
                                                "maximum": 3
                                            },
                                            "itensremun": {
                                                "required": true,
                                                "type": "array",
                                                "minItems": 1,
                                                "maxItems": 200,
                                                "items": {
                                                    "type": "object",
                                                    "properties": {
                                                        "codrubr": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 30
                                                        },
                                                        "idetabrubr": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 8
                                                        },
                                                        "qtdrubr": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "fatorrubr": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        },
                                                        "vrrubr": {
                                                            "required": false,
                                                            "type": ["number","null"]
                                                        }
                                                    }
                                                }
                                            },
                                            "detoper": {
                                                "required": false,
                                                "type": ["array","null"],
                                                "minItems": 0,
                                                "maxItems": 99,
                                                "items": {
                                                    "type": "object",
                                                    "properties": {
                                                        "cnpjoper": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 14,
                                                            "pattern": "^[0-9]"
                                                        },
                                                        "regans": {
                                                            "required": true,
                                                            "type": "string",
                                                            "minLength": 6,
                                                            "maxLength": 6
                                                        },
                                                        "vrpgtit": {
                                                            "required": true,
                                                            "type": "number"
                                                        },
                                                        "detplano": {
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
                                                                        "maxLength": 2,
                                                                        "pattern": "^[0-9]"
                                                                    },
                                                                    "cpfdep": {
                                                                        "required": false,
                                                                        "type": ["string","null"],
                                                                        "maxLength": 11,
                                                                        "pattern": "^[0-9]"
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
                                                                    "vlrpgdep": {
                                                                        "required": true,
                                                                        "type": "number"
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            },
                                            "infoagnocivo": {
                                                "required": false,
                                                "type": ["object","null"],
                                                "properties": {
                                                    "grauexp": {
                                                        "required": true,
                                                        "type": "integer",
                                                        "minimum": 1,
                                                        "maximum": 4
                                                    }
                                                }
                                            },
                                            "infotrabinterm": {
                                                "required": false,
                                                "type": ["array","null"],
                                                "minItems": 0,
                                                "maxItems": 99,
                                                "items": {
                                                    "type": "object",
                                                    "properties": {
                                                        "codconv": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 30
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    },
                    "ideadc": {
                        "required": false,
                        "type": ["array","null"],
                        "minItems": 0,
                        "maxItems": 8,
                        "items": {
                            "type": "object",
                            "properties": {
                                "dtacconv": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                },
                                "tpacconv": {
                                    "required": true,
                                    "type": "string",
                                    "pattern": "^(A|B|C|D|E|F|G|H)$"
                                },
                                "compacconv": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
                                },
                                "dtefacconv": {
                                    "required": false,
                                    "type": ["string","null"],
                                    "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])[-/](0?[1-9]|1[0-2])[-/](0?[1-9]|[12][0-9]|3[01])$"
                                },
                                "dsc": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 255
                                },
                                "remunsuc": {
                                    "required": true,
                                    "type": "string",
                                    "maxLength": 1,
                                    "pattern": "^(S|N)$"
                                },
                                "ideperiodo": {
                                    "required": true,
                                    "type": "array",
                                    "minItems": 1,
                                    "maxItems": 180,
                                    "items": {
                                        "type": "object",
                                        "properties": {
                                            "perref": {
                                                "required": true,
                                                "type": "string",
                                                "pattern": "^(19[0-9][0-9]|2[0-9][0-9][0-9])([-](0?[1-9]|1[0-2]))?$"
                                            },
                                            "ideestablot": {
                                                "required": true,
                                                "type": "array",
                                                "minItems": 1,
                                                "maxItems": 500,
                                                "items": {
                                                    "type": "object",
                                                    "properties": {
                                                        "tpinsc": {
                                                            "required": true,
                                                            "type": "integer",
                                                            "pattern": "^(1|3|4)$"
                                                        },
                                                        "nrinsc": {
                                                            "required": true,
                                                            "type": "string",
                                                            "pattern": "^[0-9]{8,14}"
                                                        },
                                                        "codlotacao": {
                                                            "required": true,
                                                            "type": "string",
                                                            "maxLength": 30
                                                        },
                                                        "remunperant": {
                                                            "required": true,
                                                            "type": "array",
                                                            "minItems": 1,
                                                            "maxItems": 8,
                                                            "items": {
                                                                "type": "object",
                                                                "properties": {
                                                                    "matricula": {
                                                                        "required": false,
                                                                        "type": ["string","null"],
                                                                        "maxLength": 30
                                                                    },
                                                                    "indsimples": {
                                                                        "required": false,
                                                                        "type": ["integer","null"],
                                                                        "minimum": 1,
                                                                        "maximum": 3
                                                                    },
                                                                    "itensremun": {
                                                                        "required": true,
                                                                        "type": "array",
                                                                        "minItems": 1,
                                                                        "maxItems": 200,
                                                                        "items": {
                                                                            "type": "object",
                                                                            "properties": {
                                                                                "codrubr": {
                                                                                    "required": true,
                                                                                    "type": "string",
                                                                                    "maxLength": 30
                                                                                },
                                                                                "idetabrubr": {
                                                                                    "required": true,
                                                                                    "type": "string",
                                                                                    "maxLength": 8
                                                                                },
                                                                                "qtdrubr": {
                                                                                    "required": false,
                                                                                    "type": ["number","null"]
                                                                                },
                                                                                "fatorrubr": {
                                                                                    "required": false,
                                                                                    "type": ["number","null"]
                                                                                },
                                                                                "vrrubr": {
                                                                                    "required": true,
                                                                                    "type": "number"
                                                                                }
                                                                            }
                                                                        }
                                                                    },
                                                                    "infoagnocivo": {
                                                                        "required": false,
                                                                        "type": ["object","null"],
                                                                        "properties": {
                                                                            "grauexp": {
                                                                                "required": true,
                                                                                "type": "integer",
                                                                                "minimum": 1,
                                                                                "maximum": 4
                                                                            }
                                                                        }
                                                                    },
                                                                    "infotrabinterm": {
                                                                        "required": false,
                                                                        "type": ["array","null"],
                                                                        "minItems": 0,
                                                                        "maxItems": 99,
                                                                        "items": {
                                                                            "type": "object",
                                                                            "properties": {
                                                                                "codconv": {
                                                                                    "required": true,
                                                                                    "type": "string",
                                                                                    "maxLength": 30
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
                            }
                        }
                    },
                    "infocomplcont": {
                        "required": false,
                        "type": ["object","null"],
                        "properties": {
                            "codcbo": {
                                "required": true,
                                "type": "string",
                                "pattern": "^[0-9]{4,6}$"
                            },
                            "natatividade": {
                                "required": false,
                                "type": ["integer","null"],
                                "minimum": 1,
                                "maximum": 2
                            },
                            "qtddiastrab": {
                                "required": false,
                                "type": ["integer","null"],
                                "minimum": 1,
                                "maximum": 31
                            }
                        }
                    }
                }
            }
        }
    }
}';


$std = new \stdClass();
//$std->sequencial = 1; //Opcional
$std->indretif = 1; //Obrigatório
$std->nrrecibo = '1.1.1234567890123456789'; //Obrigatório APENAS se indretif = 2
$std->indapuracao = 2; //Obrigatorio
$std->perapur = '2017-12'; //Obrigatório
$std->indguia = 1; //Opcional
$std->cpftrab = '12345678901'; //Obrigatório

//Grupo preenchido exclusivamente em caso de trabalhador
//que possua outros vínculos/atividades nos quais já tenha
//ocorrido desconto de contribuição previdenciária.
$std->infomv = new \stdClass(); //Opcional
$std->infomv->indmv = 1; //Obrigatório

//nformações relativas ao trabalhador que possui vínculo
//empregatício com outra(s) empresa(s)
$std->infomv->remunoutrempr[0] = new \stdClass(); //Obrigatório
$std->infomv->remunoutrempr[0]->tpinsc = 1; //Obrigatório
$std->infomv->remunoutrempr[0]->nrinsc = '12345678901234'; //Obrigatório
$std->infomv->remunoutrempr[0]->codcateg = 901; //Obrigatório
$std->infomv->remunoutrempr[0]->vlrremunoe = 2345.09; //Obrigatório

///Grupo preenchido quando o evento de remuneração se
//referir a trabalhador cuja categoria não está sujeita ao
//evento de admissão ou ao evento TSVE - Início
$std->infocomplem = new \stdClass(); //Opcional
$std->infocomplem->nmtrab = 'Fulano de Tal'; ///Obrigatório
$std->infocomplem->dtnascto = '1985-02-14'; //Obrigatório

//Informações da sucessão de vínculo trabalhista.
$std->infocomplem->sucessaovinc = new \stdClass(); //Opcional
$std->infocomplem->sucessaovinc->tpinsc = 1; //Obrigatório
$std->infocomplem->sucessaovinc->nrinsc = "12345678901234"; //Obrigatório
$std->infocomplem->sucessaovinc->matricant = 'jkdjkjdkjdjkd'; //Opcional
$std->infocomplem->sucessaovinc->dtadm = '2017-06-07'; //Obrigatório
$std->infocomplem->sucessaovinc->observacao = 'nao obrigatorio'; //Opcional

//Informações sobre a existência de processos judiciais do
//trabalhador com decisão favorável quanto à não incidência
//de contribuições sociais e/ou Imposto de Renda.
$std->procjudtrab[0] = new \stdClass(); //Opcional
$std->procjudtrab[0]->tptrib = 2; //Obrigatório
$std->procjudtrab[0]->nrprocjud = '12345678901234567890'; //Obrigatório
$std->procjudtrab[0]->codsusp = '12345678901234'; //Obrigatório

//Informações relativas ao trabalho intermitente
$std->infointerm[0] = new \stdClass(); //Opcional
$std->infointerm[0]->dia = 10; //Obrigatório

//Identificação de cada um dos demonstrativos de valores devidos ao trabalhador.
$std->dmdev[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->idedmdev = 'kjdkjdkjdkdj'; //Obrigatório
$std->dmdev[0]->codcateg = 101; //Obrigatório

$std->dmdev[0]->indrra = 'S';
//Indicativo de Rendimentos Recebidos Acumuladamente - RRA.
//Somente preencher este campo se for um demonstrativo de RRA.
//O campo apenas pode ser informado se {perApur}(/ideEvento_perApur) >= [2023-03]
// (se {indApuracao}(/ideEvento_indApuracao) = [1])
// ou se {perApur}(/ideEvento_perApur) >= [2023]
// (se {indApuracao}(/ideEvento_indApuracao) = [2]).
$std->dmdev[0]->inforra = new \stdClass(); //Opcional
//Informações complementares de RRA.
//Informações complementares relativas a Rendimentos Recebidos Acumuladamente - RRA.
//se {indRRA}(../indRRA) = [S]); N nos demais casos
$std->dmdev[0]->inforra->tpprocrra = 1; //Obrigatório
// 1 - Administrativo
// 2 - Judicial
$std->dmdev[0]->inforra->nrprocrra = '12345678901234567890'; //Opcional
//Informar o número do processo/requerimento administrativo/judicial.
//Informação obrigatória se {tpProcRRA}(./tpProcRRA) = [2] e opcional se {tpProcRRA}(./tpProcRRA) = [1].
// Deve ser número de processo válido e
//a) Se {tpProcRRA}(./tpProcRRA) = [1], deve possuir 17 (dezessete) ou 21 (vinte e um) algarismos;
//b) Se {tpProcRRA}(./tpProcRRA) = [2], deve possuir 20 (vinte) algarismos.

$std->dmdev[0]->inforra->descrra = 'bla bla bla'; //Obrigatório
//Descrição dos Rendimentos Recebidos Acumuladamente - RRA.

$std->dmdev[0]->inforra->qtdmesesrra = 111.3; //Obrigatório
//Número de meses relativo aos Rendimentos Recebidos Acumuladamente - RRA. de 0 até 999.9

$std->dmdev[0]->inforra->despprocjud = new \stdClass(); //Opcional
//Despesas com processo judicial. Detalhamento das despesas com processo judicial.

$std->dmdev[0]->inforra->despprocjud->vlrdespcustas = 1000;  //Obrigatório
//Preencher com o valor das despesas com custas judiciais.

$std->dmdev[0]->inforra->despprocjud->vlrdespadvogados = 1543.12; //obrigatório
//Preencher com o valor total das despesas com advogado(s).

$std->dmdev[0]->inforra->ideadv[0]  = new \stdClass(); //Opcional
//Identificação dos advogados.
$std->dmdev[0]->inforra->ideadv[0]->tpinsc = 1;
//Preencher com o código correspondente ao tipo de inscrição, conforme Tabela 05.
//1 CNPJ
//2 CPF
//3 CAEPF (Cadastro de Atividade Econômica de Pessoa Física)
//4 CNO (Cadastro Nacional de Obra)
//5 CGC
//6 CEI
$std->dmdev[0]->inforra->ideadv[0]->nrinsc = '12345678901';
//Informar o número de inscrição do advogado.
//Deve ser um número de inscrição válido, de acordo com o tipo de inscrição indicado no campo {ideAdv/tpInsc}(./tpInsc),
//considerando as particularidades aplicadas à informação de CNPJ de órgão público em S-1000.
//Se {ideAdv/tpInsc}(./tpInsc) = [1], deve possuir 14 (catorze) algarismos e, no caso de declarante pessoa jurídica,
//ser diferente do CNPJ base do empregador (exceto se {ideEmpregador/nrInsc}(/ideEmpregador_nrInsc) tiver
//14 (catorze) algarismos).
//Se {ideAdv/tpInsc}(./tpInsc) = [2], deve possuir 11 (onze) algarismos e, no caso de declarante pessoa física, ser
//diferente do CPF do empregador.
$std->dmdev[0]->inforra->ideadv[0]->vlradv = 1543.12;

//Identificação do estabelecimento e da lotação nos quais o
//trabalhador possui remuneração no período de apuração
$std->dmdev[0]->ideestablot[0] = new \stdClass(); //Opcional
$std->dmdev[0]->ideestablot[0]->tpinsc = "1"; //Obrigatório
$std->dmdev[0]->ideestablot[0]->nrinsc = '12345678901234'; //Obrigatório
$std->dmdev[0]->ideestablot[0]->codlotacao = 'qlkjakljwj'; //Obrigatório
$std->dmdev[0]->ideestablot[0]->qtddiasav = 20; //Opcional

//Informações relativas à remuneração do trabalhador no período de apuração.
$std->dmdev[0]->ideestablot[0]->remunperapur[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->matricula = 'kjsksjksjskjsk'; //Opcional
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->indsimples = 1; //Opcional

//Rubricas que compõem a remuneração do trabalhador.
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->codrubr = 'ksksksks'; //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->idetabrubr = 'j2j2j'; //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->qtdrubr = 150.30; //Opcional
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->fatorrubr = 1.20; //Opcional
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->vrrubr = 123.90; //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->indapurir = 0; //Opcional

//Grupo referente ao detalhamento do grau de exposição do trabalhador aos agentes nocivos que ensejam a cobrança
//da contribuição adicional para financiamento dos benefícios de aposentadoria especial.
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->infoagnocivo = new \stdClass(); //Opcional
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->infoagnocivo->grauexp = 4; //Obrigatório

//Identificação do instrumento ou situação ensejadora da
//remuneração relativa a períodos de apuração anteriores
$std->dmdev[0]->ideadc[0] = new \stdClass(); //Opcional
$std->dmdev[0]->ideadc[0]->dtacconv = '2016-12-10';  //Opcional
$std->dmdev[0]->ideadc[0]->tpacconv = 'A'; //Obrigatório
$std->dmdev[0]->ideadc[0]->dsc = 'descricao'; //Obrigatório
$std->dmdev[0]->ideadc[0]->remunsuc = 'S'; //Obrigatório

//Identificação do período ao qual se referem as diferenças
//de remuneração.
$std->dmdev[0]->ideadc[0]->ideperiodo[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->perref = '2017-01'; //Obrigatório

//dentificação do estabelecimento e da lotação ao qual se
//referem as diferenças de remuneração do mês identificado
//no grupo superior.
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->tpinsc = "1"; //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->nrinsc = '12345678901234'; //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->codlotacao = 'ksjskjkjskjjs'; //Obrigatório

//Informações relativas à remuneração do trabalhador em períodos anteriores.
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->matricula = 'kjskjskjskjs'; //Opcional
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->indsimples = 1; //Opcional

//Rubricas que compõem a remuneração do trabalhador.
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->codrubr = 'aaaaa'; //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->idetabrubr = 'bbbbb'; //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->qtdrubr = 12.65; //Opcional
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->fatorrubr = 2.99; //Opcional
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->vrrubr = 169.99; //Obrigatório

//Grupo referente ao detalhamento do grau de exposição do trabalhador aos agentes nocivos que ensejam a cobrança
//da contribuição adicional para financiamento dos benefícios de aposentadoria especial.
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->infoagnocivo = new \stdClass(); //Opcional
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->infoagnocivo->grauexp = 2;  //Obrigatório

//Grupo preenchido exclusivamente quando o evento de
//remuneração se referir a trabalhador cuja categoria não
//estiver obrigada ao evento de início de TSVE e se não
//houver evento S-2300 correspondente.
$std->dmdev[0]->infocomplcont = new \stdClass(); //Opcional
$std->dmdev[0]->infocomplcont->codcbo = '123456'; //Obrigatório
$std->dmdev[0]->infocomplcont->natatividade = 1; //Obrigatório
$std->dmdev[0]->infocomplcont->qtddiastrab = 14; //Obrigatório


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
    $std, $jsonSchemaObject, Constraint::CHECK_MODE_COERCE_TYPES  //tenta converter o dado no tipo indicado no schema
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
