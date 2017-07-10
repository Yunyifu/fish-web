<?php
use yii\helpers\Html;
?>
<div class="footer">
  <div class="content">
    <img class="pull-right" src="https://open.weixin.qq.com/connect/qrcode/021MGhx7h-IzVww-" alt="QR_code">
    <span class="pull-right clear">app下载</span>
    <h6>联系我们</h6>
    <p>浙江省台州市椒江区洪家街道洪西路1号（星星电子商务产业园）</p>
    <p>0576-88199627</p>
    <br>
    <?= Html::a('网站主页',['/']) ?>
    <?= Html::a('供应信息',['/goods/list']) ?>
    <?= Html::a('采购信息',['/demand/list']) ?>
    <?= Html::a('用户中心',['/user-center']) ?>
    <?= Html::a('实时资讯',['/news/list']) ?>
  </div>
</div>
<ul class="gotop" style="display: block;">
    <li class="qr">
        <div class="">
          <?= Html::img('/images/qr-temp.jpg') ?>
          扫描下载我们的APP
        </div>
    </li>
    <li class="phone">
      <div>
        <p>客服热线</p>
        <p>0576-88199627</p>
      </div>
    </li>
    <li class="cs">
      <div class="">
        <p>点击弹出客服</p>
      </div>
    </li>
    <li class="top">
        <a href="#top" class="btn_gotop"></a>
    </li>
</ul>
