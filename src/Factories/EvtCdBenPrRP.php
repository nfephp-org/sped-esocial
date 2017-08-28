<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtCdBenPrRP Event S-2400 constructor
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

        $evtCdBenPrRP = $this->dom->createElement("evtCdBenPrRP");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtCdBenPrRP->appendChild($att);

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

        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->idebenef->cpfbenef,
            true
        );

        $this->dom->addChild(
            $ideBenef,
            "nmBenefic",
            $this->std->idebenef->nmbenefic,
            true
        );

        $this->node->appendChild($ideBenef);

        $dadosBenef = $this->dom->createElement("dadosBenef");

        $this->dom->addChild(
            $dadosBenef,
            "cpfBenef",
            $this->std->idebenef->dadosbenef->cpfbenef,
            true
        );

        $this->dom->addChild(
            $dadosBenef,
            "nmBenefic",
            $this->std->idebenef->dadosbenef->nmbenefic,
            true
        );

        $dadosNasc = $this->dom->createElement("dadosNasc");

        $this->dom->addChild(
            $dadosNasc,
            "dtNascto",
            $this->std->idebenef->dadosbenef->dadosnasc->dtnascto,
            true
        );

        $this->dom->addChild(
            $dadosNasc,
            "codMunic",
            !empty($this->std->idebenef->dadosbenef->dadosnasc->codmunic) ?
                $this->std->idebenef->dadosbenef->dadosnasc->codmunic : null,
            false
        );

        $this->dom->addChild(
            $dadosNasc,
            "uf",
            !empty($this->std->idebenef->dadosbenef->dadosnasc->uf) ?
                $this->std->idebenef->dadosbenef->dadosnasc->uf : null,
            false
        );

        $this->dom->addChild(
            $dadosNasc,
            "paisNascto",
            $this->std->idebenef->dadosbenef->dadosnasc->paisnascto,
            true
        );

        $this->dom->addChild(
            $dadosNasc,
            "paisNac",
            $this->std->idebenef->dadosbenef->dadosnasc->paisnac,
            true
        );

        $this->dom->addChild(
            $dadosNasc,
            "nmMae",
            !empty($this->std->idebenef->dadosbenef->dadosnasc->nmmae) ?
                $this->std->idebenef->dadosbenef->dadosnasc->nmmae : null,
            false
        );

        $this->dom->addChild(
            $dadosNasc,
            "nmPai",
            !empty($this->std->idebenef->dadosbenef->dadosnasc->nmpai) ?
                $this->std->idebenef->dadosbenef->dadosnasc->nmpai : null,
            false
        );

        $dadosBenef->appendChild($dadosNasc);

        $endereco = $this->dom->createElement("endereco");

        if (isset($this->std->idebenef->dadosbenef->endereco->brasil)) {

            $brasil = $this->dom->createElement("brasil");

            $this->dom->addChild(
                $brasil,
                "tpLograd",
                $this->std->idebenef->dadosbenef->endereco->brasil->tplograd,
                true
            );

            $this->dom->addChild(
                $brasil,
                "dscLograd",
                $this->std->idebenef->dadosbenef->endereco->brasil->dsclograd,
                true
            );

            $this->dom->addChild(
                $brasil,
                "nrLograd",
                $this->std->idebenef->dadosbenef->endereco->brasil->nrlograd,
                true
            );

            $this->dom->addChild(
                $brasil,
                "complemento",
                !empty($this->std->idebenef->dadosbenef->endereco->brasil->complemento) ?
                    $this->std->idebenef->dadosbenef->endereco->brasil->complemento : null,
                false
            );

            $this->dom->addChild(
                $brasil,
                "bairro",
                !empty($this->std->idebenef->dadosbenef->endereco->brasil->bairro) ?
                    $this->std->idebenef->dadosbenef->endereco->brasil->bairro : null,
                false
            );

            $this->dom->addChild(
                $brasil,
                "cep",
                $this->std->idebenef->dadosbenef->endereco->brasil->cep,
                true
            );

            $this->dom->addChild(
                $brasil,
                "codMunic",
                $this->std->idebenef->dadosbenef->endereco->brasil->codmunic,
                true
            );

            $this->dom->addChild(
                $brasil,
                "uf",
                $this->std->idebenef->dadosbenef->endereco->brasil->uf,
                true
            );

            $endereco->appendChild($brasil);
        }

        if (isset($this->std->idebenef->dadosbenef->endereco->exterior)) {

            $exterior = $this->dom->createElement("exterior");

            $this->dom->addChild(
                $exterior,
                "tpLograd",
                $this->std->idebenef->dadosbenef->endereco->exterior->tplograd,
                true
            );

            $this->dom->addChild(
                $exterior,
                "dscLograd",
                $this->std->idebenef->dadosbenef->endereco->exterior->dsclograd,
                true
            );

            $this->dom->addChild(
                $exterior,
                "nrLograd",
                $this->std->idebenef->dadosbenef->endereco->exterior->nrlograd,
                true
            );

            $this->dom->addChild(
                $exterior,
                "complemento",
                !empty($this->std->idebenef->dadosbenef->endereco->exterior->complemento) ?
                    $this->std->idebenef->dadosbenef->endereco->exterior->complemento : null,
                false
            );

            $this->dom->addChild(
                $exterior,
                "bairro",
                !empty($this->std->idebenef->dadosbenef->endereco->exterior->bairro) ?
                    $this->std->idebenef->dadosbenef->endereco->exterior->bairro : null,
                false
            );

            $this->dom->addChild(
                $exterior,
                "cep",
                $this->std->idebenef->dadosbenef->endereco->exterior->cep,
                true
            );

            $this->dom->addChild(
                $exterior,
                "codMunic",
                $this->std->idebenef->dadosbenef->endereco->exterior->codmunic,
                true
            );

            $this->dom->addChild(
                $exterior,
                "uf",
                $this->std->idebenef->dadosbenef->endereco->exterior->uf,
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
            $iniBeneficio = $this->dom->createElement("iniBeneficio");

            $this->dom->addChild(
                $iniBeneficio,
                "tpBenef",
                $this->std->infobeneficio->inibeneficio->tpbenef,
                true
            );

            $this->dom->addChild(
                $iniBeneficio,
                "nrBenefic",
                $this->std->infobeneficio->inibeneficio->nrbenefic,
                true
            );

            $this->dom->addChild(
                $iniBeneficio,
                "dtIniBenef",
                $this->std->infobeneficio->inibeneficio->dtinibenef,
                true
            );

            $this->dom->addChild(
                $iniBeneficio,
                "vrBenef",
                $this->std->infobeneficio->inibeneficio->vrbenef,
                true
            );

            if (isset($this->std->infobeneficio->inibeneficio->infopenmorte)) {
                $infoPenMorte = $this->dom->createElement("infoPenMorte");

                $this->dom->addChild(
                    $infoPenMorte,
                    "idQuota",
                    $this->std->infobeneficio->inibeneficio->infopenmorte->idquota,
                    true
                );

                $this->dom->addChild(
                    $infoPenMorte,
                    "cpfInst",
                    $this->std->infobeneficio->inibeneficio->infopenmorte->cpfinst,
                    true
                );

                $iniBeneficio->appendChild($infoPenMorte);
            }

            $infoBeneficio->appendChild($iniBeneficio);
        }

        if (isset($this->std->infobeneficio->altbeneficio)) {
            $altBeneficio = $this->dom->createElement("altBeneficio");

            $this->dom->addChild(
                $altBeneficio,
                "tpBenef",
                $this->std->infobeneficio->altbeneficio->tpbenef,
                true
            );

            $this->dom->addChild(
                $altBeneficio,
                "nrBenefic",
                $this->std->infobeneficio->altbeneficio->nrbenefic,
                true
            );

            $this->dom->addChild(
                $altBeneficio,
                "dtIniBenef",
                $this->std->infobeneficio->altbeneficio->dtinibenef,
                true
            );

            $this->dom->addChild(
                $altBeneficio,
                "vrBenef",
                $this->std->infobeneficio->altbeneficio->vrbenef,
                true
            );

            if (isset($this->std->infobeneficio->altbeneficio->infopenmorte)) {
                $infoPenMorte = $this->dom->createElement("infoPenMorte");

                $this->dom->addChild(
                    $infoPenMorte,
                    "idQuota",
                    $this->std->infobeneficio->altbeneficio->infopenmorte->idquota,
                    true
                );

                $this->dom->addChild(
                    $infoPenMorte,
                    "cpfInst",
                    $this->std->infobeneficio->altbeneficio->infopenmorte->cpfinst,
                    true
                );

                $altBeneficio->appendChild($infoPenMorte);
            }

            $infoBeneficio->appendChild($altBeneficio);
        }

        if (isset($this->std->infobeneficio->fimbeneficio)) {
            $fimBeneficio = $this->dom->createElement("fimBeneficio");

            $this->dom->addChild(
                $fimBeneficio,
                "tpBenef",
                $this->std->infobeneficio->fimbeneficio->tpbenef,
                true
            );

            $this->dom->addChild(
                $fimBeneficio,
                "nrBenefic",
                $this->std->infobeneficio->fimbeneficio->nrbenefic,
                true
            );

            $this->dom->addChild(
                $fimBeneficio,
                "dtFimBenef",
                $this->std->infobeneficio->fimbeneficio->dtfimbenef,
                true
            );

            $this->dom->addChild(
                $fimBeneficio,
                "mtvFim",
                $this->std->infobeneficio->fimbeneficio->mtvfim,
                true
            );

            $infoBeneficio->appendChild($fimBeneficio);
        }

        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
