<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Подтвердить e-mail';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-header"><?= Html::encode($this->title) ?></div>

<div class="site-confirmation">
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

            <div class="form-group text-center">
                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary col-md-12 col-xs-12']) ?>
            </div>

            <?php ActiveForm::end(); ?>


            <p>&nbsp;</p>
            <p>
              <center>
                <?= $this->render('@app/views/shared/_user_links') ?>
              </center>
            </p>
        </div>
    </div>
</div>
