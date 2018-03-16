<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtComProd Event S-1260 constructor
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

class EvtComProd extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtComProd';
    /**
     * @var string
     */
    protected $evtAlias = 'S-1260';
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
            $this->std->nrrecibo,
            true
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
        $infoComProd = $this->dom->createElement("infoComProd");
        $ideEstabel = $this->dom->createElement("ideEstabel");
        $this->dom->addChild(
            $ideEstabel,
            "nrInscEstabRural",
            $this->std->estabelecimento->nrinscestabrural,
            true
        );
        $tpComerc = $this->dom->createElement("tpComerc");
        $this->dom->addChild(
            $tpComerc,
            "indComerc",
            $this->std->estabelecimento->indcomerc,
            true
        );
        $this->dom->addChild(
            $tpComerc,
            "vrTotCom",
            $this->std->estabelecimento->vrtotcom,
            true
        );
        if (isset($this->std->estabelecimento->ideadquir)) {
            foreach ($this->std->estabelecimento->ideadquir as $adquir) {
                $ideAdquir = $this->dom->createElement("ideAdquir");

                $this->dom->addChild(
                    $ideAdquir,
                    "tpInsc",
                    $adquir->tpinsc,
                    true
                );
                $this->dom->addChild(
                    $ideAdquir,
                    "nrInsc",
                    $adquir->nrinsc,
                    true
                );
                $this->dom->addChild(
                    $ideAdquir,
                    "vrComerc",
                    $adquir->vrcomerc,
                    true
                );
                if (isset($adquir->nfs)) {
                    foreach ($adquir->nfs as $nf) {
                        $nfs = $this->dom->createElement("nfs");

                        $this->dom->addChild(
                            $nfs,
                            "serie",
                            !empty($nf->serie) ? $nf->serie : null,
                            false
                        );
                        $this->dom->addChild(
                            $nfs,
                            "nrDocto",
                            $nf->nrdocto,
                            true
                        );
                        $this->dom->addChild(
                            $nfs,
                            "dtEmisNF",
                            $nf->dtemisnf,
                            true
                        );
                        $this->dom->addChild(
                            $nfs,
                            "vlrBruto",
                            $nf->vlrbruto,
                            true
                        );
                        $this->dom->addChild(
                            $nfs,
                            "vrCPDescPR",
                            $nf->vrcpdescpr,
                            true
                        );
                        $this->dom->addChild(
                            $nfs,
                            "vrRatDescPR",
                            $nf->vrratdescpr,
                            true
                        );
                        $this->dom->addChild(
                            $nfs,
                            "vrSenarDesc",
                            $nf->vrsenardesc,
                            true
                        );
                        $ideAdquir->appendChild($nfs);
                    }
                }
                $tpComerc->appendChild($ideAdquir);
            }
        }
        if (isset($this->std->infoprocjud)) {
            foreach ($this->std->infoprocjud as $procjud) {
                $infoProcJud = $this->dom->createElement("infoProcJud");
                $this->dom->addChild(
                    $infoProcJud,
                    "tpProc",
                    $procjud->tpproc,
                    true
                );
                $this->dom->addChild(
                    $infoProcJud,
                    "nrProc",
                    $procjud->nrproc,
                    true
                );
                $this->dom->addChild(
                    $infoProcJud,
                    "codSusp",
                    $procjud->codsusp,
                    true
                );
                $this->dom->addChild(
                    $infoProcJud,
                    "vrCPSusp",
                    !empty($procjud->vrcpsusp) ? $procjud->vrcpsusp : null,
                    false
                );
                $this->dom->addChild(
                    $infoProcJud,
                    "vrRatSusp",
                    !empty($procjud->vrratsusp) ? $procjud->vrratsusp : null,
                    false
                );
                $this->dom->addChild(
                    $infoProcJud,
                    "vrSenarSusp",
                    !empty($procjud->vrsenarsusp) ? $procjud->vrsenarsusp : null,
                    false
                );
                $tpComerc->appendChild($infoProcJud);
            }
        }
        $ideEstabel->appendChild($tpComerc);
        $infoComProd->appendChild($ideEstabel);
        $this->node->appendChild($infoComProd);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
