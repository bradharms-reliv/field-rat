<?php

namespace Reliv\FieldRat\Api\Validator;

use Psr\Container\ContainerInterface;
use Reliv\FieldRat\Api\FieldType\FindFieldType;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateByFieldTypeFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return ValidateByFieldType
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new ValidateByFieldType(
            $serviceContainer,
            $serviceContainer->get(FindFieldType::class)
        );
    }
}
