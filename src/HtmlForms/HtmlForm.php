<?php

namespace Phpshko\Test\HtmlForms;

use Phpshko\Test\Forms\FormInterface;
use Phpshko\Test\Helpers\HtmlHelper;

class HtmlForm implements HtmlFormInterface
{
    /**
     * @var FormInterface
     */
    protected $_form;

    /**
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form)
    {
        $this->_form = $form;
    }

    /**
     * @inheritdoc
     */
    public function begin(array $options = []): string
    {
        return '<form ' . HtmlHelper::formatOptions(['method' => 'POST'], $options) . '>';
    }

    /**
     * @inheritdoc
     */
    public function getErrors(array $attributes = []): array
    {
        return $this->_form->getErrors($attributes);
    }

    /**
     * @inheritdoc
     */
    public function hasErrors(): bool
    {
        return $this->_form->hasErrors();
    }

    /**
     * @inheritdoc
     */
    public function end(): string
    {
        return '</form>';
    }
}