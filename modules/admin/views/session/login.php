<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Войти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
            ]); ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe', [
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->checkbox() ?>

            <div class="form-group row">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary col-md-12 col-xs-12', 'name' => 'login-button']) ?>
                <!-- <div class="col-md-12 text-center">
                    <a href="<?= Url::toRoute('site/registration') ?>">Еще не зарегистрированы?</a>
                </div> -->
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="clr-2o"></div>
