<?php

namespace Phpshko\Test\Inputs;

use Phpshko\Test\Helpers\HtmlHelper;

class PasswordInput extends AbstractInput
{
    /**
     * @inheritdoc
     */
    public function render(): string
    {
        $options = [
            'type'  => 'password',
            'name'  => $this->_attribute,
            'value' => $this->getValue()
        ];
        return '<input ' . HtmlHelper::formatOptions($this->_htmlOptions, $options) . ' />';
    }
}