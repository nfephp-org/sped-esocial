<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtConvInterm Event S-2260 constructor
 * Read for 2.5.0 layout
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2018
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

class EvtConvInterm extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtConvInterm';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2260';
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
        $ideVinculo = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->idevinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            $this->std->idevinculo->nistrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->idevinculo->matricula,
            true
        );
        $this->node->appendChild($ideVinculo);
        
        $i = $this->std->infoconvinterm;
        $info = $this->dom->createElement("infoConvInterm");
        $this->dom->addChild(
            $info,
            "codConv",
            $i->codconv,
            true
        );
        $this->dom->addChild(
            $info,
            "dtInicio",
            $i->dtinicio,
            true
        );
        $this->dom->addChild(
            $info,
            "dtFim",
            $i->dtfim,
            true
        );
        $this->dom->addChild(
            $info,
            "dtPrevPgto",
            $i->dtprevpgto,
            true
        );
        $jornada = $this->dom->createElement("jornada");
        $this->dom->addChild(
            $jornada,
            "codHorContrat",
            !empty($i->jornada->codhorcontrat) ? $i->jornada->codhorcontrat : null,
            false
        );
        $this->dom->addChild(
            $jornada,
            "dscJornada",
            !empty($i->jornada->dscjornada) ? $i->jornada->dscjornada : null,
            false
        );
        $info->appendChild($jornada);
        
        $localTrab = $this->dom->createElement("localTrab");
        $this->dom->addChild(
            $localTrab,
            "indLocal",
            $i->localtrab->indlocal,
            true
        );
        if (!empty($i->localtrab->localtrabinterm)) {
            $l = $i->localtrab->localtrabinterm;
            $local = $this->dom->createElement("localTrabInterm");
            $this->dom->addChild(
                $local,
                "tpLograd",
                $l->tplograd,
                true
            );
            $this->dom->addChild(
                $local,
                "dscLograd",
                $l->dsclograd,
                true
            );
            $this->dom->addChild(
                $local,
                "nrLograd",
                $l->nrlograd,
                true
            );
            $this->dom->addChild(
                $local,
                "complem",
                !empty($l->complem) ? $l->complem : null,
                false
            );
            $this->dom->addChild(
                $local,
                "bairro",
                !empty($l->bairro) ? $l->bairro : null,
                false
            );
            $this->dom->addChild(
                $local,
                "cep",
                $l->cep,
                true
            );
            $this->dom->addChild(
                $local,
                "codMunic",
                $l->codmunic,
                true
            );
            $this->dom->addChild(
                $local,
                "uf",
                $l->uf,
                true
            );
            $localTrab->appendChild($local);
        }
        $info->appendChild($localTrab);
        $this->node->appendChild($info);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
