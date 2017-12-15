<?php

namespace Phpshko\Test\Forms;

use Phpshko\Test\Exceptions\InvalidConfigException;
use Phpshko\Test\Validators\AbstractValidator;
use Phpshko\Test\Validators\CallbackValidator;
use Phpshko\Test\Validators\RequiredValidatorInterface;
use Phpshko\Test\Validators\ValidatorInterface;

/**
 * Class for build and validate rule from FormInterface::rules() item
 */
class FormRule
{
    /**
     * @var FormInterface
     */
    protected $_form;

    /**
     * @var array
     */
    protected $_rule;

    /**
     * @param FormInterface $form
     * @param array         $rule
     */
    public function __construct(FormInterface $form, array $rule)
    {
        $this->_form = $form;
        $this->_rule = $rule;
    }

    /**
     * Run validate and fill errors to form
     */
    public function validate(): void
    {
        $validator = $this->getValidator();

        foreach ($this->getAttributes() as $attribute) {
            if (!$validator->isEmpty($this->_form->$attribute) || $validator instanceof RequiredValidatorInterface) {
                $validator->validateAttribute($this->_form, $attribute);
            }
        }
    }

    /**
     * @return array
     * @throws InvalidConfigException
     */
    protected function getAttributes(): array
    {
        if (!array_key_exists(0, $this->_rule)) {
            throw new InvalidConfigException('[0] element required should be array of attributes or string');
        }

        return (array)$this->_rule[0];
    }

    /**
     * @return array
     */
    protected function getValidatorConfig(): array
    {
        $config = $this->_rule;
        unset($config[0]);
        unset($config[1]);

        return $config;
    }

    /**
     * @return ValidatorInterface
     * @throws InvalidConfigException
     */
    protected function getValidator(): ValidatorInterface
    {
        $validatorType = $this->_rule[1] ?? null;

        if (!$validatorType || (!is_string($validatorType) && !is_callable($validatorType))) {
            throw new InvalidConfigException('[1] element required should be string or callable');
        }

        $config = $this->getValidatorConfig();

        if (is_callable($validatorType)) {
            $validatorClass = CallbackValidator::class;
            $config['callback'] = $validatorType;
        } elseif (array_key_exists($validatorType, AbstractValidator::$standardValidators)) {
            $validatorClass = AbstractValidator::$standardValidators[$validatorType];
        } elseif (is_subclass_of($validatorType, ValidatorInterface::class)) {
            $validatorClass = $validatorType;
        } else {
            throw new InvalidConfigException('Not found class or alias "' . $validatorType . '" or not implemented "' . ValidatorInterface::class . '"');
        }

        return new $validatorClass($config);
    }
}