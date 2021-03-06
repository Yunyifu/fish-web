<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use frontend\widgets\CustomForm2;
use yii\bootstrap\ActiveForm;
/* @var $this \yii\web\View */
$this->registerCssFile("@web/css/login.css", ['depends' => ['frontend\assets\AdminAsset']]);
$this->registerJsFile("@web/js/reg.js", ['depends' => ['frontend\assets\AdminAsset']]);
$this->title = '渔鱼网平台注册';
?>
<?= $this->render('/layouts/search')?>
<?= $this->render('/layouts/navi-bar')?>

<div class="login-container">
<div class="center">
  <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false, 'options'=>['class'=>'login-form'] ]); ?>
      <h6>注册</h6>
      <?= Html::img('/images/username.png',['style'=>'position: absolute;']) ?>
      <?= $form->field($model, 'username')->textInput(['class'=>'inputuser','placeholder'=>'手机号']) ?>

      <?= $form->field($model, 'validation')->textInput(['class'=>'validation','placeholder'=>'请输入验证码']) ?>

      <button id="validation-btn" type="button" name="button">发送验证码</button><span id="countDown"></span>
      <br>
      <?= Html::img('/images/password.png',['style'=>'position: absolute;']) ?>
      <?= $form->field($model, 'password')->passwordInput(['class'=>'inputpsw','placeholder'=>'密码']) ?>
      <?= Html::img('/images/password.png',['style'=>'position: absolute;']) ?>
      <?= $form->field($model, 'repass')->passwordInput(['class'=>'inputpsw','placeholder'=>'重复密码']) ?>

      <br class="clear">

      <?= Html::submitButton('注册', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>

  <?php ActiveForm::end(); ?>
</div>
</div>
<?php
  echo $this->render('/layouts/footer');
?>
<script type="text/javascript">
  var codeType = 0
</script>
