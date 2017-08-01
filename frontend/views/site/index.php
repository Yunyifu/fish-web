<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '鱼渔网';
$url = \Yii::$app->request->url;
$this->registerJsFile("@web/js/jquery.unslider.js", ['depends' => ['frontend\assets\AppAsset']]);
$this->registerJsFile("@web/js/index.js", ['depends' => ['frontend\assets\AppAsset']]);
$greet = \Yii::$app->user->isGuest ? "Hello" : \Yii::$app->user->identity->nickname;
$avatar = \Yii::$app->user->isGuest ? "/1/default.jpg@294w_196h_1l" : \Yii::$app->user->identity->avatar;
?>
<?= $this->render('/layouts/search')?>

<?= $this->render('/layouts/navi-bar')?>

<div class="container content index">
    <div class="tab">
      <span class="tab-title">热门分类</span>
      <a class="type pull-left hidden" href="#">鱼类</a>
      <div class="index tab-anchors">
        <?php
          foreach ($categoryData as $key => $category) {
            if ($key < 16) {
               echo Html::a($category['name'], ['/goods/list', 'GoodsSearch[category_id]'=>$category['id']] );
               if ( ($key+1)%4 !== 0 ) {
                 echo "<span style=\"text-align:center;color: #333;\">| </span>";
               }
            }
          }
        ?>
      </div>
      <div class="guarantee">
        <h6><?= Html::img('/images/guard.png') ?></h6>
        <span class="icon infor"> </span>
        <span class="icon safe"> </span>
        <span class="icon phone"> </span>
        <br>
        <span>信息真实</span>
        <span>资金安全</span>
        <span>手机认证</span>
      </div>
    </div>
    <div class="slider" id="slider">
      <ul>
        <?php foreach ($bannerData as $key => $banner): ?>
          <li class="pull-left">
            <a href="<?= $banner->link_path?>" target="_blank"><?= Html::img('http://dev.image.alimmdn.com/'.$banner->file_path, ['alt' => 'slider', 'width'=>'600', 'height'=>'338']) ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="login">
      <?= Html::img('http://dev.image.alimmdn.com/'.$avatar, ['class'=>'avatar']) ?>
      <span class="greet">
        <?= Html::a($greet, ['/user-center'], ['class'=>'no-warp','style'=>'background:none;color:#666;width:120px;text-align:left']) ?>
      </span>
      <br>
      <span class="greet" style="margin-top: 0px;">欢迎来到鱼渔网</span>
      <br class="clear">
      <?php if (!\Yii::$app->user->isGuest): ?>
        <?= Html::a('退出', '/site/logout') ?>
        <?= Html::a('发布', '/site/publish') ?>
        <?php else: ?>
          <?= Html::a('登录', '/site/login') ?>
          <?= Html::a('注册', '/site/reg') ?>
      <?php endif; ?>
      <br><br>
      <h6 class="news title">交易最新动态 ———————</h6>
      <ul id="latest">
        <?php foreach ($lastOrders as $key => $order): ?>
          <li class="news content"><?= date('Y-m-d', $order->updated_at).'&nbsp;&nbsp;'.$order->buyername. '已选购' .$order->sellername?>的海鲜<span class="pull-right red price">￥<?= $order->goods_amount?></span></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <br class="clear">
  <!--交易流程-->
  <?php echo $this->render('/layouts/steps'); ?>
  <!--交易流程-->
  <div class="container content center gallery">
    <button id="slide-left" class="pull-left"><?= Html::img('/images/left.png', ['alt' => 'gallery']) ?></button>
    <div id="gallery" class="gallery">
      <ul style="width: <?=count($gallery)*182 ?>px">
        <?php foreach ($gallery as $key => $img): ?>
          <li><?= Html::img('http://dev.image.alimmdn.com/'.$img->file_path, ['alt' => 'gallery']) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <button id="slide-right" class="pull-right"><?= Html::img('/images/right.png', ['alt' => 'gallery']) ?></button>
  </div>
  <div class="sub-title list">
    <?= Html::a('查看更多 >', ['/goods/list'], ['class'=>'pull-right'])?>
  <span class="icon need"><h5 class="margin0"></span>最新供应信息  <!-- <span>保障采购与供应方的权益</span> --></h5>
  </div>
    <?= Html::a(Html::img('/images/fisher.png'),['/site/publish'], ['class'=> 'pull-left']) ?>
    <ul class="information goods pull-left">
      <li class="left-shade"> </li>
      <?php foreach ($goodsData as $key => $goods): ?>
        <li class="<?= ($key+1)==count($goodsData)? 'last':''?>">
          <div class="user pull-right">
            <?= Html::img('http://dev.image.alimmdn.com/'.$goods->user->avatar, ['class'=>'user-avatar']) ?>
            <span class="user-name no-warp"><?= $goods->user->nickname?></span>
            <span class="user-time no-warp"><?= $goods->pubtime?></span>
          </div>
          <?= Html::a($goods->title.'—'.$goods->desc, ['/goods/detail', 'id'=>$goods->id])?>
        </li>
      <?php endforeach; ?>
    </ul>
    <?= Html::a(Html::img('http://dev.image.alimmdn.com/'.$adv->file_path, ['alt' => 'LOGO', 'style'=>'margin-bottom: 15PX; width:1080px;']), [$adv->link_path]) ?>
  <div class="sub-title list">
    <?= Html::a('查看更多 >', ['/demand/list'], ['class'=>'pull-right'])?>
    <span class="icon purchase"></span><h5>最新采购信息</h5>
  </div>
  <?= Html::a(Html::img('/images/seller.png'),['/site/publish'], ['class'=> 'pull-left', 'style'=>"margin-top:7px;"]) ?>
    <ul class="information demand pull-left">
      <li class="left-shade"> </li>
      <li class="head">
        <span>采购品类</span>
        <span>采购价格</span>
        <span>采购数量</span>
        <span>状态要求</span>
        <span>其他要求</span>
        <span>海域</span>
        <span>交易顾问</span>
        <span>发布时间</span>
      </li>
      <?php foreach ($demandData as $key => $demand): ?>
        <li class="item <?= ($key+1)==count($demandData)? 'last':''?>">
          <span class="no-warp"><?= $demand->title?></span>
          <span class="no-warp"><?= $demand->price?></span>
          <span class="no-warp"><?= $demand->num?></span>
          <span class="no-warp"><?= $demand->demandstatus?></span>
          <span title="<?= $demand->desc?>" class="no-warp"><?= $demand->otherstatus?></span>
          <span class="no-warp"><?= $demand->area?></span>
          <span class="no-warp"><?= $demand->dealer?></span>
          <span class="date"><?= date('Y.m.d', $demand->updated_at)?></span>
          <!-- <p class="dealer">供货渔民请联系<?=  $demand->dealer?></p> -->
          <!-- <button class="consult" type="button" name="button">在线咨询</button> -->
        </li>
      <?php endforeach; ?>
      <li class="right-shade"></li>
    </ul>
</div>
<?php
  echo $this->render('/layouts/footer');
?>
<script type="text/javascript">
  var gallery = <?php echo count($gallery) ?>;
</script>
