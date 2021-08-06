<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Common\Soap\SoapFake;
use NFePHP\eSocial\Common\FakePretty;
use NFePHP\eSocial\Tools;

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

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //usar a classe Fake para não tentar enviar apenas ver o resultado da chamada
    $soap = new SoapFake();
    //desativa a validação da validade do certificado
    //estamos usando um certificado vencido nesse teste
    $soap->disableCertValidation(true);

    //instancia a classe responsável pela comunicação
    $tools = new Tools($configJson, $certificate);
    //carrega a classe responsável pelo envio SOAP
    //nesse caso um envio falso
    $tools->loadSoapClass($soap);

    //Tipo do evento  | Chave(s) do evento   | Exemplo
    //S-1000          | -                    | vazio
    //S-1005          | tpInsc e nrInsc      | tpInsc=1;nrInsc=11223344556677...
    //S-1010          | codRubr e ideTabRubr | codRubr=1;ideTabRubr=1
    //S-1020          | codLotacao           | codLotacao=001
    //S-1030          | codCargo             | codCargo=001
    //S-1035          | CodCarreira          | CodCarreira=001
    //S-1040          | codFuncao            | codFuncao=001
    //S-1050          | codHorContrat        | codHorContrat=001
    //S-1060          | codAmb               | codAmb=001
    //S-1065          | codEP                | codEP=001
    //S-1070          | tpProc e nrProc      | tpProc=1;nrProc=12345678...
    //S-1080          | cnpjOpPortuario      | cnpjOpPortuario=111222333...
    
    //executa a consulta
    $tpEvt = 'S-1080';//obrigatório
    $chEvt = 'cnpjOpPortuario=11122233344'; //opcional
    $dtIni = '2012-12-13T12:12:12'; //opcional
    $dtFim = '2012-12-13T12:12:12'; //opcional
    
    $response = $tools->consultarEventosTabela($tpEvt, $chEvt, $dtIni, $dtFim);

    //header('Content-Type: application/xml; charset=utf-8');
    //echo $response;
    //retorna os dados que serão usados na conexão para conferência
    echo FakePretty::prettyPrint($response, '');
} catch (\Exception $e) {
    echo $e->getMessage();
}
