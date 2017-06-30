<?php

namespace NFePHP\eSocial\Common;

use NFePHP\Common\Certificate;
use DateTime;

class Tools
{
    protected $date;
    protected $tpInsc;
    protected $nrInsc;
    protected $company;
    protected $tpAmb;
    protected $verProc;
    protected $layout;
    protected $layoutStr;
    protected $certificate;
    
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

    public function __construct(
        $config,
        Certificate $certificate = null
    ) {
        //set properties from config
        $stdConf = json_decode($config);
        $this->date = new DateTime();
        $this->tpInsc = $stdConf->tpInsc;
        $this->nrInsc = $stdConf->nrInsc;
        $this->company = $stdConf->company;
        $this->tpAmb = $stdConf->tpAmb;
        $this->verProc = $stdConf->verProc;
        $this->layout = $stdConf->layout;
        $this->layoutStr = $this->strLayoutVer($stdConf->layout);
        $this->certificate = $certificate;
    }
    
    /**
     * Stringfy layout number
     * @param type $layout
     * @return string
     */
    protected function strLayoutVer($layout)
    {
        $fils = explode('.', $layout);
        $str = 'v';
        foreach ($fils as $fil) {
            $str .= str_pad($fil, 2, '0', STR_PAD_LEFT). '_';
        }
        return substr($str, 0, -1);
    }
}
