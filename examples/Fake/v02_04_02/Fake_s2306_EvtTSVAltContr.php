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

$std = new \stdClass();
$std->sequencial = 1;
$std->indretif = 1;

$std->trabsemvinculo = new \stdClass();
$std->trabsemvinculo->cpftrab = '11111111111';
$std->trabsemvinculo->nistrab = '11111111111';
$std->trabsemvinculo->codcateg = '101';

$std->tsvalteracao = new \stdClass();
$std->tsvalteracao->dtalteracao = '2017-08-25';

$std->cargofuncao = new \stdClass();
$std->cargofuncao->codcargo = '12345678955';

$std->remuneracao = new \stdClass();
$std->remuneracao->vrsalfx = 1500;
$std->remuneracao->undsalfixo = 5;

$std->estagiario = new \stdClass();
$std->estagiario->natestagio = 'O';
$std->estagiario->nivestagio = 1;
$std->estagiario->areaatuacao = 'ATUACAO';
$std->estagiario->nrapol = '12345681';
$std->estagiario->vlrbolsa = 1500;
$std->estagiario->dtprevterm = '2017-08-25';

$std->estagiario->instituicao = new \stdClass();
$std->estagiario->instituicao->cnpjinstensino = '11111111111111';
$std->estagiario->instituicao->nmrazao = 'INSTITUICAO';

$std->estagiario->ageintegracao = new \stdClass();
$std->estagiario->ageintegracao->cnpjagntinteg = '11111111111111';
$std->estagiario->ageintegracao->nmrazao = 'RAZAO';
$std->estagiario->ageintegracao->dsclograd = 'LOGRADOURO';
$std->estagiario->ageintegracao->nrlograd = 'S/N';
$std->estagiario->ageintegracao->bairro = 'BAIRRO';
$std->estagiario->ageintegracao->cep = '12345789';
$std->estagiario->ageintegracao->codmunic = 3550308;
$std->estagiario->ageintegracao->uf = 'SP';

$std->estagiario->supervisor = new \stdClass();
$std->estagiario->supervisor->cpfsupervisor = '11111111111';
$std->estagiario->supervisor->nmsuperv = 'SUPERVISOR';

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtTSVAltContr(
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
