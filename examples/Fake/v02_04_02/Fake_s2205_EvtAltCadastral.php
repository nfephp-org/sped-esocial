<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_4_02',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.4.2',
    //versão do layout do evento
    'serviceVersion' => '1.4.1',
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
$std->nrrecibo = 'ABJBAJBJAJBAÇÇAAKJ';
$std->cpftrab = '12345678901';
$std->dtalteracao = '2017-11-11';

$std->nistrab = '12345678901';
$std->nmtrab = 'Fulano de Tal';
$std->sexo = 'M';
$std->racacor = 1;
$std->estciv = 1;
$std->grauinstr = '10';
$std->nmsoc = null;

$std->nascimento = new \stdClass();
$std->nascimento->dtnascto = '1982-11-02';
$std->nascimento->codmunic = '1234567';
$std->nascimento->uf = 'SP';
$std->nascimento->paisnascto = '090';
$std->nascimento->paisnac = '105';
$std->nascimento->nmmae = 'Fulana de Tal';
$std->nascimento->nmpai = 'Ciclano de Tal';

$std->ctps = new \stdClass();
$std->ctps->nrctps = '12345678901';
$std->ctps->seriectps = '12345';
$std->ctps->ufctps = 'SP';

$std->ric = new \stdClass();
$std->ric->nrric = '12345678901234';
$std->ric->orgaoemissor = 'LSLSLLSLLLSLSL';
$std->ric->dtexped = '2000-12-21';

$std->rg = new \stdClass();
$std->rg->nrrg = '12345678901234';
$std->rg->orgaoemissor = 'jdjdjqjeiiei';
$std->rg->dtexped = '1998-01-25';

$std->rne = new \stdClass();
$std->rne->nrrne = '12345678901234';
$std->rne->orgaoemissor = 'lslslsllslllslslls';
$std->rne->dtexped = '2010-10-10';

$std->oc = new \stdClass();
$std->oc->nroc = '12345678901234';
$std->oc->orgaoemissor = 'lklklk3iosiosislk';
$std->oc->dtexped = '2011-11-06';
$std->oc->dtvalid = '2018-11-06';

$std->cnh = new \stdClass();
$std->cnh->nrregcnh = '123456789012';
$std->cnh->dtexped = '2013-12-05';
$std->cnh->ufcnh = 'SP';
$std->cnh->dtvalid = '2018-12-05';
$std->cnh->dtprihab = '1999-05-28';
$std->cnh->categoriacnh = 'AE';

$std->brasil = new \stdClass();
$std->brasil->tplograd = 'VRT';
$std->brasil->dsclograd = 'sei la';
$std->brasil->nrlograd = '123';
$std->brasil->complemento = 'fundos';
$std->brasil->bairro = 'fora da vila';
$std->brasil->cep = '99999999';
$std->brasil->codmunic = 1545648;
$std->brasil->uf = 'SP';


$std->exterior = new \stdClass();
$std->exterior->paisresid = 'ALB';
$std->exterior->dsclograd = 'ksksksksksks';
$std->exterior->nrlograd = '235 /1';
$std->exterior->complemento = 'lkslsklk';
$std->exterior->bairro = 'lksksksksksks';
$std->exterior->nmcid = 'Voskow';
$std->exterior->codpostal = '123456789012';

$std->trabestrangeiro = new \stdClass();
$std->trabestrangeiro->dtchegada = '2000-01-01';
$std->trabestrangeiro->classtrabestrang = 3;
$std->trabestrangeiro->casadobr = 'N';
$std->trabestrangeiro->filhosbr = 'N';

$std->infodeficiencia = new \stdClass();
$std->infodeficiencia->deffisica = 'N';
$std->infodeficiencia->defvisual = 'N';
$std->infodeficiencia->defauditiva = 'N';
$std->infodeficiencia->defmental = 'S';
$std->infodeficiencia->defintelectual = 'N';
$std->infodeficiencia->reabreadap = 'N';
$std->infodeficiencia->infocota = 'N';
$std->infodeficiencia->observacao = 'qualquer coisa lorem ipsum';

$std->dependente[1] = new \stdClass();
$std->dependente[1]->tpdep = '03';
$std->dependente[1]->nmdep = '123 de oliveira 4';
$std->dependente[1]->dtnascto = '2005-06-08';
$std->dependente[1]->cpfdep = '12345678901';
$std->dependente[1]->depirrf = 'N';
$std->dependente[1]->depsf = 'N';
$std->dependente[1]->inctrab = 'N';

$std->aposentadoria = new \stdClass();
$std->aposentadoria->trabaposent = 'N';

$std->contato = new \stdClass();
$std->contato->foneprinc = '888888888';
$std->contato->fonealternat = '55555555';
$std->contato->emailprinc = 'ciclano@email.com.br';
$std->contato->emailalternat = 'fulano@mail.com';

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
