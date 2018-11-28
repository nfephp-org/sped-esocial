<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTabCargo Event S-1030 constructor
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

class EvtTabCargo extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtTabCargo';

    /**
     * @var string
     */
    protected $evtAlias = 'S-1030';

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
        
        $ide = $this->dom->createElement("ideCargo");
        $this->dom->addChild(
            $ide,
            "codCargo",
            $this->std->codcargo,
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
        
        
        if (!empty($this->std->dadoscargo)) {
            $da = $this->std->dadoscargo;
            $dados = $this->dom->createElement("dadosCargo");
            $this->dom->addChild(
                $dados,
                "nmCargo",
                $da->nmcargo,
                true
            );
            $this->dom->addChild(
                $dados,
                "codCBO",
                $da->codcbo,
                true
            );
            if (!empty($da->cargopublico)) {
                $cpub = $this->dom->createElement("cargoPublico");
                $this->dom->addChild(
                    $cpub,
                    "acumCargo",
                    $da->cargopublico->acumcargo,
                    true
                );
                $this->dom->addChild(
                    $cpub,
                    "contagemEsp",
                    $da->cargopublico->contagemesp,
                    true
                );
                $this->dom->addChild(
                    $cpub,
                    "dedicExcl",
                    $da->cargopublico->dedicexcl,
                    true
                );
                $lei = $this->dom->createElement("leiCargo");
                $this->dom->addChild(
                    $lei,
                    "nrLei",
                    $da->cargopublico->nrlei,
                    true
                );
                $this->dom->addChild(
                    $lei,
                    "dtLei",
                    $da->cargopublico->dtlei,
                    true
                );
                $this->dom->addChild(
                    $lei,
                    "sitCargo",
                    $da->cargopublico->sitcargo,
                    true
                );
                $cpub->appendChild($lei);
                $dados->appendChild($cpub);
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
        
        $info = $this->dom->createElement("infoCargo");
        //seleção do modo
        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
            $node->appendChild($ide);
            isset($dados) ? $node->appendChild($dados) : null;
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
            $node->appendChild($ide);
            isset($dados) ? $node->appendChild($dados): null;
            isset($nova) ? $node->appendChild($nova): null;
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
