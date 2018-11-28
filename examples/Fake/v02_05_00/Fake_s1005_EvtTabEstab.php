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
$std->tpinsc = 1;
$std->nrinsc = '12345678901234';
$std->inivalid = '2017-01';
$std->fimvalid = '2017-12'; //opcional
$std->modo = 'INC';

$std->dadosestab = new \stdClass();
$std->dadosestab->cnaeprep = 26213;
$std->dadosestab->aliqgilrat = new \stdClass();
$std->dadosestab->aliqgilrat->aliqrat = 1;
$std->dadosestab->aliqgilrat->fap = 0.5000; //Deve ser um número maior ou igual a 0,5000 e menor ou igual a 2,0000.
$std->dadosestab->aliqgilrat->aliqratajust = 1 * 0.5000;
$std->dadosestab->aliqgilrat->procadmjudrat = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudrat->tpproc = 1;
$std->dadosestab->aliqgilrat->procadmjudrat->nrproc = '12345678901234567890';
$std->dadosestab->aliqgilrat->procadmjudrat->codsusp = '14524578901';
$std->dadosestab->aliqgilrat->procadmjudfap = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudfap->tpproc = 1;
$std->dadosestab->aliqgilrat->procadmjudfap->nrproc = '12345678901234567890';
$std->dadosestab->aliqgilrat->procadmjudfap->codsusp = '123445';
$std->dadosestab->infocaepf = new \stdClass();
$std->dadosestab->infocaepf->tpcaepf = 1;
$std->dadosestab->infoobra = new \stdClass();
$std->dadosestab->infoobra->indsubstpatrobra = 1;
$std->dadosestab->infotrab = new \stdClass();
$std->dadosestab->infotrab->regpt = 0;
$std->dadosestab->infotrab->infoapr = new \stdClass();
$std->dadosestab->infotrab->infoapr->contapr = 0;
$std->dadosestab->infotrab->infoapr->nrprocjud = '12345678901234567890';
$std->dadosestab->infotrab->infoapr->contented = 'S';
$std->dadosestab->infotrab->infoapr->infoenteduc[0] = new \stdClass();
$std->dadosestab->infotrab->infoapr->infoenteduc[0]->nrinsc = '12345678901234';
$std->dadosestab->infotrab->infopdc = new \stdClass();
$std->dadosestab->infotrab->infopdc->contpdc = 0;
$std->dadosestab->infotrab->infopdc->nrprocjud = '12345678901234567890';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtTabEstab(
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
