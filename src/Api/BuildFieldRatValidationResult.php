<?php

namespace Reliv\FieldRat\Api;

use Reliv\ArrayProperties\Property;
use Reliv\ValidationRat\Model\ValidationResult;
use Reliv\ValidationRat\Model\ValidationResultBasic;
use Reliv\ValidationRat\Model\ValidationResultFields;
use Reliv\ValidationRat\Model\ValidationResultFieldsBasic;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class BuildFieldRatValidationResult
{
    const OPTION_FIELD_CONFIG = BuildFieldRatValidationOptions::OPTION_FIELD_CONFIG;

    const DETAIL_FIELD_TYPE = 'field-rat-field-type';
    const DETAIL_FIELD_CONFIG = 'field-rat-field-config';

    /**
     * @param ValidationResult $validationResult
     * @param array            $options
     *
     * @return ValidationResult
     */
    public static function invoke(
        ValidationResult $validationResult,
        array $options = []
    ): ValidationResult {
        $fieldConfig = Property::getArray(
            $options,
            static::OPTION_FIELD_CONFIG
        );

        if (empty($fieldConfig)) {
            return $validationResult;
        }

        $details = $validationResult->getDetails();
        $details[static::DETAIL_FIELD_CONFIG] = $fieldConfig;

        if ($validationResult instanceof ValidationResultFields) {
            return new ValidationResultFieldsBasic(
                $validationResult->isValid(),
                $validationResult->getCode(),
                $validationResult->getFieldResults(),
                $details
            );
        }

        return new ValidationResultBasic(
            $validationResult->isValid(),
            $validationResult->getCode(),
            $details
        );
    }
}
