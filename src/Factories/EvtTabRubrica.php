<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtTabRubrica Event S-1010 constructor
 * READ for 2.5.0 layout
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
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

class EvtTabRubrica extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtTabRubrica';
    /**
     * @var string
     */
    protected $evtAlias = 'S-1010';
    /**
     * Parameters patterns
     *
     * @var array
     */
    protected $parameters = [];
    
    //Trait que contêm os métodos construtores das versões diferentes ainda ativas
    //quando uma versão for desativada o metodo correspondente pode e deve ser removido
    use Traits\TraitS1010;

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
        Certificate $certificate = null,
        $date = ''
    ) {
        parent::__construct($config, $std, $certificate, $date);
    }
}
