<?php
use yii\helpers\Url;
?>

<ul class="list-unstyled list-inline">
  <li><a href="<?= Url::toRoute(['/session']) ?>">Вход</a></li>
  <li><a href="<?= Url::toRoute(['/registration']) ?>">Регистрация</a></li>
  <li><a href="<?= Url::toRoute(['/password']) ?>">Восстановление пароля</a></li>
  <li><a href="<?= Url::toRoute(['/confirmation']) ?>">Подтвердить e-mail</a></li>
</ul>
