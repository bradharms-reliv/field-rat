<?php

namespace Reliv\FieldRat\Api\Field;

use Reliv\FieldRat\Model\Field;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldToArrayBasic implements FieldToArray
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
    ): array {
        return [
            'name' => $field->getName(),
            'type' => $field->getType(),
            'label' => $field->getLabel(),
            'required' => $field->isRequired(),
            'default' => $field->getDefault(),
            'options' => (object)$field->getOptions(),
        ];
    }
}
