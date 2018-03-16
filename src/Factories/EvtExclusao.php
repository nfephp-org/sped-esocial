<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtExclusao Event S-3000 constructor
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

class EvtExclusao extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtExclusao';
    /**
     * @var string
     */
    protected $evtAlias = 'S-3000';
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
        //o idEvento pode variar de evento para evento
        //então cada factory individualmente terá de construir o seu
        $ideEvento = $this->dom->createElement("ideEvento");
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

        $infoExclusao = $this->dom->createElement("infoExclusao");
        $this->dom->addChild(
            $infoExclusao,
            "tpEvento",
            $this->std->infoexclusao->tpevento,
            true
        );
        $this->dom->addChild(
            $infoExclusao,
            "nrRecEvt",
            $this->std->infoexclusao->nrrecevt,
            true
        );
        if (! empty($this->std->idetrabalhador)) {
            $ideTrabalhador = $this->dom->createElement("ideTrabalhador");
            $this->dom->addChild(
                $ideTrabalhador,
                "cpfTrab",
                $this->std->idetrabalhador->cpftrab,
                true
            );
            $this->dom->addChild(
                $ideTrabalhador,
                "nisTrab",
                ! empty($this->std->idetrabalhador->nistrab) ? $this->std->idetrabalhador->nistrab : null,
                false
            );
            $infoExclusao->appendChild($ideTrabalhador);
        }
        $ideFolhaPagto = $this->dom->createElement("ideFolhaPagto");
        $this->dom->addChild(
            $ideFolhaPagto,
            "indApuracao",
            $this->std->idefolhapagto->indapuracao,
            true
        );
        $this->dom->addChild(
            $ideFolhaPagto,
            "perApur",
            $this->std->idefolhapagto->perapur,
            true
        );
        $infoExclusao->appendChild($ideFolhaPagto);
        $this->node->appendChild($infoExclusao);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
