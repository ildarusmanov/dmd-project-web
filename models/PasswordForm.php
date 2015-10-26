<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class PasswordForm extends Model
{
    public $password;
    public $password_repeat;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
         return [
            [['password', 'password_repeat'], 'required'],
            [['password', 'password_repeat'], 'string', 'min' => 4],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }


    public function process()
    {

        if ($this->validate()) {
            $user = User::findIdentity(Yii::$app->user->id);
            $user->scenario = 'change_password';
            $user->setPassword($this->password);
            $user->generateAuthKey();
            return $user->save();
        }

        return false;
    }

    public function attributeLabels()
    {
        return [
            'password' => Yii::t('app', 'Password'),
            'password_repeat' => Yii::t('app', 'Repeat Password'),
        ];
    }

}
