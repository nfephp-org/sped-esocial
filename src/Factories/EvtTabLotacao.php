<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTabLotacao Event S-1020 constructor
 * READ for 2.4.2 layout
 * READ for 2.5.0 layout
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

class EvtTabLotacao extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtTabLotacao';

    /**
     * @var string
     */
    protected $evtAlias = 'S-1020';

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
        
        $ide = $this->dom->createElement("ideLotacao");
        $this->dom->addChild(
            $ide,
            "codLotacao",
            $this->std->codlotacao,
            true
        );
        $this->dom->addChild(
            $ide,
            "iniValid",
            $this->std->inivalid,
            true
        );
        $this->dom->addChild(
            $ide,
            "fimValid",
            ! empty($this->std->fimvalid) ? $this->std->fimvalid : null,
            false
        );
        
        
        if (!empty($this->std->dadoslotacao)) {
            $da = $this->std->dadoslotacao;
            $dados = $this->dom->createElement("dadosLotacao");
            $this->dom->addChild(
                $dados,
                "tpLotacao",
                $da->tplotacao,
                true
            );
            $this->dom->addChild(
                $dados,
                "tpInsc",
                !empty($da->tpinsc) ? $da->tpinsc : null,
                false
            );
            $this->dom->addChild(
                $dados,
                "nrInsc",
                !empty($da->nrinsc) ? $da->nrinsc : null,
                false
            );
            $fpasLotacao = $this->dom->createElement("fpasLotacao");
            $this->dom->addChild(
                $fpasLotacao,
                "fpas",
                $da->fpas,
                true
            );
            $this->dom->addChild(
                $fpasLotacao,
                "codTercs",
                $da->codtercs,
                true
            );
            $this->dom->addChild(
                $fpasLotacao,
                "codTercsSusp",
                !empty($da->codtercssusp) ? $da->codtercssusp : null,
                false
            );
            
            if (!empty($da->procjudterceiro)) {
                $procjud = $this->dom->createElement("infoProcJudTerceiros");
                foreach ($da->procjudterceiro as $proc) {
                    $pjt = $this->dom->createElement("procJudTerceiro");
                    $this->dom->addChild(
                        $pjt,
                        "codTerc",
                        $proc->codterc,
                        true
                    );
                    $this->dom->addChild(
                        $pjt,
                        "nrProcJud",
                        $proc->nrprocjud,
                        true
                    );
                    $this->dom->addChild(
                        $pjt,
                        "codSusp",
                        $proc->codsusp,
                        true
                    );
                    $procjud->appendChild($pjt);
                }
                $fpasLotacao->appendChild($procjud);
            }
            $dados->appendChild($fpasLotacao);
            
            if (!empty($da->infoemprparcial)) {
                $parcial = $this->dom->createElement("infoEmprParcial");
                $this->dom->addChild(
                    $parcial,
                    "tpInscContrat",
                    $da->infoemprparcial->tpinsccontrat,
                    true
                );
                $this->dom->addChild(
                    $parcial,
                    "nrInscContrat",
                    $da->infoemprparcial->nrinsccontrat,
                    true
                );
                $this->dom->addChild(
                    $parcial,
                    "tpInscProp",
                    $da->infoemprparcial->tpinscprop,
                    true
                );
                $this->dom->addChild(
                    $parcial,
                    "nrInscProp",
                    $da->infoemprparcial->nrinscprop,
                    true
                );
                $dados->appendChild($parcial);
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
        
        $info = $this->dom->createElement("infoLotacao");
        //seleção do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
            $node->appendChild($ide);
            $node->appendChild($dados);
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
            $node->appendChild($ide);
            $node->appendChild($dados);
            $node->appendChild($nova);
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
