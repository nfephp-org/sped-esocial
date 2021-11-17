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
$std->nrrecibo = '1231513';
$std->indapuracao = 1;
$std->perapur = '2017-08';

$std->remunavnp[0] = new \stdClass();
$std->remunavnp[0]->tpinsc = 1;
$std->remunavnp[0]->nrinsc = '11111111111111';
$std->remunavnp[0]->codlotacao = '11111111111111';
$std->remunavnp[0]->vrbccp00 = 1500.11;
$std->remunavnp[0]->vrbccp15 = 1500.22;
$std->remunavnp[0]->vrbccp20 = 1500.33;
$std->remunavnp[0]->vrbccp25 = 1500.44;
$std->remunavnp[0]->vrbccp13 = 1500.55;
$std->remunavnp[0]->vrbcfgts = 1500.66;
$std->remunavnp[0]->vrdesccp = 1500.77;


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtContratAvNP(
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
