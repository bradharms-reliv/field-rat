<?php

namespace Reliv\FieldRat\Api\Field;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldToArrayBasicFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FieldToArrayBasic
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new FieldToArrayBasic();
    }
}
