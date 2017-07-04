<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '供应详情';
$img = $goods->pic ? 'http://dev.image.alimmdn.com'.$goods->pic.'@!goods' : 'http://dev.image.alimmdn.com/2/14990510304821.jpg';
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
      <a class=" anchor pay " href="#">支付定金</a>
      <br>
      <a class=" anchor consult" href="#">在线咨询</a>
    </div>
    <h5>交易顾问：<?= $phone ?></h5>
    <h5><?= $goods->title ?></h5>
    <span class="created_at"><?= date('Y-m-d', $goods->updated_at) ?></span>
    <span>所在地区：<?= $goods->area ?></span><br>
    <span class="status blue"><?= $statuses[0]?>发布需求</span><span class="status <?= $borderColor[1]?>"><?= $statuses[1]?>询价中</span><span class="status <?= $borderColor[2]?>"><?= $statuses[2]?>已成交</span>
    <h6>供应详情</h6>
    <p><?= $goods->desc?></p>
  </div>
  <!--交易流程-->
  <div class="sub-title for-steps">
    <a href="#"></a>
    <h5 class="margin-top0">交易流程<span> 保障需求与供应方的权益 平台全程参与交易 确保信息真实 资金托管安全有保障</span></h5>
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
  <!--交易流程-->
</div>

<?php
  echo $this->render('/layouts/footer');
?>
<script type="text/javascript">
  var id = <?php echo $goods->id ?>
</script>
