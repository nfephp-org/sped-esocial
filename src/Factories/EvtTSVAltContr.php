<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTSVAltContr Event S-2306 constructor
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
            $this->std->trabsemvinculo->cpftrab,
            true
        );
        $this->dom->addChild(
            $ideTrabSemVinculo,
            "nisTrab",
            !empty($this->std->trabsemvinculo->nistrab) ? $this->std->trabsemvinculo->nistrab : null,
            false
        );
        $this->dom->addChild(
            $ideTrabSemVinculo,
            "codCateg",
            $this->std->trabsemvinculo->codcateg,
            true
        );
        $this->node->appendChild($ideTrabSemVinculo);
        $infoTSVAlteracao = $this->dom->createElement("infoTSVAlteracao");
        $this->dom->addChild(
            $infoTSVAlteracao,
            "dtAlteracao",
            $this->std->tsvalteracao->dtalteracao,
            true
        );
        $this->dom->addChild(
            $infoTSVAlteracao,
            "codFuncao",
            !empty($this->std->tsvalteracao->codfuncao) ? $this->std->tsvalteracao->codfuncao : null,
            false
        );
        $infoComplementares = $this->dom->createElement("infoComplementares");
        $infoTSVAlteracao->appendChild($infoComplementares);
        if (isset($this->std->cargofuncao)) {
            $cargoFuncao = $this->dom->createElement("cargoFuncao");
            $this->dom->addChild(
                $cargoFuncao,
                "codCargo",
                $this->std->cargofuncao->codcargo,
                true
            );
            $this->dom->addChild(
                $cargoFuncao,
                "codFuncao",
                !empty($this->std->cargofuncao->codfuncao) ? $this->std->cargofuncao->codfuncao : null,
                false
            );
            $infoComplementares->appendChild($cargoFuncao);
        }
        if (isset($this->std->remuneracao)) {
            $remuneracao = $this->dom->createElement("remuneracao");
            $this->dom->addChild(
                $remuneracao,
                "vrSalFx",
                $this->std->remuneracao->vrsalfx,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "undSalFixo",
                $this->std->remuneracao->undsalfixo,
                true
            );
            $this->dom->addChild(
                $remuneracao,
                "dscSalVar",
                !empty($this->std->remuneracao->dscsalVar) ? $this->std->remuneracao->dscsalVar : null,
                false
            );
            $infoComplementares->appendChild($remuneracao);
        }
        if (isset($this->std->estagiario)) {
            $infoEstagiario = $this->dom->createElement("infoEstagiario");
            $this->dom->addChild(
                $infoEstagiario,
                "natEstagio",
                $this->std->estagiario->natestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nivEstagio",
                $this->std->estagiario->nivestagio,
                true
            );
            $this->dom->addChild(
                $infoEstagiario,
                "areaAtuacao",
                !empty($this->std->estagiario->areaatuacao) ? $this->std->estagiario->areaatuacao : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "nrApol",
                !empty($this->std->estagiario->nrapol) ? $this->std->estagiario->nrapol : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "vlrBolsa",
                !empty($this->std->estagiario->vlrbolsa) ? $this->std->estagiario->vlrbolsa : null,
                false
            );
            $this->dom->addChild(
                $infoEstagiario,
                "dtPrevTerm",
                $this->std->estagiario->dtprevterm,
                true
            );
            if (isset($this->std->estagiario->instituicao)) {
                $instEnsino = $this->dom->createElement("instEnsino");
                $this->dom->addChild(
                    $instEnsino,
                    "cnpjInstEnsino",
                    $this->std->estagiario->instituicao->cnpjinstensino,
                    true
                );
                $this->dom->addChild(
                    $instEnsino,
                    "nmRazao",
                    $this->std->estagiario->instituicao->nmrazao,
                    true
                );
                $this->dom->addChild(
                    $instEnsino,
                    "dscLograd",
                    !empty($this->std->estagiario->instituicao->dsclograd) ?
                        $this->std->estagiario->instituicao->dsclograd : null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "nrLograd",
                    !empty($this->std->estagiario->instituicao->nrlograd) ?
                        $this->std->estagiario->instituicao->nrlograd : null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "bairro",
                    !empty($this->std->estagiario->instituicao->bairro) ? $this->std->estagiario->instituicao->bairro :
                        null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "cep",
                    !empty($this->std->estagiario->instituicao->cep) ? $this->std->estagiario->instituicao->cep : null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "codMunic",
                    !empty($this->std->estagiario->instituicao->codmunic) ?
                        $this->std->estagiario->instituicao->codmunic : null,
                    false
                );
                $this->dom->addChild(
                    $instEnsino,
                    "uf",
                    !empty($this->std->estagiario->instituicao->uf) ? $this->std->estagiario->instituicao->uf : null,
                    false
                );
                $infoEstagiario->appendChild($instEnsino);
            }
            if (isset($this->std->estagiario->ageintegracao)) {
                $ageIntegracao = $this->dom->createElement("ageIntegracao");
                $this->dom->addChild(
                    $ageIntegracao,
                    "cnpjAgntInteg",
                    $this->std->estagiario->ageintegracao->cnpjagntinteg,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "nmRazao",
                    $this->std->estagiario->ageintegracao->nmrazao,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "dscLograd",
                    $this->std->estagiario->ageintegracao->dsclograd,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "nrLograd",
                    $this->std->estagiario->ageintegracao->nrlograd,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "bairro",
                    !empty($this->std->estagiario->ageintegracao->bairro) ?
                        $this->std->estagiario->ageintegracao->bairro : null,
                    false
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "cep",
                    $this->std->estagiario->ageintegracao->cep,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "codMunic",
                    $this->std->estagiario->ageintegracao->codmunic,
                    true
                );
                $this->dom->addChild(
                    $ageIntegracao,
                    "uf",
                    $this->std->estagiario->ageintegracao->uf,
                    true
                );
                $infoEstagiario->appendChild($ageIntegracao);
            }
            if (isset($this->std->estagiario->supervisor)) {
                $supervisorEstagio = $this->dom->createElement("supervisorEstagio");
                $this->dom->addChild(
                    $supervisorEstagio,
                    "cpfSupervisor",
                    $this->std->estagiario->supervisor->cpfsupervisor,
                    true
                );
                $this->dom->addChild(
                    $supervisorEstagio,
                    "nmSuperv",
                    $this->std->estagiario->supervisor->nmsuperv,
                    true
                );
                $infoEstagiario->appendChild($supervisorEstagio);
            }
            $infoComplementares->appendChild($infoEstagiario);
        }
        $this->node->appendChild($infoTSVAlteracao);
        $this->eSocial->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->eSocial);
        $this->sign();
    }
}
