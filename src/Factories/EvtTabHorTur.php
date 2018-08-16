<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTabHorTur Event S-1050 constructor
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

class EvtTabHorTur extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtTabHorTur';

    /**
     * @var string
     */
    protected $evtAlias = 'S-1050';

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
        
        $ide = $this->dom->createElement("ideHorContratual");
        $this->dom->addChild(
            $ide,
            "codHorContrat",
            $this->std->idehorcontratual->codhorcontrat,
            true
        );
        $this->dom->addChild(
            $ide,
            "iniValid",
            $this->std->idehorcontratual->inivalid,
            true
        );
        $this->dom->addChild(
            $ide,
            "fimValid",
            ! empty($this->std->idehorcontratual->fimvalid) ? $this->std->idehorcontratual->fimvalid : null,
            false
        );
        
        if (!empty($this->std->dadoshorcontratual)) {
            $da = $this->std->dadoshorcontratual;
            $dados = $this->dom->createElement("dadosHorContratual");
            $this->dom->addChild(
                $dados,
                "hrEntr",
                $da->hrentr,
                true
            );
            $this->dom->addChild(
                $dados,
                "hrSaida",
                $da->hrsaida,
                true
            );
            $this->dom->addChild(
                $dados,
                "durJornada",
                $da->durjornada,
                true
            );
            $this->dom->addChild(
                $dados,
                "perHorFlexivel",
                $da->perhorflexivel,
                true
            );
            if (!empty($da->horarioIntervalo)) {
                foreach ($da->horarioIntervalo as $inter) {
                    $intervalo = $this->dom->createElement("horarioIntervalo");
                    $this->dom->addChild(
                        $intervalo,
                        "tpInterv",
                        $inter->tpinterv,
                        true
                    );
                    $this->dom->addChild(
                        $intervalo,
                        "durInterv",
                        $inter->durinterv,
                        true
                    );
                    $this->dom->addChild(
                        $intervalo,
                        "iniInterv",
                        !empty($inter->iniinterv) ? $inter->iniinterv : null,
                        false
                    );
                    $this->dom->addChild(
                        $intervalo,
                        "termInterv",
                        !empty($inter->terminterv) ? $inter->terminterv : null,
                        false
                    );
                    $dados->appendChild($intervalo);
                }
            }
        }
        
        if (!empty($this->std->novavalidade)) {
            $nova = $this->dom->createElement("novaValidade");
            $this->dom->addChild(
                $nova,
                "iniValid",
                $this->std->novavalidade->inivalid,
                true
            );
            $this->dom->addChild(
                $nova,
                "fimValid",
                ! empty($this->std->novavalidade->fimvalid)
                    ? $this->std->novavalidade->fimvalid
                    : null,
                false
            );
        }
        
        $info = $this->dom->createElement("infoHorContratual");
        //seleção do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
            $node->appendChild($ide);
            $node->appendChild($dados);
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
            $node->appendChild($ide);
            $node->appendChild($dados);
            if (isset($nova)) {
                $node->appendChild($nova);
            }
        } else {
            $node = $this->dom->createElement("exclusao");
            $node->appendChild($ide);
        }
        
        $info->appendChild($node);
        $this->node->appendChild($info);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
