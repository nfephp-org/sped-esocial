<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtInsApo Event S-2241 constructor

 * Não existe em 2.5.0 layout
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

class EvtInsApo extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtInsApo';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2241';
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
        if (isset($this->std->insalperic)) {
            $insalPeric = $this->dom->createElement("insalPeric");
            if (isset($this->std->insalperic->iniinsalperic)) {
                $iniInsalPeric = $this->dom->createElement("iniInsalPeric");
                $this->dom->addChild(
                    $iniInsalPeric,
                    "dtIniCondicao",
                    $this->std->insalperic->iniinsalperic->dtinicondicao,
                    true
                );
                if (isset($this->std->insalperic->iniinsalperic->infoamb)) {
                    foreach ($this->std->insalperic->iniinsalperic->infoamb as $amb) {
                        $infoAmb = $this->dom->createElement("infoAmb");
                        $this->dom->addChild(
                            $infoAmb,
                            "codAmb",
                            $amb->codamb,
                            true
                        );
                        if (isset($amb->fatrisco)) {
                            foreach ($amb->fatrisco as $risco) {
                                $fatRisco = $this->dom->createElement("fatRisco");
                                $this->dom->addChild(
                                    $fatRisco,
                                    "codFatRis",
                                    $risco->codfatris,
                                    true
                                );
                                $infoAmb->appendChild($fatRisco);
                            }
                        }
                        $iniInsalPeric->appendChild($infoAmb);
                    }
                }
                $insalPeric->appendChild($iniInsalPeric);
            }
            if (isset($this->std->insalperic->altinsalperic)) {
                $altInsalPeric = $this->dom->createElement("altInsalPeric");
                $this->dom->addChild(
                    $altInsalPeric,
                    "dtAltCondicao",
                    $this->std->insalperic->altinsalperic->dtaltcondicao,
                    true
                );
                if (isset($this->std->insalperic->altinsalperic->infoamb)) {
                    foreach ($this->std->insalperic->altinsalperic->infoamb as $amb) {
                        $infoAmb = $this->dom->createElement("infoamb");
                        $this->dom->addChild(
                            $infoAmb,
                            "codAmb",
                            $amb->codamb,
                            true
                        );
                        if (isset($amb->fatrisco)) {
                            foreach ($amb->fatrisco as $risco) {
                                $fatRisco = $this->dom->createElement("fatRisco");

                                $this->dom->addChild(
                                    $fatRisco,
                                    "codFatRis",
                                    $risco->codfatris,
                                    true
                                );
                                $infoAmb->appendChild($fatRisco);
                            }
                        }
                        $altInsalPeric->appendChild($infoAmb);
                    }
                }
                $insalPeric->appendChild($altInsalPeric);
            }
            if (isset($this->std->insalperic->fiminsalperic)) {
                $fimInsalPeric = $this->dom->createElement("fimInsalPeric");
                $this->dom->addChild(
                    $fimInsalPeric,
                    "dtFimCondicao",
                    $this->std->insalperic->fiminsalperic->dtfimcondicao,
                    true
                );
                if (isset($this->std->insalperic->fiminsalperic->infoamb)) {
                    foreach ($this->std->insalperic->fiminsalperic->infoamb as $amb) {
                        $infoAmb = $this->dom->createElement("infoAmb");
                        $this->dom->addChild(
                            $infoAmb,
                            "codAmb",
                            $amb->codamb,
                            true
                        );
                        $fimInsalPeric->appendChild($infoAmb);
                    }
                }
                $insalPeric->appendChild($fimInsalPeric);
            }
            $this->node->appendChild($insalPeric);
        }
        if (isset($this->std->aposentesp)) {
            $aposentEsp = $this->dom->createElement("aposentEsp");
            if (isset($this->std->aposentesp->iniaposentesp)) {
                $iniAposentEsp = $this->dom->createElement("iniAposentEsp");
                $this->dom->addChild(
                    $iniAposentEsp,
                    "dtIniCondicao",
                    $this->std->aposentesp->iniaposentesp->dtinicondicao,
                    true
                );
                if (isset($this->std->aposentesp->iniaposentesp->infoamb)) {
                    foreach ($this->std->aposentesp->iniaposentesp->infoamb as $amb) {
                        $infoAmb = $this->dom->createElement("infoAmb");
                        $this->dom->addChild(
                            $infoAmb,
                            "codAmb",
                            $amb->codamb,
                            true
                        );
                        if (isset($amb->fatrisco)) {
                            foreach ($amb->fatrisco as $risco) {
                                $fatRisco = $this->dom->createElement("fatRisco");
                                $this->dom->addChild(
                                    $fatRisco,
                                    "codFatRis",
                                    $risco->codfatris,
                                    true
                                );
                                $infoAmb->appendChild($fatRisco);
                            }
                        }
                        $iniAposentEsp->appendChild($infoAmb);
                    }
                }
                $aposentEsp->appendChild($iniAposentEsp);
            }
            if (isset($this->std->aposentesp->altaposentesp)) {
                $altAposentEsp = $this->dom->createElement("altAposentEsp");
                $this->dom->addChild(
                    $altAposentEsp,
                    "dtAltCondicao",
                    $this->std->aposentesp->altaposentesp->dtaltcondicao,
                    true
                );
                if (isset($this->std->aposentesp->altaposentesp->infoamb)) {
                    foreach ($this->std->aposentesp->altaposentesp->infoamb as $amb) {
                        $infoAmb = $this->dom->createElement("infoamb");
                        $this->dom->addChild(
                            $infoAmb,
                            "codAmb",
                            $amb->codamb,
                            true
                        );
                        if (isset($amb->fatrisco)) {
                            foreach ($amb->fatrisco as $risco) {
                                $fatRisco = $this->dom->createElement("fatRisco");
                                $this->dom->addChild(
                                    $fatRisco,
                                    "codFatRis",
                                    $risco->codfatris,
                                    true
                                );
                                $infoAmb->appendChild($fatRisco);
                            }
                        }
                        $altAposentEsp->appendChild($infoAmb);
                    }
                }
                $aposentEsp->appendChild($altAposentEsp);
            }
            if (isset($this->std->aposentesp->fimaposentesp)) {
                $fimAposentEsp = $this->dom->createElement("fimAposentEsp");
                $this->dom->addChild(
                    $fimAposentEsp,
                    "dtFimCondicao",
                    $this->std->aposentesp->fimaposentesp->dtfimcondicao,
                    true
                );
                if (isset($this->std->aposentesp->fimaposentesp->infoamb)) {
                    foreach ($this->std->aposentesp->fimaposentesp->infoamb as $amb) {
                        $infoAmb = $this->dom->createElement("infoAmb");
                        $this->dom->addChild(
                            $infoAmb,
                            "codAmb",
                            $amb->codamb,
                            true
                        );
                        $fimAposentEsp->appendChild($infoAmb);
                    }
                }
                $aposentEsp->appendChild($fimAposentEsp);
            }
            $this->node->appendChild($aposentEsp);
        }

        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
