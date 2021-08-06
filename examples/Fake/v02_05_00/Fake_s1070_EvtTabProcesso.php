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
$std->tpproc = 1;
$std->nrproc = 'alksldkdjkj';
$std->inivalid = '2017-01';
$std->fimvalid = '2017-12';
$std->modo = 'INC';

$std->dadosproc = new \stdClass();
$std->dadosproc->indautoria = 1;
$std->dadosproc->indmatproc = 99;
//$std->dadosproc->observacao = 'lalsksksksksk';

$std->dadosproc->dadosprocjud = new \stdClass();
$std->dadosproc->dadosprocjud->ufvara = 'SP';
$std->dadosproc->dadosprocjud->codmunic = '3550308';
$std->dadosproc->dadosprocjud->idvara = '234';

$std->dadosproc->infosusp[0] = new \stdClass();
$std->dadosproc->infosusp[0]->codsusp = '12345678901234';
$std->dadosproc->infosusp[0]->indsusp = '00';
$std->dadosproc->infosusp[0]->dtdecisao = '2017-07-22';
$std->dadosproc->infosusp[0]->inddeposito = 'N';

$std->novavalidade = new \stdClass();
$std->novavalidade->inivalid = '2017-12';
//$std->novavalidade->fimvalid = '2018-12';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtTabProcesso(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00' //opcional data e hora
    )->toXml();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
