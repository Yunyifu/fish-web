<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '需求信息';
?>

<?= $this->render('/layouts/navi-bar')?>

<h6 class="notice">您当前的位置：<a href="/">首页</a>>需求信息</h6>
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

  <ul class="information buys">
    <li class="head">
      <span>采购品类</span>
      <span>采购价格</span>
      <span>采购数量</span>
      <span>状态要求</span>
      <span>其他要求</span>
      <span>地理位置</span>
      <span>发布时间</span>
    </li>
    <li class="item">
      <span>海带</span>
      <span>10000/吨</span>
      <span>12吨</span>
      <span>新鲜</span>
      <span>无</span>
      <span>宁波</span>
      <span>2017.06.01</span>
    </li>
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
