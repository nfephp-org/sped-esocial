<?php

namespace NFePHP\eSocial\Common;

use DateTime;

class FactoryId
{
    /**
     * Build Id for eSocial event
     * @param int $tpInsc
     * @param string $nrInsc
     * @param DateTime $date
     * @param int $sequential
     * @return string
     */
    public static function build(
        $tpInsc,
        $nrInsc,
        DateTime $date,
        $sequential = 1
    ) {
        if (empty($sequential)) {
            $sequential = 1;
        }
        return "ID"
            . $tpInsc
            . str_pad($nrInsc, 14, '0', STR_PAD_RIGHT)
            . $date->format('YmdHis')
            . str_pad($sequential, 5, '0', STR_PAD_LEFT);
    }
}
