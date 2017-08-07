<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use NFePHP\eSocial\Event;
use NFePHP\Common\Certificate;

$config = [
    'tpAmb' => 2, //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_3_00', //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.3.0', //versão do layout do evento
    'serviceVersion' => '1.1.0',//versão do webservice
    'empregador' => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999', //numero do documento
        'nmRazao' => 'Razao Social'
    ],
    'transmissor' => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999' //numero do documento
    ]
];
$configJson = json_encode($config, JSON_PRETTY_PRINT);

//carrega os dados do envento
$std = new \stdClass();
$std->sequencial = 1;
$std->indRetif = 2;

$ideVinculo = new \stdClass();
$ideVinculo->cpfTrab = '11111111111';
$ideVinculo->nisTrab = '11111111111';
$ideVinculo->matricula = '11111111111';

$std->ideVinculo = $ideVinculo;

$infoAvPrevio = new \stdClass();
$infoAvPrevio->dtAvPrv = '2008-09-28';
$infoAvPrevio->dtPrevDeslig = '2014-09-18';
$infoAvPrevio->tpAvPrevio = '2';

$std->infoAvPrevio = $infoAvPrevio;

try {

    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtAvPrevio(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();


    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;

} catch (\Exception $e) {
    echo $e->getMessage();
}
