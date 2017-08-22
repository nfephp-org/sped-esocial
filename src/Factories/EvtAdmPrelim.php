<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtAdmPrelim Event S-2190 constructor
 *
 * @category  NFePHP
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
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

class EvtAdmPrelim extends Factory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $evtName = 'evtAdmPrelim';

    /**
     * @var string
     */
    protected $evtAlias = 'S-2190';

    /**
     * Constructor
     *
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate
     * @param             string date
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

        //tag deste evento em particular
        $infoRegPrelim = $this->dom->createElement("infoRegPrelim");
        $this->dom->addChild(
            $infoRegPrelim,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtNascto",
            $this->std->dtnascto,
            true
        );
        $this->dom->addChild(
            $infoRegPrelim,
            "dtAdm",
            $this->std->dtadm,
            true
        );
        $this->node->appendChild($infoRegPrelim);

        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
