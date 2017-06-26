
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '公司认证';
$this->registerJsFile("@web/js/preview3.js", ['depends' => ['frontend\assets\AppAsset']]);
$gender = ['0'=>'女', '1'=>'男'];
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
    <?php if ($company->status === 1): ?>
      <li calss="authtodo" style="padding-top:100px;padding-bottom:100px;border-top:1px solid #dfdfdf">
        <img src="../images/ok.png" alt="">
        <p>资料提交成功</p>
        <p>3-5个工作日审核，请等待审核结果</p>
      </li>
      <?php else: ?>
        <li class="auth form">
          <?php $form = ActiveForm::begin(); ?>

          <?= $form->field($company, 'name')->textInput(['placeholder' => '法人代表名字']) ?>

          <?= $form->field($company, 'gender')->dropDownlist($gender, ['prompt'=>'请选择性别']) ?>

          <?= $form->field($company, 'telphone')->textInput(['placeholder' => '公司联系电话']) ?>

          <?= $form->field($company, 'id_hand_pic')->fileInput(['class'=>'hidden']) ?>

          <?= $form->field($company, 'factory_pic')->fileInput(['class'=>'hidden']) ?>

          <?= $form->field($company, 'company_pic')->fileInput(['class'=>'hidden']) ?>

          <label class="for-file" style="display:inline-block" for="companyauth-company_pic"><img id ="preview1" src="../images/plus.png" style="margin-top:40px"></label>
          <label class="for-file" style="display:inline-block;margin-left:180px;margin-right:180px;" for="companyauth-id_hand_pic"><img id ="preview2" src="../images/plus.png" style="margin-top:40px"></label>
          <label class="for-file" style="display:inline-block" for="companyauth-factory_pic"><img id ="preview3" src="../images/plus.png" style="margin-top:40px"></label>
          <br>
          <span>工厂照片</span>
          <span style="display:inline-block;margin-left:260px;margin-right:260px;">手持身份证</span>
          <span>营业执照</span>
          <div class="form-group">
              <?= Html::submitButton('提交', ['class' =>  'btn' ]) ?>
          </div>

          <?php ActiveForm::end(); ?>
        </li>
    <?php endif; ?>
  </ul>
  <br class="clear"><br class="clear"><br class="clear">
</div>

<?php
  echo $this->render('/layouts/footer');
?>
