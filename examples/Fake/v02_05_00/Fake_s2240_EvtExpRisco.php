<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_5_0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.5.0',
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
$std->indretif = 1;
$std->nrrecibo = null;
$std->cpftrab = '12345678901';
$std->nistrab = '12345678901';
$std->matricula = '002zcbv';
$std->codcateg = '111';
$std->dtcondicao = '2016-02-01';

$std->infoamb[0] = new \stdClass();
$std->infoamb[0]->codamb = 'abcdefg';

$std->infoamb[1] = new \stdClass();
$std->infoamb[1]->codamb = 'xxxxx';

$std->infoativ = new \stdClass();
$std->infoativ->dscativdes = 'lkskslkslsklsks  lsk slsklsk';
$std->infoativ->ativpericinsal[0] = new \stdClass();
$std->infoativ->ativpericinsal[0]->codativ = '22.111';

$std->fatrisco[0] = new \stdClass();
$std->fatrisco[0]->codfatris = '01.01.012';
$std->fatrisco[0]->dscfatrisc = 'Cair um meteoro na cabeça';
$std->fatrisco[0]->tpaval = 1;
$std->fatrisco[0]->intconc = 20;
$std->fatrisco[0]->limtol = 22.34;
$std->fatrisco[0]->unmed = 47;
$std->fatrisco[0]->tecmedicao = 'dosimetro Geiger- Muller de halogenio';
$std->fatrisco[0]->insalubridade = 'N';
$std->fatrisco[0]->periculosidade = 'N';
$std->fatrisco[0]->aposentesp = 'N';

$std->fatrisco[0]->epcepi = new \stdClass();
$std->fatrisco[0]->epcepi->utilizepc = 1; // 0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado.
$std->fatrisco[0]->epcepi->eficepc = 'S';
$std->fatrisco[0]->epcepi->utilizepi = 1; //0 - Não se aplica; 1 - Não utilizado; 2 - Utilizado

$std->fatrisco[0]->epcepi->epi[0] = new \stdClass();
$std->fatrisco[0]->epcepi->epi[0]->caepi = '111xxx';
$std->fatrisco[0]->epcepi->epi[0]->dscepi = 'macacao';
$std->fatrisco[0]->epcepi->epi[0]->eficepi = 'S';
$std->fatrisco[0]->epcepi->epi[0]->medprotecao = 'S';
$std->fatrisco[0]->epcepi->epi[0]->condfuncto = 'S';
$std->fatrisco[0]->epcepi->epi[0]->usoinint = 'S';
$std->fatrisco[0]->epcepi->epi[0]->przvalid = 'S';
$std->fatrisco[0]->epcepi->epi[0]->periodictroca = 'S';
$std->fatrisco[0]->epcepi->epi[0]->higienizacao = 'S';

$std->respreg[0] = new \stdClass();
$std->respreg[0]->cpfresp = '12345678901';
$std->respreg[0]->nisresp = '12345678901';
$std->respreg[0]->nmresp = 'Fulano de Tal';
$std->respreg[0]->ideoc = 4;
$std->respreg[0]->dscoc = 'bla bla bla';
$std->respreg[0]->nroc = '12345678901234';
$std->respreg[0]->ufoc = 'SP';

$std->obs = new \stdClass();
$std->obs->meterg = 'slksjlskjs lks lksj s';
$std->obs->obscompl = 'kslksj s sljsljs ks';


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
