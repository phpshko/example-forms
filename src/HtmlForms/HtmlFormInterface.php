<?php

namespace Phpshko\Test\HtmlForms;

use Phpshko\Test\Forms\FormInterface;

interface HtmlFormInterface
{
    /**
     * HtmlFormInterface constructor.
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form);

    /**
     * @param array $options
     * @return string
     */
    public function begin(array $options = []): string;

    /**
     * @param array $attributes
     * @return array
     */
    public function getErrors(array $attributes = []): array;

    /**
     * @return bool
     */
    public function hasErrors(): bool;

    /**
     * @return string
     */
    public function end(): string;
}