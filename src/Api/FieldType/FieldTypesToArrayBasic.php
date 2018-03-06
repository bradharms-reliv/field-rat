<?php

namespace Reliv\FieldRat\Api\FieldType;

use Reliv\FieldRat\Model\FieldType;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldTypesToArrayBasic implements FieldTypesToArray
{
    protected $fieldTypeToArray;

    /**
     * @param FieldTypeToArray $fieldTypeToArray
     */
    public function __construct(
        FieldTypeToArray $fieldTypeToArray
    ) {
        $this->fieldTypeToArray = $fieldTypeToArray;
    }

    /**
     * @param FieldType[] $fieldTypes
     * @param array       $options
     *
     * @return array
     */
    public function __invoke(
        array $fieldTypes,
        array $options = []
    ): array {
        $result = [];
        foreach ($fieldTypes as $fieldType) {
            $result[] = $this->fieldTypeToArray->__invoke(
                $fieldType
            );
        }

        return $result;
    }
}
