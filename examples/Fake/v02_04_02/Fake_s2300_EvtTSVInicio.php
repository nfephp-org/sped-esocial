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
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab = '12345678901';
$std->nistrab = '1234';
$std->nmtrab = 'Fulano de Tal';
$std->sexo = 'M';
$std->racacor = 2;
$std->estciv = 3;
$std->grauinstr = '03';
$std->nmsoc = 'Fulano de Tal';
$std->dtnascto = '1996-06-11';
$std->codmunic = '1234567';
$std->uf = 'AC';
$std->paisnascto = '105';
$std->paisnac = '105';
$std->nmmae = 'Maria de Tal';
$std->nmpai = "Joao de Tal";
//documentos
$std->ctps = new \stdClass();
$std->ctps->nrctps = '11215454';
$std->ctps->seriectps = '011';
$std->ctps->ufctps = 'AC';

$std->ric = new \stdClass();
$std->ric->nrric = '28282828';
$std->ric->orgaoemissor = 'sslkjslkjslksj';
$std->ric->dtexped = '2011-07-07';

$std->rg = new \stdClass();
$std->rg->nrrg = '1234567';
$std->rg->orgaoemissor = 'sslkslkslks';
$std->rg->dtexped = '2011-06-06';

$std->rne = new \stdClass();
$std->rne->nrrne = '8829822982982';
$std->rne->orgaoemissor = 'slkslsklsklsk';
$std->rne->dtexped = '2011-08-08';

$std->oc = new \stdClass();
$std->oc->nroc = '1929282882828';
$std->oc->orgaoemissor = 'lslslsls';
$std->oc->dtexped = '2011-10-10';
$std->oc->dtvalid = '2022-10-10';

$std->cnh = new \stdClass();
$std->cnh->nrregcnh = '123456789012';
$std->cnh->dtexped = '2017-05-05';
$std->cnh->ufcnh = 'AC';
$std->cnh->dtvalid = '2022-05-05';
$std->cnh->dtprihab = '2011-01-01';
$std->cnh->categoriacnh = 'AB';

//endereço
$std->brasil = new \stdClass();
$std->brasil->tplograd = 'av';
$std->brasil->dsclograd = 'slkslkslkslsk';
$std->brasil->nrlograd = 'sksks';
$std->brasil->complemento = 'owpososomsmm';
$std->brasil->bairro = 'sksksksk';
$std->brasil->cep = '12345678';
$std->brasil->codmunic = '1234567';
$std->brasil->uf = 'AC';

$std->exterior = new \stdClass();
$std->exterior->paisresid = '158';
$std->exterior->dsclograd = 'kkssjksjsk';
$std->exterior->nrlograd = '1112sss';
$std->exterior->complemento = 'lslslsls';
$std->exterior->bairro = 'lslslsl';
$std->exterior->nmcid = 'slkskslks';
$std->exterior->codpostal = '1234';

$std->trabestrangeiro = new \stdClass();
$std->trabestrangeiro->dtchegada = '2015-11-11';
$std->trabestrangeiro->classtrabestrang = 12;
$std->trabestrangeiro->casadobr = 'N';
$std->trabestrangeiro->filhosbr = 'N';

$std->infodeficiencia = new \stdClass();
$std->infodeficiencia->deffisica = 'N';
$std->infodeficiencia->defvisual = 'N';
$std->infodeficiencia->defauditiva = 'N';
$std->infodeficiencia->defmental = 'N';
$std->infodeficiencia->defintelectual = 'N';
$std->infodeficiencia->reabreadap = 'N';
$std->infodeficiencia->observacao = 'lkslkslkslkslkslks';

$std->dependente[1] = new \stdClass();
$std->dependente[1]->tpdep = '01';
$std->dependente[1]->nmdep = 'Fulaninho de Tal';
$std->dependente[1]->dtnascto = '2016-11-25';
$std->dependente[1]->cpfdep = '12345678901';
$std->dependente[1]->depirrf = 'N';
$std->dependente[1]->depsf = 'N';
$std->dependente[1]->inctrab = 'N';

