<?php

namespace Reliv\FieldRat\Api\FieldType;

use Reliv\FieldRat\Model\FieldType;
use Reliv\FieldRat\Model\FieldTypeBasic;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ListFieldTypesBasic implements ListFieldTypes
{
    protected $fieldTypesConfig;

    /**
     * @param array $fieldTypesConfig
     */
    public function __construct(
        array $fieldTypesConfig
    ) {
        $this->fieldTypesConfig = $fieldTypesConfig;
    }

    /**
     * @param array $options
     *
     * @return FieldType[]
     */
    public function __invoke(
        array $options = []
    ): array {
        $fieldTypes = [];

        foreach ($this->fieldTypesConfig as $name => $fieldTypeConfig) {
            $fieldTypes[] = new FieldTypeBasic(
                $name,
                $fieldTypeConfig
            );
        }

        return $fieldTypes;
    }
}
