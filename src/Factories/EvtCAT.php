<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtCAT Event S-2210 constructor
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

class EvtCAT extends Factory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $evtName = 'evtCAT';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2210';
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
        
        $ideRegistrador = $this->dom->createElement("ideRegistrador");
        $this->dom->addChild(
            $ideRegistrador,
            "tpRegistrador",
            $this->std->tpregistrador,
            true
        );
        $this->dom->addChild(
            $ideRegistrador,
            "tpInsc",
            !empty($this->std->tpinsc) ? $this->std->tpinsc : null,
            false
        );
        $this->dom->addChild(
            $ideRegistrador,
            "nrInsc",
            !empty($this->std->nrinsc) ? $this->std->nrinsc : null,
            false
        );
        $this->node->insertBefore($ideRegistrador, $ideEmpregador);
        
        $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
        $this->dom->addChild(
            $ideTrabalhador,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideTrabalhador,
            "nisTrab",
            !empty($this->std->nistrab) ? $this->std->nistrab : null,
            false
        );
        $this->node->appendChild($ideTrabalhador);

        $cat = $this->dom->createElement("cat");
        $this->dom->addChild(
            $cat,
            "dtAcid",
            $this->std->dtacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "tpAcid",
            $this->std->tpacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "hrAcid",
            $this->std->hracid,
            true
        );
        $this->dom->addChild(
            $cat,
            "hrsTrabAntesAcid",
            $this->std->hrstrabantesacid,
            true
        );
        $this->dom->addChild(
            $cat,
            "tpCat",
            $this->std->tpcat,
            true
        );
        $this->dom->addChild(
            $cat,
            "indCatObito",
            $this->std->indcatobito,
            true
        );
        $this->dom->addChild(
            $cat,
            "dtObito",
            !empty($this->std->dtobito) ? $this->std->dtobito : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "indComunPolicia",
            $this->std->indcomunpolicia,
            true
        );
        $this->dom->addChild(
            $cat,
            "codSitGeradora",
            !empty($this->std->codsitgeradora) ? $this->std->codsitgeradora : null,
            false
        );
        $this->dom->addChild(
            $cat,
            "iniciatCAT",
            $this->std->iniciatcat,
            true
        );
        $this->dom->addChild(
            $cat,
            "observacao",
            !empty($this->std->observacao) ? $this->std->observacao : null,
            false
        );
        $localAcidente = $this->dom->createElement("localAcidente");
        $this->dom->addChild(
            $localAcidente,
            "tpLocal",
            $this->std->tplocal,
            true
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLocal",
            !empty($this->std->dsclocal) ? $this->std->dsclocal : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "dscLograd",
            !empty($this->std->dsclograd) ? $this->std->dsclograd : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "nrLograd",
            !empty($this->std->nrlograd) ? $this->std->nrlograd : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codMunic",
            !empty($this->std->codmunic) ? $this->std->codmunic : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "uf",
            !empty($this->std->uf) ? $this->std->uf : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "cnpjLocalAcid",
            !empty($this->std->cnpjlocalacid) ? $this->std->cnpjlocalacid : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "pais",
            !empty($this->std->pais) ? $this->std->pais : null,
            false
        );
        $this->dom->addChild(
            $localAcidente,
            "codPostal",
            !empty($this->std->codpostal) ? $this->std->codpostal : null,
            false
        );
        $cat->appendChild($localAcidente);
        
        foreach ($this->std->parteatingida as $pa) {
            $parteAtingida = $this->dom->createElement("parteAtingida");
            $this->dom->addChild(
                $parteAtingida,
                "codParteAting",
                $pa->codparteating,
                true
            );
            $this->dom->addChild(
                $parteAtingida,
                "lateralidade",
                $pa->lateralidade,
                true
            );
            $cat->appendChild($parteAtingida);
        }

        foreach ($this->std->agentecausador as $pa) {
            $agenteCausador = $this->dom->createElement("agenteCausador");
            $this->dom->addChild(
                $agenteCausador,
                "codAgntCausador",
                $pa->codagntcausador,
                true
            );
            $cat->appendChild($agenteCausador);
        }
        if (!empty($this->std->atestado)) {
            $pa = $this->std->atestado;
            $atestado = $this->dom->createElement("atestado");
            $this->dom->addChild(
                $atestado,
                "codCNES",
                !empty($pa->codcnes) ? $pa->codcnes : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "dtAtendimento",
                $pa->dtatendimento,
                true
            );
            $this->dom->addChild(
                $atestado,
                "hrAtendimento",
                $pa->hratendimento,
                true
            );
            $this->dom->addChild(
                $atestado,
                "indInternacao",
                $pa->indinternacao,
                true
            );
            $this->dom->addChild(
                $atestado,
                "durTrat",
                $pa->durtrat,
                true
            );
            $this->dom->addChild(
                $atestado,
                "indAfast",
                $pa->indafast,
                true
            );
            $this->dom->addChild(
                $atestado,
                "dscLesao",
                !empty($pa->dsclesao) ? $pa->dsclesao : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "dscCompLesao",
                !empty($pa->dsccomplesao) ? $pa->dsccomplesao : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "diagProvavel",
                !empty($pa->diagprovavel) ? $pa->diagprovavel : null,
                false
            );
            $this->dom->addChild(
                $atestado,
                "codCID",
                $pa->codcid,
                true
            );
            $this->dom->addChild(
                $atestado,
                "observacao",
                !empty($pa->observacao) ? $pa->observacao : null,
                false
            );
            $emitente = $this->dom->createElement("emitente");
            $this->dom->addChild(
                $emitente,
                "nmEmit",
                $pa->nmemit,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ideOC",
                $pa->ideoc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "nrOc",
                $pa->nroc,
                true
            );
            $this->dom->addChild(
                $emitente,
                "ufOC",
                !empty($pa->ufoc) ? $pa->ufoc : null,
                true
            );
            $atestado->appendChild($emitente);
            $cat->appendChild($atestado);
        }
        if (!empty($this->std->catorigem)) {
            $pa = $this->std->catorigem;
            $catOrigem = $this->dom->createElement("catOrigem");
            $this->dom->addChild(
                $catOrigem,
                "dtCatOrig",
                $pa->dtcatorig,
                true
            );
            $this->dom->addChild(
                $catOrigem,
                "nrCatOrig",
                !empty($pa->nrcatorig) ? $pa->nrcatorig : null,
                false
            );
            $cat->appendChild($catOrigem);
        }
        $this->node->appendChild($cat);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
