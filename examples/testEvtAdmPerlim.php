<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../bootstrap.php';

use NFePHP\eSocial\Event;
use NFePHP\Common\Certificate;

$content = file_get_contents('expired_certificate.pfx');
$password = 'associacao';
$certificate = Certificate::readPfx($content, $password);

$config = [
    'tpInsc' => 1,  //1-CNPJ, 2-CPF
    'nrInsc' => '99999999999999', //numero do documento
    'company' => 'Razao Social',
    'tpAmb' => 3, //tipo de ambiente 1 - Produção;2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_2_01', //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'layout' => '2.2.1' //versão do layout
];
$json = json_encode($config);

try {

    $std = new \stdClass();
    $std->sequencial = 1;
    $std->cpfTrab = '00232133417';
    $std->dtNascto = new \DateTime('1961-02-12');
    $std->dtAdm = new \DateTime('2017-04-12');

    $xml = Event::evtAdmPrelim($json, $std, $certificate)->toXML();
    
} catch (\Exception $e) {
    echo $e->getMessage();
    die;
}
header('Content-type: text/xml; charset=UTF-8');
echo $xml;

//header('Content-Type: application/json');
//echo $json;

//echo "<pre>";
//print_r($xml);
//echo "</pre>";
