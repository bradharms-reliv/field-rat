<?php

namespace Reliv\FieldRat\Model;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldTypeBasic extends FieldTypeAbstract implements FieldType
{
    /**
     * @param string $type
     * @param array  $properties
     */
    public function __construct(
        string $type,
        array $properties
    ) {
        parent::__construct(
            $type,
            $properties
        );
    }
}
