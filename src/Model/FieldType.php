<?php

namespace Reliv\FieldRat\Model;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface FieldType
{
    const DEFAULT_TYPE = 'text';

    /**
     * @param string $type
     * @param array  $properties
     */
    public function __construct(
        string $type,
        array $properties
    );

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return array
     */
    public function getProperties(): array;

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function findProperty(
        string $name,
        $default = null
    );

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasProperty(
        string $name
    ): bool;
}
