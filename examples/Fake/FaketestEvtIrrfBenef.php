<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use NFePHP\eSocial\Event;
use NFePHP\Common\Certificate;
use JsonSchema\Validator;

$config = [
    'tpAmb' => 2, //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_3_00', //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.3.0', //versão do layout do evento
    'serviceVersion' => '1.1.1',//versão do webservice
    'empregador' => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999', //numero do documento
        'nmRazao' => 'Razao Social'
    ],    
    'transmissor' => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999' //numero do documento
    ]
];
$configJson = json_encode($config, JSON_PRETTY_PRINT);

$std = new \stdClass();
$std->sequencial = 1;
$std->nrrecarqbase = 'ljdkdjdlkjdlkdjkdjdkjdkjdkdjk';
$std->perapur = '2017-08';
$std->cpftrab = '99999999999';
$std->vrdeddep = 1234.56;

$infoirrf[0] = new \stdClass();
$infoirrf[0]->codcateg = 101;
$infoirrf[0]->indresbr = 'N';        

$basesirrf[0] = new \stdClass();
$basesirrf[0]->tpvalor = '00';
$basesirrf[0]->valor = '1000';
$infoirrf[0]->basesirrf = $basesirrf;

$irrf[0] = new \stdClass();
$irrf[0]->tpcr = '056107';
$irrf[0]->vrirrfdesc = 12345.23;
$infoirrf[0]->irrf = $irrf;

$idepgtoext = new \stdClass();
$idepgtoext->codpais = '105';
$idepgtoext->indnif = 1;
$idepgtoext->nifbenef = 'lsklsslkslslsk';

$idepgtoext->dsclograd = 'RUA';
$idepgtoext->nrlograd = '123';
$idepgtoext->complem = 'ddddd';
$idepgtoext->bairro = 'eeee';
$idepgtoext->nmcid = 'nnnnnn';
$idepgtoext->codpostal = '123456789012';

$infoirrf[0]->idepgtoext = $idepgtoext;

$std->infoirrf = $infoirrf;

try {
    
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);
    
    //cria o evento e retorna o XML assinado
    $xml = Event::evtIrrfBenef(
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
