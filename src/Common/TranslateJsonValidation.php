<?php

namespace NFePHP\eSocial\Common;

class TranslateJsonValidation
{
    /**
     * @var array
     */
    protected static $frases = [
        'no schema found to verify against' => 'sem um schema parra verificar',
        'Cannot validate the schema of a non-object' => 'Impossivel validar o '
            .'schema de algo que não é um objeto',
        'Schema did not pass validation' => 'O schema não passa na validação',
        'Schema is not valid' => 'O schema não é válido',
        'Error validating' => 'Erro validando',
        'Unable to encode schema array as JSON' => 'Incapaz de transformar o array em Json',
        'There must be a minimum of' => 'Deve haver um mínimo de',
        'items in the array' => 'itens no array',
        'There must be a maximum of' => 'Deve haver um máximo de',
        'There are no duplicates allowed in the array' => 'Não são permitidas repetiçõess no array',
        'The item' => 'O item',
        'is not defined and the definition does not allow additional items'
            => 'não está definido e a definição não permite itens adicionais',
        'Does not have a value in the enumeration' => 'Não possui um valor na enumeração',
        'Unknown constraint' => 'Restrição desconhecida, falha de codificação',
        'Invalid date' => 'Data inválida',
        'expected format YYYY-MM-DD' => 'esperado o formato YYYY-MM-DD',
        'Invalid time' => 'Hora inválida',
        'expected format hh:mm:ss' => 'esperado formato HH:mm:ss',
        'Invalid date-time' => 'Inválida data hora',
        'expected format YYYY-MM-DDThh:mm:ssZ or YYYY-MM-DDThh:mm:ss+hh:mm'
            => 'esparado o formto YYYY-MM-DDThh:mm:ssZ ou YYYY-MM-DDThh:mm:ss+hh:mm',
        'expected integer of milliseconds since Epoch'
            => 'esperado numero inteiro de millisegundos desde Epoch',
        'Invalid regex format' => 'Invalido formato regex',
        'Invalid color' => 'Cor inválida',
        'Invalid style' => 'Estilo inválido',
        'Invalid phone number' => 'Telefone inválido',
        'Invalid URL format' => 'URL inválida',
        'Invalid email' => 'Email inválido',
        'Invalid IP address' => 'Endereço IP inválido',
        'Invalid hostname' => 'Hostname inválido',
        'Must have a minimum value of' => 'Deve ter no minimo',
        'Must have a maximum value of' => 'Deve ter no máximo',
        'Use of exclusiveMinimum requires presence of minimum'
            => 'Requer a presença do minimo',
        'Is not divisible by' => 'Não é divisivel por',
        'Must be a multiple of' => 'Tem que ser um multiplo de',
        'The pattern' => 'O padrão',
        'is invalid' => 'é inválido',
        'The property' => 'A propriedade',
        'is not defined and the definition does not allow additional properties'
            => 'não está definida e a definição não permite propriedades adicionais',
        'The presence of the property' => 'A presença dessa propriedade',
        'requires that' => 'requer que',
        'also be present' => 'também esteja presente',
        'Must contain a minimum of' => 'Deve conter um minimo de',
        'properties' => 'propriedades',
        'Must contain no more than' => 'Não pode conter mais que',
        'Must be at most' => 'Deve ter no máximo',
        'characters long' => 'caracteres de comprimento',
        'Must be at least' => 'Deve ter pelo menos',
        'Does not match the regex pattern' => 'Não corresponde ao padrão',
        'an integer' => 'um inteiro',
        'a number' => 'um numero',
        'a boolean' => 'um boleano',
        'an object' => 'um objeto',
        'an array' => 'um array',
        'a string' => 'uma string',
        'a null' => 'um null',
        'value found, but' => 'encontrado, mas',
        'is required' => 'é obrigatório',
        'No wording for' => 'Nenhuma redação para',
        'available, expected wordings are:' => 'está disponivel, as redações esperadas são:',
        'is an invalid type for' => 'é um tipo inválido para',
        'Disallowed value was matched' => 'O valor não permitido foi correspondido',
        'Matched a schema which it should not' => 'Correspondeu a um esquema que não deveria',
        'Failed to match all schemas' => 'Falha ao corresponder a todos os esquemas',
        'Failed to match at least one schema' => 'Falha ao corresponder a pelo menos um esquema',
        'Failed to match exactly one schema' => 'Falha ao corresponder exatamente a um esquema',
        ' depends on' => ' depende de',
        ' and ' => ' e ',
        ' or ' => ' ou ',
        'is missing' => 'não encontrado.',
    ];

    /**
     * Translate to pt-BR
     *
     * @param string $message
     * @return string
     */
    public static function translate($message)
    {
        foreach (self::$frases as $key => $value) {
            $message = str_replace($key, $value, $message);
        }
        return $message;
    }
}
