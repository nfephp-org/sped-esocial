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
$std->indretif = 2;
$std->nrrecibo = '1.1.1234567890123456789';

$std->trabsemvinculo = new \stdClass();
$std->trabsemvinculo->cpftrab = '11111111111';
$std->trabsemvinculo->matricula = 'ABC11111111111';
$std->trabsemvinculo->codcateg = '101'; //Opcional

$std->tsvalteracao = new \stdClass();
$std->tsvalteracao->dtalteracao = '2017-08-25';
$std->tsvalteracao->natatividade = 1;

$std->cargofuncao = new \stdClass();
$std->cargofuncao->nmcargo = 'Empilhador de caixas';
$std->cargofuncao->cbocargo = '123456';
$std->cargofuncao->nmfuncao = 'Empilhador de caixas';
$std->cargofuncao->cbofuncao = '123456';

$std->remuneracao = new \stdClass();
$std->remuneracao->vrsalfx = 1500;
$std->remuneracao->undsalfixo = 6;
$std->remuneracao->dscsalvar = 'desc salario variavel';

$std->dirigentesindical = new \stdClass();
$std->dirigentesindical->tpregprev = 1;

$std->trabcedido = new \stdClass();
$std->trabcedido->tpregprev = 1;

$std->mandelet = new \stdClass();
$std->mandelet->indremuncargo = 'S';
$std->mandelet->tpregprev = 1;

$std->estagiario = new \stdClass();
$std->estagiario->natestagio = 'O';
$std->estagiario->nivestagio = 1;
$std->estagiario->areaatuacao = 'ATUACAO';
$std->estagiario->nrapol = '12345681';
$std->estagiario->vlrbolsa = 1500;
$std->estagiario->dtprevterm = '2017-08-25';

$std->estagiario->instensino = new \stdClass();
$std->estagiario->instensino->cnpjinstensino = '11111111111111';
$std->estagiario->instensino->nmrazao = 'INSTITUICAO DE ENSINO';
$std->estagiario->instensino->dsclograd = 'lrogradouro';
$std->estagiario->instensino->nrlograd = "numero";
$std->estagiario->instensino->bairro = "bairro";
$std->estagiario->instensino->cep = "12345678";
$std->estagiario->instensino->codmunic = "1234567";
$std->estagiario->instensino->uf = "AC";

$std->estagiario->ageintegracao = new \stdClass();
$std->estagiario->ageintegracao->cnpjagntinteg = '11111111111111';

$std->estagiario->supervisor = new \stdClass();
$std->estagiario->supervisor->cpfsupervisor = '11111111111';

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
