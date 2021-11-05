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
$std->indretif = 1;
$std->nrrecibo = '123456';
$std->perapur = '2017-08';

$std->estabelecimento = new \stdClass();
$std->estabelecimento->nrinscestabrural = '12345678901234';

$std->estabelecimento->tpcomerc[0] = new \stdClass();
$std->estabelecimento->tpcomerc[0]->indcomerc = '2';
$std->estabelecimento->tpcomerc[0]->vrtotcom = 1500.00;

$std->estabelecimento->tpcomerc[0]->ideadquir[0] = new \stdClass();
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->tpinsc = '1';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nrinsc = '12345678';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->vrcomerc = 1500.22;

$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0] = new \stdClass();
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->serie = '12345';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->nrdocto = '1111111111111111111';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->dtemisnf = '2017-08-23';
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vlrbruto = 1500.44;
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vrcpdescpr = 1500.55;
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vrratdescpr = 1500.66;
$std->estabelecimento->tpcomerc[0]->ideadquir[0]->nfs[0]->vrsenardesc = 1500.77;

$std->estabelecimento->tpcomerc[0]->infoprocjud[0] = new \stdClass();
$std->estabelecimento->tpcomerc[0]->infoprocjud[0]->tpproc = 1;
$std->estabelecimento->tpcomerc[0]->infoprocjud[0]->nrproc = '111111111111111111';
$std->estabelecimento->tpcomerc[0]->infoprocjud[0]->codsusp = '11111111111111';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtComProd(
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
