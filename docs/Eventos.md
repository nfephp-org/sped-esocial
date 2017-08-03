# Eventos

O e-Social foi estruturado em sua versão 2.2.02 com 44 eventos

1. [evtAdmPrelim S-2190 - Admissão de Trabalhador - Registro Preliminar](EvtAdmPrelim.md)
2. [evtAdmissao S-2200 - Admissão / Ingresso de Trabalhador](EvtAdmissao.md)
3. [evtAfastTemp S-2230 - Afastamento Temporário](EvtAfastTemp.md)
4. [evtAltCadastral S-2205 - Alteração de Dados Cadastrais do Trabalhador](EvtAltCadastral.md)
5. [evtAltContratual S-2206 - Alteração de Contrato de Trabalho](EvtAltContratual.md)
6. [evtAqProd S-1250 - Aquisição de Produção Rural](EvtAqProd.md)
7. [evtAvPrevio S-2250 - Aviso Prévio](EvtAvPrevio.md)
8. [evtBasesTrab S-5001 - Informações das contribuições sociais por trabalhador](EvtBasesTrab.md)
9. [evtBenPrRP S-1207 - Benefícios previdenciários - RPPS](EvtBenPrRP.md)
10. [evtCAT S-2210 - Comunicação de Acidente de Trabalho](EvtCAT.md)
11. [evtCS S-5011 - Informações das contribuições sociais consolidadas por contribuinte](EvtCS.md)
12. [evtCadInicial S-2100 - Cadastramento Inicial do Vínculo](EvtCadInicial.md)
13. [evtCdBenPrRP S-2400 - Cadastro de Benefícios Previdenciários - RPPS](EvtCdBenPrRP.md)
14. [evtComProd S-1260 - Comercialização da Produção Rural Pessoa Física](EvtComProd.md)
15. [evtContrSindPatr S-1300 - Contribuição Sindical Patronal](EvtContrSindPatr.md)
16. [evtContratAvNP S-1270 - Contratação de Trabalhadores Avulsos Não Portuários](EvtContratAvNP.md)
17. [evtDeslig S-2299 - Desligamento](EvtDeslig.md)
18. [evtExclusao S-3000 - Exclusão de eventos](EvtExclusao.md)
19. [evtExpRisco S-2240 - Condições Ambientais do Trabalho - Fatores de Risco](EvtExpRisco.md)
20. [evtFechaEvPer S-1299 - Fechamento dos Eventos Periódicos](EvtFechaEvPer.md)
21. [evtInfoComplPer S-1280 - Informações Complementares aos Eventos Periódicos](EvtInfoComplPer.md)
22. [evtInfoEmpregador S-1000 - Informações do Empregador/Contribuinte/Órgão Público](EvtInfoEmpregador.md)
23. [evtInsApo S-2241 - Insalubridade, Periculosidade e Aposentadoria Especial](EvtInsApo.md)
24. [evtIrrf S-5012 - Informações do IRRF consolidadas por contribuinte](EvtIrrf.md)
25. [evtIrrfBenef S-5002 - Imposto de Renda Retido na Fonte](EvtIrrfBenef.md)
26. [evtMonit S-2220 - Monitoramento da Saúde do Trabalhador](EvtMonit.md)
27. [evtPgtos S-1210 - Pagamentos de Rendimentos do Trabalho](EvtPgtos.md)
28. [evtReabreEvPer S-1298 - Reabertura dos Eventos Periódicos](EvtReabreEvPer.md)
29. [evtReintegr S-2298 - Reintegração](EvtReintegr.md)
30. [evtRemun S-1200 - Remuneração de trabalhador vinculado ao Regime Geral de Previd. Social](EvtRemun.md)
31. [evtRmnRPPS S-1202 - Remuneração de servidor vinculado a Regime Próprio de Previd. Social](EvtRmnRPPS.md)
32. [evtTSVAltContr S-2306 - Trabalhador Sem Vínculo de Emprego/Estatutário - Alteração Contratual](EvtTSVAltContr.md)
33. [evtTSVInicio S-2300 - Trabalhador Sem Vínculo de Emprego/Estatutário - Início](EvtTSVInicio.md)
34. [evtTSVTermino S-2399 - Trabalhador Sem Vínculo de Emprego/Estatutário - Término](EvtTSVTermino.md)
35. [evtTabAmbiente S-1060 - Tabela de Ambientes de Trabalho](EvtTabAmbiente.md)
36. [evtTabCargo S-1030 - Tabela de Cargos/Empregos Públicos](EvtTabCargo.md)
37. [evtTabCarreira S-1035 - Tabela de Carreiras Públicas](EvtTabCarreira.md)
38. [evtTabEstab S-1005 - Tabela de Estabelecimentos, Obras ou Unidades de Órgãos Públicos](EvtTabEstab.md)
39. [evtTabFuncao S-1040 - Tabela de Funções/Cargos em Comissão](EvtTabFuncao.md)
40. [evtTabHorTur S-1050 - Tabela de Horários/Turnos de Trabalho](EvtTabHorTur.md)
41. [evtTabLotacao S-1020 - Tabela de Lotações Tributárias](EvtTabLotacao.md)
42. [evtTabOperPort S-1080 - Tabela de Operadores Portuários](EvtTabOperPort.md)
43. [evtTabProcesso S-1070 - Tabela de Processos Administrativos/Judiciais](EvtTabProcesso.md)
44. [evtTabRubrica S-1010 - Tabela de Rubricas](EvtTabRubrica.md)

