<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '渔鱼网';
$url = \Yii::$app->request->url;
$this->registerJsFile("@web/js/jquery.unslider.js", ['depends' => ['frontend\assets\AppAsset']]);
$this->registerJsFile("@web/js/index.js", ['depends' => ['frontend\assets\AppAsset']]);
$greet = \Yii::$app->user->isGuest ? "Hello" : \Yii::$app->user->identity->nickname;
$avatar = \Yii::$app->user->isGuest ? "/1/default.jpg@294w_196h_1l" : \Yii::$app->user->identity->avatar;
?>
<?= $this->render('/layouts/search')?>

<?= $this->render('/layouts/navi-bar')?>

<div class="container content">
  <br class="clear">
    <div class="tab">
      <span class="tab-title">热门分类</span>
      <a class="type pull-left" href="#">鱼类</a>
      <div class="index tab-anchors">
        <?php foreach ($categoryData as $key => $category): ?>
          <?= Html::a($category['name'], ['/goods/list', 'GoodsSearch[category_id]'=>$category['id']] ) ?>
        <?php endforeach; ?>
      </div>
      <h6 class="news title">交易最新动态</h6>
      <?php foreach ($lastOrders as $key => $order): ?>
        <p class="news content"><?= date('Y-m-d', $order->updated_at).'&nbsp;&nbsp;'.$order->buyername. '已选购' .$order->sellername?>的海鲜</p>
      <?php endforeach; ?>
    </div>
    <div class="slider" id="slider">
      <ul>
        <?php foreach ($bannerData as $key => $banner): ?>
          <li class="pull-left">
            <a href="<?= $banner->link_path?>" target="_blank"><?= Html::img('http://dev.image.alimmdn.com/'.$banner->file_path, ['alt' => 'slider', 'width'=>'600', 'height'=>'300']) ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="login">
      <img src="http://dev.image.alimmdn.com<?= $avatar ?>" alt="一个图">
      <span class="greet">
        <?= Html::a($greet, ['/user-center'], ['class'=>'no-warp','style'=>'background:none;color:#666;width:120px;']) ?>
      </span>
      <br>
      <span class="greet" style="margin-top: 0px;">欢迎来到渔鱼网</span>
      <br class="clear">
      <?php if (!\Yii::$app->user->isGuest): ?>
        <?= Html::a('退出', '/site/logout') ?>
        <?php else: ?>
          <?= Html::a('登录', '/site/login') ?>
          <?= Html::a('注册', '/site/reg') ?>
      <?php endif; ?>
      <br><br>
      <div class="guarantee">
        <h6>平台保障</h6>
        <span class="icon infor"> </span>
        <span class="icon phone"> </span>
        <span class="icon safe"> </span>
        <br>
        <span>信息真实</span>
        <span>资金安全</span>
        <span>手机认证</span>
      </div>
    </div>
  <br class="clear">
  <div class="sub-title for-steps">
    <a href="#"></a>
    <h5>交易流程<span> 保障需求与供应方的权益 平台全程参与交易 确保信息真实 资金托管安全有保障</span></h5>
  </div>
  <div class="steps">
    <div class="step">
      <h6>发布需求</h6>
      <p>详细描述需要采购或是出售的海鲜</p>
    </div>
    <div class="step step2">
      <h6>联系交易顾问</h6>
      <p>联系交易顾问，约定交易信息</p>
    </div>
    <div class="step step3">
      <h6>交付定金</h6>
      <p>交付定金，查看货品进行交易</p>
    </div>
  </div>
  <div id="gallery" class="gallery">
    <ul>
      <li><img src="" alt="test1"></li>
      <li><img src="" alt="test2"></li>
    </ul>
  </div>
  <div class="sub-title">
    <?= Html::a('查看更多 >', ['/goods/list'], ['class'=>'pull-right'])?>
    <h5><span class="icon need"></span>供应信息<span>保障需求与供应方的权益</span></h5>
  </div>
    <ul class="information goods">
      <li class="left-shade"> </li>
      <?php foreach ($goodsData as $key => $goods): ?>
        <li class="<?= ($key+1)==count($goodsData)? 'last':''?>">
          <div class="user pull-right">
            <img class="user-avatar" src="<?php echo $goods->user->avatar?>" alt="用户头像">
              <span class="user-name no-warp"><?= $goods->user->nickname?></span>
            <span class="user-time no-warp">5分钟前发布</span>
          </div>
          <?= Html::a($goods->title, ['/goods/detail', 'id'=>$goods->id])?>
        </li>
      <?php endforeach; ?>
    </ul>
  <div class="sub-title">
    <?= Html::a('查看更多 >', ['/demand/list'], ['class'=>'pull-right'])?>
    <h5><span class="icon purchase"></span>采购信息</h5>
  </div>
    <ul class="information demand">
      <li class="left-shade"> </li>
      <li class="head">
        <span>采购品类</span>
        <span>采购价格</span>
        <span>采购数量</span>
        <span>状态要求</span>
        <span>其他要求</span>
        <span>地理位置</span>
        <span>发布时间</span>
      </li>
      <?php foreach ($demandData as $key => $demand): ?>
        <li class="item <?= ($key+1)==count($demandData)? 'last':''?>">
          <span><?= $demand->title?></span>
          <span><?= $demand->price?></span>
          <span><?= $demand->num?></span>
          <span>新鲜</span>
          <span title="<?= $demand->desc?>" class="no-warp"><?= $demand->desc?></span>
          <span><?= $demand->position?></span>
          <span><?= date('Y.m.d', $demand->updated_at)?></span>
        </li>
      <?php endforeach; ?>
    </ul>
</div>
<?php
  echo $this->render('/layouts/footer');
?>
