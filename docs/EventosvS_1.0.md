# Eventos versão S 1.0

## Eventos a serem gerados

O e-Social foi estruturado em sua versão S 1.0 com 36 eventos, a serem gerados e enviados ao webservice.

01. [**S-1000 evtInfoEmpregador** - Informações do Empregador/Contribuinte/Órgão Público](EvtInfoEmpregador.md)
02. [**S-1005 evtTabEstab** - Tabela de Estabelecimentos, Obras ou Unidades de Órgãos Públicos](EvtTabEstab.md)
03. [**S-1010 evtTabRubrica** - Tabela de Rubricas](EvtTabRubrica.md)
04. [**S-1020 evtTabLotacao** - Tabela de Lotações Tributárias](EvtTabLotacao.md)
05. [**S-1070 evtTabProcesso** - Tabela de Processos Administrativos/Judiciais](EvtTabProcesso.md)
06. [**S-1200 evtRemun** - Remuneração de trabalhador vinculado ao Regime Geral de Previd. Social](EvtRemun.md)
07. [**S-1202 evtRmnRPPS** - Remuneração de servidor vinculado a Regime Próprio de Previd. Social](EvtRmnRPPS.md)
08. [**S-1207 evtBenPrRP** - Benefícios previdenciários - RPPS](EvtBenPrRP.md)
09. [**S-1210 evtPgtos** - Pagamentos de Rendimentos do Trabalho](EvtPgtos.md)
10. [**S-1260 evtComProd** - Comercialização da Produção Rural Pessoa Física](EvtComProd.md)
11. [**S-1270 evtContratAvNP** - Contratação de Trabalhadores Avulsos Não Portuários](EvtContratAvNP.md)
12. [**S-1280 evtInfoComplPer** - Informações Complementares aos Eventos Periódicos](EvtInfoComplPer.md)
13. [**S-1298 evtReabreEvPer** - Reabertura dos Eventos Periódicos](EvtReabreEvPer.md)
14. [**S-1299 evtFechaEvPer** - Fechamento dos Eventos Periódicos](EvtFechaEvPer.md)
15. [**S-2190 evtAdmPrelim** - Admissão de Trabalhador - Registro Preliminar](EvtAdmPrelim.md)
16. [**S-2200 evtAdmissao** - Admissão / Ingresso de Trabalhador](EvtAdmissao.md)
17. [**S-2205 evtAltCadastral** - Alteração de Dados Cadastrais do Trabalhador](EvtAltCadastral.md)
18. [**S-2206 evtAltContratual** - Alteração de Contrato de Trabalho](EvtAltContratual.md)
19. [**S-2210 evtCAT** - Comunicação de Acidente de Trabalho](EvtCAT.md)
20. [**S-2220 evtMonit** - Monitoramento da Saúde do Trabalhador](EvtMonit.md)
21. [**S-2221 evtToxic** - Exame Toxicológico do Motorista Profissional](EvtToxic.md)
22. [**S-2230 evtAfastTemp** - Afastamento Temporário](EvtAfastTemp.md)
23. [**S-2231 evtCessao** - Cessão/Exercício em Outro Órgão](EvtCessao.md)
24. [**S-2240 evtExpRisco** - Condições Ambientais do Trabalho - Fatores de Risco](EvtExpRisco.md)
25. [**S-2298 evtReintegr** - Reintegração](EvtReintegr.md)
26. [**S-2299 evtDeslig** - Desligamento](EvtDeslig.md)
27. [**S-2300 evtTSVInicio** - Trabalhador Sem Vínculo de Emprego/Estatutário - Início](EvtTSVInicio.md)
28. [**S-2306 evtTSVAltContr** - Trabalhador Sem Vínculo de Emprego/Estatutário - Alteração Contratual](EvtTSVAltContr.md)
29. [**S-2399 evtTSVTermino** - Trabalhador Sem Vínculo de Emprego/Estatutário - Término](EvtTSVTermino.md)
30. [**S-2400 evtCdBenPrRP** - Cadastro de Benefícios Previdenciários - RPPS](EvtCdBenPrRP.md)
31. [**S-2405 evtCdBenefAlt** - Cadastro de Beneficiário - Entes Públicos - Alteração](EvtCdBenefAlt.md)
32. [**S-2410 evtCdBenIn** - Cadastro de Benefício - Entes Públicos - Início](EvtCdBenIn.md)
33. [**S-2416 evtCdBenAlt** - Cadastro de Benefício - Entes Públicos - Alteração](EvtCdBenAlt.md)
34. [**S-2418 evtReativBen** - Reativação de Benefício - Entes Públicos](EvtReativBen.md)
35. [**S-2420 evtCdBenTerm** - Cadastro de Benefício - Entes Públicos - Término](EvtCdBenTerm.md)
36. [**S-3000 evtExclusao** - Exclusão de eventos](EvtExclusao.md)


## Eventos retornados pela Receita

São 5 possiveis eventos retornados apoós algum envio (esse retorno depende do envio de algum evento especifico).

01. [**S-5001 evtBasesTrab** - Informações das contribuições sociais por trabalhador](EvtBasesTrab.md)
02. [**S-5002 evtIrrfBenef** - Imposto de Renda Retido na Fonte](EvtIrrfBenef.md)
03. [**S-5003 evtBasesFGTS** - Informações do FGTS por Trabalhador](EvtBasesFGTS.md)
04. [**S-5011 evtCS** - Informações das contribuições sociais consolidadas por contribuinte](EvtCS.md)
05. [**S-5013 evtFGTS** - Informações do FGTS consolidadas por contribuinte](EvtFGTS.md)