## PADRONIZAÇÃO

Para efeito de padronização na passagem dos parametros para as classes foram adotados alguns critérios:

## GRUPOS

Os eventos estão subdivididos em grupos 

1. Eventos iniciais e de tabelas 
2. Eventos Não periódicos 
3. Eventos periódicos

### EVENTOS INICIAIS grupo [1]

> Identificam o contribuinte e contêm dados básicos de classificação fiscal e estrutura administrativa. É o primeiro evento a ser transmitido ao eSocial. Também compõe os eventos iniciais o cadastramento inicial dos vínculos, que deve ser informado após terem sido transmitidos os eventos de tabelas do empregador. 
> 
> Já os Eventos de Tabelas são eventos permanentes utilizados por outras partes do eSocial. É recomendável transmiti-las logo após o envio do evento de Informações do Empregador. 

- S-1000 Informações do Empregador
- S-1005 Tabela de Estabelecimentos, Obras ou Unidades de Órgãos Públicos
- S-1010 Tabela de Rubricas
- S-1020 Tabela de Lotações
- S-1030 Tabela de Cargos
- S-1035 Tabela de Carreiras Públicas
- S-1040 Tabela de Funções
- S-1050 Tabela de Horários/Turnos de Trabalho
- S-1060 Tabela de Estabelecimentos e Obras
- S-1070 Tabela de Processos
- S-1080 Tabela de Operadores Portuários
- S-2100 Cadastramento Inicial do Vínculo

### EVENTOS NÃO PERIÓDICOS grupo [2]

> São os fatos jurídicos firmados entre empregador/tomador e trabalhadores que não têm uma data prefixada para ocorrer. Vão depender dos acontecimentos na vida da empresa e do trabalhador, tais como contratação, afastamentos, demissões, dentre outros. Esses fatos influenciam na concessão de direitos e no cumprimento de deveres trabalhistas, previdenciários e fiscais. 

- S-2190 Admissão de Trabalhador - Registro Preliminar
- S-2200 Admissão de Trabalhador
- S-2220 Alteração de Dados Cadastrais do Trabalhador
- S-2240 Alteração de Contrato de Trabalho
- S-2260 Comunicação de Acidente de Trabalho
- S-2280 Atestado de Saúde Ocupacional
- S-2320 Afastamento Temporário
- S-2325 Alteração de Motivo de Afastamento
- S-2330 Retorno de Afastamento Temporário
- S-2340 Estabilidade – Início
- S-2345 Estabilidade – Término
- S-2360 Condição Diferenciada de Trabalho - Início
- S-2365 Condição Diferenciada de Trabalho - Término
- S-2400 Aviso Prévio
- S-2405 Cancelamento de Aviso Prévio
- S-2600 Trabalhador Sem Vínculo de Emprego - Início
- S-2620 Trabalhador Sem Vínculo de Emprego - Alt. Contratual
- S-2680 Trabalhador Sem Vínculo de Emprego – Término
- S-2800 Desligamento
- S-2820 Reintegração

### EVENTOS PERIÓDICOS grupo [3]

> São os eventos que têm periodicidade previamente definida para sua ocorrência. Seu prazo de transmissão é até o dia 07 do mês seguinte, antecipando o vencimento para o dia útil imediatamente anterior em caso de não haver expediente bancário (à exceção do evento de espetáculo desportivo). São compostos por informações de folha de pagamento, apuração de outros fatos geradores de contribuições previdenciárias e retenção do imposto sobre a renda em pagamentos feitos pelo próprio contribuinte.

- S-1200 Eventos Periódicos – Remuneração do Trabalhador
- S-1202 Remuneração de servidor vinculado a Regime Próprio de Previd. Social
- S-1207 Benefícios previdenciários - RPPS
- S-1210 Pagamentos de Rendimentos do Trabalho
- S-1300 Eventos Periódicos - Pagamentos Diversos
- S-1310 Eventos Periódicos - Serviços Tomados mediante Cessão de Mão de Obra
- S-1320 Eventos Periódicos - Serviços Prestados mediante Cessão de Mão de Obra
- S-1330 Eventos Periódicos - Serviços Tomados de Cooperativa de Trabalho
- S-1340 Eventos Periódicos - Serv. Prestados pela Cooperativa de Trabalho
- S-1350 Eventos Periódicos - Aquisição de Produção
- S-1360 Eventos Periódicos - Comercialização da Produção
- S-1370 Eventos Periódicos - Recursos Recebidos ou Repassados p/ Assoc. Desportiva que mantenha Equipe de Futebol Profiss.
- S-1380 Eventos Periódicos - Informações Complementares - Desoneração
- S-1390 Eventos Periódicos - Receita de Atividades Concomitantes
- S-1399 Eventos Periódicos - Fechamento
- S-1400 Eventos Periódicos - Bases, Retenção, Deduções e Contribuições
- S-1800 Eventos Periódicos - Espetáculo Desportivo