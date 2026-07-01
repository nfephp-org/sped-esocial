# EvtCdBenAlt

## Evento
*evtCdBenAlt* — S-2416 Cadastro de Benefício - Alteração (Entes Públicos)

## Alterações v_S_01_03_00 (NT S-1.3 nº 06/2026)

### Grupo `instPenMorte` em `infoPenMorte` (novo no S130)
- **Localização:** `infoBenAlteracao/dadosBeneficio/infoPenMorte/instPenMorte`
- **Obrigatoriedade do grupo:** Opcional — se não informado e `dtAltBeneficio >= 2025-11-24`, retorna alerta.
- **Campos:**
  - `tpDepInst` (obrigatório dentro do grupo): Tipo de dependente do instituidor (`TS_tpDepInst`)
  - `descrDepInst` (opcional): Descrição complementar do tipo de dependente (`TS_descrDepInst`)
- **Diferença em relação ao S-2410:** Em S-2416, `instPenMorte` contém **apenas** `tpDepInst` e `descrDepInst` (sem `cpfInst`/`dtInst`, que são exclusivos do S-2410).
