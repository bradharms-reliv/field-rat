<?php

namespace Reliv\FieldRat\Api\FieldType;

use Reliv\FieldRat\Model\FieldType;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface FieldTypesToArray
{
    /**
     * @param FieldType[] $fieldTypes
     * @param array       $options
     *
     * @return array
     */
    public function __invoke(
        array $fieldTypes,
        array $options = []
    ): array;
}
