<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.3.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.3.0',
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
$std->indretif = 1; //obrigatorio
$std->nrrecibo = '1.4.1234567890123456789'; //opcional

$std->ideresp = new \stdClass(); //Opcional
$std->ideresp->tpinsc = 1;
$std->ideresp->nrinsc = '12345678901234';

$std->origem = 1; //obrigatprio
$std->nrproctrab = '12345678901234567890'; //obrigatório
$std->obsproctrab = 'Bla bla bla'; //opcional até 999

$std->infoprocjud = new \stdClass();
$std->infoprocjud->dtsent = '2022-12-03';
$std->infoprocjud->ufvara = 'SP';
$std->infoprocjud->codmunic = '3504808';
$std->infoprocjud->idvara = '12';

$std->infocccp = new \stdClass();
$std->infocccp->dtccp = '2022-12-03';
$std->infocccp->tpccp = 1;
$std->infocccp->cnpjccp = '12345678901234';

$std->cpftrab = '12345678901'; //obrigatório
$std->nmtrab = 'Fulano da Silva'; //opcional
$std->dtnascto = '1997-02-22'; //opcional

$std->infocontr[0] = new \stdClass(); //de 1 a 99
$std->infocontr[0]->tpcontr = 1; //obrigatório
$std->infocontr[0]->indcontr = 'S'; //obrigatório
$std->infocontr[0]->dtadmorig = '2021-11-03'; //opcional
$std->infocontr[0]->indreint = 'N'; //opcional
$std->infocontr[0]->indcateg = 'N'; //obrigatório
$std->infocontr[0]->indnatativ = 'N'; //obrigatório
$std->infocontr[0]->indmotdeslig = 'N'; //obrigatório
$std->infocontr[0]->matricula = 'ABC23434'; //opcional
$std->infocontr[0]->codcateg = "101"; //opcional
$std->infocontr[0]->dtinicio = '2022-11-05'; //opcional

$std->infocontr[0]->infocompl = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->codcbo = '123456'; //opcional
$std->infocontr[0]->infocompl->natatividade = 1; //opcional

$std->infocontr[0]->infocompl->remuneracao[0] = new \stdClass(); //opcional 0 a 99
$std->infocontr[0]->infocompl->remuneracao[0]->dtremun = '2022-12-15'; //Obrigatório
$std->infocontr[0]->infocompl->remuneracao[0]->vrsalfx = 2500.00; //Obrigatório
$std->infocontr[0]->infocompl->remuneracao[0]->undsalfixo = 5; //Obrigatório
$std->infocontr[0]->infocompl->remuneracao[0]->descsalvar = 'bla bla bla'; //opcional

$std->infocontr[0]->infocompl->infovinc = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infovinc->tpregtrab = 1;
$std->infocontr[0]->infocompl->infovinc->tpregprev = 1;
$std->infocontr[0]->infocompl->infovinc->dtadm = '2022-11-03';
$std->infocontr[0]->infocompl->infovinc->tmpparc = 0; //opcional

$std->infocontr[0]->infocompl->infovinc->duracao = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infovinc->duracao->tpcontr = 1;
$std->infocontr[0]->infocompl->infovinc->duracao->dtterm = '2023-11-15'; //opcional
$std->infocontr[0]->infocompl->infovinc->duracao->clauassec = 'S';  //opcional
$std->infocontr[0]->infocompl->infovinc->duracao->objdet = 'bla bla bla'; //opcional

$std->infocontr[0]->infocompl->infovinc->observacoes[0] = new \stdClass(); //opcional 0-99
$std->infocontr[0]->infocompl->infovinc->observacoes[0]->observacao = 'bla bla bla';

$std->infocontr[0]->infocompl->infovinc->sucessaovinc = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infovinc->sucessaovinc->tpinsc = 1;
$std->infocontr[0]->infocompl->infovinc->sucessaovinc->nrinsc = '12345678901234';
$std->infocontr[0]->infocompl->infovinc->sucessaovinc->matricant = '2222';
$std->infocontr[0]->infocompl->infovinc->sucessaovinc->dttransf = '2023-03-04';

$std->infocontr[0]->infocompl->infovinc->infodeslig = new \stdClass(); //Obrigatprio
$std->infocontr[0]->infocompl->infovinc->infodeslig->dtdeslig = '2023-11-15';
$std->infocontr[0]->infocompl->infovinc->infodeslig->mtvdeslig = '01';
$std->infocontr[0]->infocompl->infovinc->infodeslig->dtprojfimapi = '2023-12-15';
$std->infocontr[0]->infocompl->infovinc->infodeslig->pensalim = 0;
$std->infocontr[0]->infocompl->infovinc->infodeslig->percaliment = 10.00;
$std->infocontr[0]->infocompl->infovinc->infodeslig->vralim = 250.00;

$std->infocontr[0]->infocompl->infoterm = new \stdClass(); //opcional
$std->infocontr[0]->infocompl->infoterm->dtterm = '2023-11-15';
$std->infocontr[0]->infocompl->infoterm->mtvdesligtsv = '01';

$std->infocontr[0]->mudcategativ[0] = new \stdClass(); //opcional 0-99
$std->infocontr[0]->mudcategativ[0]->codcateg = '101';
$std->infocontr[0]->mudcategativ[0]->natatividade = 1;
$std->infocontr[0]->mudcategativ[0]->dtmudcategativ = '2023-10-01';

$std->infocontr[0]->uniccontr[0] = new \stdClass(); //opcional 0-99
$std->infocontr[0]->uniccontr[0]->matunic = '123445555';
$std->infocontr[0]->uniccontr[0]->codcateg = '101';
$std->infocontr[0]->uniccontr[0]->dtinicio = '2023-05-01';

$std->infocontr[0]->ideestab = new \stdClass(); //obrigatório
$std->infocontr[0]->ideestab->tpinsc = 1;
$std->infocontr[0]->ideestab->nrinsc = '12345678901234';

$std->infocontr[0]->ideestab->infovlr = new \stdClass(); //obrigatório
$std->infocontr[0]->ideestab->infovlr->compini = '2023-10';
$std->infocontr[0]->ideestab->infovlr->compfim = '2023-11';
$std->infocontr[0]->ideestab->infovlr->indreperc = 1;
$std->infocontr[0]->ideestab->infovlr->indensd = 'S';
$std->infocontr[0]->ideestab->infovlr->indenabono = 'S';

$std->infocontr[0]->ideestab->infovlr->abono[0] = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->abono[0]->anobase = '2023';

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0] = new \stdClass(); //opcional 0-999
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->perref = '2023-10';
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo->vrbccpmensal = 2500;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo->vrbccp13 = 2500;

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo->infoagnocivo = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basecalculo->infoagnocivo->grauexp = 1;

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts->vrbcfgtsproctrab = 532.54;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts->vrbcfgtssefip = 2000;
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->infofgts->vrbcfgtsdecant = 1000;

$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basemudcateg = new \stdClass(); //opcional
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basemudcateg->codcateg = '101';
$std->infocontr[0]->ideestab->infovlr->ideperiodo[0]->basemudcateg->vrbccprev = 3333.33;


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
        '2017-08-03 10:37:00' //opcional data e hora
    )->toXml();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
