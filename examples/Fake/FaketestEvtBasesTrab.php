<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_3_00',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.3.0',
    //versão do layout do evento
    'serviceVersion' => '1.1.1',
    //versão do webservice
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

$std = new \stdClass();
$std->sequencial = 1;
$std->nrrecarqbase = 'kjskjsksjksjksjksjksjskjsksksjskj';
$std->indapuracao = 1;
$std->perapur = '2017-08';
$std->cpftrab = '99999999999';

$procjudtrab[0] = new \stdClass();
$procjudtrab[0]->nrprocjud = '282828282';
$procjudtrab[0]->codsusp = '73737337';
$std->procjudtrab = $procjudtrab;

$infocpcalc[0] = new \stdClass();
$infocpcalc[0]->tpcr = '108204';
$infocpcalc[0]->vrcpseg = 100.23;
$infocpcalc[0]->vrdescseg = 10;
$std->infocpcalc = $infocpcalc;

$ideestablot[0] = new \stdClass();
$ideestablot[0]->tpinsc = 1;
$ideestablot[0]->nrinsc = '12345678';
$ideestablot[0]->codlotacao = '12323455666677';

$infoCategIncid[0] = new \stdClass();
$infoCategIncid[0]->matricula = 'aaaaaaaaaa';
$infoCategIncid[0]->codcateg = 105;
$infoCategIncid[0]->indsimples = 1;

$infoBaseCS[0] = new \stdClass();
$infoBaseCS[0]->ind13 = 1;
$infoBaseCS[0]->tpvalor = 12;
$infoBaseCS[0]->valor = 1000.02;

$infoCategIncid[0]->infobasecs = $infoBaseCS;

$calcterc[0] = new \stdClass();
$calcterc[0]->tpcr = '121802';
$calcterc[0]->vrcssegterc = 500;
$calcterc[0]->vrdescterc = 111.09;

$infoCategIncid[0]->calcterc = $calcterc;

$ideestablot[0]->infocategincid = $infoCategIncid;

$std->ideestablot = $ideestablot;

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
