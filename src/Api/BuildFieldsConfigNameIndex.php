<?php

namespace Reliv\FieldRat\Api;

use Reliv\FieldRat\Model\FieldConfig;
use Reliv\ArrayProperties\Property;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class BuildFieldsConfigNameIndex
{
    /**
     * @param array $fieldsConfig
     *
     * @return array
     * @throws \Throwable
     * @throws \Reliv\ArrayProperties\Exception\ArrayPropertyException
     */
    public static function invoke(
        array $fieldsConfig
    ): array {
        $fieldsConfigByName = [];
        foreach ($fieldsConfig as $fieldConfig) {
            $name = Property::getRequired(
                $fieldConfig,
                FieldConfig::NAME
            );
            $fieldsConfigByName[$name] = $fieldConfig;
        }

        return $fieldsConfigByName;
    }
}
