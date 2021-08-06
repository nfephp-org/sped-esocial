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
$std->perapur = '2019-01';

$std->infofgts = new \stdClass();
$std->infofgts->nrrecarqbase = '1234567-1234567-1234567';
$std->infofgts->indexistinfo = 1;

$std->infofgts->infobasefgts = new \stdClass();

$std->infofgts->infobasefgts->baseperapur[0] = new \stdClass();
$std->infofgts->infobasefgts->baseperapur[0]->tpvalor = '11';
$std->infofgts->infobasefgts->baseperapur[0]->basefgts = 2547.88;

$std->infofgts->infobasefgts->infobaseperante[0] = new \stdClass();
$std->infofgts->infobasefgts->infobaseperante[0]->perref = '2019-01';

$std->infofgts->infobasefgts->infobaseperante[0]->baseperante[0] = new \stdClass();
$std->infofgts->infobasefgts->infobaseperante[0]->baseperante[0]->tpvalore = '24';
$std->infofgts->infobasefgts->infobaseperante[0]->baseperante[0]->basefgtse = 18158.66;

$std->infofgts->infodpsfgts = new \stdClass();

$std->infofgts->infodpsfgts->dpsperapur[0] = new \stdClass();
$std->infofgts->infodpsfgts->dpsperapur[0]->tpdps = '51';
$std->infofgts->infodpsfgts->dpsperapur[0]->vrfgts = 1554.78;

$std->infofgts->infodpsfgts->infodpsperante[0] = new \stdClass();
$std->infofgts->infodpsfgts->infodpsperante[0]->perref = '2019-01';

$std->infofgts->infodpsfgts->infodpsperante[0]->dpsperante[0] = new \stdClass();
$std->infofgts->infodpsfgts->infodpsperante[0]->dpsperante[0]->tpdpse = '53';
$std->infofgts->infodpsfgts->infodpsperante[0]->dpsperante[0]->vrfgtse = 1554.78;


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtFGTS(
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
