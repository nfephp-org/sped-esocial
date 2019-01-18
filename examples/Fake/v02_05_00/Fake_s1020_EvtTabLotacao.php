<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_4_02',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.4.2',
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
$std->codlotacao = 'assistente';
$std->inivalid = '2017-01';
$std->fimvalid = '2017-12';
$std->modo = 'INC';

$std->dadoslotacao = new \stdClass();
$std->dadoslotacao->tplotacao = '01';
$std->dadoslotacao->tpinsc = 1;
$std->dadoslotacao->nrinsc = '123456789012345';
$std->dadoslotacao->fpas = 507;
$std->dadoslotacao->codtercs = '0064';
$std->dadoslotacao->codtercssusp = '0072';
$std->dadoslotacao->procjudterceiro[0] = new \stdClass();
$std->dadoslotacao->procjudterceiro[0]->codterc = '0064';
$std->dadoslotacao->procjudterceiro[0]->nrprocjud = '12345678901234567890';
$std->dadoslotacao->procjudterceiro[0]->codsusp = '1234567';

$std->dadoslotacao->infoemprparcial = new \stdClass();
$std->dadoslotacao->infoemprparcial->tpinsccontrat = 1;
$std->dadoslotacao->infoemprparcial->nrinsccontrat = '12345678901234';
$std->dadoslotacao->infoemprparcial->tpinscprop = 2;
$std->dadoslotacao->infoemprparcial->nrinscprop = '12345678901234';

$std->novavalidade = new \stdClass();
$std->novavalidade->inivalid = '2017-01';
$std->novavalidade->fimvalid = '2017-12';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtTabLotacao(
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
