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
$std->indretif = 2;
$std->nrrecibo = 'lalalalalalalal';

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

$std->infoconvinterm = new \stdClass();
$std->infoconvinterm->codconv = 'bla bla bla';
$std->infoconvinterm->dtinicio = '2108-10-02';
$std->infoconvinterm->dtfim = '2018-12-30';
$std->infoconvinterm->dtprevpgto = '2018-12-30';

$std->infoconvinterm->jornada = new \stdClass();
$std->infoconvinterm->jornada->codhorcontrat = 'bal bla bla';
$std->infoconvinterm->jornada->dscjornada = 'mais bla bla bla';

$std->infoconvinterm->localtrab = new \stdClass();
$std->infoconvinterm->localtrab->indlocal = 0; //0-2

$std->infoconvinterm->localtrab->localtrabinterm = new \stdClass(); 
$std->infoconvinterm->localtrab->localtrabinterm->tplograd = 'RUA';
$std->infoconvinterm->localtrab->localtrabinterm->dsclograd = 'SEM NOME';
$std->infoconvinterm->localtrab->localtrabinterm->nrlograd = 'ZERO';
$std->infoconvinterm->localtrab->localtrabinterm->complem = 'SUBSOLO';
$std->infoconvinterm->localtrab->localtrabinterm->bairro = 'BAIRRO';
$std->infoconvinterm->localtrab->localtrabinterm->cep = '00000000';
$std->infoconvinterm->localtrab->localtrabinterm->codmunic = '1234567';
$std->infoconvinterm->localtrab->localtrabinterm->uf = 'AC';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtConvInterm(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
