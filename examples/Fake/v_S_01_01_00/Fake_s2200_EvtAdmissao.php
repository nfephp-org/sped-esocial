<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.1.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.1.0',
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
//$std->sequencial = 1; //Opcional
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789'; //Opcional
$std->cpftrab = '11111111111';
$std->nmtrab = 'JOSE DA SILVA';
$std->sexo = 'M';
$std->racacor = 5;
$std->estciv = 1; //Opcional
$std->grauinstr = '07';
$std->nmsoc = 'Chiquinho'; //Opcional
$std->dtnascto = '1980-01-01';
$std->paisnascto = '105'; // 105 = Brasil
$std->paisnac = '105';

$std->endereco = new \stdClass();
$std->endereco->brasil = new \stdClass(); //Opcional
$std->endereco->brasil->tplograd = 'R'; //Opcional
$std->endereco->brasil->dsclograd = 'Av. Paulista';
$std->endereco->brasil->nrlograd = '1850';
$std->endereco->brasil->complemento = 'Apto 2'; //Opcional
$std->endereco->brasil->bairro = 'Bela Vista';
$std->endereco->brasil->cep = '01311200';
$std->endereco->brasil->codmunic  = '3550308';
$std->endereco->brasil->uf = 'SP';

$std->endereco->exterior = new \stdClass(); //Opcional
$std->endereco->exterior->paisresid = '108';
$std->endereco->exterior->dsclograd = '5 Av';
$std->endereco->exterior->nrlograd = '2222';
$std->endereco->exterior->complemento = 'Apto 200'; //Opcional
$std->endereco->exterior->bairro = 'Manhattan'; //Opcional
$std->endereco->exterior->nmcid = 'New York';
$std->endereco->exterior->codpostal  = '111111'; //Opcional

$std->trabimig = new \stdClass(); //Opcional
$std->trabimig->tmpresid = 1; //Opcional
$std->trabimig->conding = 2;

$std->infodeficiencia = new \stdClass(); //Opcional
$std->infodeficiencia->deffisica = 'N';
$std->infodeficiencia->defvisual = 'N';
$std->infodeficiencia->defauditiva = 'N';
$std->infodeficiencia->defmental = 'N';
$std->infodeficiencia->defintelectual = 'N';
$std->infodeficiencia->reabreadap = 'N';
//$std->infodeficiencia->infocota = 'N'; //Opcional
$std->infodeficiencia->observacao = 'slsklskslkslkslkssklsklsjksjskjs'; //Opcional

$std->dependente[0] = new \stdClass(); //Opcional
$std->dependente[0]->tpdep = '01';
$std->dependente[0]->nmdep = 'WATSON';
$std->dependente[0]->dtnascto = '2015-01-01';
$std->dependente[0]->cpfdep = '12345678985'; //Opcional
$std->dependente[0]->sexodep = 'F'; //Opcional
$std->dependente[0]->depirrf = 'N';
$std->dependente[0]->depsf = 'N';
$std->dependente[0]->inctrab = 'N';

$std->contato = new \stdClass(); //Opcional
$std->contato->foneprinc = '1155555555'; //Opcional
$std->contato->emailprinc = 'beltrano@mail.com.br'; //Opcional

$std->vinculo = new \stdClass();
$std->vinculo->matricula = '1020304050';
$std->vinculo->tpregtrab = 1;
$std->vinculo->tpregprev = 1;
$std->vinculo->cadini = 'S';

$std->vinculo->infoceletista = new \stdClass(); //Opcional
$std->vinculo->infoceletista->dtadm = '2017-08-08';
$std->vinculo->infoceletista->tpadmissao = 1;
$std->vinculo->infoceletista->indadmissao = 1;
$std->vinculo->infoceletista->nrproctrab = '12345678901234567890'; //Opcional
$std->vinculo->infoceletista->tpregjor = 1;
$std->vinculo->infoceletista->natatividade = 1;
$std->vinculo->infoceletista->dtbase = 1; //Opcional
$std->vinculo->infoceletista->cnpjsindcategprof = '77721644000101';
$std->vinculo->infoceletista->dtopcfgts = '2017-01-01'; //Opcional

$std->vinculo->infoceletista->trabtemporario = new \stdClass(); //Opcional
$std->vinculo->infoceletista->trabtemporario->hipleg = 1;
$std->vinculo->infoceletista->trabtemporario->justcontr = 'jwkjwkjwkjwk';

$std->vinculo->infoceletista->trabtemporario->ideestabvinc = new \stdClass();
$std->vinculo->infoceletista->trabtemporario->ideestabvinc->tpinsc = 2; //1 pu 2
$std->vinculo->infoceletista->trabtemporario->ideestabvinc->nrinsc = '12345678901234';

$std->vinculo->infoceletista->trabtemporario->idetrabsubstituido[0] = new \stdClass(); //Opcional
$std->vinculo->infoceletista->trabtemporario->idetrabsubstituido[0]->cpftrabsubst = '12345678901';

$std->vinculo->infoceletista->aprend = new \stdClass(); //Opcional
$std->vinculo->infoceletista->aprend->tpinsc = 1; //1 pu 2
$std->vinculo->infoceletista->aprend->nrinsc = '12345678901';

$std->vinculo->infoestatutario = new \stdClass(); //Opcional
$std->vinculo->infoestatutario->tpprov = 99;
$std->vinculo->infoestatutario->dtexercicio = '2017-02-01';
$std->vinculo->infoestatutario->tpplanrp = 2; //Opcional
$std->vinculo->infoestatutario->indtetorgps = 'S'; //Opcional
$std->vinculo->infoestatutario->indabonoperm = 'S'; //Opcional
$std->vinculo->infoestatutario->dtiniabono = '2017-02-01'; //Opcional

