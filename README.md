# e-Social
**Biblioteca PHP para a integração de aplicativo com o projeto [SPED eSocial](http://www.esocial.gov.br/) do Ministério do Trabalho, Receita Federal e Caixa Economica Federal**

*sped-esocial* é um framework que permite a integração de um aplicativo, com os serviços do projeto do MT denominado *eSocial*, com a construção dos eventos em xml e do envio dos lotes de eventos e consultas, através de requisições SOAP, sobre SSL usando certificado digital modelo A1 (PKCS#12), pertencentes a cadeia de certificação Brasileira.

## Layout 2.5.0 (válido para uso até 09/03/2022, com alterações em eventos e outras regras com cronograma variado)

[VIDE NOTA ORIENTATIVA](https://www.gov.br/esocial/pt-br/documentacao-tecnica/manuais/nota-orientativa-s-1-0-01-2021.pdf)

## Layout S-1.0 (a partir de 10/05/2021)

### *Esta API ainda está em fase de desenvolvimento, portanto faça TESTES antes de usar*

*Utilize o chat do Gitter para iniciar discussões especificas sobre o desenvolvimento deste pacote.*

[![Chat][ico-gitter]][link-gitter]

[![Latest Stable Version][ico-stable]][link-packagist]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![License][ico-license]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

[![Issues][ico-issues]][link-issues]
[![Forks][ico-forks]][link-forks]
[![Stars][ico-stars]][link-stars]

Este pacote é aderente com os [PSR-1], [PSR-2] e [PSR-4]. Se você observar negligências de conformidade, por favor envie um patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

Não deixe de se cadastrar no [grupo de discussão do NFePHP](http://groups.google.com/group/nfephp) para acompanhar o desenvolvimento e participar das discussões e tirar duvidas!

## CRONOGRAMA PREVISTO

**Etapa 1 - Empresas com faturamento anual superior a R$ 78 milhões**

Fase 1: Janeiro/18 - Apenas informações relativas às empresas, ou seja, cadastros do empregador e tabelas

Fase 2: Março/18: Nesta fase, empresas passam a ser obrigadas a enviar informações relativas aos trabalhadores e seus vínculos com as empresas (eventos não periódicos), como admissões, afastamentos e desligamentos

Fase 3: Maio/18: Torna-se obrigatório o envio das folhas de pagamento

Fase 4: Julho/18: Substituição da GFIP (Guia de Informações à Previdência Social) e compensação cruzada

Fase 5: Janeiro/19: Na última fase, deverão ser enviados os dados de segurança e saúde do trabalhador


**Etapa 2 - Demais empresas privadas, incluindo Simples, MEIs e pessoas físicas (que possuam empregados)**

Fase 1: Julho/18 - Apenas informações relativas às empresas, ou seja, cadastros do empregador e tabelas

Fase 2: Set/18: Nesta fase, empresas passam a ser obrigadas a enviar informações relativas aos trabalhadores e seus vínculos com as empresas (eventos não periódicos), como admissões, afastamentos e desligamentos

Fase 3: Nov/18: Torna-se obrigatório o envio das folhas de pagamento

Fase 4: Janeiro/19: Substituição da GFIP (Guia de informações à Previdência Social) e compensação cruzada

Fase 5: Janeiro/19: Na última fase, deverão ser enviados os dados de segurança e saúde do trabalhador


**Etapa 3 - Entes Públicos**

_Atualizada pela [Portaria Conjunta ERFB/SEPRT nº 76, de 22 de outubro de 2020](https://www.in.gov.br/en/web/dou/-/portaria-conjunta-n-76-de-22-de-outubro-de-2020-284694569)_

Fase 1: Jun/21 - Apenas informações relativas aos órgãos, ou seja, cadastros dos empregadores e tabelas

Fase 2: Set/21: Nesta fase, entes passam a ser obrigadas a enviar informações relativas aos servidores e seus vínculos com os órgãos (eventos não periódicos) Ex: admissões, afastamentos e desligamentos

Fase 3: Jan/22: Torna-se obrigatório o envio das folhas de pagamento

Fase 4: Jul/22: Substituição da GFIP (guia de informações à Previdência) e compensação cruzada. Na última fase, deverão ser enviados os dados de segurança e saúde do trabalhador


**Empresas do SIMPLES NACIONAL : a definir**

[CAIXA Nº 761 DE 12/04/2017](https://www.legisweb.com.br/legislacao/?id=342289)


## Donations

**Estamos em busca de *doadores* e *patrocinadores* para ajudar a financiar parte do desenvolvimento deste pacote e de outros pacotes, aqueles que estiverem interessados por favor entrem em contato com o autor pelo email linux.rlm@gmail.com**

Este é um projeto totalmente *OpenSource*, para usá-lo, copia-lo e modificá-lo você não paga absolutamente nada. Porém para continuarmos a mantê-lo de forma adequada é necessária alguma contribuição seja feita, seja auxiliando na codificação, na documentação, na realização de testes e identificação de falhas e BUGs.

Mas também, caso você ache que qualquer informação obtida aqui, lhe foi útil e que isso vale de algum dinheiro e está disposto a doar algo, sinta-se livre para enviar qualquer quantia, seja diretamente ao autor ou através do PayPal e do PagSeguro.

<a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=linux%2erlm%40gmail%2ecom&lc=BR&item_name=NFePHP%20OpenSource%20API&item_number=nfephp&currency_code=BRL&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest">
<img alt="Doar com Paypal" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif"/></a>

<a target="_blank" href="https://pag.ae/bkXPq4">
<img alt="Doar PagSeguro" src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/120x53-doar.gif"/></a>

## Agradecimentos à contribuição de:

- **Rodrigo Traleski** da [Actuary](http://www.actuary.com.br/v3/)

> Sem a qual esse projeto não existiria.

## Faseamento detalhado por Eventos

### Fase 1
**Cadastros do empregador e tabelas:**


### Fase 2
**Dados dos trabalhadores e seus vínculos com as empresas (eventos não periódicos):**



### Fase 3
**Folha de Pagamento (eventos periódicos):**


### Fase 4
**Substituição da GFIP (Guia de informações à Previdência Social) e compensação cruzada:**

O DCTF Web (Declaração de Débitos e Créditos Tributários Federais) substituirá a GFIP e que será gerada pelo eSocial, EFD-Reinf e SERO (Serviço Eletrônico de Aferição de Obras), com apuração automática dos débitos (contribuição previdenciária, contribuição para outras entidades e fundos, IRRF) e, quando for o caso, dos créditos (salário-família, salário-maternidade e retenções sobre notas fiscais).

Não haverá geração automática da DCTF Web sem que tenha sido transmitida a apuração (eSocial, EFD-Reinf, SERO). Também não será possível a inclusão manual de débitos ou de deduções/retenções;

Deverá ser transmitida até o dia 15 do mês subsequente ao de ocorrência dos fatos geradores.

### Fase 5
**Dados de segurança e saúde do trabalhador:**


## CONCEITO DO e-SOCIAL

O eSocial (ou folha de pagamento digital), é a sigla para o Sistema de Escrituração Fiscal Digital das Obrigações Fiscais Previdenciárias e Trabalhistas, e faz parte do Projeto SPED-Sistema Público de Escrituração Digital, lançado em 2007.

## OBRIGATORIEDADE A TODOS OS EMPREGADORES

O projeto tem por objeto o envio das informações relativas à contratação e utilização de mão de obra onerosa, com ou sem vínculo empregatício. Por isso todos os empregadores, sejam eles pessoas jurídicas ou físicas ficarão obrigados à entrega. Todo o empregador tem as mesmas obrigações perante o sistema, porém as pessoas físicas, os MEIs (microempreendedores individuais) e os pequenos produtores rurais, em função de suas demandas, não necessitam de sistemas próprios para atenderem às obrigações do projeto. Eles poderão cumprir a obrigação diretamente no portal do eSocial na internet.

## CENTRALIZAÇÃO DAS OBRIGAÇÕES PREVIDENCIÁRIAS E TRABALHISTAS

O eSocial unifica o cumprimento das obrigações acessórias hoje prestadas em separado aos órgãos envolvidos: Ministério do Trabalho e Emprego, Receita Federal , Previdência Social, Caixa Econômica Federal, Fundo de Garantia por Tempo de Serviço (FGTS) e Justiça do Trabalho.

São muitos os dados a serem informados o que obriga os empregadores o quanto antes a reunir e adequar as informações da empresa e de seus colaboradores, ou seja, a manutenção de um cadastro em ordem é de grande importância para o novo sistema.

## MELHORIAS PARA O TRABALHADOR

Um dos objetivos do eSocial é garantir que os direitos trabalhistas e previdenciários dos empregados sejam devidamente cumpridos.

Os trabalhadores deverão ter maior agilidade no processo de aposentadoria e passar a ter seus direitos previdenciários e trabalhistas mais respeitados. A idéia é que com o eSocial, todos os fatos importantes da vida laboral do trabalhador ficarão registrados no sistema e estarão disponíveis quando o trabalhador precisar, dispensando a via sacra de busca dessas informações nos arquivos de antigas empresas, muitas delas até extintas.

## ALTERAÇÕES NA ROTINA DAS EMPRESAS

O sistema se aplica a todos os empregadores, independente do porte empresarial. Espera-se que haja um ganho em termos de tempo e volume de trabalho para as empresas com os ajustes nos processos internos, com a redução das obrigações acessórias e com o armazenamento de mais de 2 mil informações pelo governo.

Esse ganho porém deve vir a médio prazo pois num primeiro momento, durante a fase de readaptação, acaba ocorrendo um acúmulo das velhas obrigações enquanto não extintas e das novas que começam a ser cumpridas em paralelo. Com o eSocial futuramente deixará de ser necessário o envio de várias obrigações acessórias, tais como RAIS, CAGED, DIRF, CAT e outras informações, que estarão centralizadas no eSocial.

## ESCRITÓRIOS DE CONTABILIDADE DEVEM ALERTAR SEUS CLIENTES

A mudança na rotina das empresas atingirá diretamente a rotina dos escritórios de contabilidade que passarão a depender em grande parte do comportamento dos seus clientes para cumprir as novas obrigações.

Uma das principais novidades do novo sistema é o fato de que muitos dos acontecimentos ocorridos no dia a dia da empresa deverão ser enviados para o fisco assim que ocorrerem. Então a comunicação cliente-escritório deverá ocorrer diariamente e não apenas no final do mês como era costume. Acidentes de trabalho, aviso prévio, exame médico, admissão, demissão, etc devem ser comunicados assim que ocorrerem. Trata-se de uma nova característica no trâmite das informações entre as partes envolvidas.

Através de reuniões, palestras, dvd, livros ou cursos o escritório contábil deve alertar seus clientes para este novo cenário.

## FISCALIZAÇÃO ELETRÔNICA

A fiscalização e as autuações envolvendo o eSocial merecem atenção redobrada.

O entendimento atual é de que toa informação enviada dentro do projeto sped tem caráter declaratório, ou seja, de confissão e assinado digitalmente.

Desse modo pelo menos duas etapas dos processos de fiscalização ficam são antecipadas, intimação para comprovação e prazo para se adequar. Esses dois processos devem ser extintos, uma vez que os órgãos responsáveis já irão dispor das informações fornecidas pelo eSocial.

## SEGURANÇA E MEDICINA DO TRABALHO

Referente às regras de Segurança e Medicina do Trabalho, a mudança será a implementação de procedimentos e controles que permitam maior fiscalização sobre as empresas para que a legislação vigente seja atendida.

Os empregadores deverão elaborar e implantar o Programa de Controle Médico de Saúde Ocupacional (PCMSO) com objetivo de promover e preservar a saúde dos trabalhadores.

as organizações permanecem obrigadas a submeter os empregados aos exames previstos no Pcmso e a emitir os atestados de saúde ocupacional (ASO), a manter o Programa de Prevenção de Riscos Ambientais e a fornecer os equipamentos de proteção individual, devendo enviar essas informações ao fisco e não mais mante-las guardadas na empresa.

- Admissional: Deverá ser realizada antes que o trabalhador assuma suas atividades;
- Periódico: De acordo com os intervalos previsto pela NR 7;
- Retorno ao Trabalho: Obrigatoriamente no primeiro dia da volta ao trabalho de trabalhador ausente por período igual ou superior a 30 dias por motivo de doença ou acidente, de natureza ocupacional ou não, ou parto;
- Mudança de Função: Obrigatoriamente realizada antes da data da mudança de função, posto de trabalho ou de setor que implique a exposição de agentes nocivos diferente daquele a que estava exposto antes da mudança;
- Demissional: Obrigatoriamente desde que o último exame médico ocupacional tenha sido realizado há mais de 135 dias para as empresas de grau de risco 1 e 2 ou 90 dias para as empresas de grau de risco 3 e 4;

Em todos os tipos de exame ocupacional, será obrigatório o registro no eSocial, através do evento atestado de saúde ocupacional S-2280, com o detalhamento do médico responsável, número do registro (CRM), exames realizados etc.

## Contribuindo

Este é um projeto totalmente *OpenSource*, para usa-lo e modifica-lo você não paga absolutamente nada. Porém para continuarmos a mante-lo é necessário qua alguma contribuição seja feita, seja auxiliando na codificação, na documentação ou na realização de testes e identificação de falhas e BUGs.

**Este pacote esta listado no [Packgist](https://packagist.org/) foi desenvolvido para uso do [Composer](https://getcomposer.org/), portanto não será explicitada nenhuma alternativa de instalação.**

*Durante a fase de desenvolvimento e testes este pacote deve ser instalado com:*
```bash
composer require nfephp-org/sped-esocial:dev-master
```

*Ou ainda alterando o composer.json do seu aplicativo inserindo:*
```json
"require": {
    "nfephp-org/sped-esocial" : "dev-master"
}
```

> NOTA: Ao utilizar este pacote ainda na fase de desenvolvimento não se esqueça de alterar o composer.json da sua aplicação para aceitar pacotes em desenvolvimento, alterando a propriedade "minimum-stability" de "stable" para "dev".
> ```json
> "minimum-stability": "dev"
> ```

*Após os stable realeases estarem disponíveis, pode ser instalado com:*
```bash
composer require nfephp-org/sped-esocial
```
Ou ainda alterando o composer.json do seu aplicativo inserindo:
```json
"require": {
    "nfephp-org/sped-esocial" : "^1.0"
}
```

## Forma de uso
Em breve ....

## Log de mudanças e versões
Acompanhe o [CHANGELOG](CHANGELOG.md) para maiores informações sobre as alterações recentes.

## Testing

Todos os testes são desenvolvidos para operar com o PHPUNIT

## Security

Caso você encontre algum problema relativo a segurança, por favor envie um email diretamente aos mantenedores do pacote ao invés de abrir um ISSUE.

## Credits

Roberto L. Machado (owner and developer)

## License

Este pacote está diponibilizado sob LGPLv3 ou MIT License (MIT). Leia  [Arquivo de Licença](LICENSE.md) para maiores informações.

[ico-stable]: https://poser.pugx.org/nfephp-org/sped-esocial/version
[ico-stars]: https://img.shields.io/github/stars/nfephp-org/sped-esocial.svg?style=flat-square
[ico-forks]: https://img.shields.io/github/forks/nfephp-org/sped-esocial.svg?style=flat-square
[ico-issues]: https://img.shields.io/github/issues/nfephp-org/sped-esocial.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/nfephp-org/sped-esocial/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/nfephp-org/sped-esocial.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/nfephp-org/sped-esocial.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/nfephp-org/sped-esocial.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/nfephp-org/sped-esocial.svg?style=flat-square
[ico-license]: https://poser.pugx.org/nfephp-org/nfephp/license.svg?style=flat-square
[ico-gitter]: https://img.shields.io/badge/GITTER-4%20users%20online-green.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/nfephp-org/sped-esocial
[link-travis]: https://travis-ci.org/nfephp-org/sped-esocial
[link-scrutinizer]: https://scrutinizer-ci.com/g/nfephp-org/sped-esocial/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/nfephp-org/sped-esocial
[link-downloads]: https://packagist.org/packages/nfephp-org/sped-esocial
[link-author]: https://github.com/nfephp-org
[link-issues]: https://github.com/nfephp-org/sped-esocial/issues
[link-forks]: https://github.com/nfephp-org/sped-esocial/network
[link-stars]: https://github.com/nfephp-org/sped-esocial/stargazers
[link-gitter]: https://gitter.im/nfephp-org/sped-esocial?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge
