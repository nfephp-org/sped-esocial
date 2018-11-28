<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtAltCadastral Event S-2205 constructor
 * Read for 2.4.2 layout
 * Read for 2.5.0 layout
 *
 * @category  library
 * @package   NFePHP\eSocial
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

class EvtAltCadastral extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtAltCadastral';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2205';
    /**
     * Parameters patterns
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * Constructor
     *
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate | null
     * @param string $date
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate = null,
        $date = ''
    ) {
        parent::__construct($config, $std, $certificate, $date);
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
        $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ideTrabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->node->appendChild($ideTrabalhador);
        $alteracao = $this->dom->createElement("alteracao");
        $this->dom->addChild(
            $alteracao,
            "dtAlteracao",
            $this->std->dtalteracao,
            true
        );
        $dadosTrabalhador = $this->dom->createElement("dadosTrabalhador");
        $this->dom->addChild(
            $dadosTrabalhador,
            "nisTrab",
            !empty($this->std->nistrab) ? $this->std->nistrab : null,
            false
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "nmTrab",
            $this->std->nmtrab,
            true
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "sexo",
            $this->std->sexo,
            true
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "racaCor",
            $this->std->racacor,
            true
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "estCiv",
            !empty($this->std->estciv) ? $this->std->estciv : null,
            false
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "grauInstr",
            $this->std->grauinstr,
            true
        );
        $this->dom->addChild(
            $dadosTrabalhador,
            "nmSoc",
            !empty($this->std->nmsoc) ? $this->std->nmsoc : null,
            false
        );
        $nascimento = $this->dom->createElement("nascimento");
        $this->dom->addChild(
            $nascimento,
            "dtNascto",
            $this->std->nascimento->dtnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "codMunic",
            !empty($this->std->nascimento->codmunic) ? $this->std->nascimento->codmunic : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "uf",
            !empty($this->std->nascimento->uf) ? $this->std->nascimento->uf : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "paisNascto",
            $this->std->nascimento->paisnascto,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "paisNac",
            $this->std->nascimento->paisnac,
            true
        );
        $this->dom->addChild(
            $nascimento,
            "nmMae",
            !empty($this->std->nascimento->nmmae) ? $this->std->nascimento->nmmae : null,
            false
        );
        $this->dom->addChild(
            $nascimento,
            "nmPai",
            !empty($this->std->nascimento->nmpai) ? $this->std->nascimento->nmpai : null,
            false
        );
        $dadosTrabalhador->appendChild($nascimento);
        $documentos = null;
        if (!empty($this->std->ctps)) {
            $ct = $this->std->ctps;
            $documentos = $this->dom->createElement("documentos");
            $CTPS = $this->dom->createElement("CTPS");
            $this->dom->addChild(
                $CTPS,
                "nrCtps",
                $ct->nrctps,
                true
            );
            $this->dom->addChild(
                $CTPS,
                "serieCtps",
                $ct->seriectps,
                true
            );
            $this->dom->addChild(
                $CTPS,
                "ufCtps",
                $ct->ufctps,
                true
            );
            $documentos->appendChild($CTPS);
        }
        if (!empty($this->std->ric)) {
            $ct = $this->std->ric;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $RIC = $this->dom->createElement("RIC");
            $this->dom->addChild(
                $RIC,
                "nrRic",
                $ct->nrric,
                true
            );
            $this->dom->addChild(
                $RIC,
                "orgaoEmissor",
                $ct->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $RIC,
                "dtExped",
                !empty($ct->dtexped) ? $ct->dtexped : null,
                false
            );
            $documentos->appendChild($RIC);
        }
        if (!empty($this->std->rg)) {
            $ct = $this->std->rg;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $RG = $this->dom->createElement("RG");
            $this->dom->addChild(
                $RG,
                "nrRg",
                $ct->nrrg,
                true
            );
            $this->dom->addChild(
                $RG,
                "orgaoEmissor",
                $ct->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $RG,
                "dtExped",
                !empty($ct->dtexped) ? $ct->dtexped : null,
                false
            );
            $documentos->appendChild($RG);
        }
        if (!empty($this->std->rne)) {
            $ct = $this->std->rne;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $RNE = $this->dom->createElement("RNE");
            $this->dom->addChild(
                $RNE,
                "nrRne",
                $ct->nrrne,
                true
            );
            $this->dom->addChild(
                $RNE,
                "orgaoEmissor",
                $ct->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $RNE,
                "dtExped",
                !empty($ct->dtexped) ? $ct->dtexped : null,
                false
            );
            $documentos->appendChild($RNE);
        }
        if (!empty($this->std->oc)) {
            $ct = $this->std->oc;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $OC = $this->dom->createElement("OC");
            $this->dom->addChild(
                $OC,
                "nrOc",
                $ct->nroc,
                true
            );
            $this->dom->addChild(
                $OC,
                "orgaoEmissor",
                $ct->orgaoemissor,
                true
            );
            $this->dom->addChild(
                $OC,
                "dtExped",
                !empty($ct->dtexped) ? $ct->dtexped : null,
                false
            );
            $this->dom->addChild(
                $OC,
                "dtValid",
                !empty($ct->dtvalid) ? $ct->dtvalid : null,
                false
            );
            $documentos->appendChild($OC);
        }
        if (!empty($this->std->cnh)) {
            $ct = $this->std->cnh;
            if (is_null($documentos)) {
                $documentos = $this->dom->createElement("documentos");
            }
            $CNH = $this->dom->createElement("CNH");
            $this->dom->addChild(
                $CNH,
                "nrRegCnh",
                $ct->nrregcnh,
                true
            );
            $this->dom->addChild(
                $CNH,
                "dtExped",
                !empty($ct->dtexped) ? $ct->dtexped : null,
                false
            );
            $this->dom->addChild(
                $CNH,
                "ufCnh",
                $ct->ufcnh,
                true
            );
            $this->dom->addChild(
                $CNH,
                "dtValid",
                $ct->dtvalid,
                true
            );
            $this->dom->addChild(
                $CNH,
                "dtPriHab",
                !empty($ct->dtprihab) ? $ct->dtprihab : null,
                false
            );
            $this->dom->addChild(
                $CNH,
                "categoriaCnh",
                $ct->categoriacnh,
                true
            );
            $documentos->appendChild($CNH);
        }
        if (!is_null($documentos)) {
            $dadosTrabalhador->appendChild($documentos);
        }
        
        $endereco = $this->dom->createElement("endereco");
        if (!empty($this->std->brasil)) {
            $ct = $this->std->brasil;
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                $ct->tplograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $ct->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $ct->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($ct->complemento) ? $ct->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($ct->bairro) ? $ct->bairro : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $ct->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $ct->codmunic,
                true
            );
            $this->dom->addChild(
                $brasil,
                "uf",
                $ct->uf,
                true
            );
            $endereco->appendChild($brasil);
        } elseif (!empty($this->std->exterior)) {
            $ct = $this->std->exterior;
            $exterior = $this->dom->createElement("exterior");
            $this->dom->addChild(
                $exterior,
                "paisResid",
                $ct->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $ct->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $ct->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($ct->complemento) ? $ct->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($ct->bairro) ? $ct->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $ct->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                !empty($ct->codpostal) ? $ct->codpostal : null,
                false
            );
            $endereco->appendChild($exterior);
        }
        $dadosTrabalhador->appendChild($endereco);
        
        if (!empty($this->std->trabestrangeiro)) {
            $ct = $this->std->trabestrangeiro;
            $trabEstrangeiro = $this->dom->createElement("trabEstrangeiro");
            $this->dom->addChild(
                $trabEstrangeiro,
                "dtChegada",
                $ct->dtchegada,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "classTrabEstrang",
                $ct->classtrabestrang,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "casadoBr",
                $ct->casadobr,
                true
            );
            $this->dom->addChild(
                $trabEstrangeiro,
                "filhosBr",
                $ct->filhosbr,
                true
            );
            $dadosTrabalhador->appendChild($trabEstrangeiro);
        }
        
        if (!empty($this->std->infodeficiencia)) {
            $ct = $this->std->infodeficiencia;
            $infoDeficiencia = $this->dom->createElement("infoDeficiencia");
            $this->dom->addChild(
                $infoDeficiencia,
                "defFisica",
                $ct->deffisica,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defVisual",
                $ct->defvisual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defAuditiva",
                $ct->defauditiva,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defMental",
                $ct->defmental,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "defIntelectual",
                $ct->defintelectual,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "reabReadap",
                $ct->reabreadap,
                true
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "infoCota",
                !empty($ct->infocota) ? $ct->infocota : null,
                false
            );
            $this->dom->addChild(
                $infoDeficiencia,
                "observacao",
                !empty($ct->observacao) ? $ct->observacao : null,
                false
            );
            $dadosTrabalhador->appendChild($infoDeficiencia);
        }
        
        if (!empty($this->std->dependente)) {
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
                $dadosTrabalhador->appendChild($dependente);
            }
        }
        
        if (!empty($this->std->aposentadoria)) {
            $aposentadoria = $this->dom->createElement("aposentadoria");
            $this->dom->addChild(
                $aposentadoria,
                "trabAposent",
                $this->std->aposentadoria->trabaposent,
                true
            );
            $dadosTrabalhador->appendChild($aposentadoria);
        }
        
        if (!empty($this->std->contato)) {
            $ct = $this->std->contato;
            $contato = $this->dom->createElement("contato");
            $this->dom->addChild(
                $contato,
                "fonePrinc",
                !empty($ct->foneprinc) ? $ct->foneprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "foneAlternat",
                !empty($ct->fonealternat) ? $ct->fonealternat : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailPrinc",
                !empty($ct->emailprinc) ? $ct->emailprinc : null,
                false
            );
            $this->dom->addChild(
                $contato,
                "emailAlternat",
                !empty($ct->emailalternat) ? $ct->emailalternat : null,
                false
            );
            $dadosTrabalhador->appendChild($contato);
        }
        
        $alteracao->appendChild($dadosTrabalhador);
        
        $this->node->appendChild($alteracao);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);;
        $this->sign();
    }
}
