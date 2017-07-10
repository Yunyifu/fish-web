<?php
use yii\helpers\Html;
?>
<div class="navi-bar">
  <div class="content">
    <?= HTML::a('首页',['/site']);?>
    <?= HTML::a('供应信息',['/goods']);?>
    <?= HTML::a('采购信息',['/demand']);?>
    <?= HTML::a('资讯中心',['/news/list']);?>
    <?php if (!\Yii::$app->user->isGuest): ?>
        <?= HTML::a('个人主页',['/user-center']);?>
      <?php else: ?>
        <?= HTML::a('个人主页',['/user-center']);?>
    <?php endif; ?>
  </div>
</div>
