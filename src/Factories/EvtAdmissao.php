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
     * @param string $config
     * @param stdClass $std
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
        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);
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
            ! empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
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
        $this->node->insertBefore($ideEvento, $ideEmpregador);
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
            ! empty($this->std->trabalhador->estciv) ? $this->std->trabalhador->estciv : null,
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
            !empty($this->std->trabalhador->indpriempr) ? $this->std->trabalhador->indpriempr : null,
            false
        );
        $this->dom->addChild(
            $trabalhador,
            "nmSoc",
            ! empty($this->std->trabalhador->nmsoc) ? $this->std->trabalhador->nmsoc : null,
            false
        );
        //nascimento (obrigatorio)
        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->trabalhador->nascimento->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "codMunic",
            ! empty($this->std->trabalhador->nascimento->codmunic) ? $this->std->trabalhador->nascimento->codmunic : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "uf",
            ! empty($this->std->trabalhador->nascimento->uf) ? $this->std->trabalhador->nascimento->uf : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->trabalhador->nascimento->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->trabalhador->nascimento->paisnac,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "nmMae",
            ! empty($this->std->trabalhador->nascimento->nmmae) ? $this->std->trabalhador->nascimento->nmmae : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "nmPai",
            ! empty($this->std->trabalhador->nascimento->nmpai) ? $this->std->trabalhador->nascimento->nmpai : null,
            false
        );
        $trabalhador->appendChild($nascimento);
        // documentos (obrig)
        $documentos = $this->dom->createElement("documentos");
        //CTPS (Opc)
        if (isset($this->std->trabalhador->documentos->ctps)) {
            $ctps = $this->dom->createElement("CTPS");
            $this->dom->addChild(
                $ctps,
                "nrCtps",
                $this->std->trabalhador->documentos->ctps->nrctps,
                true
            );
            $this->dom->addChild(
                $ctps,
                "serieCtps",
                $this->std->trabalhador->documentos->ctps->seriectps,
                true
            );
            $this->dom->addChild(
                $ctps,
                "ufCtps",
                $this->std->trabalhador->documentos->ctps->ufctps,
                true
            );
            $documentos->appendChild($ctps);
        }
        //RIC (Opc)
        if (isset($this->std->trabalhador->documentos->ric)) {
            $ric = $this->dom->createElement("RIC");
            $this->dom->addChild(
                $ric,
                "nrRic",
                $this->std->trabalhador->documentos->ric->nrric,
                true
            );
            $this->dom->addChild(
                $ric,
                "orgaoEmissor",
                $this->std->trabalhador->documentos->ric->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $ric,
                "dtExped",
                ! empty($this->std->trabalhador->documentos->ric->dtexped) ? $this->std->trabalhador->documentos->ric->dtexped : null,
                false
            );
            $documentos->appendChild($ric);
        }
        //RG
        if (isset($this->std->trabalhador->documentos->rg)) {
            $rg = $this->dom->createElement("RG");
            $this->dom->addChild(
                $rg,
                "nrRg",
                $this->std->trabalhador->documentos->rg->nrrg,
                true
            );
            $this->dom->addChild(
                $rg,
                "orgaoEmissor",
                $this->std->trabalhador->documentos->rg->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $rg,
                "dtExped",
                ! empty($this->std->trabalhador->documentos->rg->dtexped) ? $this->std->trabalhador->documentos->rg->dtexped : null,
                false
            );
            $documentos->appendChild($rg);
        }
        //RNE (Opc)
        if (isset($this->std->trabalhador->documentos->rne)) {
            $rne = $this->dom->createElement("RNE");
            $this->dom->addChild(
                $rne,
                "nrRne",
                $this->std->trabalhador->documentos->rne->nrrne,
                true
            );
            $this->dom->addChild(
                $rne,
                "orgaoEmissor",
                $this->std->trabalhador->documentos->rne->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $rne,
                "dtExped",
                ! empty($this->std->trabalhador->documentos->rne->dtexped) ? $this->std->trabalhador->documentos->rne->dtexped : null,
                false
            );
            $this->dom->addChild(
                $rne,
                "dtValid",
                ! empty($this->std->trabalhador->documentos->rne->dtvalid) ? $this->std->trabalhador->documentos->rne->dtvalid : null,
                false
            );
            $documentos->appendChild($rne);
        }
        //OC (Opc)
        if (isset($this->std->trabalhador->documentos->oc)) {
            $oc = $this->dom->createElement("OC");
            $this->dom->addChild(
                $oc,
                "nrOc",
                $this->std->trabalhador->documentos->oc->nroc,
                true
            );
            $this->dom->addChild(
                $oc,
                "orgaoEmissor",
                $this->std->trabalhador->documentos->oc->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $oc,
                "dtExped",
                ! empty($this->std->trabalhador->documentos->oc->dtexped) ? $this->std->trabalhador->documentos->oc->dtexped : null,
                false
            );

            $this->dom->addChild(
                $oc,
                "dtValid",
                ! empty($this->std->trabalhador->documentos->oc->dtvalid) ? $this->std->trabalhador->documentos->oc->dtvalid : null,
                false
            );

            $documentos->appendChild($oc);
        }
        //CNH (Ops)
        if (isset($this->std->trabalhador->documentos->cnh)) {
            $cnh = $this->dom->createElement("CNH");
            $this->dom->addChild(
                $cnh,
                "nrRegCnh",
                $this->std->trabalhador->documentos->cnh->nrregcnh,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtExped",
                ! empty($this->std->trabalhador->documentos->cnh->dtExped) ? $this->std->trabalhador->documentos->cnh->dtExped : null,
                false
            );
            $this->dom->addChild(
                $cnh,
                "ufCnh",
                $this->std->trabalhador->documentos->cnh->ufcnh,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtValid",
                $this->std->trabalhador->documentos->cnh->dtvalid,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtPriHab",
                ! empty($this->std->trabalhador->documentos->cnh->dtprihab) ? $this->std->trabalhador->documentos->cnh->dtprihab : null,
                false
            );
            $this->dom->addChild(
                $cnh,
                "categoriaCnh",
                $this->std->trabalhador->documentos->cnh->categoriacnh,
                true
            );
            $documentos->appendChild($cnh);
        }
        $trabalhador->appendChild($documentos);
        //Endereço (obrigatorio)
        $endereco = $this->dom->createElement("endereco");

        if (isset($this->std->trabalhador->endereco->brasil)) {
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                $this->std->trabalhador->endereco->brasil->tplograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $this->std->trabalhador->endereco->brasil->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $this->std->trabalhador->endereco->brasil->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                ! empty($this->std->trabalhador->endereco->brasil->complemento) ? $this->std->trabalhador->endereco->brasil->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                ! empty($this->std->trabalhador->endereco->brasil->bairro) ? $this->std->trabalhador->endereco->brasil->bairro : null,
                true
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $this->std->trabalhador->endereco->brasil->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $this->std->trabalhador->endereco->brasil->codmunic,
                true
            );
            $this->dom->addChild(
                $brasil,
                "uf",
                $this->std->trabalhador->endereco->brasil->uf,
                true
            );
            $endereco->appendChild($brasil);
        }
        if (isset($this->std->trabalhador->endereco->exterior)) {
            $exterior = $this->dom->createElement("exterior");
            $this->dom->addChild(
                $exterior,
                "paisResid",
                $this->std->trabalhador->endereco->exterior->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $this->std->trabalhador->endereco->exterior->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $this->std->trabalhador->endereco->exterior->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                ! empty($this->std->trabalhador->endereco->exterior->complemento) ?
                    $this->std->trabalhador->endereco->exterior->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                ! empty($this->std->trabalhador->endereco->exterior->bairro) ? $this->std->trabalhador->endereco->exterior->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $this->std->trabalhador->endereco->exterior->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                ! empty($this->std->trabalhador->endereco->exterior->codpostal) ? $this->std->trabalhador->endereco->exterior->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $trabalhador->appendChild($endereco);
        if (isset($this->std->trabalhador->trabestrangeiro)) {
            $trabEstrangeiro = $this->dom->createElement("trabEstrangeiro");
            $this->dom->addChild(
                $trabEstrangeiro,
                "dtChegada",
                $this->std->trabalhador->trabestrangeiro->dtchegada,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "classTrabEstrang",
                $this->std->trabalhador->trabestrangeiro->classtrabestrang,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "casadoBr",
                $this->std->trabalhador->trabestrangeiro->casadobr,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "filhosBr",
                $this->std->trabalhador->trabestrangeiro->filhosbr,
                true
            );
            $trabalhador->appendChild($trabEstrangeiro);
        }
        //deficiencia (opcional)
        if (isset($this->std->trabalhador->infodeficiencia)) {
            $deficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $deficiencia,
                "defFisica",
                $this->std->trabalhador->infodeficiencia->deffisica,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defVisual",
                $this->std->trabalhador->infodeficiencia->defvisual,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defAuditiva",
                $this->std->trabalhador->infodeficiencia->defauditiva,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defMental",
                $this->std->trabalhador->infodeficiencia->defmental,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "defIntelectual",
                $this->std->trabalhador->infodeficiencia->defintelectual,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "reabReadap",
                $this->std->trabalhador->infodeficiencia->reabreadap,
                true
            );

            $this->dom->addChild(
                $deficiencia,
                "infoCota",
                $this->std->trabalhador->infodeficiencia->infocota,
                true
            );
            $this->dom->addChild(
                $deficiencia,
                "observacao",
                ! empty($this->std->trabalhador->infodeficiencia->observacao) ? $this->std->trabalhador->infodeficiencia->observacao : null,
                false
            );
            $trabalhador->appendChild($deficiencia);
        }
        //dependente (opcional) (ARRAY)
        if (isset($this->std->trabalhador->dependente)) {
            foreach ($this->std->trabalhador->dependente as $dep) {
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
                    ! empty($dep->cpfdep) ? $dep->cpfdep : null,
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
        if (isset($this->std->trabalhador->aposentadoria)) {
            $aposentadoria = $this->dom->createElement("aposentadoria");
            $this->dom->addChild(
                $aposentadoria,
                "trabAposent",
                $this->std->trabalhador->aposentadoria->trabaposent,
                true
            );
            $trabalhador->appendChild($aposentadoria);
        }
        //contato (opcional)
        if (isset($this->std->trabalhador->contato)) {
            $contato = $this->dom->createElement("contato");
            $this->dom->addChild(
                $contato,
                "fonePrinc",
                ! empty($this->std->trabalhador->contato->foneprinc) ? $this->std->trabalhador->contato->foneprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "foneAlternat",
                ! empty($this->std->trabalhador->contato->fonealternat) ? $this->std->trabalhador->contato->fonealternat : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                ! empty($this->std->trabalhador->contato->emailprinc) ? $this->std->trabalhador->contato->emailprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailAlternat",
                ! empty($this->std->trabalhador->contato->emailalternat) ? $this->std->trabalhador->contato->emailalternat : null,
                false
            );
            $trabalhador->appendChild($contato);
        }
        //encerra trabalhador
        $this->node->appendChild($trabalhador);
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
            ! empty($this->std->vinculo->nrrecinfprelim) ? $this->std->vinculo->nrrecinfprelim : null,
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
        if (isset($this->std->vinculo->inforegimetrab->infoceletista)) {
            $celetista = $this->dom->createElement("infoCeletista");
            $this->dom->addChild(
                $celetista,
                "dtAdm",
                $this->std->vinculo->inforegimetrab->infoceletista->dtadm,
                true
            );
            $this->dom->addChild(
                $celetista,
                "tpAdmissao",
                $this->std->vinculo->inforegimetrab->infoceletista->tpadmissao,
                true
            );
            $this->dom->addChild(
                $celetista,
                "indAdmissao",
                $this->std->vinculo->inforegimetrab->infoceletista->indadmissao,
                true
            );
            $this->dom->addChild(
                $celetista,
                "tpRegJor",
                $this->std->vinculo->inforegimetrab->infoceletista->tpregjor,
                true
            );
            $this->dom->addChild(
                $celetista,
                "natAtividade",
                $this->std->vinculo->inforegimetrab->infoceletista->natatividade,
                true
            );
            $this->dom->addChild(
                $celetista,
                "dtBase",
                ! empty($this->std->vinculo->inforegimetrab->infoceletista->dtbase) ? $this->std->vinculo->inforegimetrab->infoceletista->dtbase : null,
                false
            );
            $this->dom->addChild(
                $celetista,
                "cnpjSindCategProf",
                $this->std->vinculo->inforegimetrab->infoceletista->cnpjsindcategprof,
                true
            );
            //FGTS (obrigatorio)
            $fgts = $this->dom->createElement("FGTS");
            $this->dom->addChild(
                $fgts,
                "opcFGTS",
                $this->std->vinculo->inforegimetrab->infoceletista->fgts->opcfgts,
                true
            );
            $this->dom->addChild(
                $fgts,
                "dtOpcFGTS",
                ! empty($this->std->vinculo->inforegimetrab->infoceletista->fgts->dtopcfgts) ? $this->std->vinculo->inforegimetrab->infoceletista->fgts->dtopcfgts : null,
                false
            );
            $celetista->appendChild($fgts);
            if (isset($this->std->vinculo->inforegimetrab->infoceletista->trabtemporario)) {
                $trabTemporario = $this->dom->createElement("trabTemporario");
                $this->dom->addChild(
                    $trabTemporario,
                    "hipLeg",
                    $this->std->vinculo->inforegimetrab->infoceletista->trabtemporario->hipleg,
                    true
                );
                $this->dom->addChild(
                    $trabTemporario,
                    "justContr",
                    $this->std->vinculo->inforegimetrab->infoceletista->trabtemporario->justcontr,
                    true
                );
                $this->dom->addChild(
                    $trabTemporario,
                    "tpInclContr",
                    $this->std->vinculo->inforegimetrab->infoceletista->trabtemporario->tpinclcontr,
                    true
                );
                //identificação do tomador (obrigatório)
                $ideTomadorServ = $this->dom->createElement("ideTomadorServ");
                $this->dom->addChild(
                    $ideTomadorServ,
                    "tpInsc",
                    $this->std->vinculo->inforegimetrab->infoceletista->trabtemporario->idetomadorserv->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $ideTomadorServ,
                    "nrInsc",
                    $this->std->vinculo->inforegimetrab->infoceletista->trabtemporario->idetomadorserv->nrinsc,
                    true
                );
                $trabTemporario->appendChild($ideTomadorServ);

                //identificaçã o estabelecimento (opcional)
                if (isset($this->std->vinculo->inforegimetrab->infoceletista->trabTemporario->estab)) {
                    $ideEstabVinc = $this->dom->createElement("ideEstabVinc");
                    $this->dom->addChild(
                        $ideEstabVinc,
                        "tpInsc",
                        $this->std->vinculo->inforegimetrab->infoceletista->trabtemporario->ideestabvinc->tpinsc,
                        true
                    );
                    $this->dom->addChild(
                        $ideEstabVinc,
                        "nrInsc",
                        $this->std->vinculo->inforegimetrab->infoceletista->trabtemporario->ideestabvinc->nrinsc,
                        true
                    );
                    $trabTemporario->appendChild($ideEstabVinc);
                }

                //substituido (opcional) ARRAY
                if (isset($this->std->vinculo->inforegimetrab->infoceletista->trabTemporario->substituido)) {
                    foreach ($this->std->vinculo->inforegimetrab->infoceletista->trabTemporario->substituido as $subs) {
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
            if (isset($this->std->vinculo->inforegimetrab->infoceletista->aprend)) {
                $aprendiz = $this->dom->createElement("aprend");
                $this->dom->addChild(
                    $aprendiz,
                    "tpInsc",
                    $this->std->vinculo->inforegimetrab->infoceletista->aprend->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $aprendiz,
                    "nrInsc",
                    $this->std->vinculo->inforegimetrab->infoceletista->aprend->nrinsc,
                    true
                );
                $celetista->appendChild($aprendiz);
            }
            //encerra celetista
            $infoRegimeTrab->appendChild($celetista);
        }
        $vinculo->appendChild($infoRegimeTrab);
        if (isset($this->std->vinculo->inforegimetrab->infoestatutario)) {
            $estatutario = $this->dom->createElement("infoEstatutario");
            $this->dom->addChild(
                $estatutario,
                "indProvim",
                $this->std->vinculo->inforegimetrab->infoestatutario->indprovim,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "tpProv",
                $this->std->vinculo->inforegimetrab->infoestatutario->tpprov,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "dtNomeacao",
                $this->std->vinculo->inforegimetrab->infoestatutario->dtnomeacao,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "dtPosse",
                $this->std->vinculo->inforegimetrab->infoestatutario->dtposse,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "dtExercicio",
                $this->std->vinculo->inforegimetrab->infoestatutario->dtexercicio,
                true
            );
            $this->dom->addChild(
                $estatutario,
                "tpPlanRP",
                ! empty($this->std->vinculo->inforegimetrab->infoestatutario->tpplanrp) ? $this->std->vinculo->inforegimetrab->infoestatutario->tpplanrp : null,
                false
            );
            //infoDecJud (opcional)
            if (isset($this->std->vinculo->inforegimetrab->infoestatutario->infodecjud)) {
                $infoDecJud = $this->dom->createElement("infoDecJud");
                $this->dom->addChild(
                    $infoDecJud,
                    "nrProcJud",
                    $this->std->vinculo->inforegimetrab->infoestatutario->infodecjud->nrprocjud,
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
            ! empty($this->std->vinculo->infocontrato->codcargo) ? $this->std->vinculo->infocontrato->codcargo : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "codFuncao",
            ! empty($this->std->vinculo->infocontrato->codfuncao) ? $this->std->vinculo->infocontrato->codfuncao : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "codCateg",
            $this->std->vinculo->infocontrato->codcateg,
            true
        );
        $this->dom->addChild(
            $contrato,
            "codCarreira",
            ! empty($this->std->vinculo->infocontrato->codcarreira) ? $this->std->vinculo->infocontrato->codcarreira : null,
            false
        );
        $this->dom->addChild(
            $contrato,
            "dtIngrCarr",
            ! empty($this->std->vinculo->infocontrato->dtingrcarr) ? $this->std->vinculo->infocontrato->dtingrcarr : null,
            false
        );
        //remuneracao (obrigatorio)
        $remuneracao = $this->dom->createElement("remuneracao");
        $this->dom->addChild(
            $remuneracao,
            "vrSalFx",
            $this->std->vinculo->infocontrato->remuneracao->vrsalfx,
            true
        );
        $this->dom->addChild(
            $remuneracao,
            "undSalFixo",
            $this->std->vinculo->infocontrato->remuneracao->undsalfixo,
            true
        );
        $this->dom->addChild(
            $remuneracao,
            "dscSalVar",
            ! empty($this->std->vinculo->infocontrato->remuneracao->dscsalvar) ? $this->std->vinculo->infocontrato->remuneracao->dscsalvar : null,
            false
        );
        $contrato->appendChild($remuneracao);
        //duracao (obrigatorio)
        $duracao = $this->dom->createElement("duracao");
        $this->dom->addChild(
            $duracao,
            "tpContr",
            $this->std->vinculo->infocontrato->duracao->tpcontr,
            true
        );
        $this->dom->addChild(
            $duracao,
            "dtTerm",
            ! empty($this->std->vinculo->infocontrato->duracao->dtterm) ? $this->std->vinculo->infocontrato->duracao->dtterm : null,
            false
        );
        $this->dom->addChild(
            $duracao,
            "clauAssec",
            ! empty($this->std->vinculo->infocontrato->duracao->clauassec) ? $this->std->vinculo->infocontrato->duracao->clauassec : null,
            false
        );
        $contrato->appendChild($duracao);
        //localTrabalho (obrigatorio)
        $localTrabalho = $this->dom->createElement("localTrabalho");
        //localTrabGeral (opcional)
        if (isset($this->std->vinculo->infocontrato->localtrabalho->localtrabgeral)) {
            $localgeral = $this->dom->createElement("localTrabGeral");
            $this->dom->addChild(
                $localgeral,
                "tpInsc",
                $this->std->vinculo->infocontrato->localtrabalho->localtrabgeral->tpinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "nrInsc",
                $this->std->vinculo->infocontrato->localtrabalho->localtrabgeral->nrinsc,
                true
            );
            $this->dom->addChild(
                $localgeral,
                "descComp",
                ! empty($this->std->vinculo->infocontrato->localtrabalho->localtrabgeral->desccomp) ?
                    $this->std->vinculo->infocontrato->localtrabalho->localtrabgeral->desccomp : null,
                false
            );
            $localTrabalho->appendChild($localgeral);
        }
        //localTrabDom (opcional)
        if (isset($this->std->vinculo->infocontrato->localtrabalho->localtrabdom)) {
            $localDomestico = $this->dom->createElement("localTrabDom");
            $this->dom->addChild(
                $localDomestico,
                "tpLograd",
                $this->std->vinculo->infocontrato->localtrabalho->localtrabdom->tplograd,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "dscLograd",
                $this->std->vinculo->infocontrato->localtrabalho->localtrabdom->dsclograd,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "nrLograd",
                $this->std->vinculo->infocontrato->localtrabalho->localtrabdom->nrlograd,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "complemento",
                ! empty($this->std->vinculo->infocontrato->localtrabalho->localtrabdom->complemento) ?
                    $this->std->vinculo->infocontrato->localtrabalho->localtrabdom->complemento : null,
                false
            );
            $this->dom->addChild(
                $localDomestico,
                "bairro",
                ! empty($this->std->vinculo->infocontrato->localtrabalho->localtrabdom->bairro) ?
                    $this->std->vinculo->infocontrato->localtrabalho->localtrabdom->bairro : null,
                false
            );
            $this->dom->addChild(
                $localDomestico,
                "cep",
                $this->std->vinculo->infocontrato->localtrabalho->localtrabdom->cep,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "codMunic",
                $this->std->vinculo->infocontrato->localtrabalho->localtrabdom->codmunic,
                true
            );
            $this->dom->addChild(
                $localDomestico,
                "uf",
                $this->std->vinculo->infocontrato->localtrabalho->localtrabdom->uf,
                true
            );
            $localTrabalho->appendChild($localDomestico);
        }
        $contrato->appendChild($localTrabalho);
        //horContratual (opcional)
        if (isset($this->std->vinculo->infocontrato->horcontatual)) {
            $horContratual = $this->dom->createElement("horContratual");
            $this->dom->addChild(
                $horContratual,
                "qtdHrsSem",
                $this->std->vinculo->infocontrato->horcontratual->qtdhrssem,
                true
            );
            $this->dom->addChild(
                $horContratual,
                "tpJornada",
                $this->std->vinculo->infocontrato->horcontratual->tpjornada,
                true
            );
            $this->dom->addChild(
                $horContratual,
                "dscTpJorn",
                ! empty($this->std->vinculo->infocontrato->horcontratual->dsctpjorn) ?
                    $this->std->vinculo->infocontrato->horcontratual->dsctpjorn : null,
                false
            );
            $this->dom->addChild(
                $horContratual,
                "tmpParc",
                $this->std->vinculo->infocontrato->horcontratual->tmpparc,
                true
            );
            //horario (opcional) ARRAY
            if (isset($this->std->vinculo->infocontrato->horcontratual->horario)) {
                foreach ($this->std->vinculo->infocontrato->horcontratual->horario as $hr) {
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
        if (isset($this->std->vinculo->infocontrato->filiacaosindical)) {
            foreach ($this->std->vinculo->infocontrato->filiacaosindical as $sind) {
                $filiacaoSindical = $this->dom->createElement("filiacaoSindical");
                $this->dom->addChild(
                    $filiacaoSindical,
                    "cnpjSindTrab",
                    $sind->cnpjsindtrab,
                    true
                );
                $contrato->appendChild($filiacaoSindical);
            }
        }
        //alvaraJudicial (opcional)
        if (isset($this->std->vinculo->infocontrato->alvarajudicial)) {
            $alvaraJudicial = $this->dom->createElement("alvaraJudicial");
            $this->dom->addChild(
                $alvaraJudicial,
                "nrProcJud",
                $this->std->vinculo->infocontrato->alvarajudicial->nrprocjud,
                true
            );
            $contrato->appendChild($alvaraJudicial);
        }
        //encerra contrato
        $vinculo->appendChild($contrato);
        //sucessaoVinc (opcional)
        if (isset($this->std->vinculo->sucessaovinc)) {
            $sucessaoVinc = $this->dom->createElement("sucessaoVinc");
            $this->dom->addChild(
                $sucessaoVinc,
                "cnpjEmpregAnt",
                $this->std->vinculo->sucessaovinc->cnpjempregant,
                true
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "matricAnt",
                ! empty($this->std->vinculo->sucessaovinc->matricant) ? $this->std->vinculo->sucessaovinc->matricant : null,
                false
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "dtTransf",
                $this->std->vinculo->sucessaovinc->dttransf,
                true
            );
            $this->dom->addChild(
                $sucessaoVinc,
                "observacao",
                ! empty($this->std->vinculo->sucessaovinc->observacao) ? $this->std->vinculo->sucessaovinc->observacao : null,
                false
            );
            $vinculo->appendChild($sucessaoVinc);
        }
        //Empregado doméstico transferido (opcional)
        if (isset($this->std->vinculo->transfdom)) {
            $transfDom = $this->dom->createElement("transfDom");
            $this->dom->addChild(
                $transfDom,
                "cpfSubstituido",
                $this->std->vinculo->transfdom->cpfsubstituido,
                true
            );
            $this->dom->addChild(
                $transfDom,
                "matricAnt",
                !empty($this->std->vinculo->transfdom->matricant) ? $this->std->vinculo->transfdom->matricant : null,
                false
            );
            $this->dom->addChild(
                $transfDom,
                "dtTransf",
                $this->std->vinculo->transfdom->dttransf,
                true
            );
            $vinculo->appendChild($transfDom);
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
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);;
        $this->sign();
    }
}
