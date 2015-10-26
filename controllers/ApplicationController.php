<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\components\ReferalManager;
use app\components\ClicksManager;

class ApplicationController extends Controller
{
    public $referal = null;

    public function beforeAction($action)
    {
        $this->referal = ReferalManager::load_referal();
        ClicksManager::save();
        return parent::beforeAction($action);
    }

    public function renderJson($response)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
    }

    public function renderJs($template, $data)
    {
        $this->layout = false;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return $this->render($template . '_js', $data);
    }

}
