<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.3.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.3.0',
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

$std->dmdev[0]->indrra = 'S';
//Indicativo de Rendimentos Recebidos Acumuladamente - RRA.
//Somente preencher este campo se for um demonstrativo de RRA.
//O campo apenas pode ser informado se {perApur}(/ideEvento_perApur) >= [2023-03]
// (se {indApuracao}(/ideEvento_indApuracao) = [1])
// ou se {perApur}(/ideEvento_perApur) >= [2023]
// (se {indApuracao}(/ideEvento_indApuracao) = [2]).
$std->dmdev[0]->inforra = new \stdClass(); //Opcional
//Informações complementares de RRA.
//Informações complementares relativas a Rendimentos Recebidos Acumuladamente - RRA.
//se {indRRA}(../indRRA) = [S]); N nos demais casos
$std->dmdev[0]->inforra->tpprocrra = 1; //Obrigatório
// 1 - Administrativo
// 2 - Judicial
$std->dmdev[0]->inforra->nrprocrra = '12345678901234567890'; //Opcional
//Informar o número do processo/requerimento administrativo/judicial.
//Informação obrigatória se {tpProcRRA}(./tpProcRRA) = [2] e opcional se {tpProcRRA}(./tpProcRRA) = [1].
// Deve ser número de processo válido e
//a) Se {tpProcRRA}(./tpProcRRA) = [1], deve possuir 17 (dezessete) ou 21 (vinte e um) algarismos;
//b) Se {tpProcRRA}(./tpProcRRA) = [2], deve possuir 20 (vinte) algarismos.

$std->dmdev[0]->inforra->descrra = 'bla bla bla'; //Obrigatório
//Descrição dos Rendimentos Recebidos Acumuladamente - RRA.

$std->dmdev[0]->inforra->qtdmesesrra = 111.3; //Obrigatório
//Número de meses relativo aos Rendimentos Recebidos Acumuladamente - RRA. de 0 até 999.9

$std->dmdev[0]->inforra->despprocjud = new \stdClass(); //Opcional
//Despesas com processo judicial. Detalhamento das despesas com processo judicial.

$std->dmdev[0]->inforra->despprocjud->vlrdespcustas = 1000;  //Obrigatório
//Preencher com o valor das despesas com custas judiciais.

$std->dmdev[0]->inforra->despprocjud->vlrdespadvogados = 1543.12; //obrigatório
//Preencher com o valor total das despesas com advogado(s).

$std->dmdev[0]->inforra->ideadv[0]  = new \stdClass(); //Opcional
//Identificação dos advogados.
$std->dmdev[0]->inforra->ideadv[0]->tpinsc = 1;
//Preencher com o código correspondente ao tipo de inscrição, conforme Tabela 05.
//1 CNPJ
//2 CPF
//3 CAEPF (Cadastro de Atividade Econômica de Pessoa Física)
//4 CNO (Cadastro Nacional de Obra)
//5 CGC
//6 CEI
$std->dmdev[0]->inforra->ideadv[0]->nrinsc = '12345678901';
//Informar o número de inscrição do advogado.
//Deve ser um número de inscrição válido, de acordo com o tipo de inscrição indicado no campo {ideAdv/tpInsc}(./tpInsc),
//considerando as particularidades aplicadas à informação de CNPJ de órgão público em S-1000.
//Se {ideAdv/tpInsc}(./tpInsc) = [1], deve possuir 14 (catorze) algarismos e, no caso de declarante pessoa jurídica,
//ser diferente do CNPJ base do empregador (exceto se {ideEmpregador/nrInsc}(/ideEmpregador_nrInsc) tiver
//14 (catorze) algarismos).
//Se {ideAdv/tpInsc}(./tpInsc) = [2], deve possuir 11 (onze) algarismos e, no caso de declarante pessoa física, ser
//diferente do CPF do empregador.
$std->dmdev[0]->inforra->ideadv[0]->vlradv = 1543.12;

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

$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha = new \stdClass(); //Opcional
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha->tpdesc = "1"; //Indicativo do tipo de desconto. Valores válidos: 1 - eConsignado
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha->instfinanc = "123"; //Código da Instituição Financeira concedente do empréstimo.
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha->nrdoc = "12345678111"; //Número do contrato referente ao empréstimo.
$std->dmdev[0]->infoperapur->ideestab[0]->remunperapur[0]->itensremun[0]->descfolha->observacao = "klasjdkljasdkljaskldj"; //opcional

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
