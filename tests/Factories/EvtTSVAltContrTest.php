<?php

namespace NFePHP\eSocial\Tests\Factories;

use NFePHP\eSocial\Factories\EvtTSVAltContr;
use NFePHP\eSocial\Tests\ESocialTestCase;

class EvtTSVAltContrTest extends ESocialTestCase
{
    private function newPayload(array $institution): \stdClass
    {
        $data = [
            'indretif' => 1,
            'trabsemvinculo' => [
                'cpftrab' => '00232133417',
                'matricula' => 'TESTE906',
                'codcateg' => '906',
            ],
            'tsvalteracao' => ['dtalteracao' => '2026-08-01'],
        ];
        $data['estagiario'] = [
            'natestagio' => 'N',
            'dtprevterm' => '2026-12-31',
            'instensino' => $institution,
        ];

        return json_decode(json_encode($data));
    }

    private function signedDocument(\stdClass $std): \DOMDocument
    {
        // With a certificate, toXML() signs and validates against the event XSD.
        $event = new EvtTSVAltContr($this->configJson, $std, $this->certificate, '2026-08-01 10:00:00');
        $document = new \DOMDocument();
        $this->assertTrue($document->loadXML($event->toXML()));
        $this->assertSame(1, $document->getElementsByTagName('Signature')->length);

        return $document;
    }

    public function testOmittedLevelWithBrazilianInstitution()
    {
        $document = $this->signedDocument($this->newPayload(['cnpjinstensino' => '12345678000195']));

        $this->assertSame(0, $document->getElementsByTagName('nivEstagio')->length);
        $this->assertSame('12345678000195', $document->getElementsByTagName('cnpjInstEnsino')->item(0)->textContent);
        $this->assertSame(0, $document->getElementsByTagName('nmRazao')->length);
    }

    public function testOmittedLevelWithForeignInstitution()
    {
        $document = $this->signedDocument($this->newPayload(['nmrazao' => 'Foreign University']));

        $this->assertSame(0, $document->getElementsByTagName('nivEstagio')->length);
        $this->assertSame(0, $document->getElementsByTagName('cnpjInstEnsino')->length);
        $this->assertSame('Foreign University', $document->getElementsByTagName('nmRazao')->item(0)->textContent);
    }

    public function testInformedLevelIsEmitted()
    {
        $std = $this->newPayload(['nmrazao' => 'Foreign University']);
        $std->estagiario->nivestagio = 4;
        $document = $this->signedDocument($std);

        $this->assertSame(1, $document->getElementsByTagName('nivEstagio')->length);
        $this->assertSame('4', $document->getElementsByTagName('nivEstagio')->item(0)->textContent);
    }

    public function testLevelBelowMinimumIsRejected()
    {
        $this->assertInvalidLevel(0);
    }

    public function testLevelAboveMaximumIsRejected()
    {
        $this->assertInvalidLevel(10);
    }

    private function assertInvalidLevel(int $level)
    {
        $std = $this->newPayload(['cnpjinstensino' => '12345678000195']);
        $std->estagiario->nivestagio = $level;
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('estagiario.nivestagio');

        new EvtTSVAltContr($this->configJson, $std, $this->certificate, '2026-08-01 10:00:00');
    }
}
