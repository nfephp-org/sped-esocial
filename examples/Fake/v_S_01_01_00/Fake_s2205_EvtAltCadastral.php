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

//carrega os dados do envento
$std = new \stdClass();
//$std->sequencial = 1; //Opcional
$std->indretif = 1;
$std->nrrecibo = '1.1.1234567890123456789'; //Obrigatório caso indretif = 2
$std->cpftrab = '12345678901';
$std->dtalteracao = '2017-11-11';
$std->nmtrab = 'Fulano de Tal';
$std->sexo = 'M';
$std->racacor = 1;
$std->estciv = 1;
$std->grauinstr = '10';
$std->nmsoc = null;
$std->paisnac = '105';

$std->endereco = new \stdClass(); //Obrigatório
//Endereço no Brasil.
$std->endereco->brasil = new \stdClass(); //Opcional
$std->endereco->brasil->tplograd = 'R'; //Opcional
$std->endereco->brasil->dsclograd = 'Av. Paulista'; //Obrigatório
$std->endereco->brasil->nrlograd = '1850'; //Obrigatório
$std->endereco->brasil->complemento = "apto 123"; //Opcional
$std->endereco->brasil->bairro = 'Bela Vista'; //Opcional
$std->endereco->brasil->cep = '01311200'; //Obrigatório
$std->endereco->brasil->codmunic  = '3550308'; //Obrigatório
$std->endereco->brasil->uf = 'SP'; //Obrigatório

//Endereço no exterior.
$std->endereco->exterior = new \stdClass(); //Opcional
$std->endereco->exterior->paisresid = '108'; //Obrigatório
$std->endereco->exterior->dsclograd = '5 Av'; //Obrigatório
$std->endereco->exterior->nrlograd = '2222'; //Obrigatório
$std->endereco->exterior->complemento = 'Apto 200'; //Opcional
$std->endereco->exterior->bairro = 'Manhattan'; //Opcional
$std->endereco->exterior->nmcid = 'New York'; //Obrigatório
$std->endereco->exterior->codpostal  = null; //Opcional

//Informações do trabalhador imigrante.
$std->trabimig = new \stdClass(); //Opcional
$std->trabimig->tmpresid = 1; //Opcional
$std->trabimig->conding = 1; //Obrigatório

//Pessoa com deficiência.
$std->infodeficiencia = new \stdClass(); //Opcional
$std->infodeficiencia->deffisica = 'N'; //Obrigatório
$std->infodeficiencia->defvisual = 'N'; //Obrigatório
$std->infodeficiencia->defauditiva = 'N'; //Obrigatório
$std->infodeficiencia->defmental = 'N'; //Obrigatório
$std->infodeficiencia->defintelectual = 'N'; //Obrigatório
$std->infodeficiencia->reabreadap = 'N'; //Obrigatório
$std->infodeficiencia->infocota = 'N'; //Opcional
$std->infodeficiencia->observacao = 'lkslkslkslkslkslks'; //Opcional

//Informações dos dependentes.
$std->dependente[1]  = new \stdClass(); //Opcional
$std->dependente[1]->tpdep = '01'; //Obrigatório
$std->dependente[1]->nmdep = 'Fulaninho de Tal'; //Obrigatório
$std->dependente[1]->dtnascto = '2016-11-25'; //Obrigatório
$std->dependente[1]->cpfdep = '12345678901'; //Opcional
$std->dependente[1]->depirrf = 'N'; //Obrigatório
$std->dependente[1]->depsf = 'N'; //Obrigatório
$std->dependente[1]->inctrab = 'N'; //Obrigatório

//Informações de contato.
$std->contato = new \stdClass(); //Opcional
$std->contato->foneprinc = '1234567890'; //Opcional
$std->contato->emailprinc = 'ele@mail.com'; //Opcional

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtAltCadastral(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2205($json, $std, $certificate)->toXML();
    //$json = Event::evtAltCadastral($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
