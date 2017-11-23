<?php

namespace app\models;

use yii\base\Model;

class Login extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Wrong email or password');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }
}