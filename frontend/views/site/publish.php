<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '渔鱼网';
$url = \Yii::$app->request->url;
$this->registerJsFile("@web/js/publish.js", ['depends' => ['frontend\assets\AppAsset']]);
?>
<?= $this->render('/layouts/search')?>

<?= $this->render('/layouts/navi-bar')?>


<div class="publish banner">
  <?= Html::img('/images/Rectangle 17.png',['style'=>'margin-top: -20px;width: 100%; height:188px;']) ?>
  <h5 class="bannertitle">选择要发布的种类</h5>
</div>
<div class="container content publish">
  <?php foreach ($dataArray as $key => $cata): ?>
    <?php
    $isSelect = \Yii::$app->request->get('cata')==$cata->id? 'selected' : '';
    $margin = ($key+1)%6 == 0 ? 'margin-right0':'';
    ?>
    <?= Html::a($cata->name, ['publish', 'cata'=> $cata->id, 'cataname'=>$cata->name], ['class'=>'select ' . $isSelect . $margin]) ?>
  <?php endforeach; ?>
</div>

<div class="anchors publish">
  <?= Html::a('发布供应信息', ['publish-supply', 'cataid'=>\Yii::$app->request->get('cata'), 'cataname'=>\Yii::$app->request->get('cataname')], ['class'=>'anchor'])?>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?= Html::a('发布需求信息', ['publish-need', 'cataid'=>\Yii::$app->request->get('cata'), 'cataname'=>\Yii::$app->request->get('cataname')], ['class'=>'anchor'])?>
  <br>
  <span>发布即同意 <a href="#">《渔鱼网交易规则》</a></span>
</div>

<?php
  echo $this->render('/layouts/footer');
?>
