<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtCdBenPrRP Event S-2400 constructor
 * Read for 2.4.2 layout
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

class EvtCdBenPrRP extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtCdBenPrRP';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2400';
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
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate = null
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
        //então cada factory individualmente terá de construir o seu
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
        $this->node->insertBefore($ideEvento, $ideEmpregador);

        $ideBenef = $this->dom->createElement("ideBenef");
        $iben = $this->std->idebenef;
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $iben->cpfbenef,
            true
        );
        $this->dom->addChild(
            $ideBenef,
            "nmBenefic",
            $iben->nmbenefic,
            true
        );
        $this->node->appendChild($ideBenef);
        
        $dadosBenef = $this->dom->createElement("dadosBenef");
        
        $dadosNasc = $this->dom->createElement("dadosNasc");
        $diben = $this->std->idebenef->dadosbenef->dadosnasc;
        $this->dom->addChild(
            $dadosNasc,
            "dtNascto",
            $diben->dtnascto,
            true
        );
        $this->dom->addChild(
            $dadosNasc,
            "codMunic",
            !empty($diben->codmunic) ? $diben->codmunic : null,
            false
        );
        $this->dom->addChild(
            $dadosNasc,
            "uf",
            !empty($diben->uf) ? $diben->uf : null,
            false
        );
        $this->dom->addChild(
            $dadosNasc,
            "paisNascto",
            $diben->paisnascto,
            true
        );
        $this->dom->addChild(
            $dadosNasc,
            "paisNac",
            $diben->paisnac,
            true
        );
        $this->dom->addChild(
            $dadosNasc,
            "nmMae",
            !empty($diben->nmmae) ? $diben->nmmae : null,
            false
        );
        $this->dom->addChild(
            $dadosNasc,
            "nmPai",
            !empty($diben->nmpai) ?
                $diben->nmpai : null,
            false
        );
        $dadosBenef->appendChild($dadosNasc);
        $endereco = $this->dom->createElement("endereco");
        if (isset($this->std->idebenef->dadosbenef->endereco->brasil)) {
            $br = $this->std->idebenef->dadosbenef->endereco->brasil;
            $brasil = $this->dom->createElement("brasil");
            $this->dom->addChild(
                $brasil,
                "tpLograd",
                $br->tplograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $br->dsclograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $br->nrlograd,
                true
            );
            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($br->complemento) ? $br->complemento : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($br->bairro) ? $br->bairro : null,
                false
            );
            $this->dom->addChild(
                $brasil,
                "cep",
                $br->cep,
                true
            );
            $this->dom->addChild(
                $brasil,
                "codMunic",
                $br->codmunic,
                true
            );

            $this->dom->addChild(
                $brasil,
                "uf",
                $br->uf,
                true
            );
            $endereco->appendChild($brasil);
        }

        if (isset($this->std->idebenef->dadosbenef->endereco->exterior)) {
            $ext = $this->std->idebenef->dadosbenef->endereco->exterior;
            $exterior = $this->dom->createElement("exterior");

            $this->dom->addChild(
                $exterior,
                "paisResid",
                $ext->paisresid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $ext->dsclograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $ext->nrlograd,
                true
            );
            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($ext->complemento) ? $ext->complemento : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($ext->bairro) ? $ext->bairro : null,
                false
            );
            $this->dom->addChild(
                $exterior,
                "nmCid",
                $ext->nmcid,
                true
            );
            $this->dom->addChild(
                $exterior,
                "codPostal",
                $ext->codpostal,
                true
            );
            $endereco->appendChild($exterior);
        }
        $dadosBenef->appendChild($endereco);
        $ideBenef->appendChild($dadosBenef);
        $infoBeneficio = $this->dom->createElement("infoBeneficio");
        $this->dom->addChild(
            $infoBeneficio,
            "tpPlanRP",
            $this->std->infobeneficio->tpplanrp,
            true
        );
        $this->node->appendChild($infoBeneficio);
        if (isset($this->std->infobeneficio->inibeneficio)) {
            $iben = $this->std->infobeneficio->inibeneficio;
            $iniBeneficio = $this->dom->createElement("iniBeneficio");
            $this->dom->addChild(
                $iniBeneficio,
                "tpBenef",
                $iben->tpbenef,
                true
            );
            $this->dom->addChild(
                $iniBeneficio,
                "nrBenefic",
                $iben->nrbenefic,
                true
            );
            $this->dom->addChild(
                $iniBeneficio,
                "dtIniBenef",
                $iben->dtinibenef,
                true
            );
            $this->dom->addChild(
                $iniBeneficio,
                "vrBenef",
                $iben->vrbenef,
                true
            );
            if (isset($iben->infopenmorte)) {
                $infoPenMorte = $this->dom->createElement("infoPenMorte");
                $this->dom->addChild(
                    $infoPenMorte,
                    "idQuota",
                    $iben->infopenmorte->idquota,
                    true
                );
                $this->dom->addChild(
                    $infoPenMorte,
                    "cpfInst",
                    $iben->infopenmorte->cpfinst,
                    true
                );
                $iniBeneficio->appendChild($infoPenMorte);
            }
            $infoBeneficio->appendChild($iniBeneficio);
        }

        if (isset($this->std->infobeneficio->altbeneficio)) {
            $iben = $this->std->infobeneficio->altbeneficio;
            $altBeneficio = $this->dom->createElement("altBeneficio");
            $this->dom->addChild(
                $altBeneficio,
                "tpBenef",
                $iben->tpbenef,
                true
            );
            $this->dom->addChild(
                $altBeneficio,
                "nrBenefic",
                $iben->nrbenefic,
                true
            );
            $this->dom->addChild(
                $altBeneficio,
                "dtIniBenef",
                $iben->dtinibenef,
                true
            );
            $this->dom->addChild(
                $altBeneficio,
                "vrBenef",
                $iben->vrbenef,
                true
            );
            if (isset($iben->infopenmorte)) {
                $infoPenMorte = $this->dom->createElement("infoPenMorte");
                $this->dom->addChild(
                    $infoPenMorte,
                    "idQuota",
                    $iben->infopenmorte->idquota,
                    true
                );
                $this->dom->addChild(
                    $infoPenMorte,
                    "cpfInst",
                    $iben->infopenmorte->cpfinst,
                    true
                );
                $altBeneficio->appendChild($infoPenMorte);
            }
            $infoBeneficio->appendChild($altBeneficio);
        }
        if (isset($this->std->infobeneficio->fimbeneficio)) {
            $fim = $this->std->infobeneficio->fimbeneficio;
            $fimBeneficio = $this->dom->createElement("fimBeneficio");
            $this->dom->addChild(
                $fimBeneficio,
                "tpBenef",
                $fim->tpbenef,
                true
            );
            $this->dom->addChild(
                $fimBeneficio,
                "nrBenefic",
                $fim->nrbenefic,
                true
            );
            $this->dom->addChild(
                $fimBeneficio,
                "dtFimBenef",
                $fim->dtfimbenef,
                true
            );
            $this->dom->addChild(
                $fimBeneficio,
                "mtvFim",
                $fim->mtvfim,
                true
            );
            $infoBeneficio->appendChild($fimBeneficio);
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
