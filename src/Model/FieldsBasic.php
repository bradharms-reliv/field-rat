<?php

namespace Reliv\FieldRat\Model;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class FieldsBasic extends FieldsAbstract implements Fields
{
    /**
     * @param array $fieldsConfig
     *
     * @throws \Exception
     */
    public function __construct(array $fieldsConfig)
    {
        parent::__construct($fieldsConfig);
    }
}
