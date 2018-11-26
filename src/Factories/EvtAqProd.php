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
                $tpAquis->setAttribute('indAquis', $tp->indaquis);
                $tpAquis->setAttribute(
                    'vlrTotAquis',
                    number_format($tp->vlrtotaquis, 2, '.', '')
                );

                foreach ($tp->ideprodutor as $ideprod) {
                    $ideProdutor = $this->dom->createElement("ideProdutor");
                    $ideProdutor->setAttribute('tpInscProd', $ideprod->tpinscprod);
                    $ideProdutor->setAttribute('nrInscProd', $ideprod->nrinscprod);
                    $ideProdutor->setAttribute(
                        'vlrBruto',
                        number_format($ideprod->vlrbruto, 2, '.', '')
                    );
                    $ideProdutor->setAttribute(
                        'vrCPDescPR',
                        number_format($ideprod->vrcpdescpr, 2, '.', '')
                    );
                    $ideProdutor->setAttribute(
                        'vrRatDescPR',
                        number_format($ideprod->vrratdescpr, 2, '.', '')
                    );
                    $ideProdutor->setAttribute(
                        'vrSenarDesc',
                        number_format($ideprod->vrsenardesc, 2, '.', '')
                    );
                    $ideProdutor->setAttribute('indOpcCP', $ideprod->indopccp);

                    foreach ($ideprod->nfs as $prodnfs) {
                        $nfs = $this->dom->createElement("nfs");
                        !empty($prodnfs->serie) ? $nfs->setAttribute('serie', $prodnfs->serie): null;
                        $nfs->setAttribute('nrDocto', $prodnfs->nrdocto);
                        $nfs->setAttribute('dtEmisNF', $prodnfs->dtemisnf);
                        $nfs->setAttribute(
                            'vlrBruto',
                            number_format($prodnfs->vlrbruto, 2, '.', '')
                        );
                        $nfs->setAttribute(
                            'vrCPDescPR',
                            number_format($prodnfs->vrcpdescpr, 2, '.', '')
                        );
                        $nfs->setAttribute(
                            'vrRatDescPR',
                            number_format($prodnfs->vrratdescpr, 2, '.', '')
                        );
                        $nfs->setAttribute(
                            'vrSenarDesc',
                            number_format($prodnfs->vrsenardesc, 2, '.', '')
                        );
                        $ideProdutor->appendChild($nfs);
                    }

                    foreach ($ideprod->infoprocjud as $prodprocjud) {
                        $infoProcJud = $this->dom->createElement("infoProcJud");
                        $infoProcJud->setAttribute('nrProcJud', $prodprocjud->nrprocjud);
                        $infoProcJud->setAttribute('codSusp', $prodprocjud->codsusp);
                        $infoProcJud->setAttribute(
                            'vrCPNRet',
                            number_format($prodprocjud->vrcpnret, 2, '.', '')
                        );
                        $infoProcJud->setAttribute(
                            'vrRatNRet',
                            number_format($prodprocjud->vrratnret, 2, '.', '')
                        );
                        $infoProcJud->setAttribute(
                            'vrSenarNRet',
                            number_format($prodprocjud->vrsenarnret, 2, '.', '')
                        );
                        $ideProdutor->appendChild($infoProcJud);
                    }
                    $tpAquis->appendChild($ideProdutor);
                    
                    if (!empty($tp->infoprocj)) {
                        foreach ($tp->infoprocj as $procjud) {
                            $procJ = $this->dom->createElement("infoProcJ");
                            $procJ->setAttribute('nrProcJud', $procjud->nrprocjud);
                            $procJ->setAttribute('codSusp', $procjud->codsusp);
                            $procJ->setAttribute(
                                'vrCPNRet',
                                number_format($procjud->vrcpnret, 2, '.', '')
                            );
                            $procJ->setAttribute(
                                'vrRatNRet',
                                number_format($procjud->vrratnret, 2, '.', '')
                            );
                            $procJ->setAttribute(
                                'vrSenarNRet',
                                number_format($procjud->vrsenarnret, 2, '.', '')
                            );
                            $tpAquis->appendChild($procJ);
                        }
                    }
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
