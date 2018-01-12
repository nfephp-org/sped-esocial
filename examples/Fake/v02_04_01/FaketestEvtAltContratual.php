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
        'nrInsc'  => '99999999', //numero do documento
        'nmRazao' => 'Razao Social',
    ],
    'transmissor'    => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999' //numero do documento
    ],
];
$configJson = json_encode($config, JSON_PRETTY_PRINT);

//carrega os dados do envento
$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab = '12345678901';
$std->nistrab = '12345678901';
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
$std->infoceletista->trabtemp = new \stdClass();
$std->infoceletista->trabtemp->justprorr = 'kss kj s ljslkjsk slkjsl slksjlksjslkjs ';
$std->infoceletista->aprend = new \stdClass();
$std->infoceletista->aprend->tpinsc = 1;
$std->infoceletista->aprend->nrinsc = '123456789011234';

$std->infoestatutario = new \stdClass();
$std->infoestatutario->tpplanrp = 1;

$std->infocontrato = new \stdClass();
$std->infocontrato->codcargo = 'xxxx';
$std->infocontrato->codfuncao = 'ffff';
$std->infocontrato->codcateg = 101;
$std->infocontrato->codcarreira = 'carreirax';
$std->infocontrato->dtingrcarr = '2000-10-10';
$std->infocontrato->vrsalfx = 2589.55;
$std->infocontrato->undsalfixo = 4;
$std->infocontrato->dscsalvar = 'kjkjskjskjksjksjksjksjs';
$std->infocontrato->tpcontr = 2;
$std->infocontrato->dtterm = '2018-02-22';

$std->localtrabgeral = new \stdClass();
$std->localtrabgeral->tpinsc = 3; //1,3,ou 4
$std->localtrabgeral->nrinsc = '123456789012345';
$std->localtrabgeral->desccomp = 'çaçlks sçaçlsskjsjksh ksjh sjh';

$std->localtrabdom = new \stdClass();
$std->localtrabdom->tplograd = 'A';
$std->localtrabdom->dsclograd = 'sei la 2';
$std->localtrabdom->nrlograd = '25n';
$std->localtrabdom->complemento = 'por cima';
$std->localtrabdom->bairro = 'si de baixo';
$std->localtrabdom->cep = '04598777';
$std->localtrabdom->codmunic = 3512458;
$std->localtrabdom->uf = 'AL';

$std->horcontratual = new \stdClass();
$std->horcontratual->qtdhrssem = 46.25;
$std->horcontratual->tpjornada = 1;
$std->horcontratual->dsctpjorn = 'kslksçksçlksçlsk';
$std->horcontratual->tmpparc = 0;

$std->horcontratual->horario[1] = new \stdClass();
$std->horcontratual->horario[1]->dia = 1;
$std->horcontratual->horario[1]->codhorcontrat = 'sss';

$std->filiacaosindical[1] = new \stdClass();
$std->filiacaosindical[1]->cnpjsindtrab = '12345678901234';
$std->filiacaosindical[2] = new \stdClass();
$std->filiacaosindical[2]->cnpjsindtrab = '01234567890123';

$std->alvarajudicial = new \stdClass();
$std->alvarajudicial->nrprocjud = '1234dlkdlkdl';

$std->observacoes[1] = new \stdClass();
$std->observacoes[1]->observacao = 'lkslslkslksls ls lks lskls slks lsk lskls s';
$std->observacoes[2] = new \stdClass();
$std->observacoes[2]->observacao = 'uoeiueouoiueoiueieu eue eue euoeueiueoieu eu';


$std->servpubl = new \stdClass();
$std->servpubl->mtvalter = 8;

try {
    //carrega a classe responsavel por lidar com os certificados
    $content     = file_get_contents('expired_certificate.pfx');
    $password    = 'associacao';
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
