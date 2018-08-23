<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtFechaEvPer Event S-1299 constructor
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

class EvtFechaEvPer extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtFechaEvPer';
    /**
     * @var string
     */
    protected $evtAlias = 'S-1299';
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
            "indApuracao",
            $this->std->indapuracao,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "perApur",
            $this->std->perapur,
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

        $ideRespInf = $this->dom->createElement("ideRespInf");
        $this->dom->addChild(
            $ideRespInf,
            "nmResp",
            $this->std->iderespinf->nmresp,
            true
        );
        $this->dom->addChild(
            $ideRespInf,
            "cpfResp",
            $this->std->iderespinf->cpfresp,
            true
        );
        $this->dom->addChild(
            $ideRespInf,
            "telefone",
            $this->std->iderespinf->telefone,
            true
        );
        $this->dom->addChild(
            $ideRespInf,
            "email",
            ! empty($this->std->iderespinf->email) ? $this->std->iderespinf->email : null,
            false
        );
        $this->node->appendChild($ideRespInf);

        $infoFech = $this->dom->createElement("infoFech");
        $this->dom->addChild(
            $infoFech,
            "evtRemun",
            $this->std->infofech->evtremun,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtPgtos",
            $this->std->infofech->evtpgtos,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtAqProd",
            $this->std->infofech->evtaqprod,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtComProd",
            $this->std->infofech->evtcomprod,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtContratAvNP",
            $this->std->infofech->evtcontratavnp,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "evtInfoComplPer",
            $this->std->infofech->evtinfocomplper,
            true
        );
        $this->dom->addChild(
            $infoFech,
            "compSemMovto",
            ! empty($this->std->infofech->compsemmovto) ? $this->std->infofech->compsemmovto : null,
            false
        );
        $this->node->appendChild($infoFech);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
