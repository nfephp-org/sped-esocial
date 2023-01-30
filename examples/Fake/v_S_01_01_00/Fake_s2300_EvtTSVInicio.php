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
//$std->sequencial = 1;
$std->indretif = 1; //Obrigatório
$std->nrrecibo = '1.1.1234567890123456789'; //Opcional

//Informações do trabalhador.
$std->cpftrab = '12345678901'; //Obrigatório
$std->nmtrab = 'Fulano de Tal'; //Obrigatório
$std->sexo = 'M'; //Obrigatório
$std->racacor = 2; //Obrigatório
$std->estciv = 3; //Opcional
$std->grauinstr = '03'; //Obrigatório
$std->nmsoc = null; //Opcional
$std->dtnascto = '1996-06-11'; //Obrigatório
$std->paisnascto = '105'; //Obrigatório
$std->paisnac = '105'; //Obrigatório

$std->endereco = new \stdClass(); //Obrigatório
//Endereço no Brasil.
$std->endereco->brasil = new \stdClass(); //Opcional
$std->endereco->brasil->tplograd = 'R'; //Opcional
$std->endereco->brasil->dsclograd = 'Av. Paulista'; //Obrigatório
$std->endereco->brasil->nrlograd = '1850'; //Obrigatório
$std->endereco->brasil->complemento = "apto 123"; //Opcional
$std->endereco->brasil->bairro = 'Bela Vista'; //Opcional
$std->endereco->brasil->cep = '01311200'; //Obrigatório
$std->endereco->brasil->codmunic  = '3550308'; //Obrigatório
$std->endereco->brasil->uf = 'SP'; //Obrigatório

//Endereço no exterior.
$std->endereco->exterior = new \stdClass(); //Opcional
$std->endereco->exterior->paisresid = '108'; //Obrigatório
$std->endereco->exterior->dsclograd = '5 Av'; //Obrigatório
$std->endereco->exterior->nrlograd = '2222'; //Obrigatório
$std->endereco->exterior->complemento = 'Apto 200'; //Opcional
$std->endereco->exterior->bairro = 'Manhattan'; //Opcional
$std->endereco->exterior->nmcid = 'New York'; //Obrigatório
$std->endereco->exterior->codpostal  = null; //Opcional

//Informações do trabalhador imigrante.
$std->trabimig = new \stdClass(); //Opcional
$std->trabimig->tmpresid = 1; //Opcional
$std->trabimig->conding = 1; //Obrigatório

//Pessoa com deficiência.
$std->infodeficiencia = new \stdClass(); //Opcional
$std->infodeficiencia->deffisica = 'N'; //Obrigatório
$std->infodeficiencia->defvisual = 'N'; //Obrigatório
$std->infodeficiencia->defauditiva = 'N'; //Obrigatório
$std->infodeficiencia->defmental = 'N'; //Obrigatório
$std->infodeficiencia->defintelectual = 'N'; //Obrigatório
$std->infodeficiencia->reabreadap = 'N'; //Obrigatório
$std->infodeficiencia->observacao = 'lkslkslkslkslkslks'; //Opcional

//Informações dos dependentes.
$std->dependente[1]  = new \stdClass(); //Opcional
$std->dependente[1]->tpdep = '01'; //Obrigatório
$std->dependente[1]->nmdep = 'Fulaninho de Tal'; //Obrigatório
$std->dependente[1]->dtnascto = '2016-11-25'; //Obrigatório
$std->dependente[1]->cpfdep = '12345678901'; //Opcional
$std->dependente[1]->depirrf = 'N'; //Obrigatório
$std->dependente[1]->depsf = 'N'; //Obrigatório
$std->dependente[1]->inctrab = 'N'; //Obrigatório

//Informações de contato.
$std->contato = new \stdClass(); //Opcional
$std->contato->foneprinc = '1234567890'; //Opcional
$std->contato->emailprinc = 'ele@mail.com'; //Opcional

//Trabalhador Sem Vínculo de Emprego/Estatutário - TSVE - Início.
$std->cadini = 'S'; //Obrigatório
$std->matricula = '123456789'; //Opcional
$std->codcateg = '101'; //Obrigatório
$std->dtinicio = '2017-05-12'; //Obrigatório
$std->nrproctrab = null; //Opcional
$std->natatividade = 2; //Opcional

//Grupo que apresenta o cargo e/ou função ocupada pelo TSVE.
$std->cargofuncao = new \stdClass(); //Opcional
$std->cargofuncao->nmcargo = 'lalalaloaoaoa'; //Opcional
$std->cargofuncao->cbocargo = '263105'; //Opcional
$std->cargofuncao->nmfuncao = 'ksksksksk sk'; //Opcional
$std->cargofuncao->cbofuncao = '263105'; //Opcional

//Informações da remuneração e periodicidade de pagamento.
$std->remuneracao = new \stdClass(); //Opcional
$std->remuneracao->vrsalfx = 1200.00; //Obrigatório
$std->remuneracao->undsalfixo = 7; //Obrigatório
$std->remuneracao->dscsalvar = 'lkklslskksl s lks lsklsks '; //Opcional

//Informações do Fundo de Garantia do Tempo de Serviço - FGTS.
$std->fgts = new \stdClass(); //Opcional
$std->fgts->dtopcfgts = '2017-05-12'; //Obrigatório

