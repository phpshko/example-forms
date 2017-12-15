<?php

namespace Phpshko\Test\Inputs;

use Phpshko\Test\Helpers\HtmlHelper;

class TextAreaInput extends AbstractInput
{
    /**
     * @inheritdoc
     */
    public function render(): string
    {
        $options = [
            'name' => $this->_attribute,
        ];

        return '<textarea ' . HtmlHelper::formatOptions($this->_htmlOptions, $options) . ' />' . $this->getValue() . '</textarea>';
    }
}