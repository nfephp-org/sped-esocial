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
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab = '11111111111';
$std->nistrab = '11111111111';
$std->nmtrab = 'JOSE DA SILVA';
$std->sexo = 'M';
$std->racacor = 5;
$std->estciv = 1;
$std->grauinstr = '07';
$std->indpriempr = 'N';
$std->nmsoc = 'Chiquinho';
$std->dtnascto = '1980-01-01';
$std->codmunic = '1234567';
$std->uf = 'AC';
$std->paisnascto = '105'; // 105 = Brasil
$std->paisnac = '105';
$std->nmmae = 'Fulana de Tal';
$std->nmpai = 'Ciclano de Tal';

$std->ctps = new \stdClass();
$std->ctps->nrctps = '12012315';
$std->ctps->seriectps = '500';
$std->ctps->ufctps = 'SP';

$std->ric = new \stdClass();
$std->ric->nrric = '15150505';
$std->ric->orgaoemissor = 'SSP';
$std->ric->dtexped = '2015-01-01';

$std->rg = new \stdClass();
$std->rg->nrrg = '11111111';
$std->rg->orgaoemissor = 'SSP';
$std->rg->dtexped = '2015-01-01';

$std->oc = new \stdClass();
$std->oc->nroc = '12315861';
$std->oc->orgaoemissor = 'SSP';
$std->oc->dtexped = '2015-01-01';

$std->cnh = new \stdClass();
$std->cnh->nrregcnh = '1231531';
$std->cnh->dtexped = '2015-01-01';
$std->cnh->ufcnh = 'SP';
$std->cnh->dtvalid = '2019-01-01';
$std->cnh->dtprihab = '2015-01-01';
$std->cnh->categoriacnh = 'AB';

$std->endereco = new \stdClass();
$std->endereco->brasil = new \stdClass();
$std->endereco->brasil->tplograd = 'R';
$std->endereco->brasil->dsclograd = 'Av. Paulista';
$std->endereco->brasil->nrlograd = '1850';
$std->endereco->brasil->bairro = 'Bela Vista';
$std->endereco->brasil->cep = '01311200';
$std->endereco->brasil->codmunic = 3550308;
$std->endereco->brasil->uf = 'SP';

$std->endereco->exterior = new \stdClass();
$std->endereco->exterior->paisresid = '108';
$std->endereco->exterior->dsclograd = '5 Av';
$std->endereco->exterior->nrlograd = '2222';
$std->endereco->exterior->complemento = 'Apto 200';
$std->endereco->exterior->bairro = 'Manhattan';
$std->endereco->exterior->nmcid = 'New York';
$std->endereco->exterior->codpostal = '111111';

$std->trabestrangeiro = new \stdClass();
$std->trabestrangeiro->dtchegada = '2001-10-10';
$std->trabestrangeiro->classtrabestrang = 10;
$std->trabestrangeiro->casadobr = 'S';
$std->trabestrangeiro->filhosbr = 'S';

$std->infodeficiencia = new \stdClass();
$std->infodeficiencia->deffisica = 'N';
$std->infodeficiencia->defvisual = 'N';
$std->infodeficiencia->defauditiva = 'N';
$std->infodeficiencia->defmental = 'N';
$std->infodeficiencia->defintelectual = 'N';
$std->infodeficiencia->reabreadap = 'N';
$std->infodeficiencia->infocota = 'N';
$std->infodeficiencia->observacao = 'slsklskslkslkslkssklsklsjksjskjs';

$std->dependente[0] = new \stdClass();
$std->dependente[0]->tpdep = '01';
$std->dependente[0]->nmdep = 'WATSON';
$std->dependente[0]->dtnascto = '2015-01-01';
$std->dependente[0]->cpfdep = '12345678985';
$std->dependente[0]->depirrf = 'N';
$std->dependente[0]->depsf = 'N';
$std->dependente[0]->inctrab = 'N';

$std->aposentadoria = new \stdClass();
$std->aposentadoria->trabaposent = 'N';

$std->contato = new \stdClass();
$std->contato->foneprinc = '1155555555';
$std->contato->fonealternat = '11999999999';
$std->contato->emailprinc = 'beltrano@mail.com.br';
$std->contato->emailalternat = 'ciclano@mail.com.br';

$std->vinculo = new \stdClass();
$std->vinculo->matricula = '1020304050';
$std->vinculo->tpregtrab = 1;
$std->vinculo->tpregprev = 1;
$std->vinculo->nrrecinfprelim = '12345678901234556';
$std->vinculo->cadini = 'N';

/*
  $std->vinculo->infoceletista = new \stdClass();
  $std->vinculo->infoceletista->dtadm = '2017-08-08';
  $std->vinculo->infoceletista->tpadmissao = 1;
  $std->vinculo->infoceletista->indadmissao = 1;
  $std->vinculo->infoceletista->tpregjor = 1;
  $std->vinculo->infoceletista->natatividade = 1;
  $std->vinculo->infoceletista->cnpjsindcategprof = '77721644000101';
  $std->vinculo->infoceletista->opcfgts = 1;
  $std->vinculo->infoceletista->dtopcfgts = '2017-01-01';

  $std->vinculo->infoceletista->trabtemporario = new \stdClass();
  $std->vinculo->infoceletista->trabtemporario->hipleg = 1;
  $std->vinculo->infoceletista->trabtemporario->justcontr = 'jwkjwkjwkjwk';
  $std->vinculo->infoceletista->trabtemporario->tpinclcontr = 3;

  $std->vinculo->infoceletista->trabtemporario->idetomadorserv = new \stdClass();
  $std->vinculo->infoceletista->trabtemporario->idetomadorserv->tpinsc = 2;
  $std->vinculo->infoceletista->trabtemporario->idetomadorserv->nrinsc = '12345678901234';

  $std->vinculo->infoceletista->trabtemporario->idetomadorserv->ideestabvinc = new \stdClass();
  $std->vinculo->infoceletista->trabtemporario->idetomadorserv->ideestabvinc->tpinsc = 2;
  $std->vinculo->infoceletista->trabtemporario->idetomadorserv->ideestabvinc->nrinsc = '12345678901234';

  $std->vinculo->infoceletista->trabtemporario->idetrabsubstituido[0] = new \stdClass();
  $std->vinculo->infoceletista->trabtemporario->idetrabsubstituido[0]->cpftrabsubst = '12345678901';

  $std->vinculo->infoceletista->aprend = new \stdClass();
  $std->vinculo->infoceletista->aprend->tpinsc = 1;
  $std->vinculo->infoceletista->aprend->nrinsc = '12345678901';
 */
