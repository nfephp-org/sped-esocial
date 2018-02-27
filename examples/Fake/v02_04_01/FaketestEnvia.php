<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Common\FakePretty;
use NFePHP\eSocial\Common\Soap\SoapFake;
use NFePHP\eSocial\Event;
use NFePHP\eSocial\Tools;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_4_01', //Versão do processo de emissão do evento. 
                           //Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.4.1', //versão do layout do evento
    'serviceVersion' => '1.1.1', //versão do webservice
    'empregador' => [
        'tpInsc' => 1, //1-CNPJ, 2-CPF
        'nrInsc' => '99999999', //numero do documento
        'nmRazao' => 'Razao Social',
    ],
    'transmissor' => [
        'tpInsc' => 1, //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999' //numero do documento
    ],
];
$configJson = json_encode($config, JSON_PRETTY_PRINT);

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //usar a classe Fake para não tentar enviar apenas ver o resultado da chamada
    $soap = new SoapFake();
    //desativa a validação da validade do certificado
    //estamos usando um certificado vencido nesse teste
    $soap->disableCertValidation(true);

    //cria o evento
    $std = new \stdClass();
    $std->sequencial = 1;
    $std->cpfTrab = '00232133417';
    $std->dtNascto = '1931-02-12';
    $std->dtAdm = '2017-02-12';
    $evento = Event::evtAdmPrelim($configJson, $std);

    //instancia a classe responsável pela comunicação
    $tools = new Tools($configJson, $certificate);
    //carrega a classe responsável pelo envio SOAP
    //nesse caso um envio falso
    $tools->loadSoapClass($soap);

    //executa o envio
    $response = $tools->enviarLoteEventos($tools::EVT_NAO_PERIODICOS, [$evento]);

    //retorna os dados que serão usados na conexão para conferência
    echo FakePretty::prettyPrint($response, '');
} catch (\Exception $e) {
    echo $e->getMessage();
}
