# TOOLS

A classe Tools::class é a responsável por receber os eventos e providenciar a sua asisnatura e envio aos webservices do eSocial.

## FORMA DE USO

```php

use NFePHP\eSocial\Tools;
use NFePHP\Common\Certificate;

$certificado = Certificate::readPfx($pfxContent, $pfxPassword);

$esoc = new Tools($configJson, $certificado);
```



