<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtContrSindPatr Event S-1300 constructor
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

class EvtContrSindPatr extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtContrSindPatr';

    /**
     * @var string
     */
    protected $evtAlias = 'S-1300';

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
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );

        $evtContrSindPatr = $this->dom->createElement("evtContrSindPatr");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtContrSindPatr->appendChild($att);

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);

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

        if (isset($this->std->contribsind)) {
            foreach ($this->std->contribsind as $contrib) {
                $contribSind = $this->dom->createElement("contribSind");

                $this->dom->addChild(
                    $contribSind,
                    "cnpjSindic",
                    $contrib->cnpjsindic,
                    true
                );

                $this->dom->addChild(
                    $contribSind,
                    "tpContribSind",
                    $contrib->tpcontribsind,
                    true
                );

                $this->dom->addChild(
                    $contribSind,
                    "vlrContribSind",
                    $contrib->vlrcontribsind,
                    true
                );

                $this->node->appendChild($contribSind);
            }
        }

        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
