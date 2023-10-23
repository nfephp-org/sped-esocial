<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.1.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.1.0',
    //versão do layout do evento
    'serviceVersion' => '1.5.0',
    //versão do webservice
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

$std = new \stdClass();
//$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789';
$std->nrproctrab = '123456789012345';
$std->perapurpgto = '2023-03';
$std->obs = 'Bla bla bla bla bla';
$std->cpftrab = '12345678901';
$std->calctrib[0] = new \stdClass(); //array 1 a 360
$std->calctrib[0]->perref = '2023-03';
$std->calctrib[0]->vrbccpmensal = 2000.00;
$std->calctrib[0]->vrbccp13 = 1222.22;
$std->calctrib[0]->vrrendirrf = 9999.99;
$std->calctrib[0]->vrrendirrf13 = 6666.66;
$std->calctrib[0]->infocrcontrib[0] = new \stdClass(); //array de 0 a 99
$std->calctrib[0]->infocrcontrib[0]->tpcr = '123456';
$std->calctrib[0]->infocrcontrib[0]->vrcr = 2222.22;
$std->infocrirrf[0] = new \stdClass(); //array de 0 a 99
$std->infocrirrf[0]->tpcr = '593656';
$std->infocrirrf[0]->vrcr = 1111.11;



try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtContProc(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2501($json, $std, $certificate)->toXML();
    //$json = Event::evtContProc($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
