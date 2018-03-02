<?php

namespace Reliv\FieldRat\Api\Validator;

use Psr\Container\ContainerInterface;
use Reliv\FieldRat\Api\BuildFieldRatValidationOptions;
use Reliv\FieldRat\Api\BuildFieldRatValidationResult;
use Reliv\ValidationRat\Api\Validator\Validate;
use Reliv\ValidationRat\Api\FieldValidator\ValidateFields;
use Reliv\ValidationRat\Model\ValidationResult;
use Reliv\ValidationRat\Model\ValidationResultBasic;
use Reliv\ArrayProperties\Property;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ValidateByFieldConfigValidator implements Validate
{
    const OPTION_FIELD_CONFIG = BuildFieldRatValidationResult::OPTION_FIELD_CONFIG;
    const OPTION_FIELD_TYPE = BuildFieldRatValidationOptions::OPTION_FIELD_TYPE;
    const OPTION_FIELD_CONFIG_OPTIONS = 'field-config-options';
    const OPTION_FIELD_CONFIG_OPTIONS_VALIDATOR = 'validator';
    const OPTION_FIELD_CONFIG_OPTIONS_VALIDATOR_OPTIONS = 'validator-options';

    protected $serviceContainer;

    /**
     * @param ContainerInterface $serviceContainer
     */
    public function __construct(
        ContainerInterface $serviceContainer
    ) {
        $this->serviceContainer = $serviceContainer;
    }

    /**
     * @param mixed $value
     * @param array $options
     *
     * @return ValidationResult
     * @throws \Exception
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Throwable
     * @throws \Reliv\ArrayProperties\Exception\ArrayPropertyException
     */
    public function __invoke(
        $value,
        array $options = []
    ): ValidationResult {
        $fieldConfigOptions = Property::getRequired(
            $options,
            static::OPTION_FIELD_CONFIG_OPTIONS
        );

        $validatorServiceName = Property::getString(
            $fieldConfigOptions,
            static::OPTION_FIELD_CONFIG_OPTIONS_VALIDATOR
        );

        if (empty($validatorServiceName)) {
            // No validator means nothing to validate
            return new ValidationResultBasic();
        }

        /** @var Validate|ValidateFields $validator */
        $validator = $this->serviceContainer->get($validatorServiceName);

        $validatorOptions = BuildFieldRatValidationOptions::invoke(
            Property::getArray(
                $fieldConfigOptions,
                static::OPTION_FIELD_CONFIG_OPTIONS_VALIDATOR_OPTIONS,
                []
            ),
            $options
        );

        return BuildFieldRatValidationResult::invoke(
            $validator->__invoke(
                $value,
                $validatorOptions
            ),
            $options
        );
    }
}
