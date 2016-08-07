<?php

namespace NFePHP\eSocial;

/**
 * Classe Response, executa a leitura dos dados retornados na comunicação
 * com o webservice do e-Social e os estrutura em um array que observa uma
 * padronizão minima para permitir o uso facilitado dos dados retornados.
 *
 * @category  NFePHP
 * @package   NFePHP\eSocial\Response
 * @copyright Copyright (c) 2016
 * @license   https://www.gnu.org/licenses/lgpl-3.0.txt LGPLv3
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt GPLv3
 * @license   https://opensource.org/licenses/mit-license.php MIT
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-esocial for the canonical source repository
 */

use DOMDocument;

class Response
{
    /**
     * Lê os retornos das consultas e envios ao webservice
     * @param string $tag Marcador espedado na resposta
     * @param string $xmlResp Envelope SOAP retornado em um string XML
     * @return array
     */
    public static function readReturn($tag = '', $xmlResp = '')
    {
        if (trim($xmlResp) == '') {
            return [
                'bStat' => false,
                'message' => 'Não retornou nenhum dado'
            ];
        }
        libxml_use_internal_errors(true);
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->loadXML($xmlResp);
        $errors = libxml_get_errors();
        libxml_clear_errors();
        if (! empty($errors)) {
            return [
                'bStat' => false,
                'message' => $xmlResp,
                'errors' => $errors
            ];
        }
        //foi retornado um xml continue
        $reason = self::checkForFault($dom);
        if ($reason != '') {
            return [
                'bStat' => false,
                'message' => $reason
            ];
        }
        //converte o xml em uma StdClass
        $std = self::xml2Obj($dom, $tag);
        return self::readRespStd($std);
    }
    
    /**
     * Retorna os dados do objeto
     * @param StdClass $std
     * @return array
     */
    protected static function readRespStd($std)
    {
        if ($std->return->status == 'ERRO') {
            return [
                'bStat' => false,
                'message' => $std->return->mensagem,
                'status' => $std->return->status
            ];
        }
        $aResp = [
            'bStat' => true,
            'message' => $std->return->mensagem,
            'status' => $std->return->status
        ];
        $dados = $std->return->dados;
        $aReg = array();
        if (property_exists($dados, 'entry')) {
            foreach ($std->return->dados->entry as $entry) {
                if (is_object($entry->value)) {
                    if (property_exists($entry->value, 'registros')) {
                        foreach ($entry->value->registros as $registro) {
                            $aReg[$registro->campo] = $registro->valor;
                        }
                    } else {
                        foreach ($entry->value as $chave => $valor) {
                            $aReg[$chave] = $valor;
                        }
                    }
                    $aResp[$entry->key] = $aReg;
                } else {
                    $aResp[$entry->key] = $entry->value;
                }
            }
        }
        return $aResp;
    }
    
    /**
     * Converte DOMDocument em uma StdClass extraindo apenas a tag desejada
     * @param DOMDocument $dom
     * @param string $tag
     * @return StdClass
     */
    protected static function xml2Obj($dom, $tag)
    {
        $node = $dom->getElementsByTagName($tag.'Response')->item(0);
        $newdoc = new DOMDocument('1.0', 'utf-8');
        $newdoc->appendChild($newdoc->importNode($node, true));
        $xml = $newdoc->saveXML();
        $newdoc = null;
        $xml = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $xml);
        $xml = str_replace('<?xml version="1.0" encoding="utf-8"?>', '', $xml);
        $resp = simplexml_load_string($xml, null, LIBXML_NOCDATA);
        $std = json_encode($resp);
        $std = str_replace('@attributes', 'attributes', $std);
        $std = json_decode($std);
        return $std;
    }
    
    /**
     * Verifica se o retorno é relativo a um ERRO SOAP
     * @param DOMDocument $dom
     * @return string
     */
    protected static function checkForFault($dom)
    {
        $tagfault = $dom->getElementsByTagName('Fault')->item(0);
        if (empty($tagfault)) {
            return '';
        }
        $tagreason = $tagfault->getElementsByTagName('Reason')->item(0);
        if (! empty($tagreason)) {
            $reason = $tagreason->getElementsByTagName('Text')->item(0)->nodeValue;
            return $reason;
        }
        return 'Houve uma falha na comunicação.';
    }
}
