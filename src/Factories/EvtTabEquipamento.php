<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTabEquipamento Event S-1065 constructor

 * Read for 2.5.0 layout
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

class EvtTabEquipamento extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtTabEquipamento';
    /**
     * @var string
     */
    protected $evtAlias = 'S-1065';

    /**
     * Constructor
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate
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

        $ide = $this->dom->createElement("ideEquipamento");
        $this->dom->addChild(
            $ide,
            "codEP",
            $this->std->codep,
            true
        );
        $this->dom->addChild(
            $ide,
            "iniValid",
            $this->std->inivalid,
            false
        );
        $this->dom->addChild(
            $ide,
            "fimValid",
            ! empty($this->std->fimvalid) ? $this->std->fimvalid : null,
            false
        );

        $dados = null;
        if (!empty($this->std->tpep)) {
            $dados = $this->dom->createElement("dadosEquipamento");
            $this->dom->addChild(
                $dados,
                "tpEP",
                $this->std->tpep,
                true
            );
            $this->dom->addChild(
                $dados,
                "dscEP",
                $this->std->dscep,
                true
            );
            $this->dom->addChild(
                $dados,
                "caEPI",
                $this->std->caepi,
                false
            );
        }

        $nova = null;
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

        $info = $this->dom->createElement("infoEquipamento");
        //seleção do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
            $node->appendChild($ide);
            if (!empty($dados)) {
                $node->appendChild($dados);
            }
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
            $node->appendChild($ide);
            if (!empty($dados)) {
                $node->appendChild($dados);
            }
            if (!empty($nova)) {
                $node->appendChild($nova);
            }
        } else {
            $node = $this->dom->createElement("exclusao");
            $node->appendChild($ide);
        }
        $info->appendChild($node);
        $this->node->appendChild($info);
        $this->eSocial->appendChild($this->node);
        $this->xml = $this->dom->saveXML($this->eSocial);
        //$this->sign();
    }
}
