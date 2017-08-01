
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '公司认证';
$this->registerJsFile("@web/js/preview3.js", ['depends' => ['frontend\assets\AppAsset']]);
$gender = ['0'=>'女', '1'=>'男'];
$redo = \Yii::$app->request->get('redo', 0);
?>

    <?php if ($company->status === 1): ?>
      <li calss="authtodo" style="padding-top:100px;padding-bottom:100px;border-top:1px solid #dfdfdf">
        <img src="../images/ok.png" alt="">
        <p>资料提交成功</p>
        <p>3-5个工作日审核，请等待审核结果</p>
      </li>
    <?php elseif($company->status === 2):?>
      <li calss="authtodo" style="padding-top:100px;padding-bottom:100px;border-top:1px solid #dfdfdf">
        <img src="../images/ok.png" alt="">
        <br><br>
        <p>您已认证成功</p>
      </li>
    <?php elseif($company->status === 4 && $redo === 0):?>
      <li calss="authtodo" style="padding-top:100px;padding-bottom:100px;border-top:1px solid #dfdfdf">
        <img src="../images/ok.png" alt="">
        <p>审核不被通过，请重新认证</p>
        <?= Html::a('点击重新认证', ['/auth/company', 'redo'=>1]) ?>
      </li>
    <?php else:?>
      <li class="auth form">
        <?= $this->render('company_form', ['company'=>$company]) ?>
      </li>
    <?php endif; ?>
