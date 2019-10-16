<?php

namespace NFePHP\eSocial;

/**
 * Classe Tools, performs communication with the e-Social webservice
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright Copyright (c) 2017
 * @license   https://www.gnu.org/licenses/lgpl-3.0.txt LGPLv3
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt GPLv3
 * @license   https://opensource.org/licenses/mit-license.php MIT
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-esocial for the canonical source repository
 */
use InvalidArgumentException;
use NFePHP\Common\Certificate;
use NFePHP\Common\Validator;
use NFePHP\Common\Signer;
use NFePHP\eSocial\Common\Soap\SoapCurl;
use NFePHP\eSocial\Common\Soap\SoapInterface;
use NFePHP\eSocial\Common\FactoryInterface;
use NFePHP\eSocial\Common\Tools as ToolsBase;
use RuntimeException;

class Tools extends ToolsBase
{
    /**
     * @var string
     */
    public $lastRequest;
    /**
     * @var string
     */
    public $lastResponse;
    /**
     * @var SoapInterface
     */
    protected $soap;
    /**
     * @var array
     */
    protected $soapnamespaces = [
        'xmlns:xsi'  => "http://www.w3.org/2001/XMLSchema-instance",
        'xmlns:xsd'  => "http://www.w3.org/2001/XMLSchema",
        'xmlns:soap' => "http://www.w3.org/2003/05/soap-envelope",
    ];
    /**
     * @var \SoapHeader
     */
    protected $objHeader;
    /**
     * @var string
     */
    protected $xmlns;
    /**
     * @var string
     */
    protected $uri;
    /**
     * @var string
     */
    protected $action;
    /**
     * @var string
     */
    protected $method;
    /**
     * @var array
     */
    protected $parameters;
    /**
     * @var array
     */
    protected $envelopeXmlns;
    /**
     * @var array
     */
    protected $urlbase;
    /**
     * @var string
     */
    protected $namespace = 'http://www.esocial.gov.br/servicos';


    /**
     * Constructor
     * @param string $config
     * @param Certificate $certificate
     */
    public function __construct($config, Certificate $certificate)
    {
        parent::__construct($config, $certificate);
        //define o ambiente a ser usado
        $this->urlbase = [
            'consulta' =>  'https://webservices.producaorestrita.esocial.gov.br/'
            . 'servicos/empregador/consultarloteeventos/WsConsultarLoteEventos.svc',
            'envio' => 'https://webservices.producaorestrita.esocial.gov.br/'
            . 'servicos/empregador/enviarloteeventos/WsEnviarLoteEventos.svc',
            'identificadores' => 'https://webservices.producaorestrita.esocial.gov.br/'
            . 'servicos/empregador/dwlcirurgico/WsConsultarIdentificadoresEventos.svc',
            'downloads' => 'https://webservices.producaorestrita.esocial.gov.br/'
            . 'servicos/empregador/dwlcirurgico/WsSolicitarDownloadEventos.svc'
        ];
        if ($this->tpAmb == 1) {
            $this->urlbase = [
                'consulta' =>  'https://webservices.consulta.esocial.gov.br/'
                . 'servicos/empregador/consultarloteeventos/WsConsultarLoteEventos.svc',
                'envio' => 'https://webservices.envio.esocial.gov.br/'
                . 'servicos/empregador/enviarloteeventos/WsEnviarLoteEventos.svc',
                'identificadores' => 'https://webservices.download.esocial.gov.br/'
                . 'servicos/empregador/dwlcirurgico/WsConsultarIdentificadoresEventos.svc',
                'downloads' => 'https://webservices.download.esocial.gov.br/'
                . 'servicos/empregador/dwlcirurgico/WsSolicitarDownloadEventos.svc'
            ];
        }
    }

    /**
     * SOAP communication dependency injection
     * @param SoapInterface $soap
     */
    public function loadSoapClass(SoapInterface $soap)
    {
        $this->soap = $soap;
    }

