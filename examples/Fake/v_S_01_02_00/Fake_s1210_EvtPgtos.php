<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\eSocial\Event;

$config = [
    'tpAmb' => 2,
    //tipo de ambiente 1 - Produção; 2 - Produção restrita - dados reais;3 - Produção restrita - dados fictícios.
    'verProc' => 'S_1.2.0',
    //Versão do processo de emissão do evento. Informar a versão do aplicativo emissor do evento.
    'eventoVersion' => 'S.1.2.0',
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
$std->nrrecibo = null; //Opcional
$std->perapur = '2017-12';  //Obrigatório
$std->indguia = 1; //Opcional
$std->cpfbenef = '12345678901';  //Obrigatório

//Informações dos pagamentos efetuados.
$std->infopgto[0] = new \stdClass(); //Obrigatório
$std->infopgto[0]->dtpgto = '2018-01-15';  //Obrigatório
$std->infopgto[0]->tppgto = 4;  //Obrigatório
$std->infopgto[0]->perref = '2020';  //Obrigatório
$std->infopgto[0]->idedmdev = 'sjksjskjslsjksjsj';  //Obrigatório
$std->infopgto[0]->vrliq = 1000.33;  //Obrigatório
$std->infopgto[0]->paisresidext = '001'; //opcional
//Informar o código do país de residência para fins fiscais, quando no exterior, conforme Tabela 06.
//Somente informar este campo caso o país de residência para fins fiscais seja diferente de Brasil. Se não informado,
//implica que o país de residência fiscal é Brasil.
//O campo apenas pode ser preenchido se {perApur}(1210_ideEvento_perApur) >= [2023-03]. Se informado, deve ser um
// código válido e existente na Tabela 06, exceto [105].

$std->infopgto[0]->infopgtoext = new \stdClass(); //Opcional
//Informações complementares relativas a pagamentos a residente fiscal no exterior.
//CONDICAO_GRUPO: O (se {paisResidExt}(../paisResidExt) for informado); N (nos demais casos)
$std->infopgto[0]->infopgtoext->indnif = 1; //Obrigatório
//Indicativo do Número de Identificação Fiscal (NIF).
//1 - Beneficiário com NIF
//2 - Beneficiário dispensado do NIF
//3 - País não exige NIF
$std->infopgto[0]->infopgtoext->nifbenef = 'ABC1234'; //Opcional
//Número de Identificação Fiscal (NIF).
//Preenchimento obrigatório se {indNIF}(./indNIF) = [1].
$std->infopgto[0]->infopgtoext->frmtribut = '11'; //Obrigatório
//Forma de tributação, conforme opções disponíveis na Tabela 30.
//Deve ser um código válido e existente na Tabela 30

$std->infopgto[0]->infopgtoext->endext = new \stdClass(); //Opcional
//Endereço do beneficiário residente ou domiciliado no exterior.
//CONDICAO_GRUPO: OC
$std->infopgto[0]->infopgtoext->endext->enddsclograd = "5 AVE"; //Opcional
//Descrição do logradouro
$std->infopgto[0]->infopgtoext->endext->endnrlograd = "2222"; //Opcional
//Número do logradouro.
//Devem ser utilizados apenas caracteres alfanuméricos com, pelo menos, um caractere numérico.
$std->infopgto[0]->infopgtoext->endext->endcomplem = "Box 1201"; //Opcional
//Complemento do endereço
$std->infopgto[0]->infopgtoext->endext->endbairro = "Down Town"; //Opcional
//Nome do bairro/distrito.
$std->infopgto[0]->infopgtoext->endext->endcidade = "New York"; //Opcional
//Nome da cidade.
$std->infopgto[0]->infopgtoext->endext->endestado = "NY"; //Opcional
//Nome da província/estado.
$std->infopgto[0]->infopgtoext->endext->endcodpostal = "01234"; //Opcional
//Código de Endereçamento Postal.
//Devem ser informados apenas caracteres numéricos.
$std->infopgto[0]->infopgtoext->endext->telef = "55555555555"; //Opcional
//Número do telefone.
//Devem ser informados apenas caracteres numéricos

$std->infoircomplem = new \stdClass(); //opcional informações relacionadas à retenção na fonte, aos rendimentos tributáveis e não tributáveis, deduções e/ou isenções, etc., de acordo com a legislação aplicada ao imposto de renda.
$std->infoircomplem->dtlaudo = '2023-08-04'; //opcional

$std->infoircomplem->infodep[0] = new \stdClass();//opcional array com até 999 elementos Informações de dependentes não cadastrados
$std->infoircomplem->infodep[0]->cpfdep = '12345678901'; //obrigatório CPF do dependente
$std->infoircomplem->infodep[0]->dtnascto = '2021-02-28'; //opcional data de nascimento do dependente
$std->infoircomplem->infodep[0]->nome = 'Zezinho da Silva'; //opcional nome do dependente 2-70 caracteres
$std->infoircomplem->infodep[0]->depirrf = 'S'; //
$std->infoircomplem->infodep[0]->tpdep = '03'; //opcional tipo de dependente vide tabela 07
$std->infoircomplem->infodep[0]->descrdep = "bla bla"; //opcional descrição da dependência. apenas se tpDep = 99

$std->infoircomplem->infoircr[0] = new \stdClass();//opcional array com até 99 elementos Informações de Imposto de Renda, por Código de Receita
$std->infoircomplem->infoircr[0]->tpcr = '056111'; //obrigatório codigo da receita
//056107 - IRRF mensal, 13° salário e férias sobre trabalho assalariado no país ou ausente no exterior a serviço do aís, exceto se contratado por empregador doméstico ou por segurado especial sujeito a recolhimento unificado
//056108 - IRRF mensal e férias - Empregado doméstico
//056109 - IRRF 13° salário na rescisão de contrato de trabalho - Empregado doméstico
//056110 - IRRF - Empregado doméstico 13º salário
//056111 - IRRF - Empregado/Trabalhador rural - Segurado especial
//056112 - IRRF - Empregado/Trabalhador rural - Segurado especial 13° salário
//056113 - IRRF - Empregado/Trabalhador rural - Segurado especial 13° salário rescisório
//058806 - IRRF sobre rendimento do trabalho sem vínculo empregatício
//061001 - IRRF sobre rendimentos relativos a prestação de serviços de transporte rodoviário internacional de carga, pagos a transportador autônomo PF residente no Paraguai
//353301 - Proventos de aposentadoria, reserva, reforma ou pensão pagos por previdência pública
//356201 - IRRF sobre participação dos trabalhadores em lucros ou resultados - PLR
//188901 - Rendimentos Recebidos Acumuladamente - RRA
//047301 - IRRF - Residentes no exterior, para fins fiscais

$std->infoircomplem->infoircr[0]->deddepen[0] = new \stdClass();//opcional array com até 999 elementos Dedução do rendimento tributável relativa a dependentes
$std->infoircomplem->infoircr[0]->deddepen[0]->tprend = '11'; //obrigatório Tipo de rendimento.
//11 - Remuneração mensal
//12 - 13º salário
//13 - Férias
$std->infoircomplem->infoircr[0]->deddepen[0]->cpfdep = '12345678901'; //obrigatório Número de inscrição no CPF.
$std->infoircomplem->infoircr[0]->deddepen[0]->vlrdeddep = 100.00; //obrigatório valor da dedução da base de cálculo

$std->infoircomplem->infoircr[0]->penalim[0] = new \stdClass();//opcional array com até 99 elementos Informação dos beneficiários da pensão alimentícia.
$std->infoircomplem->infoircr[0]->penalim[0]->tprend = '11'; //obrigatório tipo de rendimento
//11 - Remuneração mensal
//12 - 13º salário
//13 - Férias
//14 - PLR
//18 - RRA
//79 - Rendimento isento ou não tributável
$std->infoircomplem->infoircr[0]->penalim[0]->cpfdep = '12345678901'; //obrigatório Número do CPF do dependente/beneficiário da pensão alimentícia.
$std->infoircomplem->infoircr[0]->penalim[0]->vlrdedpenalim = 250.00; //obrigatório dedução do rendimento tributável correspondente a pagamento de pensão alimentícia.

$std->infoircomplem->infoircr[0]->previdcompl[0] = new \stdClass();//opcional array com até 99 elementos Informações relativas a planos de previdência complementar
$std->infoircomplem->infoircr[0]->previdcompl[0]->tpprev = '1'; //obrigatório Tipo de previdência complementar.
//1 - Privada: codIncIRRF em S-1010 = [46, 47, 48]
//2 - FAPI: codIncIRRF em S-1010 = [61, 62, 66]
//3 - Funpresp: codIncIRRF em S-1010 = [63, 64, 65]
$std->infoircomplem->infoircr[0]->previdcompl[0]->cnpjentidpc = '12345678901234'; //obrigatório Número de CNPJ da entidade de previdência complementar.
$std->infoircomplem->infoircr[0]->previdcompl[0]->vlrdedpc = 250.00; //obrigatprio Valor da dedução relativa a previdência complementar.
$std->infoircomplem->infoircr[0]->previdcompl[0]->vlrpatrocfunp = 800.00; //opcional Valor da contribuição do ente público patrocinador da Fundação de Previdência Complementar do Servidor Público (Funpresp).

$std->infoircomplem->infoircr[0]->infoprocret[0] = new \stdClass();//opcional array com até 50 elementos
$std->infoircomplem->infoircr[0]->infoprocret[0]->tpprocret = '1'; //obrigatório código correspondente ao tipo de processo. 1 - Administrativo 2 - Judicial
$std->infoircomplem->infoircr[0]->infoprocret[0]->nrprocret = '12345678901234567'; //obrigatório número do processo administrativo/judicial. 17, 20 ou 21 caract
$std->infoircomplem->infoircr[0]->infoprocret[0]->codsusp = '1'; //opcional Código do indicativo da suspensão, atribuído pelo empregador em S-1070. 1 a 14 digitos

$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0] = new \stdClass();//opcional array com até 2 elementos
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->indapuracao = '1'; //obrigatório Indicativo de período de apuração. 1 - Mensal 2 - Anual (13° salário)
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->vlrnretido = 11.11; //opcional Valor da retenção que deixou de ser efetuada em função de processo administrativo ou judicial.
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->vlrdepjud = 22.22; //opcional Valor do depósito judicial em função de processo administrativo ou judicial.
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->vlrcmpanocal = 33.33; //opcional Valor da compensação relativa ao ano calendário em função de processo judicial.
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->vlrrendsusp = 44.44; //opcioanl Valor do rendimento com exigibilidade suspensa.

