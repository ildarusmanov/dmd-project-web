<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\Video;
use app\models\User;
use app\models\Subtitle;
use app\models\Bonus;
use app\models\Order;
use app\models\Channel;
use app\models\PasswordForm;
use app\modules\profile\controllers\ApplicationController;

class SettingsController extends ApplicationController
{
    public function actionIndex()
    {
        $model = $this->getUser();

        if(!$model->isConfirmed())
        {
            Yii::$app->session->setFlash('error', Yii::t('app', 'E-mail not confirmed'));
        }

        return $this->render('index', [
            'model' => $model,
            'password_form_model' => new PasswordForm()
        ]);
    }

    public function actionProfile()
    {
        $model = $this->getUser();
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', Yii::t('app', 'User settings was saved'));
            return $this->redirect(['/profile/settings']);
        }

        return $this->render('index', [
            'model' => $model,
            'password_form_model' => new PasswordForm()
        ]);
    }

    public function actionPassword()
    {
        $model = new PasswordForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->process()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Password was changed'));
                return $this->redirect(['/profile/settings']);
            }
        }

        return $this->render('index', [
            'model' => $this->getUser(),
            'password_form_model' => $model
        ]);
    }

    public function actionAvatar()
    {
        $model = $this->getUser();
        $model->scenario = 'upload_avatar';
        $success = false;
        $message = null;
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $success = true;
            $message = Yii::t('app', 'User settings was saved');
        }

        return $this->renderPartial('avatar_js', ['model' => $model, 'success' => $success, 'message' => $message]);
    }

    public function actionResendConfirmation()
    {
        $user = $this->getUser();
        $user->generate_confirmation();
        Yii::$app->session->setFlash('success', Yii::t('app', 'Confirmation email was sent'));
        return $this->redirect(['/profile/settings']);
    }
}
