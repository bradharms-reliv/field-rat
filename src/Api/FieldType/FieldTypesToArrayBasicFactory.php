<?php

namespace Reliv\FieldRat\Api\FieldType;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldTypesToArrayBasicFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FieldTypesToArrayBasic
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new FieldTypesToArrayBasic(
            $serviceContainer->get(FieldTypeToArray::class)
        );
    }
}
