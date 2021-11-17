<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => '2_5_0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => '2.5.0',
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
$std->sequencial = 1;
$std->indretif = 1;
$std->nrrecibo = '123456';
$std->indapuracao = 1;
$std->perapur = '2017-08';

$std->ideestabadquir = new \stdClass();
$std->ideestabadquir->tpinscadq = 1;
$std->ideestabadquir->nrinscadq = '11111111111111';

$std->ideestabadquir->tpaquis[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->indaquis = 1;
$std->ideestabadquir->tpaquis[0]->vlrtotaquis = 1500.44;

$std->ideestabadquir->tpaquis[0]->ideprodutor[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->tpinscprod = 1;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nrinscprod = '11111111111111';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->vlrbruto = 1500.44;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->vrcpdescpr = 0.44;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->vrratdescpr = 0.92;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->vrsenardesc = 0.02;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->indopccp = 1;

$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->serie = '12345';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->nrdocto = '11111111111111111111';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->dtemisnf = '2017-08-22';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->vlrbruto = 1500.22;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->vrcpdescpr = 0.33;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->vrratdescpr = 0.55;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->nfs[0]->vrsenardesc = 0.66;

$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->nrprocjud = '111111111111111';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->codsusp = '11111111111111';
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->vrcpnret = 1500.93;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->vrratnret = 1500.88;
$std->ideestabadquir->tpaquis[0]->ideprodutor[0]->infoprocjud[0]->vrsenarnret = 1500.14;

$std->ideestabadquir->tpaquis[0]->infoprocj[0] = new \stdClass();
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->nrprocjud = '111111111111111';
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->codsusp = '11111111111111';
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->vrcpnret = 1500.93;
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->vrratnret = 1500.88;
$std->ideestabadquir->tpaquis[0]->infoprocj[0]->vrsenarnret = 1500.14;

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtAqProd(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml(); //opcional data e hora
            

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
