
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '我发布的供应';
?>
    <?php foreach ($dataProvider->models as $key => $sell): ?>
      <li class="goods">
        <span class="pull-left"><?= $sell->goods->title?></span>
        <?= Html::a('删除', ['/user-center/demand'], ['class'=>'anchor pull-right']) ?>
        <span class="pull-right"><?= $sell->statustextseller ?></span>
        <!-- <span class="pull-right">发布时间：<?= date('Y-m-d', $sell->created_at)?></span> -->
      </li>
    <?php endforeach; ?>