$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->dedsusp[0] = new \stdClass();//opcional array com até 25 elementos
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->indtpdeducao = '1'; //obrigatório Indicativo do tipo de dedução.
//1 - Previdência oficial
//2 - Previdência privada
//3 - Fundo de Aposentadoria Programada Individual - FAPI
//4 - Fundação de Previdência Complementar do Servidor Público - Funpresp
//5 - Pensão alimentícia
//7 - Dependentes
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->vlrdedsusp = 55.55; //opcional Valor da dedução da base de cálculo do imposto de renda com exigibilidade suspensa.
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->cnpjentidpc = '12345678901234'; //opcional CNPJ da entidade de previdência complementar
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->vlrpatrocfunp = 55.55; //opcional Valor da contribuição do ente público patrocinador da Fundação de Previdência Complementar do Servidor Público (Funpresp).

$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->benefpen[0] = new \stdClass();//opcional array com até 99 elementos
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->benefpen[0]->cpfdep = '12345678901'; //obrigatório Número de inscrição no CPF.
$std->infoircomplem->infoircr[0]->infoprocret[0]->infovalores[0]->dedsusp[0]->benefpen[0]->vlrdepensusp = 66.66; //obrigatório Valor da dedução relativa a dependentes ou a pensão alimentícia com exigibilidade suspensa.

