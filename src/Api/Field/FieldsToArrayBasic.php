<?php

namespace Reliv\FieldRat\Api\Field;

use Reliv\FieldRat\Model\Field;
use Reliv\FieldRat\Model\Fields;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldsToArrayBasic implements FieldsToArray
{
    protected $fieldToArray;

    /**
     * @param FieldToArray $fieldToArray
     */
    public function __construct(
        FieldToArray $fieldToArray
    ) {
        $this->fieldToArray = $fieldToArray;
    }

    /**
     * @param Fields $fields
     * @param array  $options
     *
     * @return array
     */
    public function __invoke(
        Fields $fields,
        array $options = []
    ): array {
        $array = [];

        $fieldList = $fields->getFields();

        /** @var Field $field */
        foreach ($fieldList as $field) {
            $array[] = $this->fieldToArray->__invoke(
                $field
            );
        }

        return $array;
    }
}
