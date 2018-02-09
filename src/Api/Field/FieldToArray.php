<?php

namespace Reliv\FieldRat\Api\Field;

use Reliv\FieldRat\Model\Field;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface FieldToArray
{
    /**
     * @param Field $field
     * @param array $options
     *
     * @return array
     */
    public function __invoke(
        Field $field,
        array $options = []
    ): array;
}
