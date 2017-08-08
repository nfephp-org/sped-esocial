<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtFechaEvPer Event S-1299 constructor
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
        $evtFechaEvPer = $this->dom->createElement("evtFechaEvPer");
        $att = $this->dom->createAttribute('Id');
        $att->value = $evtid;
        $evtFechaEvPer->appendChild($att);

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
        $evtFechaEvPer->appendChild($ideEvento);

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
        $evtFechaEvPer->appendChild($ideEmpregador);

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
            !empty($this->std->iderespinf->email) ? $this->std->iderespinf->email : null,
            false
        );
        $evtFechaEvPer->appendChild($ideRespInf);

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
            !empty($this->std->infofech->compsemmovto) ? $this->std->infofech->compsemmovto : null,
            false
        );
        $evtFechaEvPer->appendChild($infoFech);


        $eSocial->appendChild($evtFechaEvPer);
        $this->sign($eSocial);
    }
}
