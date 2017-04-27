<?php

namespace NFePHP\eSocial\Factories;

interface FactoryInterface
{
    protected function toNode();
    
    public function __toString();
    
    public function toJson();
    
    public function toStd();
    
    public function toArray();
}
