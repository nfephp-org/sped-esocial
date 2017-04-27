<?php

namespace NFePHP\eSocial\Tests;

use NFePHP\Common\Certificate;

class ESocialTestCase extends \PHPUnit_Framework_TestCase
{
    
    public $fixturesPath = '';
    public $configJson = '';
    public $certificate;
        
    public function __construct()
    {
        $this->fixturesPath = __DIR__ . '/fixtures/';
        $contentpfx = file_get_contents($this->fixturesPath . "certs/expired_certificate.pfx");
        $config = [
            'tpInsc' => 1,  //1-CNPJ, 2-CPF
            'nrInsc' => '99999999999999', //numero do documento
            'company' => 'Razao Social',
            'tpAmb' => 3, //tipo de ambiente 1 - Produção;2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
            'verProc' => '2_2_01', //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
            'layout' => '2.2.1' //versão do layout
        ];
        $this->configJson = json_encode($config);
        $this->certificate = Certificate::readPfx($contentpfx, 'associacao');
    }
}
