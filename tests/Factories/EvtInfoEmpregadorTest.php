<?php

namespace NFePHP\eSocial\Tests\Factories;

use NFePHP\eSocial\Factories\EvtInfoEmpregador;
use NFePHP\eSocial\Tests\ESocialTestCase;

class EvtInfoEmpregadorTest extends ESocialTestCase
{
    /**
     * Payload mínimo válido para layout S.1.3.0 (jsonSchemes/v_S_01_03_00/evtInfoEmpregador.schema)
     * simulando uma alteração de vigência (modo=ALT) com o grupo novaValidade preenchido.
     */
    private function newStdEvtInfoEmpregadorAlt(): \stdClass
    {
        $std = new \stdClass();
        $std->sequencial = 1;
        $std->modo = 'ALT';
        $std->ideperiodo = new \stdClass();
        $std->ideperiodo->inivalid = '2020-01';
        $std->novavalidade = new \stdClass();
        $std->novavalidade->inivalid = '2020-02';
        $std->novavalidade->fimvalid = '2020-01';

        return $std;
    }

    /**
     * Comprova que o node <fimValid> do grupo <novaValidade> é emitido no XML.
     * Regressão: o builder lia $sh->fimValid (camelCase), mas Factory::propertiesToLower()
     * normaliza todas as chaves do stdClass de entrada para minúsculo antes do builder rodar,
     * então o campo nunca era populado e a tag nunca era emitida.
     *
     * @covers EvtInfoEmpregador::toNode
     */
    public function testNovaValidadeFimValidIsRendered()
    {
        $std = $this->newStdEvtInfoEmpregadorAlt();
        $evt = new EvtInfoEmpregador(
            $this->configJson,
            $std,
            $this->certificate,
            '2020-02-01 10:00:00'
        );
        $xml = $evt->toXML();
        $dom = new \DOMDocument();
        $dom->loadXML($xml);
        $novaValidade = $dom->getElementsByTagName('novaValidade')->item(0);
        $this->assertNotNull($novaValidade);
        $fimValid = $novaValidade->getElementsByTagName('fimValid')->item(0);
        $this->assertNotNull($fimValid, 'A tag <fimValid> deveria ser emitida dentro de <novaValidade>');
        $this->assertSame('2020-01', $fimValid->nodeValue);
    }
}
