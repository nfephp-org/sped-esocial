<?php

namespace NFePHP\eSocial\Tests\Factories;

use NFePHP\eSocial\Common\Factory;
use NFePHP\eSocial\Factories\EvtAdmPrelim;
use NFePHP\eSocial\Tests\ESocialTestCase;

class EvtAdmPrelimTest extends ESocialTestCase
{
    /**
     * @covers Factory::__construct
     * @covers Factory::init
     * @covers Factory::strLayoutVer
     * @covers Factory::standardizeParams
     * @covers Factory::loadProperties
     */
    public function testInstanciate()
    {
        $std = new \stdClass();
        $std->sequencial = 1;
        $std->cpfTrab = '00232133417';
        $std->dtNascto = '1961-02-12';
        $std->dtAdm = '2017-04-12';
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate,
            '2017-08-03 10:37:00'
        );

        $this->assertInstanceOf(EvtAdmPrelim::class, $evt);
    }

    /**
     * @covers Factory::toXML
     * @covers Factory::sign
     * @covers EvtAdmPrelim::toNode
     * @covers FactoryId::build
     */
    public function testToXML()
    {
        $std = new \stdClass();
        $std->sequencial = 1;
        $std->cpfTrab = '00232133417';
        $std->dtNascto = '1961-02-12';
        $std->dtAdm = '2017-04-12';
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
        $expected = file_get_contents($this->fixturesPath . 'evtAdmPrelim.xml');
        $dom2 = new \DOMDocument();
        $dom2->loadXML($expected);
        $expectedElement = $dom2->getElementsByTagName('evtAdmPrelim')->item(0);
        $this->assertEqualXMLStructure($expectedElement, $actualElement);
    }

    /**
     * @covers Factory::toJson
     */
    public function testToJson()
    {
        $std = new \stdClass();
        $std->sequencial = 1;
        $std->cpfTrab = '00232133417';
        $std->dtNascto = '1961-02-12';
        $std->dtAdm = '2017-04-12';
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate,
            '2017-08-03 10:37:00'
        );
        $actual = $evt->toJson();
        //file_put_contents($this->fixturesPath . 'evtAdmPrelim.json', $actual);
        $expected = file_get_contents($this->fixturesPath . 'evtAdmPrelim.json');
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Factory::toArray
     */
    public function testToArray()
    {
        $std = new \stdClass();
        $std->sequencial = 1;
        $std->cpfTrab = '00232133417';
        $std->dtNascto = '1961-02-12';
        $std->dtAdm = '2017-04-12';
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate,
            '2017-08-03 10:37:00'
        );
        $actual = $evt->toArray();
        $expected = file_get_contents($this->fixturesPath . 'evtAdmPrelim.json');
        $this->assertEquals(json_decode($expected, true), $actual);
    }

    /**
     * @covers Factory::toStd
     */
    public function testToStd()
    {
        $std = new \stdClass();
        $std->sequencial = 1;
        $std->cpfTrab = '00232133417';
        $std->dtNascto = '1961-02-12';
        $std->dtAdm = '2017-04-12';
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate,
            '2017-08-03 10:37:00'
        );
        $actual = $evt->toStd();
        $expected = file_get_contents($this->fixturesPath . 'evtAdmPrelim.json');
        $this->assertEquals(json_decode($expected), $actual);
    }
}
