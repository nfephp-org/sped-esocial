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

$std = new \stdClass();
//$std->sequencial = 1;
$std->indretif = 1; //obrigatório
$std->nrrecibo = '1.4.1234567890123456789'; //opcional
$std->cpfbenef = '12345678901'; //obrigatório
$std->dtalteracao = '2021-02-01'; //obrigatório

//campo obrigatório
$std->dadosbenef = new \stdClass();
$std->dadosbenef->nmbenefic = "Fulano de Tal"; //obrigatório
$std->dadosbenef->sexo = 'M';
$std->dadosbenef->racacor = '1';
$std->dadosbenef->estciv = '1';
$std->dadosbenef->incfismen = 'N';

//campo obrigatório
$std->dadosbenef->endereco = new \stdClass();
//campo opcional
$std->dadosbenef->endereco->brasil = new \stdClass();
$std->dadosbenef->endereco->brasil->tplograd = 'AV';
$std->dadosbenef->endereco->brasil->dsclograd = 'UM';
$std->dadosbenef->endereco->brasil->nrlograd = '123';
$std->dadosbenef->endereco->brasil->complemento = 'apto 21';
$std->dadosbenef->endereco->brasil->bairro = 'CENTRO';
$std->dadosbenef->endereco->brasil->cep = '12345678';
$std->dadosbenef->endereco->brasil->codmunic = '1234567';
$std->dadosbenef->endereco->brasil->uf = 'AC';

//campo opcional
/*
$std->dadosbenef->endereco->exterior = new \stdClass();
$std->dadosbenef->endereco->exterior->paisresid = '';
$std->dadosbenef->endereco->exterior->dsclograd = '';
$std->dadosbenef->endereco->exterior->nrlograd = '';
$std->dadosbenef->endereco->exterior->complemento = '';
$std->dadosbenef->endereco->exterior->bairro = '';
$std->dadosbenef->endereco->exterior->nmcid = '';
$std->dadosbenef->endereco->exterior->codpostal = '';
 */

$std->dadosbenef->dependente[0] = new \stdClass();
$std->dadosbenef->dependente[0]->tpdep = '09';
$std->dadosbenef->dependente[0]->nmdep = 'CICLANO DE TAL';
$std->dadosbenef->dependente[0]->dtnascto = '1955-11-27';
$std->dadosbenef->dependente[0]->cpfdep = '12345678901';
$std->dadosbenef->dependente[0]->sexodep = 'M';
$std->dadosbenef->dependente[0]->depirrf = 'S';
$std->dadosbenef->dependente[0]->incfismen = 'S';



try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtCdBenefAlt(
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
