<?php

namespace NFePHP\eSocial\Common\Soap;

/**
 * Soap fake class used for development only
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2017
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-common for the canonical source repository
 */

use NFePHP\Common\Certificate;
use Psr\Log\LoggerInterface;

class SoapFake extends SoapBase implements SoapInterface
{
    /**
     * Constructor
     *
     * @param Certificate $certificate
     * @param LoggerInterface $logger
     */
    public function __construct(
        Certificate $certificate = null,
        LoggerInterface $logger = null
    ) {
        parent::__construct($certificate, $logger);
    }
    
    public function send(
        $operation,
        $url,
        $action,
        $envelope,
        $parameters
    ) {
        $requestHead = implode("\n", $parameters);
        $requestBody = $envelope;
        return json_encode(
            [
                'url'        => $url,
                'operation'  => $operation,
                'action'     => $action,
                'soapver'    => '1.1',
                'parameters' => $parameters,
                'header'     => $requestHead,
                'namespaces' => [],
                'body'       => $requestBody,
            ],
            JSON_PRETTY_PRINT
        );
    }
}
