<?php

namespace Reliv\FieldRat\Api\FieldType;

use Reliv\FieldRat\Model\FieldType;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FindFieldTypeBasic implements FindFieldType
{
    protected $listFieldTypes;

    /**
     * @param ListFieldTypes $listFieldTypes
     */
    public function __construct(
        ListFieldTypes $listFieldTypes
    ) {
        $this->listFieldTypes = $listFieldTypes;
    }

    /**
     * @param string $type
     * @param array  $options
     *
     * @return null|FieldType
     */
    public function __invoke(
        string $type,
        array $options = []
    ) {
        $fieldTypes = $this->listFieldTypes->__invoke();

        $results = array_filter(
            $fieldTypes,
            function (FieldType $fieldType) use ($type) {
                return ($fieldType->getType() == $type);
            }
        );

        if (empty($results)) {
            return null;
        }

        return array_values($results)[0];
    }
}