//Informações relativas ao dirigente sindical.
$std->infodirigentesindical = new \stdClass(); //Opcional
$std->infodirigentesindical->categorig = '001'; //Obrigatório
$std->infodirigentesindical->tpinsc = 1; //Opcional
$std->infodirigentesindical->nrinsc = '12345678901234'; //Opcional
$std->infodirigentesindical->dtadmorig = '2017-05-12'; //Opcional
$std->infodirigentesindical->matricorig = 'ytuytuystyst'; //Opcional
$std->infodirigentesindical->tpregtrab = 1; //Opcional
$std->infodirigentesindical->tpregprev = 2; //Obrigatório

//Informações relativas ao trabalhador cedido/em exercício em outro órgão, preenchidas exclusivamente
//pelo cessionário/órgão de destino.
$std->infotrabcedido = new \stdClass(); //Opcional
$std->infotrabcedido->categorig = '001'; //Obrigatório
$std->infotrabcedido->cnpjcednt = '12345678901234'; //Obrigatório
$std->infotrabcedido->matricced = 'lksçkçslksl'; //Obrigatório
$std->infotrabcedido->dtadmced = '2017-05-12'; //Obrigatório
$std->infotrabcedido->tpregtrab = 2; //Obrigatório
$std->infotrabcedido->tpregprev = 3; //Obrigatório

//Informações relativas a servidor público exercente de mandato eletivo.
$std->infomandelet = new \stdClass(); //Opcional

$std->infomandelet->categorig = '111'; //Obrigatório
//Preencher com o código correspondente à categoria de origem do servidor.
//Deve ser um código válido e existente na Tabela 01, diferente de [304].
$std->infomandelet->cnpjorig = '12345678901234'; //Obrigatório
//Informar o CNPJ do órgão público de origem.
$std->infomandelet->matricorig = 'A1234'; //Obrigatório
//Preencher com a matrícula do servidor no órgão público de origem.
$std->infomandelet->dtexercorig = '2023-01-01'; //Obrigatório
//Preencher com a data de exercício do servidor no órgão público de origem.
////Deve ser uma data anterior a {dtInicio}(2300_infoTSVInicio_dtInicio) e igual ou posterior a 01/01/1890.


$std->infomandelet->indremuncargo = 'S'; //Opcional
$std->infomandelet->tpregtrab = 2; //Obrigatório
$std->infomandelet->tpregprev = 3; //Obrigatório

//Informações relativas ao estagiário.
$std->infoestagiario = new \stdClass(); //Opcional
$std->infoestagiario->natestagio = 'N'; //Obrigatório
$std->infoestagiario->nivestagio = 8; //Obrigatório
$std->infoestagiario->areaatuacao = 'ksksksksk'; //Opcional
$std->infoestagiario->nrapol = 'kak228282828'; //Opcional
$std->infoestagiario->dtprevterm = '2017-12-31'; //Obrigatório

$std->infoestagiario->instensino = new \stdClass(); //Obrigatório
$std->infoestagiario->instensino->cnpjinstensino = '12345678901234'; //Opcional
$std->infoestagiario->instensino->nmrazao = 'dlkdldkldkd'; //Opcional
$std->infoestagiario->instensino->dsclograd = 'lslsppopapap'; //Opcional
$std->infoestagiario->instensino->nrlograd = '12244'; //Opcional
$std->infoestagiario->instensino->bairro = 'kakakaka'; //Opcional
$std->infoestagiario->instensino->cep = '12345678'; //Opcional
$std->infoestagiario->instensino->codmunic = '1234567'; //Opcional
$std->infoestagiario->instensino->uf = 'AC'; //Opcional

$std->infoestagiario->cnpjagntinteg = '12345678901234'; //Opcional
$std->infoestagiario->cpfsupervisor = '12345678901';  //Opcional

//Informações de mudança de CPF do trabalhador.
$std->mudancacpf = new \stdClass(); //Opcional
$std->mudancacpf->cpfant = '12345678901'; //Obrigatório
$std->mudancacpf->matriant = 'ABC1234'; //Opcional
$std->mudancacpf->dtaltcpf = '2018-11-10'; //Obrigatório
$std->mudancacpf->observacao = 'bla bla bla'; //Opcional

//Informações de afastamento do TSVE
$std->afastamento = new \stdClass(); //Opcional
$std->afastamento->dtiniafast = '2017-06-01'; //Obrigatório
$std->afastamento->codmotafast = '01'; //Obrigatório

//Informação do término do TSVE.
$std->termino = new \stdClass(); //Opcional
$std->termino->dtterm = '2017-12-31'; //Obrigatório


try {
    //carrega a classe responsavel por lidar com os certificados
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $certificate = Certificate::readPfx($content, $password);

    //cria o evento e retorna o XML assinado
    $xml = Event::evtTSVInicio(
        $configJson,
        $std,
        $certificate,
        '2017-08-03 10:37:00'
    )->toXml();

    //$xml = Evento::s2300($json, $std, $certificate)->toXML();
    //$json = Event::evtTSVInicio($configjson, $std, $certificate)->toJson();

    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo $e->getMessage();
}
