<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtAqProd Event S-1250 constructor
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

class EvtAqProd extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtAqProd';

    /**
     * @var string
     */
    protected $evtAlias = 'S-1250';

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
            "nrRecibo",
            ! empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
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

        $infoAquisProd  = $this->dom->createElement("infoAquisProd");
        $ideEstabAdquir = $this->dom->createElement("ideEstabAdquir");

        $this->dom->addChild(
            $ideEstabAdquir,
            "tpInscAdq",
            $this->std->ideestabadquir->tpinscadq,
            true
        );

        $this->dom->addChild(
            $ideEstabAdquir,
            "nrInscAdq",
            $this->std->ideestabadquir->nrinscadq,
            true
        );

        if (isset($this->std->ideestabadquir->tpaquis)) {
            foreach ($this->std->ideestabadquir->tpaquis as $tp) {
                $tpAquis = $this->dom->createElement("tpAquis");

                $this->dom->addChild(
                    $tpAquis,
                    "indAquis",
                    $tp->indaquis,
                    true
                );

                $this->dom->addChild(
                    $tpAquis,
                    "vlrTotAquis",
                    $tp->vlrtotaquis,
                    true
                );

                foreach ($tp->ideprodutor as $ideprod) {
                    $ideProdutor = $this->dom->createElement("ideProdutor");

                    $this->dom->addChild(
                        $ideProdutor,
                        "tpInscProd",
                        $ideprod->tpinscprod,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "nrInscProd",
                        $ideprod->nrinscprod,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "vlrBruto",
                        $ideprod->vlrbruto,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "vrCPDescPR",
                        $ideprod->vrcpdescpr,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "vrRatDescPR",
                        $ideprod->vrratdescpr,
                        true
                    );

                    $this->dom->addChild(
                        $ideProdutor,
                        "vrSenarDesc",
                        $ideprod->vrsenardesc,
                        true
                    );

                    if (isset($ideprod->nfs)) {
                        foreach ($ideprod->nfs as $prodnfs) {
                            $nfs = $this->dom->createElement("nfs");

                            $this->dom->addChild(
                                $nfs,
                                "serie",
                                ! empty($prodnfs->serie) ? $prodnfs->serie : null,
                                false
                            );

                            $this->dom->addChild(
                                $nfs,
                                "nrDocto",
                                $prodnfs->nrdocto,
                                true
                            );

                            $this->dom->addChild(
                                $nfs,
                                "dtEmisNF",
                                $prodnfs->dtemisnf,
                                true
                            );

                            $this->dom->addChild(
                                $nfs,
                                "vlrBruto",
                                $prodnfs->vlrbruto,
                                true
                            );

                            $this->dom->addChild(
                                $nfs,
                                "vrCPDescPR",
                                $prodnfs->vrcpdescpr,
                                true
                            );

                            $this->dom->addChild(
                                $nfs,
                                "vrRatDescPR",
                                $prodnfs->vrratdescpr,
                                true
                            );

                            $this->dom->addChild(
                                $nfs,
                                "vrSenarDesc",
                                $prodnfs->vrsenardesc,
                                true
                            );

                            $ideProdutor->appendChild($nfs);
                        }
                    }

                    if (isset($ideprod->infoprocjud)) {
                        foreach ($ideprod->infoprocjud as $prodprocjud) {
                            $infoProcJud = $this->dom->createElement("infoProcJud");

                            $this->dom->addChild(
                                $infoProcJud,
                                "nrProcJud",
                                $prodprocjud->nrprocjud,
                                true
                            );

                            $this->dom->addChild(
                                $infoProcJud,
                                "codSusp",
                                $prodprocjud->codsusp,
                                true
                            );

                            $this->dom->addChild(
                                $infoProcJud,
                                "vrCPNRet",
                                $prodprocjud->vrcpnret,
                                true
                            );

                            $this->dom->addChild(
                                $infoProcJud,
                                "vrRatNRet",
                                $prodprocjud->vrratnret,
                                true
                            );

                            $this->dom->addChild(
                                $infoProcJud,
                                "vrSenarNRet",
                                $prodprocjud->vrsenarnret,
                                true
                            );

                            $ideProdutor->appendChild($infoProcJud);
                        }
                    }

                    $tpAquis->appendChild($ideProdutor);
                }

                $ideEstabAdquir->appendChild($tpAquis);
            }
        }

        $infoAquisProd->appendChild($ideEstabAdquir);
        $this->node->appendChild($infoAquisProd);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
