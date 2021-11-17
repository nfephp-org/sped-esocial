<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.0.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.0.0',
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
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789';
$std->indguia = 1;
$std->cpftrab = '12345678901';
$std->matricula = 'ABC12345678902';
$std->codcateg = 101;
$std->dtterm = '2017-12-22';
$std->mtvdesligtsv = '01';
$std->pensalim = 3;
$std->percaliment = 10.00;
$std->vralim = 600.23;
$std->nrproctrab = "12345678901234567890";
$std->novocpf = "12345678901";

    
$std->verbasresc = new \stdClass();
$std->verbasresc->dmdev[1] = new \stdClass();
$std->verbasresc->dmdev[1]->idedmdev = 'ksksksksksksksk';

$std->verbasresc->dmdev[1]->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->ideestablot[1]->nrinsc = '12345678901234';
$std->verbasresc->dmdev[1]->ideestablot[1]->codlotacao = 'assss';

$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->codrubr = '2323dffdf';
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->idetabrubr = 'sdser234';
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->qtdrubr = 256.20;
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->fatorrubr = 25.56;
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->vrrubr = 12345.56;
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->indapurir = 0;

$std->verbasresc->dmdev[1]->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->procjudtrab[1] = new \stdClass();
$std->verbasresc->procjudtrab[1]->tptrib = 2;
$std->verbasresc->procjudtrab[1]->nrprocjud = '12345678901234567890';
$std->verbasresc->procjudtrab[1]->codsusp = '12345678901234';
$std->verbasresc->infomv = new \stdClass();
$std->verbasresc->infomv->indmv = 3;
$std->verbasresc->infomv->remunoutrempr[1] = new \stdClass();
$std->verbasresc->infomv->remunoutrempr[1]->tpinsc = 1;
$std->verbasresc->infomv->remunoutrempr[1]->nrinsc = '12345678901234';
$std->verbasresc->infomv->remunoutrempr[1]->codcateg = 905;
$std->verbasresc->infomv->remunoutrempr[1]->vlrremunoe = 2598.56;

$std->quarentena = new \stdClass();
$std->quarentena->dtfimquar = '2018-12-20';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtTSVTermino(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2399($json, $std, $certificate)->toXML();
    //$json = Event::evtTSVTermino($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
