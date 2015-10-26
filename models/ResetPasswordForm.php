<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class ResetPasswordForm extends Model
{
    public $email;

    public function rules()
    {
         return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'required']
        ];
    }

    public function process()
    {
        $user = User::find()->where(['email' => $this->email])->one();
        if($user == null) return false;
        return $user->generate_password();
    }


    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email')
        ];
    }

}
