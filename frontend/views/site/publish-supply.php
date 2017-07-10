<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile("@web/js/preview1.js", ['depends' => ['frontend\assets\AppAsset']]);
$this->title = '发布供应';
$url = \Yii::$app->request->url;
$cata = 1;
$readonly = $goods->status==2 ? ['readonly'=>'readonly'] : [];
if ($readonly) {
  echo "<script>alert('正在进行中的订单请勿修改')</script>";
}
?>
<?= $this->render('/layouts/search')?>

<?= $this->render('/layouts/navi-bar')?>

<div class="publish-form">
  <h6>发布供应信息<?= \Yii::$app->request->get('cataname');?>  </h6>
  <?//=var_dump($goods) ?>
  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($goods, 'category_id')->textInput( ['value'=> '品类：'.\Yii::$app->request->get('cataname'), 'disabled'=>'disabled']) ?>

  <div class="hidden">
    <?= $form->field($goods, 'category_id')->textInput( ['value'=>\Yii::$app->request->get('cataid')]) ?>
  </div>
  <?= $form->field($goods, 'title')->textInput(array_merge(['placeholder' => '输入您要售卖的海鲜产品名'], $readonly)) ?>

  <?= $form->field($goods, 'area')->textInput(array_merge(['placeholder' => '请输入您的海域'], $readonly)) ?>

  <?= $form->field($goods, 'desc')->textInput(array_merge(['placeholder' => '描述您的产品（数量-规格）'], $readonly)) ?>
  <label class="file-upload-btn background-plus upload-btn" for="goods-pic">
    <?php if ($goods->pic): ?>
      <?= Html::img("http://dev.image.alimmdn.com/" . $goods->pic, ['id'=>"preview", 'style'=> 'width:135px; height:135px']) ?>
      <?php else: ?>
        <img class="preview"  id="preview" src="../images/plus.png" alt="">
    <?php endif; ?>
  </label>

  <?= $form->field($goods, 'pic')->fileInput(array_merge(['class'=>'hidden', 'multiple' => 'multiple'], $readonly)) ?>

  <div class="form-group">
      <?= Html::submitButton('发布', ['class' =>  'btn' ]) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>

<?php
  echo $this->render('/layouts/footer');
?>
