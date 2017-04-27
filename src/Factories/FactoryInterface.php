<?php

namespace NFePHP\eSocial\Factories;

interface FactoryInterface
{
    public function toString();
    
    public function toJson();
    
    public function toStd();
    
    public function toArray();
}
