<?php

namespace Phpshko\Test\Validators;

use Phpshko\Test\Forms\FormInterface;
use Phpshko\Test\Helpers\ConfigHelper;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var array Mapping alias for validators classes
     */
    public static $standardValidators = [
        'required' => RequiredValidatorValidator::class,
        'string'   => StringValidator::class,
        'in'       => InValidator::class,
        'email'    => EmailValidator::class,
    ];

    /**
     * @var string Form attribute name
     */
    public $attribute = '';

    /**
     * @var string Template for error message. Allow placeholder like {attribute}
     */
    public $message = '';

    /**
     * @inheritdoc
     */
    public function __construct(array $config = [])
    {
        ConfigHelper::load($this, $config);
    }

    /**
     * @param FormInterface $form
     * @param string        $attribute
     * @return bool
     */
    public function validateAttribute(FormInterface $form, string $attribute): bool
    {
        $errors = $this->validateValue($form->$attribute);
        if (!empty($errors)) {
            foreach ($errors as [$message, $params]) {
                $this->addError($form, $attribute, $message, $params);
            }
            return false;
        }

        return true;
    }

    /**
     * Validate value and return boolean result
     * @param mixed $value
     * @return bool
     */
    final public function validate($value): bool
    {
        return empty($this->validateValue($value));
    }

    /**
     * @inheritdoc
     */
    public function isEmpty($value): bool
    {
        return $value === null || $value === [] || $value === '';
    }

    /**
     * @param FormInterface $form
     * @param string        $attribute
     * @param string        $message
     * @param array         $params
     */
    protected function addError(FormInterface $form, string $attribute, string $message, array $params = [])
    {
        $form->addError($attribute, $message, $params);
    }

    /**
     * @return array
     */
    protected function getDefaultErrors(): array
    {
        return [[$this->message, []]];
    }
}