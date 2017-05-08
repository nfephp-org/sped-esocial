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

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use NFePHP\eSocial\Factories\FactoryId;
use NFePHP\Common\Certificate;
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
        //o idEvento pode variar de evento para evento
        $ideEvento = $this->dom->createElement("ideEvento");
        $this->dom->addChild(
            $ideEvento,
            "indRetif",
            $this->std->indRetif,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "nrRecibo",
            $this->std->nrRecibo,
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
        
        //tags deste evento em particular
        
        //trabalhador (obrigatório)
        $trabalhador = $this->dom->createElement("trabalhador");
        $this->dom->addChild(
            $trabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nisTrab",
            $this->std->nistrab,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "nmTrab",
            $this->std->nmtrab,
            true
        );        
        $this->dom->addChild(
            $trabalhador,
            "sexo",
            $this->std->sexo,
            true
        );
        $this->dom->addChild(
            $trabalhador,
            "racaCor",
            $this->std->racacor,
            true
        );        
        $this->dom->addChild(
            $trabalhador,
            "estCiv",
            $this->std->estciv,
            false
        );        
        $this->dom->addChild(
            $trabalhador,
            "grauInstr",
            $this->std->grauinstr,
            true
        );        
        $this->dom->addChild(
            $trabalhador,
            "indPriEmpr",
            $this->std->indpriempr,
            true
        );        
        $this->dom->addChild(
            $trabalhador,
            "nmSoc",
            $this->std->nmsoc,
            false
        );
        
        //nascimento (obrigatorio)
        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->dtnascto,
            true
        );        
        $this->dom->addChild(
            $nascimento,
            "codMunic",
            $this->std->codmunic,
            false
        );        
        $this->dom->addChild(
            $nascimento,
            "uf",
            $this->std->uf,
            false
        );        
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->paisnascto,
            true
        );        
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->paisnac,
            true
        );        
        $this->dom->addChild(
            $nascimento,
            "nmMae",
            $this->std->nmmae,
            false
        );        
        $this->dom->addChild(
            $nascimento,
            "nmPai",
            $this->std->nmpai,
            false
        );
        //encerra nascimento        
        $trabalhador->appendChild($nascimento);
        
        //documentos (obrig)
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
        //RIC (Opc)
        if (isset($this->std->ric)) {
            $ric = $this->dom->createElement("RIC");
            $this->dom->addChild(
                $ctps,
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
                $this->std->ric->dtexped,
                true
            );        
            $documentos->appendChild($ric);
        }
        //RG
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
                $this->std->rg->dtexped,
                true
            );
            $documentos->appendChild($rg);
        }
        //RNE (Opc)
        if (isset($this->std->rne)) {
            $rne = $this->dom->createElement("RNE");
            $this->dom->addChild(
                $rne,
                "nrRg",
                $this->std->rne->nrrg,
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
                $this->std->rne->dtexped,
                true
            );
            $documentos->appendChild($rne);
        }
        //OC (Opc)
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
                $this->std->oc->dtexped,
                true
            );
            if (!empty($this->std->oc->dtvalid)) {
                $this->dom->addChild(
                    $oc,
                    "dtValid",
                    $this->std->oc->dtvalid,
                    false
                );
            }
            $documentos->appendChild($oc);
        }
        //CNH (Ops)
        if (isset($this->std->cnh)) {
            $cnh = $this->dom->createElement("CNH");
            $this->dom->addChild(
                $cnh,
                "dtExped",
                $this->std->cnh->nrregcnh,
                true
            );
            $this->dom->addChild(
                $cnh,
                "dtExped",
                $this->std->cnh->dtExped,
                true
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
                $this->std->cnh->dtprihab,
                true
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
        
        //Endereço (obrigatorio)
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
                "nrLograd",
                $this->std->endereco->brasil->complemento,
                true
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                $this->std->endereco->brasil->bairro,
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
                "paisResid",
                $this->std->endereco->exterior->complemento,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                $this->std->endereco->exterior->bairro,
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
                $this->std->endereco->exterior->codpostal,
                false
            );
            $endereco->appendChild($exterior);
        }
        //encerra endereço
        $trabalhador->appendChild($endereco);
        
        //deficiencia (opcional)
        if (isset($this->std->deficiencia)) {
            $deficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $deficiencia,
                "defFisica",
                $this->std->deficiencia->deffisica,
                false
            );
            $this->dom->addChild(
                $deficiencia,
                "defVisual",
                $this->std->deficiencia->defvisual,
                false
            );
            $this->dom->addChild(
                $deficiencia,
                "defAuditiva",
                $this->std->deficiencia->defauditiva,
                false
            );
            $this->dom->addChild(
                $deficiencia,
                "defMental",
                $this->std->deficiencia->defmental,
                false
            );
            $this->dom->addChild(
                $deficiencia,
                "defIntelectual",
                $this->std->deficiencia->defintelectual,
                false
            );
            $this->dom->addChild(
                $deficiencia,
                "reabReadap",
                $this->std->deficiencia->reabreadap,
                false
            );
            
            $this->dom->addChild(
                $deficiencia,
                "infoCota",
                $this->std->deficiencia->infocota,
                false
            );
            $this->dom->addChild(
                $deficiencia,
                "observacao",
                $this->std->deficiencia->observacao,
                false
            );
            $trabalhador->appendChild($deficiencia);
        }
        //dependente (opcional) (ARRAY)
        if (isset($this->std->dependente)) {
            foreach($this->std->dependente as $dep) {
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
                    $dep->cpfdep,
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
                    "depPlan",
                    $dep->depplan,
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
                $dep->trabaposent,
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
                $this->std->contato->foneprinc,
                false
            );
            $this->dom->addChild(
                $contato,
                "foneAlternat",
                $this->std->contato->fonealternat,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                $this->std->contato->emailprinc,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailAlternat",
                $this->std->contato->emailalternat,
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
            $this->std->vinculo->nrRecInfPrelim,
            false
        );
        //infoRegimeTrab (obrigatorio)
        $infoRegimeTrab = $this->dom->createElement("$infoRegimeTrab");
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
                $this->std->vinculo->celetista->dtbase,
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
                $this->std->vinculo->celetista->dtopcfgts,
                true
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
                $this->std->vinculo->estatutario->tpplanrp,
                false
            );                                                
            //infoDecJud (opcional)
            if (isset($this->std->vinculo->estatutario->judicial)) {
                $infoDecJud = $this->dom->createElement("infoDecJud"); 
                $this->dom->addChild(
                    $infoDecJud,
                    "nrProcJud",
                    $this->std->vinculo->estatutario->nrprocjud,
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
             $this->std->vinculo->contrato->codcargo,
             false
        );  
        $this->dom->addChild(
            $contrato,
            "codFuncao",
             $this->std->vinculo->contrato->codfuncao,
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
             $this->std->vinculo->contrato->codcarreira,
             false
        );  
        $this->dom->addChild(
            $contrato,
            "dtIngrCarr",
             $this->std->vinculo->contrato->dtingrcarr,
             false
        );  
        //remuneracao (obrigatorio)
        $remuneracao = $this->dom->createElement("remuneracao");
        $this->dom->addChild(
            $remuneracao,
            "vrSalFx",
             $this->std->vinculo->contrato->vrsalfx,
             false
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
             $this->std->vinculo->contrato->dscsalvar,
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
             $this->std->vinculo->contrato->dtterm,
             false
        );  
        $contrato->appendChild($duracao);
        
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
                $this->std->vinculo->contrato->local->desccomp,
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
                $this->std->vinculo->contrato->domestico->complemento,
                false
            );  
            $this->dom->addChild(
                $localDomestico,
                "bairro",
                $this->std->vinculo->contrato->domestico->bairro,
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
                $this->std->vinculo->contrato->horcontratual->dsctpjorn,
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
                foreach($this->std->vinculo->contrato->horcontratual->horario as $hr) {
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
            foreach($this->std->vinculo->contrato->filiacaosindical as $sind) {
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
                $this->std->vinculo->sucessao->matricant,
                true
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
                $this->std->vinculo->sucessao->observacao,
                true
            );                              
            //afastamento (opcional)
            if (isset($this->std->vinculo->sucessao->afastamento)) {
                $afastamento = $this->dom->createElement("afastamento");
                $this->dom->addChild(
                    $afastamento,
                    "dtIniAfast",
                    $this->std->vinculo->sucessao->afastamento->dtiniafast,
                    true
                );                              
                $this->dom->addChild(
                    $afastamento,
                    "codMotAfast",
                    $this->std->vinculo->sucessao->afastamento->codmotafast,
                    true
                );                              
                $sucessaoVinc->appendChild($afastamento);
            }
            
            $vinculo->appendChild($sucessaoVinc);
        }
        
        //encerra vinculo
        $this->node->appendChild($vinculo);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
