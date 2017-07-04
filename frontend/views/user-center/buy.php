
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '我的购买';
?>


<?php foreach ($dataProvider->models as $key => $buy): ?>
  <li class="goods">
    <span class="pull-left"><?= $buy->goods->title?></span>
    <?= Html::a('删除', ['/user-center/demand'], ['class'=>'anchor pull-right']) ?>
    <span class="pull-right"><?= $buy->statustextbuyer ?></span>
    <!-- <span class="pull-right">发布时间：<?= date('Y-m-d', $buy->created_at)?></span> -->
  </li>
<?php endforeach; ?>
