<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS2221
{
    /**
     * builder for version S.1.0.0
     */
    protected function toNodeS100()
    {
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S_1.0 !!");
    }

    /**
     * builder for version S.1.1.0
     */
    protected function toNodeS110()
    {
        return $this->toNodeS100();
    }
}
