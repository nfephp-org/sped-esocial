<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config     = [
    'tpAmb'          => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc'        => '2_4_01',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion'  => '2.4.1',
    //versão do layout do evento
    'serviceVersion' => '1.1.1',
    //versão do webservice
    'empregador'     => [
        'tpInsc'  => 1,  //1-CNPJ, 2-CPF
        'nrInsc'  => '99999999999999', //numero do documento
        'nmRazao' => 'Razao Social',
    ],
    'transmissor'    => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999' //numero do documento
    ],
];
$configJson = json_encode($config, JSON_PRETTY_PRINT);

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1234567890';


$idevinculo            = new \stdClass();
$idevinculo->cpftrab   = '11111111111';
$idevinculo->nistrab   = '11111111111';
$idevinculo->matricula = '11111111111';

$std->idevinculo = $idevinculo;

$iniafastamento              = new \stdClass();
$iniafastamento->dtiniafast  = '2017-08-21';
$iniafastamento->codmotafast = '01';

$infoatestado[0]               = new \stdClass();
$infoatestado[0]->codcid       = '0101';
$infoatestado[0]->qtddiasafast = 120;

$emitente         = new \stdClass();
$emitente->nmemit = 'NOME DO EMITENTE';
$emitente->ideoc  = 1;
$emitente->nroc   = '11111111111111';
$emitente->ufoc   = 'SP';

$infoatestado[0]->emitente = $emitente;

$iniafastamento->infoatestado = $infoatestado;

$std->iniafastamento = $iniafastamento;

$infocessao           = new \stdClass();
$infocessao->cnpjcess = '11111111111111';
$infocessao->infonus  = 1;

$std->infocessao = $infocessao;

$infomandsind               = new \stdClass();
$infomandsind->cnpjsind     = '11111111111111';
$infomandsind->infonusremun = 1;

$std->infomandsind = $infomandsind;

$inforetif            = new \stdClass();
$inforetif->origretif = 1;
$inforetif->tpproc    = 1;

$std->inforetif = $inforetif;

$fimafastamento              = new \stdClass();
$fimafastamento->dttermafast = '2017-08-21';

$std->fimafastamento = $fimafastamento;

try {
    //carrega a classe responsavel por lidar com os certificados
    $content     = file_get_contents('expired_certificate.pfx');
    $password    = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtAfastTemp(
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
