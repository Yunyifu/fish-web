<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AdminAsset;
use yii\helpers\Html;
use common\util\Utils;
use yii\web\View;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>超级工程师_模具设计_设计外包_超级工程师平台_comaking-模具设计外包交易平台(众造科技)</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="Keywords" content="comaking,超级工程师,模具设计,设计外包,模具开发,超级工程师APP,压铸模,签约工程师,签约工作室,担保交易,资金托管,模流分析,众造科技" />
<meta name="Description" content="超级工程师平台是众造科技打造的模具设计外包交易平台；超级工程师平台为企业对接优质模具设计工程师，免费为企业提供设计外包在线交易保障。TEL:0574-86865909" />
<meta name="Author" content="风筝" />

<link rel="shortcut icon" href="/images/favicon.ico"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
/*    $this->registerJs( "var frontUrl='" . Utils::getImgUrlPrefix() . "';", View::POS_HEAD );
    $this->registerJs( "var apiUrl='" . \Yii::$app->params ['apiUrl'] . "';", View::POS_HEAD );
    */?>
</head>
<body>
<?php $this->beginBody() ?>
<!--top-header --><!--header -->
<div  class="header ">
  <div class="w1100 clearfix">
    <div class="logo"><a href="/" title="超级工程师">超级工程师</a><span class="fl txt">用户注册 | 登录</span></div>
    <a href="" class="icon-app show-mobile-qr fr mt-40">手机客户端<img src="../../images/mobile-qr.png" class="mobile-qr hide-area" alt=""></a>
  </div>
</div>
<div>
    <center><?= Alert::widget() ?></center>
</div>

    <?= $content ?>
<div class="footer w1100 clearfix"> <a href="/about/index" target="_blank">关于我们</a> | <a href="/fqa/index" target="_blank">新手指南</a> | <a href="/help/index" target="_blank">平台签约</a> | <a href="/help/index?id=owm2x" target="_blank">交易保障</a> | <a href="/help/index?id=xgv5x" target="_blank">特色服务</a><br />
  Copyright 2016 - <?= date("Y")?> www.comaking.net   宁波北仑模具协会主办 众造科技运营   电话：0574-86865909  浙ICP备16015736号
	<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1260289650'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1260289650%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
  
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
