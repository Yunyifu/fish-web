
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '用户中心';
?>

<li class="anchors published">
  <?= Html::a('供应信息', ['/user-center/goods'], ['class'=>'anchor']) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?= Html::a('需求信息', ['/user-center/demand'], ['class'=>'anchor']) ?>
</li>
