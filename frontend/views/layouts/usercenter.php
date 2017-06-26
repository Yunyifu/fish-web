<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
AppAsset::register($this);
$greet = \Yii::$app->user->isGuest ? "Hello" : \Yii::$app->user->identity->nickname;
$avatar = \Yii::$app->user->isGuest ? "http://dev.image.alimmdn.com/1/default.jpg@294w_196h_1l" : \Yii::$app->user->identity->avatar;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('header')?>
<?= $this->render('/layouts/search')?>
<?= $this->render('/layouts/navi-bar')?>

<div class="wrap">
  <div class="container content user-center">
    <div class="login">
      <img src="<?= $avatar ?>" alt="一个图">
      <span class="greet">
        <?= Html::a($greet, ['/user-center'], ['class'=>'no-warp','style'=>'background:none;color:#666;width:120px;']) ?>
      </span>
      <br>
      <span class="greet" style="margin-top: 5px;">欢迎来到渔鱼网</span>
      <br class="clear">
      <?php if (!\Yii::$app->user->isGuest): ?>
        <?= Html::a('退出', '/site/logout') ?>
        <?php else: ?>
          <?= Html::a('登录', '/site/login') ?>
          <?= Html::a('注册', '/site/reg') ?>
      <?php endif; ?>
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
      <?= $content ?>
    </ul>
    <br class="clear"><br class="clear"><br class="clear">
  </div>
</div>

<?= $this->render('/layouts/footer')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
