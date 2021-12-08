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
//$std->sequencial = 1; //Opcional
$std->indretif = 1; //Obrigatório
$std->nrrecibo = '1.1.1234567890123456789'; //Obrigatório caso indretif = 2
$std->indguia = 1; //Opcional
$std->cpftrab = '99999999999'; //Obrigatório
$std->matricula = '1234infomv56788-56478ABC'; //Obrigatório
$std->mtvdeslig = '02'; //Obrigatório
$std->dtdeslig = '2017-11-25'; //Obrigatório
$std->dtavprv = '2017-11-25'; //Opcional
$std->indpagtoapi = 'S'; //Obrigatório
$std->dtprojfimapi = '2017-11-25'; //Opcional
$std->pensalim = 2; //Opcional
$std->percaliment = 22; //Opcional
$std->vralim = 1234.45; //Opcional
$std->nrproctrab = '12345678901234567890'; //Opcional

//Informações relativas ao trabalho intermitente.
$std->infoInterm[0] = new \stdClass(); //Opcional
$std->infoInterm[0]->dia = 12; //Obrigatório

//Observações sobre o desligamento.
$std->observacoes[0] = new \stdClass(); //Opcional
$std->observacoes[0]->observacao = 'observacao'; //Obrigatório

//Grupo preenchido exclusivamente nos casos de sucessão do vínculo trabalhista, 
//com a identificação da empresa sucessora.
$std->sucessaovinc = new \stdClass(); //Opcional
$std->sucessaovinc->tpinsc = 1; //Obrigatório
$std->sucessaovinc->nrinsc = '12345678901234'; //Obrigatório

//Transferência de titularidade do empregado doméstico
//para outro representante da mesma unidade familiar.
$std->transftit = new \stdClass(); //Opcional
$std->transftit->cpfsubstituto = '12345678901'; //Obrigatório
$std->transftit->dtnascto = '1969-10-04'; //Obrigatório

//Informação do novo CPF do trabalhador.
$std->mudancacpf = new \stdClass(); //Opcional
$std->mudancacpf->novocpf = '12345678901'; //Obrigatório

//Grupo onde são prestadas as informações relativas às
//verbas devidas ao trabalhador na rescisão contratual.
$std->verbasresc = new \stdClass(); //Opcional

//Identificação de cada um dos demonstrativos de valores devidos ao trabalhador
$std->verbasresc->dmdev[1] = new \stdClass();  //Obrigatório
$std->verbasresc->dmdev[1]->idedmdev = 'akakakak737477382828282828282';  //Obrigatório

//Verbas rescisórias relativas ao mês/ano da data do desligamento.
$std->verbasresc->dmdev[1]->infoperapur = new \stdClass(); //Opcional

//Identificação do estabelecimento e da lotação
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->tpinsc = "3"; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->nrinsc = '12345678901234'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->codlotacao = 'asdfg'; //Obrigatório

//Detalhamento das verbas rescisórias devidas ao trabalhador
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->idetabrubr = '12345678'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->qtdrubr = 25.45; //Opcional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->fatorrubr = 1.56; //Opcional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->vrrubr = 200.56; //Obrigatório
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->detverbas[1]->indapurir = 0; //Opcional

//Grupo referente ao detalhamento do grau de exposição do trabalhador aos agentes nocivos
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo = new \stdClass(); //Opcional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infoagnocivo->grauexp = 2; //Obrigatório

//Informação relativa a empresas enquadradas no regime de tributação Simples Nacional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples = new \stdClass(); //Opcional
$std->verbasresc->dmdev[1]->infoperapur->ideestablot[1]->infosimples->indsimples = 1; //Obrigatório

//Remuneração relativa a períodos anteriores, devida em função de acordos coletivos, legislação específica,
//convenção coletiva de trabalho, dissídio ou conversão de licença saúde em acidente de trabalho
$std->verbasresc->dmdev[1]->infoperant = new \stdClass(); //Opcional

