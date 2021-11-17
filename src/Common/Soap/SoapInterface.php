<?php

namespace NFePHP\eSocial\Common\Soap;

/**
 * Soap class interface
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2016
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfse for the canonical source repository
 */

use NFePHP\Common\Certificate;
use Psr\Log\LoggerInterface;

interface SoapInterface
{
    const SSL_DEFAULT = 0; //default
    const SSL_TLSV1   = 1; //TLSv1
    const SSL_SSLV2   = 2; //SSLv2
    const SSL_SSLV3   = 3; //SSLv3
    const SSL_TLSV1_0 = 4; //TLSv1.0
    const SSL_TLSV1_1 = 5; //TLSv1.1
    const SSL_TLSV1_2 = 6; //TLSv1.2
    /**
     * Load Certificate::class
     * @param Certificate $certificate
     */
    public function loadCertificate(Certificate $certificate);
    /**
     * Set logger class
     * @param LoggerInterface $logger
     */
    public function loadLogger(LoggerInterface $logger);
    /**
     * Set timeout for connection
     * @param int $timesecs
     */
    public function timeout($timesecs);
    /**
     * Set security protocol for soap communications
     * @param int $protocol
     */
    public function protocol($protocol = self::SSL_DEFAULT);
    /**
     * Set proxy parameters
     * @param string $ip
     * @param int $port
     * @param string $user
     * @param string $password
     */
    public function proxy($ip, $port, $user, $password);
    /**
     * Send soap message
     * @param string $operation
     * @param string $url
     * @param string $action
     * @param string $envelope
     * @param array $parameters
      */
    public function send(
        $operation,
        $url,
        $action,
        $envelope,
        $parameters
    );
}
