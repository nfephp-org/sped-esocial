<?php

namespace NFePHP\eSocial\Common;

use DateTime;
use NFePHP\Common\Certificate;

class Tools
{
    const EVT_INICIAIS = 1;

    const EVT_NAO_PERIODICOS = 2;

    const EVT_PERIODICOS = 3;

    /**
     * @var string
     */
    protected $path;
    /**
     * @var DateTime
     */
    protected $date;
    /**
     * @var int
     */
    protected $tpInsc;
    /**
     * @var string
     */
    protected $nrInsc;
    /**
     * @var string
     */
    protected $nmRazao;
    /**
     * @var int
     */
    protected $tpAmb;
    /**
     * @var string
     */
    protected $verProc;
    /**
     * @var string
     */
    protected $eventoVersion;
    /**
     * @var string
     */
    protected $serviceVersion;
    /**
     * @var string
     */
    protected $layoutStr;
    /**
     * @var string
     */
    protected $serviceStr;
    /**
     * @var array
     */
    protected $serviceXsd = [];
    /**
     * @var Certificate
     */
    protected $certificate;
    /**
     * @var int
     */
    protected $transmissortpInsc;
    /**
     * @var string
     */
    protected $transmissornrInsc;
    /**
     * @var array
     */
    protected $eventGroup = [
        1 => 'EVENTOS INICIAIS',
        2 => 'EVENTOS NÃO PERIÓDICOS',
        3 => 'EVENTOS PERIÓDICOS',
    ];

    /**
     * @var array
     */
    protected $grupos = [
        1 => [ //EVENTOS INICIAIS grupo [1]
            'S-1000',
            'S-1005',
            'S-1010',
            'S-1020',
            'S-1030',
            'S-1035',
            'S-1040',
            'S-1050',
            'S-1060',
            'S-1070',
            'S-1080',
        ],
        2 => [ //EVENTOS NÃO PERIÓDICOS grupo [2]
            'S-2190',
            'S-2200',
            'S-2205',
            'S-2206',
            'S-2210',
            'S-2220',
            'S-2221',
            'S-2230',
            'S-2240',
            'S-2245',
            'S-2250',
            'S-2260',
            'S-2298',
            'S-2299',
            'S-2300',
            'S-2306',
            'S-2399',
            'S-2400',
            'S-2405',
            'S-2410',
            'S-2416',
            'S-2418',
            'S-2420',
            'S-3000',
            'S-4000',
            'S-5001',
            'S-5002',
            'S-5003',
            'S-5011',
            'S-5012',
            'S-5013',
        ],
        3 => [ //EVENTOS PERIÓDICOS grupo [3]
            'S-1200',
            'S-1202',
            'S-1207',
            'S-1210',
            'S-1250',
            'S-1260',
            'S-1270',
            'S-1280',
            'S-1295',
            'S-1298',
            'S-1299',
            'S-1300',
        ],
    ];

    /**
     * Constructor
     * @param string $config
     * @param Certificate $certificate
     */
    public function __construct(
        $config,
        Certificate $certificate
    ) {
        //set properties from config
        $stdConf = json_decode($config);
        $this->tpAmb = $stdConf->tpAmb;
        $this->verProc = $stdConf->verProc;
        $this->eventoVersion = $stdConf->eventoVersion;
        $this->serviceVersion = $stdConf->serviceVersion;
        $this->date = new DateTime();
        $this->tpInsc = $stdConf->empregador->tpInsc;
        $this->nrInsc = $stdConf->empregador->nrInsc;
        $this->nmRazao = $stdConf->empregador->nmRazao;
        $this->transmissortpInsc = $stdConf->transmissor->tpInsc;
        $this->transmissornrInsc = $stdConf->transmissor->nrInsc;
        $this->layoutStr = $this->stringfyVersions($stdConf->eventoVersion);
        $this->serviceStr = $this->stringfyVersions($stdConf->serviceVersion, 1);
        $this->certificate = $certificate;
        $this->path = realpath(__DIR__ . '/../../') . '/';
        $this->serviceXsd = XsdSeeker::seek(
            $this->path."schemes/comunicacao/$this->serviceStr/"
        );
    }

    /**
     * Stringfy layout number
     * @param string $version
     * @param int $length
     * @return string
     */
    protected function stringfyVersions($version, $length = 2)
    {
        $fils = explode('.', $version);
        $str  = 'v';
        foreach ($fils as $fil) {
            $str .= str_pad($fil, $length, '0', STR_PAD_LEFT) . '_';
        }
        return substr($str, 0, -1);
    }
}
