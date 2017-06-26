
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '用户中心';
?>


<?= $this->render('/layouts/search')?>
<?= $this->render('/layouts/navi-bar')?>

<div class="container content user-center">
  <div class="login">
    <img src="" alt="一个图">
    <span class="greet">Hello</span>
    <br>
    <span class="greet" style="margin-top: 5px;">欢迎来到渔鱼网</span>
    <br class="clear">
    <?= Html::a('登录', ['/site/login']) ?>
    <?= Html::a('注册', ['/site/login']) ?>
    <br><br>
    <div class="guarantee">
      <h6>平台保障</h6>
      <span class="icon infor"> </span>
      <span class="icon phone"> </span>
      <span class="icon safe"> </span>
      <br>
      <span>信息真实</span>
      <span>资金安全</span>
      <span>手机认证</span>
    </div>
  </div>
  <ul class="menu">
    <li class="user-info">
      <?= Html::img('@web/images/logo@2x.png', ['alt' => 'avatar', 'class'=>'avatar']) ?>
      <span>用户名</span>
    </li>
    <li class="anchors">
      <?= Html::a('我的发布', ['/user-center/goods'], ['class'=>'anchor border0']) ?>
      <?= Html::a('已出售', ['/user-center/sell'], ['class'=>'anchor']) ?>
      <?= Html::a('已购买', ['/user-center/buy'], ['class'=>'anchor']) ?>
      <?= Html::a('渔民认证', ['/auth/fisher'], ['class'=>'anchor']) ?>
      <?= Html::a('公司认证', ['/auth/company'], ['class'=>'anchor']) ?>
    </li>
    <li class="anchors published">
      <?= Html::a('供应信息', ['/user-center/goods'], ['class'=>'anchor']) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?= Html::a('需求信息', ['/user-center/demand'], ['class'=>'anchor']) ?>
    </li>
  </ul>
  <br class="clear"><br class="clear"><br class="clear">
</div>

<?php
  echo $this->render('/layouts/footer');
?>
