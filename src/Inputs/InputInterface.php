<?php

namespace Phpshko\Test\Inputs;

use Phpshko\Test\Forms\FormInterface;

interface InputInterface
{
    /**
     * @param string        $attribute
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form, string $attribute);

    /**
     * @param $options
     * @return InputInterface
     */
    public function setHtmlOptions($options): InputInterface;

    /**
     * @return string
     */
    public function render(): string;

    /**
     * Need implement for uses case like that
     * ```
     * <?= (new TextInput($form, 'email')) ?>
     * ```
     * @return string
     */
    public function __toString(): string;
}