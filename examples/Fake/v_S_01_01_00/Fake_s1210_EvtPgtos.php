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
$std->indretif = 1; //Obrigatório
$std->nrrecibo = null; //Opcional
$std->perapur = '2017-12';  //Obrigatório
$std->indguia = 1; //Opcional
$std->cpfbenef = '12345678901';  //Obrigatório

//Informações dos pagamentos efetuados.
$std->infopgto[0] = new \stdClass(); //Obrigatório
$std->infopgto[0]->dtpgto = '2018-01-15';  //Obrigatório
$std->infopgto[0]->tppgto = 4;  //Obrigatório
$std->infopgto[0]->perref = '2020';  //Obrigatório
$std->infopgto[0]->idedmdev = 'sjksjskjslsjksjsj';  //Obrigatório
$std->infopgto[0]->vrliq = 1000.33;  //Obrigatóri
$std->infopgto[0]->paisresidext = '001'; //opcional
//Informar o código do país de residência para fins fiscais, quando no exterior, conforme Tabela 06.
//Somente informar este campo caso o país de residência para fins fiscais seja diferente de Brasil. Se não informado,
//implica que o país de residência fiscal é Brasil.
//O campo apenas pode ser preenchido se {perApur}(1210_ideEvento_perApur) >= [2023-03]. Se informado, deve ser um
// código válido e existente na Tabela 06, exceto [105].

$std->infopgto[0]->infopgtoext = new \stdClass(); //Opcional
//Informações complementares relativas a pagamentos a residente fiscal no exterior.
//CONDICAO_GRUPO: O (se {paisResidExt}(../paisResidExt) for informado); N (nos demais casos)
$std->infopgto[0]->infopgtoext->indnif = 1; //Obrigatório
//Indicativo do Número de Identificação Fiscal (NIF).
//1 - Beneficiário com NIF
//2 - Beneficiário dispensado do NIF
//3 - País não exige NIF
$std->infopgto[0]->infopgtoext->nifbenef = 'ABC1234'; //Opcional
//Número de Identificação Fiscal (NIF).
//Preenchimento obrigatório se {indNIF}(./indNIF) = [1].
$std->infopgto[0]->infopgtoext->frmtribut = '11'; //Obrigatório
//Forma de tributação, conforme opções disponíveis na Tabela 30.
//Deve ser um código válido e existente na Tabela 30

$std->infopgto[0]->infopgtoext->endext = new \stdClass(); //Opcional
//Endereço do beneficiário residente ou domiciliado no exterior.
////CONDICAO_GRUPO: OC
$std->infopgto[0]->infopgtoext->endext->enddsclograd = "5 AVE"; //Opcional
//Descrição do logradouro
$std->infopgto[0]->infopgtoext->endext->endnrlograd = "2222"; //Opcional
//Número do logradouro.
//Devem ser utilizados apenas caracteres alfanuméricos com, pelo menos, um caractere numérico.
$std->infopgto[0]->infopgtoext->endext->endcomplem = "Box 1201"; //Opcional
//Complemento do endereço
$std->infopgto[0]->infopgtoext->endext->endbairro = "Down Town"; //Opcional
//Nome do bairro/distrito.
$std->infopgto[0]->infopgtoext->endext->endcidade = "New York"; //Opcional
//Nome da cidade.
$std->infopgto[0]->infopgtoext->endext->endestado = "NY"; //Opcional
//Nome da província/estado.
$std->infopgto[0]->infopgtoext->endext->endcodpostal = "01234"; //Opcional
//Código de Endereçamento Postal.
//Devem ser informados apenas caracteres numéricos.
$std->infopgto[0]->infopgtoext->endext->telef = "55555555555"; //Opcional
//Número do telefone.
//Devem ser informados apenas caracteres numéricos


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtPgtos(
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
