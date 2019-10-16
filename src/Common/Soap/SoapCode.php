<?php

namespace NFePHP\eSocial\Common\Soap;

/**
 * SoapCode return a description os HTTP Codes returned from server
 * useful to help identify the cause of the communication problem,
 * either with a SOAP server or a server RESTFUL
 * The codes and their descriptions are stored in a json file in the same folder
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2016
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-common for the canonical source repository
 */

class SoapCode
{
    public static function info($code)
    {
        $codes = (array) json_decode(file_get_contents(__DIR__.'/httpcodes.json'), true);
        if (array_key_exists($code, $codes)) {
            return $codes[$code];
        }
        return ['level' => 'Desconhecido', 'description' => 'Desconhecido', 'means' => 'Desconhecido'];
    }
}
