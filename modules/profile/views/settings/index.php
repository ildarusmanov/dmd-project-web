<?php
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-header">
  <div class="row">
    <div class="info col-md-8">
      <a href="#" class="thumbnail pull-left">
        <i class="fa fa-cog"></i>
      </a>
      <div class="pull-left">
        <h1><?= $this->title ?></h1>
        <h4>Настройки Вашего аккаунта</h4>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Аватар</h3>
          </div>
          <div class="panel-body">
            <div class="text-center">
                <?php $form = ActiveForm::begin([
                    'action' => Url::toRoute(['/profile/settings/avatar']),
                    'options' => [
                            'enctype' => 'multipart/form-data',
                            'class' => 'js-image-upload-form'
                        ]
                    ]); ?>

                <span class="icon">
                    <div class="hover-button js-select-file">
                        Загрузить
                    </div>
                    <img class="media-object" src="<?= $model->avatar() ?>" width="100px"/>
                </span>

                <br/>

                <button class="btn btn-primary js-select-file col-md-12">
                    <span class="fa fa-upload"></span>
                    Загрузить
                </button>

                <div class="hide">
                    <?= $form->field($model, 'avatar')->fileInput() ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Изменить пароль</h3>
          </div>
          <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'action' => Url::toRoute(['/profile/settings/password'])
            ]); ?>

            <?= $form->field($password_form_model, 'password')->passwordInput() ?>

            <?= $form->field($password_form_model, 'password_repeat')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary col-md-12']) ?>
            </div>

            <?php ActiveForm::end(); ?>
          </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Настройки аккаунта</h3>
          </div>
          <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'action' => Url::toRoute(['/profile/settings/profile'])
            ]); ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

            <? if(!$model->isConfirmed()): ?>
                <div class="form-group-addon">
                    <a href="<?= Url::toRoute(['/profile/settings/resend-confirmation']) ?>" class="btn btn-default btn-xs col-md-12 col-xs-12">
                        Подтвердить e-mail
                    </a>
                </div>
            <? endif; ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'birthdate')->widget(
                DatePicker::className(), [
                    // inline too, not bad
                     'inline' => false,
                     // modify template for custom rendering
                    //'template' => '<div class="well well-sm">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
            ]);?>


            <?= $form->field($model, 'gender')
                ->dropDownList(
                    $model::genderList()
                ); ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary pull-right']) ?>
            </div>

            <?php ActiveForm::end(); ?>
          </div>
        </div>
    </div>
</div>

