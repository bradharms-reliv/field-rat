<?php
namespace Reliv\FieldRat\Api\FieldType;

use Reliv\FieldRat\Model\FieldType;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface ListFieldTypes
{
    /**
     * @param array $options
     *
     * @return FieldType[]
     */
    public function __invoke(
        array $options = []
    ):array;
}
