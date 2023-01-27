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

$std->tpinsc = 1; //obrigatório
//Preencher com o código correspondente ao tipo de inscrição, conforme Tabela 05
//Valores válidos: 1 - CNPJ 3 - CAEPF 4 - CNO

$std->nrinsc = '12345678901234'; //obrigatório
//Informar o número de inscrição do estabelecimento, obra
//de construção civil ou órgão público de acordo com o tipo
//de inscrição indicado no campo ideEstab/tpInsc.
//Validação: Deve ser compatível com o conteúdo do campo
//ideEstab/tpInsc. Deve ser um identificador válido, constante
//das bases da RFB, vinculado ao empregador.

$std->inivalid = '2017-01';  //obrigatório
//Preencher com o mês e ano de início da validade das
//informações prestadas no evento, no formato AAAA-MM.
//Validação: Deve ser uma data válida, igual ou posterior à
//data de início de obrigatoriedade deste evento para o
//empregador no eSocial, no formato AAAA-MM.

$std->fimvalid = '2017-12'; //opcional
//Preencher com o mês e ano de término da validade das
//informações, se houver.
//Validação: Se informado, deve estar no formato AAAA-MM
//e ser um período igual ou posterior a iniValid.


$std->modo = 'INC'; //INC, ALT ou EXC

//dados do estabelecimento
$std->dadosestab = new \stdClass(); //Opcional
$std->dadosestab->cnaeprep = "1234567";
//Preencher com o código CNAE conforme legislação vigente,
//referente à atividade econômica preponderante do
//estabelecimento.
//Validação: Deve ser um número existente na tabela CNAE.

$std->dadosestab->aliqgilrat = new \stdClass();
$std->dadosestab->aliqgilrat->aliqrat = 1;
//Informar a alíquota RAT, quando divergente da legislação
//vigente para a atividade (CNAE) preponderante. A
//divergência só é permitida se existir o grupo com
//informações sobre o processo administrativo/judicial que
//permite a aplicação de alíquota diferente.
//Valores válidos: 1, 2, 3
//Validação: Preenchimento obrigatório e exclusivo se a
//alíquota informada for diferente da definida na legislação
//vigente para o código CNAE informado (neste caso, deverá
//haver informações de processo em procAdmJudRat).
//Se informada, deve ser diferente da alíquota definida na
//legislação vigente para a atividade (CNAE) preponderante.

$std->dadosestab->aliqgilrat->fap = 0.5000; //opcional
//Fator Acidentário de Prevenção - FAP.
//Validação: Preenchimento obrigatório e exclusivo por
//Pessoa Jurídica e ideEstab/tpInsc = [4], ou se ideEstab/tpInsc [1] e o fator
//informado for diferente do definido pelo
//órgão governamental competente para o estabelecimento
//(neste caso, deverá haver informações de processo em procAdmJudFap).
//Se informado, deve ser um número maior ou igual a 0,5000
//e menor ou igual a 2,0000 e, se ideEstab/tpInsc = [1], deve
//ser diferente do valor definido pelo órgão governamental competente.


//campo opcional
$std->dadosestab->aliqgilrat->procadmjudrat = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudrat->tpproc = 1;
//Preencher com o código correspondente ao tipo de processo.
//Valores válidos: 1 - Administrativo 2 - Judicial

$std->dadosestab->aliqgilrat->procadmjudrat->nrproc = '12345678901234567890';
//Informar um número de processo cadastrado através do evento S-1070, cujo indMatProc
//seja igual a [1]. Validação: Deve ser um número de processo administrativo
//ou judicial válido e existente na Tabela de Processos (S-1070), com indMatProc = [1].

$std->dadosestab->aliqgilrat->procadmjudrat->codsusp = '14524578901';
//Código do indicativo da suspensão, atribuído pelo empregador em S-1070.
//Validação: A informação prestada deve estar de acordo com o que foi informado em S-1070.

//campo opcional
$std->dadosestab->aliqgilrat->procadmjudfap = new \stdClass();
$std->dadosestab->aliqgilrat->procadmjudfap->tpproc = 1;
//Preencher com o código correspondente ao tipo de processo.
//Valores válidos: 1 - Administrativo 2 - Judicial 4 - Processo FAP de exercício anterior a 2019

$std->dadosestab->aliqgilrat->procadmjudfap->nrproc = '12345678901234567890';
//Informar um número de processo cadastrado através do evento S-1070, cujo indMatProc seja igual a [1].
//Validação: Deve ser um número de processo administrativo ou judicial válido e
//existente na Tabela de Processos (S-1070), com indMatProc = [1].

$std->dadosestab->aliqgilrat->procadmjudfap->codsusp = '123445';
//Código do indicativo da suspensão, atribuído pelo empregador em S-1070.
//Validação: A informação prestada deve estar de acordo com o que foi informado em S-1070.

//campo opcional
$std->dadosestab->infocaepf = new \stdClass();
$std->dadosestab->infocaepf->tpcaepf = 1;
//Tipo de CAEPF. Valores válidos:
//1 - Contribuinte individual
//2 - Produtor rural
//3 - Segurado especial
//Validação: Deve ser compatível com o cadastro da RFB.

//campo opcional
$std->dadosestab->infoobra = new \stdClass();
$std->dadosestab->infoobra->indsubstpatrobra = 1;
//Indicativo de substituição da contribuição patronal de obra de construção civil.
//Valores válidos: 1 - Contribuição patronal substituída 2 - Contribuição patronal não substituída

//campo opcional
$std->dadosestab->infotrab = new \stdClass();
//campo opcional
$std->dadosestab->infotrab->infoapr = new \stdClass();
$std->dadosestab->infotrab->infoapr->nrprocjud = '12345678901234567890';
//Preencher com o número do processo judicial.
//Validação: Se informado, deve ser um número de processo judicial válido.

//campo ARRAY opcional
$std->dadosestab->infotrab->infoapr->infoenteduc[0] = new \stdClass();
$std->dadosestab->infotrab->infoapr->infoenteduc[0]->nrinsc = '12345678901234';
//Informar o número de inscrição da entidade educativa ou de prática desportiva.
//Validação: Deve ser um número de CNPJ válido, com 14 (catorze) algarismos.
//Se o empregador for pessoa jurídica, a raiz do CNPJ informado deve ser diferente de ideEmpregador/nrInsc.

//campo opcional
$std->dadosestab->infotrab->infopdc = new \stdClass();
$std->dadosestab->infotrab->infopdc->nrprocjud = '12345678901234567890';
//Preencher com o número do processo judicial.
//Validação: Deve ser um número de processo judicial válido.

//campo opcional somente deve ser usado em alterações
$std->novavalidade = new \stdClass();
$std->novavalidade->inivalid = '2017-12';
$std->novavalidade->fimvalid = '2018-12';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado

    $xml = Event::evtTabEstab(
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
