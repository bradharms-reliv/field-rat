<?php

namespace Reliv\FieldRat\Api\Validator;

use Psr\Container\ContainerInterface;
use Reliv\ArrayProperties\Property;
use Reliv\FieldRat\Api\BuildFieldRatValidationOptions;
use Reliv\FieldRat\Api\BuildFieldRatValidationResult;
use Reliv\FieldRat\Api\FieldType\FindFieldType;
use Reliv\FieldRat\Model\FieldTypeConfig;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFields;
use Reliv\ValidationRat\Api\Validator\Validate;
use Reliv\ValidationRat\Model\ValidationResult;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateByFieldTypeRequired implements Validate
{
    const OPTION_FIELD_CONFIG = BuildFieldRatValidationResult::OPTION_FIELD_CONFIG;
    const OPTION_FIELD_TYPE = BuildFieldRatValidationResult::OPTION_FIELD_TYPE;

    protected $serviceContainer;
    protected $findFieldType;

    /**
     * @param ContainerInterface $serviceContainer
     * @param FindFieldType      $findFieldType
     */
    public function __construct(
        ContainerInterface $serviceContainer,
        FindFieldType $findFieldType
    ) {
        $this->serviceContainer = $serviceContainer;
        $this->findFieldType = $findFieldType;
    }

    /**
     * @param mixed $value
     * @param array $options
     *
     * @return ValidationResult
     * @throws \Exception
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Throwable
     * @throws \Reliv\ArrayProperties\Exception\ArrayPropertyException
     */
    public function __invoke(
        $value,
        array $options = []
    ): ValidationResult {
        $fieldType = (string)Property::getRequired(
            $options,
            static::OPTION_FIELD_TYPE
        );

        $fieldTypeObject = $this->findFieldType->__invoke(
            $fieldType
        );

        if (empty($fieldTypeObject)) {
            throw new \Exception(
                'Field type: (' . $fieldType . ') not found'
            );
        }

        /** @var Validate|ValidateFields $validator */
        $validator = $this->serviceContainer->get(
            $fieldTypeObject->findProperty(
                FieldTypeConfig::VALIDATOR_REQUIRED
            )
        );

        $validatorOptions = BuildFieldRatValidationOptions::invoke(
            $fieldTypeObject->findProperty(
                FieldTypeConfig::VALIDATOR_REQUIRED_OPTIONS
            ),
            $options
        );

        return BuildFieldRatValidationResult::invoke(
            $validator->__invoke(
                $value,
                $validatorOptions
            ),
            $options
        );
    }
}
