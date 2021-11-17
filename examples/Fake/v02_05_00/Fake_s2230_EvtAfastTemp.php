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
$std->nrrecibo = '1234567890';

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

//Opcional 1 ou Opcional 2 ou Opcional 3
$std->iniafastamento = new \stdClass();
$std->iniafastamento->dtiniafast = '2017-08-21';
$std->iniafastamento->codmotafast = '01';
$std->iniafastamento->infomesmomtv = 'N';
$std->iniafastamento->tpacidtransit = 3;
$std->iniafastamento->observacao = 'blablablabla';

$std->iniafastamento->infoatestado[0] = new \stdClass();
$std->iniafastamento->infoatestado[0]->codcid = '0101';
$std->iniafastamento->infoatestado[0]->qtddiasafast = 120;

$std->iniafastamento->infoatestado[0]->emitente = new \stdClass();
$std->iniafastamento->infoatestado[0]->emitente->nmemit = 'NOME DO EMITENTE';
$std->iniafastamento->infoatestado[0]->emitente->ideoc = 1;
$std->iniafastamento->infoatestado[0]->emitente->nroc = '11111111111111';
$std->iniafastamento->infoatestado[0]->emitente->ufoc = 'SP';

$std->iniafastamento->infocessao = new \stdClass();
$std->iniafastamento->infocessao->cnpjcess = '11111111111111';
$std->iniafastamento->infocessao->infonus = 1;

$std->iniafastamento->infomandsind = new \stdClass();
$std->iniafastamento->infomandsind->cnpjsind = '11111111111111';
$std->iniafastamento->infomandsind->infonusremun = 1;

//Opcional 2
$std->inforetif = new \stdClass();
$std->inforetif->origretif = 1;
$std->inforetif->tpproc = 1;
$std->inforetif->nrproc = '1234567890';

//Opcional 3
$std->fimafastamento = new \stdClass();
$std->fimafastamento->dttermafast = '2017-08-21';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
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
