<?php

namespace NFePHP\eSocial\Common;

use DateTime;

class FactoryId
{
    /**
     * Build Id for eSocial event
     * @param int $tpInsc
     * @param string $nrInsc
     * @param DateTime|null $date
     * @param int|null $sequential
     *
     * @return string
     */
    public static function build(
        $tpInsc,
        $nrInsc,
        DateTime $date = null,
        $sequential = null
    ) {
        if (empty($sequential)) {
            $mt = str_replace('.', '', (string) microtime(true));
            $sequential = rand(0, 9) . substr($mt, -4);
        }
        if (empty($date)) {
            $date = new DateTime();
        }
        return "ID"
            . $tpInsc
            . str_pad($nrInsc, 14, '0', STR_PAD_RIGHT)
            . $date->format('YmdHis')
            . str_pad($sequential, 5, '0', STR_PAD_LEFT);
    }
}
