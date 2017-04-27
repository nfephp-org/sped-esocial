<?php

namespace NFePHP\eSocial\Factories;

interface FactoryInterface
{
    public function toXML();
    
    public function toJson();
    
    public function toStd();
    
    public function toArray();
}
