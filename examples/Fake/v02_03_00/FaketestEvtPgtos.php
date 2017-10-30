<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

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

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '123456';
$std->indapuracao = 1;
$std->perapur = '2017-08';
$std->idebenef = new \stdClass();
$std->idebenef->cpfbenef = '99999999999';
$std->idebenef->vrdeddep = 28657.59;
$std->idebenef->infopgto[0] = new \stdClass();
$std->idebenef->infopgto[0]->dtpgto = '2017-09-15';
$std->idebenef->infopgto[0]->tppgto = 1; //1,2,3,5,6
$std->idebenef->infopgto[0]->indresbr = 'S'; //SN
$std->idebenef->infopgto[0]->detpgtofl[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofl[0]->perref = '2017-09';
$std->idebenef->infopgto[0]->detpgtofl[0]->idedmdev = 'aaaaaaaa';
$std->idebenef->infopgto[0]->detpgtofl[0]->indpgtott = 'S'; //SN
$std->idebenef->infopgto[0]->detpgtofl[0]->vrliq = 1587.91;
$std->idebenef->infopgto[0]->detpgtofl[0]->nrrecarq = '234567';
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->codrubr = '2222222';
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->qtdrubr = 22.56;
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->fatorrubr = 50.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->vrrubr = 2000.00;
//$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0] = new \stdClass();
//$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->cpfbenef = '99999999999';
//$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->dtnasctobenef = '1998-12-12';
//$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->nmbenefic = 'Fulano de Tal';
//$std->idebenef->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->vlrpensao = 1024.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->codrubr = '2222222';
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->qtdrubr = 22.56;
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->fatorrubr = 50.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->vrrubr = 2000.00;
$std->idebenef->infopgto[0]->detpgtobenpr = new \stdClass();
$std->idebenef->infopgto[0]->detpgtobenpr->perref = '2018-09';
$std->idebenef->infopgto[0]->detpgtobenpr->idedmdev = 'dlkjdljdkdj';
$std->idebenef->infopgto[0]->detpgtobenpr->indpgtott = 'S';
$std->idebenef->infopgto[0]->detpgtobenpr->vrliq = 1000.00;
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->codrubr = 'lskslkslks';
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->qtdrubr = 22.56;
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->fatorrubr = 50.00;
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtobenpr->retpgtotot[0]->vrrubr = 2000.00;
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->codrubr = 'lskslkslks';
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->qtdrubr = 22.56;
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->fatorrubr = 50.00;
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtobenpr->infopgtoparc[0]->vrrubr = 2000.00;
$std->idebenef->infopgto[0]->detpgtofer[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofer[0]->codcateg = 111;
$std->idebenef->infopgto[0]->detpgtofer[0]->dtinigoz = '2017-10-01';
$std->idebenef->infopgto[0]->detpgtofer[0]->qtdias = 30;
$std->idebenef->infopgto[0]->detpgtofer[0]->vrliq = 4598.65;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->codrubr = 'jssj98338w';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->idetabrubr = '12345678';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->qtdrubr = 22.25;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->fatorrubr = 100;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->vrunit = 1000.00;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->vrrubr = 1000.00;
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->cpfbenef = '99999999999';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->dtnasctobenef = '1987-10-22';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->nmbenefic = 'Fulano de Tal';
$std->idebenef->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->vlrpensao = 1000.00;
$std->idebenef->infopgto[0]->detpgtoant[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtoant[0]->codcateg = 101;
$std->idebenef->infopgto[0]->detpgtoant[0]->infopgtoant[0] = new \stdClass();
$std->idebenef->infopgto[0]->detpgtoant[0]->infopgtoant[0]->tpbcirrf = '01';
$std->idebenef->infopgto[0]->detpgtoant[0]->infopgtoant[0]->vrbcirrf = 22569.93;
$std->idebenef->infopgto[0]->idepgtoext = new \stdClass();
$std->idebenef->infopgto[0]->idepgtoext->codpais = '001';
$std->idebenef->infopgto[0]->idepgtoext->indnif = 1;
$std->idebenef->infopgto[0]->idepgtoext->nifbenef = '1245474';
$std->idebenef->infopgto[0]->idepgtoext->dsclograd = 'PARK AV';
$std->idebenef->infopgto[0]->idepgtoext->nrlograd = '123';
$std->idebenef->infopgto[0]->idepgtoext->complem = 'R13';
$std->idebenef->infopgto[0]->idepgtoext->bairro = 'SOHO';
$std->idebenef->infopgto[0]->idepgtoext->nmcid = 'NEW YORK';
$std->idebenef->infopgto[0]->idepgtoext->codpostal = '000000000000';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content     = file_get_contents('expired_certificate.pfx');
    $password    = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtPgtos(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s1210($json, $std, $certificate)->toXML();
    //$json = Event::evtPgtos($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
