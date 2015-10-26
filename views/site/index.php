<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Добро пожаловать!';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>
        </p>

        <h2>Начните прямо сейчас!</h2>
        <p><a class="btn btn-lg btn-success js-login-button" href="<?= Url::toRoute('/registration') ?>">Зарегистрироваться</a></p>
    </div>
</div>
