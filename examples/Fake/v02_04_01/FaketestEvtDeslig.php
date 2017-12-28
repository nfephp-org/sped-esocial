<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config     = [
    'tpAmb'          => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc'        => '2_4_01',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion'  => '2.4.1',
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

//carrega os dados do envento
$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab = '99999999999';
$std->nistrab = '11111111111';
$std->matricula = '1234infomv56788-56478ABC';
$std->mtvdeslig = '02';
$std->dtdeslig = '2017-11-25';
$std->indpagtoapi = 'S';
$std->dtprojfimapi = '2017-11-25';
$std->pensalim = 2;
$std->percaliment = 22;
$std->vralim = 1234.45;
$std->nrcertobito = '1234567890';
$std->nrProcTrab = '1234567890';
$std->indcumprparc = 2;
$std->observacao = 'observacao';

$std->sucessaovinc = new \stdClass();
$std->sucessaovinc->cnpjsucessora = '12345678901234';

$std->transftit = new \stdClass();
$std->transftit->cpfsubstituto = '12345678901';
$std->transftit->dtnascto = '1969-10-04';

$std->verbasresc = new \stdClass();
$std->verbasresc->dmdev[1] = new \stdClass();
$std->verbasresc->dmdev[1]->idedmdev = 'akakakak737477382828282828282';
$std->verbasresc->dmdev[1]->infoperapur = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->nrinsc = '123456789012345';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->codlotacao = 'asdfg';

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->idetabrubr = '12345678';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->qtdrubr = 25.45;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->fatorrubr = 1.56;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->vrunit = 20.15;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->vrrubr = 200.56;

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->cnpjoper = '12345678901234';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->regans = '123456';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->vrpgtit = 986.49;
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->tpdep = '01';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->cpfdep = '12345678901';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->nmdep = 'Fulano de Tal';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->dtnascto = '2005-06-05';
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosaudecolet->detoper[1]->detplano[1]->vlrpgdep = 199.41;


$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo->grauexp = 2;

$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->dmdev[1]->infoperant = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dtacconv = '2017-04-02';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->tpacconv = 'A';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->compacconv = '2017-04';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dtefacconv = '2017-06-02';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dsc = 'kksksks k skjskjskjs sk';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->perref = '2017-01';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->tpinsc = 1;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->nrinsc = '123456789012345';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->codlotacao = 'asdfg';

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->idetabrubr = '12345678';
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->qtdrubr = 25.45;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->fatorrubr = 1.56;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->vrunit = 20.15;
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->vrrubr = 200.56;

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo->grauexp = 2;

$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples = new \stdClass();
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples->indsimples = 1;

$std->verbasresc->dmdev[1]->infotrabinterm[1] = new \stdClass();
$std->verbasresc->dmdev[1]->infotrabinterm[1]->codconv = 'ksksksksksk';


$std->verbasresc->procjudtrab[1] = new \stdClass();
$std->verbasresc->procjudtrab[1]->tptrib = 3;
$std->verbasresc->procjudtrab[1]->nrprocjud = 'lalalalalalal';
$std->verbasresc->procjudtrab[1]->codsusp = '12345678901234';

$std->verbasresc->infomv = new \stdClass();
$std->verbasresc->infomv->indmv = 2;

$std->verbasresc->infomv->remunoutrempr[1] = new \stdClass();
$std->verbasresc->infomv->remunoutrempr[1]->tpinsc = 1;
$std->verbasresc->infomv->remunoutrempr[1]->nrinsc = '123456789012345';
$std->verbasresc->infomv->remunoutrempr[1]->codcateg = '001';
$std->verbasresc->infomv->remunoutrempr[1]->vlrremunoe = 2535.97;
 
$std->quarentena = new \stdClass();
$std->quarentena->dtfimquar = '2018-12-20';
         
$std->consigfgts = new \stdClass();
$std->consigfgts->idconsig = 'S';
$std->consigfgts->insconsig = '12345';
$std->consigfgts->nrcontr = '123456789012345';


try {
    //carrega a classe responsavel por lidar com os certificados
    $content     = file_get_contents('expired_certificate.pfx');
    $password    = 'associacao';
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
