<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtMonit Event S-2220 constructor
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

class EvtMonit extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;

    /**
     * @var string
     */
    protected $evtName = 'evtMonit';

    /**
     * @var string
     */
    protected $evtAlias = 'S-2220';

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
        $evtid = FactoryId::build(
            $this->tpInsc,
            $this->nrInsc,
            $this->date,
            $this->sequencial
        );

        $evtMonit = $this->dom->createElement("evtMonit");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtMonit->appendChild($att);

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);

        $ideEvento = $this->dom->createElement("ideEvento");
        $this->dom->addChild(
            $ideEvento,
            "indRetif",
            $this->std->indretif,
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

        $ideVinculo = $this->dom->createElement("ideVinculo");

        $this->dom->addChild(
            $ideVinculo,
            "cpfTrab",
            $this->std->idevinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "nisTrab",
            $this->std->idevinculo->nistrab,
            true
        );
        $this->dom->addChild(
            $ideVinculo,
            "matricula",
            $this->std->idevinculo->matricula,
            true
        );

        $this->node->appendChild($ideVinculo);

        $aso = $this->dom->createElement("aso");

        $this->dom->addChild(
            $aso,
            "dtAso",
            $this->std->aso->dtaso,
            true
        );

        $this->dom->addChild(
            $aso,
            "tpAso",
            $this->std->aso->tpaso,
            true
        );

        $this->dom->addChild(
            $aso,
            "resAso",
            $this->std->aso->resaso,
            true
        );

        if (isset($this->std->exame)) {
            foreach ($this->std->exame as $exam) {
                $exame = $this->dom->createElement("exame");

                $this->dom->addChild(
                    $exame,
                    "dtExm",
                    $exam->dtexm,
                    true
                );

                $this->dom->addChild(
                    $exame,
                    "procRealizado",
                    ! empty($exam->procrealizado) ? $exam->procrealizado : null,
                    false
                );

                $this->dom->addChild(
                    $exame,
                    "obsProc",
                    ! empty($exam->obsproc) ? $exam->obsproc : null,
                    false
                );

                $this->dom->addChild(
                    $exame,
                    "interprExm",
                    $exam->interprexm,
                    true
                );

                $this->dom->addChild(
                    $exame,
                    "ordExame",
                    $exam->ordexame,
                    true
                );

                $this->dom->addChild(
                    $exame,
                    "dtIniMonit",
                    $exam->dtinimonit,
                    true
                );

                $this->dom->addChild(
                    $exame,
                    "dtFimMonit",
                    ! empty($exam->dtfimmonit) ? $exam->dtfimmonit : null,
                    false
                );

                $this->dom->addChild(
                    $exame,
                    "indResult",
                    ! empty($exam->indresult) ? $exam->indresult : null,
                    false
                );

                $aso->appendChild($exame);
            }
        }

        $respMonit = $this->dom->createElement("respMonit");

        $this->dom->addChild(
            $respMonit,
            "nisResp",
            $this->std->respmonit->nisresp,
            true
        );

        $this->dom->addChild(
            $respMonit,
            "nrConsClasse",
            $this->std->respmonit->nrconsclasse,
            true
        );

        $this->dom->addChild(
            $respMonit,
            "ufConsClasse",
            ! empty($this->std->respmonit->ufconsclasse) ? $this->std->respmonit->ufconsclasse : null,
            false
        );

        $exame->appendChild($respMonit);

        $ideServSaude = $this->dom->createElement("ideServSaude");

        $this->dom->addChild(
            $ideServSaude,
            "codCNES",
            ! empty($this->std->ideservsaude->codcnes) ? $this->std->ideservsaude->codcnes : null,
            false
        );

        $this->dom->addChild(
            $ideServSaude,
            "frmCtt",
            $this->std->ideservsaude->frmctt,
            true
        );

        $this->dom->addChild(
            $ideServSaude,
            "email",
            ! empty($this->std->ideservsaude->email) ? $this->std->ideservsaude->email : null,
            false
        );

        $aso->appendChild($ideServSaude);

        $medico = $this->dom->createElement("medico");

        $this->dom->addChild(
            $medico,
            "nmMed",
            $this->std->medico->nmmed,
            true
        );

        $ideServSaude->appendChild($medico);

        $crm = $this->dom->createElement("crm");

        $this->dom->addChild(
            $crm,
            "nrCRM",
            $this->std->medico->nrcrm,
            true
        );

        $this->dom->addChild(
            $crm,
            "ufCRM",
            $this->std->medico->ufcrm,
            true
        );

        $medico->appendChild($crm);

        $this->node->appendChild($aso);

        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
