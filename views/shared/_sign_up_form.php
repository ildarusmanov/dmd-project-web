<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<?php $form = ActiveForm::begin([
        'id' => 'form-signup',
        'action' => Url::toRoute(['/registration'])
]); ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary col-md-12 col-xs-12', 'name' => 'signup-button']) ?>
        <div class="col-md-12 text-center">
            <a href="<?= Url::toRoute('/session') ?>" class="js-sign-in-button">Уже зарегистрированы?</a>
        </div>
    </div>
<?php ActiveForm::end(); ?>
