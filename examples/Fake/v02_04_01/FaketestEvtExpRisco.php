<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_4_01',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.4.1',
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
$std->nrrecibo = null;
$std->cpftrab = '12345678901';
$std->nistrab = '12345678901';
$std->matricula = '002zcbv';
$std->respreg[0] = new \stdClass();
$std->respreg[0]->dtini = '2015-02-04';
$std->respreg[0]->dtfim = null;
$std->respreg[0]->nisresp = '12345678901';
$std->respreg[0]->nroc = '12345678901234';
$std->respreg[0]->ufoc = 'SP';
$std->modo = 'INI'; //['INI', 'ALT', 'FIM']
$std->dtcondicao = '2016-02-01';

$std->infoamb[] = new \stdClass();
$std->infoamb[0]->codamb = 'abcdefg';

//opcional depende do modo
$std->infoamb[0]->dscativdes = 'Descricao das atividades, fisicas ou mentais, realizadas pelo trabalhador, por forca do poder de comando a que se submete.';
$std->infoamb[0]->fatrisco[0] = new \stdClass();
$std->infoamb[0]->fatrisco[0]->codfatris = '01.01.012';
$std->infoamb[0]->fatrisco[0]->intconc = '20 mSv';
$std->infoamb[0]->fatrisco[0]->tecmedicao = 'dosimetro Geiger- Muller de halogenio';

$std->infoamb[0]->fatrisco[0]->epcepi = new \stdClass();
$std->infoamb[0]->fatrisco[0]->epcepi->utilizepc = 1; // 0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado.
$std->infoamb[0]->fatrisco[0]->epcepi->utilizepi = 1; //0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado
//opcional
$std->infoamb[0]->fatrisco[0]->epcepi->epc[0] = new \stdClass();
$std->infoamb[0]->fatrisco[0]->epcepi->epc[0]->dscepc = 'barreira de contencao';
$std->infoamb[0]->fatrisco[0]->epcepi->epc[0]->eficepc = 'S'; //S - Sim; N - Não.
//opcional
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0] = new \stdClass();
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->caepi = 'macacao';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->eficepi = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->medprotecao = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->condfuncto = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->przvalid = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->periodictroca = 'S';
$std->infoamb[0]->fatrisco[0]->epcepi->epi[0]->higienizacao = 'S';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtExpRisco(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2190($json, $std, $certificate)->toXML();
    //$json = Event::evtAdmPrelim($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
