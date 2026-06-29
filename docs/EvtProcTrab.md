# EvtProcTrab

## Evento
*evtProcTrab* — S-2500 Processo Trabalhista

## Alterações v_S_01_03_00 (NT S-1.3 nº 06/2026)

### Campo `infoPatPrec` (novo no S130)
- **Localização:** `infoProcesso/dadosCompl/infoProcJud/infoPatPrec`
- **Tipo:** `TS_valorMonetario` — valor monetário
- **Obrigatoriedade:** Obrigatório e exclusivo se `origem = 3` (Justiça Comum)
- **Descrição:** Valor total da cota patronal incidente sobre a remuneração paga ao trabalhador, que será objeto de requisição autônoma.

### Suporte a `origem = 3` (Justiça Comum)
- O enum `TS_origem` ganhou o valor `3` = Justiça Comum.
- Quando `origem = 3`, o grupo `infoProcJud` é obrigatório (igual ao `origem = 1`).
- A validação do `nrProcTrab` para `origem = 3`: o 14º dígito deve ser `4` ou `8` (se `dtSent >= 2026-04-27`).

### Campos `indCateg` e `indNatAtiv` em `infoContr`
- Estes campos já existiam desde S-1.2.0 ao nível de `infoContr`.
- Controlam respectivamente se houve reconhecimento de categoria e de natureza de atividade diferentes das informadas pelo declarante.
- O grupo `mudCategAtiv` é obrigatório quando `indCateg = S` ou `indNatAtiv = S`.
