<?php

namespace Reliv\FieldRat\Model;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldBasic extends FieldAbstract implements Field
{
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
        parent::__construct(
            $name,
            $type,
            $label,
            $required,
            $default,
            $options
        );
    }
}
