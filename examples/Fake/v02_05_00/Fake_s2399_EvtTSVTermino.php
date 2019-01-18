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
$std->indretif = 1;
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab = '12345678901';
$std->nistrab = '12345678902';
$std->codcateg = 101;
$std->dtterm = '2017-12-22';
$std->mtvdesligtsv = '01';
$std->pensalim = 3;
$std->percaliment = 10.00;
$std->vralim = 600.23;

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
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->vrunit = 256.89;
$std->verbasresc->dmdev[1]->ideestablot[1]->detverbas[1]->vrrubr = 12345.56;


$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1] = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1]->cnpjoper = '12345678901234';
$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1]->regans = 'as2323';
$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1]->vrpgtit = 299.75;

$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1] = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->tpdep = '01';
$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->cpfdep = '12345678901';
$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->nmdep = 'Cacetinho da Silva';
$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->dtnascto = '2010-05-30';
$std->verbasresc->dmdev[1]->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->vlrpgdep = 256.02;


$std->verbasresc->dmdev[1]->ideestablot[1]->infoagnocivo = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->infoagnocivo->grauexp = 4;

$std->verbasresc->dmdev[1]->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->ideestablot[1]->infosimples->indsimples = 2;

$std->verbasresc->procjudtrab[1] = new \stdClass();
$std->verbasresc->procjudtrab[1]->tptrib = 3;
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
