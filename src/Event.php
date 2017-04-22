<?php

namespace NFePHP\eSocial;

/**
 * Class eSocial Event constructor
 *
 * @category  NFePHP
 * @package   NFePHP\eSocial\Event
 * @copyright NFePHP Copyright (c) 2017
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfe for the canonical source repository
 */

use InvalidArgumentException;

class Event
{
    private static $available = [
        'evtadmissao' => Factories\EvtAdmissao::class,
        'evtcs' => Factories\EvtCS::class,
        'evtrmnrpps' => Factories\EvtRmnRPPS::class,
        'evtadmprelim' => Factories\EvtAdmPrelim::class,
        'evtdeslig' => Factories\EvtDeslig::class,
        'evttabambiente' => Factories\EvtTabAmbiente::class,
        'evtafasttemp' => Factories\EvtAfastTemp::class,
        'evtexclusao' => Factories\EvtExclusao::class,
        'evttabcargo' => Factories\EvtTabCargo::class,
        'evtaltcadastral' => Factories\EvtAltCadastral::class,
        'evtexprisco' => Factories\EvtExpRisco::class,
        'evttabcarreira' => Factories\EvtTabCarreira::class,
        'evtaltcontratual' => Factories\EvtAltContratual::class,
        'evtfechaevper' => Factories\EvtFechaEvPer::class,
        'evttabestab' => Factories\EvtTabEstab::class,
        'evtaqprod' => Factories\EvtAqProd::class,
        'evtinfocomplper' => Factories\EvtInfoComplPer::class,
        'evttabfuncao' => Factories\EvtTabFuncao::class,
        'evtavprevio' => Factories\EvtAvPrevio::class,
        'evtinfoempregador' => Factories\EvtInfoEmpregador::class,
        'evttabhortur' => Factories\EvtTabHorTur::class,
        'evtbasestrab' => Factories\EvtBasesTrab::class,
        'evtinsapo' => Factories\EvtInsApo::class,
        'evttablotacao' => Factories\EvtTabLotacao::class,
        'evtbenprrp' => Factories\EvtBenPrRP::class,
        'evtirrfbenef' => Factories\EvtIrrfBenef::class,
        'evttaboperport' => Factories\EvtTabOperPort::class,
        'evtcadinicial' => Factories\EvtCadInicial::class,
        'evtirrf' => Factories\EvtIrrf::class,
        'evttabprocesso' => Factories\EvtTabProcesso::class,
        'evtcat' => Factories\EvtCAT::class,
        'evtmonit' => Factories\EvtMonit::class,
        'evttabrubrica' => Factories\EvtTabRubrica::class,
        'evtcdbenprrp' => Factories\EvtCdBenPrRP::class,
        'evtpgtos' => Factories\EvtPgtos::class,
        'evttsvaltcontr' => Factories\EvtTSVAltContr::class,
        'evtcomprod' => Factories\EvtComProd::class,
        'evtreabreevper' => Factories\EvtReabreEvPer::class,
        'evttsvinicio' => Factories\EvtTSVInicio::class,
        'evtcontratavnp' => Factories\EvtContratAvNP::class,
        'evtreintegr' => Factories\EvtReintegr::class,
        'evttsvtermino' => Factories\EvtTSVTermino::class,
        'evtcontrsindpatr' => Factories\EvtContrSindPatr::class,
        'evtremun' => Factories\EvtRemun::class
    ];
    
    /**
     * Call classes to build XML eSocial Event
     * @param string $name
     * @param array $arguments
     * @return \NFePHP\eSocial\Factories\className
     * @throws InvalidArgumentException
     */
    public static function __callStatic($name, $arguments)
    {
        //incluir aliases ??
        $className = self::$available[strtolower($name)];
        if (empty($className)) {
            throw new InvalidArgumentException('Event name not found.');
        }
        return new $className($arguments[0],$arguments[1]);
    }
}
