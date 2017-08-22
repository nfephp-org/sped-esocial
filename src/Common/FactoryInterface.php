<?php

namespace NFePHP\eSocial\Common;

use NFePHP\Common\Certificate;

interface FactoryInterface
{
    public function alias();

    public function toXML();

    public function toJson();

    public function toStd();

    public function toArray();

    public function getCertificate();

    public function setCertificate(Certificate $certificate);
}