    /**
     * Event batch query
     * @param  string $protocolo
     * @return string
     */
    public function consultarLoteEventos($protocolo)
    {
        $operationVersion = $this->serviceXsd['ConsultaLoteEventos']['version'];
        if (empty($operationVersion)) {
            throw new \InvalidArgumentException(
                'Schemas não localizados, verifique de passou as versões '
                    . 'corretamente no config.'
            );
        }
        $verWsdl = $this->serviceXsd['WsConsultarLoteEventos']['version'];
        $this->action = "{$this->namespace}/empregador/lote"
            ."/eventos/envio/consulta/retornoProcessamento/$verWsdl"
            ."/ServicoConsultarLoteEventos/ConsultarLoteEventos";
        
        $this->method = "ConsultarLoteEventos";
        $this->uri = $this->urlbase['consulta'];
        $this->envelopeXmlns = [
            'xmlns:soapenv' => "http://schemas.xmlsoap.org/soap/envelope/",
            'xmlns:v1'      => "http://www.esocial.gov.br/servicos/empregador/lote"
                ."/eventos/envio/consulta/retornoProcessamento/$verWsdl",
        ];
        $request = "<eSocial xmlns=\"http://www.esocial.gov.br/schema/lote"
            ."/eventos/envio/consulta/retornoProcessamento/"
            . $operationVersion . "\" "
            ."xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
            ."<consultaLoteEventos>"
            ."<protocoloEnvio>$protocolo</protocoloEnvio>"
            ."</consultaLoteEventos>"
            ."</eSocial>";
        
        //validar a requisição conforme o seu respectivo XSD
        Validator::isValid(
            $request,
            $this->path
            ."schemes/comunicacao/$this->serviceStr/"
            ."ConsultaLoteEventos-$operationVersion.xsd"
        );
        $body = "<v1:ConsultarLoteEventos>"
            ."<v1:consulta>"
            .$request
            ."</v1:consulta>"
            ."</v1:ConsultarLoteEventos>";
        $this->lastRequest  = $body;
        $this->lastResponse = $this->sendRequest($body);
        return $this->lastResponse;
    }
    
    /**
     * Events Identification employer query
     * @param string $tpEvt
     * @param string $perapur
     * @return string
     * @throws InvalidArgumentException
     */
    public function consultarEventosEmpregador($tpEvt, $perapur)
    {
        $operationVersion = $this->serviceXsd['ConsultaIdentificadoresEventosEmpregador']['version'];
        if (empty($operationVersion)) {
            throw new \InvalidArgumentException(
                'Schemas não localizados, verifique de passou as versões '
                    . 'corretamente no config.'
            );
        }
        $this->method = 'ConsultarIdentificadoresEventosEmpregador';
        $verWsdl = $this->serviceXsd['WsConsultarIdentificadoresEventos']['version'];
        $this->action = "{$this->namespace}/empregador/consulta/identificadores-eventos/"
        . "$verWsdl/ServicoConsultarIdentificadoresEventos/{$this->method}";
        
        $this->uri = $this->urlbase['identificadores'];
        
        $this->envelopeXmlns = [
            'xmlns:soapenv' => "http://schemas.xmlsoap.org/soap/envelope/",
            'xmlns:v1'      => "http://www.esocial.gov.br/servicos/empregador/"
            . "consulta/identificadores-eventos/$verWsdl",
        ];
        
        $request = "<eSocial xmlns=\"http://www.esocial.gov.br/schema/consulta/"
            . "identificadores-eventos/empregador/"
            . $operationVersion . "\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
            . "<consultaIdentificadoresEvts>"
            . "<ideEmpregador>"
            . "<tpInsc>{$this->tpInsc}</tpInsc>"
            . "<nrInsc>{$this->nrInsc}</nrInsc>"
            . "</ideEmpregador>"
            . "<consultaEvtsEmpregador>"
            . "<tpEvt>$tpEvt</tpEvt>"
            . "<perApur>$perapur</perApur>"
            . "</consultaEvtsEmpregador>"
            . "</consultaIdentificadoresEvts>"
            . "</eSocial>";
        
        $request = $this->sign($request);
        
        //validar a requisição conforme o seu respectivo XSD
        Validator::isValid(
            $request,
            $this->path
            ."schemes/comunicacao/$this->serviceStr/"
            ."ConsultaIdentificadoresEventosEmpregador-$operationVersion.xsd"
        );
        
        $body = "<v1:{$this->method}>"
            . "<v1:consultaEventosEmpregador>"
            . $request
            . "</v1:consultaEventosEmpregador>"
            . "</v1:{$this->method}>";
        $this->lastRequest  = $body;
        $this->lastResponse = $this->sendRequest($body);
        return $this->lastResponse;
    }
    
