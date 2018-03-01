<?php

namespace Reliv\FieldRat\Api\FieldValidator;

use Reliv\FieldRat\Api\BuildFieldsConfigNameIndex;
use Reliv\FieldRat\Api\Field\FindFieldsByModel;
use Reliv\FieldRat\Api\Validator\ValidateByFieldConfigValidator;
use Reliv\FieldRat\Api\Validator\ValidateByFieldType;
use Reliv\FieldRat\Api\Validator\ValidateByFieldTypeRequired;
use Reliv\FieldRat\Model\FieldConfig;
use Reliv\FieldRat\Model\FieldType;
use Reliv\ValidationRat\Api\BuildCode;
use Reliv\ValidationRat\Api\IsValidFieldResults;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFields;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFieldsHasOnlyRecognizedFields;
use Reliv\ValidationRat\Model\ValidationResultFields;
use Reliv\ValidationRat\Model\ValidationResultFieldsBasic;
use Reliv\ArrayProperties\Property;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateFieldsByFieldsModelName implements ValidateFields
{
    const OPTION_FIELDS_MODEL_NAME = 'fields-model-name';

    const DEFAULT_INVALID_CODE = 'invalid-fields-for-fields-config';

    protected $findFieldsByModel;
    protected $validateFieldsHasOnlyRecognizedFields;
    protected $validateByFieldTypeRequired;
    protected $validateByFieldType;
    protected $validateByFieldConfigValidator;
    protected $defaultInvalidCode;

    /**
     * @param FindFieldsByModel              $findFieldsByModel
     * @param ValidateFields                 $validateFieldsHasOnlyRecognizedFields
     * @param ValidateByFieldTypeRequired    $validateByFieldTypeRequired
     * @param ValidateByFieldType            $validateByFieldType
     * @param ValidateByFieldConfigValidator $validateByFieldConfigValidator
     * @param string                         $defaultInvalidCode
     */
    public function __construct(
        FindFieldsByModel $findFieldsByModel,
        ValidateFields $validateFieldsHasOnlyRecognizedFields,
        ValidateByFieldTypeRequired $validateByFieldTypeRequired,
        ValidateByFieldType $validateByFieldType,
        ValidateByFieldConfigValidator $validateByFieldConfigValidator,
        string $defaultInvalidCode = self::DEFAULT_INVALID_CODE
    ) {
        $this->findFieldsByModel = $findFieldsByModel;
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
        $modelName = Property::getRequired(
            $options,
            static::OPTION_FIELDS_MODEL_NAME
        );

        $fieldsModel = $this->findFieldsByModel->__invoke(
            $modelName
        );

        if (empty($fieldsModel)) {
            throw new \Exception(
                'No fields found for field model: ' . $modelName
            );
        }

        $fieldsConfigByName = BuildFieldsConfigNameIndex::invoke($fieldsModel->getFieldsConfig());

        // Only recognized fields
        $validationResult = $this->validateFieldsHasOnlyRecognizedFields->__invoke(
            $fields,
            [
                ValidateFieldsHasOnlyRecognizedFields::OPTION_FIELDS_ALLOWED
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
                    [ValidateByFieldTypeRequired::OPTION_FIELD_TYPE => $type]
                );
            }

            if ($required && !$requiredValidationResult->isValid()) {
                $fieldResults[$fieldName] = $requiredValidationResult;
                continue;
            }

            $validationResult = $this->validateByFieldType->__invoke(
                $value,
                [ValidateByFieldType::OPTION_FIELD_TYPE => $type]
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
                [ValidateByFieldConfigValidator::OPTION_FIELD_CONFIG_OPTIONS => $options]
            );
        }

        return $fieldResults;
    }
}
