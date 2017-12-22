<?php

namespace NFePHP\eSocial\Common;

class Sanitize
{
    /**
     * Remove html entities from text
     * @param string $text
     * @return string
     */
    public static function text($text)
    {
        return htmlentities($text, ENT_QUOTES, 'UTF-8', false);
    }
}
