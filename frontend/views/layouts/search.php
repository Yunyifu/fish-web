<?php

use yii\helpers\Html;

?>

<form class="search content" action="index.html" method="post">
  <?= Html::img('@web/images/logo@2x.png', ['alt' => 'LOGO']) ?>
  <?= Html::a('发布', ['/site/publish'], ['class'=>'pull-right'])?>
  <input class="pull-right btn" type="submit" name="" value="搜索">
  <input class="pull-right" type="text" name="search" placeholder="请输入关键字...">
</form>
