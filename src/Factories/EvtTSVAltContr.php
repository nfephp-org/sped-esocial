<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTSVAltContr Event S-2306 constructor
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

class EvtTSVAltContr extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtTSVAltContr';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2306';
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
        file_put_contents("/var/www/eita.txt", var_export($std, true));
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

        $evtTSVAltContr = $this->dom->createElement("evtTSVAltContr");

        $att = $this->dom->createAttribute('Id');

        $att->value = $evtid;

        $evtTSVAltContr->appendChild($att);

        $ideEmpregador = $this->node->getElementsByTagName('ideEmpregador')->item(0);

        $ideEvento = $this->dom->createElement("ideEvento");

        $this->dom->addChild(
            $ideEvento,
            "indRetif",
            $this->std->indretif,
            true
        );

        if (isset($this->std->nrrecibo)) {
            $this->dom->addChild(
              $ideEvento,
              "nrRecibo",
              $this->std->nrrecibo,
              false
            );
        }

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

        $ideTrabSemVinculo = $this->dom->createElement("ideTrabSemVinculo");

        $this->dom->addChild(
            $ideTrabSemVinculo,
            "cpfTrab",
            $this->std->idetrabsemvinculo->cpftrab,
            true
        );

        $this->dom->addChild(
            $ideTrabSemVinculo,
            "nisTrab",
            !empty($this->std->idetrabsemvinculo->nistrab) ? $this->std->idetrabsemvinculo->nistrab : null,
            false
        );

        $this->dom->addChild(
            $ideTrabSemVinculo,
            "codCateg",
            $this->std->idetrabsemvinculo->codcateg,
            true
        );

        $this->node->appendChild($ideTrabSemVinculo);

        $infoTSVAlteracao = $this->dom->createElement("infoTSVAlteracao");

        $this->dom->addChild(
            $infoTSVAlteracao,
            "dtAlteracao",
            $this->std->infotsvalteracao->dtalteracao,
            true
        );

        $this->dom->addChild(
            $infoTSVAlteracao,
            "natAtividade",
            !empty($this->std->infotsvalteracao->natatividade) ? $this->std->infotsvalteracao->natatividade : null,
            false
        );

        $infoComplementares = $this->dom->createElement("infoComplementares");

        if (isset($this->std->infotsvalteracao->infocomplementares->cargofuncao)) {
            $stdCargofuncao = $this->std->infotsvalteracao->infocomplementares->cargofuncao;
            $cargoFuncao = $this->dom->createElement("cargoFuncao");

            $this->dom->addChild(
                $cargoFuncao,
                "codCargo",
                $stdCargofuncao->codcargo,
                true
            );

            $this->dom->addChild(
                $cargoFuncao,
                "codFuncao",
                !empty($stdCargofuncao->codfuncao) ? $stdCargofuncao->codfuncao : null,
                false
            );

            $infoComplementares->appendChild($cargoFuncao);
        }

        if (isset($this->std->infotsvalteracao->infocomplementares->remuneracao)) {
            $remuneracao = $this->dom->createElement("remuneracao");
            $stdRemuneracao = $this->std->infotsvalteracao->infocomplementares->remuneracao;

            $this->dom->addChild(
                $remuneracao,
                "vrSalFx",
                $stdRemuneracao->vrsalfx,
                true
            );

            $this->dom->addChild(
                $remuneracao,
                "undSalFixo",
                $stdRemuneracao->undsalfixo,
                true
            );

            $this->dom->addChild(
                $remuneracao,
                "dscSalVar",
                !empty($stdRemuneracao->dscsalVar) ? $stdRemuneracao->dscsalVar : null,
                false
            );

            $infoComplementares->appendChild($remuneracao);
        }

        if (isset($this->std->infotsvalteracao->infocomplementares->infoestagiario)) {
            $stdEstagiario = $this->std->infotsvalteracao->infocomplementares->infoestagiario;
            $infoEstagiario = $this->dom->createElement("infoEstagiario");

            $this->dom->addChild(
                $infoEstagiario,
                "natEstagio",
                $stdEstagiario->natestagio,
                true
            );

            $this->dom->addChild(
                $infoEstagiario,
                "nivEstagio",
                $stdEstagiario->nivestagio,
                true
            );

            $this->dom->addChild(
                $infoEstagiario,
                "areaAtuacao",
                !empty($stdEstagiario->areaatuacao) ? $stdEstagiario->areaatuacao : null,
                false
            );

            $this->dom->addChild(
                $infoEstagiario,
                "nrApol",
                !empty($stdEstagiario->nrapol) ? $stdEstagiario->nrapol : null,
                false
            );

            $this->dom->addChild(
                $infoEstagiario,
                "vlrBolsa",
                !empty($stdEstagiario->vlrbolsa) ? $stdEstagiario->vlrbolsa : null,
                false
            );

            $this->dom->addChild(
                $infoEstagiario,
                "dtPrevTerm",
                $stdEstagiario->dtprevterm,
                true
            );

            if (isset($stdEstagiario->instensino)) {
                $instEnsino = $this->dom->createElement("instEnsino");

                $this->dom->addChild(
                    $instEnsino,
                    "cnpjInstEnsino",
                    $stdEstagiario->instensino->cnpjinstensino,
                    true
                );

                $this->dom->addChild(
                    $instEnsino,
                    "nmRazao",
                    $stdEstagiario->instensino->nmrazao,
                    true
                );

                $this->dom->addChild(
                    $instEnsino,
                    "dscLograd",
                    !empty($stdEstagiario->instensino->dsclograd) ?
                        $stdEstagiario->instensino->dsclograd : null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "nrLograd",
                    !empty($stdEstagiario->instensino->nrlograd) ?
                        $stdEstagiario->instensino->nrlograd : null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "bairro",
                    !empty($stdEstagiario->instensino->bairro) ? $stdEstagiario->instensino->bairro :
                        null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "cep",
                    !empty($stdEstagiario->instensino->cep) ? $stdEstagiario->instensino->cep : null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "codMunic",
                    !empty($stdEstagiario->instensino->codmunic) ?
                        $stdEstagiario->instensino->codmunic : null,
                    false
                );

                $this->dom->addChild(
                    $instEnsino,
                    "uf",
                    !empty($stdEstagiario->instensino->uf) ? $stdEstagiario->instensino->uf : null,
                    false
                );

                $infoEstagiario->appendChild($instEnsino);
            }

            if (isset($stdEstagiario->ageintegracao)) {
                $ageIntegracao = $this->dom->createElement("ageIntegracao");

                $this->dom->addChild(
                    $ageIntegracao,
                    "cnpjAgntInteg",
                    $stdEstagiario->ageintegracao->cnpjagntinteg,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "nmRazao",
                    $stdEstagiario->ageintegracao->nmrazao,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "dscLograd",
                    $stdEstagiario->ageintegracao->dsclograd,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "nrLograd",
                    $stdEstagiario->ageintegracao->nrlograd,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "bairro",
                    !empty($stdEstagiario->ageintegracao->bairro) ?
                        $stdEstagiario->ageintegracao->bairro : null,
                    false
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "cep",
                    $stdEstagiario->ageintegracao->cep,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "codMunic",
                    $stdEstagiario->ageintegracao->codmunic,
                    true
                );

                $this->dom->addChild(
                    $ageIntegracao,
                    "uf",
                    $stdEstagiario->ageintegracao->uf,
                    true
                );

                $infoEstagiario->appendChild($ageIntegracao);
            }

            if (isset($stdEstagiario->supervisorestagio)) {
                $supervisorEstagio = $this->dom->createElement("supervisorEstagio");

                $this->dom->addChild(
                    $supervisorEstagio,
                    "cpfSupervisor",
                    $stdEstagiario->supervisorestagio->cpfsupervisor,
                    true
                );

                $this->dom->addChild(
                    $supervisorEstagio,
                    "nmSuperv",
                    $stdEstagiario->supervisorestagio->nmsuperv,
                    true
                );


                $infoEstagiario->appendChild($supervisorEstagio);
            }

            $infoComplementares->appendChild($infoEstagiario);
        }

        $infoTSVAlteracao->appendChild($infoComplementares);
        $this->node->appendChild($infoTSVAlteracao);

        $this->eSocial->appendChild($this->node);
        $this->sign();
    }
}
