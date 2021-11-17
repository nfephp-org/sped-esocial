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
$std->nrrecarqbase = 'kjskjsksjksjksjksjksjskjsksksjskj';
$std->indapuracao = 1;
$std->perapur = '2017-08';
$std->cpftrab = '99999999999';

$std->procjudtrab[0] = new \stdClass();
$std->procjudtrab[0]->nrprocjud = '12345678901234567890';
$std->procjudtrab[0]->codsusp = '73737337';

$std->infocpcalc[0] = new \stdClass();
$std->infocpcalc[0]->tpcr = '108204';
$std->infocpcalc[0]->vrcpseg = 100.23;
$std->infocpcalc[0]->vrdescseg = 10;

$std->ideestablot[0] = new \stdClass();
$std->ideestablot[0]->tpinsc = 1;
$std->ideestablot[0]->nrinsc = '12345678';
$std->ideestablot[0]->codlotacao = '12323455666677';

$std->ideestablot[0]->infocategincid[0] = new \stdClass();
$std->ideestablot[0]->infocategincid[0]->matricula = 'aaaaaaaaaa';
$std->ideestablot[0]->infocategincid[0]->codcateg = 105;
$std->ideestablot[0]->infocategincid[0]->indsimples = 1;

$std->ideestablot[0]->infocategincid[0]->infobasecs[0] = new \stdClass();
$std->ideestablot[0]->infocategincid[0]->infobasecs[0]->ind13 = 1;
$std->ideestablot[0]->infocategincid[0]->infobasecs[0]->tpvalor = 12;
$std->ideestablot[0]->infocategincid[0]->infobasecs[0]->valor = 1000.02;

$std->ideestablot[0]->infocategincid[0]->calcterc[0] = new \stdClass();
$std->ideestablot[0]->infocategincid[0]->calcterc[0]->tpcr = '121802';
$std->ideestablot[0]->infocategincid[0]->calcterc[0]->vrcssegterc = 500;
$std->ideestablot[0]->infocategincid[0]->calcterc[0]->vrdescterc = 111.09;



try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtBasesTrab(
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
