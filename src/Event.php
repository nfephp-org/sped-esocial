<?php

namespace NFePHP\eSocial;

/**
 * Class eSocial Event constructor
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
use NFePHP\eSocial\Exception\EventsException;

class Event
{
    /**
     * Relationship between the name of the event and its respective class
     * @var array
     */
    private static $available = [
        'evtadmissao' => Factories\EvtAdmissao::class,
        'evtcs' => Factories\EvtCS::class,
        'evtcessao' => Factories\EvtCessao::class,
        'evtpgtos' => Factories\EvtPgtos::class,
        'evtrmnrpps' => Factories\EvtRmnRPPS::class,
        'evtadmprelim' => Factories\EvtAdmPrelim::class,
        'evtdeslig' => Factories\EvtDeslig::class,
        'evttabambiente' => Factories\EvtTabAmbiente::class,
        'evttabequipamento' => Factories\EvtTabEquipamento::class,
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
        'evttreicap' => Factories\EvtTreiCap::class,
        'evtconvinterm' => Factories\EvtConvInterm::class,
        'evttablotacao' => Factories\EvtTabLotacao::class,
        'evtbenprrp' => Factories\EvtBenPrRP::class,
        'evtirrfbenef' => Factories\EvtIrrfBenef::class,
        'evttaboperport' => Factories\EvtTabOperPort::class,
        'evtirrf' => Factories\EvtIrrf::class,
        'evttabprocesso' => Factories\EvtTabProcesso::class,
        'evtcat' => Factories\EvtCAT::class,
        'evtmonit' => Factories\EvtMonit::class,
        'evttabrubrica' => Factories\EvtTabRubrica::class,
        'evtcdbenprrp' => Factories\EvtCdBenPrRP::class,
        'evtcdbenefin' => Factories\EvtCdBenPrRP::class, //novo nome para evento S-2400
        'evtcdbenefalt' => Factories\EvtCdBenefAlt::class,
        'evtcdbenin' => Factories\EvtCdBenIn::class,
        'evtcdbenalt' => Factories\EvtCdBenAlt::class,
        'evtreativben' => Factories\EvtReativBen::class,
        'evtcdbenterm' => Factories\EvtCdBenTerm::class,
        'evttsvaltcontr' => Factories\EvtTSVAltContr::class,
        'evtcomprod' => Factories\EvtComProd::class,
        'evtreabreevper' => Factories\EvtReabreEvPer::class,
        'evttsvinicio' => Factories\EvtTSVInicio::class,
        'evtcontratavnp' => Factories\EvtContratAvNP::class,
        'evtreintegr' => Factories\EvtReintegr::class,
        'evttsvtermino' => Factories\EvtTSVTermino::class,
        'evtcontrsindpatr' => Factories\EvtContrSindPatr::class,
        'evtremun' => Factories\EvtRemun::class,
        'evttotconting' => Factories\EvtTotConting::class,
        'evttoxic' => Factories\EvtToxic::class,
        'evtfgts' => Factories\EvtFGTS::class,
        'evtbasesfgts' => Factories\EvtBasesFGTS::class,
        'evtbaixa' => Factories\EvtBaixa::class,
    ];

    /**
     * Relationship between the code of the event and its respective name
     *
     * @var array
     */
    private static $aliases = [
        's2200' => 'evtadmissao',
        's5011' => 'evtcs',
        's2231' => 'evtcessao',
        's1202' => 'evtrmnrpps',
        's2190' => 'evtadmprelim',
        's2299' => 'evtdeslig',
        's1060' => 'evttabambiente',
        's1065' => 'evttabequipamento',
        's2230' => 'evtafasttemp',
        's3000' => 'evtexclusao',
        's1030' => 'evttabcargo',
        's2205' => 'evtaltcadastral',
        's2240' => 'evtexprisco',
        's1035' => 'evttabcarreira',
        's2206' => 'evtaltcontratual',
        's1299' => 'evtfechaevper',
        's1005' => 'evttabestab',
        's1250' => 'evtaqprod',
        's1280' => 'evtinfocomplper',
        's1040' => 'evttabfuncao',
        's2250' => 'evtavprevio',
        's1000' => 'evtinfoempregador',
        's1050' => 'evttabhortur',
        's5001' => 'evtbasestrab',
        's2241' => 'evtinsapo',
        's2245' => 'evttreicap',
        's2260' => 'evtconvinterm',
        's1020' => 'evttablotacao',
        's1207' => 'evtbenprrp',
        's5002' => 'evtirrfbenef',
        's1080' => 'evttaboperport',
        's5012' => 'evtirrf',
        's1070' => 'evttabprocesso',
        's2210' => 'evtcat',
        's2220' => 'evtmonit',
        's2221' => 'evttoxic',
        's1010' => 'evttabrubrica',
        's2400' => 'evtcdbenprrp',
        's1210' => 'evtpgtos',
        's2306' => 'evttsvaltcontr',
        's1260' => 'evtcomprod',
        's1298' => 'evtreabreevper',
        's2300' => 'evttsvinicio',
        's1270' => 'evtcontratavnp',
        's2298' => 'evtreintegr',
        's2399' => 'evttsvtermino',
        's1300' => 'evtcontrsindpatr',
        's1200' => 'evtremun',
        's1295' => 'evttotconting',
        's5003' => 'evtbasesfgts',
        's5013' => 'evtfgts',
        's8299' => 'evtbaixa',
        's2405' => 'evtcdbenefalt',
        's2410' => 'evtcdbenin',
        's2416' => 'evtcdbenalt',
        's2418' => 'evtreativben',
        's2420' => 'evtcdbenterm',
    ];

    /**
     * Call classes to build XML eSocial Event
     *
     * @param  string $name
     * @param  array $arguments [config, std, certificate, $date]
     *
     * @return object
     * @throws InvalidArgumentException
     */
    public static function __callStatic($name, $arguments)
    {
        $name = str_replace('-', '', strtolower($name));
        $realname = $name;
        if (substr($name, 0, 1) == 's') {
            if (!array_key_exists($name, self::$aliases)) {
                //este evento não foi localizado
                throw EventsException::wrongArgument(1000, $name);
            }
            $realname = self::$aliases[$name];
        }
        if (!array_key_exists($realname, self::$available)) {
            //este evento não foi localizado
            throw EventsException::wrongArgument(1000, $name);
        }
        $className = self::$available[$realname];
        if (empty($arguments[0])) {
            throw EventsException::wrongArgument(1001);
        }
        if (empty($arguments[1])) {
            throw EventsException::wrongArgument(1002, $name);
        }
        if (count($arguments) > 1 && count($arguments) < 3) {
            return new $className($arguments[0], $arguments[1]);
        }
        if (count($arguments) > 2 && count($arguments) < 4) {
            return new $className($arguments[0], $arguments[1], $arguments[2]);
        }
        if (count($arguments) > 3) {
            return new $className($arguments[0], $arguments[1], $arguments[2], $arguments[3]);
        }
        return new $className($arguments[0], $arguments[1]);
    }
}
