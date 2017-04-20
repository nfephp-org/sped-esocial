<?php

namespace NFePHP\eSocial\Factories;

use NFePHP\eSocial\Factories\Factory;
use NFePHP\eSocial\Factories\FactoryInterface;
use stdClass;

class EvtInfoComplPer extends Factory implements FactoryInterface
{
    const EVT_NAME = 'evtInfoComplPer';

    public function __construct(stdClass $std)
    {
        parent::__construct($std);
    }
    

    public function toNode()
    {
    }
}
