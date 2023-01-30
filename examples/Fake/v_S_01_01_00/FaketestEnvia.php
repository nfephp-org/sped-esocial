<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Common\Soap\SoapFake;
use NFePHP\eSocial\Common\FakePretty;
use NFePHP\eSocial\Event;
use NFePHP\eSocial\Tools;

$config = [
    'tpAmb'          => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc'        => 'S_1.1.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion'  => 'S.1.1.0',
    'serviceVersion' => '1.5.0', //versão do webservice
    'empregador'     => [
        'tpInsc'  => 1, //1-CNPJ, 2-CPF
        'nrInsc'  => '99999999', //numero do documento
        'nmRazao' => 'Razao Social',
    ],
    'transmissor'    => [
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
    $soap->loadCertificate($certificate);

    //campos OBRIGATORIOS
    $std = new \stdClass();
    $std->sequencial = 1; //numero sequencial
    $std->modo = 'INC'; //INC inclusão, ALT alteração EXC exclusão

    $std->ideperiodo = new \stdClass();
    $std->ideperiodo->inivalid = '2017-01'; //aaaa-mm do inicio da validade
//$std->ideperiodo->fimvalid = '2017-07'; //yyyy-mm do fim da validade
//campo OPCIONAL
//usar em Inclusão ou alteração apenas

    $std->infocadastro = new \stdClass();
    $std->infocadastro->classtrib = '01'; // classificação tributária do contribuinte, conforme tabela 8
    $std->infocadastro->indcoop = 0; //Indicativo de Cooperativa: 0 - Não é cooperativa; 1 - Cooperativa de Trabalho; 2 - Cooperativa de Produção; 3 - Outras Cooperativas.
    $std->infocadastro->indconstr = 0; //Indicativo de Construtora: 0 - Não é Construtora; 1 - Empresa Construtora.
    $std->infocadastro->inddesfolha = 0; //Indicativo de Desoneração da Folha: 0 - Não Aplicável; 1 - Empresa enquadrada nos art. 7º a 9º da Lei 12.546/2011.
    $std->infocadastro->indopccp = 2; //Indicativo da opção pelo produtor rural pela forma de tributação da contribuição previdenciária, nos termos do art. 25, §13, da Lei 8.212/1991 e do art. 25, §7°, da Lei 8.870/1994. O não preenchimento deste campo por parte do produtor rural implica opção pela comercialização da sua produção: 1 - Sobre a comercialização da sua produção; 2 - Sobre a folha de pagamento.
    $std->infocadastro->indporte = 'S'; //Indicativo de microempresa ou empresa de pequeno porte
    $std->infocadastro->indoptregeletron = 0; //registro eletrônico de empregados: 0 - Não optou pelo registro eletrônico de empregados; 1 - Optou pelo registro eletrônico de empregados
    $std->infocadastro->cnpjefr = '12345678901234'; //
//campo OPCIONAL
//Informações Complementares - Empresas Isentas - Dados da Isenção
//usar esses campos somente se declarar infocadastro
    $std->dadosisencao = new \stdClass();
    $std->dadosisencao->ideminlei = 'seila'; //Sigla e nome do Ministério ou Lei que concedeu o Certificado
    $std->dadosisencao->nrcertif = '987654321'; //Número do Certificado de Entidade Beneficente de Assistência Social, número da portaria de concessão do Certificado, ou, no caso de concessão através de Lei específica, o número da Lei.
    $std->dadosisencao->dtemiscertif = '2016-11-04'; //Data de Emissão do Certificado/publicação da Lei
    $std->dadosisencao->dtvenccertif = '2018-12-03'; //Data de Vencimento do Certificado
    $std->dadosisencao->nrprotrenov = null; //Protocolo pedido renovação
    $std->dadosisencao->dtprotrenov = null; //Data do protocolo de renovação
    $std->dadosisencao->dtdou = null; //Preencher com a data de publicação no Diário Oficial da União
    $std->dadosisencao->pagdou = null; // número da página no DOU referente à publicação do documento de concessão do certificado.
//campo Opcional
    $std->infoorginternacional = new \stdClass();
    $std->infoorginternacional->indacordoisenmulta = 0;

//campo OPCIONAL
//Informação preenchida exclusivamente em caso de alteração do período de validade das informações do registro identificado no evento, apresentando o novo período de validade.
//usar somente em caso de alteração
//$std->novavalidade = new \stdClass();
//$std->novavalidade->inivalid = '2021-05';//mês e ano de início da validade das informações prestadas no evento,
//$std->novavalidade->fimvalid = null;//mês e ano de término da validade das informações, se houve

    $evento = Event::evtInfoEmpregador($configJson, $std);

    //instancia a classe responsável pela comunicação
    $tools = new Tools($configJson, $certificate);
    //carrega a classe responsável pelo envio SOAP
    //nesse caso um envio falso
    $tools->loadSoapClass($soap);

    //executa o envio
    $response = $tools->enviarLoteEventos($tools::EVT_INICIAIS, [$evento]);

    //retorna os dados que serão usados na conexão para conferência
    echo FakePretty::prettyPrint($response, '');
} catch (\Exception $e) {
    echo $e->getMessage();
}
