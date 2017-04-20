<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use stdClass;

class EvtExclusao extends Factory implements FactoryInterface
{
    const EVT_NAME = 'evtExclusao';

    public function __construct(stdClass $std)
    {
        parent::__construct($std);
    }
    

    public function toNode()
    {
    }
}
