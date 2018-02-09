<?php

namespace Reliv\FieldRat\Api\FieldType;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldTypeToArrayBasicFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FieldTypeToArrayBasic
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new FieldTypeToArrayBasic();
    }
}
