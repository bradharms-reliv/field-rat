<?php

namespace Reliv\FieldRat\Api\Field;

use Reliv\FieldRat\Model\Fields;
use Reliv\ArrayProperties\Property;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FindFieldsByModelBasic implements FindFieldsByModel
{
    protected $fieldsModelConfig;
    protected $fieldsModelExtendsConfig;
    protected $fieldsModelFieldsConfig;

    /**
     * @param array $fieldsModelConfig
     * @param array $fieldsModelFieldsConfig
     */
    public function __construct(
        array $fieldsModelConfig,
        array $fieldsModelExtendsConfig,
        array $fieldsModelFieldsConfig
    ) {
        $this->fieldsModelConfig = $fieldsModelConfig;
        $this->fieldsModelExtendsConfig = $fieldsModelExtendsConfig;
        $this->fieldsModelFieldsConfig = $fieldsModelFieldsConfig;
    }

    /**
     * @param string $modelName
     * @param array  $options
     *
     * @return null|string|Fields
     * @throws \Exception
     */
    public function __invoke(
        string $modelName,
        array $options = []
    ) {
        $fieldsModel = Property::getString(
            $this->fieldsModelConfig,
            $modelName
        );

        if (empty($fieldsModel)) {
            return null;
        }

        $fieldsConfig = Property::getArray(
            $this->fieldsModelFieldsConfig,
            $modelName,
            []
        );

        $fieldsConfig = $this->buildExtendsModelConfig(
            $modelName,
            $fieldsConfig
        );

        /** @var Fields $fields */
        $fields = new $fieldsModel($fieldsConfig);

        if (!$fields instanceof Fields) {
            throw new \Exception(
                'Fields model: (' . $modelName . ')'
                . ' must be instance of: (' . Fields::class . ')'
                . ' got ' . $fieldsModel
            );
        }

        return $fields;
    }

    /**
     * @param string $modelName
     * @param array  $fieldsConfig
     *
     * @return array
     */
    protected function buildExtendsModelConfig(
        string $modelName,
        array $fieldsConfig
    ): array {
        $modelExtendsName = Property::getString(
            $this->fieldsModelExtendsConfig,
            $modelName
        );

        if (empty($modelExtendsName)) {
            return [];
        }

        $extendsModelConfig = Property::getArray(
            $this->fieldsModelFieldsConfig,
            $modelExtendsName,
            []
        );

        return array_merge(
            $extendsModelConfig,
            $fieldsConfig
        );

    }
}
