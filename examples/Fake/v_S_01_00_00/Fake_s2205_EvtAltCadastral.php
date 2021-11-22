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

//carrega os dados do envento
$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;
//$std->nrrecibo = '11111111112222222222333';
$std->dtalteracao = '2017-11-11';
$std->cpftrab = '11111111111';
$std->nmtrab = 'JOSE DA SILVA';
$std->sexo = 'M';
$std->racacor = 5;
$std->estciv = 1;
$std->grauinstr = '07';
$std->nmsoc = 'Chiquinho';
$std->paisnac = '105';

$std->endereco = new \stdClass();
$std->endereco->brasil = new \stdClass();
$std->endereco->brasil->tplograd = 'R';
$std->endereco->brasil->dsclograd = 'Av. Paulista';
$std->endereco->brasil->nrlograd = '1850';
$std->endereco->brasil->bairro = 'Bela Vista';
$std->endereco->brasil->cep = '01311200';
$std->endereco->brasil->codmunic  = 3550308;
$std->endereco->brasil->uf = 'SP';

$std->endereco->exterior = new \stdClass();
$std->endereco->exterior->paisresid = '108';
$std->endereco->exterior->dsclograd = '5 Av';
$std->endereco->exterior->nrlograd = '2222';
$std->endereco->exterior->complemento = 'Apto 200';
$std->endereco->exterior->bairro = 'Manhattan';
$std->endereco->exterior->nmcid = 'New York';
$std->endereco->exterior->codpostal  = '111111';

$std->trabimig = new \stdClass();
$std->trabimig->tmpresid = 1;
$std->trabimig->conding = 2;

$std->infodeficiencia = new \stdClass();
$std->infodeficiencia->deffisica = 'N';
$std->infodeficiencia->defvisual = 'N';
$std->infodeficiencia->defauditiva = 'N';
$std->infodeficiencia->defmental = 'N';
$std->infodeficiencia->defintelectual = 'N';
$std->infodeficiencia->reabreadap = 'N';
$std->infodeficiencia->infocota = 'N';
$std->infodeficiencia->observacao = 'slsklskslkslkslkssklsklsjksjskjs';

$std->dependente[0] = new \stdClass();
$std->dependente[0]->tpdep = '01';
$std->dependente[0]->nmdep = 'WATSON';
$std->dependente[0]->dtnascto = '2015-01-01';
$std->dependente[0]->cpfdep = '12345678985';
$std->dependente[0]->sexodep = 'F';
$std->dependente[0]->depirrf = 'N';
$std->dependente[0]->depsf = 'N';
$std->dependente[0]->inctrab = 'N';

$std->contato = new \stdClass();
$std->contato->foneprinc = '1155555555';
$std->contato->emailprinc = 'beltrano@mail.com.br';

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
