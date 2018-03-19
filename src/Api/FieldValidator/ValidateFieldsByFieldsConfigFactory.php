<?php

namespace Reliv\FieldRat\Api\FieldValidator;

use Psr\Container\ContainerInterface;
use Reliv\FieldRat\Api\Validator\ValidateByFieldConfigValidator;
use Reliv\FieldRat\Api\Validator\ValidateByFieldType;
use Reliv\FieldRat\Api\Validator\ValidateByFieldTypeRequired;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFieldsHasOnlyRecognizedFields;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateFieldsByFieldsConfigFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return ValidateFieldsByFieldsConfig
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new ValidateFieldsByFieldsConfig(
            $serviceContainer->get(ValidateFieldsHasOnlyRecognizedFields::class),
            $serviceContainer->get(ValidateByFieldTypeRequired::class),
            $serviceContainer->get(ValidateByFieldType::class),
            $serviceContainer->get(ValidateByFieldConfigValidator::class),
            ValidateFieldsByFieldsConfig::DEFAULT_INVALID_CODE
        );
    }
}
