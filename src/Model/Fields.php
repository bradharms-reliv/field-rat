<?php

namespace Reliv\FieldRat\Model;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface Fields
{
    /**
     * @param array $fieldsConfig
     *
     * @throws \Exception
     */
    public function __construct(array $fieldsConfig);

    /**
     * @param string $name
     *
     * @return Field
     */
    public function findField(string $name): Field;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasField(string $name): bool;

    /**
     * @return Field[]
     */
    public function getFields(): array;

    /**
     * @return array ['{name}' => {default}]
     */
    public function getFieldDefaults(): array;

    /**
     * @return array
     */
    public function getFieldsConfig(): array;
}
