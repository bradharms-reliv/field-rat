<?php

namespace Reliv\FieldRat\Api\Field;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FindFieldsByModelBasicFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindFieldsByModelBasic
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        $appConfig = $serviceContainer->get('config');

        return new FindFieldsByModelBasic(
            $appConfig['field-rat-fields-model'],
            $appConfig['field-rat-fields-model-extends'],
            $appConfig['field-rat-fields']
        );
    }
}
