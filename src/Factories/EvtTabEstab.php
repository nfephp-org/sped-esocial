<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTabEstab Event S-1005 constructor
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
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

class EvtTabEstab extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtTabEstab';

    /**
     * @var string
     */
    protected $evtAlias = 'S-1005';

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

        //tag deste evento em particular
        $infoEstab = $this->dom->createElement("infoEstab");

        //tag comum a todos os modos
        $ideEstab = $this->dom->createElement("ideEstab");
        $this->dom->addChild(
            $ideEstab,
            "tpInsc",
            $this->std->tpinsc,
            true
        );
        $this->dom->addChild(
            $ideEstab,
            "nrInsc",
            $this->std->nrinsc,
            true
        );
        $this->dom->addChild(
            $ideEstab,
            "iniValid",
            $this->std->inivalid,
            true
        );
        $this->dom->addChild(
            $ideEstab,
            "fimValid",
            ! empty($this->std->fimvalid) ? $this->std->fimvalid : null,
            false
        );

        if ($this->std->modo == 'INC') {
            $node = $this->dom->createElement("inclusao");
        } elseif ($this->std->modo == 'ALT') {
            $node = $this->dom->createElement("alteracao");
        } else {
            $node = $this->dom->createElement("exclusao");
        }
        $node->appendChild($ideEstab);

        if (! empty($this->std->dadosestab)) {
            $dadosEstab = $this->dom->createElement("dadosEstab");
            $this->dom->addChild(
                $dadosEstab,
                "cnaePrep",
                $this->std->dadosestab->cnaeprep,
                true
            );
            $aliqGilrat = $this->dom->createElement("aliqGilrat");
            $this->dom->addChild(
                $aliqGilrat,
                "aliqRat",
                $this->std->dadosestab->aliqgilrat->aliqrat,
                true
            );
            $fap = ! empty($this->std->dadosestab->aliqgilrat->fap) ? $this->std->dadosestab->aliqgilrat->fap : null;
            if ($fap) {
                $fap = number_format($fap, 4, '.', '');
            }
            $this->dom->addChild(
                $aliqGilrat,
                "fap",
                $fap,
                false
            );
            $aliqrata = ! empty($this->std->dadosestab->aliqgilrat->aliqratajust)
                ? $this->std->dadosestab->aliqgilrat->aliqratajust
                : null;
            if ($aliqrata) {
                $aliqrata = number_format($aliqrata, 4, '.', '');
            }
            $this->dom->addChild(
                $aliqGilrat,
                "aliqRatAjust",
                $aliqrata,
                false
            );
            if (! empty($this->std->dadosestab->aliqgilrat->procadmjudrat)) {
                $procAdmJudRat = $this->dom->createElement("procAdmJudRat");
                $this->dom->addChild(
                    $procAdmJudRat,
                    "tpProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudrat->tpproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudRat,
                    "nrProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudrat->nrproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudRat,
                    "codSusp",
                    $this->std->dadosestab->aliqgilrat->procadmjudrat->codsusp,
                    true
                );
                $aliqGilrat->appendChild($procAdmJudRat);
            }
            if (! empty($this->std->dadosestab->aliqgilrat->procadmjudfap)) {
                $procAdmJudFap = $this->dom->createElement("procAdmJudFap");
                $this->dom->addChild(
                    $procAdmJudFap,
                    "tpProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudfap->tpproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudFap,
                    "nrProc",
                    $this->std->dadosestab->aliqgilrat->procadmjudfap->nrproc,
                    true
                );
                $this->dom->addChild(
                    $procAdmJudFap,
                    "codSusp",
                    $this->std->dadosestab->aliqgilrat->procadmjudfap->codsusp,
                    true
                );
                $aliqGilrat->appendChild($procAdmJudFap);
            }
            $dadosEstab->appendChild($aliqGilrat);

            if (! empty($this->std->dadosestab->infocaepf)) {
                $infoCaepf = $this->dom->createElement("infoCaepf");
                $this->dom->addChild(
                    $infoCaepf,
                    "tpCaepf",
                    $this->std->dadosestab->infocaepf->tpcaepf,
                    true
                );
                $dadosEstab->appendChild($infoCaepf);
            }

            if (! empty($this->std->dadosestab->infoobra)) {
                $infoObra = $this->dom->createElement("infoObra");
                $this->dom->addChild(
                    $infoObra,
                    "indSubstPatrObra",
                    $this->std->dadosestab->infoobra->indsubstpatrobra,
                    true
                );
                $dadosEstab->appendChild($infoObra);
            }

            $infoTrab = $this->dom->createElement("infoTrab");
            $this->dom->addChild(
                $infoTrab,
                "regPt",
                $this->std->dadosestab->infotrab->regpt,
                true
            );

            $infoApr = $this->dom->createElement("infoApr");
            $this->dom->addChild(
                $infoApr,
                "contApr",
                $this->std->dadosestab->infotrab->infoapr->contapr,
                true
            );
            $this->dom->addChild(
                $infoApr,
                "nrProcJud",
                ! empty($this->std->dadosestab->infotrab->infoapr->nrprocjud)
                    ? $this->std->dadosestab->infotrab->infoapr->nrprocjud
                    : null,
                false
            );
            $this->dom->addChild(
                $infoApr,
                "contEntEd",
                ! empty($this->std->dadosestab->infotrab->infoapr->contented)
                    ? $this->std->dadosestab->infotrab->infoapr->contented
                    : null,
                false
            );

            if (! empty($this->std->dadosestab->infotrab->infoapr->infoenteduc)) {
                foreach ($this->std->dadosestab->infotrab->infoapr->infoenteduc as $edu) {
                    $infoEntEduc = $this->dom->createElement("infoEntEduc");
                    $this->dom->addChild(
                        $infoEntEduc,
                        "nrInsc",
                        $edu->nrinsc,
                        true
                    );
                    $infoApr->appendChild($infoEntEduc);
                }
            }

            $infoTrab->appendChild($infoApr);
            if (! empty($this->std->dadosestab->infotrab->infopdc)) {
                $infoPCD = $this->dom->createElement("infoPCD");
                $this->dom->addChild(
                    $infoPCD,
                    "contPCD",
                    $this->std->dadosestab->infotrab->infopdc->contpdc,
                    true
                );
                $this->dom->addChild(
                    $infoPCD,
                    "nrProcJud",
                    ! empty($this->std->dadosestab->infotrab->infopdc->nrprocjud)
                        ? $this->std->dadosestab->infotrab->infopdc->nrprocjud
                        : null,
                    false
                );
                $infoTrab->appendChild($infoPCD);
            }
            $dadosEstab->appendChild($infoTrab);
            $node->appendChild($dadosEstab);
        }

        if (! empty($this->std->novavalidade) && $this->std->modo == 'ALT') {
            $newVal       = $this->std->novavalidade;
            $novaValidade = $this->dom->createElement("novaValidade");
            $this->dom->addChild(
                $ideRubrica,
                "iniValid",
                $newVal->inivalid,
                true
            );
            $this->dom->addChild(
                $ideRubrica,
                "fimValid",
                ! empty($newVal->fimvalid) ? $newVal->fimvalid : null,
                false
            );
            $node->appendChild($novaValidade);
        }
        $infoEstab = $this->dom->createElement("infoEstab");
        $infoEstab->appendChild($node);
        //finalização do xml
        $this->node->appendChild($infoEstab);
        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
