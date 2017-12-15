<?php

use PHPUnit\Framework\TestCase;

abstract class BaseValidatorTest extends TestCase
{
    abstract protected function validate($value): bool;

    protected function assertTrueValidate($value)
    {
        $this->assertTrue($this->validate($value));
    }

    protected function assertFalseValidate($value)
    {
        $this->assertFalse($this->validate($value));
    }
}