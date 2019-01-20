<?php

namespace NFePHP\eSocial\Common;

class XsdSeeker
{

    public static $list = [
        'ConsultaLoteEventos' => ['version' => '', 'name' => ''],
        'EnvioLoteEventos' => ['version' => '', 'name' => ''],
        'ConsultaIdentificadoresEventosEmpregador' => ['version' => '', 'name' => ''],
        'ConsultaIdentificadoresEventosTabela' => ['version' => '', 'name' => ''],
        'ConsultaIdentificadoresEventosTrabalhador' => ['version' => '', 'name' => ''],
        'RetornoEnvioLoteEventos' => ['version' => '', 'name' => ''],
        'RetornoEvento' => ['version' => '', 'name' => ''],
        'RetornoProcessamentoLote' => ['version' => '', 'name' => ''],
        'SolicitacaoDownloadEventosPorId' => ['version' => '', 'name' => ''],
        'SolicitacaoDownloadEventosPorNrRecibo' => ['version' => '', 'name' => ''],
        'WsConsultarLoteEventos' => ['version' => '', 'name' => ''],
        'WsEnviarLoteEventos' => ['version' => '', 'name' => ''],
        'WsConsultarIdentificadoresEventos' => ['version' => '', 'name' => ''],
        'WsSolicitarDownloadEventos' => ['version' => '', 'name' => ''],
    ];

    public static function seek($path)
    {
        if (!is_dir($path)) {
            return self::$list;
        }
        $arr = scandir($path);
        foreach ($arr as $filename) {
            if ($filename == '.' || $filename == '..') {
                continue;
            }
            foreach (self::$list as $key => $content) {
                $len = strlen($key);
                $chave = substr($filename, 0, $len);
                $version = self::getVersion($filename);
                if ($chave == $key) {
                    self::$list[$key] = ['version' => $version, 'name' => $filename];
                    break;
                }
            }
        }
        return self::$list;
    }

    public static function getVersion($filename)
    {
        $p = explode('-', $filename);
        $v = explode('.', $p[1]);
        return $v[0];
    }
}