    /**
     * Events Identification tables query
     * @param string $tpEvt
     * @param string $chEvt
     * @param string $dtIni
     * @param string $dtFim
     * @return string
     * @throws InvalidArgumentException
     */
    public function consultarEventosTabela($tpEvt, $chEvt = null, $dtIni = null, $dtFim = null)
    {
        $operationVersion = $this->serviceXsd['ConsultaIdentificadoresEventosTabela']['version'];
        if (empty($operationVersion)) {
            throw new \InvalidArgumentException(
                'Schemas não localizados, verifique de passou as versões '
                    . 'corretamente no config.'
            );
        }
        $this->method = 'ConsultarIdentificadoresEventosTabela';
        $verWsdl = $this->serviceXsd['WsConsultarIdentificadoresEventos']['version'];
        $this->action = "{$this->namespace}/empregador/consulta/identificadores-eventos/"
        . "$verWsdl/ServicoConsultarIdentificadoresEventos/{$this->method}";

        $this->uri = $this->urlbase['identificadores'];
        
        $this->envelopeXmlns = [
            'xmlns:soapenv' => "http://schemas.xmlsoap.org/soap/envelope/",
            'xmlns:v1'      => "http://www.esocial.gov.br/servicos/empregador/"
            . "consulta/identificadores-eventos/$verWsdl",
        ];
        
        $request = "<eSocial xmlns=\"http://www.esocial.gov.br/schema/consulta/"
            . "identificadores-eventos/tabela/"
            . $operationVersion . "\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
            . "<consultaIdentificadoresEvts>"
            . "<ideEmpregador>"
            . "<tpInsc>{$this->tpInsc}</tpInsc>"
            . "<nrInsc>{$this->nrInsc}</nrInsc>"
            . "</ideEmpregador>"
            . "<consultaEvtsTabela>"
            . "<tpEvt>$tpEvt</tpEvt>";
        
        $request .= !empty($chEvt) ? "<chEvt>$chEvt</chEvt>" : "";
        $request .= !empty($dtIni) ? "<dtIni>$dtIni</dtIni>" : "";
        $request .= !empty($dtFim) ? "<dtFim>$dtFim</dtFim>" : "";
        
        $request .= "</consultaEvtsTabela>"
            . "</consultaIdentificadoresEvts>"
            . "</eSocial>";
        
        $request = $this->sign($request);
        
        //validar a requisição conforme o seu respectivo XSD
        Validator::isValid(
            $request,
            $this->path
            ."schemes/comunicacao/$this->serviceStr/"
            ."ConsultaIdentificadoresEventosTabela-$operationVersion.xsd"
        );
        $body = "<v1:{$this->method}>"
            ."<v1:consultaEventosTabela>"
            .$request
            ."</v1:consultaEventosTabela>"
            ."</v1:{$this->method}>";
            
        $this->lastRequest  = $body;
        $this->lastResponse = $this->sendRequest($body);
        return $this->lastResponse;
    }
    
