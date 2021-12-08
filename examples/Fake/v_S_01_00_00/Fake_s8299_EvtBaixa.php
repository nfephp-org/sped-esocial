<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;


//ESTE EVENTO É EMITIDO COM EXCLUSIVIDADE PELO PODER JUDICIARIO

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
//$std->sequencial = 1;
$std->indretif = 1; //obrigatorio Informe [1] para arquivo original ou [2] para arquivo de retificação.
$std->nrrecibo = "1.9.1234567890123456789"; //opcional Preencher com o número do recibo do arquivo a ser retificado.
$std->cpftrab = "12345678901"; //obrigatorio Preencher com o número do CPF do trabalhador
$std->matricula = "123456789012345678901234567890"; //obrigatorio Matrícula atribuída ao trabalhador pela empresa
$std->mtvdeslig = "11"; //obrigatorio Código de motivo do desligamento. [11, 12, 13, 25, 28, 29, 30, 34, 36]
$std->dtdeslig = "2021-02-03"; //obrigatorio Preencher com a data de desligamento do vínculo (último dia trabalhado).
$std->dtprojfimapi =  "2021-03-03"; //opcional Data projetada para o término do aviso prévio indenizado
$std->nrproctrab = "C21-029010.23456789c"; //obrigatorio Número que identifica o processo judicial onde a baixa do vínculo foi determinada.
$std->observacao = "teste de geracao do evento"; //opcional Observação relevante sobre o desligamento do trabalhador, que não esteja consignada em outros campos.


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtBaixa(
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
