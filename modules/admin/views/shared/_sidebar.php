<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!-- Sidebar -->
<div id="sidebar-wrapper">
  <ul id="sidebar_menu" class="sidebar-nav">
      <li class="sidebar-brand"><a id="menu-toggle" href="#"><?= Yii::t('app', 'Admin Navigation') ?><span id="main_icon"><i class="fa fa-bars"></i></span></a></li>
  </ul>
  <ul class="sidebar-nav" id="sidebar">
    <li><a href="<?= Url::toRoute('/admin') ?>"><?= Yii::t('app', 'Admin Home') ?><span class="sub_icon"><i class="fa fa-dashboard"></i></span></a></li>
    <li><a href="<?= Url::toRoute(['/admin/users']) ?>"><?= Yii::t('app', 'Admin Users') ?><span class="sub_icon"><i class="fa fa-users"></i></span></a></li>
    <li><a href="<?= Url::toRoute('/admin/messages') ?>"><?= Yii::t('app', 'Admin Messages') ?><span class="sub_icon"><i class="fa fa-envelope"></i></span></a></li>
    <li><a href="<?= Url::toRoute('/admin/library') ?>"><?= Yii::t('app', 'Admin Library') ?><span class="sub_icon"><i class="fa fa-file-pdf-o"></i></span></a></li>
    <li><a data-method="post" href="<?= Url::toRoute('/session/logout') ?>"><?= Yii::t('app', 'Admin Logout') ?><span class="sub_icon"><i class="fa fa-sign-out"></i></span></a></li>
  </ul>
</div>