$std->contato = new \stdClass();
$std->contato->foneprinc = '1234567890';
$std->contato->fonealternat = '0912345678';
$std->contato->emailprinc = 'ele@mail.com';
$std->contato->emailalternat = 'ela@email.com.br';

$std->infotsvinicio = new \stdClass();
$std->infotsvinicio->cadini = 'S';
$std->infotsvinicio->codcateg = '101';
$std->infotsvinicio->dtinicio = '2017-05-12';
$std->infotsvinicio->natatividade = 2;

$std->cargofuncao = new \stdClass();
$std->cargofuncao->codcargo = 'oaoaoa';
$std->cargofuncao->codfuncao = 'ksksksksk sk';

$std->remuneracao = new \stdClass();
$std->remuneracao->vrsalfx = 1200.00;
$std->remuneracao->undsalfixo = 7;
$std->remuneracao->dscsalvar = 'lkklslskksl s lks lsklsks ';

$std->fgts = new \stdClass();
$std->fgts->opcfgts = 1;
$std->fgts->dtopcfgts = '2017-05-12';

$std->infodirigentesindical = new \stdClass();
$std->infodirigentesindical->categorig = '001';
$std->infodirigentesindical->cnpjorigem = '12345678901234';
$std->infodirigentesindical->dtadmorig = '2017-05-12';
$std->infodirigentesindical->matricorig = 'ytuytuystyst';

$std->infotrabcedido = new \stdClass();
$std->infotrabcedido->categorig = '001';
$std->infotrabcedido->cnpjcednt = '12345678901234';
$std->infotrabcedido->matricced = 'lksçkçslksl';
$std->infotrabcedido->dtadmced = '2017-05-12';
$std->infotrabcedido->tpregtrab = 2;
$std->infotrabcedido->tpregprev = 3;
$std->infotrabcedido->infonus = 3;

$std->infoestagiario = new \stdClass();
$std->infoestagiario->natestagio = 'N';
$std->infoestagiario->nivestagio = 8;
$std->infoestagiario->areaatuacao = 'ksksksksk';
$std->infoestagiario->nrapol = 'kak228282828';
$std->infoestagiario->vlrbolsa = 1200.00;
$std->infoestagiario->dtprevterm = '2017-12-31';

$std->infoestagiario->instensino = new \stdClass();
$std->infoestagiario->instensino->cnpjinstensino = '12345678901234';
$std->infoestagiario->instensino->nmrazao = 'dlkdldkldkd';
$std->infoestagiario->instensino->dsclograd = 'lslsppopapap';
$std->infoestagiario->instensino->nrlograd = '12244';
$std->infoestagiario->instensino->bairro = 'kakakaka';
$std->infoestagiario->instensino->cep = '12345678';
$std->infoestagiario->instensino->codmunic = '1234567';
$std->infoestagiario->instensino->uf = 'AC';

$std->infoestagiario->ageintegracao = new \stdClass();
$std->infoestagiario->ageintegracao->cnpjagntinteg = '12345678901234';
$std->infoestagiario->ageintegracao->nmrazao = 'mamaamamamam';
$std->infoestagiario->ageintegracao->dsclograd = 'oaoaoaoao';
$std->infoestagiario->ageintegracao->nrlograd = 'msmsmsmsms';
$std->infoestagiario->ageintegracao->bairro = 'lslslslsl';
$std->infoestagiario->ageintegracao->cep = '12345678';
$std->infoestagiario->ageintegracao->codmunic = '1234567';
$std->infoestagiario->ageintegracao->uf = 'AC';

$std->infoestagiario->supervisorestagio = new \stdClass();
$std->infoestagiario->supervisorestagio->cpfsupervisor = '12345678901';
$std->infoestagiario->supervisorestagio->nmsuperv = 'lksklskslkslkslk slkslkslkskslk';

$std->afastamento = new \stdClass();
$std->afastamento->dtiniafast = '2017-06-01';
$std->afastamento->codmotafast = '01';

$std->termino = new \stdClass();
$std->termino->dtterm = '2017-12-31';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtTSVInicio(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2300($json, $std, $certificate)->toXML();
    //$json = Event::evtTSVInicio($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
