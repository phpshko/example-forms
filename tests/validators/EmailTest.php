<?php

use Phpshko\Test\Validators\EmailValidator;

final class EmailTest extends BaseValidatorTest
{
    protected function validate($value): bool
    {
        return (new EmailValidator())->validate($value);
    }

    public function testNotCorrectEmails()
    {
        $this->assertFalseValidate('');
        $this->assertFalseValidate('john___dou');
        $this->assertFalseValidate('john_dou@_dou.com');
        $this->assertFalseValidate('john@@@gmail.com');
        $this->assertFalseValidate('@gmail.com');
    }

    public function testCorrectEmails()
    {
        $this->assertTrueValidate('johndou@gmail.com');
        $this->assertTrueValidate('john-dou@gmail.com');
        $this->assertTrueValidate('john_dou@gmail.com');
        $this->assertTrueValidate('john.dou@gmail.com');
    }
}