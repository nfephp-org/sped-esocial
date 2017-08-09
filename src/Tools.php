<?php

namespace NFePHP\eSocial;

/**
 * Classe Tools, performs communication with the e-Social webservice
 *
 * @category  NFePHP
 * @package   NFePHP\eSocial\Tools
 * @copyright Copyright (c) 2017
 * @license   https://www.gnu.org/licenses/lgpl-3.0.txt LGPLv3
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt GPLv3
 * @license   https://opensource.org/licenses/mit-license.php MIT
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-esocial for the canonical source repository
 */
use NFePHP\Common\Certificate;
use NFePHP\eSocial\Common\Tools as ToolsBase;
use NFePHP\eSocial\Common\FactoryInterface;
use NFePHP\eSocial\Common\Soap\SoapCurl;
use NFePHP\eSocial\Common\Soap\SoapInterface;
use NFePHP\Common\Validator;
use RuntimeException;
use InvalidArgumentException;

class Tools extends ToolsBase
{
    public $lastRequest;
    public $lastResponse;
    
    /**
     * @var NFePHP\Common\Soap\SoapInterface
     */
    protected $soap;
    protected $soapnamespaces = [
        'xmlns:xsi' => "http://www.w3.org/2001/XMLSchema-instance",
        'xmlns:xsd' => "http://www.w3.org/2001/XMLSchema",
        'xmlns:soap' => "http://www.w3.org/2003/05/soap-envelope"
    ];
    protected $objHeader;
    protected $xmlns;
    protected $uri;
    protected $action;
    protected $method;
    protected $parameters;
    protected $envelopeXmlns;



    public function __construct($config, Certificate $certificate = null)
    {
        parent::__construct($config, $certificate);
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
     * @param string $protocolo
     * @return string
     */
    public function consultarLoteEventos($protocolo)
    {
        $operationVersion = $this->serviceXsd['ConsultaLoteEventos']['version'];
        $xmlns = "http://www.esocial.gov.br/servicos/empregador/lote/eventos"
            . "/envio/consulta/retornoProcessamento/$operationVersion";
        $this->action = "http://www.esocial.gov.br/servicos/empregador/lote"
            . "/eventos/envio/consulta/retornoProcessamento/$operationVersion"
            . "/ServicoConsultarLoteEventos/ConsultarLoteEventos";
        $this->method = "ConsultarLoteEventos";
        $this->uri = "https://webservices.producaorestrita.esocial.gov.br"
            . "/servicos/empregador/consultarloteeventos"
            . "/WsConsultarLoteEventos.svc";
        $this->envelopeXmlns = [
            'xmlns:soapenv'=> "http://schemas.xmlsoap.org/soap/envelope/",
            'xmlns:v1'=> "http://www.esocial.gov.br/servicos/empregador/lote"
                . "/eventos/envio/consulta/retornoProcessamento/$operationVersion"
        ];
        $request = "<eSocial xmlns=\"http://www.esocial.gov.br/schema/lote"
            . "/eventos/envio/consulta/retornoProcessamento/$operationVersion\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
            . "<consultaLoteEventos>"
            . "<protocoloEnvio>$protocolo</protocoloEnvio>"
            . "</consultaLoteEventos>"
            . "</eSocial>";
        
        
        //validar a requisição conforme o seu respectivo XSD
        Validator::isValid($request, $this->path
            . "schemes/comunicacao/$this->serviceStr/"
            . "ConsultaLoteEventos-$operationVersion.xsd");
        
        $body = "<v1:ConsultarLoteEventos>"
            . "<v1:consulta>"
            . $request
            . "</v1:consulta>"
            . "</v1:ConsultarLoteEventos>";
        
        $this->lastRequest = $body;
        $this->lastResponse = $this->sendRequest($body);
        return $this->lastResponse;
    }
    
    /**
     * Send batch of events
     * @param integer $grupo
     * @param array $eventos
     * @return string
     */
    public function enviarLoteEventos($grupo, $eventos = [])
    {
        if (empty($eventos)) {
            return '';
        }
        $xml = "";
        $nEvt = count($eventos);
        if ($nEvt > 50) {
            throw new InvalidArgumentException(
                "O numero máximo de eventos em um lote é 50, "
                . "você está tentando enviar $nEvt eventos !"
            );
        }
        foreach ($eventos as $evt) {
            //verifica se o evento pertence ao grupo indicado
            if (!in_array($evt->alias(), $this->grupos[$grupo])) {
                throw new RuntimeException(
                    'O evento '. $evt->alias() . ' não pertence a este grupo [ '
                    . $this->eventGroup[$grupo] . ' ].'
                );
            }
            $this->checkCertificate($evt);
            $xml .= "<evento Id=\"$evt->evtid\">";
            $xml .= $evt->toXML();
            $xml .= "</evento>";
        }
        $operationVersion = $this->serviceXsd['EnvioLoteEventos']['version'];
        $xmlns = "http://www.esocial.gov.br/servicos/empregador/lote/eventos"
            . "/envio/$operationVersion";
        $this->method = "EnviarLoteEventos";
        $this->action = "http://www.esocial.gov.br/servicos/empregador/lote"
            . "/eventos/envio/$operationVersion/ServicoEnviarLoteEventos"
            . "/EnviarLoteEventos";
        $this->uri = "https://webservices.producaorestrita.esocial.gov.br"
            . "/servicos/empregador/enviarloteeventos/WsEnviarLoteEventos.svc";
        $this->envelopeXmlns = [
            'xmlns:soapenv'=> "http://schemas.xmlsoap.org/soap/envelope/",
            'xmlns:v1'=> "http://www.esocial.gov.br/servicos/empregador"
                . "/lote/eventos/envio/$operationVersion"
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
        Validator::isValid($request, $this->path
            . "schemes/comunicacao/$this->serviceStr/"
            . "EnvioLoteEventos-$operationVersion.xsd");
        
        $body = "<v1:EnviarLoteEventos>"
            . "<v1:loteEventos>"
            . $request
            . "</v1:loteEventos>"
            . "</v1:EnviarLoteEventos>";
        
        $this->lastRequest = $body;
        $this->lastResponse = $this->sendRequest($body);
        return $this->lastResponse;
    }
    
    /**
     * Send request to webservice
     * @param string $request
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
            . "<soapenv:Header/>"
            . "<soapenv:Body>"
            . $request
            . "</soapenv:Body>"
            . "</soapenv:Envelope>";
        
        $msgSize = strlen($envelope);
        $parameters = [
            "Content-Type: text/xml;charset=UTF-8",
            "SOAPAction: \"$this->action\"",
            "Content-length: $msgSize"
        ];
        
        //return $envelope;
        return (string) $this->soap->send(
            $this->method,
            $this->uri,
            $this->action,
            $envelope,
            $parameters
        );
    }


    /**
     * Verify the availability of a digital certificate.
     * If available, place it where it is needed
     * @param FactoryInterface $evento
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
}
