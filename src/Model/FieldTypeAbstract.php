<?php

namespace Reliv\FieldRat\Model;

use Reliv\ArrayProperties\Property;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldTypeAbstract implements FieldType
{
    protected $type;
    protected $properties = [];

    /**
     * @param string $type
     * @param array  $properties
     */
    public function __construct(
        string $type,
        array $properties
    ) {
        $this->type = $type;
        $this->properties = $properties;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function findProperty(
        string $name,
        $default = null
    ) {
        return Property::get(
            $this->getProperties(),
            $name,
            $default
        );
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws \Exception
     */
    public function findPropertyRequired(
        string $name
    ) {
        $class = get_class($this);

        return Property::getRequired(
            $this->getProperties(),
            $name,
            "Required property ({$name}) is missing in: {$class}"
        );
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasProperty(
        string $name
    ): bool {
        return Property::has(
            $this->getProperties(),
            $name
        );
    }
}
