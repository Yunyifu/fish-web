<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile("@web/js/preview1.js", ['depends' => ['frontend\assets\AppAsset']]);
$this->title = '发布供应';
$url = \Yii::$app->request->url;
$cata = 1;
if (true) {
  # code...
}
?>
<?= $this->render('/layouts/search')?>

<?= $this->render('/layouts/navi-bar')?>

<div class="publish-form">
  <h6>发布供应信息<?= \Yii::$app->request->get('cataname');?>  </h6>
  <?//=var_dump($goods) ?>
  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($goods, 'category_id')->dropDownlist([\Yii::$app->request->get('cataid') => \Yii::$app->request->get('cataname')], ['style'=>'border: 0;box-shadow: none;background: none;']) ?>

  <?= $form->field($goods, 'title')->textInput(['placeholder' => '输入您要售卖的海鲜产品名']) ?>

  <?= $form->field($goods, 'area')->textInput(['placeholder' => '请输入您的地理位置(省市区)']) ?>

  <?= $form->field($goods, 'desc')->textInput(['placeholder' => '详细地描述您的产品（产地／数量／价格）']) ?>
  <label class="file-upload-btn background-plus upload-btn" for="goods-pic">
    <?php if ($goods->pic): ?>
      <?= Html::img("http://dev.image.alimmdn.com/" . $goods->pic, ['id'=>"preview", 'style'=> 'width:135px; height:135px']) ?>
      <?php else: ?>
        <img class="preview"  id="preview" src="../images/plus.png" alt="">
    <?php endif; ?>
  </label>

  <?= $form->field($goods, 'pic')->fileInput(['class'=>'hidden', 'multiple' => 'multiple']) ?>

  <div class="form-group">
      <?= Html::submitButton('发布', ['class' =>  'btn' ]) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>

<?php
  echo $this->render('/layouts/footer');
?>
