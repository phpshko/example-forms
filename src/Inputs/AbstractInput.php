<?php

namespace Phpshko\Test\Inputs;

use Phpshko\Test\Forms\FormInterface;
use Phpshko\Test\Helpers\ConfigHelper;

abstract class AbstractInput implements InputInterface
{
    /**
     * True if need encode value
     * @var bool
     */
    public $encode = true;

    /**
     * @var string Attribute name from form
     */
    protected $_attribute;

    /**
     * @var FormInterface
     */
    protected $_form;

    /**
     * @var array Array of html input options
     */
    protected $_htmlOptions = [];

    /**
     * @inheritdoc
     */
    public function __construct(FormInterface $form, string $attribute, array $config = [])
    {
        $this->_attribute = $attribute;
        $this->_form = $form;
        ConfigHelper::load($this, $config);
    }

    /**
     * @inheritdoc
     */
    public function setHtmlOptions($options): InputInterface
    {
        $this->_htmlOptions = $options;
        return $this;
    }

    /**
     * Get raw form attribute value
     * @return null|string
     */
    protected function getRawValue(): ?string
    {
        return $this->_form->{$this->_attribute};
    }

    /**
     * Get encoded value (if need)
     * @return null|string
     */
    protected function getValue(): ?string
    {
        return $this->encode
            ? htmlspecialchars($this->getRawValue(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
            : $this->getRawValue();
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->render();
    }
}