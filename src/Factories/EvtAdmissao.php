<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtAdmissao Event S-2200 constructor
 *
 * @category  NFePHP
 * @package   NFePHPSocial
 * @copyright NFePHP Copyright (c) 2017
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-esocial for the canonical source repository
 */

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Common\Factory;
use NFePHP\eSocial\Common\FactoryId;
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

class EvtAdmissao extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial = 1;

    /**
     * @var string
     */
    protected $evtName = 'evtAdmissao';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2200';
    /**
     * @var array
     */
    protected $parameters = [];


    /**
     * Constructor
     *
     * @param string      $config
     * @param stdClass    $std
     * @param Certificate $certificate
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate
    ) {
        parent::__construct($config, $std, $certificate);
    }

    /**
     * Node constructor
     */
    protected function toNode()
    {
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );
        $eSocial = $this->dom->getElementsByTagName("eSocial")->item(0);
        $evtAdmissao = $this->dom->createElement("evtAdmissao");
        $att = $this->dom->createAttribute('Id');
        $att->value = $evtid;
        $evtAdmissao->appendChild($att);

        $ideEvento = $this->dom->createElement("ideEvento");
        $this->dom->addChild(
            $ideEvento,
            "indRetif",
            $this->std->indretif,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "nrRecibo",
            !empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
            false
        );
        $this->dom->addChild(
            $ideEvento,
            "tpAmb",
            $this->tpAmb,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "procEmi",
            $this->procEmi,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "verProc",
            $this->verProc,
            true
        );
        $evtAdmissao->appendChild($ideEvento);

        $ideEmpregador = $this->dom->createElement("ideEmpregador");

        $this->dom->addChild(
            $ideEmpregador,
            "tpInsc",
            $this->tpInsc,
            true
        );
        $this->dom->addChild(
            $ideEmpregador,
            "nrInsc",
            $this->nrInsc,
            true
        );
        $evtAdmissao->appendChild($ideEmpregador);

        //trabalhador (obrigatório)
        $trabalhador = $this->dom->createElement("trabalhador");
        $this->dom->addChild(
            $trabalhador,
            "cpfTrab",
            $this->std->trabalhador->cpftrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nisTrab",
            $this->std->trabalhador->nistrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmTrab",
            $this->std->trabalhador->nmtrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "sexo",
            $this->std->trabalhador->sexo,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "racaCor",
            $this->std->trabalhador->racacor,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "estCiv",
            !empty($this->std->trabalhador->estciv) ? $this->std->trabalhador->estciv : null,
            false
        );
        $this->dom->addChild(
            $trabalhador,
            "grauInstr",
            $this->std->trabalhador->grauinstr,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "indPriEmpr",
            $this->std->trabalhador->indpriempr,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmSoc",
            !empty($this->std->trabalhador->nmsoc) ? $this->std->trabalhador->nmsoc : null,
            false
        );
        //nascimento (obrigatorio)
        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->trabalhador->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "codMunic",
            !empty($this->std->trabalhador->codmunic) ? $this->std->trabalhador->codmunic : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "uf",
            !empty($this->std->trabalhador->uf) ? $this->std->trabalhador->uf : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->trabalhador->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->trabalhador->paisnac,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "nmMae",
            !empty($this->std->trabalhador->nmmae) ? $this->std->trabalhador->nmmae : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "nmPai",
            !empty($this->std->trabalhador->nmpai) ? $this->std->trabalhador->nmpai : null,
            false
        );
        //encerra nascimento
        $trabalhador->appendChild($nascimento);


//        documentos (obrig)
        $documentos = $this->dom->createElement("documentos");
        //CTPS (Opc)
        if (isset($this->std->ctps)) {
            $ctps = $this->dom->createElement("CTPS");
            $this->dom->addChild(
                $ctps,
                "nrCtps",
                $this->std->ctps->nrctps,
                true
            );
            $this->dom->addChild(
                $ctps,
                "serieCtps",
                $this->std->ctps->seriectps,
                true
            );
            $this->dom->addChild(
                $ctps,
                "ufCtps",
                $this->std->ctps->ufctps,
                true
            );
            $documentos->appendChild($ctps);
        }
