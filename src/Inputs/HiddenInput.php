<?php

namespace Phpshko\Test\Inputs;

use Phpshko\Test\Helpers\HtmlHelper;

class HiddenInput extends AbstractInput
{
    /**
     * @inheritdoc
     */
    public function render(): string
    {
        $options = [
            'type'  => 'hidden',
            'name'  => $this->_attribute,
            'value' => $this->getValue(),
        ];
        return '<input ' . HtmlHelper::formatOptions($this->_htmlOptions, $options) . ' />';
    }
}