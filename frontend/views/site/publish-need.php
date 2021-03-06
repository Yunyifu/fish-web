<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '发布采购';
$url = \Yii::$app->request->url;

?>
<?= $this->render('/layouts/search')?>

<?= $this->render('/layouts/navi-bar')?>

<div class="publish-form demand">
  <h6>发布采购信息</h6>
  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($demand, 'category_id')->textInput( ['value'=> '品类：'.\Yii::$app->request->get('cataname'), 'disabled'=>'disabled']) ?>

  <div class="hidden">
    <?= $form->field($demand, 'category_id')->textInput( ['value'=>\Yii::$app->request->get('cataid')]) ?>
  </div>

  <?= $form->field($demand, 'title')->textInput(['placeholder' => '可输入多种类']) ?>

  <?= $form->field($demand, 'price')->textInput(['placeholder' => '别忘了输入单位哦']) ?>

  <?= $form->field($demand, 'num')->textInput(['placeholder' => '填写意向采购的数量']) ?>

  <?= $form->field($demand, 'demandstatus')->textInput(['placeholder' => '可填写冷冻/新鲜等状态要求 ']) ?>

  <?= $form->field($demand, 'otherstatus')->textInput(['placeholder' => '填写您的特殊要求']) ?>

  <?= $form->field($demand, 'area')->textInput(['placeholder' => '填写您的海域位置  ']) ?>

  <div class="form-group">
      <?= Html::submitButton('发布', ['class' =>  'btn' ]) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>

<?php
  echo $this->render('/layouts/footer');
?>
