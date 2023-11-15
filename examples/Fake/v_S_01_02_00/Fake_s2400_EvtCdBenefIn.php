<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.2.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.2.0',
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
//$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = "1.7.1234567890123456789";
$std->cpfbenef = '11111111111';
$std->nmbenefic = 'NOME';
$std->dtnascto = '1987-01-01';
$std->dtinicio = '1987-01-01';
$std->sexo = "M";
$std->racacor = '1';
$std->estciv = '1';
$std->incfismen = 'S';
$std->dtincfismen = '1999-12-12';

$std->endereco = new \stdClass();
$std->endereco->brasil = new \stdClass();
$std->endereco->brasil->tplograd = 'AV';
$std->endereco->brasil->dsclograd = 'Avenida da Paz';
$std->endereco->brasil->nrlograd = '1000';
$std->endereco->brasil->complemento = 'sobre loja';
$std->endereco->brasil->bairro = 'Centro';
$std->endereco->brasil->cep = '04178000';
$std->endereco->brasil->codmunic = '3550308';
$std->endereco->brasil->uf = 'SP';

$std->endereco->exterior = new \stdClass();
$std->endereco->exterior->paisresid = '805';
$std->endereco->exterior->dsclograd = 'Bodega Street';
$std->endereco->exterior->nrlograd = '1000';
$std->endereco->exterior->complemento = null;
$std->endereco->exterior->bairro = 'New City';
$std->endereco->exterior->nmcid = 'Fakaofo';
$std->endereco->exterior->codpostal = 'Z001';

$std->dependente[0] = new \stdClass();
$std->dependente[0]->tpdep = '03';
$std->dependente[0]->nmdep = 'Luluzinha';
$std->dependente[0]->dtnascto = '2010-04-12';
$std->dependente[0]->cpfdep = '12345678901';
$std->dependente[0]->sexodep = 'F';
$std->dependente[0]->depirrf = 'S';
$std->dependente[0]->incfismen = 'N';


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    /*********************************************************
     * Este evento MUDOU de nome na versão S 1.0
     *********************************************************/

    //cria o evento e retorna o XML assinado
    /*
    $xml = Event::evtCdBenefIn(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00' //opcional data e hora
    )->toXml();*/

    $xml = Event::s2400(
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
