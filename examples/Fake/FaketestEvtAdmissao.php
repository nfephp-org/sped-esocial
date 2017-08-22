<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_3_00',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.3.0',
    //versão do layout do evento
    'serviceVersion' => '1.1.0',
    //versão do webservice
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

//carrega os dados do envento
$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;

$trabalhador = new \stdClass();
$trabalhador->cpftrab = '11111111111';
$trabalhador->nistrab = '11111111111';
$trabalhador->nmtrab = 'JOSE DA SILVA';
$trabalhador->sexo = 'M';
$trabalhador->racacor = 5;
$trabalhador->grauinstr = '07';
$trabalhador->indpriempr = 'N';
$trabalhador->dtnascto = '1980-01-01';
$trabalhador->paisnascto = '105'; // 105 = Brasil
$trabalhador->paisnac = '105';

$std->trabalhador = $trabalhador;

$endereco = new \stdClass();
$brasil = new \stdClass();
$brasil->tplograd = 'R';
$brasil->dsclograd = 'Av. Paulista';
$brasil->nrlograd = '1850';
$brasil->bairro = 'Bela Vista';
$brasil->cep = '01311200';
$brasil->codmunic = 3550308;
$brasil->uf = 'SP';

$endereco->brasil = $brasil;
$std->endereco = $endereco;

$vinculo = new \stdClass();
$vinculo->matricula = '1020304050';
$vinculo->tpregtrab = 1;
$vinculo->tpregprev = 1;
$vinculo->cadini = 'N';

$celetista = new \stdClass();
$celetista->dtadm = '2017-08-08';
$celetista->tpadmissao = 1;
$celetista->indadmissao = 1;
$celetista->tpregjor = 1;
$celetista->natatividade = 1;
$celetista->cnpjsindcategprof = '77721644000101';
$celetista->opcfgts = 1;

$vinculo->celetista = $celetista;

$contrato = new \stdClass();
$contrato->codcateg = 101;
$contrato->vrsalfx = 5000;
$contrato->undsalfixo = 5;
$contrato->tpcontr = 1;

$vinculo->contrato = $contrato;

$std->vinculo = $vinculo;

$ctps = new \stdClass();
$ctps->nrctps = '12012315';
$ctps->seriectps = '500';
$ctps->ufctps = 'SP';

$std->ctps = $ctps;

$ric = new \stdClass();
$ric->nrric = '15150505';
$ric->orgaoemissor = 'SSP';
$ric->dtexped = '2015-01-01';

$std->ric = $ric;

$rg = new \stdClass();
$rg->nrrg = '11111111';
$rg->orgaoemissor = 'SSP';
$rg->dtexped = '2015-01-01';

$std->rg = $rg;

$oc = new \stdClass();
$oc->nroc = '12315861';
$oc->orgaoemissor = 'SSP';
$oc->dtexped = '2015-01-01';

$std->oc = $oc;

$cnh = new \stdClass();
$cnh->nrregcnh = '1231531';
$cnh->dtexped = '2015-01-01';
$cnh->ufcnh = 'SP';
$cnh->dtvalid = '2019-01-01';
$cnh->dtprihab = '2015-01-01';
$cnh->categoriacnh = 'AB';

$std->cnh = $cnh;

$dependente[0] = new \stdClass();
$dependente[0]->tpdep = '01';
$dependente[0]->nmdep = 'WATSON';
$dependente[0]->dtnascto = '2015-01-01';
$dependente[0]->cpfdep = '12345678985';
$dependente[0]->depirrf = 'N';
$dependente[0]->depsf = 'N';
$dependente[0]->inctrab = 'N';

$std->dependente = $dependente;

$contato = new \stdClass();
$contato->foneprinc = '1144443333';
$contato->fonealternat = '1122228888';
$contato->emailprinc = 'email@email.com.br';
$contato->emailalternat = 'emailalt@email.com.br';

$std->contato = $contato;
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
