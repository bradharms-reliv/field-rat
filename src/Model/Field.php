<?php

namespace Reliv\FieldRat\Model;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface Field
{
    /**
     * @param array $fieldConfig
     *
     * @return Field
     */
    public static function build(array $fieldConfig):Field;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * @return mixed
     */
    public function getDefault();

    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function findOption(string $name, $default = null);
}
