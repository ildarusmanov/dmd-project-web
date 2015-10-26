<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="message-form col-md-8">

        <div class="panel panel-default">
          <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'receiver_user_id')
                        ->dropDownList(
                            $receivers,
                            ['prompt'=> Yii::t('app', 'Message Receiver')]
                        ); ?>
                </div>
                <div class="col-md-8">
                    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                     <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group pull-right">
                        <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
          </div>
        </div>

    </div>
</div>
