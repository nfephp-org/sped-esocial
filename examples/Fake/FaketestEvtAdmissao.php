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
$brasil->nrlograd = '1250';
$brasil->bairro = 'Centro';
$brasil->cep = '08533000';
$brasil->codmunic = '3550308';
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
$contrato->codcateg = '101';
$contrato->vrsalfx = 5000;
$contrato->undsalfixo = 5;
$contrato->tpcontr = 1;

$vinculo->contrato  = $contrato;

$std->vinculo = $vinculo;


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