//Identificação do instrumento ou situação ensejadora da remuneração relativa a períodos de apuração anteriores.
$std->verbasresc->dmdev[1]->infoperant->ideadc[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dtacconv = '2017-04-02'; //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->tpacconv = 'A';  //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->dsc = 'kksksks k skjskjskjs sk';  //Obrigatório

//Identificação do período ao qual se referem as diferenças de remuneração.
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1] = new \stdClass(); //Obrigatório 
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->perref = '2017-01'; //Obrigatório

//Identificação do estabelecimento e da lotação
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->tpinsc = "1"; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->nrinsc = '12345678901234'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->codlotacao = 'asdfg'; //Obrigatório

//Detalhamento das verbas rescisórias devidas ao trabalhador
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1] = new \stdClass(); //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->codrubr = 'lslslslslslslslslslslsl'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->idetabrubr = '12345678'; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->qtdrubr = 25.45; //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->fatorrubr = 1.56; //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->vrrubr = 200.56; //Obrigatório
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->detverbas[1]->indapurir = 0; //Opcional

//Grupo referente ao detalhamento do grau de exposição do trabalhador aos agentes nocivos
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo = new \stdClass(); //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infoagnocivo->grauexp = 2; //Obrigatório

//Informação relativa a empresas enquadradas no regime de tributação Simples Nacional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples = new \stdClass(); //Opcional
$std->verbasresc->dmdev[1]->infoperant->ideadc[1]->ideperiodo[1]->ideestablot[1]->infosimples->indsimples = 1; //Obrigatório

//Informações sobre a existência de processos judiciais do trabalhador com decisão favorável quanto à não incidência
//de contribuições sociais e/ou Imposto de Renda.
$std->verbasresc->procjudtrab[1] = new \stdClass(); //Opcional
$std->verbasresc->procjudtrab[1]->tptrib = 2; //Obrigatório
$std->verbasresc->procjudtrab[1]->nrprocjud = '12345678901234567890'; //Obrigatório
$std->verbasresc->procjudtrab[1]->codsusp = '12345678901234'; //Obrigatório

//Grupo preenchido exclusivamente em caso de trabalhador que possua outros vínculos/atividades nos quais já tenha
//ocorrido desconto de contribuição previdenciária. 
$std->verbasresc->infomv = new \stdClass(); //Opcional
$std->verbasresc->infomv->indmv = 2; //Obrigatório

//Informações relativas ao trabalhador que possui vínculo
//empregatício com outra(s) empresa(s) e/ou que exerce
//outras atividades como contribuinte individual, detalhando
$std->verbasresc->infomv->remunoutrempr[1] = new \stdClass(); //Obrigatório
$std->verbasresc->infomv->remunoutrempr[1]->tpinsc = 1; //Obrigatório
$std->verbasresc->infomv->remunoutrempr[1]->nrinsc = '12345678901234'; //Obrigatório
$std->verbasresc->infomv->remunoutrempr[1]->codcateg = '001'; //Obrigatório
$std->verbasresc->infomv->remunoutrempr[1]->vlrremunoe = 2535.97; //Obrigatório

//Informação sobre processo judicial que suspende a
//exigibilidade da Contribuição Social Rescisória
$std->verbasresc->proccs = new \stdClass(); //OPcional
$std->verbasresc->proccs->nrprocjud = '12345678901234567890'; //Obrigatório

//Informações sobre a "quarentena" remunerada de
//trabalhador desligado ou outra situação de desligamento
//com data anterior.
$std->quarentena = new \stdClass(); //Opcional
$std->quarentena->dtfimquar = '2018-12-20'; //Obrigatório

//Informações sobre operação de crédito consignado com garantia de FGTS.
$std->consigfgts[0] = new \stdClass(); //Opcional
$std->consigfgts[0]->insconsig = '12345'; //Obrigatório
$std->consigfgts[0]->nrcontr = '123456789012345'; //Obrigatório

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtDeslig(
        $configJson,
        $std,
        $certificate
        //'2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2299($json, $std, $certificate)->toXML();
    //$json = Event::evtDeslig($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
