<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtExpRisco Event S-2240 constructor
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

class EvtExpRisco extends Factory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $evtName = 'evtExpRisco';

    /**
     * @var string
     */
    protected $evtAlias = 'S-2240';

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
        
        $ide = $this->dom->createElement("ideVinculo");
        $this->dom->addChild(
            $ide,
            "cpfTrab",
            $this->std->cpftrab,
            true
        );
        $this->dom->addChild(
            $ide,
            "nisTrab",
            !empty($this->std->nistrab) ? $this->std->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ide,
            "matricula",
            !empty($this->std->matricula) ? $this->std->matricula : null,
            false
        );
        $this->node->appendChild($ide);
        
        switch ($this->std->modo) {
            case 'INI':
                $noderisco = $this->dom->createElement("iniExpRisco");
                $dtnode = 'dtIniCondicao';
                break;
            case 'ALT':
                $noderisco = $this->dom->createElement("altExpRisco");
                $dtnode = 'dtAltCondicao';
                break;
            case 'FIM':
                $noderisco = $this->dom->createElement("fimExpRisco");
                $dtnode = 'dtFimCondicao';
                break;
        }
        $this->dom->addChild(
            $noderisco,
            $dtnode,
            $this->std->dtcondicao,
            true
        );
        if (!empty($this->std->infoamb)) {
            foreach ($this->std->infoamb as $info) {
                $infoAmb = $this->dom->createElement("infoAmb");
                $this->dom->addChild(
                    $infoAmb,
                    'codAmb',
                    $info->codamb,
                    true
                );
                $infoAtiv = $this->dom->createElement("infoAtiv");
                $this->dom->addChild(
                    $infoAtiv,
                    'dscAtivDes',
                    $info->dscativdes,
                    true
                );
                $infoAmb->appendChild($infoAtiv);
                foreach ($info->fatrisco as $fat) {
                    $fatRisco = $this->dom->createElement("fatRisco");
                    $this->dom->addChild(
                        $fatRisco,
                        'codFatRis',
                        $fat->codfatris,
                        true
                    );
                    $this->dom->addChild(
                        $fatRisco,
                        'intConc',
                        !empty($fat->intconc) ? $fat->intconc : null,
                        false
                    );
                    $this->dom->addChild(
                        $fatRisco,
                        'tecMedicao',
                        !empty($fat->tecmedicao) ? $fat->tecmedicao : null,
                        false
                    );
                    $epcEpi = $this->dom->createElement("epcEpi");
                    $this->dom->addChild(
                        $epcEpi,
                        'utilizEPC',
                        $fat->epcepi->utilizepc,
                        true
                    );
                    $this->dom->addChild(
                        $epcEpi,
                        'utilizEPI',
                        $fat->epcepi->utilizepi,
                        true
                    );
                    foreach ($fat->epcepi->epc as $e) {
                        $epc = $this->dom->createElement("epc");
                        $this->dom->addChild(
                            $epc,
                            'dscEpc',
                            $e->dscepc,
                            true
                        );
                        $this->dom->addChild(
                            $epc,
                            'eficEpc',
                            !empty($e->eficepc) ? $e->eficepc : null,
                            false
                        );
                        $epcEpi->appendChild($epc);
                    }
                    foreach ($fat->epcepi->epi as $e) {
                        $epi = $this->dom->createElement("epi");
                        $this->dom->addChild(
                            $epi,
                            'caEPI',
                            !empty($e->caepi) ? $e->caepi : null,
                            false
                        );
                        $this->dom->addChild(
                            $epi,
                            'eficEpi',
                            $e->eficepi,
                            true
                        );
                        $this->dom->addChild(
                            $epi,
                            'medProtecao',
                            $e->medprotecao,
                            true
                        );
                        $this->dom->addChild(
                            $epi,
                            'condFuncto',
                            $e->condfuncto,
                            true
                        );
                        $this->dom->addChild(
                            $epi,
                            'przValid',
                            $e->przvalid,
                            true
                        );
                        $this->dom->addChild(
                            $epi,
                            'periodicTroca',
                            $e->periodictroca,
                            true
                        );
                        $this->dom->addChild(
                            $epi,
                            'higienizacao',
                            $e->higienizacao,
                            true
                        );
                        $epcEpi->appendChild($epi);
                    }
                    $fatRisco->appendChild($epcEpi);
                    $infoAmb->appendChild($fatRisco);
                }
                $noderisco->appendChild($infoAmb);
            }
        }
        $info = $this->dom->createElement("infoExpRisco");
        $info->appendChild($noderisco);
        
        foreach ($this->std->respreg as $e) {
            $respReg = $this->dom->createElement("respReg");
            $this->dom->addChild(
                $respReg,
                'dtIni',
                $e->dtini,
                true
            );
            $this->dom->addChild(
                $respReg,
                'dtFim',
                !empty($e->dtfim) ? $e->dtfim : null,
                false
            );
            $this->dom->addChild(
                $respReg,
                'nisResp',
                $e->nisresp,
                true
            );
            $this->dom->addChild(
                $respReg,
                'nrOc',
                $e->nroc,
                true
            );
            $this->dom->addChild(
                $respReg,
                'ufOC',
                $e->ufoc,
                false
            );
            $info->appendChild($respReg);
        }
        $this->node->appendChild($info);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
