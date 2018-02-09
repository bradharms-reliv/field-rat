<?php

namespace Reliv\FieldRat\Api\FieldType;

use Reliv\FieldRat\Model\FieldType;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface FindFieldType
{
    /**
     * @param string $fieldType
     * @param array  $options
     *
     * @return FieldType|null
     */
    public function __invoke(
        string $fieldType,
        array $options = []
    );
}
