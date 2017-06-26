
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '采购信息';
?>

<?= $this->render('/layouts/navi-bar')?>


<h6 class="notice">您当前的位置：<a href="/">首页</a>>采购信息</h6>
<div class="container content">
  <ul class="tab need">
    <li class="type" >
      <img src="" alt="icon">
      <span>产品分类 >></span>
      <a href="javascript:void(null)">鱼类 <span>👇</span> </a>
      <a href="javascript:void(null)">虾类 <span>👇</span> </a>
    </li>
    <li class="fish items">
      <a href="#">全部</a>
      <a href="#">黄鱼</a>
    </li>
  </ul>

  <br class="clear">
  <br>

  <ul class="information purchase">
    <li>
      <img class="img" src="" alt="图片">
      <img class="avatar" src="" alt="用户头像">
      <span class="user-name">老渔民</span><br>
      <span class="created_at">2017-06-01</span>
      <span class="location">宁波</span>
      <span class="comment">新鲜鱼</span>
      <a class="anchor" href="#">查看详情</a>
    </li>
    <li><?php var_dump($dataProvider->models[0]); ?></li>
    <?php foreach ($dataProvider->models as $key => $demand): ?>

      <li>
        <img class="img" src="" alt="图片">
        <img class="avatar" src="" alt="用户头像">
        <span class="user-name">老渔民</span><br>
        <span class="created_at">2017-06-01</span>
        <span class="location">宁波</span>
        <span class="comment">新鲜鱼</span>
        <a class="anchor" href="#">查看详情</a>
      </li>
    <?php endforeach; ?>
  </ul>
  <br>
  <div class="pager">
    <a href="#">《</a>
    <a href="#"><</a>
    <a href="#">1</a>
    <a href="#">2</a>
    <span>...</span>
    <a href="#">10</a>
    <a href="#">11</a>
    <a href="#">></a>
    <a href="#">》</a>
  </div>
  <br><br>
</div>

<?php
  echo $this->render('/layouts/footer');
?>