$std->vinculo->infoestatutario = new \stdClass();
$std->vinculo->infoestatutario->indprovim = 1;
$std->vinculo->infoestatutario->tpprov = 99;
$std->vinculo->infoestatutario->dtnomeacao = '2017-01-01';
$std->vinculo->infoestatutario->dtposse = '2017-02-01';
$std->vinculo->infoestatutario->dtexercicio = '2017-02-01';
$std->vinculo->infoestatutario->tpplanrp = 2;

$std->vinculo->infoestatutario->infodecjud = new \stdClass();
$std->vinculo->infoestatutario->infodecjud->nrprocjud = 'kjsksjksj2222';

$std->vinculo->infocontrato = new \stdClass();
$std->vinculo->infocontrato->codcargo = 'wwww';
$std->vinculo->infocontrato->codfuncao = 'wwww';
$std->vinculo->infocontrato->codcateg = 101;
$std->vinculo->infocontrato->codcarreira = 'wwww';
$std->vinculo->infocontrato->dtingrcarr = '2017-01-01';
$std->vinculo->infocontrato->vrsalfx = 2547.56;
$std->vinculo->infocontrato->undsalfixo = 7;
$std->vinculo->infocontrato->dscsalvar = 'ksksksksk';
$std->vinculo->infocontrato->tpcontr = 1;
$std->vinculo->infocontrato->dtterm = '2018-01-01';
$std->vinculo->infocontrato->clauassec = 'N';

$std->vinculo->infocontrato->localtrabgeral = new \stdClass();
$std->vinculo->infocontrato->localtrabgeral->tpinsc = 2;
$std->vinculo->infocontrato->localtrabgeral->nrinsc = '12345678901234';
$std->vinculo->infocontrato->localtrabgeral->desccomp = 'lkdldkldkldk';

$std->vinculo->infocontrato->localtrabdom = new \stdClass();
$std->vinculo->infocontrato->localtrabdom->tplograd = 'AV';
$std->vinculo->infocontrato->localtrabdom->dsclograd = 'sm,sm,sms,ms,ms';
$std->vinculo->infocontrato->localtrabdom->nrlograd = '27272';
$std->vinculo->infocontrato->localtrabdom->complemento = 'sjsksjhsh';
$std->vinculo->infocontrato->localtrabdom->bairro = 'sjhsj';
$std->vinculo->infocontrato->localtrabdom->cep = '99999999';
$std->vinculo->infocontrato->localtrabdom->codmunic = '1234567';
$std->vinculo->infocontrato->localtrabdom->uf = 'AC';

$std->vinculo->infocontrato->horcontratual = new \stdClass();
$std->vinculo->infocontrato->horcontratual->qtdhrssem = 123.50;
$std->vinculo->infocontrato->horcontratual->tpjornada = 9;
$std->vinculo->infocontrato->horcontratual->dsctpjorn = 'kjsksjsjs';
$std->vinculo->infocontrato->horcontratual->tmpparc = 0;

$std->vinculo->infocontrato->horcontratual->horario[0] = new \stdClass();
$std->vinculo->infocontrato->horcontratual->horario[0]->dia = 1;
$std->vinculo->infocontrato->horcontratual->horario[0]->codhorcontrat = 'sssss';

$std->vinculo->infocontrato->filiacaosindical[0] = new \stdClass();
$std->vinculo->infocontrato->filiacaosindical[0]->cnpjsindtrab = '12345678901234';

$std->vinculo->infocontrato->alvarajudicial = new \stdClass();
$std->vinculo->infocontrato->alvarajudicial->nrprocjud = 'kjskjsksj';

$std->vinculo->infocontrato->observacoes[0] = new \stdClass();
$std->vinculo->infocontrato->observacoes[0]->observacao = 'kjskjsksksj';

$std->vinculo->sucessaovinc = new \stdClass();
$std->vinculo->sucessaovinc->cnpjempregant = '12345678901234';
$std->vinculo->sucessaovinc->matricant = 'sksksksk';
$std->vinculo->sucessaovinc->dttransf = '2017-01-01';
$std->vinculo->sucessaovinc->observacao = 'kjsksjksjksj';

$std->vinculo->transfdom = new \stdClass();
$std->vinculo->transfdom->cpfsubstituido = '12345678901';
$std->vinculo->transfdom->matricant = 'slslslsls';
$std->vinculo->transfdom->dttransf = '2017-01-01';

$std->vinculo->afastamento = new \stdClass();
$std->vinculo->afastamento->dtiniafast = '2017-05-01';
$std->vinculo->afastamento->codmotafast = '01';

$std->vinculo->desligamento = new \stdClass();
$std->vinculo->desligamento->dtdeslig = '2017-08-08';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtAdmissao(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
