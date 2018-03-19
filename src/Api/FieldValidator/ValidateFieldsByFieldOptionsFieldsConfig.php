<?php

namespace Reliv\FieldRat\Api\FieldValidator;

use Reliv\ArrayProperties\Property;
use Reliv\FieldRat\Api\BuildFieldRatValidationOptions;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFields;
use Reliv\ValidationRat\Model\ValidationResultFields;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateFieldsByFieldOptionsFieldsConfig implements ValidateFields
{
    const OPTION_FIELDS_OPTIONS = 'options';
    const OPTION_PARENT_FIELD_CONFIG = BuildFieldRatValidationOptions::VALIDATOR_OPTION_FIELD_CONFIG;

    protected $findFieldsByModel;
    protected $validateFieldsByFieldsConfig;

    /**
     * @param ValidateFieldsByFieldsConfig $validateFieldsByFieldsConfig
     */
    public function __construct(
        ValidateFieldsByFieldsConfig $validateFieldsByFieldsConfig
    ) {
        $this->validateFieldsByFieldsConfig = $validateFieldsByFieldsConfig;
    }

    /**
     * @param array $fields ['{name}' => '{value}']
     * @param array $options
     *
     * @return ValidationResultFields
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Throwable
     * @throws \Reliv\ArrayProperties\Exception\ArrayPropertyException
     */
    public function __invoke(
        array $fields,
        array $options = []
    ): ValidationResultFields {
        $parentOptions = Property::getArray(
            $options,
            static::OPTION_PARENT_FIELD_CONFIG,
            []
        );

        $fieldOptions = Property::getArray(
            $parentOptions,
            static::OPTION_FIELDS_OPTIONS,
            []
        );

        $options[ValidateFieldsByFieldsConfig::OPTION_FIELDS_CONFIG] = Property::getArray(
            $fieldOptions,
            ValidateFieldsByFieldsConfig::OPTION_FIELDS_CONFIG,
            []
        );

        return $this->validateFieldsByFieldsConfig->__invoke(
            $fields,
            $options
        );
    }
}
