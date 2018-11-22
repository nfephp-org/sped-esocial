<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtInfoEmpregador Event S-1000 constructor
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
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

class EvtInfoEmpregador extends Factory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $evtName = 'evtInfoEmpregador';

    /**
     * @var string
     */
    protected $evtAlias = 'S-1000';

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
        Certificate $certificate = null
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

        $infoEmpregador = $this->dom->createElement("infoEmpregador");

        //periodo
        $idePeriodo = $this->dom->createElement("idePeriodo");
        $this->dom->addChild(
            $idePeriodo,
            "iniValid",
            $this->std->ideperiodo->inivalid,
            true
        );
        $this->dom->addChild(
            $idePeriodo,
            "fimValid",
            !empty($this->std->ideperiodo->fimvalid) ? $this->std->ideperiodo->fimvalid : '',
            false
        );

        //infoCadastro
        if (isset($this->std->infocadastro)) {
            $cad = $this->std->infocadastro;
            $infoCadastro = $this->dom->createElement("infoCadastro");
            $this->dom->addChild(
                $infoCadastro,
                "nmRazao",
                $cad->nmrazao,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "classTrib",
                $cad->classtrib,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "natJurid",
                $cad->natjurid,
                ($this->tpInsc == 1) ? true : false //obrigatorio para pessoa juridica
            );
            $this->dom->addChild(
                $infoCadastro,
                "indCoop",
                $cad->indcoop,
                ($this->tpInsc == 1) ? true : false //obrigatorio para pessoa juridica
            );
            $this->dom->addChild(
                $infoCadastro,
                "indConstr",
                $cad->indconstr,
                ($this->tpInsc == 1) ? true : false //obrigatorio para pessoa juridica
            );
            $this->dom->addChild(
                $infoCadastro,
                "indDesFolha",
                $cad->inddesfolha,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "indOpcCP",
                $cad->indOpcCP,
                false
            );
            $this->dom->addChild(
                $infoCadastro,
                "indOptRegEletron",
                $cad->indoptregeletron,
                true
            );
            $this->dom->addChild(
                $infoCadastro,
                "indEntEd",
                $cad->indented,
                false
            );
            $this->dom->addChild(
                $infoCadastro,
                "indEtt",
                $cad->indett,
                false
            );
            if ($cad->indett == 'S') {
                $this->dom->addChild(
                    $infoCadastro,
                    "nrRegEtt",
                    $cad->nrregett,
                    false
                );
            }
        }

        if (isset($this->std->dadosisencao) && !empty($infoCadastro)) {
            $cad = $this->std->dadosisencao;
            $info = $this->dom->createElement("dadosIsencao");
            $this->dom->addChild(
                $info,
                "ideMinLei",
                $cad->ideminlei,
                true
            );
            $this->dom->addChild(
                $info,
                "nrCertif",
                $cad->nrcertif,
                true
            );
            $this->dom->addChild(
                $info,
                "dtEmisCertif",
                $cad->dtemiscertif,
                true
            );
            $this->dom->addChild(
                $info,
                "dtVencCertif",
                $cad->dtvenccertif,
                true
            );
            $this->dom->addChild(
                $info,
                "nrProtRenov",
                $cad->nrprotrenov,
                false
            );
            $this->dom->addChild(
                $info,
                "dtProtRenov",
                $cad->dtprotrenov,
                false
            );
            $this->dom->addChild(
                $info,
                "dtDou",
                $cad->dtdou,
                false
            );
            $this->dom->addChild(
                $info,
                "pagDou",
                $cad->pagdou,
                true
            );
            $infoCadastro->appendChild($info);
        }

        if (isset($this->std->contato) && !empty($infoCadastro)) {
            $cad = $this->std->contato;
            $info = $this->dom->createElement("contato");
            $this->dom->addChild(
                $info,
                "nmCtt",
                $cad->nmctt,
                true
            );
            $this->dom->addChild(
                $info,
                "cpfCtt",
                $cad->cpfctt,
                true
            );
            $this->dom->addChild(
                $info,
                "foneFixo",
                !empty($cad->fonefixo) ? $cad->fonefixo : '',
                false
            );
            $this->dom->addChild(
                $info,
                "foneCel",
                $cad->fonecel,
                false
            );
            $this->dom->addChild(
                $info,
                "email",
                $cad->email,
                false
            );
            $infoCadastro->appendChild($info);
        }

        if (isset($this->std->infoop) && !empty($infoCadastro)) {
            $cad = $this->std->infoop;
            $infoOP = $this->dom->createElement("infoOP");
            $this->dom->addChild(
                $infoOP,
                "nrSiafi",
                $cad->nrsiafi,
                true
            );
            if (isset($this->std->infoefr)) {
                $cad = $this->std->infoefr;
                $infoEFR = $this->dom->createElement("infoEFR");
                $this->dom->addChild(
                    $infoEFR,
                    "ideEFR",
                    $cad->ideefr,
                    true
                );
                if ($cad->ideefr == 'N') {
                    $this->dom->addChild(
                        $infoEFR,
                        "cnpjEFR",
                        $cad->cnpjefr,
                        false
                    );
                }
                $infoOP->appendChild($infoEFR);
            }
            if (isset($this->std->infoente)) {
                $cad = $this->std->infoente;
                $infoEnte = $this->dom->createElement("infoEnte");
                $this->dom->addChild(
                    $infoEnte,
                    "nmEnte",
                    $cad->nmente,
                    true
                );
                $this->dom->addChild(
                    $infoEnte,
                    "uf",
                    $cad->uf,
                    true
                );
                $this->dom->addChild(
                    $infoEnte,
                    "codMunic",
                    $cad->codmunic,
                    false
                );
                $this->dom->addChild(
                    $infoEnte,
                    "indRPPS",
                    $cad->indrpps,
                    true
                );
                $this->dom->addChild(
                    $infoEnte,
                    "subteto",
                    $cad->subteto,
                    true
                );
                $this->dom->addChild(
                    $infoEnte,
                    "vrSubteto",
                    number_format($cad->vrsubteto, 2, ".", ""),
                    true
                );
                $infoOP->appendChild($infoEnte);
            }
            $infoCadastro->appendChild($infoOP);
        }

        if (isset($this->std->infoorginternacional) && !empty($infoCadastro)) {
            $cad = $this->std->infoorginternacional;
            $info = $this->dom->createElement("infoOrgInternacional");
            $this->dom->addChild(
                $info,
                "indAcordoIsenMulta",
                $cad->indacordoisenmulta,
                true
            );
            $infoCadastro->appendChild($info);
        }

        if (isset($this->std->softwarehouse) && !empty($infoCadastro)) {
            foreach ($this->std->softwarehouse as $sh) {
                $info = $this->dom->createElement("softwareHouse");
                $this->dom->addChild(
                    $info,
                    "cnpjSoftHouse",
                    $sh->cnpjsofthouse,
                    true
                );
                $this->dom->addChild(
                    $info,
                    "nmRazao",
                    $sh->nmrazao,
                    true
                );
                $this->dom->addChild(
                    $info,
                    "nmCont",
                    $sh->nmcont,
                    true
                );
                $this->dom->addChild(
                    $info,
                    "telefone",
                    $sh->telefone,
                    true
                );
                $this->dom->addChild(
                    $info,
                    "email",
                    $sh->email,
                    false
                );
                $infoCadastro->appendChild($info);
            }
        }

        if (isset($this->std->situacaopj)) {
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $sh = $this->std->situacaopj;
            $info = $this->dom->createElement("situacaoPJ");
            $this->dom->addChild(
                $info,
                "indSitPJ",
                $sh->indsitpj,
                true
            );
            $infoComplementares->appendChild($info);
        } elseif (isset($this->std->situacaopf)) {
            $infoComplementares = $this->dom->createElement("infoComplementares");
            $sh = $this->std->situacaopf;
            $info = $this->dom->createElement("situacaoPF");
            $this->dom->addChild(
                $info,
                "indSitPF",
                $sh->indsitpf,
                true
            );
            $infoComplementares->appendChild($info);
        }

        if (isset($this->std->novavalidade)) {
            $sh = $this->std->novavalidade;
            $novavalidade = $this->dom->createElement("novaValidade");
            $this->dom->addChild(
                $novavalidade,
                "iniValid",
                $sh->inivalid,
                true
            );
            $this->dom->addChild(
                $novavalidade,
                "fimValid",
                $sh->fimValid,
                false
            );
        }

        switch ($this->std->modo) {
            case "INC":
                $node = $this->dom->createElement("inclusao");
                $node->appendChild($idePeriodo);
                if (isset($infoComplementares)) {
                    $infoCadastro->appendChild($infoComplementares);
                }
                $node->appendChild($infoCadastro);
                break;
            case "ALT":
                $node = $this->dom->createElement("alteracao");
                $node->appendChild($idePeriodo);
                if (isset($infoComplementares)) {
                    $infoCadastro->appendChild($infoComplementares);
                }
                $node->appendChild($infoCadastro);
                if (isset($novavalidade)) {
                    $node->appendChild($novavalidade);
                }
                break;
            case "EXC":
                $node = $this->dom->createElement("exclusao");
                $node->appendChild($idePeriodo);
                break;
        }

        $infoEmpregador->appendChild($node);
        $this->node->appendChild($infoEmpregador);

        //finalização do xml
        $this->eSocial->appendChild($this->node);
        $this->sign();
        //$this->xml = $this->dom->saveXML($this->eSocial);
    }
}