    /**
     * Events Identification employee query
     * @param string $cpfTrab
     * @param string $dtIni
     * @param string $dtFim
     * @return string
     * @throws InvalidArgumentException
     */
    public function consultarEventosTrabalhador($cpfTrab, $dtIni, $dtFim)
    {
        $operationVersion = $this->serviceXsd['ConsultaIdentificadoresEventosTrabalhador']['version'];
        if (empty($operationVersion)) {
            throw new \InvalidArgumentException(
                'Schemas não localizados, verifique de passou as versões '
                    . 'corretamente no config.'
            );
        }
        $this->method = 'ConsultarIdentificadoresEventosTrabalhador';
        $verWsdl = $this->serviceXsd['WsConsultarIdentificadoresEventos']['version'];
        $this->action = "{$this->namespace}/empregador/consulta/identificadores-eventos/"
        . "$verWsdl/ServicoConsultarIdentificadoresEventos/{$this->method}";

        $this->uri = $this->urlbase['identificadores'];
        
        $this->envelopeXmlns = [
            'xmlns:soapenv' => "http://schemas.xmlsoap.org/soap/envelope/",
            'xmlns:v1'      => "http://www.esocial.gov.br/servicos/empregador/"
            . "consulta/identificadores-eventos/$verWsdl",
        ];
        
        $request = "<eSocial xmlns=\"http://www.esocial.gov.br/schema/consulta/"
            . "identificadores-eventos/trabalhador/"
            . $operationVersion . "\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
            . "<consultaIdentificadoresEvts>"
            . "<ideEmpregador>"
            . "<tpInsc>{$this->tpInsc}</tpInsc>"
            . "<nrInsc>{$this->nrInsc}</nrInsc>"
            . "</ideEmpregador>"
            . "<consultaEvtsTrabalhador>"
            . "<cpfTrab>$cpfTrab</cpfTrab>"
            . "<dtIni>$dtIni</dtIni>"
            . "<dtFim>$dtFim</dtFim>"
            . "</consultaEvtsTrabalhador>"
            . "</consultaIdentificadoresEvts>"
            . "</eSocial>";

        $request = $this->sign($request);
        
        //validar a requisição conforme o seu respectivo XSD
        Validator::isValid(
            $request,
            $this->path
            ."schemes/comunicacao/$this->serviceStr/"
            ."ConsultaIdentificadoresEventosTrabalhador-$operationVersion.xsd"
        );
        
        $body = "<v1:{$this->method}>"
            ."<v1:consultaEventosTrabalhador>"
            .$request
            ."</v1:consultaEventosTrabalhador>"
            ."</v1:{$this->method}>";
            
        $this->lastRequest  = $body;
        $this->lastResponse = $this->sendRequest($body);
        return $this->lastResponse;
    }
    
    /**
     * Download Event by Id
     * @param array $ids
     * @return string
     * @throws InvalidArgumentException
     */
    public function downloadEventosPorId($ids)
    {
        $operationVersion = $this->serviceXsd['SolicitacaoDownloadEventosPorId']['version'];
        if (empty($operationVersion)) {
            throw new \InvalidArgumentException(
                'Schemas não localizados, verifique de passou as versões '
                    . 'corretamente no config.'
            );
        }

        $this->method = 'SolicitarDownloadEventosPorId';
        $verWsdl = $this->serviceXsd['WsSolicitarDownloadEventos']['version'];
        $this->action = "{$this->namespace}/empregador/download/"
        . "solicitacao/$verWsdl/ServicoSolicitarDownloadEventos/{$this->method}";
        
        $this->uri = $this->urlbase['downloads'];
        
        $this->envelopeXmlns = [
            'xmlns:soapenv' => "http://schemas.xmlsoap.org/soap/envelope/",
            'xmlns:v1'      => "http://www.esocial.gov.br/servicos/empregador/"
            . "download/solicitacao/$verWsdl",
        ];
        
        $request = "<eSocial xmlns=\"http://www.esocial.gov.br/schema/download/"
            . "solicitacao/id/$operationVersion\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
            . "<download>"
            . "<ideEmpregador>"
            . "<tpInsc>{$this->tpInsc}</tpInsc>"
            . "<nrInsc>{$this->nrInsc}</nrInsc>"
            . "</ideEmpregador>"
            . "<solicDownloadEvtsPorId>";
        foreach ($ids as $id) {
            $request .= "<id>$id</id>";
        }
        $request .= "</solicDownloadEvtsPorId>"
            . "</download>"
            . "</eSocial>";
        
        $request = $this->sign($request);
        
        //validar a requisição conforme o seu respectivo XSD
        Validator::isValid(
            $request,
            $this->path
            ."schemes/comunicacao/$this->serviceStr/"
            ."SolicitacaoDownloadEventosPorId-$operationVersion.xsd"
        );
        
        $body = "<v1:{$this->method}>"
            ."<v1:solicitacao>"
            .$request
            ."</v1:solicitacao>"
            ."</v1:{$this->method}>";
            
        $this->lastRequest  = $body;
        $this->lastResponse = $this->sendRequest($body);
        return $this->lastResponse;
    }
    
