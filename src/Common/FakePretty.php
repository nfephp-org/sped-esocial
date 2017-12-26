<?php

namespace NFePHP\eSocial\Common;

class FakePretty
{
    /**
     * Show pretty html representation for response action only used for debugging
     * @param string $response
     * @param string $save complete real path to file
     * @return string
     */
    public static function prettyPrint($response, $save = '')
    {
        $std = json_decode($response);
        if (! empty($save)) {
            file_put_contents(
                "$save.xml",
                $std->body
            );
        }
        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($std->body);
        $html = "<pre>";
        $html .= '<h2>url</h2>';
        $html .= $std->url;
        $html .= "<br>";
        $html .= '<h2>operation</h2>';
        $html .= "<br>";
        $html .= $std->operation;
        $html .= "<br>";
        $html .= '<h2>action</h2>';
        $html .= $std->action;
        $html .= "<br>";
        $html .= '<h2>soapver</h2>';
        $html .= $std->soapver;
        $html .= "<br>";
        $html .= '<h2>parameters</h2>';
        foreach ($std->parameters as $key => $param) {
            $html .= "[$key] => $param <br>";
        }
        $html .= "<br>";
        $html .= '<h2>header</h2>';
        $html .= $std->header;
        $html .= "<br>";
        $html .= '<h2>namespaces</h2>';
        $an   = json_decode(json_encode($std->namespaces), true);
        foreach ($an as $key => $nam) {
            $html .= "[$key] => $nam <br>";
        }
        $html .= "<br>";
        $html .= '<h2>body</h2>';
        $html .= str_replace(
            ['<', '>'],
            ['&lt;', '&gt;'],
            str_replace(
                '<?xml version="1.0"?>',
                '<?xml version="1.0" encoding="UTF-8"?>',
                $doc->saveXML()
            )
        );
        $html .= "</pre>";
        return $html;
    }
}
