<?php

use Phpshko\Test\Validators\InValidator;

final class InTest extends BaseValidatorTest
{
    protected function validate($value, $statuses = [1, 2, 3, 'Username']): bool
    {
        return (new InValidator(['range' => $statuses]))->validate($value);
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
        $this->assertFalseValidate(false);
    }

    public function testTrue()
    {
        $this->assertFalseValidate(true);
    }

    public function testArray()
    {
        $this->assertFalseValidate([1, 2, 3]);
    }

    public function testZero()
    {
        $this->assertFalseValidate(0);
    }

    public function testNegativeInteger()
    {
        $this->assertFalseValidate(-1);
    }

    public function testObject()
    {
        $this->assertFalseValidate(new stdClass);
    }

    public function testNotCorrectString()
    {
        $this->assertFalseValidate('Username0');
    }

    public function testCorrectInteger()
    {
        $this->assertTrueValidate(1);
    }

    public function testCorrectString()
    {
        $this->assertTrueValidate('Username');
    }
}