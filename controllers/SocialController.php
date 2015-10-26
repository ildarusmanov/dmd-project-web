<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\components\ReferalManager;

class SocialController extends ApplicationController
{

    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        $token = $_REQUEST['token'];

        $s = file_get_contents('http://ulogin.ru/token.php?token=' . $token . '&host=' . $_SERVER['HTTP_HOST']);
        $user_data = json_decode($s, true);

        if(isset($user_data['error']))
        {
            return $this->goHome();
        }

        $user_data['photo'] = isset($user_data['photo']) ? $user_data['photo'] : '';

        $user = User::find()->where(['network_identity' => $user_data['identity'], 'network_id' => $user_data['network']])->one();

        if($user != null)
        {
            Yii::$app->user->login($user);
            return $this->goDashboard();
        }elseif(!Yii::$app->user->isGuest)
        {
            $user_id = Yii::$app->user->getId();
            $user = User::findIdentity($user_id);

            $attr = array(
              'network_identity' => $user_data['identity'],
              'network_id' => $user_data['network'],
              'network_profile' => $user_data['profile'],
              'network_avatar' => $user_data['photo']
            );
            $user->setAttributes($attr);
            $user->save();
            ii::$app->user->login($user);
            return $this->goDashboard();
        }


        $attr = array(
          'created_at' => time(),
          'network_identity' => $user_data['identity'],
          'network_id' => $user_data['network'],
          'network_profile' => $user_data['profile'],
          'network_avatar' => $user_data['photo'],
          'name' => implode(' ', array($user_data['first_name'], $user_data['last_name'])),
          'role' => 'user',
          'password' => md5(time())
        );

        $user = new User(['scenario' => 'social_signup']);
        $user->setAttributes($attr);

        if($user->save())
        {
            ReferalManager::assign_referal($user);
            Yii::$app->user->login($user);
            return $this->goDashboard();
        }

        return $this->goHome();
    }

    private function goDashboard()
    {
        return $this->redirect(['/profile']);
    }
}
