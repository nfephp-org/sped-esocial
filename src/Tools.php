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
use NFePHP\Common\Soap\SoapCurl;
use NFePHP\Common\Soap\SoapInterface;
use RuntimeException;

class Tools extends ToolsBase
{
    /**
     * @var string
     */
    protected $envelopeVersion = "1.1.0";

    /**
     * @var NFePHP\Common\Soap\SoapInterface
     */
    protected $soap;
    protected $soapnamespaces = [
        'xmlns:xsi' => "http://www.w3.org/2001/XMLSchema-instance",
        'xmlns:xsd' => "http://www.w3.org/2001/XMLSchema",
        'xmlns:soap' => "http://www.w3.org/2003/05/soap-envelope"
    ];
    protected $tpAmb;
    /**
     * @var \SOAPHeader
     */
    protected $objHeader;
    protected $xmlns;
    protected $uri;
    protected $action;
    protected $method;
    protected $parameters;
    public $lastResponse;

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
     * Set envelope version and return it
     * @param string $version
     * @return string
     */
    public function setEnvelopeVersion($version = null)
    {
        if (!empty($version)) {
            $this->envelopeVersion = $version;
        }
        return $this->envelopeVersion;
    }
    
    /**
     * Event batch query
     * @param string $protocolo
     * @return string
     */
    public function consultarLoteEventos($protocolo)
    {
        $xmlns = "http://www.esocial.gov.br/servicos/empregador/lote/eventos/envio/consulta/retornoProcessamento/v1_1_0";
        $this->action = "http://www.esocial.gov.br/servicos/empregador/lote/eventos/envio/consulta/retornoProcessamento/v1_1_0/ServicoConsultarLoteEventos/ConsultarLoteEventos";
        $this->method = "ConsultarLoteEventos";
        $this->uri = "https://webservices.producaorestrita.esocial.gov.br/servicos/empregador/consultarloteeventos/WsConsultarLoteEventos.svc";
        $request = "<ConsultarLoteEventos xmlns=\"$xmlns\">"
            . "<consulta>"
            . "<eSocial xmlns=\"http://www.esocial.gov.br/schema/lote/eventos/envio/consulta/retornoProcessamento/v1_0_0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
            . "<consultaLoteEventos>"
            . "<protocoloEnvio>$protocolo</protocoloEnvio>"
            . "</consultaLoteEventos>"
            . "</eSocial>"    
            . "</consulta>"
            . "</ConsultarLoteEventos>";
        $parameters = ['' => $request];
        $this->lastResponse = $this->sendRequest($request, $parameters); 
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
        foreach($eventos as $evt) {
            //verifica se o evento pertence ao grupo indicado
            if (in_array($evt->alias, $this->grupos[$grupo])) {
                
            }
        }
        
        $xmlns = "http://www.esocial.gov.br/servicos/empregador/lote/eventos/envio/v1_1_0";
        $this->method = "EnviarLoteEventos";
        $this->action = "http://www.esocial.gov.br/servicos/empregador/lote/eventos/envio/v1_1_0/ServicoEnviarLoteEventos/EnviarLoteEventos";
        $this->uri = "https://webservices.producaorestrita.esocial.gov.br/servicos/empregador/enviarloteeventos/WsEnviarLoteEventos.svc";
        $request = "<EnviarLoteEventos xmlns=\"$xmlns\">"
           . "<loteEventos>"
           . "<eSocial xmlns=\"http://www.esocial.gov.br/schema/lote/eventos/envio/v1_1_0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">"
           . "<envioLoteEventos grupo=\"$grupo\">"
           . "<ideEmpregador>"
           . "<tpInsc>0</tpInsc>"
           . "<nrInsc>nrInsc</nrInsc>"
           . "</ideEmpregador>"
           . "<ideTransmissor>"
           . "<tpInsc>0</tpInsc>"
           . "<nrInsc>nrInsc</nrInsc>"
           . "</ideTransmissor>"
           . "<eventos>"
           . "<evento Id=\"idvalue0\">"
           . "$xml"
           . "</evento>"
           . "</eventos>"
           . "</envioLoteEventos>"
           . "</eSocial>"
           . "</loteEventos>"
           . "</EnviarLoteEventos>";

        $parameters = ['' => $request];
        $this->lastResponse = $this->sendRequest($request, $parameters); 
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
