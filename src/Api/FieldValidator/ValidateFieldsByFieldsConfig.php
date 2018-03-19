<?php

namespace Reliv\FieldRat\Api\FieldValidator;

use Reliv\ArrayProperties\Property;
use Reliv\FieldRat\Api\BuildFieldsConfigNameIndex;
use Reliv\FieldRat\Api\Validator\ValidateByFieldConfigValidator;
use Reliv\FieldRat\Api\Validator\ValidateByFieldType;
use Reliv\FieldRat\Api\Validator\ValidateByFieldTypeRequired;
use Reliv\FieldRat\Model\FieldConfig;
use Reliv\FieldRat\Model\FieldsBasic;
use Reliv\FieldRat\Model\FieldType;
use Reliv\ValidationRat\Api\BuildCode;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFields;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFieldsHasOnlyRecognizedFields;
use Reliv\ValidationRat\Api\IsValidFieldResults;
use Reliv\ValidationRat\Model\ValidationResultFields;
use Reliv\ValidationRat\Model\ValidationResultFieldsBasic;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateFieldsByFieldsConfig implements ValidateFields
{
    const OPTION_FIELDS_CONFIG = 'fields-config';
    const OPTION_FIELDS_ALLOWED = ValidateFieldsHasOnlyRecognizedFields::OPTION_FIELDS_ALLOWED;

    const DEFAULT_INVALID_CODE = 'invalid-fields-for-fields-config';

    protected $validateFieldsHasOnlyRecognizedFields;
    protected $validateByFieldTypeRequired;
    protected $validateByFieldType;
    protected $validateByFieldConfigValidator;
    protected $defaultInvalidCode;

    /**
     * @param ValidateFields                 $validateFieldsHasOnlyRecognizedFields
     * @param ValidateByFieldTypeRequired    $validateByFieldTypeRequired
     * @param ValidateByFieldType            $validateByFieldType
     * @param ValidateByFieldConfigValidator $validateByFieldConfigValidator
     * @param string                         $defaultInvalidCode
     */
    public function __construct(
        ValidateFields $validateFieldsHasOnlyRecognizedFields,
        ValidateByFieldTypeRequired $validateByFieldTypeRequired,
        ValidateByFieldType $validateByFieldType,
        ValidateByFieldConfigValidator $validateByFieldConfigValidator,
        string $defaultInvalidCode = self::DEFAULT_INVALID_CODE
    ) {
        $this->validateFieldsHasOnlyRecognizedFields = $validateFieldsHasOnlyRecognizedFields;
        $this->validateByFieldTypeRequired = $validateByFieldTypeRequired;
        $this->validateByFieldType = $validateByFieldType;
        $this->validateByFieldConfigValidator = $validateByFieldConfigValidator;
        $this->defaultInvalidCode = $defaultInvalidCode;
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
        $fieldsConfig = Property::getRequired(
            $options,
            static::OPTION_FIELDS_CONFIG
        );

        $fieldsModel = new FieldsBasic(
            $fieldsConfig
        );

        $fieldsConfigByName = BuildFieldsConfigNameIndex::invoke($fieldsModel->getFieldsConfig());

        // Only recognized fields
        $validationResult = $this->validateFieldsHasOnlyRecognizedFields->__invoke(
            $fields,
            [
                static::OPTION_FIELDS_ALLOWED
                => $this->buildRecognizedFields($fieldsConfigByName)
            ]
        );

        if (!$validationResult->isValid()) {
            return $validationResult;
        }

        $fieldResults = $this->getFieldValidationResults(
            $fields,
            $fieldsConfigByName
        );

        $valid = IsValidFieldResults::invoke(
            $fieldResults,
            $options
        );

        $code = BuildCode::invoke(
            $valid,
            $options,
            $this->defaultInvalidCode
        );

        return new ValidationResultFieldsBasic(
            $valid,
            $code,
            [],
            $fieldResults
        );
    }

    /**
     * @param array $fieldsConfigByName
     *
     * @return array
     */
    protected function buildRecognizedFields(
        array $fieldsConfigByName
    ): array {
        return array_keys($fieldsConfigByName);
    }

    /**
     * @param array $fields
     * @param array $fieldsConfigByName
     * @param array $fieldResults
     *
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Throwable
     * @throws \Reliv\ArrayProperties\Exception\ArrayPropertyException
     */
    protected function getFieldValidationResults(
        array $fields,
        array $fieldsConfigByName = [],
        array $fieldResults = []
    ): array {
        foreach ($fields as $fieldName => $value) {
            $fieldConfig = Property::getRequired(
                $fieldsConfigByName,
                $fieldName
            );

            $required = Property::getBool(
                $fieldConfig,
                FieldConfig::REQUIRED,
                false
            );

            $type = Property::getString(
                $fieldConfig,
                FieldConfig::TYPE,
                FieldType::DEFAULT_TYPE
            );

            $requiredValidationResult = null;

            if ($required) {
                $requiredValidationResult = $this->validateByFieldTypeRequired->__invoke(
                    $value,
                    [
                        ValidateByFieldTypeRequired::OPTION_FIELD_TYPE => $type,
                        ValidateByFieldTypeRequired::OPTION_FIELD_CONFIG => $fieldConfig
                    ]
                );
            }

            if ($required && !$requiredValidationResult->isValid()) {
                $fieldResults[$fieldName] = $requiredValidationResult;
                continue;
            }

            $validationResult = $this->validateByFieldType->__invoke(
                $value,
                [
                    ValidateByFieldType::OPTION_FIELD_TYPE => $type,
                    ValidateByFieldType::OPTION_FIELD_CONFIG => $fieldConfig
                ]
            );

            if (!$validationResult->isValid()) {
                $fieldResults[$fieldName] = $validationResult;
                continue;
            }

            $options = Property::getArray(
                $fieldConfig,
                FieldConfig::OPTIONS,
                []
            );

            $fieldResults[$fieldName] = $this->validateByFieldConfigValidator->__invoke(
                $value,
                [
                    ValidateByFieldType::OPTION_FIELD_TYPE => $type,
                    ValidateByFieldType::OPTION_FIELD_CONFIG => $fieldConfig,
                    ValidateByFieldConfigValidator::OPTION_FIELD_CONFIG_OPTIONS => $options
                ]
            );
        }

        return $fieldResults;
    }
}
