<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

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

//carrega os dados do envento
$std = new \stdClass();
//$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789';
$std->cpftrab = '12345678901';
$std->matricula = '12345678901';
$std->dtalteracao = '2017-11-11';
$std->dtef = '2017-11-11';
$std->dscalt = 'lkslkslksçl çs çskçsk slkslsk';
$std->tpregprev = 1;

$std->infoceletista = new \stdClass();
$std->infoceletista->tpregjor = 1;
$std->infoceletista->natatividade = 2;
$std->infoceletista->dtbase = 11;
$std->infoceletista->cnpjsindcategprof = '12345678901234';
$std->infoceletista->trabtemporario = new \stdClass();
$std->infoceletista->trabtemporario->justprorr = 'kss kj s ljslkjsk slkjsl slksjlksjslkjs ';
$std->infoceletista->aprend = new \stdClass();
$std->infoceletista->aprend->tpinsc = 1;
$std->infoceletista->aprend->nrinsc = '12345678901234';

$std->infoestatutario = new \stdClass();
$std->infoestatutario->tpplanrp = 1;
$std->infoestatutario->indtetorgps = 'S';
$std->infoestatutario->indabonoperm = 'S';

$std->infocontrato = new \stdClass();
$std->infocontrato->nmcargo = 'Melhor cargo do país';
$std->infocontrato->cbocargo = '123456';
$std->infocontrato->nmfuncao = 'Melhor função de todas';
$std->infocontrato->cbofuncao = '654321';
$std->infocontrato->acumcargo = 'S';
$std->infocontrato->codcateg = 101;
$std->infocontrato->vrsalfx = 2547.56;
$std->infocontrato->undsalfixo = 7;
$std->infocontrato->dscsalvar = 'ksksksksk';
$std->infocontrato->tpcontr = 1;
$std->infocontrato->dtterm = '2018-01-01';
$std->infocontrato->objdet = 'ksksks';

$std->infocontrato->localtrabgeral = new \stdClass();
$std->infocontrato->localtrabgeral->tpinsc = 1;
$std->infocontrato->localtrabgeral->nrinsc = '12345678901234';
$std->infocontrato->localtrabgeral->desccomp = 'lkdldkldkldk';

$std->infocontrato->localtempdom = new \stdClass();
$std->infocontrato->localtempdom->tplograd = 'AV';
$std->infocontrato->localtempdom->dsclograd = 'sm,sm,sms,ms,ms';
$std->infocontrato->localtempdom->nrlograd = '27272';
$std->infocontrato->localtempdom->complemento = 'sjsksjhsh';
$std->infocontrato->localtempdom->bairro = 'sjhsj';
$std->infocontrato->localtempdom->cep = '99999999';
$std->infocontrato->localtempdom->codmunic = '1234567';
$std->infocontrato->localtempdom->uf = 'AC';

$std->infocontrato->horcontratual = new \stdClass();
$std->infocontrato->horcontratual->qtdhrssem = 99.50;
$std->infocontrato->horcontratual->tpjornada = 9;
$std->infocontrato->horcontratual->dsctpjorn = 'kjsksjsjs';
$std->infocontrato->horcontratual->tmpparc = 0;
$std->infocontrato->horcontratual->hornoturno = 'N';
$std->infocontrato->horcontratual->dscjorn = 'De 2a a 6a feira, das 8:00 às 12:00 e das 13:00 às 17:00 e no sábado das 8:00 às 12:00';

$std->infocontrato->alvarajudicial = new \stdClass();
$std->infocontrato->alvarajudicial->nrprocjud = '12345678901234567890';

$std->infocontrato->observacoes[0] = new \stdClass();
$std->infocontrato->observacoes[0]->observacao = 'kjskjsksksj';

$std->infocontrato->treicap[0] = new \stdClass();
$std->infocontrato->treicap[0]->codtreicap = 1001;

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtAltContratual(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2206($json, $std, $certificate)->toXML();
    //$json = Event::evtAltContratual($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