    /**
     * Download Event by receipt number
     * @param array $nrRecs
     * @return string
     * @throws InvalidArgumentException
     */
    public function downloadEventosPorNrRecibo($nrRecs)
    {
        $operationVersion = $this->serviceXsd['SolicitacaoDownloadEventosPorNrRecibo']['version'];
        if (empty($operationVersion)) {
            throw new \InvalidArgumentException(
                'Schemas não localizados, verifique de passou as versões '
                    . 'corretamente no config.'
            );
        }

        $this->method = 'SolicitarDownloadEventosPorNrRecibo';
        $verWsdl = $this->serviceXsd['WsSolicitarDownloadEventos']['version'];
        $this->action = "{$this->namespace}/empregador/download/"
        . "solicitacao/$verWsdl/ServicoSolicitarDownloadEventos/{$this->method}";
        
        $this->uri = $this->urlbase['downloads'];
        
        $this->envelopeXmlns = [
            'xmlns:soapenv' => "http://schemas.xmlsoap.org/soap/envelope/",
            'xmlns:v1'      => "http://www.esocial.gov.br/servicos/empregador/"
            . "download/solicitacao/$verWsdl",
        ];
        
        $request = "<eSocial xmlns=\"http://www.esocial.gov.br/schema/download/"
            . "solicitacao/nrRecibo/$operationVersion\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
            . "<download>"
            . "<ideEmpregador>"
            . "<tpInsc>{$this->tpInsc}</tpInsc>"
            . "<nrInsc>{$this->nrInsc}</nrInsc>"
            . "</ideEmpregador>"
            . "<solicDownloadEventosPorNrRecibo>";
        
        foreach ($nrRecs as $nrRec) {
            $request .= "<nrRec>$nrRec</nrRec>";
        }
        
        $request .= "</solicDownloadEventosPorNrRecibo>"
            . "</download>"
            . "</eSocial>";
        
        $request = $this->sign($request);
        
        //validar a requisição conforme o seu respectivo XSD
        Validator::isValid(
            $request,
            $this->path
            ."schemes/comunicacao/$this->serviceStr/"
            ."SolicitacaoDownloadEventosPorNrRecibo-$operationVersion.xsd"
        );
        
        $body = "<v1:{$this->method}>"
            ."<v1:solicitacao>"
            .$request
            ."</v1:solicitacao>"
            ."</v1:{$this->method}>";
            
        $this->lastRequest  = $body;
        $this->lastResponse = $this->sendRequest($body);
        return $this->lastResponse;
    }

    /**
     * Send request to webservice
     * @param  string $request
     * @return string
     */
    protected function sendRequest($request)
    {
        if (empty($this->soap)) {
            $this->soap = new SoapCurl($this->certificate);
        }
        $envelope = "<soapenv:Envelope ";
        foreach ($this->envelopeXmlns as $key => $xmlns) {
            $envelope .= "$key = \"$xmlns\" ";
        }
        $envelope .= ">"
            ."<soapenv:Header/>"
            ."<soapenv:Body>"
            .$request
            ."</soapenv:Body>"
            ."</soapenv:Envelope>";
        
        $msgSize    = strlen($envelope);
        $parameters = [
            "Content-Type: text/xml;charset=UTF-8",
            "SOAPAction: \"$this->action\"",
            "Content-length: $msgSize",
        ];

        // Versão do SOAP esperada é a 1.1, conforme manual do desenvolvedor eSocial versão 1.1:
        // "Alteração da versão do SOAP de 1.2 para 1.1."
        // http://portal.esocial.gov.br/institucional/manuais/manualorientacaodesenvolvedoresocialv1-7.pdf
        return (string) $this->soap->send(
            $this->method,
            $this->uri,
            $this->action,
            $envelope,
            $parameters
        );
    }