## GRUPOS

Os eventos estão subdivididos em grupos 

1. Eventos iniciais e de tabelas
2. Eventos Não periódicos 
3. Eventos periódicos

## EVENTOS INICIAIS grupo [1] (total 5 eventos)

> Identificam o contribuinte e contêm dados básicos de classificação fiscal e estrutura administrativa. São os primeiros eventos a serem transmitido ao eSocial. Também compõe os eventos iniciais o cadastramento inicial dos vínculos, que deve ser informado após terem sido transmitidos os eventos de tabelas do empregador. 
> 
> Os Eventos das Tabelas, são eventos permanentes utilizados por outras partes do eSocial. É recomendável transmiti-las logo após o envio do evento de Informações do Empregador (S-1000). 

- [S-1000 Informações do Empregador](EvtInfoEmpregador.md)
- [S-1005 Tabela de Estabelecimentos, Obras ou Unidades de Órgãos Públicos](EvtTabEstab.md)
- [S-1010 Tabela de Rubricas](EvtTabRubrica.md)
- [S-1020 Tabela de Lotações](EvtTabLotacao.md)
- [S-1070 Tabela de Processos](EvtTabProcesso.md)


## EVENTOS NÃO PERIÓDICOS grupo [2] (total 21 eventos)

> São os fatos jurídicos firmados entre empregador/tomador e trabalhadores que não têm uma data prefixada para ocorrer. Vão depender dos acontecimentos na vida da empresa e do trabalhador, tais como contratação, afastamentos, demissões, dentre outros. Esses fatos influenciam na concessão de direitos e no cumprimento de deveres trabalhistas, previdenciários e fiscais. 
>
> Alguns desses eventos preconizam um controle de ocorrencia. Por exemplo, somente posso alterar um contato (S-2206) SE o trabalhador já tiver sido admitido (S-2200).

- [S-2190 Admissão de Trabalhador - Registro Preliminar](EvtAdmPerlim.md)
- [S-2200 Admissão de Trabalhador](EvtAdmissao.md)
- [S-2205 Alteração de Dados Cadastrais do Trabalhador](EvtAltCadastral.md)
- [S-2206 Alteração de Contrato de Trabalho](EvtAltContratual.md)
- [S-2210 Comunicação de Acidente de Trabalho](EvtCAT.md)
- [S-2220 Monitoramento da Saúde do Trabalhador](EvtMonit.md)
- [S-2230 Afastamento Temporário](EvtAfastTemp.md)
- [S-2231 Cessão/Exercício em Outro Órgão](EvtCessao.md)
- [S-2240 Condições Ambientais do Trabalho - Fatores de Risco](EvtExpRisco.md)
- [S-2298 Reintegração](EvtReintegr.md)
- [S-2299 Desligamento](EvtDeslig.md)
- [S-2300 Trabalhador Sem Vínculo de Emprego/Estatutário - Início](EvtTSVInicio.md)
- [S-2306 Trabalhador Sem Vínculo de Emprego/Estatutário - Alteração Contratual](EvtTSVAltContr.md)
- [S-2399 Trabalhador Sem Vínculo de Emprego/Estatutário - Término](EvtTSVTermino.md)
- [S-2400 Cadastro de Benefícios Previdenciários - RPPS](EvtCdBenPrRP.md)
- [S-2405 Cadastro de Beneficiário - Entes Públicos - Alteração](EvtCdBenefAlt.md)
- [S-2410 Cadastro de Benefício - Entes Públicos - Início](EvtCdBenIn.md)
- [S-2416 Cadastro de Benefício - Entes Públicos - Alteração](EvtCdBenAlt.md)
- [S-2418 Reativação de Benefício - Entes Públicos](EvtReativBen.md)
- [S-2420 Cadastro de Benefício - Entes Públicos - Término](EvtCdBenTerm.md)
- [S-3000 Exclusão de eventos](EvtExclusao.md)


## EVENTOS PERIÓDICOS grupo [3] (total 10 eventos)

> São os eventos que têm periodicidade previamente definida para sua ocorrência. Seu prazo de transmissão é até o dia 07 do mês seguinte, antecipando o vencimento para o dia útil imediatamente anterior em caso de não haver expediente bancário (à exceção do evento de espetáculo desportivo). São compostos por informações de folha de pagamento, apuração de outros fatos geradores de contribuições previdenciárias e retenção do imposto sobre a renda em pagamentos feitos pelo próprio contribuinte.

- [S-1200 Remuneração de trabalhador vinculado ao Regime Geral de Previd. Social](EvtRemun.md)
- [S-1202 Remuneração de servidor vinculado a Regime Próprio de Previd. Social](EvtRmnRPPS.md)
- [S-1207 Benefícios previdenciários - RPPS](EvtBenPrRP.md)
- [S-1210 Pagamentos de Rendimentos do Trabalho](EvtPgtos.md)
- [S-1250 Aquisição de Produção Rural](EvtAqProd.md)
- [S-1260 Comercialização da Produção Rural Pessoa Física](EvtComProd.md)
- [S-1270 Contratação de Trabalhadores Avulsos Não Portuários](EvtContratAvNP.md)
- [S-1280 Informações Complementares aos Eventos Periódicos](EvtInfoComplPer.md)
- [S-1298 Reabertura dos Eventos Periódicos](EvtReabreEvPer.md)
- [S-1299 Fechamento dos Eventos Periódicos](EvtFechaEvPer.md)


