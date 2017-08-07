<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtAvPrevio Event S-2250 constructor
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
     * @param string      $config
     * @param stdClass    $std
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
        $eSocial = $this->dom->getElementsByTagName("eSocial")->item(0);
        $evtAvPrevio = $this->dom->createElement("evtAvPrevio");
        $att = $this->dom->createAttribute('Id');
        $att->value = $evtid;
        $evtAvPrevio->appendChild($att);

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
        $evtAvPrevio->appendChild($ideEvento);

        $ideEmpregador = $this->dom->createElement("ideEmpregador");
        $this->dom->addChild(
            $ideEmpregador,
            "tpInsc",
            $this->tpInsc,
            true
        );
        $this->dom->addChild(
            $ideEmpregador,
            "nrInsc",
            $this->nrInsc,
            true
        );
        $evtAvPrevio->appendChild($ideEmpregador);

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
        $evtAvPrevio->appendChild($ideVinculo);

        $infoAvPrevio = $this->dom->createElement("infoAvPrevio");

        $detAvPrevio = $this->dom->createElement("detAvPrevio");

        $this->dom->addChild(
            $detAvPrevio,
            "dtAvPrv",
            $this->std->infoavprevio->dtavprv,
            true
        );
        $this->dom->addChild(
            $detAvPrevio,
            "dtPrevDeslig",
            $this->std->infoavprevio->dtprevdeslig,
            true
        );
        $this->dom->addChild(
            $detAvPrevio,
            "tpAvPrevio",
            $this->std->infoavprevio->tpavprevio,
            true
        );
        $this->dom->addChild(
            $detAvPrevio,
            "observacao",
            !empty($this->std->observacao) ? $this->std->observacao : null,
            false
        );

        $infoAvPrevio->appendChild($detAvPrevio);
        $evtAvPrevio->appendChild($infoAvPrevio);

        if (!empty($this->std->cancavprevio)) {
            $cancAvPrevio = $this->dom->createElement("cancAvPrevio");
            $this->dom->addChild(
                $cancAvPrevio,
                "dtCancAvPrv",
                $this->std->cancavprevio->dtCancAvPrv,
                true
            );
            $this->dom->addChild(
                $cancAvPrevio,
                "observacao",
                !empty($this->std->cancavprevio->observacao) ? $this->std->cancavprevio->observacao : null,
                false
            );
            $this->dom->addChild(
                $cancAvPrevio,
                "mtvCancAvPrevio",
                $this->std->cancavprevio->mtvcancavprevio,
                true
            );
            $infoAvPrevio->appendChild($cancAvPrevio);
        }

        $eSocial->appendChild($evtAvPrevio);
        $this->sign($eSocial);
    }
}
