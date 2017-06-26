<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '需求详情';
?>

<form class="search content" action="index.html" method="post">
  <img src="" alt="LOGO">
  <a class="pull-right" href="#">发布</a>
  <input class="pull-right btn" type="submit" name="" value="搜索">
  <input class="pull-right" type="text" name="" value="">
</form>

<?= $this->render('/layouts/navi-bar')?>

<div class="container content detail">
  <h5 class="notice detail">您当前的位置：<a href="/">首页</a> <a href="#">>需求信息</a> > 详情</h5>

  <div class="slider detail">
    <img src="" alt="">
  </div>

  <div class="detail-content">
    <div class="pull-right">
      <a class=" anchor pay " href="#">支付定金</a>
      <br>
      <a class=" anchor consult" href="#">在线资讯</a>
    </div>

    <h5>卖螃蟹</h5>
    <span class="created_at">2017-12-12</span>
    <span>所在地区：浙江宁波</span><br>
    <span class="status">发布需求</span><span class="status">询价中</span><span class="status">已成交</span>
    <h6>详细需求</h6>
    <p>在山的那边海的那边</p>
  </div>
  <!--交易流程-->
  <div class="sub-title for-steps">
    <a href="#"></a>
    <h5>交易流程<span> 保障需求与供应方的权益 平台全程参与交易 确保信息真实 资金托管安全有保障</span></h5>
  </div>
  <div class="steps">
    <div class="step">
      <h6>发布需求</h6>
      <p>详细描述需要采购或是出售的海鲜</p>
    </div>
    <div class="step">
      <h6>发布需求</h6>
      <p>详细描述需要采购或是出售的海鲜</p>
    </div>
    <div class="step">
      <h6>发布需求</h6>
      <p>详细描述需要采购或是出售的海鲜</p>
    </div>
  </div>
  <!--交易流程-->
</div>

<?php
  echo $this->render('/layouts/footer');
?>
