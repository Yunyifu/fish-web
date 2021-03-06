<?php
use yii\helpers\Html;
?>
<div class="header">
  <div class="content">
    <?php if (!\Yii::$app->user->isGuest): ?>
      <a href="/user-center"><span>欢迎来到鱼渔网，<?= \Yii::$app->user->identity->nickname  ?>  </span></a>
      <span class="pull-right">&nbsp;&nbsp;&nbsp;客服专线：0576-88199627</span>
      <?= Html::a('退出', ['/site/logout'], ['class'=>'pull-right']) ?>
      <?php else: ?>
        <span>欢迎来到鱼渔网</span>
        <span class="pull-right">&nbsp;&nbsp;&nbsp;客服专线：123456789</span>
        <?= Html::a('注册', ['/site/reg'], ['class'=>'pull-right blue']) ?>
        <span class="pull-right blue">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
        <?= Html::a('登录', ['/site/login'], ['class'=>'pull-right blue']) ?>
    <?php endif; ?>
    <span>台州市椒江大郑网络科技有限公司  账号：33050166350000000362　　中国建设银行台州分行</span>
  </div>
</div>
