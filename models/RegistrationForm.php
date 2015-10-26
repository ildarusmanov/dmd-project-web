<?php

namespace app\models;

use Yii;
use yii\base\Model;


class RegistrationForm extends Model
{
    public $name;
    public $email;
    public $password;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
         return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'E-mail зарегистрирован!'],
            ['password', 'required'],
            ['password', 'string', 'min' => 4],
        ];
    }


    public function signup()
    {
        if ($this->validate()) {
            $confirmation_token = md5(time() . $this->email);
            $user = new User(['scenario' => 'signup']);
            $user->created_at = time();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->role = 'user';
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->confirmation_token = $confirmation_token;
            if ($user->generate_confirmation($confirmation_token, $this->password))
            {
                return $user;
            }
        }
        return null;
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'name' => Yii::t('app', 'Name')
        ];
    }

}
