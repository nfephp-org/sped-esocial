<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.1.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.1.0',
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
$std->ideresp = new \stdClass();
$std->ideresp->tpinsc = 1;
$std->ideresp->nrinsc = '12345678901234';
$std->origem = 1;
$std->nrproctrab = '123456789012345';
$std->obsproctrab = 'Bla bla bla';
$std->infoprocjud = new \stdClass(); //Opcional
$std->infoprocjud->dtsent = '2023-01-22';
$std->infoprocjud->ufvara = 'SP';
$std->infoprocjud->codmunic = '3512345';
$std->infoprocjud->idvara = '1';
$std->infoccp = new \stdClass(); //Opcional
$std->infoccp->dtccp = '2023-01-22';
$std->infoccp->tpccp = '2';
$std->infoccp->cnpjccp = '12345678901234';
$std->cpftrab = '12345678901';
$std->nmtrab = 'Fulano da Silva';
$std->dtnascto = '2000-04-02';
$std->dependente[0] = new \stdClass(); //array 0 a 99
$std->dependente[0]->cpfdep = '12345678901';
$std->dependente[0]->tpdep = '01';
$std->dependente[0]->descDep = 'amazia';

$std->infocontr[0] = new \stdClass(); //array 0 a 99
$std->infocontr[0]->tpcontr = '1';
$std->infocontr[0]->indcontr = 'S';
$std->infocontr[0]->dtadmorig = '2022-11-23';
$std->infocontr[0]->indreint = 'N';
$std->infocontr[0]->indcateg = 'N';
$std->infocontr[0]->indnatativ = 'S';
$std->infocontr[0]->indmotdeslig = 'N';
$std->infocontr[0]->indunic = 'S';
$std->infocontr[0]->matricula = 'ABC23838';
$std->infocontr[0]->codcateg = '101';
$std->infocontr[0]->dtinicio = '2023-03-02';
$std->infocontr[0]->infocompl = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->codcbo = '261105';
$std->infocontr[0]->infocompl->natatividade = '1';
$std->infocontr[0]->infocompl->remuneracao[0] = new \stdClass(); //array 0 a 99
$std->infocontr[0]->infocompl->remuneracao[0]->dtremun = '2022-12-10';
$std->infocontr[0]->infocompl->remuneracao[0]->vrsalfx = 7234.84;
$std->infocontr[0]->infocompl->remuneracao[0]->undsalfixo = '5';
$std->infocontr[0]->infocompl->remuneracao[0]->dscsalvar = 'teste teste';

$std->infocontr[0]->infocompl->infovinc = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infovinc->tpregtrab = '1';
$std->infocontr[0]->infocompl->infovinc->tpregprev = '1';
$std->infocontr[0]->infocompl->infovinc->dtadm = '2022-11-01';
$std->infocontr[0]->infocompl->infovinc->tmpparc = '0';

$std->infocontr[0]->infocompl->infovinc->duracao = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infovinc->duracao->tpcontr = '1';
$std->infocontr[0]->infocompl->infovinc->duracao->dtterm = '2023-02-10';
$std->infocontr[0]->infocompl->infovinc->duracao->clauassec = 'N';
$std->infocontr[0]->infocompl->infovinc->duracao->objdet = 'bla bla bla';

$std->infocontr[0]->infocompl->infovinc->observacoes[0] = new \stdClass(); //array 0 a 99
$std->infocontr[0]->infocompl->infovinc->observacoes[0]->observacao = 'Blablablablablabla';
$std->infocontr[0]->infocompl->infovinc->observacoes[1] = new \stdClass(); //array 0 a 99
$std->infocontr[0]->infocompl->infovinc->observacoes[1]->observacao = 'Testetesteteste';

$std->infocontr[0]->infocompl->infovinc->suceessaovinc = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infovinc->suceessaovinc->tpinsc = '1';
$std->infocontr[0]->infocompl->infovinc->suceessaovinc->nrinsc = '12345678901234';
$std->infocontr[0]->infocompl->infovinc->suceessaovinc->matricant = '5678';
$std->infocontr[0]->infocompl->infovinc->suceessaovinc->dttransf = '2022-12-12';

$std->infocontr[0]->infocompl->infovinc->infodeslig = new \stdClass(); //OBRIGATÓRIO
$std->infocontr[0]->infocompl->infovinc->infodeslig->dtdeslig = '2022-12-12';
$std->infocontr[0]->infocompl->infovinc->infodeslig->mtvdeslig = '44';
$std->infocontr[0]->infocompl->infovinc->infodeslig->dtprojfimapi = '2023-01-12';

$std->infocontr[0]->infocompl->infoterm = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infoterm->dtterm = '2022-10-10';
$std->infocontr[0]->infocompl->infoterm->mtvdesligtsv = '01';

$std->infocontr[0]->mudcategativ[0] = new \stdClass(); //array 0 a 99
$std->infocontr[0]->mudcategativ[0]->codcateg = '101';
$std->infocontr[0]->mudcategativ[0]->natatividade = '1';
$std->infocontr[0]->mudcategativ[0]->dtmudcategativ = '2022-11-30';

$std->infocontr[0]->uniccontr[0] = new \stdClass(); //array 0 a 99
$std->infocontr[0]->uniccontr[0]->matinic = '12345';
$std->infocontr[0]->uniccontr[0]->codcateg = '101';
$std->infocontr[0]->uniccontr[0]->dtinicio = '2022-11-30';

$std->infocontr[0]->ideestab = new \stdClass(); //OBRIGATÓRIO
$std->infocontr[0]->ideestab->tpinsc = '1';
$std->infocontr[0]->ideestab->nrinsc = '12345678901234';

$std->infocontr[0]->ideestab->infovlr = new \stdClass(); //OBRIGATÓRIO
$std->infocontr[0]->ideestab->infovlr->compini = '2023-02';
$std->infocontr[0]->ideestab->infovlr->compfim = '2023-04';
$std->infocontr[0]->ideestab->infovlr->repercproc = '1';
$std->infocontr[0]->ideestab->infovlr->vrremun = 2011.77;
$std->infocontr[0]->ideestab->infovlr->vrapi = 234.84;
$std->infocontr[0]->ideestab->infovlr->vr13api = 112.76;
$std->infocontr[0]->ideestab->infovlr->vrinden = 233.09;
$std->infocontr[0]->ideestab->infovlr->vrbaseidenfgts = 1234.88;
$std->infocontr[0]->ideestab->infovlr->pagdiretoresc = 'S';

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0] = new \stdClass(); //array 0 a 360
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->perref = '2022-04';
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->vrbccpmensal = 1000.00;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->vrbccp13 = 200.00;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->vrbcfgts = 300.00;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->vrbcfgts13 = 100.00;

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infoagnocivo = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infoagnocivo->grauexp = '1';

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts->vrbcfgtsguia = 2222.22;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts->vrbcfgts13guia = 1222.33;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts->pagdireto = 'S';

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basemudcateg = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basemudcateg->codcateg = '101';
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basemudcateg->vrbccprev = 2022.34;


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtProcTrab(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2500($json, $std, $certificate)->toXML();
    //$json = Event::evtProcTrab($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
