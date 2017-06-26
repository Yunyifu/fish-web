<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = $news->title;
?>

<?= $this->render('/layouts/search');?>

<?= $this->render('/layouts/navi-bar');?>

<div class="container content news">
  <h6><?= $news->title ?></h6>
  <span class="created_at">时间：<?= date('Y-m-d', $news->created_at) ?></span>
  <div class="content">
    <?= $news->content ?>
  </div>
</div>

<?= $this->render('/layouts/footer');?>
