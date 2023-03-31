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
$std->nrrecibo = '1.1.1234567890123456789'; //Obrigatório APENAS se indretif = 2
$std->indapuracao = 2; //Obrigatorio
$std->perapur = '2017-12'; //Obrigatório
$std->indguia = 1; //Opcional
$std->cpftrab = '12345678901'; //Obrigatório

//Grupo preenchido exclusivamente em caso de trabalhador
//que possua outros vínculos/atividades nos quais já tenha
//ocorrido desconto de contribuição previdenciária.
$std->infomv = new \stdClass(); //Opcional
$std->infomv->indmv = 1; //Obrigatório

//nformações relativas ao trabalhador que possui vínculo
//empregatício com outra(s) empresa(s)
$std->infomv->remunoutrempr[0] = new \stdClass(); //Obrigatório
$std->infomv->remunoutrempr[0]->tpinsc = 1; //Obrigatório
$std->infomv->remunoutrempr[0]->nrinsc = '12345678901234'; //Obrigatório
$std->infomv->remunoutrempr[0]->codcateg = 901; //Obrigatório
$std->infomv->remunoutrempr[0]->vlrremunoe = 2345.09; //Obrigatório

///Grupo preenchido quando o evento de remuneração se
//referir a trabalhador cuja categoria não está sujeita ao
//evento de admissão ou ao evento TSVE - Início
$std->infocomplem = new \stdClass(); //Opcional
$std->infocomplem->nmtrab = 'Fulano de Tal'; ///Obrigatório
$std->infocomplem->dtnascto = '1985-02-14'; //Obrigatório

//Informações da sucessão de vínculo trabalhista.
$std->infocomplem->sucessaovinc = new \stdClass(); //Opcional
$std->infocomplem->sucessaovinc->tpinsc = 1; //Obrigatório
$std->infocomplem->sucessaovinc->nrinsc = "12345678901234"; //Obrigatório
$std->infocomplem->sucessaovinc->matricant = 'jkdjkjdkjdjkd'; //Opcional
$std->infocomplem->sucessaovinc->dtadm = '2017-06-07'; //Obrigatório
$std->infocomplem->sucessaovinc->observacao = 'nao obrigatorio'; //Opcional

//Informações sobre a existência de processos judiciais do
//trabalhador com decisão favorável quanto à não incidência
//de contribuições sociais e/ou Imposto de Renda.
$std->procjudtrab[0] = new \stdClass(); //Opcional
$std->procjudtrab[0]->tptrib = 2; //Obrigatório
$std->procjudtrab[0]->nrprocjud = '12345678901234567890'; //Obrigatório
$std->procjudtrab[0]->codsusp = '12345678901234'; //Obrigatório

//Informações relativas ao trabalho intermitente
$std->infointerm[0] = new \stdClass(); //Opcional
$std->infointerm[0]->dia = 10; //Obrigatório

