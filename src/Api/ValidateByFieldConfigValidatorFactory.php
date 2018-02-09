<?php

namespace Reliv\FieldRat\Api;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateByFieldConfigValidatorFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return ValidateByFieldConfigValidator
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new ValidateByFieldConfigValidator(
            $serviceContainer
        );
    }
}
