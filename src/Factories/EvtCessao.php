<?php

namespace NFePHP\eSocial\Factories;

/**
 * Class eSocial EvtCessao Event S-2231 constructor
 * Read for S.1.0 layout
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2021
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

class EvtCessao extends Factory implements FactoryInterface
{
    /**
     * @var int
     */
    public $sequencial;
    /**
     * @var string
     */
    protected $evtName = 'evtCessao';
    /**
     * @var string
     */
    protected $evtAlias = 'S-2231';
    /**
     * Parameters patterns
     *
     * @var array
     */
    protected $parameters = [];
    
    //Trait que cont�m os m�todos construtores das vers�es diferentes ainda ativas
    //quando uma vers�o for desativada o metodo correspondente pode e deve ser removido
    use Traits\TraitS2231;

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