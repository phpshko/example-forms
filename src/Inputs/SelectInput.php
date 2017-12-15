<?php

namespace Phpshko\Test\Inputs;

use Phpshko\Test\Helpers\HtmlHelper;

class SelectInput extends AbstractInput
{
    protected $_items = [];

    /**
     * @param array $items
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->_items = $items;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function render(): string
    {
        $html = '<select ' . HtmlHelper::formatOptions($this->_htmlOptions, ['name' => $this->_attribute]) . '>';

        foreach ($this->_items as $val => $label) {
            $html .= '<option value="' . $val . '" ' . ($val == $this->getValue() ? ' selected' : '') . ' >' . $label . '</option>';
        }

        $html .= '</select>';

        return $html;
    }
}