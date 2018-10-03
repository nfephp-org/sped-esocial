<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtAvPrevio Event S-2250 constructor
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

class EvtAvPrevio extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtAvPrevio';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2250';
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
        $infoAvPrevio = $this->dom->createElement("infoAvPrevio");
        if (! empty($this->std->infoavprevio->detavprevio)) {
            $detAvPrevio = $this->dom->createElement("detAvPrevio");
            $this->dom->addChild(
                $detAvPrevio,
                "dtAvPrv",
                $this->std->infoavprevio->detavprevio->dtavprv,
                true
            );
            $this->dom->addChild(
                $detAvPrevio,
                "dtPrevDeslig",
                $this->std->infoavprevio->detavprevio->dtprevdeslig,
                true
            );
            $this->dom->addChild(
                $detAvPrevio,
                "tpAvPrevio",
                $this->std->infoavprevio->detavprevio->tpavprevio,
                true
            );
            $this->dom->addChild(
                $detAvPrevio,
                "observacao",
                ! empty($this->std->infoavprevio->detavprevio->observacao) ?
                    $this->std->infoavprevio->detavprevio->observacao : null,
                false
            );
            $infoAvPrevio->appendChild($detAvPrevio);
        }
        if (! empty($this->std->infoavprevio->cancavprevio)) {
            $cancAvPrevio = $this->dom->createElement("cancAvPrevio");
            $this->dom->addChild(
                $cancAvPrevio,
                "dtCancAvPrv",
                $this->std->infoavprevio->cancavprevio->dtcancavprv,
                true
            );
            $this->dom->addChild(
                $cancAvPrevio,
                "observacao",
                ! empty($this->std->infoavprevio->cancavprevio->observacao) ?
                    $this->std->infoavprevio->cancavprevio->observacao : null,
                false
            );
            $this->dom->addChild(
                $cancAvPrevio,
                "mtvCancAvPrevio",
                $this->std->infoavprevio->cancavprevio->mtvcancavprevio,
                true
            );
            $infoAvPrevio->appendChild($cancAvPrevio);
        }
        $this->node->appendChild($infoAvPrevio);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
