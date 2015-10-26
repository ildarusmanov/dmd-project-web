<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ResetPasswordForm;
use app\models\User;

class PasswordController extends ApplicationController
{
    public function actionIndex()
    {
        $this->layout = 'narrow';
        $model = new ResetPasswordForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->process()) {

                Yii::$app->session->setFlash('success', Yii::t('app', 'Confirmation email was sent'));
                $model = new ResetPasswordForm();
            }
        }
        return $this->render('index', [
            'model' => $model,
        ]);

    }
}
