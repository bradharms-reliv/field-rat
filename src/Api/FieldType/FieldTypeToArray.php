<?php

namespace Reliv\FieldRat\Api\FieldType;

use Reliv\FieldRat\Model\FieldType;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface FieldTypeToArray
{
    /**
     * @param FieldType $fieldType
     * @param array     $options
     *
     * @return array
     */
    public function __invoke(
        FieldType $fieldType,
        array $options = []
    ): array;
}
