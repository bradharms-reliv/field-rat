<?php

namespace Reliv\FieldRat\Api\FieldType;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ListFieldTypesBasicFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return ListFieldTypesBasic
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        $appConfig = $serviceContainer->get('config');

        return new ListFieldTypesBasic(
            $appConfig['field-rat-field-types']
        );
    }
}
