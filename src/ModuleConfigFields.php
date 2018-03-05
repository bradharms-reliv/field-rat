<?php

namespace Reliv\FieldRat;

use Reliv\ValidationRat\Api\FieldValidator\ValidateFieldsByStrategy;
use Reliv\ValidationRat\Api\Validator\ValidateIsAnyValue;
use Reliv\ValidationRat\Api\Validator\ValidateIsArrayOrNull;
use Reliv\ValidationRat\Api\Validator\ValidateIsBooleanOrNull;
use Reliv\ValidationRat\Api\Validator\ValidateIsClass;
use Reliv\ValidationRat\Api\Validator\ValidateIsIntOrNull;
use Reliv\ValidationRat\Api\Validator\ValidateIsNotEmpty;
use Reliv\ValidationRat\Api\Validator\ValidateIsObjectOrNull;
use Reliv\ValidationRat\Api\Validator\ValidateIsRealValue;
use Reliv\ValidationRat\Api\Validator\ValidateIsStringOrNull;

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
                    'validator' => ValidateIsArrayOrNull::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'bool' => [
                    'validator' => ValidateIsBooleanOrNull::class,
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
                    'validator-options' => [// Details required],
                        'validator-required' => ValidateIsRealValue::class,
                        'validator-required-options' => [],
                    ],
                ],
                'id' => [
                    'validator' => ValidateIsAnyValue::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'id-string' => [
                    'validator' => ValidateIsStringOrNull::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'id-int' => [
                    'validator' => ValidateIsIntOrNull::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'image' => [
                    'validator' => ValidateIsStringOrNull::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'object' => [
                    'validator' => ValidateIsObjectOrNull::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'string' => [
                    'validator' => ValidateIsStringOrNull::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
                'text' => [
                    'validator' => ValidateIsStringOrNull::class,
                    'validator-options' => [],
                    'validator-required' => ValidateIsRealValue::class,
                    'validator-required-options' => [],
                ],
            ],
        ];
    }
}
