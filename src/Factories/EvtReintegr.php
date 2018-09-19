<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtReintegr Event S-2298 constructor
 * READ for 2.4.2 layout
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
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

/**
 * Class EvtReintegr
 * @package NFePHP\eSocial\Factories
 */
class EvtReintegr extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtReintegr';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2298';
    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * EvtReintegr constructor.
     * @param $config
     * @param stdClass $std
     * @param Certificate|null $certificate
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
     *
     */
    protected function toNode()
    {
        $ideEvento = $this->dom->createElement('ideEvento');

        $this->dom->addChild(
            $ideEvento,
            'indRetif',
            $this->std->indretif,
            true
        );

        $this->dom->addChild(
            $ideEvento,
            'nrRecibo',
            !empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
            false
        );

        $this->dom->addChild(
            $ideEvento,
            'tpAmb',
            $this->tpAmb,
            true
        );

        $this->dom->addChild(
            $ideEvento,
            'procEmi',
            $this->procEmi,
            true
        );

        $this->dom->addChild(
            $ideEvento,
            'verProc',
            $this->verProc,
            true
        );

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);

        $this->node->insertBefore($ideEvento, $ideEmpregador);

        $ideVinculo = $this->dom->createElement('ideVinculo');

        $this->dom->addChild(
            $ideVinculo,
            'cpfTrab',
            $this->std->idevinculo->cpftrab,
            true
        );

        $this->dom->addChild(
            $ideVinculo,
            'nisTrab',
            $this->std->idevinculo->nistrab,
            true
        );

        $this->dom->addChild(
            $ideVinculo,
            'matricula',
            $this->std->idevinculo->matricula,
            true
        );

        $this->node->appendChild($ideVinculo);

        $infoReintegr = $this->dom->createElement('infoReintegr');

        $this->dom->addChild(
            $infoReintegr,
            'tpReint',
            $this->std->inforeintegr->tpreint,
            true
        );

        $this->dom->addChild(
            $infoReintegr,
            'nrProcJud',
            !empty($this->std->inforeintegr->nrprocjud) ? $this->std->inforeintegr->nrprocjud : null,
            false
        );

        $this->dom->addChild(
            $infoReintegr,
            'nrLeiAnistia',
            !empty($this->std->inforeintegr->nrleianistia) ? $this->std->inforeintegr->nrleianistia : null,
            false
        );

        $this->dom->addChild(
            $infoReintegr,
            'dtEfetRetorno',
            $this->std->inforeintegr->dtefetretorno,
            true
        );

        $this->dom->addChild(
            $infoReintegr,
            'dtEfeito',
            $this->std->inforeintegr->dtefeito,
            true
        );

        $this->dom->addChild(
            $infoReintegr,
            'indPagtoJuizo',
            $this->std->inforeintegr->indpagtojuizo,
            true
        );

        $this->node->appendChild($infoReintegr);
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