$std->infoircomplem->plansaude[0] = new \stdClass();//opcional array com até 99 elementos
$std->infoircomplem->plansaude[0]->cnpjoper = '12345678901234'; //obrigatório CNPJ da operadora de plano privado coletivo empresarial de assistência à saúde
$std->infoircomplem->plansaude[0]->regans = '345611'; //opcional  Registro na Agência Nacional de Saúde - ANS. 6 caracteres
$std->infoircomplem->plansaude[0]->vlrsaudetit = 1200.00; //obrigatório Valor relativo à dedução do rendimento tributável correspondente a pagamento a plano de saúde do titular

$std->infoircomplem->plansaude[0]->infodepsau[0] = new \stdClass();//opcional array com até 99 elementos
$std->infoircomplem->plansaude[0]->infodepsau[0]->cpfdep = '12345678901'; //obrigatório Número de inscrição no CPF do dependente do plano de saúde.
$std->infoircomplem->plansaude[0]->infodepsau[0]->vlrsaudedep = 500.00; //obrigatório Valor relativo a dedução do rendimento tributável correspondente a pagamento a plano de saúde do     dependente.

$std->infoircomplem->inforeembmed[0] = new \stdClass();//opcional array com até 99 elementos
$std->infoircomplem->inforeembmed[0]->indorgreemb = '1'; //obrigatório indicativo da origem do reembolso.
//1 - Reembolso efetuado pelo empregador no âmbito do plano de saúde (a operadora reembolsa o empregador)
//2 - Reembolso efetuado pelo empregador como benefício do próprio empregador
$std->infoircomplem->inforeembmed[0]->cnpjoper = '12345678901234';
$std->infoircomplem->inforeembmed[0]->regans = '123456'; //opcional Registro na Agência Nacional de Saúde - ANS. 6 caract

