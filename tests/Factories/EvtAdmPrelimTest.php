<?php

namespace NFePHP\eSocial\Tests\Factories;

use NFePHP\eSocial\Factories\EvtAdmPrelim;
use NFePHP\eSocial\Tests\ESocialTestCase;

class EvtAdmPrelimTest extends ESocialTestCase
{
    /**
     * @covers NFePHP\eSocial\Factories\Factory::__construct
     * @covers NFePHP\eSocial\Factories\Factory::init
     * @covers NFePHP\eSocial\Factories\Factory::strLayoutVer
     * @covers NFePHP\eSocial\Factories\Factory::standardizeParams
     * @covers NFePHP\eSocial\Factories\Factory::loadProperties
     */
    public function testInstanciate()
    {
        $std = new \stdClass();
        $std->sequencial = 1;
        $std->cpfTrab = '00232133417';
        $std->dtNascto = new \DateTime('1961-02-12');
        $std->dtAdm = new \DateTime('2017-04-12');
        $evt = new EvtAdmPrelim(
            $this->configJson,
            $std,
            $this->certificate
        );
    }
    
    /**
     * @covers NFePHP\eSocial\Factories\Factory::toXML
     * @covers NFePHP\eSocial\Factories\Factory::sign
     * @covers NFePHP\eSocial\Factories\EvtAdmPrelim::toNode
     * @covers NFePHP\eSocial\Factories\FactoryId::build
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
            $this->certificate
        );

        $actual = $evt->toXML();
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
     * @covers NFePHP\eSocial\Factories\Factory::toJson
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
            $this->certificate
        );

        $evtid = FactoryId::build(
            '1',
            '99999999999999',
            new \DateTime('2017-04-27 11:12:30'),
            $std->sequencial
        );

        $event = json_decode($evt->toJson(), true);
        $event['evtAdmPrelim']['attributes']['Id'] = $evtid;

        $actual = json_encode($event, JSON_PRETTY_PRINT);

        $expected = file_get_contents($this->fixturesPath . 'evtAdmPrelim.json');
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers NFePHP\eSocial\Factories\Factory::toArray
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
            $this->certificate
        );

        $actual = $evt->toArray();
        $evtid = FactoryId::build(
            '1',
            '99999999999999',
            new \DateTime('2017-04-27 11:12:30'),
            $std->sequencial
        );
        $actual['evtAdmPrelim']['attributes']['Id'] = $evtid;
        $expected = file_get_contents($this->fixturesPath . 'evtAdmPrelim.json');
        $this->assertEquals(json_decode($expected, true), $actual);
    }

    /**
     * @covers NFePHP\eSocial\Factories\Factory::toStd
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
            $this->certificate
        );

        $actual = $evt->toStd();
        $evtid = FactoryId::build(
            '1',
            '99999999999999',
            new \DateTime('2017-04-27 11:12:30'),
            $std->sequencial
        );
        $actual->evtAdmPrelim->attributes->Id = $evtid;
        $expected = file_get_contents($this->fixturesPath . 'evtAdmPrelim.json');
        $this->assertEquals(json_decode($expected), $actual);
    }
}
