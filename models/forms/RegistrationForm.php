<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\db\User;

/**
 * RegistrationForm is the model behind the registration form.
 */
class RegistrationForm extends Model
{
    public $login;
    public $email;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
       return [
        [['login', 'email', 'password'], 'required', 'message' => 'Заполните поле'],
        ['login', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
       ];
    }
}
