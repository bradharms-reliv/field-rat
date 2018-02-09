<?php

namespace Reliv\FieldRat\Api\FieldType;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FindFieldTypeBasicFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindFieldTypeBasic
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new FindFieldTypeBasic(
            $serviceContainer->get(ListFieldTypes::class)
        );
    }
}
