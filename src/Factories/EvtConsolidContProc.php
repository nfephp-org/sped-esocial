<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtConsolidContProc Event S-2555 constructor
 * Read for S 1.3.0 layout
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2023
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

class EvtConsolidContProc extends Factory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $evtName = 'evtConsolidContProc';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2555';
    /**
     * Parameters patterns
     *
     * @var array
     */
    protected $parameters = [];

    //Trait que contêm os métodos construtores das versões diferentes ainda ativas
    //quando uma versão for desativada o metodo correspondente pode e deve ser removido
    use Traits\TraitS2555;

    /**
     * Constructor
     *
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate | null
     * @param string $date
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate = null,
        $date = ''
    ) {
        parent::__construct($config, $std, $certificate, $date);
    }
}
