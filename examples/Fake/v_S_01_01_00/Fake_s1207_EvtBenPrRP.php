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
$std->indretif = 1;  //Obrigatório
$std->nrrecibo = null; //Opcional
$std->indapuracao = 1;  //Obrigatório
$std->perapur = '2017-08';  //Obrigatório
$std->cpfbenef = '11111111111';  //Obrigatório

//dentificação de cada um dos demonstrativos de valores devidos ao beneficiário.
$std->dmdev[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->idedmdev = '11111111111111111111'; //Obrigatório
$std->dmdev[0]->nrbeneficio = '11111111111111111111'; //Obrigatório

$std->dmdev[0]->indrra = 'S'; //S ou null
$std->dmdev[0]->inforra = new \stdClass(); //Opcional se indRRA for NULL
$std->dmdev[0]->inforra->tpprocrra = 1; //Obrigatorio 1 -Administrativo  ou 2 - judicial
$std->dmdev[0]->inforra->nrprocrra = '12345678901234567'; //Obrigatório
$std->dmdev[0]->inforra->descrra = 'Descrição do RRA'; //Obrigatório até 50 caracteres
$std->dmdev[0]->inforra->qtdmesesrra = 1; //Obrigatório de 9 atá 999.9
$std->dmdev[0]->inforra->despprocjud = new \stdClass(); //Opcional
$std->dmdev[0]->inforra->despprocjud->vlrdespcustas = 100.00; //Obrigatório
$std->dmdev[0]->inforra->despprocjud->vlrdespadvogados = 5000.00;  //Obrigatório
$std->dmdev[0]->inforra->ideadv[0] =  new \stdClass(); //Opcional até 1 até 99
$std->dmdev[0]->inforra->ideadv[0]->tpinsc = 1; //Obrigatório 1-CNPJ ou 2-CPF
$std->dmdev[0]->inforra->ideadv[0]->nrinsc = '12345678901234'; //Obrigatório

//Informações relativas ao período de apuração.
$std->dmdev[0]->infoperapur = new \stdClass(); //Opcional

//Identificação da unidade do órgão público na qual o beneficiário possui provento ou pensão.
$std->dmdev[0]->infoperapur->ideestab[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->tpinsc = 1; //Obrigatório e igual a 1
$std->dmdev[0]->infoperapur->ideestab[0]->nrinsc = "12345678901234"; //Obrigatório

//Rubricas que compõem o provento ou pensão do beneficiário.
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->codrubr = "slkjskjskj"; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->idetabrubr = "kkkk"; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->qtdrubr = 1; //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->fatorrubr = 2.2; //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->vrrubr = 100; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->itensremun[0]->indapurir = 0; //Obrigatório

//Grupo destinado às informações relativas a períodos anteriores. Somente preencher esse grupo se houver
//proventos ou pensões retroativos.
$std->dmdev[0]->infoperant = new \stdClass(); //Opcional

$std->dmdev[0]->infoperant->ideperiodo[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->perref = '2011-10'; //Obrigatório

//Identificação da unidade do órgão público na qual o beneficiário possui provento ou pensão.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->tpinsc = 1; //Obrigatório e igual a 1
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->nrinsc = "12345678901234"; //Obrigatório

//Rubricas que compõem o provento ou pensão do beneficiário.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->codrubr = "slkjskjskj"; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->idetabrubr = "kkkk"; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->qtdrubr = 1; //Opcional
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->fatorrubr = 2.2; //Opcional
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->vrrubr = 100; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->itensremun[0]->indapurir = 0; //Obrigatório

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtBenPrRP(
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
