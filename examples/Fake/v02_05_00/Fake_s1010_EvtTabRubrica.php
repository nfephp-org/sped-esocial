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

$std = new \stdClass();
$std->sequencial = 1;
$std->codrubr = 'alalalalaallkj ';
$std->idetabrubr = 'lslslsls';
$std->inivalid = '2017-01';
$std->fimvalid = '2017-12';
$std->modo = "ALT";

$std->dadosrubrica = new \stdClass();
$std->dadosrubrica->dscrubr = 'dkdldkdlk';
$std->dadosrubrica->natrubr = 1234;
$std->dadosrubrica->tprubr = 1;
$std->dadosrubrica->codinccp = '11';
$std->dadosrubrica->codincirrf = '11';
$std->dadosrubrica->codincfgts = '11';
$std->dadosrubrica->codincsind = '11';
$std->dadosrubrica->observacao = '';

$std->dadosrubrica->ideprocessocp[0] = new \stdClass();
$std->dadosrubrica->ideprocessocp[0]->tpproc = 1;
$std->dadosrubrica->ideprocessocp[0]->nrproc = 'alkdslkdldkdlk';
$std->dadosrubrica->ideprocessocp[0]->extdecisao = 1;
$std->dadosrubrica->ideprocessocp[0]->codsusp = '0929292882';

$std->dadosrubrica->ideprocessoirrf[0] = new \stdClass();
$std->dadosrubrica->ideprocessoirrf[0]->nrproc = 'alkdslkdldkdlk';
$std->dadosrubrica->ideprocessoirrf[0]->codsusp = '0929292882';

$std->dadosrubrica->ideprocessofgts[0] = new \stdClass();
$std->dadosrubrica->ideprocessofgts[0]->nrproc = 'alkdslkdldkdlk';
$std->dadosrubrica->ideprocessofgts[0]->codsusp = '0929292882';

$std->dadosrubrica->ideprocessosind[0] = new \stdClass();
$std->dadosrubrica->ideprocessosind[0]->nrproc = 'alkdslkdldkdlk';
$std->dadosrubrica->ideprocessosind[0]->codsusp = '0929292882';

$std->novavalidade = new \stdClass();
$std->novavalidade->inivalid = '2017-12';
$std->novavalidade->fimvalid = '2018-12';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtTabRubrica(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00' //opcional data e hora
    )->toXml();

    //$xml = Evento::s1010($json, $std, $certificate)->toXML();
    //$json = Event::evtTabRubrica($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
