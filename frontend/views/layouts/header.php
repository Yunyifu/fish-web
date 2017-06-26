<?php
use yii\helpers\Html;
?>
<div class="header">
  <div class="content">
    <?php if (!\Yii::$app->user->isGuest): ?>
      <a href="/user-center"><span>欢迎来到渔鱼网，<?= \Yii::$app->user->identity->nickname  ?>  </span></a>
      <span class="pull-right">&nbsp;&nbsp;&nbsp;客服专线：123456789</span>
      <?= Html::a('退出', ['/site/logout'], ['class'=>'pull-right']) ?>
      <?php else: ?>
        <span>欢迎来到渔鱼网</span>
        <span class="pull-right">&nbsp;&nbsp;&nbsp;客服专线：123456789</span>
        <?= Html::a('注册', ['/site/reg'], ['class'=>'pull-right blue']) ?>
        <span class="pull-right blue">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
        <?= Html::a('登录', ['/site/login'], ['class'=>'pull-right blue']) ?>
    <?php endif; ?>
  </div>
</div>
