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
$std->indretif = 1; //Obritatório
$std->nrrecibo = null;  //Obritatório caso indretif == 2
$std->indapuracao = 1;  //Obritatório
$std->perapur = '2017-08'; //Obritatório
$std->cpftrab = '11111111111'; //Obritatório

//Grupo preenchido quando o evento de remuneração se referir a trabalhador cuja categoria não está sujeita ao
//evento de admissão ou ao evento TSVE - Início, bem como para informar remuneração devida pelo órgão sucessor a
//servidor desligado ainda no sucedido. No caso das categorias em que o evento TSVE - Início for opcional, o
//preenchimento do grupo somente é exigido se não existir o respectivo evento. As informações complementares são
//necessárias para correta identificação do trabalhador.
$std->infocomplem = new \stdClass(); //Opcional
$std->infocomplem->nmtrab = "Jose da Silva"; //Obritatório
$std->infocomplem->dtnascto = "1984-11-16"; //Obritatório

//Grupo de informações da sucessão de vínculo.
$std->infocomplem->sucessaovinc = new \stdClass(); //Opcional
$std->infocomplem->sucessaovinc->cnpjorgaoant = "12345678901234"; //Obritatório
$std->infocomplem->sucessaovinc->matricant = "12345678"; //Opcional
$std->infocomplem->sucessaovinc->dtexercicio = "2021-11-05"; //Obritatório
$std->infocomplem->sucessaovinc->observacao = 'bla bla bla bla bla bla bla bla '; //Opcional


//dentificação de cada um dos demonstrativos de valores devidos ao trabalhador.
$std->dmdev[0] = new \stdClass(); //Obritatório
$std->dmdev[0]->idedmdev = '213789'; //Obritatório
$std->dmdev[0]->codcateg = '103';  //Obritatório

//Informações relativas ao período de apuração.
$std->dmdev[0]->infoperapur = new \stdClass(); //Opcional

//Identificação da unidade do órgão público na qual o servidor possui remuneração.
$std->dmdev[0]->infoperapur->ideestab[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->tpinsc = 1; //Obrigatório somente pode ser 1 - cnpj
$std->dmdev[0]->infoperapur->ideestab[0]->nrinsc = '11111111111111'; //Obrigatório

//Informações relativas à remuneração do trabalhador no período de apuração.
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->matricula = '12365110'; //Opcional

//Rubricas que compõem a remuneração do trabalhador
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->codrubr = '123150'; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->idetabrubr = '12345678'; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->qtdrubr = 1; //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->fatorrubr = 1; //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->vrrubr = 1.00; //Obrigatório
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->indapurir = 0; //Obrigatório


//Grupo destinado às informações de:
// a) remuneração relativa a diferenças de vencimento provenientes de disposições legais;
// b) verbas de natureza salarial ou não salarial devidas após o desligamento;
// c) decisões administrativas ou judiciais relativas a diferenças de remuneração.
// OBS.: As informações previstas acima podem se referir ao período de apuração definido em perApur ou a períodos anteriores a perApur.
$std->dmdev[0]->infoperant = new \stdClass(); //Opcional
$std->dmdev[0]->infoperant->remunorgsuc = 'S'; //Obrigatório

//Identificação do período ao qual se referem as diferenças de remuneração.
$std->dmdev[0]->infoperant->ideperiodo[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->perref = '2021-10'; //Obrigatório

//Identificação da unidade do órgão público na qual o servidor possui remuneração.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->tpinsc = 1; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->nrinsc = '12345678901234'; //Obrigatório

//nformações relativas à remuneração do trabalhador em períodos anteriores.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->matricula = '123456'; //Opcional

//Rubricas que compõem a remuneração do trabalhador.
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->codrubr = '123150'; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->idetabrubr = '12345678'; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->qtdrubr = 1;  //Opcional
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->fatorrubr = 1; //Opcional
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->vrrubr = 1; //Obrigatório
$std->dmdev[0]->infoperant->ideperiodo[0]->ideestab[0]->remumperant[0]->itensremum[0]->indapurir = 0; //Obrigatório


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtRmnRPPS(
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
