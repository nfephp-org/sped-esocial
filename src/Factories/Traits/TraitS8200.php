<?php

namespace NFePHP\eSocial\Factories\Traits;

trait TraitS8200
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
        throw new \Exception("NÃO EXISTE EVENTO {$this->evtAlias} na versão S_1.1 !!");
    }

    /**
     * builder for version S.1.2.0
     */
    protected function toNodeS120()
    {
        //sem necessidade de criação do evento pois somente pode ser enviado pelo poder judiciário
    }

}