$std->vinculo->infocontrato = new \stdClass();
$std->vinculo->infocontrato->nmcargo = 'Melhor cargo do país'; //Opcional
$std->vinculo->infocontrato->cbocargo = '123456'; //Opcional
$std->vinculo->infocontrato->dtingrcargo = '2017-02-01'; //Opcional
$std->vinculo->infocontrato->nmfuncao = 'Melhor função de todas'; //Opcional
$std->vinculo->infocontrato->cbofuncao = '654321'; //Opcional
$std->vinculo->infocontrato->acumcargo = 'S'; //Opcional
$std->vinculo->infocontrato->codcateg = 101;

$std->vinculo->infocontrato->remuneracao = new \stdClass(); //Opcional
$std->vinculo->infocontrato->remuneracao->vrsalfx = 2547.56;
$std->vinculo->infocontrato->remuneracao->undsalfixo = 7;
$std->vinculo->infocontrato->remuneracao->dscsalvar = 'ksksksksk';

$std->vinculo->infocontrato->duracao = new \stdClass(); //Opcional
$std->vinculo->infocontrato->duracao->tpcontr = 1;
$std->vinculo->infocontrato->duracao->dtterm = '2018-01-01';
$std->vinculo->infocontrato->duracao->clauassec = 'N';
$std->vinculo->infocontrato->duracao->objdet = 'ksksks';

$std->vinculo->infocontrato->localtrabgeral = new \stdClass(); //Opcional
$std->vinculo->infocontrato->localtrabgeral->tpinsc = "1"; //1, 3 ou 4
$std->vinculo->infocontrato->localtrabgeral->nrinsc = '12345678901234';
$std->vinculo->infocontrato->localtrabgeral->desccomp = 'lkdldkldkldk'; //Opcional

$std->vinculo->infocontrato->localtempdom = new \stdClass(); //Opcional
$std->vinculo->infocontrato->localtempdom->tplograd = 'AV'; //Opcional
$std->vinculo->infocontrato->localtempdom->dsclograd = 'sm,sm,sms,ms,ms';
$std->vinculo->infocontrato->localtempdom->nrlograd = '27272';
$std->vinculo->infocontrato->localtempdom->complemento = 'sjsksjhsh'; //Opcional
$std->vinculo->infocontrato->localtempdom->bairro = 'sjhsj';
$std->vinculo->infocontrato->localtempdom->cep = '99999999';
$std->vinculo->infocontrato->localtempdom->codmunic = '1234567';
$std->vinculo->infocontrato->localtempdom->uf = 'AC';

$std->vinculo->infocontrato->horcontratual = new \stdClass();
$std->vinculo->infocontrato->horcontratual->qtdhrssem = 99.50; //Opcional
$std->vinculo->infocontrato->horcontratual->tpjornada = 9;
$std->vinculo->infocontrato->horcontratual->tmpparc = 0;
$std->vinculo->infocontrato->horcontratual->hornoturno = 'N'; //Opcional
$std->vinculo->infocontrato->horcontratual->dscjorn = 'De 2a a 6a feira, das 8:00 às 12:00 e das 13:00 às 17:00 e no sábado das 8:00 às 12:00';

$std->vinculo->infocontrato->alvarajudicial = new \stdClass(); //Opcional
$std->vinculo->infocontrato->alvarajudicial->nrprocjud = '12345678901234567890';

$std->vinculo->infocontrato->observacoes[0] = new \stdClass(); //Opcional
$std->vinculo->infocontrato->observacoes[0]->observacao = 'kjskjsksksj';

$std->vinculo->infocontrato->treicap[0] = new \stdClass(); //Opcional
$std->vinculo->infocontrato->treicap[0]->codtreicap = 1001;

$std->vinculo->sucessaovinc = new \stdClass(); //Opcional
$std->vinculo->sucessaovinc->tpinsc = "6";
$std->vinculo->sucessaovinc->nrinsc = '12345678901234';
$std->vinculo->sucessaovinc->matricant = 'sksksksk'; //Opcional
$std->vinculo->sucessaovinc->dttransf = '2017-01-01';
$std->vinculo->sucessaovinc->observacao = 'kjsksjksjksj'; //Opcional

$std->vinculo->transfdom = new \stdClass(); //Opcional
$std->vinculo->transfdom->cpfsubstituido = '12345678901';
$std->vinculo->transfdom->matricant = 'slslslsls'; //Opcional
$std->vinculo->transfdom->dttransf = '2017-01-01';

$std->vinculo->mudancacpf = new \stdClass(); //Opcional
$std->vinculo->mudancacpf->cpfant = '12345678901';
$std->vinculo->mudancacpf->matricant = 'slslslsls';
$std->vinculo->mudancacpf->dtaltcpf = '2017-01-01';
$std->vinculo->mudancacpf->observacao = 'kjsksjksjksj'; //Opcional

$std->vinculo->afastamento = new \stdClass(); //Opcional
$std->vinculo->afastamento->dtiniafast = '2017-05-01';
$std->vinculo->afastamento->codmotafast = '01';

$std->vinculo->desligamento = new \stdClass(); //Opcional
$std->vinculo->desligamento->dtdeslig = '2017-08-08';

$std->vinculo->cessao = new \stdClass(); //Opcional
$std->vinculo->cessao->dtinicessao = '2017-08-08';

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