//        //RIC (Opc)
        if (isset($this->std->ric)) {
            $ric = $this->dom->createElement("RIC");
            $this->dom->addChild(
                $ric,
                "nrRic",
                $this->std->ric->nrric,
                true
            );
            $this->dom->addChild(
                $ric,
                "orgaoEmissor",
                $this->std->ric->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $ric,
                "dtExped",
                !empty($this->std->ric->dtexped) ? $this->std->ric->dtexped : null,
                false
            );
            $documentos->appendChild($ric);
        }
//        //RG
        if (isset($this->std->rg)) {
            $rg = $this->dom->createElement("RG");
            $this->dom->addChild(
                $rg,
                "nrRg",
                $this->std->rg->nrrg,
                true
            );
            $this->dom->addChild(
                $rg,
                "orgaoEmissor",
                $this->std->rg->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $rg,
                "dtExped",
                !empty($this->std->rg->dtexped) ? $this->std->rg->dtexped : null,
                false
            );
            $documentos->appendChild($rg);
        }
//        //RNE (Opc)
        if (isset($this->std->rne)) {
            $rne = $this->dom->createElement("RNE");
            $this->dom->addChild(
                $rne,
                "nrRne",
                $this->std->rne->nrrne,
                true
            );
            $this->dom->addChild(
                $rne,
                "orgaoEmissor",
                $this->std->rne->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $rne,
                "dtExped",
                !empty($this->std->rne->dtexped) ? $this->std->rne->dtexped : null,
                false
            );
            $this->dom->addChild(
                $rne,
                "dtValid",
                !empty($this->std->rne->dtvalid) ? $this->std->rne->dtvalid : null,
                false
            );
            $documentos->appendChild($rne);
        }
//        //OC (Opc)
        if (isset($this->std->oc)) {
            $oc = $this->dom->createElement("OC");
            $this->dom->addChild(
                $oc,
                "nrOc",
                $this->std->oc->nroc,
                true
            );
            $this->dom->addChild(
                $oc,
                "orgaoEmissor",
                $this->std->oc->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $oc,
                "dtExped",
                !empty($this->std->oc->dtexped) ? $this->std->oc->dtexped : null,
                false
            );

            $this->dom->addChild(
                $oc,
                "dtValid",
                !empty($this->std->oc->dtvalid) ? $this->std->oc->dtvalid : null,
                false
            );

            $documentos->appendChild($oc);
        }
        //CNH (Ops)
        if (isset($this->std->cnh)) {
            $cnh = $this->dom->createElement("CNH");
            $this->dom->addChild(
                $cnh,
                "nrRegCnh",
                $this->std->cnh->nrregcnh,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtExped",
                !empty($this->std->cnh->dtExped) ? $this->std->cnh->dtExped : null,
                false
            );
            $this->dom->addChild(
                $cnh,
                "ufCnh",
                $this->std->cnh->ufcnh,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtValid",
                $this->std->cnh->dtvalid,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtPriHab",
                !empty($this->std->cnh->dtprihab) ? $this->std->cnh->dtprihab : null,
                false
            );
            $this->dom->addChild(
                $cnh,
                "categoriaCnh",
                $this->std->cnh->categoriacnh,
                true
            );
            $documentos->appendChild($cnh);
        }
        //encerra documentos
        $trabalhador->appendChild($documentos);

