<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.2.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.2.0',
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
//$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789';

$std->cpftrab = '12345678901';
$std->matricula = '9292kkk';
$std->codcateg = '123';

$std->dtacid = '2017-12-10';
$std->tpacid = 1;
$std->hracid = '0522';
$std->hrstrabantesacid = '0559';

$std->tpcat = 1;
$std->indcatobito = 'S';
$std->dtobito = '2017-12-10';

$std->indcomunpolicia = 'S';
$std->codsitgeradora = '123456789';

$std->iniciatcat = 3;
$std->obscat = 'lksjlskjlskjslkjslkjslkjslksjl';
$std->ultdiatrab = '2023-01-01';
$std->houveafast = 'S';
$std->tplocal = 9;
$std->dsclocal = 'klçkdçldkdlkdlk';
$std->tplograd = 'AAAA';
$std->dsclograd = 'poiwpoiwowiowi';
$std->nrlograd = '2929b';
$std->complemento = 'lslslsl';
$std->bairro = 'nsnnsnsn';
$std->cep = '04154000';
$std->codmunic = '1200104';
$std->uf = 'AC';
$std->pais = '105';
$std->codpostal = '123456789012';

$std->idelocalacid = new \stdClass();
$std->idelocalacid->tpinsc = 1;
$std->idelocalacid->nrinsc = '12345678901234';


$std->parteatingida = new \stdClass();
$std->parteatingida->codparteating = '123456789';
$std->parteatingida->lateralidade = 0;

$std->agentecausador = new \stdClass();
$std->agentecausador->codagntcausador = '123456789';

$std->atestado = new \stdClass();
$std->atestado->dtatendimento = '2017-02-01';
$std->atestado->hratendimento = '0000';
$std->atestado->indinternacao = 'S';
$std->atestado->durtrat = 2;
$std->atestado->indafast = 'N';
$std->atestado->dsclesao = '123456789';
$std->atestado->dsccompLesao = 'lskjslkjslkjslksjlskjslkj';
$std->atestado->diagprovavel = 'kkhjskjhskjhskjhskjshkjh';
$std->atestado->codcid = 'a234';
$std->atestado->observacao = 'llksjlkjslksjlskjlsjlskj';
$std->atestado->nmemit = 'Dr Estranho';
$std->atestado->ideoc = 2;
$std->atestado->nroc = '12222kkkk';
$std->atestado->ufoc = 'AC';

$std->catorigem = new \stdClass();
$std->catorigem->nrreccatorig = '1.1.1234567890123456789';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtCAT(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2210($json, $std, $certificate)->toXML();
    //$json = Event::evtCAT($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
