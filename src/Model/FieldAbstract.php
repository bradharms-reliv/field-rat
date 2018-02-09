<?php

namespace Reliv\FieldRat\Model;

use Reliv\ArrayProperties\Property;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldAbstract
{
    /**
     * @param array $fieldConfig
     *
     * @return Field|FieldAbstract
     */
    public static function build(array $fieldConfig): Field
    {
        return new static(
            Property::getString($fieldConfig, FieldConfig::NAME),
            Property::getString($fieldConfig, FieldConfig::TYPE),
            Property::getString($fieldConfig, FieldConfig::LABEL),
            Property::getBool($fieldConfig, FieldConfig::REQUIRED, false),
            Property::get($fieldConfig, FieldConfig::DEFAULT_VALUE, null),
            Property::getArray($fieldConfig, FieldConfig::OPTIONS, [])
        );
    }

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var bool
     */
    protected $default = null;

    /**
     * @var bool
     */
    protected $options = [];

    /**
     * @param string $name
     * @param string $type
     * @param string $label
     * @param bool   $required
     * @param null   $default
     * @param array  $options
     */
    public function __construct(
        string $name,
        string $type,
        string $label,
        bool $required = false,
        $default = null,
        array $options = []
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->required = $required;
        $this->default = $default;
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param string     $name
     * @param null|mixed $default
     *
     * @return mixed
     */
    public function findOption(string $name, $default = null)
    {
        if (array_key_exists($name, $this->options)) {
            return $this->options[$name];
        }

        return $default;
    }
}
