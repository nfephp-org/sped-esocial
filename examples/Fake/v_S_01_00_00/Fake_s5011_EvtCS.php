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
$std->indapuracao = 1;
$std->perapur = '2017-11';
$std->nrrecarqbase = 'ksksksk1211_40';
$std->indexistinfo = 3;

$std->infocpseg = new \stdClass();
$std->infocpseg->vrdesccp = 222.56;
$std->infocpseg->vrcpseg = 333.89;
$std->infocontrib = new \stdClass();
$std->infocontrib->classtrib = '02';
$std->infocontrib->infopj = new \stdClass();
$std->infocontrib->infopj->indcoop = 0;
$std->infocontrib->infopj->indconstr = 1;
$std->infocontrib->infopj->indsubstpatr = 2;
$std->infocontrib->infopj->percredcontrib = 23.45;
$std->infocontrib->infopj->infoatconc = new \stdClass();
$std->infocontrib->infopj->infoatconc->fatormes = 0.96;
$std->infocontrib->infopj->infoatconc->fator13 = 0.01;

$std->ideestab[1] = new \stdClass();
$std->ideestab[1]->tpinsc = 4;
$std->ideestab[1]->nrinsc = '12345678901234';
$std->ideestab[1]->infoestab = new \stdClass();
$std->ideestab[1]->infoestab->cnaeprep = 12345;
$std->ideestab[1]->infoestab->aliqrat = 4;
$std->ideestab[1]->infoestab->fap = 0.5;
$std->ideestab[1]->infoestab->aliqratajust = 2.00;
$std->ideestab[1]->infoestab->infocomplobra = new \stdClass();
$std->ideestab[1]->infoestab->infocomplobra->indsubstpatrobra = 1;

$std->ideestab[1]->idelotacao[1] = new \stdClass();
$std->ideestab[1]->idelotacao[1]->codlotacao = 'kjskjsksj';
$std->ideestab[1]->idelotacao[1]->fpas = 111;
$std->ideestab[1]->idelotacao[1]->codtercs = 'lsls';
$std->ideestab[1]->idelotacao[1]->codtercssusp = 'oeoe';
$std->ideestab[1]->idelotacao[1]->infotercsusp[1] = new \stdClass();
$std->ideestab[1]->idelotacao[1]->infotercsusp[1]->codterc = 'aaaa';
$std->ideestab[1]->idelotacao[1]->infoemprparcial = new \stdClass();
$std->ideestab[1]->idelotacao[1]->infoemprparcial->tpinsccontrat = 1;
$std->ideestab[1]->idelotacao[1]->infoemprparcial->nrinsccontrat = '12345678901234';
$std->ideestab[1]->idelotacao[1]->infoemprparcial->tpinscprop = 2;
$std->ideestab[1]->idelotacao[1]->infoemprparcial->nrinscprop = '12345678901';
$std->ideestab[1]->idelotacao[1]->infoemprparcial->cnoobra = '123456789012';
$std->ideestab[1]->idelotacao[1]->dadosopport = new \stdClass();
$std->ideestab[1]->idelotacao[1]->dadosopport->cnpjopportuario = '12345678901234';
$std->ideestab[1]->idelotacao[1]->dadosopport->aliqrat = 3;
$std->ideestab[1]->idelotacao[1]->dadosopport->fap = 1.0;
$std->ideestab[1]->idelotacao[1]->dadosopport->aliqratajust = 2.99;
$std->ideestab[1]->idelotacao[1]->basesremun[1] = new \stdClass();
$std->ideestab[1]->idelotacao[1]->basesremun[1]->indincid = 9;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->codcateg = 123;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp = new \stdClass();
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrbccp00 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrbccp15 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrbccp20 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrbccp25 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsuspbccp00 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsuspbccp15 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsuspbccp20 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsuspbccp25 = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrdescsest = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrcalcsest = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrdescsenat = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrcalcsenat = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsalfam = 100.00;
$std->ideestab[1]->idelotacao[1]->basesremun[1]->basescp->vrsalmat = 100.00;
$std->ideestab[1]->idelotacao[1]->basesavnport = new \stdClass();
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp00 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp15 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp20 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp25 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbccp13 = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrbcfgts = 222.22;
$std->ideestab[1]->idelotacao[1]->basesavnport->vrdesccp = 222.22;

$std->ideestab[1]->idelotacao[1]->infosubstpatropport[1] = new \stdClass();
$std->ideestab[1]->idelotacao[1]->infosubstpatropport[1]->cnpjopportuario = '12345678901234';

$std->ideestab[1]->basesaquis[1] = new \stdClass();
$std->ideestab[1]->basesaquis[1]->indaquis = 2;
$std->ideestab[1]->basesaquis[1]->vlraquis = 333.33;
$std->ideestab[1]->basesaquis[1]->vrcpdescpr = 333.33;
$std->ideestab[1]->basesaquis[1]->vrcpnret = 333.33;
$std->ideestab[1]->basesaquis[1]->vrratnret = 333.33;
$std->ideestab[1]->basesaquis[1]->vrsenarnret = 333.33;
$std->ideestab[1]->basesaquis[1]->vrcpcalcpr = 333.33;
$std->ideestab[1]->basesaquis[1]->vrratdescpr = 333.33;
$std->ideestab[1]->basesaquis[1]->vrratcalcpr = 333.33;
$std->ideestab[1]->basesaquis[1]->vrsenardesc = 333.33;
$std->ideestab[1]->basesaquis[1]->vrsenarcalc = 333.33;

$std->ideestab[1]->basescomerc[1] = new \stdClass();
$std->ideestab[1]->basescomerc[1]->indcomerc = 8;
$std->ideestab[1]->basescomerc[1]->vrbccompr = 44.44;
$std->ideestab[1]->basescomerc[1]->vrcpsusp = 44.44;
$std->ideestab[1]->basescomerc[1]->vrratsusp = 44.44;
$std->ideestab[1]->basescomerc[1]->vrsenarsusp = 44.44;

$std->ideestab[1]->infocrestab[1] = new \stdClass();
$std->ideestab[1]->infocrestab[1]->tpcr = 12345;
$std->ideestab[1]->infocrestab[1]->vrcr = 55.55;
$std->ideestab[1]->infocrestab[1]->vrsuspcr = 55.55;

$std->infocrcontrib[1] = new \stdClass();
$std->infocrcontrib[1]->tpcr = 122;
$std->infocrcontrib[1]->vrcr = 1458.65;
$std->infocrcontrib[1]->vrcrsusp = 1400.65;


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtCS(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s5011($json, $std, $certificate)->toXML();
    //$json = Event::evtCS($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
