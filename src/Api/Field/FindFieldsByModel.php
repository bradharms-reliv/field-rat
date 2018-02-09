<?php

namespace Reliv\FieldRat\Api\Field;

use Reliv\FieldRat\Model\Fields;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface FindFieldsByModel
{
    /**
     * @param string $modelName
     * @param array  $options
     *
     * @return Fields|null
     * @throws \Exception
     */
    public function __invoke(
        string $modelName,
        array $options = []
    );
}
