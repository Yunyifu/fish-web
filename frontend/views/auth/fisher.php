
<?php
use yii\helpers\Html;
/* @var $this yii\web\View */


$this->title = '渔民认证';
$this->registerJsFile("@web/js/preview3.js", ['depends' => ['frontend\assets\AppAsset']]);
$redo = \Yii::$app->request->get('redo', 0);
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
    <?php if ($fisher->status === 1): ?>
      <li calss="authtodo" style="padding-top:100px;padding-bottom:100px;border-top:1px solid #dfdfdf">
        <img src="../images/ok.png" alt="">
        <p>资料提交成功</p>
        <p>3-5个工作日审核，请等待审核结果</p>
      </li>
    <?php elseif($fisher->status === 2):?>
      <li calss="authtodo" style="padding-top:100px;padding-bottom:100px;border-top:1px solid #dfdfdf">
        <img src="../images/ok.png" alt="">
        <br><br>
        <p>您已认证成功</p>
      </li>
    <?php elseif($fisher->status === 4 && $redo === 0):?>
      <li calss="authtodo" style="padding-top:100px;padding-bottom:100px;border-top:1px solid #dfdfdf">
        <img src="../images/ok.png" alt="">
        <p>审核不被通过，请重新认证</p>
        <?= Html::a('点击重新认证', ['/auth/fisher', 'redo'=>1]) ?>
      </li>
    <?php else:?>
      <li class="auth form">
        <?= $this->render('form', ['fisher'=>$fisher]) ?>
      </li>
  <?php endif; ?>
  </ul>
  <br class="clear"><br class="clear"><br class="clear">
</div>

<?php
  echo $this->render('/layouts/footer');
?>
