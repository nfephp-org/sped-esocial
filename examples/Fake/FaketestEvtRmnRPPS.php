<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config     = [
    'tpAmb'          => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc'        => '2_3_00',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion'  => '2.3.0',
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

$std              = new \stdClass();
$std->sequencial  = 1;
$std->indretif    = 1;
$std->nrrecibo    = '123456';
$std->indapuracao = 1;
$std->perapur     = '2017-08';

$std->idetrabalhador          = new \stdClass();
$std->idetrabalhador->cpftrab = '11111111111';

$std->idetrabalhador->procjudtrab[0]            = new \stdClass();
$std->idetrabalhador->procjudtrab[0]->tptrib    = 1;
$std->idetrabalhador->procjudtrab[0]->nrprocjud = '12456';
$std->idetrabalhador->procjudtrab[0]->codsusp   = 123456;

$std->dmdev[0]           = new \stdClass();
$std->dmdev[0]->idedmdev = '213789';

$std->dmdev[0]->infoperapur = new \stdClass();

$std->dmdev[0]->infoperapur->ideestab[0]         = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->tpinsc = 1;
$std->dmdev[0]->infoperapur->ideestab[0]->nrinsc = '11111111111111';

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]            = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->matricula = '12365110';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->codcateg  = 101;

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]             = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->codrubr    = '123150';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->idetabrubr = '12345678';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->qtdrubr    = 1;
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->fatorrubr  = 1;
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->vrrubr     = 1;

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet                       = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]           = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->cnpjoper = '11111111111111';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->regans   = '111111';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->vrpgtit  = 1500;

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]           = new \stdClass();
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->tpdep    = '01';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->cpfdep   = '11111111111';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->nmdep    = 'NOME';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->dtnascto = '1987-01-01';
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->infosaudecolet->detoper[0]->detplano[0]->vlrpgdep = 1500;

$std->dmdev[0]->infoperant                   = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]        = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->dtlei = '2017-08-29';
$std->dmdev[0]->infoperant->ideadc[0]->nrlei = '20170829';
$std->dmdev[0]->infoperant->ideadc[0]->dtef  = '2017-08-29';

$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]         = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->perref = '2017-08';

$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]         = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->tpinsc = 1;
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->nrinsc = '11111111111111';

$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]           = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->codcateg = 101;

$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]             = new \stdClass();
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]->codrubr    = '1615615';
$std->dmdev[0]->infoperant->ideadc[0]->ideperiodo[0]->ideestab[0]->remunperant[0]->itensremun[0]->idetabrubr = '1615615';


try {
    //carrega a classe responsavel por lidar com os certificados
    $content     = file_get_contents('expired_certificate.pfx');
    $password    = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtRmnRPPS(
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
