<?php
error_reporting(E_ALL);

use Phpshko\Test\Forms\AbstractForm;
use Phpshko\Test\HtmlForms\HtmlForm;
use Phpshko\Test\Inputs\PasswordInput;
use Phpshko\Test\Inputs\SelectInput;
use Phpshko\Test\Inputs\TextAreaInput;
use Phpshko\Test\Inputs\TextInput;
use Phpshko\Test\Validators\RequiredValidatorValidator;

require __DIR__ . '/../vendor/autoload.php';

class LoginForm extends AbstractForm
{
    public $email;
    public $username;
    public $password;
    public $status;
    public $bio;

    protected function rules(): array
    {
        return [
            [['email', 'username', 'password'], RequiredValidatorValidator::class, 'message' => '{attribute} is required'],
            [['email'], 'email'],
            ['password', 'string', 'min' => 6, 'max' => 8, 'message' => '{attribute} length should be from {min} to {max} characters'],
            ['status', 'in', 'range' => ['1', '2', '3'], 'message' => '{attribute} is invalid'],
            ['bio', 'string', 'max' => 60],
            [['username'], function ($value) {
                if (!empty($value) && $value[0] === 'x') {
                    $this->addError('username', 'Username not allowed starts with "x"');
                    return false;
                }
                return true;
            }],
        ];
    }
}

$form = new LoginForm();

if ($isLoad = $form->load($_POST)) {
    $form->validate();
}

$htmlForm = new HtmlForm($form);
?>

<!doctype html>
<html lang="en">
<head>
    <style>
        .container {
            width: 400px;
            margin: 0 auto;
        }

        form {
            width: 100%;
        }

        .input-block {
            margin: 20px 0;
        }

        form input,
        form select,
        form textarea,
        form button {
            width: 100%;
            height: 35px;
        }

        form textarea {
            height: 70px;
        }

        .error-summary {
            color: #ff0000;
        }

        .validation-success {
            color: #008000;
        }

        .error-summary, .validation-success {
            margin: 30px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <?= $htmlForm->begin() ?>
        <div class="input-block">
            <?= (new TextInput($form, 'email'))->setHtmlOptions(['placeholder' => 'Email...']) ?>
        </div>

        <div class="input-block">
            <?= (new TextInput($form, 'username'))->setHtmlOptions(['placeholder' => 'Username...']) ?>
        </div>

        <div class="input-block">
            <?= (new PasswordInput($form, 'password'))->setHtmlOptions(['placeholder' => 'Password...']) ?>
        </div>

        <div class="input-block">
            <?= (new TextAreaInput($form, 'bio'))->setHtmlOptions(['placeholder' => 'Bio...']) ?>
        </div>

        <div class="input-block">
            <?= (new SelectInput($form, 'status'))->setItems(['1' => 'Option 1', '2' => 'Option 2', '3' => 'Option 3', '6' => 'Not valid options']) ?>
        </div>

        <div>
            <button type="submit">Signup</button>
        </div>
    <?= $htmlForm->end() ?>

    <?php if ($htmlForm->hasErrors()): ?>
        <div class="error-summary">
            <?php foreach ($htmlForm->getErrors() as $attribute => $errors): ?>
                <div class="attribute-error-block">
                    <?php foreach ($errors as $error): ?>
                        <p class="error-block"><?= $error ?></p>
                    <?php endforeach ?>
                </div>
            <?php endforeach ?>
        </div>
    <?php elseif ($isLoad): ?>
        <div class="validation-success">Validation Success</div>
    <?php endif ?>
</div>
</body>
</html>

