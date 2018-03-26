<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_4_02',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.4.2',
    //versão do layout do evento
    'serviceVersion' => '1.1.1',
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
$std->cpfbenef = '12345678901';

$std->deps = new \stdClass();
$std->deps->vrdeddep = 1000.00;

$std->infopgto[0] = new \stdClass();
$std->infopgto[0]->dtpgto = '2018-01-15';
$std->infopgto[0]->tppgto = 4;
$std->infopgto[0]->indresbr = 'N';

$std->infopgto[0]->detpgtofl[0] = new \stdClass();
$std->infopgto[0]->detpgtofl[0]->perref = '2018-12';
$std->infopgto[0]->detpgtofl[0]->idedmdev = 'jlkjkj112121';
$std->infopgto[0]->detpgtofl[0]->indpgtott = 'N';
$std->infopgto[0]->detpgtofl[0]->vrliq = 1001.55;
$std->infopgto[0]->detpgtofl[0]->nrrecarq = 'dkjhdkjdhkjdh dkjhdkjhdkj';

$std->infopgto[0]->detpgtofl[0]->retpgtotot[0] = new \stdClass();
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->codrubr = 'kjlsksksjs';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->idetabrubr = 'k2k3k2k3';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->qtdrubr = 1500.22;
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->fatorrubr = 11.55;
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->vrunit = 5894.56;
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->vrrubr = 8759.99;

$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0] = new \stdClass();
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->cpfbenef = '12345678901';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->dtnasctobenef = '2011-04-15';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->nmbenefic = 'Beltrano de Tal';
$std->infopgto[0]->detpgtofl[0]->retpgtotot[0]->penalim[0]->vlrpensao = 1200.87;

$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0] = new \stdClass();
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->matricula = 'slkjslskjslkjslksjks';
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->codrubr = 'sdkdjkdjdkjdkjd 29322929';
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->idetabrubr = 'ksks1234';
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->qtdrubr = 1000.34;
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->fatorrubr = 2.54;
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->vrunit = 1200.55;
$std->infopgto[0]->detpgtofl[0]->infopgtoparc[0]->vrrubr = 3988.77;

$std->infopgto[0]->detpgtobenpr = new \stdClass();
$std->infopgto[0]->detpgtobenpr->perref = '2018-02';
$std->infopgto[0]->detpgtobenpr->idedmdev = 'ljslksjksjksj';
$std->infopgto[0]->detpgtobenpr->indpgtott = 'N';
$std->infopgto[0]->detpgtobenpr->vrliq = 234.44;

$std->infopgto[0]->detpgtobenpr->retpgtotot[0] = new \stdClass();
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->codrubr = 'sdkdjkdjdkjdkjd 29322929';
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->idetabrubr = 'ksks1234';
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->qtdrubr = 2012.33;
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->fatorrubr = 3.66;
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->vrunit = 234.98;
$std->infopgto[0]->detpgtobenpr->retpgtotot[0]->vrrubr = 2654.87;

$std->infopgto[0]->detpgtobenpr->infopgtoparc[0] = new \stdClass();
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->codrubr = 'sdkdjkdjdkjdkjd 29322929';
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->idetabrubr = 'ksks1234';
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->qtdrubr = 2012.33;
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->fatorrubr = 3.66;
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->vrunit = 234.98;
$std->infopgto[0]->detpgtobenpr->infopgtoparc[0]->vrrubr = 2654.87;

$std->infopgto[0]->detpgtofer[0] = new \stdClass();
$std->infopgto[0]->detpgtofer[0]->codcateg = 101;
$std->infopgto[0]->detpgtofer[0]->matricula = 'slkjslskjslkjslksjks';
$std->infopgto[0]->detpgtofer[0]->dtinigoz = '2018-03-01';
$std->infopgto[0]->detpgtofer[0]->qtdias = 22;
$std->infopgto[0]->detpgtofer[0]->vrliq = 2658.25;

$std->infopgto[0]->detpgtofer[0]->detrubrfer[0] = new \stdClass();
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->codrubr = 'sdkdjkdjdkjdkjd 29322929';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->idetabrubr = 'ksks1234';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->qtdrubr = 2012.33;
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->fatorrubr = 3.66;
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->vrunit = 234.98;
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->vrrubr = 2654.87;

$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0] = new \stdClass();
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->cpfbenef = '12345678901';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->dtnasctobenef = '2011-04-15';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->nmbenefic = 'Beltrano de Tal';
$std->infopgto[0]->detpgtofer[0]->detrubrfer[0]->penalim[0]->vlrpensao = 1200.87;

$std->infopgto[0]->detpgtoant[0] = new \stdClass();
$std->infopgto[0]->detpgtoant[0]->codcateg = 101;

$std->infopgto[0]->detpgtoant[0]->infopgtoant[0] = new \stdClass();
$std->infopgto[0]->detpgtoant[0]->infopgtoant[0]->tpbcirrf = '01';
$std->infopgto[0]->detpgtoant[0]->infopgtoant[0]->vrbcirrf = 3452.87;

$std->infopgto[0]->idepgtoext = new \stdClass();
$std->infopgto[0]->idepgtoext->codpais = '008';
$std->infopgto[0]->idepgtoext->indnif = 3;
$std->infopgto[0]->idepgtoext->nifbenef = '298983927937';

$std->infopgto[0]->idepgtoext->endext = new \stdClass();
$std->infopgto[0]->idepgtoext->endext->dsclograd = 'lkjslkjsksj';
$std->infopgto[0]->idepgtoext->endext->nrlograd = '123';
$std->infopgto[0]->idepgtoext->endext->complem = 'kjdhkdjdhj';
$std->infopgto[0]->idepgtoext->endext->bairro = 'kjdlkdjkdjk';
$std->infopgto[0]->idepgtoext->endext->nmcid = 'lkwjlkjekj';
$std->infopgto[0]->idepgtoext->endext->codpostal = '1230099';


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtPgtos(
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
