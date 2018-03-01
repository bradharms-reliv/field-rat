<?php

namespace Reliv\FieldRat;

use Reliv\FieldRat\Api\Field\FieldsToArray;
use Reliv\FieldRat\Api\Field\FieldsToArrayBasicFactory;
use Reliv\FieldRat\Api\Field\FieldToArray;
use Reliv\FieldRat\Api\Field\FieldToArrayBasicFactory;
use Reliv\FieldRat\Api\Field\FindFieldsByModel;
use Reliv\FieldRat\Api\Field\FindFieldsByModelBasicFactory;
use Reliv\FieldRat\Api\FieldType\FieldTypeToArray;
use Reliv\FieldRat\Api\FieldType\FieldTypeToArrayBasicFactory;
use Reliv\FieldRat\Api\FieldType\FindFieldType;
use Reliv\FieldRat\Api\FieldType\FindFieldTypeBasicFactory;
use Reliv\FieldRat\Api\FieldType\ListFieldTypes;
use Reliv\FieldRat\Api\FieldType\ListFieldTypesBasicFactory;
use Reliv\FieldRat\Api\FieldValidator\ValidateFieldsByFieldsModelName;
use Reliv\FieldRat\Api\FieldValidator\ValidateFieldsByFieldsModelNameFactory;
use Reliv\FieldRat\Api\PrepareFieldDefaults;
use Reliv\FieldRat\Api\PrepareFieldDefaultsByFieldsModelNameFactory;
use Reliv\FieldRat\Api\Validator\ValidateByFieldConfigValidator;
use Reliv\FieldRat\Api\Validator\ValidateByFieldConfigValidatorFactory;
use Reliv\FieldRat\Api\Validator\ValidateByFieldType;
use Reliv\FieldRat\Api\Validator\ValidateByFieldTypeFactory;
use Reliv\FieldRat\Api\Validator\ValidateByFieldTypeRequired;
use Reliv\FieldRat\Api\Validator\ValidateByFieldTypeRequiredFactory;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ModuleConfig
{
    /**
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => [
                'config_factories' => [
                    /**
                     * Api/Field
                     */
                    FieldsToArray::class => [
                        'factory' => FieldsToArrayBasicFactory::class,
                    ],
                    FieldToArray::class => [
                        'factory' => FieldToArrayBasicFactory::class,
                    ],
                    FindFieldsByModel::class => [
                        'factory' => FindFieldsByModelBasicFactory::class,
                    ],

                    /**
                     * Api/FieldType
                     */
                    FieldTypeToArray::class => [
                        'factory' => FieldTypeToArrayBasicFactory::class,
                    ],
                    FindFieldType::class => [
                        'factory' => FindFieldTypeBasicFactory::class,
                    ],
                    ListFieldTypes::class => [
                        'factory' => ListFieldTypesBasicFactory::class,
                    ],

                    /**
                     * Api/FieldValidator
                     */
                    ValidateFieldsByFieldsModelName::class => [
                        'factory' => ValidateFieldsByFieldsModelNameFactory::class,
                    ],

                    /**
                     * Api/Validator
                     */
                    ValidateByFieldConfigValidator::class => [
                        'factory' => ValidateByFieldConfigValidatorFactory::class,
                    ],
                    ValidateByFieldType::class => [
                        'factory' => ValidateByFieldTypeFactory::class,
                    ],
                    ValidateByFieldTypeRequired::class => [
                        'factory' => ValidateByFieldTypeRequiredFactory::class,
                    ],

                    /**
                     * Api
                     */
                    PrepareFieldDefaults::class => [
                        'factory' => PrepareFieldDefaultsByFieldsModelNameFactory::class,
                    ],
                ],
            ],
        ];
    }
}
