<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTreiCap Event S-2245 constructor
 * Read for 2.5.0 layout
 *
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

class EvtTreiCap extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtTreiCap';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2245';
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
            isset($this->std->nrrecibo) ? $this->std->nrrecibo : null,
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
            !empty($this->std->idevinculo->nistrab) ? $this->std->idevinculo->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            !empty($this->std->idevinculo->matricula) ? $this->std->idevinculo->matricula : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "codCateg",
            !empty($this->std->idevinculo->codcateg) ? $this->std->idevinculo->codcateg : null,
            false
        );
        $this->node->appendChild($ideVinculo);
        
        $t = $this->std->treicap;
        $treiCap = $this->dom->createElement("treiCap");
        $this->dom->addChild(
            $treiCap,
            "codTreiCap",
            $t->codtreicap,
            true
        );
        $this->dom->addChild(
            $treiCap,
            "obsTreiCap",
            !empty($t->obstreicap) ? $t->obstreicap : null,
            false
        );
        if (!empty($t->infocomplem)) {
            $i = $t->infocomplem;
            $infoComplem = $this->dom->createElement("infoComplem");
            $this->dom->addChild(
                $infoComplem,
                "dtTreiCap",
                $i->dttreicap,
                true
            );
            $this->dom->addChild(
                $infoComplem,
                "durTreiCap",
                $i->durtreicap,
                true
            );
            $this->dom->addChild(
                $infoComplem,
                "modTreiCap",
                $i->modtreicap,
                true
            );
            $this->dom->addChild(
                $infoComplem,
                "tpTreiCap",
                $i->tptreicap,
                true
            );
            $this->dom->addChild(
                $infoComplem,
                "indTreinAnt",
                $i->indtreinant,
                true
            );
            
            foreach ($i->ideprofresp as $p) {
                $ideProfResp = $this->dom->createElement("ideProfResp");
                $this->dom->addChild(
                    $ideProfResp,
                    "cpfProf",
                    !empty($p->cpfprof) ? $p->cpfprof : null,
                    false
                );
                $this->dom->addChild(
                    $ideProfResp,
                    "nmProf",
                    $p->nmprof,
                    true
                );
                $this->dom->addChild(
                    $ideProfResp,
                    "tpProf",
                    $p->tpprof,
                    true
                );
                $this->dom->addChild(
                    $ideProfResp,
                    "formProf",
                    $p->formprof,
                    true
                );
                $this->dom->addChild(
                    $ideProfResp,
                    "codCBO",
                    $p->codcbo,
                    true
                );
                $this->dom->addChild(
                    $ideProfResp,
                    "nacProf",
                    $p->nacprof,
                    true
                );
                $infoComplem->appendChild($ideProfResp);
            }
            $treiCap->appendChild($infoComplem);
        }
        $this->node->appendChild($treiCap);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
