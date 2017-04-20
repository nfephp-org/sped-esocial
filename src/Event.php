<?php

namespace NFePHP\eSocial;

/**
 * Class eSocial Event constructor
 *
 * @category  NFePHP
 * @package   NFePHP\eSocial\Event
 * @copyright NFePHP Copyright (c) 2008 - 2017
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfe for the canonical source repository
 */

use \InvalidArgumentException;

class Event
{
    private static $available = [
        'evtAdmissao' => Factories\EvtAdmissao::class,
        'evtCS' => Factories\EvtCS::class,
        'evtRmnRPPS' => Factories\EvtRmnRPPS::class,
        'evtAdmPrelim' => Factories\EvtAdmPrelim::class,
        'evtDeslig' => Factories\EvtDeslig::class,
        'evtTabAmbiente' => Factories\EvtTabAmbiente::class,
        'evtAfastTemp' => Factories\EvtAfastTemp::class,
        'evtExclusao' => Factories\EvtExclusao::class,
        'evtTabCargo' => Factories\EvtTabCargo::class,
        'evtAltCadastral' => Factories\EvtAltCadastral::class,
        'evtExpRisco' => Factories\EvtExpRisco::class,
        'evtTabCarreira' => Factories\EvtTabCarreira::class,
        'evtAltContratual' => Factories\EvtAltContratual::class,
        'evtFechaEvPer' => Factories\EvtFechaEvPer::class,
        'evtTabEstab' => Factories\EvtTabEstab::class,
        'evtAqProd' => Factories\EvtAqProd::class,
        'evtInfoComplPer' => Factories\EvtInfoComplPer::class,
        'evtTabFuncao' => Factories\EvtTabFuncao::class,
        'evtAvPrevio' => Factories\EvtAvPrevio::class,
        'evtInfoEmpregador' => Factories\EvtInfoEmpregador::class,
        'evtTabHorTur' => Factories\EvtTabHorTur::class,
        'evtBasesTrab' => Factories\EvtBasesTrab::class,
        'evtInsApo' => Factories\EvtInsApo::class,
        'evtTabLotacao' => Factories\EvtTabLotacao::class,
        'evtBenPrRP' => Factories\EvtBenPrRP::class,
        'evtIrrfBenef' => Factories\EvtIrrfBenef::class,
        'evtTabOperPort' => Factories\EvtTabOperPort::class,
        'evtCadInicial' => Factories\EvtCadInicial::class,
        'evtIrrf' => Factories\EvtIrrf::class,
        'evtTabProcesso' => Factories\EvtTabProcesso::class,
        'evtCAT' => Factories\EvtCAT::class,
        'evtMonit' => Factories\EvtMonit::class,
        'evtTabRubrica' => Factories\EvtTabRubrica::class,
        'evtCdBenPrRP' => Factories\EvtCdBenPrRP::class,
        'evtPgtos' => Factories\EvtPgtos::class,
        'evtTSVAltContr' => Factories\EvtTSVAltContr::class,
        'evtComProd' => Factories\EvtComProd::class,
        'evtReabreEvPer' => Factories\EvtReabreEvPer::class,
        'evtTSVInicio' => Factories\EvtTSVInicio::class,
        'evtContratAvNP' => Factories\EvtContratAvNP::class,
        'evtReintegr' => Factories\EvtReintegr::class,
        'evtTSVTermino' => Factories\EvtTSVTermino::class,
        'evtContrSindPatr' => Factories\EvtContrSindPatr::class,
        'evtRemun' => Factories\EvtRemun::class
    ];
    
    /**
     * Call classes to build XML eSocial Event
     * @param type $name
     * @param type $arguments
     * @return \NFePHP\eSocial\Factories\className
     * @throws InvalidArgumentException
     */
    public static function __callStatic($name, $arguments)
    {
        $className = self::$available[strtolower($name)];
        if (empty($className)) {
            throw new InvalidArgumentException('Event name not found.');
        }
        return new $className($arguments[0]);
    }
}
