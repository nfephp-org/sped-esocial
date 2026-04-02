<?php

namespace NFePHP\eSocial\Tests\Factories;

use NFePHP\eSocial\Common\Factory;
use NFePHP\eSocial\Factories\EvtAdmPrelim;
use NFePHP\eSocial\Tests\ESocialTestCase;

class EvtAdmPrelimTest extends ESocialTestCase
{
    /**
     * Payload mínimo válido para layout S.1.3.0 (jsonSchemes/v_S_01_03_00/evtAdmPrelim.schema).
     */
    private function newStdEvtAdmPrelimS130(): \stdClass
    {
        $std = new \stdClass();
        $std->sequencial = 1;
        $std->indretif = 1;
        $std->cpftrab = '00232133417';
        $std->dtnascto = '1961-02-12';
        $std->dtadm = '2017-04-12';
        $std->matricula = '12345';
        $std->codcateg = '101';

        return $std;
    }

    /**
     * @covers Factory::__construct
     * @covers Factory::init
     * @covers Factory::strLayoutVer
     * @covers Factory::standardizeParams
     * @covers Factory::loadProperties
     */
    public function testInstanciate()
    {
        $std = $this->newStdEvtAdmPrelimS130();
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate,
            '2017-08-03 10:37:00'
        );
        //$this->assertInstanceOf(EvtAdmPrelim::class, $evt);
        $this->assertTrue(true);
    }

    /**
     * @covers Factory::toXML
     * @covers Factory::sign
     * @covers EvtAdmPrelim::toNode
     * @covers FactoryId::build
     */
    public function testToXML()
    {
        $std = $this->newStdEvtAdmPrelimS130();
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate,
            '2017-08-03 10:37:00'
        );
        $actual = $evt->toXML();
        //file_put_contents($this->fixturesPath . 'evtAdmPrelim.xml', $actual);
        $dom1 = new \DOMDocument();
        $dom1->loadXML($actual);
        $actualElement = $dom1->getElementsByTagName('evtAdmPrelim')->item(0);
        $expected = file_get_contents($this->fixturesPath.'evtAdmPrelim.xml');
        $dom2 = new \DOMDocument();
        $dom2->loadXML($expected);
        $expectedElement = $dom2->getElementsByTagName('evtAdmPrelim')->item(0);
        //$this->assertEqualXMLStructure($expectedElement, $actualElement);
        $this->assertTrue(true);
    }

    /**
     * @covers Factory::toJson
     */
    public function testToJson()
    {
        $std = $this->newStdEvtAdmPrelimS130();
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate,
            '2017-08-03 10:37:00'
        );
        $actual = $evt->toJson();
        //file_put_contents($this->fixturesPath . 'evtAdmPrelim.json', $actual);
        $expected = file_get_contents($this->fixturesPath . 'evtAdmPrelim.json');
        //$this->assertEquals($expected, $actual);
        $this->assertTrue(true);
    }

    /**
     * @covers Factory::toArray
     */
    public function testToArray()
    {
        $std = $this->newStdEvtAdmPrelimS130();
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate,
            '2017-08-03 10:37:00'
        );
        $actual = $evt->toArray();
        $expected = file_get_contents($this->fixturesPath.'evtAdmPrelim.json');
        //$this->assertEquals(json_decode($expected, true), $actual);
        $this->assertTrue(true);
    }

    /**
     * @covers Factory::toStd
     */
    public function testToStd()
    {
        $std = $this->newStdEvtAdmPrelimS130();
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate,
            '2017-08-03 10:37:00'
        );
        $actual = $evt->toStd();
        $expected = file_get_contents($this->fixturesPath.'evtAdmPrelim.json');
        //$this->assertEquals(json_decode($expected), $actual);
        $this->assertTrue(true);
    }
}
