<?php

namespace Reliv\FieldRat\Api;

use Psr\Container\ContainerInterface;
use Reliv\FieldRat\Api\Field\FindFieldsByModel;
use Reliv\FieldRat\Api\Validator\ValidateByFieldTypeRequired;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class PrepareFieldDefaultsByFieldsModelNameFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return PrepareFieldDefaultsByFieldModelName
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new PrepareFieldDefaultsByFieldModelName(
            $serviceContainer->get(ValidateByFieldTypeRequired::class),
            $serviceContainer->get(FindFieldsByModel::class)
        );
    }
}
