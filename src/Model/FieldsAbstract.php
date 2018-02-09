<?php

namespace Reliv\FieldRat\Model;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldsAbstract
{
    /**
     * @var array
     */
    protected $fieldsConfig = [];

    /**
     * @var array
     */
    protected $fieldsNameIndex = [];

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @param array $fieldsConfig
     *
     * @throws \Exception
     */
    public function __construct(array $fieldsConfig)
    {
        $fieldsArray = [];

        foreach ($fieldsConfig as $fieldConfig) {
            $field = FieldBasic::build($fieldConfig);
            $fieldsArray[] = $field;
        }

        foreach ($fieldsArray as $field) {
            $this->addField($field);
        }

        $this->fieldsConfig = $fieldsConfig;
    }

    /**
     * @param string $name
     *
     * @return Field
     */
    public function findField(string $name): Field
    {
        if ($this->hasField($name)) {
            return $this->fields[$this->fieldsNameIndex[$name]];
        }

        return null;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasField(string $name): bool
    {
        return array_key_exists($name, $this->fieldsNameIndex);
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return array ['{name}' => {default}]
     */
    public function getFieldDefaults(): array
    {
        $defaults = [];
        /** @var Field $field */
        foreach ($this->fields as $field) {
            $defaults[$field->getName()] = $field->getDefault();
        }

        return $defaults;
    }

    /**
     * @return array
     */
    public function getFieldsConfig(): array
    {
        return $this->fieldsConfig;
    }

    /**
     * @param Field $field
     *
     * @return void
     * @throws \Exception
     */
    protected function addField(Field $field)
    {
        if ($this->hasField($field->getName())) {
            throw new \Exception(
                'Field already defined for name: ' . $field->getName()
            );
        }

        $index = count($this->fields);

        $this->fieldsNameIndex[$index] = $field->getName();
        $this->fields[] = $field;
    }
}
