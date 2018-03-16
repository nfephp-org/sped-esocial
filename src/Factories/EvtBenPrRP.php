<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtBenPrRP Event S-1207 constructor
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

class EvtBenPrRP extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtBenPrRP';
    /**
     * @var string
     */
    protected $evtAlias = 'S-1207';
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
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate = null
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
        $ideBenef = $this->dom->createElement("ideBenef");
        $this->dom->addChild(
            $ideBenef,
            "cpfBenef",
            $this->std->cpfbenef,
            true
        );
        $this->node->appendChild($ideBenef);
        if (isset($this->std->dmdev)) {
            foreach ($this->std->dmdev as $dev) {
                $dmDev = $this->dom->createElement("dmDev");
                $this->dom->addChild(
                    $dmDev,
                    "tpBenef",
                    $dev->tpbenef,
                    true
                );
                $this->dom->addChild(
                    $dmDev,
                    "nrBenefic",
                    $dev->nrbenefic,
                    true
                );
                $this->dom->addChild(
                    $dmDev,
                    "ideDmDev",
                    $dev->idedmdev,
                    true
                );
                if (isset($dev->itens)) {
                    foreach ($dev->itens as $item) {
                        $itens = $this->dom->createElement("itens");
                        $this->dom->addChild(
                            $itens,
                            "codRubr",
                            $item->codrubr,
                            true
                        );
                        $this->dom->addChild(
                            $itens,
                            "ideTabRubr",
                            $item->idetabrubr,
                            true
                        );
                        $this->dom->addChild(
                            $itens,
                            "vrRubr",
                            $item->vrrubr,
                            true
                        );
                        $dmDev->appendChild($itens);
                    }
                }
                $this->node->appendChild($dmDev);
            }
        }
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
