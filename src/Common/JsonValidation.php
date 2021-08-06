<?php

namespace NFePHP\eSocial\Common;

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;
use NFePHP\eSocial\Common\TranslateJsonValidation;

class JsonValidation
{
    public static function validate(
        \stdClass $std,
        string $jsonschema,
        string $definitions
    ) {
        if (!is_file($jsonschema) || !is_file($definitions)) {
            return [];
        }
        $jsonSchemaObject = json_decode((string)file_get_contents($jsonschema));
        $schemaStorage = new SchemaStorage();
        $schemaStorage->addSchema("file:{$definitions}", $jsonSchemaObject);
        $jsonValidator = new Validator(new Factory($schemaStorage));
        $jsonValidator->validate($std, $jsonSchemaObject, Constraint::CHECK_MODE_COERCE_TYPES);
        if ($jsonValidator->isValid()) {
            return [];
        }
        $resp = [];
        foreach ($jsonValidator->getErrors() as $error) {
            $error['message'] = TranslateJsonValidation::translate($error['message']);
            $resp[] = $error;
        }
        return $resp;
    }
}
