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
        'nrInsc' => '99999999999999', //numero do documento
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
$std->nrrecibo = 'abcdefghijklmnopq';
$std->indapuracao = 2;
$std->perapur = '2017-12';
$std->cpftrab = '12345678901';
$std->nistrab = '10987654321';

$std->infomv = new \stdClass();
$std->infomv->indmv = 1;
$std->infomv->remunoutrempr[0] = new \stdClass();
$std->infomv->remunoutrempr[0]->tpinsc = 1;
$std->infomv->remunoutrempr[0]->nrinsc = '123456789012345';
$std->infomv->remunoutrempr[0]->codcateg = 901;
$std->infomv->remunoutrempr[0]->vlrremunoe = 2345.09;

$std->infocomplem = new \stdClass();
$std->infocomplem->nmtrab = 'Fulano de Tal';
$std->infocomplem->dtnascto = '1985-02-14';
$std->infocomplem->codcbo = '123456';
$std->infocomplem->natatividade = 1;
$std->infocomplem->qtddiastrab = 6;

$std->infocomplem->sucessaovinc = new \stdClass();
$std->infocomplem->sucessaovinc->cnpjempregant = '12345678901234';
$std->infocomplem->sucessaovinc->matricant = 'jkdjkjdkjdjkd';
$std->infocomplem->sucessaovinc->dtadm = '2017-06-07';
$std->infocomplem->sucessaovinc->observacao = 'nao obrigatorio';

$std->procjudtrab[0] = new \stdClass();
$std->procjudtrab[0]->tptrib = 2;
$std->procjudtrab[0]->nrprocjud = '123456789';
$std->procjudtrab[0]->codsusp = '12345678901234';

$std->dmdev[0] = new \stdClass();
$std->dmdev[0]->idedmdev = 'kjdkjdkjdkdj';
$std->dmdev[0]->codcateg = 101;

$std->dmdev[0]->ideestablot[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->tpinsc = 2;
$std->dmdev[0]->ideestablot[0]->nrinsc = '123456789012345';
$std->dmdev[0]->ideestablot[0]->codlotacao = 'qlkjakljwj';
$std->dmdev[0]->ideestablot[0]->qtddiasav = 20;

$std->dmdev[0]->ideestablot[0]->remunperapur[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->matricula = 'kjsksjksjskjsk';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->indsimples = 1;

$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->codrubr = 'ksksksks';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->idetabrubr = 'j2j2j';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->qtdrubr = 150.30;
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->fatorrubr = 1.20;
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->vrunit = 123.90;
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->vrrubr = 333.33;

$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->cnpjoper = '12345678901234';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->regans = 'asdfgh';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->vrpgtit = 1234.50;

$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0] = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->tpdep = '01';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->cpfdep = '12345678901';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->nmdep = 'Maria Maria de Tal';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->dtnascto = '1991-09-15';
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->detoper[0]->detplano[0]->vlrpgdep = 912.68;

$std->dmdev[0]->ideestablot[0]->remunperapur[0]->infoagnocivo = new \stdClass();
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->infoagnocivo->grauexp = 1;

$std->dmdev[0]->ideadc[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->dtacconv = '2016-12-10';
$std->dmdev[0]->ideadc[0]->tpacconv = 'A';
$std->dmdev[0]->ideadc[0]->compacconv = '2017-01';
$std->dmdev[0]->ideadc[0]->dtefacconv = '2017-10-12';
$std->dmdev[0]->ideadc[0]->dsc = 'descricao';
$std->dmdev[0]->ideadc[0]->remunsuc = 'S';

$std->dmdev[0]->ideadc[0]->ideperiodo[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->perref = '2017-01';

$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->tpinsc = 1;
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->nrinsc = '12345678901234';
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->codlotacao = 'ksjskjkjskjjs';

$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->matricula = 'kjskjskjskjs';
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->indsimples = 1;

$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0] = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->codrubr = 'aaaaa';
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->idetabrubr = 'bbbbb';
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->qtdrubr = 12.65;
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->fatorrubr = 2.99;
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->vrunit = 123.02;
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->vrrubr = 169.99;

$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->infoagnocivo = new \stdClass();
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->infoagnocivo->grauexp = 2;


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtRemun(
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
