<?php

namespace NFePHP\eSocial\Common;

class Sanitize
{
    public static function text($text)
    {
        return htmlentities($text, ENT_QUOTES, 'UTF-8', false);
    }
}
