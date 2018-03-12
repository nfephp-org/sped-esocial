<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_4_01',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.4.1',
    //versão do layout do evento
    'serviceVersion' => '1.4.1',
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

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

$std->insalperic = new \stdClass();
$std->insalperic->iniinsalperic = new \stdClass();
$std->insalperic->iniinsalperic->dtinicondicao = '2017-08-28';

$std->insalperic->iniinsalperic->infoamb[0] = new \stdClass();
$std->insalperic->iniinsalperic->infoamb[0]->codamb = '123546';

$std->insalperic->iniinsalperic->infoamb[0]->fatrisco[0] = new \stdClass();
$std->insalperic->iniinsalperic->infoamb[0]->fatrisco[0]->codfatris = '123456';

$std->insalperic->altinsalperic = new \stdClass();
$std->insalperic->altinsalperic->dtaltcondicao = '2017-08-28';

$std->insalperic->altinsalperic->infoamb[0] = new \stdClass();
$std->insalperic->altinsalperic->infoamb[0]->codamb = '123456';

$std->insalperic->altinsalperic->infoamb[0]->fatrisco[0] = new \stdClass();
$std->insalperic->altinsalperic->infoamb[0]->fatrisco[0]->codfatris = '123456';

$std->insalperic->fiminsalperic = new \stdClass();
$std->insalperic->fiminsalperic->dtfimcondicao = '2017-08-28';

$std->insalperic->fiminsalperic->infoamb[0] = new \stdClass();
$std->insalperic->fiminsalperic->infoamb[0]->codamb = '123456';

$std->aposentesp = new \stdClass();
$std->aposentesp->iniaposentesp = new \stdClass();
$std->aposentesp->iniaposentesp->dtinicondicao = '2017-08-28';

$std->aposentesp->iniaposentesp->infoamb[0] = new \stdClass();
$std->aposentesp->iniaposentesp->infoamb[0]->codamb = '123456';

$std->aposentesp->iniaposentesp->infoamb[0]->fatrisco[0] = new \stdClass();
$std->aposentesp->iniaposentesp->infoamb[0]->fatrisco[0]->codfatris = '9101';

$std->aposentesp->altaposentesp = new \stdClass();
$std->aposentesp->altaposentesp->dtaltcondicao = '2017-08-28';

$std->aposentesp->altaposentesp->infoamb[0] = new \stdClass();
$std->aposentesp->altaposentesp->infoamb[0]->codamb = '123456';

$std->aposentesp->altaposentesp->infoamb[0]->fatrisco[0] = new \stdClass();
$std->aposentesp->altaposentesp->infoamb[0]->fatrisco[0]->codfatris = '9101';

$std->aposentesp->fimaposentesp = new \stdClass();
$std->aposentesp->fimaposentesp->dtfimcondicao = '2017-08-28';

$std->aposentesp->fimaposentesp->infoamb[0] = new \stdClass();
$std->aposentesp->fimaposentesp->infoamb[0]->codamb = '123456';


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtInsApo(
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
