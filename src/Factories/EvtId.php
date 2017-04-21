<?php

namespace NFePHP\eSocial\Factories;

use DateTime;

class EvtId
{
    /**
     * Build Id of eSocial event
     * @param int $tipo
     * @param string $docnum
     * @param DateTime $data
     * @param int $seq
     * @return string
     */
    public static function build(
        $doctype,
        $docnum,
        DateTime $date,
        $sequential = 1
    ) {
        if (empty($seq)) {
            $seq = 1;
        }
        return "ID"
            . $doctype
            . str_pad($docnum, 14, '0', STR_PAD_RIGHT)
            . $date->format('YmdHis')
            . str_pad($sequential, 5, '0', STR_PAD_LEFT);
    }
}
