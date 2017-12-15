<?php

use Phpshko\Test\Forms\AbstractForm;
use Phpshko\Test\Forms\FormInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers Email
 */
final class BaseFormTest extends TestCase
{
    /**
     * @param array $rules
     * @param array $data
     * @return FormInterface
     */
    protected function getForm(array $rules, array $data): FormInterface
    {
        $form = new class ($rules) extends AbstractForm
        {
            public $username;
            public $password;
            public $status;
            public $age;

            private $_rules = [];

            public function __construct(array $rules)
            {
                $this->_rules = $rules;
            }

            protected function rules(): array
            {
                return $this->_rules;
            }
        };

        $form->load($data);
        return $form;
    }

    public function testRequiredWithNull()
    {
        $form = $this->getForm([
            [['password'], 'required'],
        ], []);
        $this->assertFalse($form->validate());
        $this->assertArrayHasKey('password', $form->getErrors());
        $this->assertNotEmpty($form->getErrors(['password']));
    }

    public function testRequiredWithShort()
    {
        $form = $this->getForm([
            [['password'], 'required'],
            [['password'], 'string', 'min' => 5],
        ], ['password' => '123']);
        $this->assertFalse($form->validate());
        $this->assertArrayHasKey('password', $form->getErrors());
    }

    public function testRequiredWithLong()
    {
        $form = $this->getForm([
            [['password'], 'required'],
            [['password'], 'string', 'min' => 5, 'max' => 8],
        ], ['password' => '1234567890']);
        $this->assertFalse($form->validate());
        $this->assertArrayHasKey('password', $form->getErrors());
    }

    public function testRequiredWithString()
    {
        $form = $this->getForm([
            [['password'], 'required'],
            [['password'], 'string', 'min' => 5, 'max' => 8],
        ], ['password' => '123456']);
        $this->assertTrue($form->validate());
        $this->assertArrayNotHasKey('password', $form->getErrors());
        $this->assertEmpty($form->getErrors(['password']));
    }

    public function testInWithNotCorrectNumber()
    {
        $form = $this->getForm([
            [['status'], 'in', 'range' => [1, 2, 3]],
        ], ['status' => 4]);
        $this->assertFalse($form->validate());
        $this->assertArrayHasKey('status', $form->getErrors());
    }

    public function testInWithNull()
    {
        $form = $this->getForm([
            [['status'], 'in', 'range' => [1, 2, 3]],
        ], ['status' => null]);
        $this->assertTrue($form->validate());
        $this->assertArrayNotHasKey('status', $form->getErrors());
    }

    public function testInWithCorrectNumber()
    {
        $form = $this->getForm([
            [['status'], 'in', 'range' => [1, 2, 3]],
        ], ['status' => 2]);
        $this->assertTrue($form->validate());
        $this->assertArrayNotHasKey('status', $form->getErrors());
    }
}