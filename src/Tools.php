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
use NFePHP\eSocial\Factories\FactoryInterface;
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
        $operationVersion = 'v1_0_0';
        $xmlns = "http://www.esocial.gov.br/servicos/empregador/lote/eventos"
            . "/envio/consulta/retornoProcessamento/$this->serviceStr";
        $this->action = "http://www.esocial.gov.br/servicos/empregador/lote"
            . "/eventos/envio/consulta/retornoProcessamento/$this->serviceStr"
            . "/ServicoConsultarLoteEventos/ConsultarLoteEventos";
        $this->method = "ConsultarLoteEventos";
        $this->uri = "https://webservices.producaorestrita.esocial.gov.br"
            . "/servicos/empregador/consultarloteeventos"
            . "/WsConsultarLoteEventos.svc";
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
        
        $body = "<ConsultarLoteEventos xmlns=\"$xmlns\">"
            . "<consulta>"
            . $request
            . "</consulta>"
            . "</ConsultarLoteEventos>";
        
        $parameters = ['' => $body];
        $this->lastRequest = $body;
        $this->lastResponse = $this->sendRequest($body, $parameters);
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
        if ($n > 50) {
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
        $operationVersion = 'v1_1_0';
        $xmlns = "http://www.esocial.gov.br/servicos/empregador/lote/eventos"
            . "/envio/$this->serviceStr";
        $this->method = "EnviarLoteEventos";
        $this->action = "http://www.esocial.gov.br/servicos/empregador/lote"
            . "/eventos/envio/$this->serviceStr/ServicoEnviarLoteEventos"
            . "/EnviarLoteEventos";
        $this->uri = "https://webservices.producaorestrita.esocial.gov.br"
            . "/servicos/empregador/enviarloteeventos/WsEnviarLoteEventos.svc";
        $request = "<eSocial xmlns=\"http://www.esocial.gov.br/schema/lote"
            . "/eventos/envio/$this->serviceStr\" "
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
            . "EnvioLoteEventos-$this->serviceStr.xsd");
        
        $body = "<EnviarLoteEventos "
            . "xmlns=\"$xmlns\">"
            . "<loteEventos>"
            . $request
            . "</loteEventos>"
            . "</EnviarLoteEventos>";
        
        $parameters = ['' => $body];
        $this->lastRequest = $body;
        $this->lastResponse = $this->sendRequest($body, $parameters);
        return $this->lastResponse;
    }
    
    protected function sendRequest($request, $parameters)
    {
        if (empty($this->soap)) {
            $this->soap = new SoapCurl($this->certificate);
        }
        
        return (string) $this->soap->send(
            $this->uri,
            $this->method,
            $this->action,
            SOAP_1_2,
            $parameters,
            $this->soapnamespaces,
            $request,
            $this->objHeader
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