//Identificação de cada um dos demonstrativos de valores devidos ao trabalhador.
$std->dmdev[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->idedmdev = 'kjdkjdkjdkdj'; //Obrigatório
$std->dmdev[0]->codcateg = 101; //Obrigatório

$std->dmdev[0]->indrra = 'S';
//Indicativo de Rendimentos Recebidos Acumuladamente - RRA.
//Somente preencher este campo se for um demonstrativo de RRA.
//O campo apenas pode ser informado se {perApur}(/ideEvento_perApur) >= [2023-03]
// (se {indApuracao}(/ideEvento_indApuracao) = [1])
// ou se {perApur}(/ideEvento_perApur) >= [2023]
// (se {indApuracao}(/ideEvento_indApuracao) = [2]).
$std->dmdev[0]->inforra = new \stdClass(); //Opcional
//Informações complementares de RRA.
//Informações complementares relativas a Rendimentos Recebidos Acumuladamente - RRA.
//se {indRRA}(../indRRA) = [S]); N nos demais casos
$std->dmdev[0]->inforra->tpprocrra = 1; //Obrigatório
// 1 - Administrativo
// 2 - Judicial
$std->dmdev[0]->inforra->nrprocrra = '12345678901234567890'; //Opcional
//Informar o número do processo/requerimento administrativo/judicial.
//Informação obrigatória se {tpProcRRA}(./tpProcRRA) = [2] e opcional se {tpProcRRA}(./tpProcRRA) = [1].
// Deve ser número de processo válido e
//a) Se {tpProcRRA}(./tpProcRRA) = [1], deve possuir 17 (dezessete) ou 21 (vinte e um) algarismos;
//b) Se {tpProcRRA}(./tpProcRRA) = [2], deve possuir 20 (vinte) algarismos.

$std->dmdev[0]->inforra->descrra = 'bla bla bla'; //Obrigatório
//Descrição dos Rendimentos Recebidos Acumuladamente - RRA.

$std->dmdev[0]->inforra->qtdmesesrra = 111.3; //Obrigatório
//Número de meses relativo aos Rendimentos Recebidos Acumuladamente - RRA. de 0 até 999.9

$std->dmdev[0]->inforra->despprocjud = new \stdClass(); //Opcional
//Despesas com processo judicial. Detalhamento das despesas com processo judicial.

$std->dmdev[0]->inforra->despprocjud->vlrdespcustas = 1000;  //Obrigatório
//Preencher com o valor das despesas com custas judiciais.

$std->dmdev[0]->inforra->despprocjud->vlrdespadvogados = 1543.12; //obrigatório
//Preencher com o valor total das despesas com advogado(s).

$std->dmdev[0]->inforra->ideadv[0]  = new \stdClass(); //Opcional
//Identificação dos advogados.
$std->dmdev[0]->inforra->ideadv[0]->tpinsc = 1;
//Preencher com o código correspondente ao tipo de inscrição, conforme Tabela 05.
//1 CNPJ
//2 CPF
//3 CAEPF (Cadastro de Atividade Econômica de Pessoa Física)
//4 CNO (Cadastro Nacional de Obra)
//5 CGC
//6 CEI
$std->dmdev[0]->inforra->ideadv[0]->nrinsc = '12345678901';
//Informar o número de inscrição do advogado.
//Deve ser um número de inscrição válido, de acordo com o tipo de inscrição indicado no campo {ideAdv/tpInsc}(./tpInsc),
//considerando as particularidades aplicadas à informação de CNPJ de órgão público em S-1000.
//Se {ideAdv/tpInsc}(./tpInsc) = [1], deve possuir 14 (catorze) algarismos e, no caso de declarante pessoa jurídica,
//ser diferente do CNPJ base do empregador (exceto se {ideEmpregador/nrInsc}(/ideEmpregador_nrInsc) tiver
//14 (catorze) algarismos).
//Se {ideAdv/tpInsc}(./tpInsc) = [2], deve possuir 11 (onze) algarismos e, no caso de declarante pessoa física, ser
//diferente do CPF do empregador.
$std->dmdev[0]->inforra->ideadv[0]->vlradv = 1543.12;

//Identificação do estabelecimento e da lotação nos quais o
//trabalhador possui remuneração no período de apuração
$std->dmdev[0]->ideestablot[0] = new \stdClass(); //Opcional
$std->dmdev[0]->ideestablot[0]->tpinsc = "1"; //Obrigatório
$std->dmdev[0]->ideestablot[0]->nrinsc = '12345678901234'; //Obrigatório
$std->dmdev[0]->ideestablot[0]->codlotacao = 'qlkjakljwj'; //Obrigatório
$std->dmdev[0]->ideestablot[0]->qtddiasav = 20; //Opcional

//Informações relativas à remuneração do trabalhador no período de apuração.
$std->dmdev[0]->ideestablot[0]->remunperapur[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->matricula = 'kjsksjksjskjsk'; //Opcional
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->indsimples = 1; //Opcional

//Rubricas que compõem a remuneração do trabalhador.
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->codrubr = 'ksksksks'; //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->idetabrubr = 'j2j2j'; //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->qtdrubr = 150.30; //Opcional
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->fatorrubr = 1.20; //Opcional
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->vrrubr = 123.90; //Obrigatório
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->itensremun[0]->indapurir = 0; //Opcional

//Grupo referente ao detalhamento do grau de exposição do trabalhador aos agentes nocivos que ensejam a cobrança
//da contribuição adicional para financiamento dos benefícios de aposentadoria especial.
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->infoagnocivo = new \stdClass(); //Opcional
$std->dmdev[0]->ideestablot[0]->remunperapur[0]->infoagnocivo->grauexp = 4; //Obrigatório

//Identificação do instrumento ou situação ensejadora da
//remuneração relativa a períodos de apuração anteriores
$std->dmdev[0]->ideadc[0] = new \stdClass(); //Opcional
$std->dmdev[0]->ideadc[0]->dtacconv = '2016-12-10';  //Opcional
$std->dmdev[0]->ideadc[0]->tpacconv = 'A'; //Obrigatório
$std->dmdev[0]->ideadc[0]->dsc = 'descricao'; //Obrigatório
$std->dmdev[0]->ideadc[0]->remunsuc = 'S'; //Obrigatório

//Identificação do período ao qual se referem as diferenças
//de remuneração.
$std->dmdev[0]->ideadc[0]->ideperiodo[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->perref = '2017-01'; //Obrigatório

//dentificação do estabelecimento e da lotação ao qual se
//referem as diferenças de remuneração do mês identificado
//no grupo superior.
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->tpinsc = "1"; //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->nrinsc = '12345678901234'; //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->codlotacao = 'ksjskjkjskjjs'; //Obrigatório

//Informações relativas à remuneração do trabalhador em períodos anteriores.
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->matricula = 'kjskjskjskjs'; //Opcional
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->indsimples = 1; //Opcional

//Rubricas que compõem a remuneração do trabalhador.
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0] = new \stdClass(); //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->codrubr = 'aaaaa'; //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->idetabrubr = 'bbbbb'; //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->qtdrubr = 12.65; //Opcional
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->fatorrubr = 2.99; //Opcional
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->vrrubr = 169.99; //Obrigatório
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->itensremun[0]->indapurir = 0; //Opcional

//Grupo referente ao detalhamento do grau de exposição do trabalhador aos agentes nocivos que ensejam a cobrança
//da contribuição adicional para financiamento dos benefícios de aposentadoria especial.
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->infoagnocivo = new \stdClass(); //Opcional
$std->dmdev[0]->ideadc[0]->ideperiodo[0]->ideestablot[0]->remunperant[0]->infoagnocivo->grauexp = 2;  //Obrigatório

//Grupo preenchido exclusivamente quando o evento de
//remuneração se referir a trabalhador cuja categoria não
//estiver obrigada ao evento de início de TSVE e se não
//houver evento S-2300 correspondente.
$std->dmdev[0]->infocomplcont = new \stdClass(); //Opcional
$std->dmdev[0]->infocomplcont->codcbo = '123456'; //Obrigatório
$std->dmdev[0]->infocomplcont->natatividade = 1; //Obrigatório
$std->dmdev[0]->infocomplcont->qtddiastrab = 14; //Obrigatório

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtRemun(
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
