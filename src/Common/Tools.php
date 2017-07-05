<?php

namespace NFePHP\eSocial\Common;

use NFePHP\Common\Certificate;
use DateTime;

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
        3 => 'EVENTOS PERIÓDICOS'
    ];
    /**
     * @var array
     */
    protected $grupos = [
        1 => [ //EVENTOS INICIAIS grupo [1]
            'S-1000',
            'S-1010',
            'S-1020',
            'S-1030',
            'S-1040',
            'S-1050',
            'S-1060',
            'S-1070',
            'S-1080',
            'S-2100'
        ],
        2 => [ //EVENTOS NÃO PERIÓDICOS grupo [2]
            'S-2190',
            'S-2200',
            'S-2220',
            'S-2240',
            'S-2260',
            'S-2280',
            'S-2320',
            'S-2325',
            'S-2330',
            'S-2340',
            'S-2345',
            'S-2360',
            'S-2365',
            'S-2400',
            'S-2405',
            'S-2600',
            'S-2620',
            'S-2680',
            'S-2800',
            'S-2820'
        ],
        3 => [ //EVENTOS PERIÓDICOS grupo [3]
            'S-1100',
            'S-1200',
            'S-1300',
            'S-1310',
            'S-1320',
            'S-1330',
            'S-1340',
            'S-1350',
            'S-1360',
            'S-1370',
            'S-1380',
            'S-1390',
            'S-1399',
            'S-1400',
            'S-1800'
        ]
    ];

    /**
     * Constructor
     * @param string $config
     * @param Certificate $certificate
     */
    public function __construct(
        $config,
        Certificate $certificate = null
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
        
        $this->path = realpath(
            __DIR__ . '/../../'
        ).'/';
    }
    
    /**
     * Stringfy layout number
     * @param type $layout
     * @return string
     */
    protected function stringfyVersions($version, $length = 2)
    {
        $fils = explode('.', $version);
        $str = 'v';
        foreach ($fils as $fil) {
            $str .= str_pad($fil, $length, '0', STR_PAD_LEFT). '_';
        }
        return substr($str, 0, -1);
    }
}
