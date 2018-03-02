<?php

namespace Reliv\FieldRat\Api;

use Reliv\FieldRat\Api\Field\FindFieldsByModel;
use Reliv\FieldRat\Api\Validator\ValidateByFieldTypeRequired;
use Reliv\FieldRat\Model\FieldConfig;
use Reliv\FieldRat\Model\FieldType;
use Reliv\ArrayProperties\Property;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class PrepareFieldDefaultsByFieldModelName implements PrepareFieldDefaults
{
    const OPTION_FIELDS_MODEL_NAME = 'fields-model-name';

    protected $validateByFieldTypeRequired;
    protected $findFieldsByModel;

    /**
     * @param ValidateByFieldTypeRequired $validateByFieldTypeRequired
     * @param FindFieldsByModel           $findFieldsByModel
     */
    public function __construct(
        ValidateByFieldTypeRequired $validateByFieldTypeRequired,
        FindFieldsByModel $findFieldsByModel
    ) {
        $this->validateByFieldTypeRequired = $validateByFieldTypeRequired;
        $this->findFieldsByModel = $findFieldsByModel;
    }

    /**
     * @param array $fields ['{name}' => '{value}']
     * @param array $options
     *
     * @return array
     * @throws \Exception
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Throwable
     * @throws \Reliv\ArrayProperties\Exception\ArrayPropertyException
     */
    public function __invoke(
        array $fields,
        array $options = []
    ): array {
        $modelName = Property::getRequired(
            $options,
            static::OPTION_FIELDS_MODEL_NAME
        );

        $fieldsModel= $this->findFieldsByModel->__invoke(
            $modelName
        );

        if (empty($fieldsModel)) {
            throw new \Exception(
                'No fields found for field model: ' . $modelName
            );
        }

        return $this->prepare(
            $fields,
            $fieldsModel->getFieldsConfig()
        );
    }

    /**
     * @param array $fields
     * @param array $fieldsConfig
     *
     * @return array
     * @throws \Exception
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Throwable
     * @throws \Reliv\ArrayProperties\Exception\ArrayPropertyException
     */
    protected function prepare(
        array $fields,
        array $fieldsConfig
    ):array {
        $fieldsConfigByName = BuildFieldsConfigNameIndex::invoke($fieldsConfig);

        $preparedFields = [];

        foreach ($fieldsConfigByName as $name => $fieldConfig) {
            $fieldType = Property::getString(
                $fieldConfig,
                FieldConfig::TYPE,
                FieldType::DEFAULT_TYPE
            );

            $fieldValue = Property::get(
                $fields,
                $name
            );

            $validationResult = $this->validateByFieldTypeRequired->__invoke(
                $fieldValue,
                [ValidateByFieldTypeRequired::OPTION_FIELD_TYPE => $fieldType]
            );

            $required = Property::getBool(
                $fieldConfig,
                FieldConfig::REQUIRED,
                false
            );

            if ($required) {
                // We can not do anything about required values
                $preparedFields[$name] = $fieldValue;
                continue;
            }

            if ($validationResult->isValid()) {
                $preparedFields[$name] = $fieldValue;
                continue;
            }

            $preparedFields[$name] = Property::get(
                $fieldConfig,
                FieldConfig::DEFAULT_VALUE,
                $fieldValue
            );
        }

        return $preparedFields;
    }
}
