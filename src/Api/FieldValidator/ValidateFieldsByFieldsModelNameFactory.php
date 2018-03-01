<?php

namespace Reliv\FieldRat\Api\FieldValidator;

use Psr\Container\ContainerInterface;
use Reliv\FieldRat\Api\Field\FindFieldsByModel;
use Reliv\FieldRat\Api\Validator\ValidateByFieldConfigValidator;
use Reliv\FieldRat\Api\Validator\ValidateByFieldType;
use Reliv\FieldRat\Api\Validator\ValidateByFieldTypeRequired;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFieldsHasOnlyRecognizedFields;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateFieldsByFieldsModelNameFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return ValidateFieldsByFieldsModelName
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new ValidateFieldsByFieldsModelName(
            $serviceContainer->get(FindFieldsByModel::class),
            $serviceContainer->get(ValidateFieldsHasOnlyRecognizedFields::class),
            $serviceContainer->get(ValidateByFieldTypeRequired::class),
            $serviceContainer->get(ValidateByFieldType::class),
            $serviceContainer->get(ValidateByFieldConfigValidator::class),
            ValidateFieldsByFieldsModelName::DEFAULT_INVALID_CODE
        );
    }
}
