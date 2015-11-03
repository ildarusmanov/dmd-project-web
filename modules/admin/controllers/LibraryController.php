<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class LibraryController extends ApplicationController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
