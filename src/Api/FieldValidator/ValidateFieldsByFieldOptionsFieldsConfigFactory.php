<?php

namespace Reliv\FieldRat\Api\FieldValidator;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateFieldsByFieldOptionsFieldsConfigFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return ValidateFieldsByFieldOptionsFieldsConfig
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new ValidateFieldsByFieldOptionsFieldsConfig(
            $serviceContainer->get(ValidateFieldsByFieldsConfig::class)
        );
    }
}
