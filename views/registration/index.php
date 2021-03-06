<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-header"><?= Html::encode($this->title) ?></div>

<div class="site-signup">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('@app/views/shared/_sign_up_form', ['model' => $model]) ?>
            <h4 class="text-center or">&mdash; ИЛИ &mdash;</h4>
            <p class="text-center">Войти через одну из социальных сетей</p>
            <?= $this->render('@app/views/shared/_social_buttons') ?>

            <p>
              <center>
                <?= $this->render('@app/views/shared/_user_links') ?>
              </center>
            </p>
        </div>
    </div>
</div>
