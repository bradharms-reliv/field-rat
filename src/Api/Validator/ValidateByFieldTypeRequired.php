<?php

namespace Reliv\FieldRat\Api\Validator;

use Psr\Container\ContainerInterface;
use Reliv\FieldRat\Api\FieldType\FindFieldType;
use Reliv\FieldRat\Model\FieldTypeConfig;
use Reliv\ValidationRat\Api\Validator\Validate;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFields;
use Reliv\ValidationRat\Model\ValidationResult;
use Reliv\ArrayProperties\Property;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateByFieldTypeRequired implements Validate
{
    const OPTION_FIELD_TYPE = 'field-type';

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
        $fieldType = Property::getRequired(
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

        $validatorOptions = $fieldTypeObject->findProperty(
            FieldTypeConfig::VALIDATOR_REQUIRED_OPTIONS
        );

        return $validator->__invoke(
            $value,
            $validatorOptions
        );
    }
}
