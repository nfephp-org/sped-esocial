<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Common\Soap\SoapFake;
use NFePHP\eSocial\Common\FakePretty;
use NFePHP\eSocial\Event;
use NFePHP\eSocial\Tools;

$config = [
    'tpAmb'          => 1,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.2.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.2.0',
    'serviceVersion' => '1.5.0', //versão do webservice
    'empregador'     => [
        'tpInsc'  => 1, //1-CNPJ, 2-CPF
        'nrInsc'  => '99999999', //numero do documento
        'nmRazao' => 'Razao Social',
    ],
    'transmissor'    => [
        'tpInsc' => 1, //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999' //numero do documento
    ],
];
$configJson = json_encode($config, JSON_PRETTY_PRINT);

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //usar a classe Fake para não tentar enviar apenas ver o resultado da chamada
    $soap = new SoapFake();
    //desativa a validação da validade do certificado
    //estamos usando um certificado vencido nesse teste
    $soap->disableCertValidation(true);

    $std = new \stdClass();
    $std->sequencial = 1;
    $std->indretif = 1;
    //$std->nrrecibo = 'lklskslkskslkslk';

    $std->idevinculo = new \stdClass();
    $std->idevinculo->cpftrab = '11111111111';
    $std->idevinculo->nistrab = '11111111111';
    $std->idevinculo->matricula = '11111111111';

    $std->treicap = new \stdClass();
    $std->treicap->codtreicap = '2222';
    $std->treicap->obstreicap = 'bla bla bla';

    $std->treicap->infocomplem = new \stdClass(); //opcional
    $std->treicap->infocomplem->dttreicap = '2018-11-12';
    $std->treicap->infocomplem->durtreicap = 22.4;
    $std->treicap->infocomplem->modtreicap = 3; //1-3
    $std->treicap->infocomplem->tptreicap = 5; //1-5
    $std->treicap->infocomplem->indtreinant = 'N';

    $std->treicap->infocomplem->ideprofresp[0] = new \stdClass();
    $std->treicap->infocomplem->ideprofresp[0]->cpfprof = '12345678901';
    $std->treicap->infocomplem->ideprofresp[0]->nmprof = 'Beltrano de Tal';
    $std->treicap->infocomplem->ideprofresp[0]->tpprof = 1; //1-2
    $std->treicap->infocomplem->ideprofresp[0]->formprof = 'bla bla bla';
    $std->treicap->infocomplem->ideprofresp[0]->codcbo = '123456';
    $std->treicap->infocomplem->ideprofresp[0]->nacprof = 1; //1-2

    $evento = Event::evtTreiCap($configJson, $std);


    //instancia a classe responsável pela comunicação
    $tools = new Tools($configJson, $certificate);
    //carrega a classe responsável pelo envio SOAP
    //nesse caso um envio falso
    $tools->loadSoapClass($soap);

    //executa o envio
    $response = $tools->enviarLoteEventos($tools::EVT_NAO_PERIODICOS, [$evento]);

    //retorna os dados que serão usados na conexão para conferência
    echo FakePretty::prettyPrint($response, '');
} catch (\Exception $e) {
    echo $e->getMessage();
}
