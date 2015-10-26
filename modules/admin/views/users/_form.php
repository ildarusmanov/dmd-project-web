<?php
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'role')
                ->dropDownList(
                    $model::roleList(),
                    ['prompt'=>'Выберите Роль']
                ); ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'gender')
                ->dropDownList(
                    $model::genderList()
                ); ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'birthdate')->widget(
                DatePicker::className(), [
                     'inline' => false,
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
            ]);?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'partner_id')
                ->dropDownList(
                    ArrayHelper::map(User::find()->all(), 'id', 'name'),
                    ['prompt'=>'Выберите Партнера']
                ); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'avatar')->fileInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
