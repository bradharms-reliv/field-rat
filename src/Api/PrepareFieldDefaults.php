<?php

namespace Reliv\FieldRat\Api;

/**
 * @author James Jervis - https://github.com/jerv13
 */
interface PrepareFieldDefaults
{
    /**
     * @param array $fields ['{name}' => '{value}']
     * @param array $options
     *
     * @return array
     * @throws \Exception
     */
    public function __invoke(
        array $fields,
        array $options = []
    ): array;
}
