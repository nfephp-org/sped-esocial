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

$std             = new \stdClass();
$std->sequencial = 1;
$std->indretif   = 1;

$idevinculo            = new \stdClass();
$idevinculo->cpftrab   = '11111111111';
$idevinculo->nistrab   = '11111111111';
$idevinculo->matricula = '11111111111';

$std->idevinculo = $idevinculo;

$aso         = new \stdClass();
$aso->dtaso  = '2017-08-18';
$aso->tpaso  = 0;
$aso->resaso = 1;

$std->aso = $aso;

$exame[0]                = new \stdClass();
$exame[0]->dtexm         = '2017-08-18';
$exame[0]->procrealizado = 10102019;
$exame[0]->obsproc       = 'observação do exame';
$exame[0]->interprexm    = 1;
$exame[0]->ordexame      = 1;
$exame[0]->dtinimonit    = '2017-08-18';
$exame[0]->dtfimmonit    = '2018-08-18';
$exame[0]->indresult     = 1;

$std->exame = $exame;

$respmonit               = new \stdClass();
$respmonit->nisresp      = '11111111111';
$respmonit->nrconsclasse = '11111111';

$std->respmonit = $respmonit;

$ideservsaude          = new \stdClass();
$ideservsaude->codcnes = '1111111';
$ideservsaude->frmctt  = 'CONTATO';
$ideservsaude->email   = 'teste@exemplo.com.br';

$std->ideservsaude = $ideservsaude;

$medico        = new \stdClass();
$medico->nmmed = 'NOME DO MEDICO';
$medico->nrcrm = '12345678';
$medico->ufcrm = 'SP';

$std->medico = $medico;

try {
    //carrega a classe responsavel por lidar com os certificados
    $content     = file_get_contents('expired_certificate.pfx');
    $password    = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtMonit(
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
