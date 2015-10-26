<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!-- Sidebar -->
<div id="sidebar-wrapper">
  <ul id="sidebar_menu" class="sidebar-nav">
      <li class="sidebar-brand"><a id="menu-toggle" href="#"><?= Yii::t('app', 'Profile Navigation') ?><span id="main_icon"><i class="fa fa-bars"></i></span></a></li>
  </ul>
  <ul class="sidebar-nav" id="sidebar">
    <li><a href="<?= Url::toRoute('/profile') ?>"><?= Yii::t('app', 'Profile Home') ?><span class="sub_icon"><i class="fa fa-dashboard"></i></span></a></li>
    <li><a href="<?= Url::toRoute('/profile/messages') ?>"><?= Yii::t('app', 'Profile Messages') ?><span class="sub_icon"><i class="fa fa-envelope"></i></span></a></li>
    <li><a href="<?= Url::toRoute('/profile/settings') ?>"><?= Yii::t('app', 'Profile Settings') ?><span class="sub_icon"><i class="fa fa-cog"></i></span></a></li>
    <li><a data-method="post" href="<?= Url::toRoute('/session/logout') ?>"><?= Yii::t('app', 'Profile Logout') ?><span class="sub_icon"><i class="fa fa-sign-out"></i></span></a></li>
  </ul>
</div>
