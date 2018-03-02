<?php

namespace Reliv\FieldRat\Api\FieldType;

use Reliv\FieldRat\Model\FieldType;
use Reliv\FieldRat\Model\FieldTypeBasic;
use Reliv\Json\Json;

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
     * @throws \Exception
     */
    public function __invoke(
        array $options = []
    ): array {
        $fieldTypes = [];

        foreach ($this->fieldTypesConfig as $name => $fieldTypeConfig) {
            if (!is_string($name)) {
                throw new \Exception(
                    'Field type name must be a string, got ' . Json::encode($name)
                    . ' with value: ' . Json::encode($fieldTypeConfig)
                );
            }
            if (!is_array($fieldTypeConfig)) {
                throw new \Exception(
                    'Field type config must be a array, got ' . Json::encode($fieldTypeConfig)
                );
            }
            $fieldTypes[] = new FieldTypeBasic(
                $name,
                $fieldTypeConfig
            );
        }

        return $fieldTypes;
    }
}
