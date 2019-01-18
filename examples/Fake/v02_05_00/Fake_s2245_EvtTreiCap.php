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
$std->nrrecibo = 'lklskslkskslkslk';

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

$std->treicap = new \stdClass();
$std->treicap->codtreicap = '2222';
$std->treicap->obstreicap = 'bla bla bla';

$std->treicap->infocomplem = new \stdClass(); //opcional
$std->treicap->infocomplem->dttreicap = '2018-11-12';
$std->treicap->infocomplem->durtreicap = 22.4;
$std->treicap->infocomplem->modtreicap = 3; //1-3
$std->treicap->infocomplem->tptreicap = 5; //1-5

$std->treicap->infocomplem->ideprofresp[0] = new \stdClass();
$std->treicap->infocomplem->ideprofresp[0]->cpfprof = '12345678901';
$std->treicap->infocomplem->ideprofresp[0]->nmprof = 'Beltrano de Tal';
$std->treicap->infocomplem->ideprofresp[0]->tpprof = 1; //1-2
$std->treicap->infocomplem->ideprofresp[0]->formprof = 'bla bla bla';
$std->treicap->infocomplem->ideprofresp[0]->codcbo = '123456'; 
$std->treicap->infocomplem->ideprofresp[0]->nacprof = 1; //1-2


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtTreiCap(
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
