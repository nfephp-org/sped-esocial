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

//carrega os dados do envento
$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789';
$std->indguia = 1;
$std->cpftrab = '99999999999';
$std->matricula = '1234infomv56788-56478ABC';
$std->mtvdeslig = '02';
$std->dtdeslig = '2017-11-25';
$std->indpagtoapi = 'S';
$std->dtprojfimapi = '2017-11-25';
$std->pensalim = 2;
$std->percaliment = 22;
$std->vralim = 1234.45;
$std->nrproctrab = '12345678901234567890';
$std->infoInterm[0] = new \stdClass();
$std->infoInterm[0]->dia = 12;

$std->observacoes[0] = new \stdClass();
$std->observacoes[0]->observacao = 'observacao';

$std->sucessaovinc = new \stdClass();
$std->sucessaovinc->tpinsc = 1;
$std->sucessaovinc->nrinsc = '12345678901234';

$std->transftit = new \stdClass();
$std->transftit->cpfsubstituto = '12345678901';
$std->transftit->dtnascto = '1969-10-04';

$std->mudancacpf = new \stdClass();
$std->mudancacpf->novocpf = '12345678901';

$std->verbasresc = new \stdClass();
$std->verbasresc->dmdev[1] = new \stdClass();
$std->verbasresc->dmdev[1]->idedmdev = 'akakakak737477382828282828282';
$std->verbasresc->dmdev[1]->infoperapur = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->nrinsc = '12345678901234';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->codlotacao = 'asdfg';

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->idetabrubr = '12345678';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->qtdrubr = 25.45;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->fatorrubr = 1.56;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->vrrubr = 200.56;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->indapurir = 0;

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo->grauexp = 2;

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->dmdev[1]->infoperant = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dtacconv = '2017-04-02';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->tpacconv = 'A';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dsc = 'kksksks k skjskjskjs sk';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->perref = '2017-01';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->nrinsc = '12345678901234';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->codlotacao = 'asdfg';

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->idetabrubr = '12345678';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->qtdrubr = 25.45;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->fatorrubr = 1.56;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->vrrubr = 200.56;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->indapurir = 0;

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo->grauexp = 2;

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->procjudtrab[1] = new \stdClass();
$std->verbasresc->procjudtrab[1]->tptrib = 3;
$std->verbasresc->procjudtrab[1]->nrprocjud = '12345678901234567890';
$std->verbasresc->procjudtrab[1]->codsusp = '12345678901234';

$std->verbasresc->infomv = new \stdClass();
$std->verbasresc->infomv->indmv = 2;

$std->verbasresc->infomv->remunoutrempr[1] = new \stdClass();
$std->verbasresc->infomv->remunoutrempr[1]->tpinsc = 1;
$std->verbasresc->infomv->remunoutrempr[1]->nrinsc = '12345678901234';
$std->verbasresc->infomv->remunoutrempr[1]->codcateg = '001';
$std->verbasresc->infomv->remunoutrempr[1]->vlrremunoe = 2535.97;

$std->verbasresc->proccs = new \stdClass();
$std->verbasresc->proccs->nrprocjud = '12345678901234567890';

$std->quarentena = new \stdClass();
$std->quarentena->dtfimquar = '2018-12-20';

$std->consigfgts[0] = new \stdClass();
$std->consigfgts[0]->insconsig = '12345';
$std->consigfgts[0]->nrcontr = '123456789012345';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtDeslig(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2299($json, $std, $certificate)->toXML();
    //$json = Event::evtDeslig($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
