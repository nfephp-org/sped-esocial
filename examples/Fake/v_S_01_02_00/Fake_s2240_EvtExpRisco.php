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
$std->nrrecibo = "1.7.1234567890123456789";
$std->cpftrab = '12345678901';
$std->matricula = '002zcbv';
$std->codcateg = '111';
$std->dtinicondicao = '2016-02-01';
$std->dtfimcondicao = null;
//Informar a data em que o trabalhador terminou as atividades nas condições descritas.
//Preenchimento obrigatório e exclusivo para trabalhador avulso (código de categoria no RET igual a [2XX])
//e se {dtIniCondicao}(./dtIniCondicao) for igual ou posterior a [2023-01-16].
//Se informada, deve ser uma data válida, igual ou posterior a {dtIniCondicao}(./dtIniCondicao) e
//igual ou anterior a {dtTerm}(2399_infoTSVTermino_dtTerm) de S-2399, se existente.

$std->infoamb = new \stdClass();
$std->infoamb->localamb = 1;
$std->infoamb->dscsetor = 'Administrativo';
$std->infoamb->tpinsc = 1;
$std->infoamb->nrinsc = '12345678901234';

$std->dscativdes = 'lkskslkslsklsks  lsk slsklsk';

$std->agnoc[0] = new \stdClass();
$std->agnoc[0]->codagnoc = '01.01.012';
$std->agnoc[0]->dscagnoc = 'Cair um meteoro na cabeça';
$std->agnoc[0]->tpaval = 1;
$std->agnoc[0]->intconc = 20;
$std->agnoc[0]->limtol = 22.34;
$std->agnoc[0]->unmed = 15;
$std->agnoc[0]->tecmedicao = 'dosimetro Geiger- Muller de halogenio';
$std->agnoc[0]->nrprocjud = '12345678901234567';

$std->agnoc[0]->epcepi = new \stdClass();
$std->agnoc[0]->epcepi->utilizepc = 1; // 0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado.
$std->agnoc[0]->epcepi->eficepc = 'S';
$std->agnoc[0]->epcepi->utilizepi = 1; //0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado
$std->agnoc[0]->epcepi->eficepi = 'S';
$std->agnoc[0]->epcepi->epi[0] = new \stdClass();
$std->agnoc[0]->epcepi->epi[0]->docaval = 'blablabla';

$std->agnoc[0]->epcepi->epicompl = new \stdClass();
$std->agnoc[0]->epcepi->epicompl->medprotecao = 'S';
$std->agnoc[0]->epcepi->epicompl->condfuncto = 'S';
$std->agnoc[0]->epcepi->epicompl->usoinint = 'S';
$std->agnoc[0]->epcepi->epicompl->przvalid = 'S';
$std->agnoc[0]->epcepi->epicompl->periodictroca = 'S';
$std->agnoc[0]->epcepi->epicompl->higienizacao = 'S';

$std->respreg[0] = new \stdClass();
$std->respreg[0]->cpfresp = '12345678901';
$std->respreg[0]->ideoc = 4;
$std->respreg[0]->dscoc = 'bla bla bla';
$std->respreg[0]->nroc = '12345678901234';
$std->respreg[0]->ufoc = 'SP';

$std->obscompl = 'kslksj s sljsljs ks';

//echo "<pre>";
//print_r($std);
//echo "</pre>";
//die;
try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtExpRisco(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2190($json, $std, $certificate)->toXML();
    //$json = Event::evtAdmPrelim($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
