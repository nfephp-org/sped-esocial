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
    'serviceVersion' => '1.4.1',
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
$std->indretif = 1;

$std->idevinculo = new \stdClass();
$std->idevinculo->cpftrab = '11111111111';
$std->idevinculo->nistrab = '11111111111';
$std->idevinculo->matricula = '11111111111';

$std->aso = new \stdClass();
$std->aso->dtaso = '2017-08-18';
$std->aso->tpaso = 0;
$std->aso->resaso = 1;

$std->aso->exame[0] = new \stdClass();
$std->aso->exame[0]->dtexm = '2017-08-18';
$std->aso->exame[0]->procrealizado = 10102019;
$std->aso->exame[0]->obsproc = 'observação do exame';
$std->aso->exame[0]->interprexm = 1;
$std->aso->exame[0]->ordexame = 1;
$std->aso->exame[0]->dtinimonit = '2017-08-18';
$std->aso->exame[0]->dtfimmonit = '2018-08-18';
$std->aso->exame[0]->indresult = 1;
$std->aso->exame[0]->respmonit = new \stdClass();
$std->aso->exame[0]->respmonit->nisresp = '11111111111';
$std->aso->exame[0]->respmonit->nrconsclasse = '11111111';

$std->aso->ideservsaude = new \stdClass();
$std->aso->ideservsaude->codcnes = '1111111';
$std->aso->ideservsaude->frmctt = 'CONTATO';
$std->aso->ideservsaude->email = 'teste@exemplo.com.br';
$std->aso->ideservsaude->medico = new \stdClass();
$std->aso->ideservsaude->medico->nmmed = 'NOME DO MEDICO';
$std->aso->ideservsaude->medico->nrcrm = '12345678';
$std->aso->ideservsaude->medico->ufcrm = 'SP';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
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
