<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_5_0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.5.0',
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

//carrega os dados do envento
$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 2;

$idevinculo = new \stdClass();
$idevinculo->cpftrab = '11111111111';
$idevinculo->nistrab = '11111111111';
$idevinculo->matricula = '11111111111';

$std->idevinculo = $idevinculo;

$infoavprevio = new \stdClass();

$dtAvPrv = '2008-09-28';
if ($dtAvPrv) {
    $detavprevio  = new \stdClass();
    $detavprevio->dtavprv = $dtAvPrv;
    $detavprevio->dtprevdeslig = '2014-09-18';
    $detavprevio->tpAvprevio = 2;
    $infoavprevio->detavprevio = $detavprevio;
}

$dtCancAvPrv = '';
if ($dtCancAvPrv) {
    $cancavprevio  = new \stdClass();
    $cancavprevio->dtcancavprv = $dtCancAvPrv;
    $cancavprevio->mtvcancavprevio = 1;
    $infoavprevio->cancavprevio = $cancavprevio;
}

$std->infoavprevio = $infoavprevio;

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