$std->infoircomplem->inforeembmed[0]->detreembtit[0] = new \stdClass();//opcional array com até 99 elementos
$std->infoircomplem->inforeembmed[0]->detreembtit[0]->tpinsc = '1'; //obrigatório correspondente ao tipo de inscrição do prestador de serviços.
//1 - CNPJ
//2 - CPF
$std->infoircomplem->inforeembmed[0]->detreembtit[0]->nrinsc = '12345678901234'; //obrigatório número de inscrição do prestador de serviços de assistência médica, de acordo com o tipo de inscrição
$std->infoircomplem->inforeembmed[0]->detreembtit[0]->vlrreemb = 245.67; //obrigatório Valor do reembolso relativo ao ano do período indicado
$std->infoircomplem->inforeembmed[0]->detreembtit[0]->vlrreembant = 100.00; //obrigatório Valor do reembolso relativo a anos anteriores.

$std->infoircomplem->inforeembmed[0]->inforeembdep[0] = new \stdClass();//opcional array com até 99 elementos
$std->infoircomplem->inforeembmed[0]->inforeembdep[0]->cpfbenef = '12345678901'; //obrigatório

$std->infoircomplem->inforeembmed[0]->inforeembdep[0]->detreembdep[0] = new \stdClass();//opcional array com até 99 elementos
$std->infoircomplem->inforeembmed[0]->inforeembdep[0]->detreembdep[0]->tpinsc = '1'; //obrigatório correspondente ao tipo de inscrição do prestador de serviços.
//1 - CNPJ
//2 - CPF
$std->infoircomplem->inforeembmed[0]->inforeembdep[0]->detreembdep[0]->nrinsc = '12345678901234'; //obrigatório número de inscrição do prestador de serviços de assistência médica, de acordo com o tipo de inscrição
$std->infoircomplem->inforeembmed[0]->inforeembdep[0]->detreembdep[0]->vlrreemb = 245.67; //opcional Valor do reembolso relativo ao ano do período indicado
$std->infoircomplem->inforeembmed[0]->inforeembdep[0]->detreembdep[0]->vlrreembant = 100.00; //opcional Valor do reembolso relativo a anos anteriores.

try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtPgtos(
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
