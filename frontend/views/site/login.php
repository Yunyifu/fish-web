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

    <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false, 'options'=>['class'=>'login-form'] ]); ?>
        <h6>登录</h6>
        <?= $form->field($model, 'username')->textInput(['class'=>'inputuser','placeholder'=>'用户名']) ?>

        <?= $form->field($model, 'password')->passwordInput(['class'=>'inputpsw','placeholder'=>'密码']) ?>

        <?= Html::a('忘记密码', ['/site/reset-password'], ['class'=>'pull-right white']) ?>
        <span class="pull-right white">&nbsp;|&nbsp;</span>
        <?= Html::a('立即注册', ['/site/reg'], ['class'=>'pull-right blue']) ?>
        <br><br><br>
        <br class="clear">
        <!-- /.col -->
        <div class="col-xs-4">
            <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
        </div>
        <!-- /.col -->

    <?php ActiveForm::end(); ?>
</div>
<?php
  echo $this->render('/layouts/footer');
?>