    /**
     * Send batch of events
     * @param  integer $grupo
     * @param  array $eventos
     * @return string
     */
    public function enviarLoteEventos($grupo, $eventos = [])
    {
        if (empty($eventos)) {
            return '';
        }
        $xml  = "";
        $nEvt = count($eventos);
        if ($nEvt > 50) {
            throw new InvalidArgumentException(
                "O numero máximo de eventos em um lote é 50, "
                ."você está tentando enviar $nEvt eventos !"
            );
        }
        foreach ($eventos as $evt) {
            //verifica se o evento pertence ao grupo indicado
            if (! in_array($evt->alias(), $this->grupos[$grupo])) {
                throw new RuntimeException(
                    'O evento ' . $evt->alias() . ' não pertence a este grupo [ '
                    . $this->eventGroup[$grupo] . ' ].'
                );
            }
            $this->checkCertificate($evt);
            $xml .= "<evento Id=\"$evt->evtid\">";
            $xml .= $evt->toXML();
            $xml .= "</evento>";
        }
        $operationVersion = $this->serviceXsd['EnvioLoteEventos']['version'];
        if (empty($operationVersion)) {
            throw new \InvalidArgumentException(
                'Schemas não localizados, verifique de passou as versões '
                    . 'corretamente no config.'
            );
        }
        $verWsdl = $this->serviceXsd['WsEnviarLoteEventos']['version'];
        $this->method = "EnviarLoteEventos";
        $this->action = "http://www.esocial.gov.br/servicos/empregador/lote"
            . "/eventos/envio/"
            . $verWsdl
            . "/ServicoEnviarLoteEventos"
            . "/EnviarLoteEventos";
        $this->uri = $this->urlbase['envio'];
        $this->envelopeXmlns = [
            'xmlns:soapenv' => "http://schemas.xmlsoap.org/soap/envelope/",
            'xmlns:v1'      => "http://www.esocial.gov.br/servicos/empregador"
                . "/lote/eventos/envio/$verWsdl",
        ];
        $request = "<eSocial xmlns=\"http://www.esocial.gov.br/schema/lote"
            . "/eventos/envio/$operationVersion\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
            . "<envioLoteEventos grupo=\"$grupo\">"
            . "<ideEmpregador>"
            . "<tpInsc>$this->tpInsc</tpInsc>"
            . "<nrInsc>$this->nrInsc</nrInsc>"
            . "</ideEmpregador>"
            . "<ideTransmissor>"
            . "<tpInsc>$this->transmissortpInsc</tpInsc>"
            . "<nrInsc>$this->transmissornrInsc</nrInsc>"
            . "</ideTransmissor>"
            . "<eventos>"
            . "$xml"
            . "</eventos>"
            . "</envioLoteEventos>"
            . "</eSocial>";
        //validar a requisição conforme o seu respectivo XSD
        Validator::isValid(
            $request,
            $this->path
            . "schemes/comunicacao/$this->serviceStr/"
            . "EnvioLoteEventos-$operationVersion.xsd"
        );
        $body = "<v1:EnviarLoteEventos>"
            . "<v1:loteEventos>"
            . $request
            . "</v1:loteEventos>"
            . "</v1:EnviarLoteEventos>";
        $this->lastRequest  = $body;
        $this->lastResponse = $this->sendRequest($body);
        return $this->lastResponse;
    }

    /**
     * Verify the availability of a digital certificate.
     * If available, place it where it is needed
     * @param  FactoryInterface $evento
     * @throws RuntimeException
     */
    protected function checkCertificate(FactoryInterface $evento)
    {
        if (empty($this->certificate)) {
            //try to get certificate from event
            $certificate = $evento->getCertificate();
            if (empty($certificate)) {
                //oops no certificate avaiable
                throw new \RuntimeException("Não temos um certificado disponível!");
            }
            $this->certificate = $certificate;
        } else {
            $certificate = $evento->getCertificate();
            if (empty($certificate)) {
                $evento->setCertificate($this->certificate);
            }
        }
    }
    
    protected function sign($request)
    {
        return str_replace(
            "<?xml version=\"1.0\" encoding=\"UTF-8\"?>",
            '',
            $sign = Signer::sign(
                $this->certificate,
                $request,
                'eSocial',
                '',
                OPENSSL_ALGO_SHA256,
                [false, false, null, null]
            )
        );
    }
}
