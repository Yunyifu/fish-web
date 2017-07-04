<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use frontend\widgets\CustomForm2;
use yii\bootstrap\ActiveForm;
/* @var $this \yii\web\View */
$this->registerCssFile("@web/css/login.css", ['depends' => ['frontend\assets\AdminAsset']]);
$this->title = '渔鱼网平台登录';
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<?= $this->render('/layouts/search')?>
<?= $this->render('/layouts/navi-bar')?>


<div class="login-container">
    <div class="center">
      <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false, 'options'=>['class'=>'login-form'] ]); ?>
          <br><br><br><br>
          <h6>登录</h6>
          <?= Html::img('/images/username.png',['style'=>'position: absolute;']) ?>
          <?= $form->field($model, 'username')->textInput(['class'=>'inputuser','placeholder'=>'用户名']) ?>
          <?= Html::img('/images/password.png',['style'=>'position: absolute;']) ?>
          <?= $form->field($model, 'password')->passwordInput(['class'=>'inputpsw','placeholder'=>'密码']) ?>

          <?= Html::a('忘记密码', ['/site/reset-password'], ['class'=>'pull-right white']) ?>
          <span class="pull-right white">&nbsp;|&nbsp;</span>
          <?= Html::a('立即注册', ['/site/reg'], ['class'=>'pull-right blue']) ?>
          <br><br><br>
          <br class="clear">
          <!-- /.col -->

          <?= Html::submitButton('登&nbsp;&nbsp;&nbsp;录', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
          <!-- /.col -->

      <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
  echo $this->render('/layouts/footer');
?>
