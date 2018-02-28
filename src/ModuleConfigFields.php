<?php

namespace Reliv\FieldRat;

use Reliv\ValidationRat\Api\FieldValidator\ValidateFieldsByStrategy;
use Reliv\ValidationRat\Api\Validator\ValidateIsArray;
use Reliv\ValidationRat\Api\Validator\ValidateIsBoolean;
use Reliv\ValidationRat\Api\Validator\ValidateIsClass;
use Reliv\ValidationRat\Api\Validator\ValidateIsInt;
use Reliv\ValidationRat\Api\Validator\ValidateIsNotEmpty;
use Reliv\ValidationRat\Api\Validator\ValidateIsObject;
use Reliv\ValidationRat\Api\Validator\ValidateIsRealValue;
use Reliv\ValidationRat\Api\Validator\ValidateIsString;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ModuleConfigFields
{
    /**
     * @return array
     */
    public function __invoke()
    {
        return [
            /**
             * ===== Field Models =====
             * ['{model-name}' => '{model-class}']
             */
            'field-rat-fields-model' => [],

            /**
             * ===== Field Model Extends =====
             * ['{model-name}' => '{extends-model-name}']
             */
            'field-rat-fields-model-extends' => [],

            /**
             * ===== Fields =====
             * ['{model-name}' => '{fields-config}']
             */
            'field-rat-fields' => [],

            /**
             * ===== Field Types =====
             */
            'field-rat-field-types' => [
                'array' => [
                    'validator' => ValidateIsArray::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'bool' => [
                    'validator' => ValidateIsBoolean::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'class' => [
                    'validator' => ValidateIsClass::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'fields' => [
                    'validator' => ValidateFieldsByStrategy::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'id' => [
                    'validator' => ValidateIsNotEmpty::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'id-string' => [
                    'validator' => ValidateIsString::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'id-int' => [
                    'validator' => ValidateIsInt::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'object' => [
                    'validator' => ValidateIsObject::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'string' => [
                    'validator' => ValidateIsString::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'text' => [
                    'validator' => ValidateIsString::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
            ],
        ];
    }
}
