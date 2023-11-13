<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Common\Factory;
use NFePHP\eSocial\Common\FactoryInterface;
use stdClass;

/**
 * Class eSocial EvtAnotJud Event S-8200 constructor
 * Read for S_1.2
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

class EvtAnotJud extends Factory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $evtName = 'evtAnotJud';
    /**
     * @var string
     */
    protected $evtAlias = 'S-8200';
    /**
     * @var array
     */
    protected $parameters = [];

    //Trait que contêm os métodos construtores das versões diferentes ainda ativas
    //quando uma versão for desativada o metodo correspondente pode e deve ser removido
    use Traits\TraitS8200;

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
        throw new \Exception("Este evento somente pode ser criado por "
            ."aplicativo governamental para envio de eventos pelo Judiciário");
    }
}
