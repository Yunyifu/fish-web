<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '供应详情';
$img = $goods->pic ? 'http://dev.image.alimmdn.com'.$goods->pic.'@!goods' : 'http://dev.image.alimmdn.com/2/14990510304821.jpg';
$this->registerJsFile("@web/js/layer/layer/layer.js", ['depends' => ['frontend\assets\AppAsset']]);
$this->registerJsFile("@web/js/goods-detail.js", ['depends' => ['frontend\assets\AppAsset']]);
$this->registerJsFile("@web/js/meiqia.js", ['depends' => ['frontend\assets\AppAsset']]);
$statuses = [Html::img('/images/bluepoint.png'),Html::img('/images/graypoint.png'),Html::img('/images/graypoint.png')];
$borderColor = [ 'blue', '', '' ];
if ($goods->status == 3) {
  $statuses[1] = Html::img('/images/bluepoint.png');
  $borderColor[1] = 'blue';
}
if ($goods->status == 2) {
  $statuses[1] = Html::img('/images/bluepoint.png');
  $statuses[2] = Html::img('/images/bluepoint.png');
  $borderColor[1] = 'blue';
  $borderColor[2] = 'blue';
}
$userId = \Yii::$app->user->id ? \Yii::$app->user->id : 'null';
?>

<?= $this->render('/layouts/search')?>
<?= $this->render('/layouts/navi-bar')?>

<div class="container content detail" style="margin-top:0">
  <h5 class="notice detail">您当前的位置：<?= Html::a('首页', ['/'])?> <?= Html::a('>供应信息', ['/goods'])?> > 详情</h5>

  <div class="slider detail">
    <img src="<?= $img?>" alt="">
  </div>

  <div class="detail-content">
    <div class="pull-right">
      <a class=" anchor pay <?= $goods->status==2? 'selled':''?>" href="#"><?= Html::img('/images/money-icon.png') ?>支付定金</a>
      <br>
      <!-- <a class=" anchor offline-pay <?= $goods->status==2? 'selled':''?>" href="#"><?= Html::img('/images/money-icon.png') ?>通过银行打款</a>
      <br> -->
      <a class=" anchor consult" href="#"><?= Html::img('/images/service-icon.png') ?>在线咨询</a>
      <br>
    </div>
    <h5 style="margin-top:3px;">交易顾问：<?= $phone ?>(支付定金前请先联系交易顾问)</h5>
    <h5 style="line-height: 22px;"><?= $goods->title ?></h5>
    <span class="created_at"><?= date('Y-m-d', $goods->updated_at) ?></span>
    <span>所在海域：<?= $goods->area ?></span><br>
    <span class="status blue"><?= $statuses[0]?>发布需求</span><span class="status <?= $borderColor[1]?>"><?= $statuses[1]?>询价中</span><span class="status <?= $borderColor[2]?>"><?= $statuses[2]?>已成交</span>
    <h6>供应详情</h6>
    <p><?= $goods->desc?></p>
  </div>
  <!--交易流程-->
  <?php echo $this->render('/layouts/steps'); ?>
  <!--交易流程-->
</div>

<?php
  echo $this->render('/layouts/footer');
?>
<script type="text/javascript">
  var id = <?= $goods->id ?>;
  var user_id = <?= $userId ?>;
  var goods_id = <?= $goods->id ?>;
</script>

<div style="width:0px;height:0px;" class="overhidden">
  <div id="pay">
    <h6>支付</h6>
    <form class="" action="/pay/pay" method="get">
      <label for="">&nbsp;&nbsp;￥&nbsp;&nbsp;</label>
      <input class="input" id="amount" type="text" name="amount" value="" placeholder="请与客服协商定金">
      <br>
      <label for="">开户姓名</label>
      <input  class="input"type="text" name="acct_name" value="">
      <br>
      <label for="">身份证号</label>
      <input  class="input"type="text" name="id_no" value="">
      <input type="hidden" id="order" name="orderId" value="">
      <br>
      <button class="btn pay" type="button" name="button">支付</button>
      <input class="btn hidden pay-btn" type="submit" name="" value="支付">
    </form>
  </div>
  <div id="offline-pay">
    <h6>通过银行打款</h6>
  </div>
</div>
