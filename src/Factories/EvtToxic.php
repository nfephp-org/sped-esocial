<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtToxic Event S-2221 constructor
 * Read for 2.5.0 layout
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2017-2019
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

class EvtToxic extends Factory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $evtName = 'evtToxic';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2221';

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
        $this->node->insertBefore($ideEvento, $ideEmpregador);
        
        $ideVinculo = $this->dom->createElement("ideVinculo");
        $ide = $this->std->idevinculo;
        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $ide->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            !empty($ide->nistrab) ? $ide->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            !empty($ide->matricula) ? $ide->matricula : null,
            false
        );
        $this->dom->addChild(
            $ideVinculo,
            "codCateg",
            !empty($ide->codcateg) ? $ide->codcateg : null,
            false
        );
        $this->node->appendChild($ideVinculo);
        
        $toxic = $this->dom->createElement("toxicologico");
        $tox = $this->std->toxicologico;
        $this->dom->addChild(
            $toxic,
            "dtExame",
            $tox->dtexame,
            true
        );
        $this->dom->addChild(
            $toxic,
            "cnpjLab",
            !empty($tox->cnpjlab) ? $tox->cnpjlab : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "codSeqExame",
            !empty($tox->codseqexame) ? $tox->codseqexame : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "nmMed",
            !empty($tox->nmmed) ? $tox->nmmed : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "nrCRM",
            !empty($tox->nrcrm) ? $tox->nrcrm : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "ufCRM",
            !empty($tox->ufcrm) ? $tox->ufcrm : null,
            false
        );
        $this->dom->addChild(
            $toxic,
            "indRecusa",
            $tox->indrecusa,
            true
        );
        $this->node->appendChild($toxic);
        //finalização do xml
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
