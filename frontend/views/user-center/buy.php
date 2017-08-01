
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '我的购买';
$this->registerJsFile("@web/js/layer/layer/layer.js", ['depends' => ['frontend\assets\AppAsset']]);
$this->registerJsFile("@web/js/buy.js", ['depends' => ['frontend\assets\AppAsset']]);
?>


<?php foreach ($dataProvider->models as $key => $buy): ?>
  <li class="goods">
    <span class="pull-left"> <?= Html::a($buy->goods_name, ['/goods/detail', 'id'=>$buy->goods->id]) ?></span>
    <?php
    echo Html::a('删除', ['/user-center/demand'], ['class'=>'anchor pull-right']);
      if ($buy->status == 0) {
        echo Html::a('继续支付', ['/pay/pay', 'orderId'=>$buy->id], ['class'=>'pull-right']);
      }else{
        echo Html::tag('span',$buy->statustextbuyer, ['class'=>'pull-right']);
      }
    ?>
    <!-- <span class="pull-right">发布时间：<?= date('Y-m-d', $buy->created_at)?></span> -->
  </li>
<?php endforeach; ?>
<li><?= $this->render('/layouts/pager', ['pageCount' => $pageCount]);?></li>
<script type="text/javascript">
  var pay = 0;
  <?php
  //支付结果
    if ( isset($payResult['res_data']) && $result = json_decode($payResult['res_data'])) {
      if ($result->result_pay == 'SUCCESS') {
        echo "var pay = 1;";
      }else{
        echo "var pay = 2;";
      }
    }
  ?>
</script>
