<?php

use Phpshko\Test\Validators\StringValidator;

final class StringTest extends BaseValidatorTest
{
    protected function validate($string, $min = 4, $max = 8): bool
    {
        return (new StringValidator(['min' => $min, 'max' => $max]))->validate($string);
    }

    public function testObject()
    {
        $this->assertFalseValidate(new stdClass);
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

    public function testShort()
    {
        $this->assertFalseValidate('123');
    }

    public function testLong()
    {
        $this->assertFalseValidate('123456789');
    }

    public function testCorrect()
    {
        $this->assertTrueValidate('123456');
    }
}