<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'action' => Url::toRoute(['/session'])
]); ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'rememberMe', [
    'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
])->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary col-md-12 col-xs-12', 'name' => 'login-button']) ?>
    <div class="col-md-12 text-center">
        <p>
          <a href="<?= Url::toRoute('/registration') ?>" class="js-sign-up-button">Еще не зарегистрированы?</a>
          /
          <a href="<?= Url::toRoute('/password') ?>">Забыли пароль?</a>
        </p>
    </div>
</div>


<?php ActiveForm::end(); ?>
