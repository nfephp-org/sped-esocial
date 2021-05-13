<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtReintegr Event S-2298 constructor

 * READ for 2.5.0 layout
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
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

class EvtReintegr extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtReintegr';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2298';
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
        //nodes do evento
        $ideVinculo = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            $this->std->nistrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->matricula,
            true
        );
        $this->node->appendChild($ideVinculo);

        $infoReintegr = $this->dom->createElement("infoReintegr");
        $this->dom->addChild(
            $infoReintegr,
            "tpReint",
            $this->std->tpreint,
            true
        );
        $this->dom->addChild(
            $infoReintegr,
            "nrProcJud",
            ! empty($this->std->nrprocjud) ? $this->std->nrprocjud : null,
            false
        );
        $this->dom->addChild(
            $infoReintegr,
            "nrLeiAnistia",
            ! empty($this->std->nrleianistia) ? $this->std->nrleianistia : null,
            false
        );
        $this->dom->addChild(
            $infoReintegr,
            "dtEfetRetorno",
            $this->std->dtefetretorno,
            true
        );
        $this->dom->addChild(
            $infoReintegr,
            "dtEfeito",
            $this->std->dtefeito,
            true
        );
        $this->dom->addChild(
            $infoReintegr,
            "indPagtoJuizo",
            $this->std->indpagtojuizo,
            true
        );
        $this->node->appendChild($infoReintegr);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
