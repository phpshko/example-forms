<?php

use Phpshko\Test\Validators\RequiredValidatorValidator;

final class RequiredTest extends BaseValidatorTest
{
    protected function validate($value): bool
    {
        return (new RequiredValidatorValidator())->validate($value);
    }

    public function testNull()
    {
        $this->assertFalseValidate(null);
    }

    public function testEmptyString()
    {
        $this->assertFalseValidate('');
    }

    public function testEmptyArray()
    {
        $this->assertFalseValidate([]);
    }


    public function testFalse()
    {
        $this->assertTrueValidate(false);
    }

    public function testTrue()
    {
        $this->assertTrueValidate(true);
    }

    public function testArray()
    {
        $this->assertTrueValidate([1, 2]);
    }

    public function testArrayWithZero()
    {
        $this->assertTrueValidate([0]);
    }

    public function testZero()
    {
        $this->assertTrueValidate(0);
    }

    public function testInteger()
    {
        $this->assertTrueValidate(4);
    }

    public function testNegativeInteger()
    {
        $this->assertTrueValidate(4);
    }

    public function testString()
    {
        $this->assertTrueValidate('my string');
    }

    public function testObject()
    {
        $this->assertTrueValidate(new stdClass);
    }
}