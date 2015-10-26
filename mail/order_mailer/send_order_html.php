<?php
use yii\helpers\Url;
?>

<h1>Заказ #<?= $order->id ?></h1>

<? foreach($goods as $good): ?>
  <div>
    <h3><?= $good->title ?></h3>
    <p><?= $good->getHtmlAccessContent(); ?></p>
    <br/><br/>
  </div>
<? endforeach; ?>

<p>Благодарим Вас за покупку!</p>
