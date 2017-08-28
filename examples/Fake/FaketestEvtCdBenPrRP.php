<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config     = [
    'tpAmb'          => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc'        => '2_3_00',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion'  => '2.3.0',
    //versão do layout do evento
    'serviceVersion' => '1.1.1',
    //versão do webservice
    'empregador'     => [
        'tpInsc'  => 1,  //1-CNPJ, 2-CPF
        'nrInsc'  => '99999999999999', //numero do documento
        'nmRazao' => 'Razao Social',
    ],
    'transmissor'    => [
        'tpInsc' => 1,  //1-CNPJ, 2-CPF
        'nrInsc' => '99999999999999' //numero do documento
    ],
];
$configJson = json_encode($config, JSON_PRETTY_PRINT);

$std             = new \stdClass();
$std->sequencial = 1;
$std->indretif   = 1;

$std->idebenef            = new \stdClass();
$std->idebenef->cpfbenef  = '11111111111';
$std->idebenef->nmbenefic = 'NOME';

$std->idebenef->dadosbenef            = new \stdClass();
$std->idebenef->dadosbenef->cpfbenef  = '11111111111';
$std->idebenef->dadosbenef->nmbenefic = 'NOME';

$std->idebenef->dadosbenef->dadosnasc             = new \stdClass();
$std->idebenef->dadosbenef->dadosnasc->dtnascto   = '1987-01-01';
$std->idebenef->dadosbenef->dadosnasc->codmunic   = 3550308;
$std->idebenef->dadosbenef->dadosnasc->uf         = 'SP';
$std->idebenef->dadosbenef->dadosnasc->paisnascto = '105';
$std->idebenef->dadosbenef->dadosnasc->paisnac    = '105';

$std->idebenef->dadosbenef->endereco                    = new \stdClass();
$std->idebenef->dadosbenef->endereco->brasil            = new \stdClass();
$std->idebenef->dadosbenef->endereco->brasil->tplograd  = 'R';
$std->idebenef->dadosbenef->endereco->brasil->dsclograd = 'DESCRICAO';
$std->idebenef->dadosbenef->endereco->brasil->nrlograd  = '123';
$std->idebenef->dadosbenef->endereco->brasil->cep       = '12345678';
$std->idebenef->dadosbenef->endereco->brasil->codmunic  = 3550308;
$std->idebenef->dadosbenef->endereco->brasil->uf        = 'SP';

$std->infobeneficio           = new \stdClass();
$std->infobeneficio->tpplanrp = 1;

$std->infobeneficio->inibeneficio             = new \stdClass();
$std->infobeneficio->inibeneficio->tpbenef    = 1;
$std->infobeneficio->inibeneficio->nrbenefic  = '123165050';
$std->infobeneficio->inibeneficio->dtinibenef = '2017-08-28';
$std->infobeneficio->inibeneficio->vrbenef    = 1500;

$std->infobeneficio->inibeneficio->infopenmorte          = new \stdClass();
$std->infobeneficio->inibeneficio->infopenmorte->idquota = '123131561';
$std->infobeneficio->inibeneficio->infopenmorte->cpfinst = '11122233344';

$std->infobeneficio->altbeneficio             = new \stdClass();
$std->infobeneficio->altbeneficio->tpbenef    = 1;
$std->infobeneficio->altbeneficio->nrbenefic  = '123165050';
$std->infobeneficio->altbeneficio->dtinibenef = '2017-08-28';
$std->infobeneficio->altbeneficio->vrbenef    = 1500;

$std->infobeneficio->altbeneficio->infopenmorte          = new \stdClass();
$std->infobeneficio->altbeneficio->infopenmorte->idquota = '123131561';
$std->infobeneficio->altbeneficio->infopenmorte->cpfinst = '11122233344';

$std->infobeneficio->fimbeneficio             = new \stdClass();
$std->infobeneficio->fimbeneficio->tpbenef    = 1;
$std->infobeneficio->fimbeneficio->nrbenefic  = '123165050';
$std->infobeneficio->fimbeneficio->dtfimbenef = '2017-08-28';
$std->infobeneficio->fimbeneficio->mtvfim     = 3;


try {
    //carrega a classe responsavel por lidar com os certificados
    $content     = file_get_contents('expired_certificate.pfx');
    $password    = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtCdBenPrRP(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00' //opcional data e hora
    )->toXml();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
