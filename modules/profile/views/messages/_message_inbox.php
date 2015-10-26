<?php
use yii\helpers\Url;
?>
<a data-message-id="<?=$model->id ?>" href="<?= Url::toRoute(['view', 'id' => $model->id]) ?>" class="row js-message-item message-item message-status-<?=$model->receiver_status ?>">
  <div class="col-sm-2 col-xs-5 name">
    <?=$model->sender_data()['name'] ?>
  </div>
  <div class="col-sm-8 col-xs-7">
    <div class="subject"><?=$model->subject ?></div>
    <div class="short hidden-xs"><?=$model->short_content() ?></div>
  </div>
  <div class="col-sm-2 col-xs-12 date"><span class="date"><?= $model->created_at_date() ?></span></div>
</a>
