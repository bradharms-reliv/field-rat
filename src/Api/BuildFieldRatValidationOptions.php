<?php

namespace Reliv\FieldRat\Api;

use Reliv\ArrayProperties\Property;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class BuildFieldRatValidationOptions
{
    const OPTION_FIELD_TYPE = 'field-type';
    const OPTION_FIELD_CONFIG = 'field-config';

    const VALIDATOR_OPTION_FIELD_TYPE = 'field-rat-field-type';
    const VALIDATOR_OPTION_FIELD_CONFIG = 'field-rat-field-config';

    /**
     * @param array $validatorOptions
     * @param array $options
     *
     * @return array
     */
    public static function invoke(
        array $validatorOptions,
        array $options
    ): array {
        $fieldConfig = Property::getArray(
            $options,
            static::OPTION_FIELD_CONFIG
        );

        $fieldType = Property::getString(
            $options,
            static::OPTION_FIELD_TYPE
        );

        if (empty($fieldConfig) && empty($fieldType)) {
            return $validatorOptions;
        }

        $validatorOptions[self::VALIDATOR_OPTION_FIELD_TYPE] = $fieldConfig;
        $validatorOptions[self::VALIDATOR_OPTION_FIELD_CONFIG] = $fieldConfig;

        return $validatorOptions;
    }
}
