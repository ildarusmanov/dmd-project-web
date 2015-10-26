<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ConfirmationForm;
use app\models\User;

class ConfirmationController extends ApplicationController
{
    public function actionIndex()
    {
        $this->layout = 'narrow';
        $model = new ConfirmationForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->process()) {

                Yii::$app->session->setFlash('success', Yii::t('app', 'Confirmation email was sent'));
                $model = new ConfirmationForm();
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionConfirm($token)
    {
        $user = User::find()->where(['confirmation_token' => $token, 'confirmed_at' => 0])->one();
        if($user == null)
        {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Can`t confirm user'));
        }else{
            $user->confirm_email();
            Yii::$app->user->login($user);
            Yii::$app->session->setFlash('success', Yii::t('app', 'E-mail was confirmed'));
        }

        return $this->redirect(['/confirmation']);
    }

    private function getUser()
    {
        if(Yii::$app->user->isGuest)
        {
            return false;
        }

        return User::findIdentity(Yii::$app->user->id);
    }
}