//        //Endereço (obrigatorio)
        $endereco = $this->dom->createElement("endereco");
        if (isset($this->std->endereco->brasil)) {
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                $this->std->endereco->brasil->tplograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $this->std->endereco->brasil->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $this->std->endereco->brasil->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($this->std->endereco->brasil->complemento) ? $this->std->endereco->brasil->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($this->std->endereco->brasil->bairro) ? $this->std->endereco->brasil->bairro : null,
                true
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $this->std->endereco->brasil->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $this->std->endereco->brasil->codmunic,
                true
            );
            $this->dom->addChild(
                $brasil,
                "uf",
                $this->std->endereco->brasil->uf,
                true
            );
            $endereco->appendChild($brasil);
        }
        if (isset($this->std->endereco->exterior)) {
            $exterior = $this->dom->createElement("exterior");
            $this->dom->addChild(
                $exterior,
                "paisResid",
                $this->std->endereco->exterior->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $this->std->endereco->exterior->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $this->std->endereco->exterior->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($this->std->endereco->exterior->complemento) ? $this->std->endereco->exterior->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($this->std->endereco->exterior->bairro) ? $this->std->endereco->exterior->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $this->std->endereco->exterior->nmCid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                !empty($this->std->endereco->exterior->codpostal) ? $this->std->endereco->exterior->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
//        encerra endereço
        $trabalhador->appendChild($endereco);

        if (isset($this->std->trabestrangeiro)) {
            $trabEstrangeiro = $this->dom->createElement("trabEstrangeiro");
            $this->dom->addChild(
                $trabEstrangeiro,
                "dtChegada",
                $this->std->trabestrangeiro->dtchegada,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "classTrabEstrang",
                $this->std->trabestrangeiro->classtrabestrang,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "casadoBr",
                $this->std->trabestrangeiro->casadobr,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "filhosBr",
                $this->std->trabestrangeiro->filhosbr,
                true
            );
            $trabalhador->appendChild($trabEstrangeiro);
        }

        //deficiencia (opcional)
        if (isset($this->std->deficiencia)) {
            $deficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $deficiencia,
                "defFisica",
                $this->std->deficiencia->deffisica,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defVisual",
                $this->std->deficiencia->defvisual,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defAuditiva",
                $this->std->deficiencia->defauditiva,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defMental",
                $this->std->deficiencia->defmental,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defIntelectual",
                $this->std->deficiencia->defintelectual,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "reabReadap",
                $this->std->deficiencia->reabreadap,
                true
            );

            $this->dom->addChild(
                $deficiencia,
                "infoCota",
                $this->std->deficiencia->infocota,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "observacao",
                !empty($this->std->deficiencia->observacao) ? $this->std->deficiencia->observacao : null,
                false
            );
            $trabalhador->appendChild($deficiencia);
        }
        //dependente (opcional) (ARRAY)
        if (isset($this->std->dependente)) {
            foreach ($this->std->dependente as $dep) {
                $dependente = $this->dom->createElement("dependente");
                $this->dom->addChild(
                    $dependente,
                    "tpDep",
                    $dep->tpdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "nmDep",
                    $dep->nmdep,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "dtNascto",
                    $dep->dtnascto,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "cpfDep",
                    !empty($dep->cpfdep) ? $dep->cpfdep : null,
                    false
                );
                $this->dom->addChild(
                    $dependente,
                    "depIRRF",
                    $dep->depirrf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "depSF",
                    $dep->depsf,
                    true
                );
                $this->dom->addChild(
                    $dependente,
                    "incTrab",
                    $dep->inctrab,
                    true
                );
                $trabalhador->appendChild($dependente);
            }
        }

        //aposentadoria (opcional)
        if (isset($this->std->aposentadoria)) {
            $aposentadoria = $this->dom->createElement("aposentadoria");
            $this->dom->addChild(
                $aposentadoria,
                "trabAposent",
                $this->std->aposentadoria->trabaposent,
                true
            );
            $trabalhador->appendChild($aposentadoria);
        }

        //contato (opcional)
        if (isset($this->std->contato)) {
            $contato = $this->dom->createElement("contato");
            $this->dom->addChild(
                $contato,
                "fonePrinc",
                !empty($this->std->contato->foneprinc) ? $this->std->contato->foneprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "foneAlternat",
                !empty($this->std->contato->fonealternat) ? $this->std->contato->fonealternat : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                !empty($this->std->contato->emailprinc) ? $this->std->contato->emailprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailAlternat",
                !empty($this->std->contato->emailalternat) ? $this->std->contato->emailalternat : null,
                false
            );
            $trabalhador->appendChild($contato);
        }

        //encerra trabalhador
        $evtAdmissao->appendChild($trabalhador);

        //vinculo (obrigatorio)
        $vinculo = $this->dom->createElement("vinculo");
        $this->dom->addChild(
            $vinculo,
            "matricula",
            $this->std->vinculo->matricula,
            true
        );
        $this->dom->addChild(
            $vinculo,
            "tpRegTrab",
            $this->std->vinculo->tpregtrab,
            true
        );
        $this->dom->addChild(
            $vinculo,
            "tpRegPrev",
            $this->std->vinculo->tpregprev,
            true
        );
        $this->dom->addChild(
            $vinculo,
            "nrRecInfPrelim",
            !empty($this->std->vinculo->nrrecinfprelim) ? $this->std->vinculo->nrrecinfprelim : null,
            false
        );
        $this->dom->addChild(
            $vinculo,
            "cadIni",
            $this->std->vinculo->cadini,
            true
        );
        //infoRegimeTrab (obrigatorio)
        $infoRegimeTrab = $this->dom->createElement("infoRegimeTrab");

        if (isset($this->std->vinculo->celetista)) {
            $celetista = $this->dom->createElement("infoCeletista");
            $this->dom->addChild(
                $celetista,
                "dtAdm",
                $this->std->vinculo->celetista->dtadm,
                true
            );
            $this->dom->addChild(
                $celetista,
                "tpAdmissao",
                $this->std->vinculo->celetista->tpadmissao,
                true
            );
            $this->dom->addChild(
                $celetista,
                "indAdmissao",
                $this->std->vinculo->celetista->indadmissao,
                true
            );
            $this->dom->addChild(
                $celetista,
                "tpRegJor",
                $this->std->vinculo->celetista->tpregjor,
                true
            );
            $this->dom->addChild(
                $celetista,
                "natAtividade",
                $this->std->vinculo->celetista->natatividade,
                true
            );
            $this->dom->addChild(
                $celetista,
                "dtBase",
                !empty($this->std->vinculo->celetista->dtbase) ? $this->std->vinculo->celetista->dtbase : null,
                false
            );
            $this->dom->addChild(
                $celetista,
                "cnpjSindCategProf",
                $this->std->vinculo->celetista->cnpjsindcategprof,
                true
            );
            //FGTS (obrigatorio)
            $fgts = $this->dom->createElement("FGTS");
            $this->dom->addChild(
                $fgts,
                "opcFGTS",
                $this->std->vinculo->celetista->opcfgts,
                true
            );
            $this->dom->addChild(
                $fgts,
                "dtOpcFGTS",
                !empty($this->std->vinculo->celetista->dtopcfgts) ? $this->std->vinculo->celetista->dtopcfgts : null,
                false
            );
            $celetista->appendChild($fgts);

            if (isset($this->std->vinculo->celetista->trabtemporario)) {
                $trabTemporario = $this->dom->createElement("trabTemporario");
                $this->dom->addChild(
                    $trabTemporario,
                    "hipLeg",
                    $this->std->vinculo->celetista->trabtemporario->hipleg,
                    true
                );
                $this->dom->addChild(
                    $trabTemporario,
                    "justContr",
                    $this->std->vinculo->celetista->trabtemporario->justcontr,
                    true
                );
                $this->dom->addChild(
                    $trabTemporario,
                    "tpInclContr",
                    $this->std->vinculo->celetista->trabtemporario->tpinclcontr,
                    true
                );
                //identificação do tomador (obrigatório)
                $ideTomadorServ = $this->dom->createElement("ideTomadorServ");
                $this->dom->addChild(
                    $ideTomadorServ,
                    "tpInsc",
                    $this->std->vinculo->celetista->trabtemporario->tomador->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $ideTomadorServ,
                    "nrInsc",
                    $this->std->vinculo->celetista->trabtemporario->tomador->nrinsc,
                    true
                );
                $trabTemporario->appendChild($ideTomadorServ);

                //identificaçã o estabelecimento (opcional)
                if (isset($this->std->vinculo->celetista->trabTemporario->estab)) {
                    $ideEstabVinc = $this->dom->createElement("ideEstabVinc");
                    $this->dom->addChild(
                        $ideEstabVinc,
                        "tpInsc",
                        $this->std->vinculo->celetista->trabtemporario->estabvinc->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabVinc,
                        "nrInsc",
                        $this->std->vinculo->celetista->trabtemporario->estabvinc->nrinsc,
                        true
                    );
                    $trabTemporario->appendChild($ideEstabVinc);
                }

                //substituido (opcional) ARRAY
                if (isset($this->std->vinculo->celetista->trabTemporario->substituido)) {
                    foreach ($this->std->vinculo->celetista->trabTemporario->substituido as $subs) {
                        $ideTrabSubstituido = $this->dom->createElement("ideTrabSubstituido");
                        $this->dom->addChild(
                            $ideEstabVinc,
                            "cpfTrabSubst",
                            $subs->cpftrabsubst,
                            true
                        );
                        $trabTemporario->appendChild($ideTrabSubstituido);
                    }
                }
                //encerra trabTemporario
                $celetista->appendChild($trabTemporario);
            }
            //aprendiz (opcional)
            if (isset($this->std->vinculo->celetista->aprendiz)) {
                $aprendiz = $this->dom->createElement("aprend");
                $this->dom->addChild(
                    $aprendiz,
                    "tpInsc",
                    $this->std->vinculo->celetista->aprendiz->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $aprendiz,
                    "nrInsc",
                    $this->std->vinculo->celetista->aprendiz->nrinsc,
                    true
                );
                $celetista->appendChild($aprendiz);
            }
            //encerra celetista
            $infoRegimeTrab->appendChild($celetista);
        }
        $vinculo->appendChild($infoRegimeTrab);
        if (isset($this->std->vinculo->estatutario)) {
            $estatutario = $this->dom->createElement("infoEstatutario");
            $this->dom->addChild(
                $estatutario,
                "indProvim",
                $this->std->vinculo->estatutario->indprovim,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "tpProv",
                $this->std->vinculo->estatutario->tpprov,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "dtNomeacao",
                $this->std->vinculo->estatutario->dtnomeacao,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "dtPosse",
                $this->std->vinculo->estatutario->dtposse,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "dtExercicio",
                $this->std->vinculo->estatutario->dtexercicio,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "tpPlanRP",
                !empty($this->std->vinculo->estatutario->tpplanrp) ? $this->std->vinculo->estatutario->tpplanrp : null,
                false
            );
            //infoDecJud (opcional)
            if (isset($this->std->vinculo->estatutario->judicial)) {
                $infoDecJud = $this->dom->createElement("infoDecJud");
                $this->dom->addChild(
                    $infoDecJud,
                    "nrProcJud",
                    $this->std->vinculo->estatutario->judicial->nrprocjud,
                    true
                );
                $estatutario->appendChild($infoDecJud);
            }
            //encerra estatutario
            $infoRegimeTrab->appendChild($estatutario);
        }

        //infoContrato (obrigatorio)
        $contrato = $this->dom->createElement("infoContrato");
        $this->dom->addChild(
            $contrato,
            "codCargo",
            !empty($this->std->vinculo->contrato->codcargo) ? $this->std->vinculo->contrato->codcargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "codFuncao",
            !empty($this->std->vinculo->contrato->codfuncao) ? $this->std->vinculo->contrato->codfuncao : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "codCateg",
            $this->std->vinculo->contrato->codcateg,
            true
        );
        $this->dom->addChild(
            $contrato,
            "codCarreira",
            !empty($this->std->vinculo->contrato->codcarreira) ? $this->std->vinculo->contrato->codcarreira : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "dtIngrCarr",
            !empty($this->std->vinculo->contrato->dtingrcarr) ? $this->std->vinculo->contrato->dtingrcarr : null,
            false
        );
        //remuneracao (obrigatorio)
        $remuneracao = $this->dom->createElement("remuneracao");
        $this->dom->addChild(
            $remuneracao,
            "vrSalFx",
            $this->std->vinculo->contrato->vrsalfx,
            true
        );
        $this->dom->addChild(
            $remuneracao,
            "undSalFixo",
            $this->std->vinculo->contrato->undsalfixo,
            true
        );
        $this->dom->addChild(
            $remuneracao,
            "dscSalVar",
            !empty($this->std->vinculo->contrato->dscsalvar) ? $this->std->vinculo->contrato->dscsalvar : null,
            false
        );
        $contrato->appendChild($remuneracao);

        //duracao (obrigatorio)
        $duracao = $this->dom->createElement("duracao");
        $this->dom->addChild(
            $duracao,
            "tpContr",
            $this->std->vinculo->contrato->tpcontr,
            true
        );
        $this->dom->addChild(
            $duracao,
            "dtTerm",
            !empty($this->std->vinculo->contrato->dtterm) ? $this->std->vinculo->contrato->dtterm : null,
            false
        );
        $this->dom->addChild(
            $duracao,
            "clauAsseg",
            !empty($this->std->vinculo->contrato->clauasseg) ? $this->std->vinculo->contrato->clauasseg : null,
            false
        );
        $contrato->appendChild($duracao);
//
        //localTrabalho (obrigatorio)
        $localTrabalho = $this->dom->createElement("localTrabalho");
        //localTrabGeral (opcional)
        if (isset($this->std->vinculo->contrato->local)) {
            $localgeral = $this->dom->createElement("localTrabGeral");
            $this->dom->addChild(
                $localgeral,
                "tpInsc",
                $this->std->vinculo->contrato->local->tpinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "nrInsc",
                $this->std->vinculo->contrato->local->nrinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "descComp",
                !empty($this->std->vinculo->contrato->local->desccomp) ? $this->std->vinculo->contrato->local->desccomp : null,
                false
            );
            $localTrabalho->appendChild($localgeral);
        }
        //localTrabDom (opcional)
        if (isset($this->std->vinculo->contrato->domestico)) {
            $localDomestico = $this->dom->createElement("localTrabDom");
            $this->dom->addChild(
                $localDomestico,
                "tpLograd",
                $this->std->vinculo->contrato->domestico->tplograd,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "dscLograd",
                $this->std->vinculo->contrato->domestico->dsclograd,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "nrLograd",
                $this->std->vinculo->contrato->domestico->nrlograd,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "complemento",
                !empty($this->std->vinculo->contrato->domestico->complemento) ? $this->std->vinculo->contrato->domestico->complemento : null,
                false
            );
            $this->dom->addChild(
                $localDomestico,
                "bairro",
                !empty($this->std->vinculo->contrato->domestico->bairro) ? $this->std->vinculo->contrato->domestico->bairro : null,
                false
            );
            $this->dom->addChild(
                $localDomestico,
                "cep",
                $this->std->vinculo->contrato->domestico->cep,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "codMunic",
                $this->std->vinculo->contrato->domestico->codmunic,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "uf",
                $this->std->vinculo->contrato->domestico->uf,
                true
            );
            $localTrabalho->appendChild($localDomestico);
        }
        $contrato->appendChild($localTrabalho);

        //horContratual (opcional)
        if (isset($this->std->vinculo->contrato->horcontatual)) {
            $horContratual = $this->dom->createElement("horContratual");
            $this->dom->addChild(
                $horContratual,
                "qtdHrsSem",
                $this->std->vinculo->contrato->horcontratual->qtdhrssem,
                true
            );
            $this->dom->addChild(
                $horContratual,
                "tpJornada",
                $this->std->vinculo->contrato->horcontratual->tpjornada,
                true
            );
            $this->dom->addChild(
                $horContratual,
                "dscTpJorn",
                !empty($this->std->vinculo->contrato->horcontratual->dsctpjorn) ? $this->std->vinculo->contrato->horcontratual->dsctpjorn : null,
                false
            );
            $this->dom->addChild(
                $horContratual,
                "tmpParc",
                $this->std->vinculo->contrato->horcontratual->tmpparc,
                true
            );
            //horario (opcional) ARRAY
            if (isset($this->std->vinculo->contrato->horcontratual->horario)) {
                foreach ($this->std->vinculo->contrato->horcontratual->horario as $hr) {
                    $horario = $this->dom->createElement("horario");
                    $this->dom->addChild(
                        $horario,
                        "dia",
                        $hr->dia,
                        true
                    );
                    $this->dom->addChild(
                        $horario,
                        "codHorContrat",
                        $hr->codhorcontrat,
                        true
                    );
                    $horContratual->appendChild($horario);
                }
            }
            //encerra horContratual
            $contrato->appendChild($horContratual);
        }

        //filiacaoSindical (opcional) ARRAY
        if (isset($this->std->vinculo->contrato->filiacaosindical)) {
            foreach ($this->std->vinculo->contrato->filiacaosindical as $sind) {
                $filiacaoSindical = $this->dom->createElement("filiacaoSindical");
                $this->dom->addChild(
                    $horario,
                    "cnpjSindTrab",
                    $sind->cnpjsindtrab,
                    true
                );
                $contrato->appendChild($filiacaoSindical);
            }
        }
        //alvaraJudicial (opcional)
        if (isset($this->std->vinculo->contrato->judicial)) {
            $alvaraJudicial = $this->dom->createElement("alvaraJudicial");
            $this->dom->addChild(
                $alvaraJudicial,
                "nrProcJud",
                $this->std->vinculo->contrato->judicial->nrprocjud,
                true
            );
            $contrato->appendChild($alvaraJudicial);
        }
        //encerra contrato
        $vinculo->appendChild($contrato);

        //sucessaoVinc (opcional)
        if (isset($this->std->vinculo->sucessao)) {
            $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
            $this->dom->addChild(
                $sucessaoVinc,
                "cnpjEmpregAnt",
                $this->std->vinculo->sucessao->cnpjempregant,
                true
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "matricAnt",
                !empty($this->std->vinculo->sucessao->matricant) ? $this->std->vinculo->sucessao->matricant : null,
                false
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "dtIniVinculo",
                $this->std->vinculo->sucessao->dtinivinculo,
                true
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "observacao",
                !empty($this->std->vinculo->sucessao->observacao) ? $this->std->vinculo->sucessao->observacao : null,
                false
            );
            $vinculo->appendChild($sucessaoVinc);
        }
        //afastamento (opcional)
        if (isset($this->std->vinculo->afastamento)) {
            $afastamento = $this->dom->createElement("afastamento");
            $this->dom->addChild(
                $afastamento,
                "dtIniAfast",
                $this->std->vinculo->afastamento->dtiniafast,
                true
            );
            $this->dom->addChild(
                $afastamento,
                "codMotAfast",
                $this->std->vinculo->afastamento->codmotafast,
                true
            );

            $vinculo->appendChild($afastamento);
        }

        //desligamento (opcional)
        if (isset($this->std->vinculo->desligamento)) {
            $desligamento = $this->dom->createElement("desligamento");
            $this->dom->addChild(
                $desligamento,
                "dtDeslig",
                $this->std->vinculo->desligamento->dtdeslig,
                true
            );

            $vinculo->appendChild($desligamento);
        }

        //encerra vinculo
        $this->node->appendChild($vinculo);
        //finalização do xml

        $evtAdmissao->appendChild($vinculo);

        $eSocial->appendChild($evtAdmissao);
        $this->sign($eSocial);
    }
}
