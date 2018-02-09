<?php

namespace Reliv\FieldRat\Api\Field;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldsToArrayBasicFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FieldsToArrayBasic
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new FieldsToArrayBasic(
            $serviceContainer->get(FieldToArray::class)
        );
    }
}
