# Json Schema

Aqui vou dar algumas orientações básicas com referencia ao json schema utilizado na pré-validação dos dados dos eventos.

> NOTA: sempre que possivel use o XSD do evento.versão para obter os condicionantes de cada campo e adapte o REGEX, pois o indicado no XSD nem sempre é aceito pelo PCRE.

## Tipos

### INTEGER

Os tipos integer, podem receber os seguintes atributos:

minimum e maximum

### STRING

Os tipos string, preferencialmente devem ser controlados (quanto ao seu formato) com 

pattern (REGEX pcre)

Ex.
```
"pattern": "^[0-9]{14}$"
```
E alternativamente com:

minLength e maxLength

### NUMBER

Os tipos number, não recebem normalmente nenhum tipo adicional de filtro, além de terem de ser numeros reais.

### MAIL

O tipo mail é auto explicativo
