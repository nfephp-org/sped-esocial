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
$std->perapur = '2017-08';
$std->cpftrab = '99999999999';
$std->nistrab = '99999999999';


$std->infofgts = new \stdClass();
$std->infofgts->dtvenc = '2019-04-07';

$std->infofgts->ideestablot[0] = new \stdClass();
$std->infofgts->ideestablot[0]->tpinsc = 1;
$std->infofgts->ideestablot[0]->nrinsc = '12345678';
$std->infofgts->ideestablot[0]->codlotacao = '12323455666677';

$std->infofgts->ideestablot[0]->infotrabfgts[0] = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->matricula = '10';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->codcateg = '101';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->dtadm = '2017-05-12';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->dtdeslig = '2019-01-05';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->dtinicio = '2017-05-20';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->mtvdeslig = '01';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->dtterm = '2019-01-05';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->mtvdesligtsv = '01';

$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->baseperapur[0] = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->baseperapur[0]->tpvalor = '12';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->baseperapur[0]->remfgts = 2547.22;

$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0] = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0]->perref = '2018-12';

$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0]->baseperante[0] = new \stdClass();
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0]->baseperante[0]->tpvalore = '13';
$std->infofgts->ideestablot[0]->infotrabfgts[0]->infobasefgts->infobaseperante[0]->baseperante[0]->remfgtse = 15897.65;

$std->infofgts->infodpsfgts = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0] = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0]->matricula = '10';
$std->infofgts->infodpsfgts->infotrabdps[0]->codcateg = '101';

$std->infofgts->infodpsfgts->infotrabdps[0]->dpsperapur[0] = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0]->dpsperapur[0]->tpdps = '51';
$std->infofgts->infodpsfgts->infotrabdps[0]->dpsperapur[0]->dpsfgts = 15487.99;

$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0] = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0]->perref = '2019-01';

$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0]->dpsperante[0] = new \stdClass();
$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0]->dpsperante[0]->tpdpse = '51';
$std->infofgts->infodpsfgts->infotrabdps[0]->infodpsperante[0]->dpsperante[0]->dpsfgtse = 25987.56;

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtBasesFGTS(
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
