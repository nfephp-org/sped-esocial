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

$std->nrproctrab = '12345678901234567890'; //obrigatório
$std->perapurpgto = '2023-10';
$std->obs = 'Bla bla bla'; //opcional

$std->idetrab[0] = new \stdClass(); //obrigatório 1-n
$std->idetrab[0]->cpftrab = '12345678901';

$std->idetrab[0]->calctrib[0] = new \stdClass(); //opcional 0-999
$std->idetrab[0]->calctrib[0]->perref = '2023-10';
$std->idetrab[0]->calctrib[0]->vrbccpmensal = 2555.34;
$std->idetrab[0]->calctrib[0]->vrbccp13 = 2555.34;

$std->idetrab[0]->calctrib[0]->infocrcontrib[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->calctrib[0]->infocrcontrib[0]->tpcr = '113851';
$std->idetrab[0]->calctrib[0]->infocrcontrib[0]->vrcr = 325.87;

$std->idetrab[0]->infocrirrf[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->infocrirrf[0]->tpcr = '593656'; //593656 - IRRF - Decisão da Justiça do Trabalho 188951 - IRRF - RRA - Decisão da Justiça do Trabalho
$std->idetrab[0]->infocrirrf[0]->vrcr = 326.91;

$std->idetrab[0]->infocrirrf[0]->infoir = new \stdClass(); //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendtrib = 2555.34; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendtrib13 = 2555.34; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendmolegrave = 2000; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendisen65 = 2000; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrjurosmora = 32.48; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->vrrendisenntrib = 2000; //opcional
$std->idetrab[0]->infocrirrf[0]->infoir->descisenntrib = 'Bla bla bla'; //opcional 1-60
$std->idetrab[0]->infocrirrf[0]->infoir->vrprevoficial = 800; //opcional

$std->idetrab[0]->infocrirrf[0]->inforra = new \stdClass(); //opcional
$std->idetrab[0]->infocrirrf[0]->inforra->descrra = 'bla bla bla'; // 1-50
$std->idetrab[0]->infocrirrf[0]->inforra->qtdmesesrra = 4;

$std->idetrab[0]->infocrirrf[0]->inforra->despprocjud = new \stdClass(); //opcional
$std->idetrab[0]->infocrirrf[0]->inforra->despprocjud->vlrdespcustas = 200;
$std->idetrab[0]->infocrirrf[0]->inforra->despprocjud->vlrdespadvogados = 12000;

$std->idetrab[0]->infocrirrf[0]->inforra->ideadv[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->infocrirrf[0]->inforra->ideadv[0]->tpisnc = 1;
$std->idetrab[0]->infocrirrf[0]->inforra->ideadv[0]->nrisnc = '12345678901234';
$std->idetrab[0]->infocrirrf[0]->inforra->ideadv[0]->vlradv = 12000;

$std->idetrab[0]->infocrirrf[0]->deddepen[0] = new \stdClass(); //opcional 0-999
$std->idetrab[0]->infocrirrf[0]->deddepen[0]->tprend = '11';
$std->idetrab[0]->infocrirrf[0]->deddepen[0]->cpfdep = '12345678901';
$std->idetrab[0]->infocrirrf[0]->deddepen[0]->vlrdeducao = 300;

$std->idetrab[0]->infocrirrf[0]->penalim[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->infocrirrf[0]->penalim[0]->tprend = '11';
$std->idetrab[0]->infocrirrf[0]->penalim[0]->cpfdep = '12345678901';
$std->idetrab[0]->infocrirrf[0]->penalim[0]->vlrpensao = 1000;

$std->idetrab[0]->infocrirrf[0]->infoprocret[0] = new \stdClass(); //opcional 0-50
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->tpprocret = 1;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->nrprocret = '12345678901234567';
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->codsusp = '123'; //opcional

$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0] = new \stdClass(); //opcional 0-2
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->indapuracao = 1;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrnretido = 100;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrdepjud = 20;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrcmpanocal = 300;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrcmpanoant = 20;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->vlrrendsusp = 400;

$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0] = new \stdClass(); //opcional 0-25
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->indtpdeducao = '1';
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->vlrdedsusp = 300;
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->benefpen[0] = new \stdClass(); //opcional 0-99
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->benefpen[0]->cpfdep = '12345678901';
$std->idetrab[0]->infocrirrf[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->benefpen[0]->vlrdepensusp = 300;

$std->idetrab[0]->infoircomplem = new \stdClass(); //opcional
$std->idetrab[0]->infoircomplem->dtlaudo = '2023-10-31';
$std->idetrab[0]->infoircomplem->infodep[0] = new \stdClass(); //opcional 0-999
$std->idetrab[0]->infoircomplem->infodep[0]->cpfdep = '12345678901';
$std->idetrab[0]->infoircomplem->infodep[0]->dtnascto = '2020-12-01';
$std->idetrab[0]->infoircomplem->infodep[0]->nome = 'Chica da Silva';
$std->idetrab[0]->infoircomplem->infodep[0]->depirrf = 'S';
$std->idetrab[0]->infoircomplem->infodep[0]->tpdep = '03';
$std->idetrab[0]->infoircomplem->infodep[0]->descrdep = 'bla bla bla';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtContProc(
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
