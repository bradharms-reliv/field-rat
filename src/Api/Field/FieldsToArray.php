<?php

namespace Reliv\FieldRat\Api\Field;

use Reliv\FieldRat\Model\Fields;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface FieldsToArray
{
    /**
     * @param Fields $fields
     * @param array  $options
     *
     * @return array
     */
    public function __invoke(
        Fields $fields,
        array $options = []
    ): array;
}
